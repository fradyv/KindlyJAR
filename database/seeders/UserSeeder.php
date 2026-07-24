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

        // ── Fundraiser: pembuat program donasi ──
        $fundraiser = User::create([
            'legal_name'    => 'Hugo Verniac',
            'display_name'  => 'Hugo',
            'email'         => 'hugo@gmail.com',
            'hash_password' => Hash::make('password'),
            'kyc_status'    => 'verified',
            'bio'           => 'Relawan kemanusiaan yang fokus menggalang dana untuk daerah 3T di Indonesia.',
        ]);
        $fundraiser->roles()->attach([$fundraiserRole->id, $normalUserRole->id]);

        // ── Hero: penjual produk digital di KindlyShop (KYC terverifikasi, punya toko) ──
        $heroes = [
            [
                'legal_name'   => 'Herlambang Suryana',
                'display_name' => 'Herlambang',
                'email'        => 'herlambang@gmail.com',
                'bio'          => 'Desainer grafis lepas, senang bikin poster & ilustrasi untuk mendukung program donasi.',
            ],
            [
                'legal_name'   => 'Kevin Adinata',
                'display_name' => 'Kevin',
                'email'        => 'kevin@gmail.com',
                'bio'          => 'Fotografer stok foto, hasil penjualannya disalurkan langsung ke program donasi pilihan.',
            ],
            [
                'legal_name'   => 'Raka Wibisono',
                'display_name' => 'Raka',
                'email'        => 'raka@gmail.com',
                'bio'          => 'Modeler 3D, bikin aset digital premium untuk mendukung kampanye kemanusiaan.',
            ],
        ];

        foreach ($heroes as $data) {
            $hero = User::create([
                'legal_name'    => $data['legal_name'],
                'display_name'  => $data['display_name'],
                'email'         => $data['email'],
                'hash_password' => Hash::make('password'),
                'kyc_status'    => 'verified',
                'bio'           => $data['bio'],
            ]);
            $hero->roles()->attach([$normalUserRole->id, $fundraiserRole->id]);
        }

        // ── Savior: pembeli/donatur biasa ──
        $saviors = [
            [
                'legal_name'   => 'Joseph Jeremy',
                'display_name' => 'Joseph',
                'email'        => 'joseph@gmail.com',
                'kyc_status'   => 'unverified',
            ],
            [
                'legal_name'   => 'Dinda Kartika',
                'display_name' => 'Dinda',
                'email'        => 'dinda@gmail.com',
                'kyc_status'   => 'unverified',
            ],
            [
                'legal_name'   => 'Rangga Saputra',
                'display_name' => 'Rangga',
                'email'        => 'rangga@gmail.com',
                'kyc_status'   => 'unverified',
            ],
            [
                'legal_name'   => 'Melati Putri',
                'display_name' => 'Melati',
                'email'        => 'melati@gmail.com',
                'kyc_status'   => 'unverified',
            ],
            [
                // Sudah mengajukan verifikasi fundraiser, masih menunggu review admin.
                'legal_name'   => 'Fajar Nugroho',
                'display_name' => 'Fajar',
                'email'        => 'fajar@gmail.com',
                'kyc_status'   => 'pending',
                'phone_number' => '081234567890',
                'address'      => 'Jl. Kenanga No. 12, Bandung, Jawa Barat',
            ],
        ];

        foreach ($saviors as $data) {
            $savior = User::create([
                'legal_name'    => $data['legal_name'],
                'display_name'  => $data['display_name'],
                'email'         => $data['email'],
                'hash_password' => Hash::make('password'),
                'kyc_status'    => $data['kyc_status'],
                'phone_number'  => $data['phone_number'] ?? null,
                'address'       => $data['address'] ?? null,
            ]);
            $savior->roles()->attach($normalUserRole);
        }
    }
}
