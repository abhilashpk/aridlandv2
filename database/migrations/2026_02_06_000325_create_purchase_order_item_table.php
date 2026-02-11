<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_order_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_order_id');
            $table->integer('item_id');
            $table->string('item_name', 150);
            $table->integer('unit_id');
            $table->float('quantity');
            $table->float('unit_price');
            $table->float('vat');
            $table->decimal('vat_amount', 10, 2);
            $table->float('discount');
            $table->decimal('total_price', 10, 2);
            $table->tinyInteger('is_transfer');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('balance_quantity');
            $table->string('tax_code', 5);
            $table->tinyInteger('tax_include');
            $table->decimal('othercost_unit', 10, 2);
            $table->decimal('netcost_unit', 10, 2);
            $table->decimal('item_total', 10, 2);
            $table->decimal('unit_price_fc', 6, 2);
            $table->decimal('item_total_fc', 8, 2);
            $table->decimal('total_price_fc', 8, 2);
            $table->decimal('vat_amount_fc', 6, 2);
            $table->index(["purchase_order_id", "item_id", "unit_id", "is_transfer", "status", "deleted_at", "tax_include"], 'purchase_order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_order_item');
    }
};
