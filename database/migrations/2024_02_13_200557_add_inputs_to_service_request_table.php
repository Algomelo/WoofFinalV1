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
        Schema::table('service_request', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('date');
            $table->string('shift')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('namepets')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        // Parte 2: Agregar clave foránea a service_id
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_request', function (Blueprint $table) {
            //
        });
    }
};
