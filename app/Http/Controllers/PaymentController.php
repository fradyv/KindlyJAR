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
            return redirect()->route('riwayat')
                ->with('error', 'Pembayaran gagal atau kedaluwarsa. Silakan coba lagi.');
        }

        try {
            $snapToken = $this->midtrans->createSnapToken($transaction);
        } catch (Throwable $e) {
            report($e);

            return redirect()->back()
                ->with('error', 'Gagal memuat halaman pembayaran. Periksa konfigurasi Midtrans kamu.');
        }

        $transaction->load('campaign');

        return view('payment.snap', compact('transaction', 'snapToken'));
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

        if ($status && $this->midtrans->isFailedStatus($status)) {
            $this->completion->fail($transaction, $request->query('transaction_id'));

            return redirect()->route('riwayat')
                ->with('error', 'Pembayaran gagal atau dibatalkan.');
        }

        if ($transaction->fresh()->status === 'success') {
            return $this->redirectAfterSuccess($transaction);
        }

        return redirect()->route('payment.show', $transaction)
            ->with('success', 'Pembayaran sedang diproses. Selesaikan pembayaran di popup Midtrans.');
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
            } elseif ($this->midtrans->isFailedStatus($status)) {
                $this->completion->fail($transaction, $midtransTransactionId);
            }
        } catch (Throwable $e) {
            report($e);

            return response('Notification error', 500);
        }

        return response('OK', 200);
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
