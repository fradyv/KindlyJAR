<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users')
                  ->comment('Savior (Pembeli/Pendonasi)');
            $table->foreignId('campaign_id')->constrained()
                  ->comment('Target alokasi dana donasi');
            $table->decimal('total_product_price', 15, 2)->default(0)
                  ->comment('0 jika ini merupakan donasi langsung murni');
            $table->decimal('extra_donation', 15, 2)->default(0)
                  ->comment('Kelebihan nominal bayar / nominal donasi murni');
            $table->decimal('total_paid', 15, 2)
                  ->comment('Wajib bernilai >= total_product_price');
            $table->string('bank_name')->nullable();
            $table->timestamp('payment_time')->nullable();
            $table->boolean('is_anonymous')->default(false)
                  ->comment('Snapshot status anonim saat transaksi terjadi');
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('digital_products');
            $table->decimal('price_at_purchase', 15, 2)
                  ->comment('Snapshot harga saat dibeli demi validitas riwayat keuangan');
            $table->integer('quantity');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_items');
        Schema::dropIfExists('transactions');
    }
};
