<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contra_type_head', function (Blueprint $table) {
            $table->increments('id');
            $table->string('head', 45);
            $table->string('head_text', 150);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contra_type_head');
    }
};
