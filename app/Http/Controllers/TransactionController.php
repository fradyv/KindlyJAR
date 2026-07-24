<?php

namespace App\Http\Controllers;

use App\Models\TransactionItem;

class TransactionController extends Controller
{
    public function index()
    {
        $user = $this->authUser();

        $purchaseRows = TransactionItem::query()
            ->whereHas('transaction', fn ($q) => $q->where('buyer_id', $user->id))
            ->with(['transaction', 'product'])
            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->orderByDesc('transactions.created_at')
            ->orderByDesc('transaction_items.id')
            ->select('transaction_items.*')
            ->paginate(10)
            ->withQueryString();

        $assetCount = TransactionItem::query()
            ->whereHas('transaction', fn ($q) => $q->where('buyer_id', $user->id)->where('status', 'success'))
            ->count();

        return view('user-info.riwayat', compact('purchaseRows', 'assetCount'));
    }
}
