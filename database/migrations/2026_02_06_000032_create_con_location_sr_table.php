<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('con_location_sr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id');
            $table->integer('item_id');
            $table->integer('unit_id');
            $table->float('quantity');
            $table->integer('invoice_id');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('con_location_sr');
    }
};
