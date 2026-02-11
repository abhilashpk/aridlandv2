<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_enquiry', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prefix', 20);
            $table->string('voucher_no', 100);
            $table->date('voucher_date');
            $table->integer('job_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('locfrom_id');
            $table->string('description', 290)->nullable();
            $table->integer('salesman_id')->nullable();
            $table->decimal('total', 10, 2);
            $table->float('discount');
            $table->decimal('net_amount', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_transfer')->nullable()->default("0");
            $table->integer('supplier_id')->nullable();
            $table->integer('location_id');
            $table->text('foot_description')->nullable();
            $table->tinyInteger('approval_status')->nullable()->default("0");
            $table->integer('approved_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->tinyInteger('is_intercompany')->nullable()->default("0");
            $table->tinyInteger('is_draft')->nullable()->default("0");
            $table->unique('voucher_no', 'voucher_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_enquiry');
    }
};
