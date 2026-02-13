<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargo_vehicle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vehicle_name', 85);
            $table->string('vehicle_no', 50);
            $table->string('driver_name', 100);
            $table->string('mobile_uae', 55);
            $table->string('mobile_ksa', 55);
            $table->date('expiry_date');
            $table->dateTime('deleted_at')->nullable();
            $table->string('driver_code', 25);
            $table->string('company', 100);
            $table->string('watsapp', 50);
            $table->string('driver_id', 50);
            $table->string('passport_no', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargo_vehicle');
    }
};
