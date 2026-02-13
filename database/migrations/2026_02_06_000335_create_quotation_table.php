<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 50);
            $table->string('reference_no', 50)->nullable();
            $table->string('description', 180);
            $table->integer('supplier_id');
            $table->string('document_type', 45);
            $table->date('voucher_date');
            $table->date('lpo_date');
            $table->integer('terms_id');
            $table->integer('job_id');
            $table->tinyInteger('is_fc');
            $table->integer('currency_id');
            $table->float('currency_rate');
            $table->integer('header_id');
            $table->integer('footer_id');
            $table->float('total');
            $table->float('discount');
            $table->float('vat_amount');
            $table->float('net_amount');
            $table->float('total_fc');
            $table->float('discount_fc');
            $table->float('net_amount_fc');
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by');
            $table->tinyInteger('is_transfer');
            $table->string('subject', 100);
            $table->tinyInteger('is_export');
            $table->tinyInteger('job_type');
            $table->tinyInteger('jobnature');
            $table->tinyInteger('fabrication');
            $table->tinyInteger('prefix');
            $table->decimal('subtotal', 10, 0);
            $table->decimal('subtotal_fc', 10, 0);
            $table->text('footer_text');
            $table->tinyInteger('is_editable');
            $table->unique('voucher_no', 'voucher_no_2');
            $table->index(["voucher_no", "supplier_id", "document_type", "voucher_date", "terms_id", "job_id", "is_fc"], 'voucher_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation');
    }
};
