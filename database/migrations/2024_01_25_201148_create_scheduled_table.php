<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateScheduledTable extends Migration

{

    public function up()
    {
        Schema::create('scheduled', function (Blueprint $table) {
            $table->id();
            $table->string('nameservice');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('walker_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('walker_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('namepets');
            $table->integer('quantity')->nullable();
            $table->string('state');
            $table->text('comment')->nullable();
            $table->string('address')->nullable();
            $table->string('date');
            $table->string('shift');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
