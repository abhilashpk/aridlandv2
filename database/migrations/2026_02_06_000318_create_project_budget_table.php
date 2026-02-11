<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_budget', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('budgeting_id');
            $table->integer('ac_id');
            $table->decimal('amount', 10, 2);
            $table->dateTime('created_at');
            $table->string('description', 100);
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('is_log');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_budget');
    }
};
