<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_customerdriver', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->text('driver_id');
            $table->dateTime('deleted_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_customerdriver');
    }
};
