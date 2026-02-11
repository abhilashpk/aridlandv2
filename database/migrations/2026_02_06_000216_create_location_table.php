<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('location', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 45);
            $table->string('name', 55);
            $table->tinyInteger('is_default');
            $table->tinyInteger('status');
            $table->integer('department_id')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_conloc')->nullable();
            $table->integer('customer_id')->nullable();
            $table->tinyInteger('is_minus_qty')->nullable();
            $table->index(["code", "name", "is_default", "status", "deleted_at"], 'code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('location');
    }
};
