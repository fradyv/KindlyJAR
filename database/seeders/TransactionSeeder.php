<?php

namespace Database\Seeders;

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
        $savior = User::where('email', 'joseph@gmail.com')->firstOrFail();

        $products = DigitalProduct::whereIn('title', [
            'Poster Retro "Do What Excites" - DWE Playbook Vol. 2',
            'Diorama 3D Isometric "Ruang Baca Cozy"',
            'Desain Web "Crumb Theory" Bakery Landing Page',
        ])->get()->keyBy('title');

        $transactions = [
            [
                'product_title'       => 'Poster Retro "Do What Excites" - DWE Playbook Vol. 2',
                'extra_donation'      => 5000,
                'status'              => 'success',
                'payment_time'        => Carbon::now()->subDays(10),
            ],
            [
                'product_title'       => 'Diorama 3D Isometric "Ruang Baca Cozy"',
                'extra_donation'      => 20000,
                'status'              => 'success',
                'payment_time'        => Carbon::now()->subDays(5),
            ],
            [
                'product_title'       => 'Desain Web "Crumb Theory" Bakery Landing Page',
                'extra_donation'      => 0,
                'status'              => 'pending',
                'payment_time'        => null,
            ],
        ];

        foreach ($transactions as $data) {
            $product = $products->get($data['product_title']);

            if (! $product) {
                continue;
            }

            $totalProduct = (float) $product->price;
            $extraDonation = (float) $data['extra_donation'];

            $transaction = Transaction::create([
                'buyer_id'            => $savior->id,
                'campaign_id'         => $product->campaign_id,
                'total_product_price' => $totalProduct,
                'extra_donation'      => $extraDonation,
                'total_paid'          => $totalProduct + $extraDonation,
                'bank_name'           => 'BCA',
                'payment_time'        => $data['payment_time'],
                'status'              => $data['status'],
            ]);

            $transaction->created_at = $data['payment_time'] ?? Carbon::now();
            $transaction->save();

            TransactionItem::create([
                'transaction_id'    => $transaction->id,
                'product_id'        => $product->id,
                'price_at_purchase' => $totalProduct,
                'quantity'          => 1,
            ]);
        }
    }
}
