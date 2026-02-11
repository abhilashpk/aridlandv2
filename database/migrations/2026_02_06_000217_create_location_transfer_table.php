<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('location_transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 50);
            $table->string('reference_no', 50)->nullable();
            $table->string('description', 180)->nullable();
            $table->integer('locfrom_id');
            $table->integer('locto_id');
            $table->date('voucher_date');
            $table->float('total');
            $table->tinyInteger('status');
            $table->integer('department_id')->nullable();
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at');
            $table->integer('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->string('type', 5)->nullable();
            $table->integer('typeid')->nullable();
            $table->string('prefix', 12)->nullable();
            $table->index(["voucher_no", "locfrom_id", "locto_id", "voucher_date", "status", "deleted_at"], 'voucher_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('location_transfer');
    }
};
