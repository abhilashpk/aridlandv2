<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proforma_invoice_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proforma_invoice_id');
            $table->integer('item_id');
            $table->text('item_name');
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
            $table->string('tax_code', 5);
            $table->tinyInteger('tax_include');
            $table->decimal('item_total', 10, 2);
            $table->tinyInteger('item_type');
            $table->float('pay_pcntg');
            $table->decimal('pay_amount', 10, 2);
            $table->string('pay_pcntg_desc', 250);
            $table->tinyInteger('orderno');
            $table->index('item_type', 'item_type');
            $table->index(["proforma_invoice_id", "item_id", "unit_id", "is_transfer", "status", "deleted_at"], 'sales_order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proforma_invoice_item');
    }
};
