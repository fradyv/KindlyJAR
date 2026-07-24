<?php

namespace Database\Seeders;

use App\Models\FundraiserVerification;
use App\Models\User;
use Illuminate\Database\Seeder;

class FundraiserVerificationSeeder extends Seeder
{
    public function run(): void
    {
        $verifiedFundraisers = [
            [
                'email'               => 'hugo@gmail.com',
                'account_type'        => 'individu',
                'ktp_number'          => '3273011208900001',
                'bank_name'           => 'BCA',
                'bank_account_number' => '8800112233',
                'bank_account_name'   => 'Hugo Verniac',
            ],
            [
                'email'               => 'herlambang@gmail.com',
                'account_type'        => 'individu',
                'ktp_number'          => '3204101501880002',
                'bank_name'           => 'Mandiri',
                'bank_account_number' => '1420012345678',
                'bank_account_name'   => 'Herlambang Suryana',
            ],
            [
                'email'               => 'kevin@gmail.com',
                'account_type'        => 'individu',
                'ktp_number'          => '3174012205920003',
                'bank_name'           => 'BNI',
                'bank_account_number' => '9876543210',
                'bank_account_name'   => 'Kevin Adinata',
            ],
            [
                'email'               => 'raka@gmail.com',
                'account_type'        => 'individu',
                'ktp_number'          => '3302210807930004',
                'bank_name'           => 'BCA',
                'bank_account_number' => '5566778899',
                'bank_account_name'   => 'Raka Wibisono',
            ],
        ];

        foreach ($verifiedFundraisers as $data) {
            $user = User::where('email', $data['email'])->firstOrFail();

            FundraiserVerification::create([
                'user_id'             => $user->id,
                'account_type'        => $data['account_type'],
                'ktp_number'          => $data['ktp_number'],
                'ktp_photo'           => 'assets/savior1.jpg',
                'selfie_ktp_photo'    => 'assets/savior2.jpg',
                'profile_photo'       => 'assets/savior3.jpg',
                'bank_name'           => $data['bank_name'],
                'bank_account_number' => $data['bank_account_number'],
                'bank_account_name'   => $data['bank_account_name'],
                'passbook_photo'      => 'assets/savior4.jpg',
                'statement_letter'    => 'assets/surat_pernyataan.pdf',
                'supporting_docs'     => 'assets/savior5.jpg',
                'status'              => 'verified',
            ]);
        }

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
            'statement_letter'    => 'assets/surat_pernyataan.pdf',
            'supporting_docs'     => 'assets/savior5.jpg',
            'status'              => 'pending',
        ]);
    }
}
