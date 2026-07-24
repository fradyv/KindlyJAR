<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->foreignId('campaign_id')
                ->nullable()
                ->after('product_id')
                ->constrained()
                ->comment('Snapshot program donasi saat checkout');
        });

        foreach (DB::table('transaction_items')->select('id', 'product_id')->get() as $row) {
            $campaignId = DB::table('digital_products')
                ->where('id', $row->product_id)
                ->value('campaign_id');

            if ($campaignId) {
                DB::table('transaction_items')
                    ->where('id', $row->id)
                    ->update(['campaign_id' => $campaignId]);
            }
        }

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['campaign_id']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('campaign_id')->nullable()->change();
            $table->foreign('campaign_id')->references('id')->on('campaigns');
        });
    }

    public function down(): void
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->dropForeign(['campaign_id']);
            $table->dropColumn('campaign_id');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['campaign_id']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('campaign_id')->nullable(false)->change();
            $table->foreign('campaign_id')->references('id')->on('campaigns');
        });
    }
};
