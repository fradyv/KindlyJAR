<?php

namespace App\Http\Controllers;

class TransactionController extends Controller
{
    public function index()
    {
        $user = $this->authUser();

        $transactions = $user
            ->transactions()
            ->with(['campaign', 'items.product'])
            ->latest()
            ->get();

        $assetCount = $transactions
            ->where('status', 'success')
            ->flatMap(fn ($transaction) => $transaction->items)
            ->count();

        return view('user-info.riwayat', compact('transactions', 'assetCount'));
    }
}
