<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timesheet_entry', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('month');
            $table->string('day_type', 45);
            $table->integer('employee_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('break_time', 50);
            $table->float('twh');
            $table->float('nwh');
            $table->float('otg');
            $table->float('oth');
            $table->integer('job_id');
            $table->tinyInteger('leave_type');
            $table->string('leave_status', 15);
            $table->string('leave_reason', 400);
            $table->integer('subjob_id');
            $table->tinyInteger('is_approved');
            $table->dateTime('created_at');
            $table->dateTime('modified_at');
            $table->tinyInteger('leave_approve');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timesheet_entry');
    }
};
