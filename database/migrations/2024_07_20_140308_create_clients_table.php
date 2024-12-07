<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->enum('genre', ['M', 'F'])->nullable();
            $table->string('cine')->nullable();
            $table->string('adresse');
            $table->date('premiere_visite')->nullable();
            $table->date('derniere_visite')->nullable();
            $table->date('client_depuis')->nullable();
            $table->decimal('total_vente', 10, 2)->nullable();
            $table->decimal('total_reglement', 10, 2)->nullable();
            $table->decimal('reste_du', 10, 2)->nullable();
            $table->integer('nombre_visite')->nullable();
            $table->string('assurance', 10)->nullable();
            $table->timestamps();
        });
    }

    public function down() 
    {
        Schema::dropIfExists('clients');
    }
}
