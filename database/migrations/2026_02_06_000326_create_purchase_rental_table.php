<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_rental', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id');
            $table->string('voucher_no', 45);
            $table->date('voucher_date');
            $table->string('reference_no', 45);
            $table->integer('account_master_id');
            $table->integer('supplier_id');
            $table->string('description', 250);
            $table->tinyInteger('is_vat');
            $table->tinyInteger('vat_type');
            $table->decimal('total', 10, 2);
            $table->decimal('discount', 5, 2);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('vat_amount', 5, 2);
            $table->decimal('net_amount', 10, 2);
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at')->nullable();
            $table->integer('modify_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_rental');
    }
};
