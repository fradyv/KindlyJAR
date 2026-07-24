<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\DigitalProduct;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Services\MidtransService;
use App\Services\TransactionCompletionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        private MidtransService $midtrans,
        private TransactionCompletionService $completion,
    ) {}

    private function userCart(bool $create = false): ?Cart
    {
        $user = $this->authUser();

        if ($create) {
            return Cart::firstOrCreate(['user_id' => $user->id]);
        }

        return Cart::where('user_id', $user->id)->first();
    }

    public function index(): View
    {
        $cart = $this->userCart();
        $items = $cart ? $cart->items()->with(['product.shop', 'product.campaign'])->latest('id')->get() : collect();
        $subtotal = $items->sum(fn ($item) => $item->product->price * $item->quantity);
        $campaignGroups = $items->groupBy(fn ($item) => $item->product->campaign_id);

        $pendingPayment = Transaction::where('buyer_id', $this->authUser()->id)
            ->where('status', 'pending')
            ->where('total_product_price', '>', 0)
            ->latest('created_at')
            ->first();

        return view('dashboard-user.keranjang', compact('cart', 'items', 'subtotal', 'pendingPayment', 'campaignGroups'));
    }

    public function add(Request $request, DigitalProduct $product): RedirectResponse
    {
        $product->load('campaign');

        if ($product->campaign && ! $product->campaign->acceptsContributions()) {
            return back()->with('error', 'Program donasi untuk produk ini sudah terpenuhi. Pembelian tidak dapat dilanjutkan.');
        }

        $quantity = max(1, (int) $request->input('quantity', 1));

        $cart = $this->userCart(create: true);

        $existing = $cart->items()->where('product_id', $product->id)->first();
        $currentQty = $existing?->quantity ?? 0;

        if ($currentQty + $quantity > $product->stock) {
            return back()->with('error', 'Stok "'.$product->title.'" tidak cukup. Sisa stok: '.$product->stock.'.');
        }

        if ($existing) {
            $existing->increment('quantity', $quantity);
        } else {
            CartItem::create([
                'cart_id'    => $cart->id,
                'product_id' => $product->id,
                'quantity'   => $quantity,
            ]);
        }

        return back()->with('success', '"'.$product->title.'" berhasil ditambahkan ke keranjang.');
    }

    public function updateQuantity(Request $request, CartItem $cartItem): RedirectResponse
    {
        $user = $this->authUserFromRequest($request);
        abort_if($cartItem->cart->user_id !== $user->id, 403);

        $quantity = max(1, (int) $request->input('quantity', 1));

        if ($quantity > $cartItem->product->stock) {
            return back()->with('error', 'Stok tidak cukup. Sisa stok: '.$cartItem->product->stock.'.');
        }

        $cartItem->update(['quantity' => $quantity]);

        return back()->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function remove(CartItem $cartItem): RedirectResponse
    {
        abort_if($cartItem->cart->user_id !== $this->authUser()->id, 403);

        $cartItem->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function checkout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'extra_donation' => ['nullable', 'numeric', 'min:0'],
            'is_anonymous'   => ['nullable', 'boolean'],
        ]);

        $cart = $this->userCart();
        $items = $cart ? $cart->items()->with(['product.campaign'])->get() : collect();

        if ($items->isEmpty()) {
            return redirect()->route('keranjang')->with('error', 'Keranjangmu masih kosong.');
        }

        foreach ($items as $item) {
            $campaign = $item->product->campaign;

            if ($campaign && ! $campaign->acceptsContributions()) {
                return redirect()->route('keranjang')
                    ->with('error', 'Program donasi untuk "'.$item->product->title.'" sudah terpenuhi. Hapus produk tersebut atau kosongkan keranjang.');
            }

            if ($item->quantity > $item->product->stock) {
                return redirect()->route('keranjang')
                    ->with('error', 'Stok "'.$item->product->title.'" tidak cukup untuk memenuhi jumlah di keranjangmu.');
            }
        }

        $totalProductPrice = $items->sum(fn ($item) => $item->product->price * $item->quantity);
        $extraDonation = $validated['extra_donation'] ?? 0;
        $totalPaid = $totalProductPrice + $extraDonation;

        $user = $this->authUserFromRequest($request);

        $campaignIds = $items->pluck('product.campaign_id')->unique()->filter()->values();
        $transactionCampaignId = $campaignIds->count() === 1 ? $campaignIds->first() : null;

        $existingPending = $this->findMatchingPendingTransaction(
            $user->id,
            $items,
            $totalProductPrice,
            $extraDonation,
        );

        if ($existingPending) {
            if (! MidtransService::isEnabled()) {
                $this->completion->complete($existingPending);

                return redirect()->route('riwayat')
                    ->with('success', 'Checkout berhasil! Total Rp '.number_format($totalPaid, 0, ',', '.').' telah dibayar dan tersalurkan.');
            }

            return redirect()->route('payment.show', $existingPending)
                ->with('success', 'Kamu masih punya pembayaran yang belum selesai. Lanjutkan pembayaran di bawah ini.');
        }

        $transaction = Transaction::create([
            'buyer_id'             => $user->id,
            'campaign_id'          => $transactionCampaignId,
            'total_product_price'  => $totalProductPrice,
            'extra_donation'       => $extraDonation,
            'total_paid'           => $totalPaid,
            'bank_name'            => 'Midtrans',
            'is_anonymous'         => $request->boolean('is_anonymous'),
            'status'               => 'pending',
            'created_at'           => now(),
        ]);

        $transaction->midtrans_order_id = $this->midtrans->orderIdFor($transaction);
        $transaction->save();

        foreach ($items as $item) {
            TransactionItem::create([
                'transaction_id'    => $transaction->id,
                'product_id'        => $item->product_id,
                'campaign_id'       => $item->product->campaign_id,
                'price_at_purchase' => $item->product->price,
                'quantity'          => $item->quantity,
            ]);
        }

        if (! MidtransService::isEnabled()) {
            $this->completion->complete($transaction);

            return redirect()->route('riwayat')
                ->with('success', 'Checkout berhasil! Total Rp '.number_format($totalPaid, 0, ',', '.').' telah dibayar dan tersalurkan.');
        }

        return redirect()->route('payment.show', $transaction);
    }

    private function findMatchingPendingTransaction(
        int $userId,
        Collection $cartItems,
        float $totalProductPrice,
        float $extraDonation,
    ): ?Transaction {
        $pendingTransactions = Transaction::where('buyer_id', $userId)
            ->where('status', 'pending')
            ->where('total_product_price', '>', 0)
            ->with('items')
            ->latest('created_at')
            ->get();

        foreach ($pendingTransactions as $transaction) {
            if (
                (float) $transaction->total_product_price === (float) $totalProductPrice
                && (float) $transaction->extra_donation === (float) $extraDonation
                && $this->cartMatchesTransaction($cartItems, $transaction)
            ) {
                return $transaction;
            }
        }

        return null;
    }

    private function cartMatchesTransaction(Collection $cartItems, Transaction $transaction): bool
    {
        if ($cartItems->count() !== $transaction->items->count()) {
            return false;
        }

        $cartMap = $cartItems->mapWithKeys(fn ($item) => [
            $item->product_id => $item->quantity,
        ]);

        foreach ($transaction->items as $item) {
            if (($cartMap[$item->product_id] ?? null) !== $item->quantity) {
                return false;
            }
        }

        return true;
    }
}
