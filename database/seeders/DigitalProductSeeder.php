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
        $shopHerlambang = Shop::where('name', 'Toko Herlambang')->firstOrFail();
        $shopKevin = Shop::where('name', 'Kevin Photo Stock')->firstOrFail();
        $shopRaka = Shop::where('name', 'Raka 3D Studio')->firstOrFail();
        $campaigns = Campaign::all()->keyBy('title');

        $this->seedProducts($shopHerlambang, $campaigns, $this->herlambangProducts());
        $this->seedProducts($shopKevin, $campaigns, $this->kevinProducts());
        $this->seedProducts($shopRaka, $campaigns, $this->rakaProducts());
    }

    private function seedProducts(Shop $shop, $campaigns, array $products): void
    {
        foreach ($products as $data) {
            $campaign = $campaigns->get($data['campaign']);

            if (! $campaign) {
                continue;
            }

            DigitalProduct::create([
                'shop_id'         => $shop->id,
                'campaign_id'     => $campaign->id,
                'title'           => $data['title'],
                'description'     => $data['description'] ?? 'Produk digital premium dari Hero KindlyJAR.',
                'price'           => $data['price'],
                'stock'           => $data['stock'],
                'category'        => $data['category'],
                'product_preview' => $data['product_preview'],
                'file_url'        => $data['file_url'],
            ]);
        }
    }

    private function herlambangProducts(): array
    {
        return [
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
    }

    private function kevinProducts(): array
    {
        return [
            [
                'campaign'        => 'Bantu Korban Banjir Bandang di Kabupaten Demak',
                'title'           => 'Foto Stok "Aksi Skateboard Ekstrem"',
                'price'           => 18000,
                'category'        => 'Stok Foto',
                'product_preview' => 'assets/hero2-prod1.jpg',
                'file_url'        => 'assets/hero2-prod1.jpg',
                'stock'           => 90,
            ],
            [
                'campaign'        => 'Perbaikan Akses Jalan Desa Terisolir Flores Timur',
                'title'           => 'Foto Stok "Ngobrol Santai di Kafe"',
                'price'           => 20000,
                'category'        => 'Stok Foto',
                'product_preview' => 'assets/hero2-prod2.jpg',
                'file_url'        => 'assets/hero2-prod2.jpg',
                'stock'           => 80,
            ],
            [
                'campaign'        => 'Instalasi Air Bersih untuk Pesisir Rote Ndao',
                'title'           => 'Foto Stok "Hangout Diner Retro"',
                'price'           => 22000,
                'category'        => 'Stok Foto',
                'product_preview' => 'assets/hero2-prod3.jpg',
                'file_url'        => 'assets/hero2-prod3.jpg',
                'stock'           => 70,
            ],
        ];
    }

    private function rakaProducts(): array
    {
        return [
            [
                'campaign'        => 'Renovasi Ruang Kelas SD Pedalaman Mentawai',
                'title'           => 'Aset 3D "Kamera Vintage Wireframe"',
                'price'           => 95000,
                'category'        => 'Aset 3D',
                'product_preview' => 'assets/hero3-prod1.jpg',
                'file_url'        => 'assets/hero3-prod1.jpg',
                'stock'           => 18,
            ],
            [
                'campaign'        => 'Sumur Bor untuk Dusun Kering Waingapu',
                'title'           => 'Aset 3D "Game Controller Modern"',
                'price'           => 85000,
                'category'        => 'Aset 3D',
                'product_preview' => 'assets/hero3-prod2.jpg',
                'file_url'        => 'assets/hero3-prod2.jpg',
                'stock'           => 22,
            ],
            [
                'campaign'        => 'Penanaman Mangrove Pesisir Pantai Selatan',
                'title'           => 'Aset 3D "Anggrek Bulan Realistis"',
                'price'           => 65000,
                'category'        => 'Aset 3D',
                'product_preview' => 'assets/hero3-prod3.jpg',
                'file_url'        => 'assets/hero3-prod3.jpg',
                'stock'           => 28,
            ],
        ];
    }
}
