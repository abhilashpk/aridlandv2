<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mfg_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->integer('subitem_id');
            $table->float('quantity');
            $table->float('unit_price');
            $table->float('total');
            $table->dateTime('deleted_at')->nullable();
            $table->float('other_cost');
            $table->float('netcost_unit');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mfg_items');
    }
};
