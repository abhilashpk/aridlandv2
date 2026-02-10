<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goods_return_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_return_id');
            $table->integer('item_id');
            $table->string('item_name', 150);
            $table->integer('unit_id');
            $table->float('quantity');
            $table->float('unit_price');
            $table->float('discount');
            $table->decimal('total_price', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_editable');
            $table->tinyInteger('is_transfer');
            $table->decimal('balance_quantity', 10, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goods_return_item');
    }
};
