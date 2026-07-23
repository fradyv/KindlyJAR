<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();

        $trendingCampaigns = Campaign::where('status', 'active')
            ->with('products')
            ->withCount('transactions')
            ->orderByDesc('collected_amount')
            ->take(4)
            ->get();

        $totalDonasi = $user->transactions()->where('status', 'success')->sum('total_paid');

        $shop = $user->shop;
        $karyaTerjual = 0;
        if ($shop) {
            $productIds = $shop->products()->pluck('id');
            $karyaTerjual = TransactionItem::whereIn('product_id', $productIds)->sum('quantity');
        }

        $inisiasiProgram = $user->campaigns()->count();
        $pencairanDana = $user->campaigns()->sum('withdrawn_amount');

        $riwayatAktivitas = $user->transactions()
            ->with('campaign')
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('dashboard-user.dashboard-beranda', compact(
            'trendingCampaigns',
            'totalDonasi',
            'karyaTerjual',
            'inisiasiProgram',
            'pencairanDana',
            'riwayatAktivitas'
        ));
    }
}
