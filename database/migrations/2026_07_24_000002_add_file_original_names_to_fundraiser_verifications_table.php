<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fundraiser_verifications', function (Blueprint $table) {
            $table->json('file_original_names')->nullable()->after('supporting_docs');
        });
    }

    public function down(): void
    {
        Schema::table('fundraiser_verifications', function (Blueprint $table) {
            $table->dropColumn('file_original_names');
        });
    }
};
