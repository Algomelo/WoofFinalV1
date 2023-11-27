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
        Schema::create('package_services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Claves foráneas
            $table->foreignId('package_id')->constrained();
            $table->foreignId('services_id')->nullable()->constrained();

            // Otros campos
            $table->integer('quantity');

            // Índices
            $table->index('package_id');
            $table->primary(['package_id', 'services_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_services');
    }
};
