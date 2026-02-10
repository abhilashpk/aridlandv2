<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_return', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id');
            $table->string('voucher_no', 100);
            $table->string('reference_no', 45);
            $table->date('voucher_date');
            $table->integer('sales_invoice_id');
            $table->string('description', 120)->nullable();
            $table->integer('cr_account_id');
            $table->integer('customer_id');
            $table->integer('dr_account_id');
            $table->integer('job_id')->nullable();
            $table->tinyInteger('is_fc')->nullable()->default("0");
            $table->integer('currency_id')->nullable();
            $table->float('currency_rate')->nullable();
            $table->decimal('total', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->decimal('vat_amount', 10, 2);
            $table->decimal('net_amount', 10, 2);
            $table->decimal('total_fc', 10, 2);
            $table->decimal('discount_fc', 10, 0);
            $table->decimal('vat_amount_fc', 10, 2);
            $table->decimal('net_amount_fc', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->string('sales_invoice_no', 80)->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('subtotal_fc', 10, 2);
            $table->integer('location_id')->nullable();
            $table->tinyInteger('amount_transfer');
            $table->float('balance_amount');
            $table->tinyInteger('is_prior')->nullable()->default("0");
            $table->text('foot_description')->nullable();
            $table->integer('deleted_by');
            $table->integer('department_id');
            $table->string('prefix', 25)->nullable();
            $table->tinyInteger('is_intercompany')->nullable()->default("0");
            $table->unique('voucher_no', 'voucher_no');
            $table->index(["voucher_id", "voucher_no", "voucher_date", "sales_invoice_id", "cr_account_id", "customer_id", "dr_account_id", "job_id", "is_fc", "currency_id", "status", "deleted_at", "sales_invoice_no", "location_id"], 'voucher_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_return');
    }
};
