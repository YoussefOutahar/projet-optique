<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueSocieteToFournisseursTable extends Migration
{
    public function up()
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            $table->dropUnique(['societe']);
            
            $table->string('societe')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            $table->dropUnique(['societe']);
        });
    }
}
