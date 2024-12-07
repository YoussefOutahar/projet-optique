<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('factures', 'vente_id')) {
            Schema::table('factures', function (Blueprint $table) {
                $table->unsignedBigInteger('vente_id')->nullable()->after('client_id');
            });

            DB::table('factures')->update(['vente_id' => 1]); 

            Schema::table('factures', function (Blueprint $table) {
                $table->unsignedBigInteger('vente_id')->nullable(false)->change();
                $table->foreign('vente_id')->references('id')->on('ventes')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factures', function (Blueprint $table) {
            $table->dropForeign(['vente_id']);
            $table->dropColumn('vente_id');
        });
    }
};
