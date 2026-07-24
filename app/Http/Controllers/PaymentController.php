<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\MidtransService;
use App\Services\TransactionCompletionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Throwable;

class PaymentController extends Controller
{
    public function __construct(
        private MidtransService $midtrans,
        private TransactionCompletionService $completion,
    ) {}

    public function show(Transaction $transaction): View|RedirectResponse
    {
        $user = $this->authUser();

        abort_if($transaction->buyer_id !== $user->id, 403);

        if ($transaction->status === 'success') {
            return redirect()->route('riwayat')
                ->with('success', 'Pembayaran sudah berhasil.');
        }

        if ($transaction->status === 'failed') {
            return $this->redirectAfterCancelled($transaction);
        }

        $transaction->load(['campaign', 'items.campaign']);

        if ($this->completion->transactionHasBlockedCampaign($transaction)) {
            $this->completion->fail($transaction);

            $message = 'Salah satu program donasi di pesanan ini sudah terpenuhi. Pembayaran tidak dapat dilanjutkan.';

            if ((float) $transaction->total_product_price > 0) {
                return redirect()->route('keranjang')->with('error', $message);
            }

            if ($transaction->campaign) {
                return redirect()->route('detail-program', $transaction->campaign)->with('error', $message);
            }

            return redirect()->route('program-donasi')->with('error', $message);
        }

        try {
            $snapToken = $this->midtrans->createSnapToken($transaction);
        } catch (Throwable $e) {
            report($e);

            $message = 'Gagal memuat halaman pembayaran.';
            if (! MidtransService::isEnabled()) {
                $message = 'Midtrans belum dikonfigurasi. Set MIDTRANS_SERVER_KEY atau aktifkan MIDTRANS_DEMO_MODE=true untuk development.';
            }

            return $this->redirectAfterPaymentLoadError($transaction, $message);
        }

        $transaction->load(['campaign', 'items.campaign']);

        $campaignTitles = $transaction->items
            ->pluck('campaign.title')
            ->filter()
            ->unique()
            ->values();

        if ($campaignTitles->isEmpty() && $transaction->campaign) {
            $campaignTitles = collect([$transaction->campaign->title]);
        }

        return view('payment.snap', compact('transaction', 'snapToken', 'campaignTitles'));
    }

    public function finish(Request $request, Transaction $transaction): RedirectResponse
    {
        $user = $this->authUser();

        abort_if($transaction->buyer_id !== $user->id, 403);

        $status = $request->query('transaction_status');

        if ($status && $this->midtrans->isSuccessfulStatus($status)) {
            $this->completion->complete(
                $transaction,
                $request->query('transaction_id')
            );

            return $this->redirectAfterSuccess($transaction);
        }

        if ($status && $this->midtrans->isCancelledStatus($status)) {
            $this->completion->fail($transaction, $request->query('transaction_id'));

            return $this->redirectAfterCancelled($transaction);
        }

        if ($transaction->fresh()->status === 'success') {
            return $this->redirectAfterSuccess($transaction);
        }

        return redirect()->route('payment.show', $transaction)
            ->with('success', 'Pembayaran belum selesai. Kamu bisa mencoba bayar lagi.');
    }

    public function notification(Request $request): Response
    {
        try {
            $notif = $this->midtrans->parseNotification();

            $orderId = $notif->order_id;
            $status = $notif->transaction_status;
            $midtransTransactionId = $notif->transaction_id ?? null;

            $transaction = $this->midtrans->findTransactionByOrderId($orderId);

            if (! $transaction) {
                return response('Transaction not found', 404);
            }

            if ($this->midtrans->isSuccessfulStatus($status)) {
                $this->completion->complete($transaction, $midtransTransactionId);
            } elseif ($this->midtrans->isCancelledStatus($status)) {
                $this->completion->fail($transaction, $midtransTransactionId);
            }
        } catch (Throwable $e) {
            report($e);

            return response('Notification error', 500);
        }

        return response('OK', 200);
    }

    private function redirectAfterPaymentLoadError(Transaction $transaction, ?string $message = null): RedirectResponse
    {
        $message ??= 'Gagal memuat halaman pembayaran. Periksa konfigurasi Midtrans kamu. Produk masih ada di keranjang — kamu bisa coba bayar lagi.';

        if ((float) $transaction->total_product_price > 0) {
            return redirect()->route('keranjang')
                ->with('error', $message)
                ->with('retry_payment_url', route('payment.show', $transaction));
        }

        $transaction->load('campaign');

        if ($transaction->campaign) {
            return redirect()->route('detail-program', $transaction->campaign)
                ->with('error', $message)
                ->with('retry_payment_url', route('payment.show', $transaction));
        }

        return redirect()->route('program-donasi')
            ->with('error', $message)
            ->with('retry_payment_url', route('payment.show', $transaction));
    }

    private function redirectAfterCancelled(Transaction $transaction): RedirectResponse
    {
        if ((float) $transaction->total_product_price > 0) {
            return redirect()->route('keranjang')
                ->with('error', 'Pembayaran dibatalkan. Produk masih ada di keranjang — silakan checkout ulang jika ingin melanjutkan.');
        }

        $transaction->load('campaign');

        if ($transaction->campaign) {
            return redirect()->route('detail-program', $transaction->campaign)
                ->with('error', 'Donasi dibatalkan. Silakan coba lagi jika kamu masih ingin berdonasi.');
        }

        return redirect()->route('program-donasi')
            ->with('error', 'Donasi dibatalkan.');
    }

    private function redirectAfterSuccess(Transaction $transaction): RedirectResponse
    {
        $message = 'Pembayaran berhasil! Total Rp '
            .number_format((float) $transaction->total_paid, 0, ',', '.')
            .' telah dibayar dan tersalurkan.';

        if ($transaction->total_product_price > 0) {
            return redirect()->route('riwayat')->with('success', $message);
        }

        $transaction->load('campaign');

        if ($transaction->campaign) {
            return redirect()->route('detail-program', $transaction->campaign)->with('success', $message);
        }

        return redirect()->route('riwayat')->with('success', $message);
    }
}
