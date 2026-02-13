<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wage_entry', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entry_type', 40);
            $table->string('year', 40);
            $table->string('month', 20);
            $table->date('payment_date');
            $table->integer('employee_id');
            $table->float('absent_hrs');
            $table->float('sick_leave');
            $table->float('paid_leave');
            $table->decimal('loan', 10, 2);
            $table->float('net_basic');
            $table->float('net_hra');
            $table->float('net_allowance');
            $table->float('net_otg');
            $table->float('net_oth');
            $table->float('net_total');
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->float('deductions');
            $table->float('othr_allowance');
            $table->tinyInteger('unpaid_leave');
            $table->float('otgs_total');
            $table->float('oths_total');
            $table->integer('wdays_total');
            $table->index('payment_date', 'payment_date');
            $table->index('entry_type', 'entry_type');
            $table->index('month', 'month');
            $table->index('employee_id', 'employee_id');
            $table->index('deleted_at', 'deleted_at');
            $table->index('status', 'status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wage_entry');
    }
};
