<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('division', function (Blueprint $table) {
            $table->increments('id');
            $table->string('div_code', 45);
            $table->string('div_name', 100);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('division');
    }
};
