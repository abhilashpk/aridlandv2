<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_connection', function (Blueprint $table) {
            $table->increments('id');
            $table->string('connection_no', 45);
            $table->date('date');
            $table->integer('building_id');
            $table->integer('flat_id');
            $table->integer('customer_id');
            $table->decimal('grand_total', 10, 2);
            $table->tinyInteger('is_rv')->nullable();
            $table->dateTime('created_at');
            $table->smallInteger('created_by');
            $table->dateTime('modify_at')->nullable();
            $table->smallInteger('modify_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->smallInteger('deleted_by')->nullable();
            $table->tinyInteger('status');
            $table->string('sin_no', 45);
            $table->decimal('rv_amount', 10, 2);
            $table->float('new_reading');
            $table->tinyInteger('is_close');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_connection');
    }
};
