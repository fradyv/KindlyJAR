<?php

$user = App\Models\User::find(1);
$wallet = $user->wallet ?? App\Models\Wallet::create(['user_id' => $user->id]);

$totalAvailable = $user->campaigns()->get()->sum(fn ($c) => $c->available_balance);
echo 'Total available: '.$totalAvailable.PHP_EOL;

$pendingAmount = (float) $wallet->withdrawalRequests()->where('status', 'pending')->sum('amount');
$withdrawable = max(0, $totalAvailable - $pendingAmount);
echo 'Withdrawable: '.$withdrawable.PHP_EOL;

// Simulate store() logic: request withdrawal of 500000
$amount = 500000;
if ($amount > $withdrawable) {
    echo 'BLOCKED: exceeds withdrawable'.PHP_EOL;
} else {
    $req = $wallet->withdrawalRequests()->create([
        'amount' => $amount,
        'bank_or_ewallet_info' => 'BCA 1234567890 a.n. Test User',
        'status' => 'pending',
    ]);
    echo 'Created withdrawal request id='.$req->id.' status='.$req->status.PHP_EOL;
}

// Try requesting more than available -> should be blocked
$hugeAmount = $totalAvailable + 1000000;
$pendingAmount2 = (float) $wallet->withdrawalRequests()->where('status', 'pending')->sum('amount');
$withdrawable2 = max(0, $totalAvailable - $pendingAmount2);
if ($hugeAmount > $withdrawable2) {
    echo 'CORRECTLY BLOCKED oversized request ('.$hugeAmount.' > '.$withdrawable2.')'.PHP_EOL;
} else {
    echo 'ERROR: oversized request was NOT blocked!'.PHP_EOL;
}

echo 'Wallet withdrawal requests count: '.$wallet->withdrawalRequests()->count().PHP_EOL;
