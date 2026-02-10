<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('debit_note', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id');
            $table->string('voucher_no', 150);
            $table->date('voucher_date');
            $table->integer('cr_account_id');
            $table->decimal('amount', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->dateTime('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->string('description', 250);
            $table->integer('department_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('debit_note');
    }
};
