<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\DigitalProduct;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $products = DigitalProduct::all()->keyBy('title');
        $campaigns = Campaign::all()->keyBy('title');

        $purchases = [
            [
                'buyer'         => 'joseph@gmail.com',
                'product'       => 'Poster Retro "Do What Excites" - DWE Playbook Vol. 2',
                'extra'         => 5000,
                'status'        => 'success',
                'days_ago'      => 10,
            ],
            [
                'buyer'         => 'joseph@gmail.com',
                'product'       => 'Diorama 3D Isometric "Ruang Baca Cozy"',
                'extra'         => 20000,
                'status'        => 'success',
                'days_ago'      => 5,
            ],
            [
                'buyer'         => 'joseph@gmail.com',
                'product'       => 'Desain Web "Crumb Theory" Bakery Landing Page',
                'extra'         => 0,
                'status'        => 'pending',
                'days_ago'      => 0,
            ],
            [
                'buyer'         => 'dinda@gmail.com',
                'product'       => 'Foto Stok "Aksi Skateboard Ekstrem"',
                'extra'         => 3000,
                'status'        => 'success',
                'days_ago'      => 8,
            ],
            [
                'buyer'         => 'rangga@gmail.com',
                'product'       => 'Aset 3D "Kamera Vintage Wireframe"',
                'extra'         => 0,
                'status'        => 'success',
                'days_ago'      => 6,
            ],
            [
                'buyer'         => 'rangga@gmail.com',
                'product'       => 'Logo Maskot "Moji Matcha"',
                'extra'         => 10000,
                'status'        => 'success',
                'days_ago'      => 3,
            ],
            [
                'buyer'         => 'melati@gmail.com',
                'product'       => 'Aset 3D "Anggrek Bulan Realistis"',
                'extra'         => 0,
                'status'        => 'success',
                'days_ago'      => 4,
            ],
            [
                'buyer'         => 'fajar@gmail.com',
                'product'       => 'Foto Stok "Ngobrol Santai di Kafe"',
                'extra'         => 0,
                'status'        => 'failed',
                'days_ago'      => 2,
            ],
            [
                'buyer'         => 'fajar@gmail.com',
                'product'       => 'Ilustrasi Potret "Lily & Senja"',
                'extra'         => 5000,
                'status'        => 'success',
                'days_ago'      => 1,
            ],
        ];

        foreach ($purchases as $data) {
            $buyer = User::where('email', $data['buyer'])->first();
            $product = $products->get($data['product']);

            if (! $buyer || ! $product) {
                continue;
            }

            $totalProduct = (float) $product->price;
            $extraDonation = (float) $data['extra'];
            $paymentTime = $data['status'] === 'success' ? Carbon::now()->subDays($data['days_ago']) : null;

            $transaction = Transaction::create([
                'buyer_id'            => $buyer->id,
                'campaign_id'         => $product->campaign_id,
                'total_product_price' => $totalProduct,
                'extra_donation'      => $extraDonation,
                'total_paid'          => $totalProduct + $extraDonation,
                'bank_name'           => 'BCA',
                'payment_time'        => $paymentTime,
                'status'              => $data['status'],
            ]);

            $transaction->created_at = Carbon::now()->subDays($data['days_ago']);
            $transaction->save();

            TransactionItem::create([
                'transaction_id'    => $transaction->id,
                'product_id'        => $product->id,
                'price_at_purchase' => $totalProduct,
                'quantity'          => 1,
            ]);

            if ($data['status'] === 'success' && $product->stock > 0) {
                $product->decrement('stock');
            }
        }

        // ── Donasi langsung ke program (tanpa beli produk) ──
        $donations = [
            [
                'buyer'        => 'dinda@gmail.com',
                'campaign'     => 'Alat Bantu Dengar untuk Anak Difabel Nias',
                'nominal'      => 50000,
                'is_anonymous' => true,
                'days_ago'     => 7,
            ],
            [
                'buyer'        => 'melati@gmail.com',
                'campaign'     => 'Perpustakaan Mini untuk Anak Pedalaman Kalimantan',
                'nominal'      => 30000,
                'is_anonymous' => false,
                'days_ago'     => 2,
            ],
            [
                'buyer'        => 'joseph@gmail.com',
                'campaign'     => 'Perbaikan Akses Jalan Desa Terisolir Flores Timur',
                'nominal'      => 100000,
                'is_anonymous' => false,
                'days_ago'     => 12,
            ],
        ];

        foreach ($donations as $data) {
            $buyer = User::where('email', $data['buyer'])->first();
            $campaign = $campaigns->get($data['campaign']);

            if (! $buyer || ! $campaign) {
                continue;
            }

            $transaction = Transaction::create([
                'buyer_id'            => $buyer->id,
                'campaign_id'         => $campaign->id,
                'total_product_price' => 0,
                'extra_donation'      => $data['nominal'],
                'total_paid'          => $data['nominal'],
                'bank_name'           => 'Transfer Bank',
                'payment_time'        => Carbon::now()->subDays($data['days_ago']),
                'is_anonymous'        => $data['is_anonymous'],
                'status'              => 'success',
            ]);

            $transaction->created_at = Carbon::now()->subDays($data['days_ago']);
            $transaction->save();
        }
    }
}
