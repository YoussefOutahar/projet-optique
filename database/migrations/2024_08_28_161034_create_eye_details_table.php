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
        Schema::create('eye_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('vision')->nullable();
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
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eye_details');
    }
};
