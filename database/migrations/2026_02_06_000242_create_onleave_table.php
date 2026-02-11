<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('onleave', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->date('start_date');
            $table->decimal('airtkt_amount', 10, 2);
            $table->float('alo_leave_days');
            $table->float('months_worked');
            $table->float('cal_leave_days');
            $table->decimal('cal_leave_salary', 10, 2);
            $table->decimal('leave_advance', 10, 2);
            $table->decimal('paid_leave_salary', 10, 2);
            $table->tinyInteger('leave_status');
            $table->tinyInteger('status');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('deleted_at')->nullable();
            $table->date('rejoin_date');
            $table->index('employee_id', 'employee_id');
            $table->index('start_date', 'start_date');
            $table->index('status', 'status');
            $table->index('deleted_at', 'deleted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('onleave');
    }
};
