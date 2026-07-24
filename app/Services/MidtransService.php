<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use Exception;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class MidtransService
{
    public static function isEnabled(): bool
    {
        if (config('midtrans.demo_mode')) {
            return false;
        }

        return filled(config('midtrans.server_key'));
    }

    public function configure(): void
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = (bool) config('midtrans.is_production');
        Config::$isSanitized = (bool) config('midtrans.is_sanitized');
        Config::$is3ds = (bool) config('midtrans.is_3ds');
    }

    public function orderIdFor(Transaction $transaction): string
    {
        return 'KJ-T-'.$transaction->id;
    }

    public function retryOrderIdFor(Transaction $transaction): string
    {
        return $this->orderIdFor($transaction).'-'.now()->format('YmdHis');
    }

    public function findTransactionByOrderId(string $orderId): ?Transaction
    {
        if (preg_match('/^KJ-T-(\d+)(?:-.+)?$/', $orderId, $matches)) {
            return Transaction::find($matches[1]);
        }

        return Transaction::where('midtrans_order_id', $orderId)->first();
    }

    public function createSnapToken(Transaction $transaction): string
    {
        $this->configure();

        /** @var User $buyer */
        $buyer = $transaction->buyer;

        $orderId = $transaction->midtrans_order_id ?? $this->orderIdFor($transaction);

        $params = $this->buildSnapParams($transaction, $buyer, $orderId);

        try {
            $token = Snap::getSnapToken($params);
        } catch (Exception $e) {
            if (! $this->isDuplicateOrderIdError($e)) {
                throw $e;
            }

            $orderId = $this->retryOrderIdFor($transaction);
            $params = $this->buildSnapParams($transaction, $buyer, $orderId);
            $token = Snap::getSnapToken($params);
        }

        $transaction->update(['midtrans_order_id' => $orderId]);

        return $token;
    }

    /** @return array<string, mixed> */
    private function buildSnapParams(Transaction $transaction, User $buyer, string $orderId): array
    {
        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) round((float) $transaction->total_paid),
            ],
            'customer_details' => [
                'first_name' => $buyer->display_name,
                'email'      => $buyer->email,
                'phone'      => $buyer->phone_number ?? '',
            ],
            'callbacks' => [
                'finish' => route('payment.finish', $transaction),
            ],
        ];

        $itemDetails = $transaction->items()
            ->with('product')
            ->get()
            ->map(fn ($item) => [
                'id'       => (string) $item->product_id,
                'price'    => (int) round((float) $item->price_at_purchase),
                'quantity' => $item->quantity,
                'name'     => $item->product->title,
            ])
            ->values()
            ->all();

        if ($itemDetails !== []) {
            $params['item_details'] = $itemDetails;

            if ((float) $transaction->extra_donation > 0) {
                $params['item_details'][] = [
                    'id'       => 'donation',
                    'price'    => (int) round((float) $transaction->extra_donation),
                    'quantity' => 1,
                    'name'     => 'Donasi Tambahan',
                ];
            }
        } elseif ((float) $transaction->extra_donation > 0) {
            $params['item_details'] = [[
                'id'       => 'donation',
                'price'    => (int) round((float) $transaction->extra_donation),
                'quantity' => 1,
                'name'     => 'Donasi Program',
            ]];
        }

        return $params;
    }

    private function isDuplicateOrderIdError(Exception $e): bool
    {
        $message = strtolower($e->getMessage());

        return str_contains($message, 'order_id')
            && (str_contains($message, 'sudah digunakan') || str_contains($message, 'already been taken'));
    }

    public function parseNotification(): Notification
    {
        $this->configure();

        return new Notification;
    }

    public function isSuccessfulStatus(string $status): bool
    {
        return in_array($status, ['capture', 'settlement'], true);
    }

    public function isCancelledStatus(string $status): bool
    {
        return $status === 'cancel';
    }

    public function isFailedStatus(string $status): bool
    {
        return in_array($status, ['deny', 'cancel', 'expire', 'failure'], true);
    }
}
