<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credit_note', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id');
            $table->string('voucher_no', 250);
            $table->date('voucher_date');
            $table->integer('dr_account_id');
            $table->decimal('amount', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->string('description', 200);
            $table->integer('department_id');
            $table->index('voucher_id', 'voucher_id');
            $table->index('voucher_date', 'voucher_date');
            $table->index('dr_account_id', 'dr_account_id');
            $table->index('status', 'status');
            $table->index('deleted_at', 'deleted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_note');
    }
};
