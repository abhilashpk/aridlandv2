<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_invoice_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_invoice_id');
            $table->integer('item_id');
            $table->string('item_name', 120);
            $table->integer('unit_id');
            $table->float('quantity');
            $table->float('unit_price');
            $table->float('vat');
            $table->decimal('vat_amount', 10, 2);
            $table->float('discount');
            $table->decimal('total_price', 10, 2);
            $table->decimal('othercost_unit', 10, 2);
            $table->decimal('netcost_unit', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_editable');
            $table->tinyInteger('is_transfer');
            $table->integer('balance_quantity');
            $table->string('tax_code', 5);
            $table->tinyInteger('tax_include');
            $table->decimal('item_total', 10, 2);
            $table->float('unit_price_fc');
            $table->float('vat_amount_fc');
            $table->decimal('total_price_fc', 10, 2);
            $table->decimal('item_total_fc', 10, 2);
            $table->float('width');
            $table->float('length');
            $table->float('mp_qty');
            $table->integer('doc_row_id');
            $table->index(["purchase_invoice_id", "item_id", "unit_id", "status", "deleted_at", "is_editable", "is_transfer"], 'purchase_invoice_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_invoice_item');
    }
};
