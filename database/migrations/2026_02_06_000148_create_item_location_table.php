<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_location', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id');
            $table->integer('department_id')->nullable();
            $table->integer('item_id');
            $table->integer('unit_id');
            $table->float('quantity');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->float('opn_qty');
            $table->integer('logid');
            $table->integer('bin_id');
            $table->index('bin_id', 'bin_id');
            $table->index(["item_id", "unit_id", "status", "deleted_at", "opn_qty"], 'item_id');
            $table->index('location_id', 'location_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_location');
    }
};
