<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parameter3', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id');
            $table->integer('account_id');
            $table->index(["location_id", "account_id"], 'location_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parameter3');
    }
};
