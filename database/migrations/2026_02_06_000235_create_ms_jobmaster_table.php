<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ms_jobmaster', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 100);
            $table->string('name', 120);
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_jobmaster');
    }
};
