<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proforma_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 45);
            $table->string('reference_no', 45);
            $table->date('voucher_date');
            $table->date('lpo_date');
            $table->string('quotation_id', 30);
            $table->string('description', 120);
            $table->integer('customer_id');
            $table->integer('job_id');
            $table->integer('terms_id');
            $table->tinyInteger('is_fc');
            $table->integer('currency_id');
            $table->float('currency_rate');
            $table->integer('footer_id');
            $table->decimal('total', 10, 2);
            $table->float('discount');
            $table->float('vat');
            $table->decimal('vat_amount', 10, 2);
            $table->decimal('net_total', 10, 2);
            $table->decimal('total_fc', 10, 2);
            $table->float('discount_fc');
            $table->float('vat_fc');
            $table->decimal('vat_amount_fc', 10, 2);
            $table->decimal('net_total_fc', 10, 2);
            $table->tinyInteger('is_transfer');
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_editable');
            $table->integer('salesman_id');
            $table->tinyInteger('is_export');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('subtotal_fc', 10, 2);
            $table->integer('vehicle_id');
            $table->string('kilometer', 45);
            $table->tinyInteger('job_type');
            $table->tinyInteger('jobnature');
            $table->string('fabrication', 200);
            $table->string('prefix', 45);
            $table->string('less_description', 150);
            $table->decimal('less_amount', 10, 2);
            $table->decimal('less_amount2', 10, 2);
            $table->string('less_description2', 150);
            $table->decimal('less_amount3', 10, 2);
            $table->string('less_description3', 150);
            $table->decimal('net_total_pay', 10, 2);
            $table->string('footer_text', 300);
            $table->tinyInteger('doc_status');
            $table->text('comment');
            $table->integer('location_id');
            $table->string('start_time', 45);
            $table->string('end_time', 45);
            $table->tinyInteger('jctype');
            $table->tinyInteger('is_warning');
            $table->text('items_inside');
            $table->text('remarks');
            $table->string('signature', 150);
            $table->string('fuel_level', 45);
            $table->tinyInteger('is_rental');
            $table->date('next_due');
            $table->string('present_km', 45);
            $table->string('service_km', 45);
            $table->string('next_km', 45);
            $table->index('vehicle_id', 'vehicle_id');
            $table->index('voucher_date', 'voucher_date');
            $table->index(["voucher_no", "quotation_id", "customer_id", "job_id", "terms_id", "is_fc", "currency_id", "footer_id", "is_transfer", "status", "is_editable", "salesman_id", "is_export", "job_type"], 'voucher_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proforma_invoice');
    }
};
