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
 Schema::create('vente_produit', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('vente_id');
    $table->unsignedBigInteger('produit_id');
    $table->unsignedBigInteger('quantite');
    
    
    $table->unsignedBigInteger('categorie_id')->nullable();

    $table->foreign('vente_id')->references('id')->on('ventes')->onDelete('cascade');
    $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
    $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('set null'); 

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vente_produit');
    }
};
