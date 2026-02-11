<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->string('description', 300);
            $table->float('amount');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_master');
    }
};
