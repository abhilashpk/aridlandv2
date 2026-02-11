<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lead_no', 45);
            $table->date('lead_date');
            $table->integer('customer_id');
            $table->text('description');
            $table->string('lead_status', 55);
            $table->tinyInteger('status');
            $table->integer('created_by');
            $table->dateTime('created_at')->useCurrent();
            $table->integer('modified_by');
            $table->dateTime('modified_at');
            $table->integer('deleted_by');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('customer_type');
            $table->integer('salesman_id');
            $table->index(["lead_no", "lead_date", "customer_id", "lead_status", "status", "deleted_at"], 'lead_no');
            $table->index('salesman_id', 'salesman_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
