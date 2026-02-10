<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_id');
            $table->integer('item_id');
            $table->string('item_name', 120);
            $table->integer('unit_id');
            $table->integer('quantity');
            $table->float('unit_price');
            $table->float('vat');
            $table->float('vat_amount');
            $table->float('discount');
            $table->float('line_total');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_transfer');
            $table->integer('balance_quantity');
            $table->tinyInteger('is_editable');
            $table->string('tax_code', 45);
            $table->tinyInteger('tax_include');
            $table->decimal('item_total', 10, 0);
            $table->tinyInteger('item_type');
            $table->index(["quotation_id", "item_id", "unit_id", "status", "deleted_at", "is_editable"], 'quotation_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_item');
    }
};
