<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supplier_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 100);
            $table->string('voucher_type', 15);
            $table->date('voucher_date');
            $table->integer('cr_account_id');
            $table->string('reference', 100);
            $table->string('description', 120);
            $table->string('transaction', 10);
            $table->float('amount');
            $table->integer('job_id');
            $table->integer('department_id');
            $table->tinyInteger('is_fc');
            $table->integer('currency_id');
            $table->float('currency_rate');
            $table->float('amount_fc');
            $table->string('cheque_no', 45);
            $table->date('cheque_date');
            $table->integer('bank_id');
            $table->integer('supplier_id');
            $table->string('tr_description', 120);
            $table->string('depositor', 80);
            $table->float('debit');
            $table->float('credit');
            $table->float('difference');
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_transfer');
            $table->index(["voucher_no", "voucher_type", "voucher_date", "cr_account_id", "job_id", "department_id", "is_fc", "currency_id", "bank_id", "supplier_id", "status", "deleted_at", "is_transfer"], 'voucher_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supplier_payment');
    }
};
