<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_do', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 50);
            $table->string('reference_no', 50)->nullable();
            $table->date('voucher_date');
            $table->date('lpo_date')->nullable();
            $table->integer('customer_id');
            $table->string('document_type', 50)->nullable();
            $table->string('document_id', 150)->nullable();
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
            $table->tinyInteger('is_transfer');
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by');
            $table->tinyInteger('is_editable');
            $table->integer('salesman_id')->nullable();
            $table->tinyInteger('is_export')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('subtotal_fc', 10, 2);
            $table->tinyInteger('doc_status')->nullable();
            $table->text('comment')->nullable();
            $table->integer('location_id')->nullable();
            $table->text('foot_description')->nullable();
            $table->string('prefix', 25)->nullable();
            $table->integer('department_id');
            $table->tinyInteger('is_intercompany');
            $table->string('doc_nos', 255)->nullable();
            $table->unique('voucher_no', 'voucher_no_2');
            $table->index('reference_no', 'reference_no');
            $table->index('voucher_date', 'voucher_date');
            $table->index('voucher_no', 'voucher_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_do');
    }
};
