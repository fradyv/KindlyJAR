<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\Cart;
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

            $transaction->load(['items.product', 'items.campaign', 'campaign']);

            foreach ($transaction->items as $item) {
                if ($item->quantity > $item->product->stock) {
                    $transaction->update(['status' => 'failed']);

                    return false;
                }
            }

            foreach ($transaction->items as $item) {
                $item->product->decrement('stock', $item->quantity);
            }

            if (! $this->allocateCollectedFunds($transaction)) {
                $transaction->update(['status' => 'failed']);

                return false;
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
            $this->clearBuyerCart($transaction);

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

    public function clearBuyerCart(Transaction $transaction): void
    {
        if ((float) $transaction->total_product_price <= 0) {
            return;
        }

        $cart = Cart::where('user_id', $transaction->buyer_id)->first();

        if (! $cart) {
            return;
        }

        $transaction->loadMissing('items');

        foreach ($transaction->items as $item) {
            $cart->items()->where('product_id', $item->product_id)->delete();
        }
    }

    public function transactionHasBlockedCampaign(Transaction $transaction): bool
    {
        $transaction->loadMissing(['items.campaign', 'items.product.campaign', 'campaign']);

        foreach ($transaction->items as $item) {
            $campaign = $item->campaign ?? $item->product?->campaign;

            if ($campaign && ! $campaign->acceptsContributions()) {
                return true;
            }
        }

        if ($transaction->items->isEmpty() && $transaction->campaign) {
            return ! $transaction->campaign->acceptsContributions();
        }

        return false;
    }

    private function allocateCollectedFunds(Transaction $transaction): bool
    {
        if ($transaction->items->isNotEmpty()) {
            return $this->allocateProductPurchaseFunds($transaction);
        }

        if ($transaction->campaign_id && $transaction->campaign) {
            $campaign = $transaction->campaign->fresh();

            if (! $campaign->acceptsContributions()) {
                return false;
            }

            $campaign->increment('collected_amount', $transaction->total_paid);
            $campaign->refresh()->markAsCompletedIfFull();

            return true;
        }

        return true;
    }

    private function allocateProductPurchaseFunds(Transaction $transaction): bool
    {
        $allocations = [];

        foreach ($transaction->items as $item) {
            $campaignId = $item->campaign_id ?? $item->product?->campaign_id;

            if (! $campaignId) {
                continue;
            }

            $amount = (float) $item->price_at_purchase * $item->quantity;
            $allocations[$campaignId] = ($allocations[$campaignId] ?? 0) + $amount;
        }

        if ($allocations === []) {
            return true;
        }

        $extraDonation = (float) $transaction->extra_donation;

        if ($extraDonation > 0) {
            $this->distributeExtraDonation($allocations, $extraDonation);
        }

        foreach ($allocations as $campaignId => $amount) {
            $campaign = Campaign::query()->find($campaignId);

            if (! $campaign || ! $campaign->acceptsContributions()) {
                return false;
            }

            $campaign->increment('collected_amount', $amount);
            $campaign->refresh()->markAsCompletedIfFull();
        }

        return true;
    }

    /**
     * @param  array<int, float>  $allocations
     */
    private function distributeExtraDonation(array &$allocations, float $extraDonation): void
    {
        $totalProduct = array_sum($allocations);

        if ($totalProduct <= 0) {
            return;
        }

        $campaignIds = array_keys($allocations);
        $distributed = 0.0;
        $lastIndex = count($campaignIds) - 1;

        foreach ($campaignIds as $index => $campaignId) {
            if ($index === $lastIndex) {
                $share = round($extraDonation - $distributed, 2);
            } else {
                $share = round($extraDonation * ($allocations[$campaignId] / $totalProduct), 2);
                $distributed += $share;
            }

            $allocations[$campaignId] += $share;
        }
    }
}
