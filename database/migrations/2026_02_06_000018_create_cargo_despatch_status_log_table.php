<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargo_despatch_status_log', function (Blueprint $table) {
            $table->integer('despatch_id');
            $table->tinyInteger('status_id');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->date('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargo_despatch_status_log');
    }
};
