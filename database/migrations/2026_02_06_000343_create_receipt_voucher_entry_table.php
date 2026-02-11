<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('receipt_voucher_entry', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('receipt_voucher_id');
            $table->integer('account_id');
            $table->string('description', 120)->nullable();
            $table->string('reference', 80)->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('entry_type', 5);
            $table->integer('job_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->tinyInteger('is_fc')->nullable()->default("0");
            $table->integer('currency_id')->nullable();
            $table->float('currency_rate')->nullable();
            $table->decimal('amount_fc', 10, 2)->nullable();
            $table->string('cheque_no', 100)->nullable();
            $table->date('cheque_date')->nullable();
            $table->integer('bank_id')->nullable();
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by');
            $table->tinyInteger('is_onaccount')->nullable()->default("0");
            $table->tinyInteger('amount_transfer')->nullable()->default("0");
            $table->decimal('balance_amount', 10, 2)->nullable();
            $table->integer('party_account_id')->nullable();
            $table->integer('salesman_id')->nullable();
            $table->index(["receipt_voucher_id", "account_id", "entry_type", "job_id", "department_id", "is_fc", "currency_id"], 'receipt_voucher_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('receipt_voucher_entry');
    }
};
