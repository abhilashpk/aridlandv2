<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('machine', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->string('model', 100);
            $table->string('serialno', 150);
            $table->string('brand', 50);
            $table->string('media', 50);
            $table->string('type', 10);
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('machine');
    }
};
