<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_document', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('name', 200);
            $table->string('description', 300);
            $table->string('file_name', 150);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->index(["employee_id", "name", "status", "deleted_at"], 'employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_document');
    }
};
