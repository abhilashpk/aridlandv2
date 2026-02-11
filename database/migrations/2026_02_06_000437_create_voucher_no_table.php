<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voucher_no', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_type', 10);
            $table->integer('no');
            $table->tinyInteger('status');
            $table->string('name', 80);
            $table->string('prefix', 15);
            $table->tinyInteger('autoincrement');
            $table->dateTime('modified_at')->nullable();
            $table->tinyInteger('department_id')->nullable();
            $table->index(["voucher_type", "no", "status"], 'voucher_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_no');
    }
};
