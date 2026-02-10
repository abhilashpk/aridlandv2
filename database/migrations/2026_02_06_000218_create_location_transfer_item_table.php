<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('location_transfer_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_transfer_id');
            $table->integer('item_id');
            $table->string('item_name', 150)->nullable();
            $table->integer('unit_id')->nullable();
            $table->float('quantity');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index(["location_transfer_id", "item_id", "unit_id", "status", "deleted_at"], 'location_transfer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('location_transfer_item');
    }
};
