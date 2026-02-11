<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_requisition', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 100);
            $table->date('voucher_date');
            $table->integer('job_id')->nullable();
            $table->string('description', 290)->nullable();
            $table->integer('salesman_id')->nullable();
            $table->decimal('total', 10, 2);
            $table->float('discount')->nullable();
            $table->decimal('net_amount', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_transfer');
            $table->integer('supplier_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->text('foot_description')->nullable();
            $table->tinyInteger('approval_status')->nullable();
            $table->integer('approved_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->integer('department_id');
            $table->string('prefix', 10)->nullable();
            $table->integer('locfrom_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_requisition');
    }
};
