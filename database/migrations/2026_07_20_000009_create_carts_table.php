<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete()
                  ->comment('1 user hanya memiliki 1 keranjang aktif');
            $table->foreignId('campaign_id')->nullable()->constrained()->nullOnDelete()
                  ->comment('Mengunci keranjang agar hanya produk dari campaign yang sama yang bisa masuk');
            $table->timestamps();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('digital_products')->cascadeOnDelete();
            $table->integer('quantity')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
    }
};
