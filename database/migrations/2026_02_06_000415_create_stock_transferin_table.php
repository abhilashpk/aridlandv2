<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_transferin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 120);
            $table->string('reference_no', 120)->nullable();
            $table->date('voucher_date');
            $table->string('description', 150)->nullable();
            $table->integer('job_id');
            $table->integer('account_dr');
            $table->integer('account_cr');
            $table->double('total_qty');
            $table->decimal('total_amt', 10, 2);
            $table->float('discount');
            $table->decimal('net_total', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by');
            $table->tinyInteger('is_mfg');
            $table->integer('department_id');
            $table->decimal('other_cost', 8, 2);
            $table->unique('voucher_no', 'voucher_no_2');
            $table->index(["voucher_no", "voucher_date", "job_id", "account_dr", "account_cr", "status", "deleted_at"], 'voucher_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_transferin');
    }
};
