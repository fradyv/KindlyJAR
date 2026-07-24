<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fundraiser_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->enum('account_type', ['individu', 'yayasan', 'komunitas', 'organisasi_mahasiswa'])->nullable();
            $table->string('ktp_number')->nullable();
            $table->string('ktp_photo')->nullable()->comment('URL/Path file KTP');
            $table->string('selfie_ktp_photo')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('bank_name')->nullable();
            $table->bigInteger('bank_account_number')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('passbook_photo')->nullable();
            $table->string('statement_letter')->nullable();
            $table->string('supporting_docs')->nullable()->comment('Opsional');
            $table->enum('status', ['draft', 'pending', 'verified', 'rejected'])->default('draft');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fundraiser_verifications');
    }
};
