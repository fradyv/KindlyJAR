<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->firstOrFail();
        $fundraiserRole = Role::where('name', 'fundraiser')->firstOrFail();
        $normalUserRole = Role::where('name', 'normal_user')->firstOrFail();

        $admin = User::create([
            'legal_name'    => 'Admin KindlyJAR',
            'display_name'  => 'Admin',
            'email'         => 'admin@kindlyjar.com',
            'hash_password' => Hash::make('password'),
            'kyc_status'    => 'verified',
        ]);
        $admin->roles()->attach($adminRole);

        $fundraiser = User::create([
            'legal_name'    => 'Hugo Verniac',
            'display_name'  => 'Hugo',
            'email'         => 'hugo@gmail.com',
            'hash_password' => Hash::make('password'),
            'kyc_status'    => 'verified',
        ]);
        $fundraiser->roles()->attach($fundraiserRole);

        $hero = User::create([
            'legal_name'    => 'Herlambang Suryana',
            'display_name'  => 'Herlambang',
            'email'         => 'herlambang@gmail.com',
            'hash_password' => Hash::make('password'),
            'kyc_status'    => 'verified',
        ]);
        $hero->roles()->attach($normalUserRole);

        $savior = User::create([
            'legal_name'    => 'Joseph Jeremy',
            'display_name'  => 'Joseph',
            'email'         => 'joseph@gmail.com',
            'hash_password' => Hash::make('password'),
        ]);
        $savior->roles()->attach($normalUserRole);
    }
}
