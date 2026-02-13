<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchasesplit_return', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id');
            $table->string('voucher_no', 100);
            $table->string('reference_no', 100);
            $table->date('voucher_date');
            $table->integer('purchase_split_id');
            $table->integer('supplier_id');
            $table->string('description', 200);
            $table->integer('job_id');
            $table->tinyInteger('is_fc');
            $table->integer('currency_id');
            $table->float('currency_rate');
            $table->decimal('total', 10, 2);
            $table->float('discount');
            $table->decimal('vat_amount', 10, 2);
            $table->decimal('net_amount', 10, 2);
            $table->decimal('total_fc', 10, 2);
            $table->decimal('discount_fc', 10, 2);
            $table->decimal('vat_amount_fc', 10, 2);
            $table->decimal('net_amount_fc', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('subtotal_fc', 10, 2);
            $table->tinyInteger('is_transfer');
            $table->integer('department_id');
            $table->tinyInteger('amount_transfer');
            $table->decimal('balance_amount', 10, 2);
            $table->tinyInteger('is_pettycash');
            $table->text('foot_description');
            $table->index('supplier_id', 'supplier_id');
            $table->index('job_id', 'job_id');
            $table->index('department_id', 'department_id');
            $table->index('voucher_id', 'voucher_id');
            $table->index('voucher_no', 'voucher_no');
            $table->index('voucher_date', 'voucher_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchasesplit_return');
    }
};
