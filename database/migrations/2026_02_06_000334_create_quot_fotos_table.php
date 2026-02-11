<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quot_fotos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quot_id');
            $table->string('photo', 120);
            $table->string('description', 250);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quot_fotos');
    }
};
