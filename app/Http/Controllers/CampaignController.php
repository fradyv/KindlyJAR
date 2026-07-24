<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $allCampaigns = Campaign::where('status', 'active')
            ->with(['fundraiser', 'products'])
            ->withCount('transactions')
            ->get();

        $trendingCampaigns = $allCampaigns->sortByDesc('collected_amount')->take(4)->values();
        $newCampaigns = $allCampaigns->sortByDesc('created_at')->take(4)->values();
        $campaigns = $allCampaigns;

        return view('fundraiser.program-donasi', compact('trendingCampaigns', 'newCampaigns', 'campaigns'));
    }

    public function show(Campaign $campaign)
    {
        $campaign->load(['fundraiser', 'products']);
        $campaign->loadCount('transactions');

        $donaturTerbaru = $campaign->transactions()
            ->with('buyer')
            ->latest()
            ->take(5)
            ->get();

        $programSerupa = Campaign::where('status', 'active')
            ->where('id', '!=', $campaign->id)
            ->with('products')
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('dashboard-user.detail-program', compact('campaign', 'donaturTerbaru', 'programSerupa'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $this->authUser();

        if ($user->kyc_status !== 'verified') {
            return redirect()->route('inisiasi')
                ->with('error', 'Akunmu harus terverifikasi sebelum bisa membuat program donasi.');
        }

        $validated = $request->validate([
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['required', 'string'],
            'category'      => ['required', 'string', 'max:100'],
            'target_amount' => ['required', 'numeric', 'min:100000'],
            'end_date'      => ['required', 'date', 'after:today'],
        ]);

        Campaign::create([
            'fundraiser_id'  => $user->id,
            'title'          => $validated['title'],
            'description'    => $validated['description'],
            'category'       => $validated['category'],
            'target_amount'  => $validated['target_amount'],
            'end_date'       => $validated['end_date'],
            'created_at'     => now(),
        ]);

        return redirect()->route('inisiasi')
            ->with('success', 'Program donasi "'.$validated['title'].'" berhasil diajukan dan sudah tayang di halaman Program Donasi!');
    }
}
