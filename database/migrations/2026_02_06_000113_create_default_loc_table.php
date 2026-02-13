<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('default_loc', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('pur_loc');
            $table->integer('sales_loc');
            $table->integer('mfg_loc');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('default_loc');
    }
};
