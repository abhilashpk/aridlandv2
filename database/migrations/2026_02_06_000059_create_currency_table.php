<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('currency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 40);
            $table->string('name', 55);
            $table->float('rate')->nullable();
            $table->string('fracode', 10)->nullable();
            $table->tinyInteger('decimal_place')->nullable();
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_default');
            $table->string('decimal_name', 45)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currency');
    }
};
