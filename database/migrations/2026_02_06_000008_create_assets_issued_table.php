<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets_issued', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('name', 150);
            $table->string('description', 300);
            $table->date('issue_date');
            $table->tinyInteger('asset_status');
            $table->date('received_date');
            $table->string('othr_description', 300);
            $table->integer('status');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('deleted_at')->nullable();
            $table->index('employee_id', 'employee_id');
            $table->index('name', 'name');
            $table->index('asset_status', 'asset_status');
            $table->index(["status", "deleted_at"], 'status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets_issued');
    }
};
