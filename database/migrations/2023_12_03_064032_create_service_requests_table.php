<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_service_requests_table.php

// database/migrations/xxxx_xx_xx_create_service_requests_table.php

    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('package_id')->nullable()->constrained();
            $table->foreignId('service_id')->nullable()->constrained();
            $table->integer('package_quantity')->default(0);
            $table->integer('service_quantity')->default(0);
            // Otros campos necesarios
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
