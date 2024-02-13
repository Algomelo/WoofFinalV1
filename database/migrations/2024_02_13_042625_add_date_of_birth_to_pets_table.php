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
        // Agregar la nueva columna de fecha
        Schema::table('pets', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable();
        });

        // Eliminar la columna 'age' original
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn('age');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            //
        });
    }
};
