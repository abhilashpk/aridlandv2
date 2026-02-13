<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opening_balance_tr', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tr_type', 10);
            $table->date('tr_date');
            $table->string('reference_no', 45)->nullable();
            $table->string('description', 100)->nullable();
            $table->decimal('amount', 10, 2);
            $table->integer('account_master_id');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->string('cheque_no', 55)->nullable();
            $table->date('cheque_date')->nullable();
            $table->integer('bank_id')->nullable();
            $table->integer('frmaccount_id')->nullable();
            $table->tinyInteger('amount_transfer')->nullable();
            $table->decimal('balance_amount', 10, 2)->nullable();
            $table->integer('currency_id')->nullable();
            $table->float('rate')->nullable();
            $table->decimal('fc_amount', 10, 2)->nullable();
            $table->string('loc_proj', 200)->nullable();
            $table->string('eqp_type', 200)->nullable();
            $table->string('lpo_no', 200)->nullable();
            $table->integer('salesman_id')->nullable();
            $table->string('jobno', 100)->nullable();
            $table->date('duedate')->nullable();
            $table->index(["tr_type", "tr_date", "account_master_id", "status", "deleted_at", "bank_id", "frmaccount_id"], 'tr_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opening_balance_tr');
    }
};
