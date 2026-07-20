<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use App\Models\WithdrawalRequest;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WithdrawalRequestSeeder extends Seeder
{
    public function run(): void
    {
        $hugo = User::where('email', 'hugo@gmail.com')->firstOrFail();
        $admin = User::where('email', 'admin@kindlyjar.com')->firstOrFail();

        // Sinkronkan saldo wallet dengan total available_balance semua campaign.
        $totalAvailable = $hugo->campaigns()->get()->sum(fn ($campaign) => $campaign->available_balance);
        $wallet = Wallet::updateOrCreate(
            ['user_id' => $hugo->id],
            ['balance' => $totalAvailable]
        );

        $approved = WithdrawalRequest::create([
            'wallet_id'            => $wallet->id,
            'amount'               => 2000000,
            'bank_or_ewallet_info' => 'BCA 8800112233 a.n. Hugo Verniac',
            'status'               => 'approved',
            'admin_id'             => $admin->id,
        ]);
        $approved->created_at = Carbon::now()->subDays(7);
        $approved->updated_at = Carbon::now()->subDays(6);
        $approved->save();

        $pending = WithdrawalRequest::create([
            'wallet_id'            => $wallet->id,
            'amount'               => 1500000,
            'bank_or_ewallet_info' => 'GoPay 081234567890 a.n. Hugo Verniac',
            'status'               => 'pending',
        ]);
        $pending->created_at = Carbon::now()->subDay();
        $pending->save();
    }
}
