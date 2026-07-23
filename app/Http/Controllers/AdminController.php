<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\FundraiserVerification;
use App\Models\Transaction;
use App\Models\User;
use App\Models\WithdrawalRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $stats = [
            'total_users'         => User::count(),
            'total_fundraisers'   => User::whereHas('roles', fn ($q) => $q->where('name', 'fundraiser'))->count(),
            'pending_kyc'         => FundraiserVerification::where('status', 'pending')->count(),
            'pending_withdrawals' => WithdrawalRequest::where('status', 'pending')->count(),
            'total_collected'     => Campaign::sum('collected_amount'),
            'total_withdrawn'     => Campaign::sum('withdrawn_amount'),
            'total_transactions'  => Transaction::where('status', 'success')->count(),
        ];

        $latestVerifications = FundraiserVerification::with('user')->where('status', 'pending')->latest('created_at')->take(5)->get();
        $latestWithdrawals = WithdrawalRequest::with('wallet.user')->where('status', 'pending')->latest('created_at')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestVerifications', 'latestWithdrawals'));
    }

    public function users(Request $request): View
    {
        $search = $request->query('search');

        $users = User::with('roles')
            ->when($search, fn ($q) => $q->where(fn ($q2) => $q2
                ->where('display_name', 'like', "%{$search}%")
                ->orWhere('legal_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")))
            ->latest('id')
            ->get();

        return view('admin.users', compact('users', 'search'));
    }

    public function toggleUserActive(User $user): RedirectResponse
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Akun admin tidak bisa dinonaktifkan.');
        }

        $user->update(['is_active' => ! $user->is_active]);

        return back()->with('success', 'Status akun "'.$user->display_name.'" berhasil diperbarui.');
    }

    public function verifications(Request $request): View
    {
        $status = $request->query('status', 'pending');

        $verifications = FundraiserVerification::with('user')
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->latest('created_at')
            ->get();

        return view('admin.verifications', compact('verifications', 'status'));
    }

    public function approveVerification(FundraiserVerification $verification): RedirectResponse
    {
        $verification->update(['status' => 'verified']);
        $verification->user->update(['kyc_status' => 'verified']);

        return back()->with('success', 'Verifikasi KYC "'.$verification->user->display_name.'" berhasil disetujui.');
    }

    public function rejectVerification(FundraiserVerification $verification): RedirectResponse
    {
        $verification->update(['status' => 'rejected']);
        $verification->user->update(['kyc_status' => 'rejected']);

        return back()->with('success', 'Verifikasi KYC "'.$verification->user->display_name.'" ditolak.');
    }

    public function transactions(Request $request): View
    {
        $status = $request->query('status', 'all');

        $transactions = Transaction::with(['buyer', 'campaign'])
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->latest('created_at')
            ->get();

        return view('admin.transactions', compact('transactions', 'status'));
    }

    public function withdrawals(Request $request): View
    {
        $status = $request->query('status', 'pending');

        $withdrawals = WithdrawalRequest::with('wallet.user')
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->latest('created_at')
            ->get();

        return view('admin.withdrawals', compact('withdrawals', 'status'));
    }

    public function approveWithdrawal(WithdrawalRequest $withdrawal): RedirectResponse
    {
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Permintaan pencairan ini sudah diproses sebelumnya.');
        }

        $fundraiser = $withdrawal->wallet->user;
        $remaining = (float) $withdrawal->amount;

        $campaigns = $fundraiser->campaigns()->get()->sortByDesc(fn ($c) => $c->available_balance);

        foreach ($campaigns as $campaign) {
            if ($remaining <= 0) {
                break;
            }

            $deduction = min($remaining, $campaign->available_balance);
            if ($deduction > 0) {
                $campaign->increment('withdrawn_amount', $deduction);
                $remaining -= $deduction;
            }
        }

        /** @var User $admin */
        $admin = auth()->user();

        $withdrawal->update([
            'status'   => 'approved',
            'admin_id' => $admin->id,
        ]);

        return back()->with('success', 'Pencairan dana sebesar Rp '.number_format($withdrawal->amount, 0, ',', '.').' untuk "'.$fundraiser->display_name.'" berhasil disetujui.');
    }

    public function rejectWithdrawal(WithdrawalRequest $withdrawal): RedirectResponse
    {
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Permintaan pencairan ini sudah diproses sebelumnya.');
        }

        /** @var User $admin */
        $admin = auth()->user();

        $withdrawal->update([
            'status'   => 'rejected',
            'admin_id' => $admin->id,
        ]);

        return back()->with('success', 'Permintaan pencairan dana ditolak.');
    }

    public function campaigns(): View
    {
        $campaigns = Campaign::with('fundraiser')
            ->withCount(['transactions' => fn ($q) => $q->where('status', 'success')])
            ->latest('created_at')
            ->get();

        return view('admin.campaigns', compact('campaigns'));
    }
}
