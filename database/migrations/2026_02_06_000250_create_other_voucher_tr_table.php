<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('other_voucher_tr', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_type', 5);
            $table->integer('voucher_id');
            $table->string('tr_type', 5);
            $table->date('tr_date');
            $table->string('reference_no', 100);
            $table->integer('account_master_id');
            $table->decimal('amount', 10, 2);
            $table->tinyInteger('amount_transfer');
            $table->decimal('balance_amount', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index(["tr_type", "tr_date", "account_master_id", "amount_transfer", "status", "deleted_at"], 'tr_type');
            $table->index(["voucher_type", "voucher_id"], 'voucher_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('other_voucher_tr');
    }
};
