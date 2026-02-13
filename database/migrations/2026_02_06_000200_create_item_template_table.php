<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_template', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->string('type_name', 150);
            $table->string('input_type', 50);
            $table->tinyInteger('is_stock');
            $table->tinyInteger('unit_id');
            $table->integer('group_id');
            $table->tinyInteger('is_dimension');
            $table->tinyInteger('order_no');
            $table->tinyInteger('is_required');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('frame_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_template');
    }
};
