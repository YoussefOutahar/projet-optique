<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaisseTable extends Migration
{
    public function up()
    {
        Schema::create('caisse', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facture_id');
            $table->date('date_facture');
            $table->enum('status', ['Avance', 'Réglé', 'Non Réglé']);
            $table->unsignedBigInteger('client_id');
            $table->decimal('paiement', 10, 2);
            $table->timestamps();
            
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('facture_id')->references('id')->on('factures')->onDelete('cascade'); 

        });
    }

    public function down()
    {
        Schema::dropIfExists('caisse');
    }
}
