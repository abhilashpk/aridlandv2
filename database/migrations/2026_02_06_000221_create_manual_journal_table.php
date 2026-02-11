<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manual_journal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_type', 100);
            $table->string('voucher_no', 100);
            $table->date('voucher_date');
            $table->decimal('debit', 10, 0);
            $table->decimal('credit', 10, 0);
            $table->float('difference');
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->integer('modify_at');
            $table->string('modify_by', 122);
            $table->dateTime('deleted_at')->nullable();
            $table->string('supplier_name', 112);
            $table->string('trn_no', 112);
            $table->integer('group_id');
            $table->tinyInteger('is_transfer');
            $table->integer('balance_amount');
            $table->integer('department_id');
            $table->index('group_id', 'group_id');
            $table->index('status', 'status');
            $table->index('voucher_date', 'voucher_date');
            $table->index('voucher_no', 'voucher_no');
            $table->index('voucher_type', 'voucher_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manual_journal');
    }
};
