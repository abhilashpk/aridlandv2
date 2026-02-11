<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goods_return', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id');
            $table->string('voucher_no', 50);
            $table->date('voucher_date');
            $table->integer('job_id');
            $table->string('description', 155)->nullable();
            $table->integer('account_master_id');
            $table->integer('job_account_id');
            $table->decimal('total', 10, 2);
            $table->float('discount');
            $table->decimal('net_amount', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->tinyInteger('is_return');
            $table->tinyInteger('is_editable');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by');
            $table->integer('department_id');
            $table->unique('voucher_no', 'voucher_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goods_return');
    }
};
