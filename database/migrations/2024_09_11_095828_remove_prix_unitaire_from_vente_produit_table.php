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
        Schema::table('vente_produit', function (Blueprint $table) {
            $table->dropColumn('prix_unitaire');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vente_produit', function (Blueprint $table) {
            $table->decimal('prix_unitaire', 8, 2)->nullable();
        });
    }
};