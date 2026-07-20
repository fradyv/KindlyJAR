<?php

namespace Database\Seeders;

use App\Models\FundraiserVerification;
use App\Models\User;
use Illuminate\Database\Seeder;

class FundraiserVerificationSeeder extends Seeder
{
    public function run(): void
    {
        $fajar = User::where('email', 'fajar@gmail.com')->firstOrFail();

        FundraiserVerification::create([
            'user_id'             => $fajar->id,
            'account_type'        => 'individu',
            'ktp_number'          => '3204101203990001',
            'ktp_photo'           => 'assets/savior5.jpg',
            'selfie_ktp_photo'    => 'assets/savior5.jpg',
            'profile_photo'       => 'assets/savior5.jpg',
            'bank_name'           => 'BCA',
            'bank_account_number' => '5551234567',
            'bank_account_name'   => 'Fajar Nugroho',
            'passbook_photo'      => 'assets/savior5.jpg',
            'statement_letter'    => 'assets/savior5.jpg',
            'supporting_docs'     => 'assets/savior5.jpg',
            'status'              => 'pending',
        ]);
    }
}
