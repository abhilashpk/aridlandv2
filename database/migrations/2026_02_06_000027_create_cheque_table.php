<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cheque', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cheque_no', 50);
            $table->integer('bank_id');
            $table->integer('account_id');
            $table->string('ctype');
            $table->index('cheque_no', 'cheque_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cheque');
    }
};
