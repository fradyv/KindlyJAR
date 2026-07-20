<?php

namespace App\Http\Controllers;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()
            ->transactions()
            ->with(['campaign', 'items.product'])
            ->latest()
            ->get();

        return view('user-info.riwayat', compact('transactions'));
    }
}
