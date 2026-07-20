<?php

namespace App\Http\Controllers;

use App\Models\Campaign;

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
}
