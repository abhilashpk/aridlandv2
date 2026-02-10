<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('receipt_voucher', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_type', 10);
            $table->integer('voucher_id');
            $table->string('voucher_no', 250);
            $table->date('voucher_date');
            $table->tinyInteger('from_jv')->nullable()->default("0");
            $table->decimal('debit', 10, 2);
            $table->decimal('credit', 10, 2);
            $table->float('difference')->nullable();
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by');
            $table->tinyInteger('is_transfer')->nullable()->default("0");
            $table->string('tr_description', 100)->nullable();
            $table->string('depositor', 54)->nullable();
            $table->integer('opening_balance_id')->nullable();
            $table->integer('sales_invoice_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('salesman_id')->nullable();
            $table->unique('voucher_no', 'voucher_no');
            $table->unique('voucher_no', 'voucher_no_2');
            $table->index(["voucher_type", "voucher_id", "voucher_no", "voucher_date", "from_jv", "status", "deleted_at"], 'voucher_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('receipt_voucher');
    }
};
