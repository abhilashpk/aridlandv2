<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_type', 15);
            $table->integer('voucher_type_id');
            $table->integer('account_master_id');
            $table->string('transaction_type', 5)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->string('description', 80)->nullable();
            $table->string('reference', 50);
            $table->date('invoice_date');
            $table->tinyInteger('is_paid');
            $table->string('reference_from', 80)->nullable();
            $table->integer('deleted_by');
            $table->tinyInteger('tr_for')->nullable();
            $table->decimal('fc_amount', 10, 2)->nullable();
            $table->string('other_type', 15)->nullable();
            $table->tinyInteger('is_fc');
            $table->integer('department_id')->nullable();
            $table->integer('job_id')->nullable();
            $table->string('other_info', 50)->nullable();
            $table->string('loc_proj', 200)->nullable();
            $table->string('eqp_type', 200)->nullable();
            $table->string('lpo_no', 200)->nullable();
            $table->integer('salesman_id')->nullable();
            $table->date('due_date')->nullable();
            $table->tinyInteger('version_no');
            $table->index('account_master_id', 'account_master_id');
            $table->index('created_at', 'created_at');
            $table->index('created_by', 'created_by');
            $table->index('deleted_at', 'deleted_at');
            $table->index('deleted_by', 'deleted_by');
            $table->index('invoice_date', 'invoice_date');
            $table->index('is_paid', 'is_paid');
            $table->index('modify_at', 'modify_at');
            $table->index('modify_by', 'modify_by');
            $table->index('voucher_type', 'voucher_type');
            $table->index('voucher_type_id', 'voucher_type_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_transaction');
    }
};
