<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobtype', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('job_no');
            $table->index('name', 'name');
            $table->index('status', 'status');
            $table->index('deleted_at', 'deleted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobtype');
    }
};
