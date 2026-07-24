<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WithdrawalController extends Controller
{
    public function index(): View
    {
        $user = $this->authUser();
        $wallet = $user->wallet ?? Wallet::create(['user_id' => $user->id]);

        $campaigns = $user->campaigns()->get();
        $totalAvailable = $campaigns->sum(fn ($campaign) => $campaign->available_balance);
        $pendingAmount = (float) $wallet->withdrawalRequests()->where('status', 'pending')->sum('amount');
        $withdrawable = max(0, $totalAvailable - $pendingAmount);

        $wallet->update(['balance' => $totalAvailable]);

        $requests = $wallet->withdrawalRequests()->latest()->paginate(10)->withQueryString();

        return view('dashboard-hero.pencairan-dana', [
            'wallet'         => $wallet,
            'campaigns'      => $campaigns,
            'totalAvailable' => $totalAvailable,
            'pendingAmount'  => $pendingAmount,
            'withdrawable'   => $withdrawable,
            'requests'       => $requests,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'amount'               => ['required', 'numeric', 'min:50000'],
            'bank_or_ewallet_info' => ['required', 'string', 'max:255'],
        ]);

        $user = $this->authUser();
        $wallet = $user->wallet ?? Wallet::create(['user_id' => $user->id]);

        $totalAvailable = $user->campaigns()->get()->sum(fn ($campaign) => $campaign->available_balance);
        $pendingAmount = (float) $wallet->withdrawalRequests()->where('status', 'pending')->sum('amount');
        $withdrawable = max(0, $totalAvailable - $pendingAmount);

        if ($validated['amount'] > $withdrawable) {
            return back()->with('error', 'Jumlah pencairan melebihi saldo yang tersedia (Rp '.number_format($withdrawable, 0, ',', '.').').');
        }

        $wallet->withdrawalRequests()->create([
            'amount'               => $validated['amount'],
            'bank_or_ewallet_info' => $validated['bank_or_ewallet_info'],
            'status'               => 'pending',
        ]);

        return redirect()->route('pencairan-dana')
            ->with('success', 'Permintaan pencairan dana sebesar Rp '.number_format($validated['amount'], 0, ',', '.').' berhasil diajukan. Tim admin akan meninjau dalam 1-2 hari kerja.');
    }
}
