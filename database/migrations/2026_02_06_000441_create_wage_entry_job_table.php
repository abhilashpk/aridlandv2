<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wage_entry_job', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wage_entry_items_id');
            $table->integer('job_id');
            $table->tinyInteger('job_type');
            $table->float('hour');
            $table->index('wage_entry_items_id', 'wage_entry_items_id');
            $table->index('job_id', 'job_id');
            $table->index('job_type', 'job_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wage_entry_job');
    }
};
