<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_order_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_order_id');
            $table->integer('item_id');
            $table->string('item_name', 120);
            $table->integer('unit_id');
            $table->float('quantity');
            $table->float('unit_price');
            $table->float('vat');
            $table->decimal('vat_amount', 10, 2);
            $table->float('discount');
            $table->decimal('line_total', 10, 2);
            $table->tinyInteger('is_transfer');
            $table->tinyInteger('status')->default("1");
            $table->dateTime('deleted_at')->nullable();
            $table->integer('balance_quantity');
            $table->string('tax_code', 45);
            $table->tinyInteger('tax_include');
            $table->decimal('item_total', 10, 2);
            $table->tinyInteger('item_type');
            $table->float('pay_pcntg');
            $table->decimal('pay_amount', 10, 2);
            $table->string('pay_pcntg_desc', 250);
            $table->tinyInteger('balance_quantity_po');
            $table->tinyInteger('is_transfer_po');
            $table->integer('doc_row_id');
            $table->index('item_type', 'item_type');
            $table->index(["sales_order_id", "item_id", "unit_id", "is_transfer", "status", "deleted_at"], 'sales_order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_order_item');
    }
};
