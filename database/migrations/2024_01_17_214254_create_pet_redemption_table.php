<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetRedemptionTable extends Migration
{
    public function up()
    {
        Schema::create('pet_redemption', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('redemption_id');
            $table->unsignedBigInteger('pet_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('redemption_id')->references('id')->on('redemptions')->onDelete('cascade');
            $table->foreign('pet_id')->references('id')->on('pets')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pet_redemption');
    }
}
