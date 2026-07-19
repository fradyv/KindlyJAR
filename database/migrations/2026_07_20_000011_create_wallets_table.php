<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete()
                  ->comment('Hanya diaktifkan secara sistem untuk akun role fundraiser');
            $table->decimal('balance', 15, 2)->default(0);
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->text('bank_or_ewallet_info')
                  ->comment('Informasi rekening/e-wallet tujuan penarikan');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete()
                  ->comment('Admin yang melakukan verifikasi manual / Approve');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdrawal_requests');
        Schema::dropIfExists('wallets');
    }
};
