<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contra_voucher', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 100);
            $table->date('voucher_date');
            $table->tinyInteger('voucher_type');
            $table->decimal('amount', 12, 2);
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at')->nullable();
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contra_voucher');
    }
};
