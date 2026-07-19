<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('digital_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->foreignId('campaign_id')->constrained()
                  ->comment('Relasi wajib ke program donasi yang aktif (one-to-one dari sisi produk)');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->integer('stock')->default(0);
            $table->string('product_preview')->nullable()->comment('URL preview karya');
            $table->string('category')->nullable();
            $table->string('file_url')->nullable()->comment('Link akses download produk digital asli');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('digital_products');
    }
};
