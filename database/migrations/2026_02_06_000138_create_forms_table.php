<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 85);
            $table->string('name', 85);
            $table->tinyInteger('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
