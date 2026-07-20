<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\DigitalProduct;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class DigitalProductSeeder extends Seeder
{
    public function run(): void
    {
        $shop = Shop::where('name', 'Toko Herlambang')->firstOrFail();
        $campaigns = Campaign::all()->keyBy('title');

        $products = [
            [
                'campaign'        => 'Renovasi Ruang Kelas SD Pedalaman Mentawai',
                'title'           => 'Poster Retro "Do What Excites" - DWE Playbook Vol. 2',
                'price'           => 25000,
                'category'        => 'Desain Poster',
                'product_preview' => 'assets/kata1.jpg',
                'file_url'        => 'assets/kata1.jpg',
                'stock'           => 50,
            ],
            [
                'campaign'        => 'Perpustakaan Mini untuk Anak Pedalaman Kalimantan',
                'title'           => 'Ilustrasi Potret "Lily & Senja"',
                'price'           => 35000,
                'category'        => 'Ilustrasi Digital',
                'product_preview' => 'assets/kata16.jpg',
                'file_url'        => 'assets/kata16.jpg',
                'stock'           => 40,
            ],
            [
                'campaign'        => 'Bantu Korban Banjir Bandang di Kabupaten Demak',
                'title'           => 'Poster Retro "YUJI Staff Pengmas"',
                'price'           => 22000,
                'category'        => 'Desain Poster',
                'product_preview' => 'assets/kata2.jpg',
                'file_url'        => 'assets/kata2.jpg',
                'stock'           => 60,
            ],
            [
                'campaign'        => 'Perbaikan Akses Jalan Desa Terisolir Flores Timur',
                'title'           => 'Poster Infografis "Hardest Records to Break"',
                'price'           => 20000,
                'category'        => 'Desain Poster',
                'product_preview' => 'assets/kata3.jpg',
                'file_url'        => 'assets/kata3.jpg',
                'stock'           => 35,
            ],
            [
                'campaign'        => 'Instalasi Air Bersih untuk Pesisir Rote Ndao',
                'title'           => 'Desain Web "Crumb Theory" Bakery Landing Page',
                'price'           => 150000,
                'category'        => 'Desain Web',
                'product_preview' => 'assets/kata4.jpg',
                'file_url'        => 'assets/kata4.jpg',
                'stock'           => 20,
            ],
            [
                'campaign'        => 'Penanaman Mangrove Pesisir Pantai Selatan',
                'title'           => 'Brand Identity Kit "LUNE" Ice Cream, Tea & Coffee',
                'price'           => 175000,
                'category'        => 'Desain Logo',
                'product_preview' => 'assets/kata5.jpg',
                'file_url'        => 'assets/kata5.jpg',
                'stock'           => 15,
            ],
            [
                'campaign'        => 'Sumur Bor untuk Dusun Kering Waingapu',
                'title'           => 'Diorama 3D Isometric "Halte Malam"',
                'price'           => 55000,
                'category'        => 'Aset 3D',
                'product_preview' => 'assets/kata6.jpg',
                'file_url'        => 'assets/kata6.jpg',
                'stock'           => 30,
            ],
            [
                'campaign'        => 'Alat Bantu Dengar untuk Anak Difabel Nias',
                'title'           => 'Diorama 3D Isometric "Ruang Baca Cozy"',
                'price'           => 80000,
                'category'        => 'Aset 3D',
                'product_preview' => 'assets/kata15.jpg',
                'file_url'        => 'assets/kata15.jpg',
                'stock'           => 25,
            ],
            [
                'campaign'        => 'Renovasi Ruang Kelas SD Pedalaman Mentawai',
                'title'           => 'Logo Maskot "Moji Matcha"',
                'price'           => 45000,
                'category'        => 'Desain Logo',
                'product_preview' => 'assets/kata8.jpg',
                'file_url'        => 'assets/kata8.jpg',
                'stock'           => 45,
            ],
            [
                'campaign'        => 'Perpustakaan Mini untuk Anak Pedalaman Kalimantan',
                'title'           => 'Foto Stok "Aksi Skateboard"',
                'price'           => 15000,
                'category'        => 'Stok Foto',
                'product_preview' => 'assets/kata12.jpg',
                'file_url'        => 'assets/kata12.jpg',
                'stock'           => 100,
            ],
        ];

        foreach ($products as $data) {
            $campaign = $campaigns->get($data['campaign']);

            if (! $campaign) {
                continue;
            }

            DigitalProduct::create([
                'shop_id'         => $shop->id,
                'campaign_id'     => $campaign->id,
                'title'           => $data['title'],
                'description'     => 'Produk digital premium dari Hero KindlyJAR.',
                'price'           => $data['price'],
                'stock'           => $data['stock'],
                'category'        => $data['category'],
                'product_preview' => $data['product_preview'],
                'file_url'        => $data['file_url'],
            ]);
        }
    }
}
