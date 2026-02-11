<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_voucher_tr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_voucher_entry_id');
            $table->integer('purchase_invoice_id')->nullable();
            $table->decimal('assign_amount', 10, 2)->nullable();
            $table->string('bill_type', 5)->nullable();
            $table->integer('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index(["payment_voucher_entry_id", "purchase_invoice_id", "bill_type", "status", "deleted_at"], 'payment_voucher_entry_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_voucher_tr');
    }
};
