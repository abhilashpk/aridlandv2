<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_return', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id');
            $table->string('voucher_no', 100);
            $table->date('voucher_date');
            $table->string('reference_no', 15);
            $table->integer('purchase_invoice_id');
            $table->string('description', 120)->nullable();
            $table->integer('account_master_id');
            $table->integer('supplier_id');
            $table->integer('job_id')->nullable();
            $table->tinyInteger('is_fc')->nullable()->default("0");
            $table->integer('currency_id')->nullable();
            $table->float('currency_rate')->nullable();
            $table->decimal('total', 10, 2);
            $table->float('discount');
            $table->decimal('vat_amount', 10, 2);
            $table->decimal('net_amount', 10, 2);
            $table->decimal('total_fc', 10, 2);
            $table->float('discount_fc');
            $table->decimal('vat_amount_fc', 10, 2);
            $table->decimal('net_amount_fc', 10, 2);
            $table->tinyInteger('status');
            $table->integer('department_id')->nullable();
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('subtotal_fc', 10, 2);
            $table->string('purchase_invoice_no', 80)->nullable();
            $table->integer('location_id');
            $table->text('foot_description')->nullable();
            $table->string('prefix', 12)->nullable();
            $table->tinyInteger('is_intercompany')->nullable()->default("0");
            $table->unique('voucher_no', 'voucher_no');
            $table->unique('voucher_no', 'voucher_no_2');
            $table->index(["voucher_id", "voucher_no", "voucher_date", "purchase_invoice_id", "account_master_id", "supplier_id", "job_id"], 'voucher_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_return');
    }
};
