<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voucher_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 55);
            $table->tinyInteger('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_type');
    }
};
