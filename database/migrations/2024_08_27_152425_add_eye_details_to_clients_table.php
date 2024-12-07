<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('od_sphere')->nullable();
            $table->string('od_cylinder')->nullable();
            $table->string('od_axis')->nullable();
            $table->string('od_add')->nullable();
            $table->string('od_epi')->nullable();
            $table->string('os_sphere')->nullable();
            $table->string('os_cylinder')->nullable();
            $table->string('os_axis')->nullable();
            $table->string('os_add')->nullable();
            $table->string('os_epi')->nullable();
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'od_sphere', 'od_cylinder', 'od_axis', 'od_add', 'od_epi',
                'os_sphere', 'os_cylinder', 'os_axis', 'os_add', 'os_epi'
            ]);
        });
    }

};
