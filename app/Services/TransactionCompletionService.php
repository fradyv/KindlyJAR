<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionCompletionService
{
    public function complete(Transaction $transaction, ?string $midtransTransactionId = null): bool
    {
        if ($transaction->status === 'success') {
            return true;
        }

        return DB::transaction(function () use ($transaction, $midtransTransactionId) {
            $transaction->refresh();

            if ($transaction->status === 'success') {
                return true;
            }

            $transaction->load(['items.product', 'campaign']);

            foreach ($transaction->items as $item) {
                if ($item->quantity > $item->product->stock) {
                    $transaction->update(['status' => 'failed']);

                    return false;
                }
            }

            foreach ($transaction->items as $item) {
                $item->product->decrement('stock', $item->quantity);
            }

            if ($transaction->campaign_id && $transaction->campaign) {
                $transaction->campaign->increment('collected_amount', $transaction->total_paid);
            }

            $updates = [
                'status'       => 'success',
                'payment_time' => now(),
            ];

            if ($midtransTransactionId) {
                $updates['midtrans_transaction_id'] = $midtransTransactionId;
            }

            if (! $transaction->bank_name || $transaction->bank_name === 'Transfer Bank') {
                $updates['bank_name'] = 'Midtrans';
            }

            $transaction->update($updates);

            return true;
        });
    }

    public function fail(Transaction $transaction, ?string $midtransTransactionId = null): void
    {
        if ($transaction->status === 'success') {
            return;
        }

        $updates = ['status' => 'failed'];

        if ($midtransTransactionId) {
            $updates['midtrans_transaction_id'] = $midtransTransactionId;
        }

        $transaction->update($updates);
    }
}
