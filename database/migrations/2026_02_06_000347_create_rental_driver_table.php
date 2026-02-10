<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_driver', function (Blueprint $table) {
            $table->increments('id');
            $table->string('driver_name', 100);
            $table->string('mobile1', 45);
            $table->string('mobile2', 45);
            $table->string('driver_type', 20);
            $table->integer('account_id');
            $table->dateTime('deleted_at')->nullable();
            $table->string('code', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_driver');
    }
};
