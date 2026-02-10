<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cheque_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cheque_no');
            $table->date('cheque_date');
            $table->dateTime('created_date');
            $table->string('amount_words', 100);
            $table->decimal('amount_number', 10, 2);
            $table->integer('customer_id');
            $table->integer('bank_id');
            $table->tinyInteger('ac_payee');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('doc_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cheque_details');
    }
};
