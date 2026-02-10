<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('receipt_voucher_tr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('receipt_voucher_entry_id');
            $table->integer('sales_invoice_id')->nullable();
            $table->decimal('assign_amount', 10, 2)->nullable();
            $table->string('bill_type', 5)->nullable();
            $table->integer('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index(["receipt_voucher_entry_id", "sales_invoice_id", "status", "deleted_at"], 'receipt_voucher_entry_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('receipt_voucher_tr');
    }
};
