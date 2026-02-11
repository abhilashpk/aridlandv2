<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_stock', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_type', 15);
            $table->integer('document_id');
            $table->integer('item_id');
            $table->integer('unit_id');
            $table->integer('quantity');
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->float('unit_cost');
            $table->integer('balance_qty');
            $table->tinyInteger('is_return');
            $table->float('prev_quantity');
            $table->float('prev_purchase_cost');
            $table->float('cost_avg');
            $table->float('prev_cost_avg');
            $table->string('action', 10);
            $table->float('packing');
            $table->float('cur_quantity');
            $table->integer('department_id');
            $table->index(["document_type", "document_id", "item_id", "unit_id", "status", "deleted_at", "is_return"], 'document_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_stock');
    }
};
