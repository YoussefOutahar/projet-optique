<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('produit_id');
        $table->integer('stock_min');
        $table->integer('stock_max');
        $table->integer('stock_reel');
        $table->decimal('prix_vente', 10, 2);
        $table->timestamps();
        
        $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
    });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
