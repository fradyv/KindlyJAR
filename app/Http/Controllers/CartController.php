<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\DigitalProduct;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use App\Services\MidtransService;
use App\Services\TransactionCompletionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        private MidtransService $midtrans,
        private TransactionCompletionService $completion,
    ) {}

    private function userCart(bool $create = false): ?Cart
    {
        /** @var User $user */
        $user = auth()->user();

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

        return view('dashboard-user.keranjang', compact('cart', 'items', 'subtotal'));
    }

    public function add(Request $request, DigitalProduct $product): RedirectResponse
    {
        $quantity = max(1, (int) $request->input('quantity', 1));

        $cart = $this->userCart(create: true);

        if ($cart->campaign_id && $cart->campaign_id !== $product->campaign_id && $cart->items()->exists()) {
            return back()->with('error', 'Keranjangmu sedang berisi produk dari program donasi lain. Selesaikan checkout atau kosongkan keranjang dulu sebelum menambah produk dari program berbeda.');
        }

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

        if (! $cart->campaign_id) {
            $cart->update(['campaign_id' => $product->campaign_id]);
        }

        return back()->with('success', '"'.$product->title.'" berhasil ditambahkan ke keranjang.');
    }

    public function updateQuantity(Request $request, CartItem $cartItem): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
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
        /** @var User $user */
        $user = auth()->user();
        abort_if($cartItem->cart->user_id !== $user->id, 403);

        $cart = $cartItem->cart;
        $cartItem->delete();

        if (! $cart->items()->exists()) {
            $cart->update(['campaign_id' => null]);
        }

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function checkout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'extra_donation' => ['nullable', 'numeric', 'min:0'],
            'bank_name'      => ['nullable', 'string', 'max:100'],
            'is_anonymous'   => ['nullable', 'boolean'],
        ]);

        $cart = $this->userCart();
        $items = $cart ? $cart->items()->with('product')->get() : collect();

        if ($items->isEmpty()) {
            return redirect()->route('keranjang')->with('error', 'Keranjangmu masih kosong.');
        }

        foreach ($items as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('keranjang')
                    ->with('error', 'Stok "'.$item->product->title.'" tidak cukup untuk memenuhi jumlah di keranjangmu.');
            }
        }

        $totalProductPrice = $items->sum(fn ($item) => $item->product->price * $item->quantity);
        $extraDonation = $validated['extra_donation'] ?? 0;
        $totalPaid = $totalProductPrice + $extraDonation;

        /** @var User $user */
        $user = $request->user();

        $transaction = Transaction::create([
            'buyer_id'             => $user->id,
            'campaign_id'          => $cart->campaign_id,
            'total_product_price'  => $totalProductPrice,
            'extra_donation'       => $extraDonation,
            'total_paid'           => $totalPaid,
            'bank_name'            => $validated['bank_name'] ?? 'Midtrans',
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
                'price_at_purchase' => $item->product->price,
                'quantity'          => $item->quantity,
            ]);
        }

        $cart->items()->delete();
        $cart->update(['campaign_id' => null]);

        if (! MidtransService::isEnabled()) {
            $this->completion->complete($transaction);

            return redirect()->route('riwayat')
                ->with('success', 'Checkout berhasil! Total Rp '.number_format($totalPaid, 0, ',', '.').' telah dibayar dan tersalurkan.');
        }

        return redirect()->route('payment.show', $transaction);
    }
}
