<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('header_footer', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('is_header');
            $table->string('title', 80);
            $table->text('description');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->string('doc', 5);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('header_footer');
    }
};
