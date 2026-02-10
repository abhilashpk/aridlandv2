<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_return_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_return_id');
            $table->integer('item_id');
            $table->string('item_name', 120);
            $table->integer('unit_id');
            $table->integer('quantity');
            $table->float('unit_price');
            $table->float('vat');
            $table->decimal('vat_amount', 10, 2);
            $table->float('discount');
            $table->decimal('total_price', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->string('tax_code', 10);
            $table->tinyInteger('tax_include');
            $table->decimal('item_total', 10, 2);
            $table->float('item_cost');
            $table->text('conloc_id')->nullable();
            $table->text('conloc_qty')->nullable();
            $table->decimal('rate', 8, 2);
            $table->decimal('rate_fc', 8, 2);
            $table->decimal('row_total', 10, 2);
            $table->decimal('row_total_fc', 10, 2);
            $table->decimal('vat_exc', 8, 2);
            $table->decimal('vat_exc_fc', 8, 2);
            $table->float('width')->nullable();
            $table->float('length')->nullable();
            $table->float('mp_qty')->nullable();
            $table->integer('cat_id')->nullable();
            $table->index(["sales_return_id", "item_id", "unit_id", "status", "deleted_at"], 'sales_return_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_return_item');
    }
};
