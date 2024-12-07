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
        Schema::table('produits', function (Blueprint $table) {
            if (Schema::hasColumn('produits', 'categorie')) {
                $table->dropColumn('categorie');
            }

            if (!Schema::hasColumn('produits', 'categorie_id')) {
                $table->unsignedBigInteger('categorie_id')->nullable();  
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            if (Schema::hasColumn('produits', 'categorie_id')) {
                $table->dropColumn('categorie_id');
            }

            if (!Schema::hasColumn('produits', 'categorie')) {
                $table->string('categorie');
            }
        });
    }
};
