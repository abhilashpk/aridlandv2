<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pdc_received', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_type', 10);
            $table->integer('voucher_id');
            $table->decimal('amount', 10, 2);
            $table->string('reference', 100)->nullable();
            $table->integer('dr_account_id');
            $table->integer('cr_account_id');
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('deleted_at')->nullable();
            $table->date('voucher_date');
            $table->integer('customer_id');
            $table->string('cheque_no', 45);
            $table->date('cheque_date');
            $table->string('voucher_no', 45);
            $table->string('description', 200)->nullable();
            $table->integer('bank_id');
            $table->integer('entry_id');
            $table->string('entry_type', 5)->nullable();
            $table->integer('dr_bank_id')->nullable();
            $table->integer('department_id');
            $table->index(["voucher_type", "voucher_id", "dr_account_id", "cr_account_id", "status", "deleted_at", "voucher_date", "customer_id"], 'voucher_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pdc_received');
    }
};
