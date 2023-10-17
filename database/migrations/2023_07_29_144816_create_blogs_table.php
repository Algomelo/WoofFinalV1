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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('contenido');
            $table->dateTime('fecha_publicacion');
            $table->string('autor');
            $table->timestamps();
            $table->string('image_path')->nullable(); // Campo para almacenar la ruta de la imagen (puedes cambiar el tipo según tus necesidades)
            $table->text('image_description')->nullable(); // Campo para almacenar la descripción de la imagen (puedes cambiar el tipo según tus necesidades)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
        

       
    }
};
