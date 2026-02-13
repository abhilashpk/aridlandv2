<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_split_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_split_id');
            $table->integer('account_id');
            $table->string('item_description', 250);
            $table->string('unit_id', 40);
            $table->float('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->float('vat');
            $table->float('item_vat');
            $table->integer('item_jobid');
            $table->string('tax_code', 5);
            $table->tinyInteger('tax_include');
            $table->decimal('item_total', 10, 2);
            $table->decimal('unit_price_fc', 10, 2);
            $table->decimal('item_vat_fc', 10, 2);
            $table->decimal('line_total', 10, 2);
            $table->decimal('line_total_fc', 10, 2);
            $table->decimal('item_total_fc', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->string('item_supname', 300);
            $table->string('item_vatno', 100);
            $table->tinyInteger('is_transfer');
            $table->integer('balance_quantity');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_split_item');
    }
};
