<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('numero_facture');
            $table->date('date_facture');
            $table->unsignedBigInteger('client_id');
            $table->enum('status', ['Avance', 'Réglé', 'Non Réglé']);
            $table->decimal('total', 10, 2);
            $table->decimal('remise', 10, 2)->nullable();
            $table->decimal('avance', 10, 2)->nullable();
            $table->decimal('reste_a_payer', 10, 2)->nullable();
            $table->string('responsable'); 
            $table->timestamps();
            
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
