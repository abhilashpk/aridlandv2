<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manufacture', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 100);
            $table->integer('stock_transferin_id');
            $table->integer('stock_transferout_id');
            $table->dateTime('deleted_at')->nullable();
            $table->date('voucher_date');
            $table->decimal('amount', 10, 2);
            $table->integer('department_id');
            $table->integer('account_dr');
            $table->integer('account_cr');
            $table->float('other_cost');
            $table->integer('account_dr_to');
            $table->integer('account_cr_to');
            $table->text('foot_description');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manufacture');
    }
};
