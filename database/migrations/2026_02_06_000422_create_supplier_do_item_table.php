<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supplier_do_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_do_id');
            $table->integer('item_id');
            $table->string('item_name', 160);
            $table->integer('unit_id');
            $table->float('quantity');
            $table->integer('balance_quantity');
            $table->float('unit_price');
            $table->float('vat');
            $table->float('vat_amount');
            $table->float('discount');
            $table->float('total_price');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_transfer');
            $table->decimal('othercost_unit', 10, 2);
            $table->decimal('netcost_unit', 10, 2);
            $table->tinyInteger('is_editable');
            $table->string('tax_code', 5);
            $table->tinyInteger('tax_include');
            $table->decimal('item_total', 10, 2);
            $table->float('unit_price_fc');
            $table->float('vat_amount_fc');
            $table->decimal('total_price_fc', 10, 2);
            $table->decimal('item_total_fc', 10, 2);
            $table->integer('doc_row_id');
            $table->index('is_transfer', 'is_transfer');
            $table->index(["supplier_do_id", "item_id", "unit_id", "status", "deleted_at"], 'supplier_do_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supplier_do_item');
    }
};
