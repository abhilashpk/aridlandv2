<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budgeting', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id');
            $table->decimal('total', 10, 2);
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('modified_at');
            $table->decimal('total_cost', 10, 2);
            $table->decimal('total_income', 10, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budgeting');
    }
};
