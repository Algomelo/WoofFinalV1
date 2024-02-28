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
        Schema::create('email', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('comment');
            $table->string('name');
            $table->string('phone', 15);
            $table->string('age', 15)->nullable();
            $table->string('dogname')->nullable();
            $table->string('breed')->nullable();
            $table->string('address')->nullable();
            $table->string('service')->nullable();
            $table->string('form');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email');
    }
};
