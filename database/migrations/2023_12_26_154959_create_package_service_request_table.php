<?php
// database/migrations/xxxx_xx_xx_create_package_service_request_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageServiceRequestTable extends Migration
{
    public function up()
    {
        Schema::create('package_service_request', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('service_request_id');
            $table->integer('package_quantity');
            $table->timestamps();

            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->foreign('service_request_id')->references('id')->on('service_request')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('package_service_request');
    }
}
