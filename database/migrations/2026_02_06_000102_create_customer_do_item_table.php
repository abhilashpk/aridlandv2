<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_do_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_do_id');
            $table->integer('item_id');
            $table->string('item_name', 120);
            $table->integer('unit_id');
            $table->float('quantity');
            $table->integer('balance_quantity');
            $table->float('unit_price');
            $table->float('vat');
            $table->decimal('vat_amount', 10, 2);
            $table->float('discount');
            $table->decimal('line_total', 10, 2);
            $table->tinyInteger('is_transfer');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->string('tax_code', 5);
            $table->tinyInteger('tax_include');
            $table->decimal('item_total', 10, 2);
            $table->text('conloc_id');
            $table->text('conloc_qty');
            $table->integer('doc_row_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_do_item');
    }
};
