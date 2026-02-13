<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manual_journal_entry', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manual_journal_id');
            $table->integer('account_id');
            $table->string('description', 100);
            $table->string('reference', 100);
            $table->string('entry_type', 100);
            $table->decimal('amount', 10, 0);
            $table->decimal('fc_amount', 10, 0);
            $table->tinyInteger('fc_id');
            $table->float('currency_rate');
            $table->integer('job_id');
            $table->integer('department_id');
            $table->string('cheque_no', 111);
            $table->date('cheque_date');
            $table->integer('bank_id');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('party_account_id');
            $table->tinyInteger('is_onaccount');
            $table->tinyInteger('amount_transfer');
            $table->decimal('balance_amount', 10, 0);
            $table->index('account_id', 'account_id');
            $table->index('bank_id', 'bank_id');
            $table->index('deleted_at', 'deleted_at');
            $table->index('department_id', 'department_id');
            $table->index('entry_type', 'entry_type');
            $table->index('fc_id', 'fc_id');
            $table->index('job_id', 'job_id');
            $table->index('manual_journal_id', 'journal_id');
            $table->index('party_account_id', 'party_account_id');
            $table->index('status', 'status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manual_journal_entry');
    }
};
