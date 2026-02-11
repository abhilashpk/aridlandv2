<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 45);
            $table->string('description', 150)->nullable();
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->string('file', 110)->nullable();
            $table->index(["code", "status", "deleted_at"], 'code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('terms');
    }
};
