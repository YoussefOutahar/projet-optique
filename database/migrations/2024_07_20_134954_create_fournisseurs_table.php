<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisseursTable extends Migration
{
    public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('societe')->unique(); 
            $table->string('responsable');
            $table->string('ice')->unique();;
            $table->string('adresse');
            $table->string('ville');
            $table->string('telephone');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fournisseurs');
    }
}
