<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_id', 50)->nullable();
            $table->string('master_name', 120);
            $table->integer('account_category_id')->nullable();
            $table->integer('account_group_id')->nullable();
            $table->decimal('cl_balance', 10, 2)->nullable();
            $table->decimal('op_balance', 10, 2)->nullable();
            $table->decimal('fcop_balance', 10, 2)->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('currency_id')->nullable();
            $table->integer('salesman_id')->nullable();
            $table->decimal('credit_limit', 10, 2)->nullable();
            $table->smallInteger('duedays')->nullable();
            $table->integer('terms_id')->nullable();
            $table->string('country_id', 150)->nullable();
            $table->string('area_id', 150)->nullable();
            $table->tinyInteger('job_assign')->nullable();
            $table->tinyInteger('job_compulsary')->nullable();
            $table->tinyInteger('is_hide')->nullable();
            $table->integer('created_by');
            $table->dateTime('created_at');
            $table->integer('modify_by');
            $table->dateTime('modified_at');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('non_edit')->nullable();
            $table->decimal('pdc_amount', 10, 2)->nullable();
            $table->string('transaction_type', 10)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('city', 150)->nullable();
            $table->string('state', 150)->nullable();
            $table->string('pin', 150)->nullable();
            $table->string('phone', 45)->nullable();
            $table->string('vat_no', 45)->nullable();
            $table->tinyInteger('vat_assign')->nullable();
            $table->float('vat_percentage')->nullable();
            $table->integer('deleted_by');
            $table->string('category', 45)->nullable();
            $table->decimal('fy_balance', 10, 2)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('reference', 200)->nullable();
            $table->string('contact_name', 80)->nullable();
            $table->string('listorder', 5)->nullable();
            $table->string('passport_no', 100)->nullable();
            $table->dateTime('passport_exp')->nullable();
            $table->string('nationality', 100)->nullable();
            $table->string('ac_no', 50)->nullable();
            $table->index('account_category_id', 'account_category_id');
            $table->index('account_id', 'account_id');
            $table->index('created_at', 'created_at');
            $table->index('created_by', 'created_by');
            $table->index('currency_id', 'currency_id');
            $table->index('deleted_by', 'deleted_by');
            $table->index('department_id', 'department_id');
            $table->index('master_name', 'master_name');
            $table->index('modified_at', 'modified_at');
            $table->index('modify_by', 'modify_by');
            $table->index('salesman_id', 'salesman_id');
            $table->index('status', 'status');
            $table->index('terms_id', 'terms_id');
            $table->index('transaction_type', 'transaction_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_master');
    }
};
