<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journal_voucher_tr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('journal_entry_id');
            $table->integer('invoice_id')->nullable();
            $table->decimal('assign_amount', 10, 2)->nullable();
            $table->string('bill_type', 10)->nullable();
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal_voucher_tr');
    }
};
