<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobmaster', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 80);
            $table->string('name', 120);
            $table->float('open_cost');
            $table->integer('customer_id');
            $table->integer('department_id');
            $table->integer('salesman_id');
            $table->float('open_income');
            $table->tinyInteger('is_close');
            $table->float('contract_amount');
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('incexp');
            $table->integer('vehicle_id');
            $table->tinyInteger('is_salary_job');
            $table->string('transport_type', 55);
            $table->string('packing', 55);
            $table->date('date');
            $table->string('address', 120);
            $table->string('mbl', 55);
            $table->string('house_bl_no', 55);
            $table->string('origin', 120);
            $table->string('hbl', 55);
            $table->string('por', 55);
            $table->string('fnd', 120);
            $table->float('no_of_pieces');
            $table->float('volume');
            $table->float('gross_weight');
            $table->string('destination', 120);
            $table->string('flight_no', 55);
            $table->float('chargeable_weight');
            $table->string('be_no', 55);
            $table->date('flight_date');
            $table->string('container_no', 55);
            $table->tinyInteger('is_subjob');
            $table->string('shipper', 150);
            $table->string('consignee', 150);
            $table->index(["code", "name", "customer_id", "department_id", "salesman_id", "is_close", "start_date", "end_date", "status", "deleted_at", "incexp", "vehicle_id", "is_salary_job"], 'code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobmaster');
    }
};
