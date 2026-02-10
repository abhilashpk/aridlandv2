<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flat_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('flat_id');
            $table->string('photo', 220)->nullable();
            $table->index('flat_id', 'flat_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flat_photos');
    }
};
