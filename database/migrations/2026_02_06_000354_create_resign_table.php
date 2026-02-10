<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resign', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->date('resign_date');
            $table->decimal('airtkt_amount', 10, 2);
            $table->tinyInteger('resign_type');
            $table->float('months_worked');
            $table->float('cal_leave_days');
            $table->decimal('cal_leave_salary', 10, 2);
            $table->float('years_worked');
            $table->decimal('gratuity', 10, 2);
            $table->decimal('leave_advance', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('deleted_at')->nullable();
            $table->index('employee_id', 'employee_id');
            $table->index('status', 'status');
            $table->index('deleted_at', 'deleted_at');
            $table->index('resign_date', 'resign_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resign');
    }
};
