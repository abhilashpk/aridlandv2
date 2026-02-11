<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supplier_payment_tr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_payment_id');
            $table->integer('purchase_invoice_id');
            $table->float('assign_amount');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->string('bill_type', 5);
            $table->index(["supplier_payment_id", "purchase_invoice_id", "status", "deleted_at", "bill_type"], 'supplier_payment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supplier_payment_tr');
    }
};
