<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Transaction;
use App\Services\MidtransService;
use App\Services\TransactionCompletionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function __construct(
        private MidtransService $midtrans,
        private TransactionCompletionService $completion,
    ) {}

    public function store(Request $request, Campaign $campaign): RedirectResponse
    {
        $validated = $request->validate([
            'nominal'      => ['required', 'numeric', 'min:1000'],
            'bank_name'    => ['nullable', 'string', 'max:100'],
            'is_anonymous' => ['nullable', 'boolean'],
        ]);

        $user = $this->authUserFromRequest($request);

        $transaction = Transaction::create([
            'buyer_id'             => $user->id,
            'campaign_id'          => $campaign->id,
            'total_product_price'  => 0,
            'extra_donation'       => $validated['nominal'],
            'total_paid'           => $validated['nominal'],
            'bank_name'            => $validated['bank_name'] ?? 'Midtrans',
            'is_anonymous'         => $request->boolean('is_anonymous'),
            'status'               => 'pending',
            'created_at'           => now(),
        ]);

        $transaction->midtrans_order_id = $this->midtrans->orderIdFor($transaction);
        $transaction->save();

        if (! MidtransService::isEnabled()) {
            $this->completion->complete($transaction);

            return redirect()->route('detail-program', $campaign)
                ->with('success', 'Terima kasih! Donasimu sebesar Rp '.number_format($validated['nominal'], 0, ',', '.').' berhasil dan langsung tersalurkan.');
        }

        return redirect()->route('payment.show', $transaction);
    }
}
