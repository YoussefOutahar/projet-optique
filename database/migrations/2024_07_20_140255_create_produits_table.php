<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('marque');
            $table->unsignedBigInteger('categorie_id')->constrained('categories');
            $table->unsignedBigInteger('fournisseur_id');
            $table->integer('quantite_stock');
            $table->decimal('prix_achat', 10, 2);
            $table->decimal('prix_vente', 10, 2);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            
            $table->foreign('categorie_id')->references('id')->on('categories');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
