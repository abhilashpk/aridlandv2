<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flat_fotos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('flat_id');
            $table->string('photo', 120);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flat_fotos');
    }
};
