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
        $indexExists = DB::select(
            "SELECT name FROM sqlite_master WHERE type='index' AND name='fournisseurs_ice_unique'"
        );

        if (empty($indexExists)) {
            Schema::table('fournisseurs', function (Blueprint $table) {
                $table->unique('ice', 'fournisseurs_ice_unique');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            $table->dropUnique('fournisseurs_ice_unique');
        });
    }
};
