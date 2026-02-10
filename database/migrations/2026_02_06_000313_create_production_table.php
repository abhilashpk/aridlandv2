<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 50);
            $table->string('reference_no', 50);
            $table->date('voucher_date');
            $table->date('lpo_date');
            $table->integer('customer_id');
            $table->tinyInteger('document_type');
            $table->integer('document_id');
            $table->string('description', 120);
            $table->integer('terms_id');
            $table->integer('job_id');
            $table->tinyInteger('is_fc');
            $table->integer('currency_id');
            $table->float('currency_rate');
            $table->integer('footer_id');
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
            $table->integer('salesman_id');
            $table->tinyInteger('is_export');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('subtotal_fc', 10, 2);
            $table->tinyInteger('doc_status');
            $table->text('comment');
            $table->text('foot_description');
            $table->index('voucher_no', 'voucher_no');
            $table->index('reference_no', 'reference_no');
            $table->index('voucher_date', 'voucher_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production');
    }
};
