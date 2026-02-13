<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contra_voucher_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contra_voucher_id');
            $table->integer('account_id');
            $table->text('description');
            $table->string('reference', 45);
            $table->decimal('amount', 12, 2);
            $table->string('tr_type', 10);
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contra_voucher_details');
    }
};
