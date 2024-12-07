<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptionsTable extends Migration
{
    public function up()
    {
        Schema::create('receptions', function (Blueprint $table) {
            $table->id();
            $table->string('numero_reception');
            $table->string('categorie');
            $table->integer('quantite');
            $table->date('date_reception');
            $table->unsignedBigInteger('fournisseur_id');
            $table->string('reference'); 
            $table->string('responsable'); 
            $table->timestamps();
            
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('receptions');
    }
}
