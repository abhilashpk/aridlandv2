<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_enquiry', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 45);
            $table->string('reference_no', 45);
            $table->date('voucher_date');
            $table->integer('customer_id');
            $table->integer('salesman_id');
            $table->string('subject', 85);
            $table->string('description', 120);
            $table->integer('job_id');
            $table->integer('header_id');
            $table->integer('footer_id');
            $table->tinyInteger('is_fc');
            $table->integer('currency_id');
            $table->float('currency_rate');
            $table->decimal('total', 10, 2);
            $table->decimal('vat_amount', 10, 2);
            $table->float('discount');
            $table->decimal('net_total', 10, 2);
            $table->decimal('total_fc', 10, 2);
            $table->float('discount_fc');
            $table->decimal('net_total_fc', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_transfer');
            $table->tinyInteger('is_editable');
            $table->decimal('vat_amount_fc', 10, 2);
            $table->tinyInteger('is_export');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('subtotal_fc', 10, 2);
            $table->integer('vehicle_id');
            $table->tinyInteger('job_type');
            $table->tinyInteger('jobnature');
            $table->string('fabrication', 200);
            $table->string('prefix', 15);
            $table->string('kilometer', 45);
            $table->text('footer_text');
            $table->integer('terms_id');
            $table->integer('lead_id');
            $table->tinyInteger('doc_status');
            $table->text('comment');
            $table->integer('location_id');
            $table->integer('deleted_by');
            $table->index(["voucher_no", "voucher_date", "customer_id", "salesman_id", "job_id", "header_id", "footer_id", "is_fc", "currency_id", "status", "deleted_at", "is_transfer", "is_editable", "is_export", "vehicle_id", "job_type"], 'voucher_no');
            $table->index('lead_id', 'lead_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_enquiry');
    }
};
