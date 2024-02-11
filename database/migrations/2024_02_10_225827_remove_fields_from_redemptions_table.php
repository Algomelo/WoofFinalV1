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
        Schema::table('redemptions', function (Blueprint $table) {
            // Eliminar los campos 'date', 'shift', 'address' y 'comment'
            $table->dropColumn('date');
            $table->dropColumn('shift');
            $table->dropColumn('address');
            $table->dropColumn('comment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('redemptions', function (Blueprint $table) {
            //
        });
    }
};
