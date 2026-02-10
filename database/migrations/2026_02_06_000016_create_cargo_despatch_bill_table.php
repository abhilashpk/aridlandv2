<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargo_despatch_bill', function (Blueprint $table) {
            $table->increments('id');
            $table->string('despatch_no', 45);
            $table->date('despatch_date');
            $table->string('clear_agent_sila', 150);
            $table->string('clear_agent', 150);
            $table->string('vehicle_no', 45);
            $table->string('driver', 100);
            $table->string('loading_place', 110);
            $table->string('offloading_place', 110);
            $table->string('mob_uae', 45);
            $table->string('mob_ksa', 45);
            $table->text('cargo_waybill_ids');
            $table->decimal('total_amount', 10, 2);
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at')->nullable();
            $table->integer('modify_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->decimal('other_charge', 10, 2);
            $table->decimal('advance', 10, 2);
            $table->decimal('balance', 10, 2);
            $table->string('agreed_amt', 100);
            $table->string('agreed_transport', 100);
            $table->string('add1_col', 100);
            $table->string('add2_col', 100);
            $table->string('add3_col', 100);
            $table->string('add_col1', 100);
            $table->string('add_col2', 100);
            $table->string('add_col3', 100);
            $table->tinyInteger('status');
            $table->string('attachment', 150);
            $table->string('remarks', 200);
            $table->string('payment_at', 200);
            $table->string('weight', 45);
            $table->string('volume', 45);
            $table->tinyInteger('status_id');
            $table->string('container_type', 25);
            $table->decimal('duty_amt', 10, 2);
            $table->index('despatch_no', 'despatch_no');
            $table->index('despatch_date', 'despatch_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargo_despatch_bill');
    }
};
