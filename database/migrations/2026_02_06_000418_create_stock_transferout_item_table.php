<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_transferout_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock_transferout_id');
            $table->integer('item_id');
            $table->string('item_name', 80);
            $table->integer('unit_id');
            $table->float('quantity');
            $table->float('price');
            $table->decimal('item_total', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('mfg_item_id');
            $table->index(["stock_transferout_id", "item_id", "unit_id", "status", "deleted_at"], 'stock_transferout_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_transferout_item');
    }
};
