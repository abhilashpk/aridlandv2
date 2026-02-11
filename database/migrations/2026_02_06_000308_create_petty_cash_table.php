<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('petty_cash', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_type', 10);
            $table->string('voucher_no', 45);
            $table->date('voucher_date');
            $table->decimal('debit', 10, 2);
            $table->decimal('credit', 10, 2);
            $table->float('difference');
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by');
            $table->string('supplier_name', 80);
            $table->string('trn_no', 100);
            $table->string('group_id', 45)->nullable();
            $table->tinyInteger('is_transfer');
            $table->index(["voucher_type", "voucher_no", "voucher_date", "status", "deleted_at", "group_id"], 'voucher_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('petty_cash');
    }
};
