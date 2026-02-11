<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bin_location', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 50)->nullable();
            $table->string('name', 120)->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bin_location');
    }
};
