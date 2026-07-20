<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $hero = User::where('email', 'herlambang@gmail.com')->firstOrFail();

        Shop::create([
            'user_id'     => $hero->id,
            'name'        => 'Toko Herlambang',
            'description' => 'Karya digital premium untuk mendukung pemerataan Nusantara.',
        ]);
    }
}
