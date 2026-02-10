<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ms_workorder', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wo_no', 100);
            $table->dateTime('creation_datetime');
            $table->integer('job_id');
            $table->integer('location_id');
            $table->integer('customer_id');
            $table->text('description');
            $table->integer('type_id');
            $table->string('technician_id', 400);
            $table->float('total_time');
            $table->tinyInteger('status');
            $table->text('remarks');
            $table->dateTime('closed_datetime');
            $table->dateTime('created_at');
            $table->dateTime('modified_at');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('enquiry_id');
            $table->string('location', 250);
            $table->string('reference_no', 100);
            $table->index(["job_id", "location_id", "customer_id", "type_id", "technician_id"], 'job_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_workorder');
    }
};
