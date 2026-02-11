<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id');
            $table->string('voucher_no', 50);
            $table->string('reference_no', 50);
            $table->date('voucher_date');
            $table->date('lpo_date')->nullable();
            $table->string('document_type', 15)->nullable();
            $table->integer('supplier_id');
            $table->string('document_id', 100)->nullable();
            $table->string('description', 120)->nullable();
            $table->integer('account_master_id');
            $table->integer('job_id')->nullable();
            $table->integer('terms_id')->nullable();
            $table->tinyInteger('is_fc');
            $table->integer('currency_id')->nullable();
            $table->float('currency_rate')->nullable();
            $table->decimal('total', 10, 2);
            $table->float('discount');
            $table->decimal('vat_amount', 10, 2);
            $table->decimal('net_amount', 10, 2);
            $table->decimal('total_fc', 10, 2);
            $table->float('discount_fc');
            $table->decimal('other_cost', 10, 2);
            $table->decimal('other_cost_fc', 10, 2);
            $table->decimal('vat_amount_fc', 10, 2);
            $table->decimal('net_amount_fc', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by');
            $table->tinyInteger('amount_transfer');
            $table->decimal('advance', 10, 2)->nullable();
            $table->decimal('balance_amount', 10, 2)->nullable();
            $table->tinyInteger('is_return');
            $table->tinyInteger('is_editable');
            $table->string('lpo_no', 45)->nullable();
            $table->tinyInteger('is_import');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('subtotal_fc', 10, 2);
            $table->integer('location_id');
            $table->string('po_no', 15)->nullable();
            $table->string('supplier_name', 150)->nullable();
            $table->integer('department_id');
            $table->text('foot_description')->nullable();
            $table->tinyInteger('is_pventry')->nullable()->default("0");
            $table->string('document_no', 45)->nullable();
            $table->smallInteger('duedays')->nullable();
            $table->date('due_date')->nullable();
            $table->string('prefix', 12)->nullable();
            $table->tinyInteger('is_intercompany')->nullable()->default("0");
            $table->string('doc_nos', 200)->nullable();
            $table->unique('voucher_no', 'voucher_no');
            $table->index(["voucher_id", "voucher_no", "voucher_date", "document_type", "supplier_id", "document_id", "account_master_id"], 'voucher_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_invoice');
    }
};
