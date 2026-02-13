<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mfg_wastage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manufacture_id');
            $table->integer('item_id');
            $table->float('quantity');
            $table->float('unit_price');
            $table->float('total');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mfg_wastage');
    }
};
