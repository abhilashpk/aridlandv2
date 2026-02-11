<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ms_wo_time', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workorder_id');
            $table->time('time_in');
            $table->time('time_out');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_wo_time');
    }
};
