<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        $fundraiser = User::where('email', 'hugo@gmail.com')->firstOrFail();

        $campaigns = [
            [
                'title'            => 'Bantu Korban Banjir Bandang di Kabupaten Demak',
                'description'      => 'Curah hujan tinggi menyebabkan tanggul jebol dan merendam ribuan rumah di Demak. Ratusan warga mengungsi dan membutuhkan makanan, pakaian, selimut, dan obat-obatan.',
                'category'         => 'Lainnya',
                'target_amount'    => 20000000,
                'collected_amount' => 13280000,
                'created_at'       => Carbon::now()->subDays(45),
            ],
            [
                'title'            => 'Perbaikan Akses Jalan Desa Terisolir Flores Timur',
                'description'      => 'Perbaiki jalan desa terisolir agar warga Flores Timur bisa mengakses sekolah, pasar, dan fasilitas kesehatan dengan aman.',
                'category'         => 'Infrastruktur & Akses',
                'target_amount'    => 12000000,
                'collected_amount' => 9750000,
                'created_at'       => Carbon::now()->subDays(30),
            ],
            [
                'title'            => 'Instalasi Air Bersih untuk Pesisir Rote Ndao',
                'description'      => 'Bangun instalasi air bersih di pesisir Rote Ndao agar keluarga nelayan tidak lagi bergantung pada air keruh saat musim kemarau.',
                'category'         => 'Lingkungan',
                'target_amount'    => 7000000,
                'collected_amount' => 5600000,
                'created_at'       => Carbon::now()->subDays(25),
            ],
            [
                'title'            => 'Alat Bantu Dengar untuk Anak Difabel Nias',
                'description'      => 'Sediakan alat bantu dengar bagi anak-anak difabel di Nias Selatan agar mereka bisa belajar dan berinteraksi dengan lebih baik.',
                'category'         => 'Inklusi & Kesetaraan',
                'target_amount'    => 2500000,
                'collected_amount' => 1800000,
                'created_at'       => Carbon::now()->subDays(20),
            ],
            [
                'title'            => 'Renovasi Ruang Kelas SD Pedalaman Mentawai',
                'description'      => 'Renovasi ruang kelas sekolah dasar di pedalaman Mentawai agar anak-anak bisa belajar di ruang yang layak dan aman.',
                'category'         => 'Pendidikan',
                'target_amount'    => 10000000,
                'collected_amount' => 8100000,
                'created_at'       => Carbon::now()->subDays(15),
            ],
            [
                'title'            => 'Sumur Bor untuk Dusun Kering Waingapu',
                'description'      => 'Bangun sumur bor agar warga Dusun Waingapu tidak lagi jalan berkilo-kilo demi air bersih setiap hari.',
                'category'         => 'Infrastruktur & Akses',
                'target_amount'    => 8000000,
                'collected_amount' => 450000,
                'created_at'       => Carbon::now()->subDays(5),
            ],
            [
                'title'            => 'Perpustakaan Mini untuk Anak Pedalaman Kalimantan',
                'description'      => 'Hadirkan buku bacaan dan rak sederhana agar anak-anak pedalaman Kalimantan gemar membaca dan belajar mandiri.',
                'category'         => 'Pendidikan',
                'target_amount'    => 5000000,
                'collected_amount' => 120000,
                'created_at'       => Carbon::now()->subDays(3),
            ],
            [
                'title'            => 'Penanaman Mangrove Pesisir Pantai Selatan',
                'description'      => 'Tanam ribuan bibit mangrove untuk melindungi pesisir dari abrasi dan menciptakan habitat bagi biota laut setempat.',
                'category'         => 'Lingkungan',
                'target_amount'    => 6000000,
                'collected_amount' => 2100000,
                'created_at'       => Carbon::now()->subDays(1),
            ],
        ];

        foreach ($campaigns as $data) {
            $createdAt = $data['created_at'];
            unset($data['created_at']);

            $campaign = Campaign::create([
                'fundraiser_id' => $fundraiser->id,
                'status'        => 'active',
                ...$data,
            ]);

            $campaign->created_at = $createdAt;
            $campaign->save();
        }
    }
}
