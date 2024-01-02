<?php
// database/migrations/xxxx_xx_xx_create_service_service_request_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceServiceRequestTable extends Migration
{
    public function up()
    {
        Schema::create('service_service_request', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('service_request_id');
            $table->integer('service_quantity');
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('service_request_id')->references('id')->on('service_request')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_service_request');
    }
}
