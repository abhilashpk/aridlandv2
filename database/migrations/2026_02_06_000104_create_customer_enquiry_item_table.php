<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_enquiry_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_enquiry_id');
            $table->integer('item_id');
            $table->string('item_name', 120);
            $table->integer('unit_id');
            $table->float('quantity');
            $table->float('unit_price');
            $table->float('vat');
            $table->decimal('vat_amount', 10, 2);
            $table->float('discount');
            $table->decimal('line_total', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_transfer');
            $table->integer('balance_quantity');
            $table->string('tax_code', 5);
            $table->tinyInteger('tax_include');
            $table->decimal('item_total', 10, 2);
            $table->tinyInteger('item_type');
            $table->index('item_type', 'item_type');
            $table->index(["customer_enquiry_id", "item_id", "unit_id", "status", "deleted_at", "is_transfer", "tax_include"], 'customer_enquiry_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_enquiry_item');
    }
};
