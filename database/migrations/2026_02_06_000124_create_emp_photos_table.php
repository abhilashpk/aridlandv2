<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emp_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('photo', 250);
            $table->string('type', 15);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emp_photos');
    }
};
