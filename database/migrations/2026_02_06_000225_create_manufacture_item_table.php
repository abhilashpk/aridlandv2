<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manufacture_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manufacture_id');
            $table->integer('item_id');
            $table->string('item_name', 200);
            $table->integer('unit_id');
            $table->float('quantity');
            $table->float('price');
            $table->decimal('item_total', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->float('other_cost');
            $table->float('netcost_unit');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manufacture_item');
    }
};
