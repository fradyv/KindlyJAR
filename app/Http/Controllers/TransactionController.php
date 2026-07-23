<?php

namespace App\Http\Controllers;

use App\Models\User;

class TransactionController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

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
