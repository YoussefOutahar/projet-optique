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
        Schema::table('clients', function (Blueprint $table) {
            if (Schema::hasColumn('clients', 'cine')) {
                $table->dropUnique(['cine']);
            }

            if (Schema::hasColumn('clients', 'genre')) {
                $table->dropColumn('genre');
            }

            if (Schema::hasColumn('clients', 'cine')) {
                $table->dropColumn('cine');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            if (!Schema::hasColumn('clients', 'cine')) {
                $table->string('cine')->unique()->nullable();
            }

            if (!Schema::hasColumn('clients', 'genre')) {
                $table->string('genre')->nullable();
            }
        });
    }
};
