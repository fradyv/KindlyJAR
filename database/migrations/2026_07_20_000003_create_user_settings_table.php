<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->boolean('enable_2fa')->default(false);
            $table->text('notification_preferences')->nullable()->comment('Konfigurasi notifikasi dalam format JSON');
            $table->text('privacy_permissions')->nullable()->comment('Pengaturan privasi penggunaan data');
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
