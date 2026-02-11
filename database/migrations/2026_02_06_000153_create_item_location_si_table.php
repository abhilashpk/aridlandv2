<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_location_si', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id');
            $table->integer('item_id');
            $table->integer('unit_id');
            $table->float('quantity');
            $table->integer('invoice_id');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_do');
            $table->integer('logid');
            $table->float('qty_entry');
            $table->integer('department_id');
            $table->index(["location_id", "item_id", "unit_id", "invoice_id", "status", "deleted_at"], 'location_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_location_si');
    }
};
