<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bud_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('building_id');
            $table->string('photo', 150);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bud_photos');
    }
};
