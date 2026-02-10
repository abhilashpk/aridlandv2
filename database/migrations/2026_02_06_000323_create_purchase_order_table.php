<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 50);
            $table->string('reference_no', 50)->nullable();
            $table->string('description', 180)->nullable();
            $table->integer('supplier_id');
            $table->date('voucher_date');
            $table->date('lpo_date')->nullable();
            $table->string('document_type', 15)->nullable();
            $table->integer('document_id')->nullable();
            $table->integer('terms_id')->nullable();
            $table->integer('job_id')->nullable();
            $table->tinyInteger('is_fc')->default("0");
            $table->integer('currency_id')->nullable();
            $table->float('currency_rate')->nullable();
            $table->integer('header_id')->nullable();
            $table->integer('footer_id')->nullable();
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
            $table->tinyInteger('is_transfer')->nullable()->default("0");
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_editable')->nullable()->default("0");
            $table->tinyInteger('is_import')->default("0");
            $table->decimal('other_cost', 10, 2)->nullable();
            $table->decimal('other_cost_fc', 10, 2)->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('subtotal_fc', 10, 2);
            $table->integer('location_id')->nullable();
            $table->text('foot_description')->nullable();
            $table->integer('deleted_by');
            $table->tinyInteger('approval_status')->default("0");
            $table->tinyInteger('is_settled')->default("0");
            $table->tinyInteger('is_draft')->default("0");
            $table->string('prefix', 12)->nullable();
            $table->tinyInteger('is_intercompany')->nullable();
            $table->string('doc_nos', 150)->nullable();
            $table->unique('voucher_no', 'voucher_no_2');
            $table->index(["voucher_no", "supplier_id", "voucher_date", "terms_id", "job_id", "is_fc", "currency_id", "currency_rate"], 'voucher_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_order');
    }
};
