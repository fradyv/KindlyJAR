<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            FundraiserVerificationSeeder::class,
            ShopSeeder::class,
            CampaignSeeder::class,
            DigitalProductSeeder::class,
            TransactionSeeder::class,
            WithdrawalRequestSeeder::class,
        ]);
    }
}
