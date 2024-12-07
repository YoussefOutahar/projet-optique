<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ventes', function (Blueprint $table) {

        $indexes = DB::select('PRAGMA index_list("ventes")');

        $indexExists = false;
        foreach ($indexes as $index) {
            if ($index->name === 'ventes_numero_vente_unique') {
                $indexExists = true;
                break;
            }
        }

        if (!$indexExists) {
            $table->unique('numero_vente');
        }
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ventes', function (Blueprint $table) {
            $table->unique('numero_facture', 'ventes_numero_facture_unique');

            $table->dropUnique('ventes_numero_vente_unique');
        });
    }
};
