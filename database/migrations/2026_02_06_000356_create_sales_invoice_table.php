<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id');
            $table->string('voucher_no', 50);
            $table->string('reference_no', 50)->nullable();
            $table->date('voucher_date');
            $table->date('lpo_date')->nullable();
            $table->integer('customer_id');
            $table->integer('dr_account_id');
            $table->integer('cr_account_id');
            $table->string('document_type', 10)->nullable();
            $table->string('document_id', 55)->nullable();
            $table->string('description', 120)->nullable();
            $table->integer('terms_id')->nullable();
            $table->integer('job_id')->nullable();
            $table->tinyInteger('is_fc')->nullable();
            $table->integer('currency_id')->nullable();
            $table->float('currency_rate')->nullable();
            $table->integer('footer_id')->nullable();
            $table->decimal('total', 10, 2);
            $table->float('discount');
            $table->decimal('vat_amount', 10, 2);
            $table->decimal('net_total', 10, 2);
            $table->decimal('total_fc', 10, 2);
            $table->float('discount_fc');
            $table->decimal('vat_amount_fc', 10, 2);
            $table->decimal('net_total_fc', 10, 2);
            $table->tinyInteger('is_transfer')->nullable()->default("0");
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('amount_transfer')->nullable();
            $table->float('balance_amount')->nullable();
            $table->tinyInteger('is_editable')->nullable()->default("0");
            $table->string('customer_name', 120)->nullable();
            $table->string('customer_phone', 80)->nullable();
            $table->string('lpo_no', 45)->nullable();
            $table->integer('salesman_id')->nullable();
            $table->tinyInteger('is_export');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('subtotal_fc', 10, 2);
            $table->integer('location_id')->nullable();
            $table->integer('department_id');
            $table->integer('vehicle_id')->nullable();
            $table->string('customer_trn', 85)->nullable();
            $table->tinyInteger('is_rventry')->nullable();
            $table->decimal('advance', 10, 2)->nullable();
            $table->decimal('balance', 10, 2)->nullable();
            $table->string('kilometer', 45)->nullable();
            $table->tinyInteger('job_type')->nullable();
            $table->tinyInteger('jobnature')->nullable();
            $table->string('fabrication', 200)->nullable();
            $table->decimal('less_amount', 10, 2)->nullable();
            $table->string('less_description', 150)->nullable();
            $table->string('previnv_description', 150)->nullable();
            $table->decimal('previnv_amount', 10, 2)->nullable();
            $table->decimal('less_amount2', 10, 2)->nullable();
            $table->string('less_description2', 150)->nullable();
            $table->decimal('less_amount3', 10, 2)->nullable();
            $table->string('less_description3', 150)->nullable();
            $table->decimal('net_total_pay', 10, 2);
            $table->tinyInteger('doc_status');
            $table->text('comment')->nullable();
            $table->string('so_no', 15)->nullable();
            $table->string('vehicle_no', 100)->nullable();
            $table->decimal('roundoff', 10, 2);
            $table->decimal('total_roundoff', 10, 2);
            $table->tinyInteger('is_rental');
            $table->decimal('other_cost', 8, 2)->nullable();
            $table->string('items_description', 150)->nullable();
            $table->text('foot_description')->nullable();
            $table->string('doc_ids', 100)->nullable();
            $table->string('doc_nos', 200)->nullable();
            $table->string('metre_in', 250)->nullable();
            $table->string('metre_out', 250)->nullable();
            $table->integer('deleted_by');
            $table->smallInteger('duedays')->nullable();
            $table->date('due_date');
            $table->tinyInteger('is_cash');
            $table->string('prefix', 25)->nullable();
            $table->tinyInteger('is_intercompany');
            $table->unique('voucher_no', 'voucher_no');
            $table->index('so_no', 'so_no');
            $table->index(["voucher_id", "voucher_no", "voucher_date", "customer_id", "dr_account_id", "cr_account_id"], 'voucher_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_invoice');
    }
};
