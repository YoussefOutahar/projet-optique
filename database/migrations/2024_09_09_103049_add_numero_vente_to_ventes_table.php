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
        Schema::table('ventes', function (Blueprint $table) {
            if (!Schema::hasColumn('ventes', 'numero_vente')) {
                $table->string('numero_vente')->unique();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    if (Schema::hasColumn('ventes', 'numero_vente')) {
        Schema::table('ventes', function (Blueprint $table) {
            if (DB::getDriverName() !== 'sqlite') {
                $table->dropColumn('numero_vente');
            }
        });
    }
}
};