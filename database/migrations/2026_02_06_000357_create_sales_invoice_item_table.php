<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_invoice_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_invoice_id');
            $table->integer('item_id');
            $table->string('item_name', 120);
            $table->integer('unit_id');
            $table->float('quantity');
            $table->float('unit_price');
            $table->float('vat');
            $table->float('vat_amount');
            $table->float('discount');
            $table->decimal('line_total', 10, 2);
            $table->tinyInteger('is_transfer');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('balance_quantity');
            $table->string('tax_code', 5);
            $table->tinyInteger('tax_include');
            $table->decimal('item_total', 10, 2);
            $table->float('item_cost');
            $table->tinyInteger('item_type');
            $table->float('pay_pcntg');
            $table->decimal('pay_amount', 10, 2);
            $table->string('pay_pcntg_desc', 250);
            $table->text('assembly_items');
            $table->tinyInteger('is_assembly_item');
            $table->text('assembly_items_qty');
            $table->float('unit_price_fc');
            $table->float('vat_amount_fc');
            $table->decimal('total_price_fc', 10, 2);
            $table->decimal('item_total_fc', 10, 2);
            $table->text('conloc_id');
            $table->text('conloc_qty');
            $table->float('width');
            $table->float('length');
            $table->float('mp_qty');
            $table->decimal('rate', 8, 2);
            $table->decimal('rate_fc', 8, 2);
            $table->decimal('row_total', 10, 2);
            $table->decimal('row_total_fc', 10, 2);
            $table->decimal('vat_exc', 10, 2);
            $table->decimal('vat_exc_fc', 10, 2);
            $table->integer('doc_row_id');
            $table->decimal('assembly_items_cost', 8, 2);
            $table->index(["sales_invoice_id", "item_id", "unit_id", "is_transfer", "status", "deleted_at", "balance_quantity", "item_type"], 'sales_invoice_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_invoice_item');
    }
};
