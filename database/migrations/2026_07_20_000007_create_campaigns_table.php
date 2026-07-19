<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fundraiser_id')->constrained('users')
                  ->comment('User ID yang sudah berstatus VERIFIED');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category')->nullable()->comment('Untuk filter di halaman Program Donasi');
            $table->decimal('target_amount', 15, 2);
            $table->decimal('collected_amount', 15, 2)->default(0);
            $table->decimal('withdrawn_amount', 15, 2)->default(0)
                  ->comment('Total dana yang sudah dicairkan oleh fundraiser');
            $table->enum('status', ['active', 'completed', 'closed'])->default('active');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('end_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
