<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parameter2', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->tinyInteger('is_active');
            $table->tinyInteger('status');
            $table->string('keyname', 150);
            $table->index('keyname', 'keyname');
            $table->index(["status", "keyname"], 'status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parameter2');
    }
};
