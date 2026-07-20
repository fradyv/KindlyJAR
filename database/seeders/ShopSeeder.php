<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $shops = [
            [
                'email'       => 'herlambang@gmail.com',
                'name'        => 'Toko Herlambang',
                'description' => 'Karya digital premium (poster, ilustrasi, logo & web design) untuk mendukung pemerataan Nusantara.',
            ],
            [
                'email'       => 'kevin@gmail.com',
                'name'        => 'Kevin Photo Stock',
                'description' => 'Koleksi foto stok berkualitas tinggi untuk kebutuhan konten dan desainmu, sekaligus berdonasi.',
            ],
            [
                'email'       => 'raka@gmail.com',
                'name'        => 'Raka 3D Studio',
                'description' => 'Aset 3D premium siap pakai untuk game, render, dan desain produk — setiap pembelian ikut menyalurkan donasi.',
            ],
        ];

        foreach ($shops as $data) {
            $user = User::where('email', $data['email'])->firstOrFail();

            Shop::create([
                'user_id'     => $user->id,
                'name'        => $data['name'],
                'description' => $data['description'],
            ]);
        }
    }
}
