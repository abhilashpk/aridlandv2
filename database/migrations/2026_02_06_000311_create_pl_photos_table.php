<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pl_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timesheet_id');
            $table->string('photo', 250);
            $table->string('description', 350);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pl_photos');
    }
};
