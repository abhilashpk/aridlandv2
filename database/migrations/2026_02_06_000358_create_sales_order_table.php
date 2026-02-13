<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 45);
            $table->string('reference_no', 45)->nullable();
            $table->date('voucher_date');
            $table->date('lpo_date')->nullable();
            $table->string('quotation_id', 30)->nullable();
            $table->string('description', 120)->nullable();
            $table->integer('customer_id');
            $table->integer('job_id')->nullable();
            $table->integer('terms_id')->nullable();
            $table->tinyInteger('is_fc')->nullable();
            $table->integer('currency_id')->nullable();
            $table->float('currency_rate')->nullable();
            $table->integer('footer_id')->nullable();
            $table->decimal('total', 10, 2);
            $table->float('discount')->nullable();
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
            $table->integer('salesman_id')->nullable();
            $table->tinyInteger('is_export')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('subtotal_fc', 10, 2);
            $table->integer('vehicle_id')->nullable();
            $table->string('kilometer', 45)->nullable();
            $table->tinyInteger('job_type')->nullable();
            $table->tinyInteger('jobnature')->nullable();
            $table->string('fabrication', 200)->nullable();
            $table->string('prefix', 45)->nullable();
            $table->string('less_description', 150)->nullable();
            $table->decimal('less_amount', 10, 2)->nullable();
            $table->decimal('less_amount2', 10, 2)->nullable();
            $table->string('less_description2', 150)->nullable();
            $table->decimal('less_amount3', 10, 2)->nullable();
            $table->string('less_description3', 150)->nullable();
            $table->decimal('net_total_pay', 10, 2)->nullable();
            $table->string('footer_text', 300)->nullable();
            $table->tinyInteger('doc_status')->nullable();
            $table->text('comment')->nullable();
            $table->integer('location_id')->nullable();
            $table->string('start_time', 45)->nullable();
            $table->string('end_time', 45)->nullable();
            $table->tinyInteger('jctype')->nullable();
            $table->tinyInteger('is_warning')->nullable();
            $table->text('items_inside')->nullable();
            $table->text('remarks')->nullable();
            $table->string('signature', 150)->nullable();
            $table->string('fuel_level', 45)->nullable();
            $table->tinyInteger('is_rental')->nullable();
            $table->date('next_due')->nullable();
            $table->string('present_km', 45)->nullable();
            $table->string('service_km', 45)->nullable();
            $table->string('next_km', 45)->nullable();
            $table->string('items_description', 150)->nullable();
            $table->text('foot_description')->nullable();
            $table->string('metre_in', 250)->nullable();
            $table->string('metre_out', 250)->nullable();
            $table->tinyInteger('is_transfer_po')->nullable();
            $table->string('order_type', 40)->nullable();
            $table->integer('deleted_by');
            $table->tinyInteger('is_settled')->nullable()->default("0");
            $table->tinyInteger('is_draft');
            $table->smallInteger('duedays')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('department_id');
            $table->tinyInteger('is_intercompany');
            $table->unique('voucher_no', 'voucher_no_2');
            $table->index('vehicle_id', 'vehicle_id');
            $table->index('voucher_date', 'voucher_date');
            $table->index(["voucher_no", "quotation_id", "customer_id", "job_id", "terms_id", "is_fc", "currency_id", "footer_id", "is_transfer", "status", "is_editable", "salesman_id", "is_export", "job_type"], 'voucher_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_order');
    }
};
