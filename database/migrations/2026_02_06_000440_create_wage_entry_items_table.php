<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wage_entry_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wage_entry_id');
            $table->string('day', 45);
            $table->integer('job_id');
            $table->float('wage');
            $table->integer('nodays');
            $table->float('nwh');
            $table->float('otg');
            $table->float('oth');
            $table->decimal('allowance', 10, 2);
            $table->decimal('total_wage', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('leave_type');
            $table->tinyInteger('is_salary');
            $table->text('job_data');
            $table->tinyInteger('leave_status');
            $table->string('leave_reason', 250);
            $table->float('otg_wage');
            $table->float('oth_wage');
            $table->date('job_date');
            $table->index('wage_entry_id', 'wage_entry_id');
            $table->index('job_id', 'job_id');
            $table->index('status', 'status');
            $table->index('deleted_at', 'deleted_at');
            $table->index('leave_type', 'leave_type');
            $table->index('is_salary', 'is_salary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wage_entry_items');
    }
};
