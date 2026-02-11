<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('other_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 100);
            $table->string('voucher_type', 15);
            $table->date('voucher_date');
            $table->integer('cr_account_id');
            $table->string('reference', 100);
            $table->string('description', 120);
            $table->string('transaction', 10);
            $table->decimal('amount', 10, 2);
            $table->integer('job_id');
            $table->integer('department_id');
            $table->tinyInteger('is_fc');
            $table->integer('currency_id');
            $table->float('currency_rate');
            $table->decimal('amount_fc', 10, 2);
            $table->integer('customer_id');
            $table->string('tr_description', 120);
            $table->string('depositor', 80);
            $table->decimal('debit', 10, 2);
            $table->decimal('credit', 10, 2);
            $table->float('difference');
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->string('cheque_no', 80);
            $table->date('cheque_date');
            $table->integer('bank_id');
            $table->tinyInteger('is_transfer');
            $table->index(["voucher_no", "voucher_type", "voucher_date", "cr_account_id", "job_id", "department_id", "is_fc", "currency_id", "customer_id", "status", "deleted_at", "bank_id", "is_transfer"], 'voucher_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('other_payment');
    }
};
