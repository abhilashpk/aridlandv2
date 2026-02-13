<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 45);
            $table->string('reference_no', 45)->nullable();
            $table->date('voucher_date');
            $table->integer('customer_id');
            $table->integer('department_id');
            $table->integer('salesman_id');
            $table->string('subject', 85)->nullable();
            $table->string('description', 120)->nullable();
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
            $table->tinyInteger('doc_status');
            $table->text('comment');
            $table->integer('customer_enquiry_id');
            $table->integer('location_id');
            $table->tinyInteger('is_rental');
            $table->string('items_description', 150);
            $table->text('foot_description');
            $table->string('metre_in', 250);
            $table->string('metre_out', 250);
            $table->integer('document_id');
            $table->string('document_type', 5);
            $table->string('document_no', 200);
            $table->tinyInteger('approval_status');
            $table->integer('deleted_by');
            $table->tinyInteger('is_draft');
            $table->unique('voucher_no', 'voucher_no_2');
            $table->index(["voucher_no", "voucher_date", "customer_id", "salesman_id", "job_id", "header_id", "footer_id", "is_fc"], 'voucher_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_sales');
    }
};
