<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unit_name', 100);
            $table->string('description', 120)->nullable();
            $table->tinyInteger('fracount')->nullable();
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index(["unit_name", "description", "status", "deleted_at"], 'unit_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
