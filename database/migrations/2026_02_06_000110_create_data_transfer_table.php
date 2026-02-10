<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from_transfer', 100);
            $table->string('to_transfer', 100);
            $table->integer('crm_id');
            $table->dateTime('created_at');
            $table->integer('crm_follow');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_transfer');
    }
};
