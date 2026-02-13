<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_receipt_tr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_receipt_id');
            $table->integer('sales_invoice_id');
            $table->float('assign_amount');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->string('bill_type', 5);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_receipt_tr');
    }
};
