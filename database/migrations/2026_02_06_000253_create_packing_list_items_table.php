<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packing_list_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('packing_list_id');
            $table->integer('item_id');
            $table->float('quantity');
            $table->string('carton_no', 55);
            $table->float('carton_qty');
            $table->float('balance_qty');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_sub');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packing_list_items');
    }
};
