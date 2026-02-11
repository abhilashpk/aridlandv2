<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('name', 85);
            $table->string('reg_no', 45);
            $table->string('make', 85)->nullable();
            $table->string('color', 45)->nullable();
            $table->string('engine_no', 45)->nullable();
            $table->string('chasis_no', 45)->nullable();
            $table->string('owner', 45)->nullable();
            $table->string('km_done', 45)->nullable();
            $table->tinyInteger('status')->default("1");
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_cashsale')->nullable();
            $table->string('customer_name', 45)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('model', 85)->nullable();
            $table->string('year', 45)->nullable();
            $table->string('plate_type', 50)->nullable();
            $table->string('issue_plate', 100)->nullable();
            $table->string('code_plate', 85)->nullable();
            $table->string('color_code', 45)->nullable();
            $table->index(["customer_id", "name", "reg_no", "status", "deleted_at", "is_cashsale", "customer_name", "phone"], 'customer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle');
    }
};
