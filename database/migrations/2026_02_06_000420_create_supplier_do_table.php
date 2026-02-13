<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supplier_do', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 50);
            $table->string('reference_no', 50);
            $table->date('voucher_date');
            $table->date('lpo_date');
            $table->string('document_type', 15);
            $table->string('document_id', 110);
            $table->string('description', 120)->nullable();
            $table->integer('job_id');
            $table->integer('location_id');
            $table->tinyInteger('is_fc');
            $table->integer('currency_id');
            $table->float('currency_rate');
            $table->integer('supplier_id');
            $table->integer('footer_id');
            $table->float('total');
            $table->float('discount');
            $table->float('vat_amount');
            $table->float('net_total');
            $table->float('total_fc');
            $table->float('discount_fc');
            $table->float('vat_amount_fc');
            $table->float('net_total_fc');
            $table->tinyInteger('status');
            $table->integer('department_id')->nullable();
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by');
            $table->tinyInteger('is_transfer');
            $table->tinyInteger('is_editable');
            $table->decimal('other_cost', 10, 2);
            $table->decimal('other_cost_fc', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('subtotal_fc', 10, 2);
            $table->tinyInteger('is_import');
            $table->text('foot_description')->nullable();
            $table->string('prefix', 12)->nullable();
            $table->tinyInteger('is_intercompany')->nullable()->default("0");
            $table->string('doc_nos', 200)->nullable();
            $table->unique('voucher_no', 'voucher_no_2');
            $table->index(["voucher_no", "voucher_date", "document_type", "document_id", "job_id", "location_id", "is_fc", "currency_id", "supplier_id", "footer_id", "status", "deleted_at", "is_transfer", "is_editable"], 'voucher_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supplier_do');
    }
};
