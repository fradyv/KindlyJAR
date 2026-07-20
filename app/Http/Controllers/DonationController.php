<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function store(Request $request, Campaign $campaign): RedirectResponse
    {
        $validated = $request->validate([
            'nominal'      => ['required', 'numeric', 'min:1000'],
            'bank_name'    => ['nullable', 'string', 'max:100'],
            'is_anonymous' => ['nullable', 'boolean'],
        ]);

        $transaction = Transaction::create([
            'buyer_id'             => auth()->id(),
            'campaign_id'          => $campaign->id,
            'total_product_price'  => 0,
            'extra_donation'       => $validated['nominal'],
            'total_paid'           => $validated['nominal'],
            'bank_name'            => $validated['bank_name'] ?? 'Transfer Bank',
            'is_anonymous'         => $request->boolean('is_anonymous'),
            'status'               => 'success',
        ]);

        $transaction->payment_time = now();
        $transaction->created_at = now();
        $transaction->save();

        $campaign->increment('collected_amount', $validated['nominal']);

        return redirect()->route('detail-program', $campaign)
            ->with('success', 'Terima kasih! Donasimu sebesar Rp '.number_format($validated['nominal'], 0, ',', '.').' berhasil dan langsung tersalurkan.');
    }
}
