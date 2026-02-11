<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('petty_cash_entry', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('petty_cash_id');
            $table->integer('account_id');
            $table->string('description', 120)->nullable();
            $table->string('reference', 80)->nullable();
            $table->string('entry_type', 4);
            $table->decimal('amount', 10, 2);
            $table->decimal('fc_amount', 10, 2)->nullable();
            $table->tinyInteger('fc_id')->nullable();
            $table->float('currency_rate')->nullable();
            $table->integer('job_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->string('cheque_no', 45)->nullable();
            $table->date('cheque_date')->nullable();
            $table->integer('bank_id')->nullable();
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('party_account_id')->nullable();
            $table->index(["petty_cash_id", "account_id", "entry_type", "fc_id", "job_id", "department_id", "bank_id", "status", "deleted_at", "party_account_id"], 'petty_cash_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('petty_cash_entry');
    }
};
