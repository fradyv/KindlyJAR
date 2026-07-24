<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE fundraiser_verifications MODIFY account_type ENUM('individu', 'yayasan', 'komunitas', 'organisasi_mahasiswa') NULL");
            DB::statement("ALTER TABLE fundraiser_verifications MODIFY status ENUM('draft', 'pending', 'verified', 'rejected') NOT NULL DEFAULT 'draft'");
        }
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("UPDATE fundraiser_verifications SET status = 'pending' WHERE status = 'draft'");
            DB::statement("ALTER TABLE fundraiser_verifications MODIFY account_type ENUM('individu', 'yayasan', 'komunitas', 'organisasi_mahasiswa') NOT NULL");
            DB::statement("ALTER TABLE fundraiser_verifications MODIFY status ENUM('pending', 'verified', 'rejected') NOT NULL DEFAULT 'pending'");
        }
    }
};
