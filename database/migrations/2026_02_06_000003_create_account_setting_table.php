<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_type_id');
            $table->integer('department_id');
            $table->string('voucher_name', 100);
            $table->string('prefix', 10)->nullable();
            $table->tinyInteger('is_prefix');
            $table->integer('voucher_no');
            $table->integer('dr_account_master_id')->nullable();
            $table->integer('cr_account_master_id')->nullable();
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modified_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('cash_account_id')->nullable();
            $table->integer('bank_account_id')->nullable();
            $table->integer('pdc_account_id')->nullable();
            $table->tinyInteger('is_default');
            $table->tinyInteger('is_cash_voucher')->nullable();
            $table->integer('default_account_id')->nullable();
            $table->string('description', 150)->nullable();
            $table->integer('dr_account_master_id_to')->nullable();
            $table->integer('cr_account_master_id_to')->nullable();
            $table->index('voucher_type_id', 'voucher_type_id');
            $table->index('department_id', 'department_id');
            $table->index('dr_account_master_id', 'dr_account_master_id');
            $table->index('cr_account_master_id', 'cr_account_master_id');
            $table->index('status', 'status');
            $table->index('cash_account_id', 'cash_account_id');
            $table->index('bank_account_id', 'bank_account_id');
            $table->index('pdc_account_id', 'pdc_account_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_setting');
    }
};
