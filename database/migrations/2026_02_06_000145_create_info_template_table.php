<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('info_template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('doc_type', 4);
            $table->tinyInteger('colno');
            $table->string('label1', 80);
            $table->tinyInteger('reqd1');
            $table->string('label2', 80);
            $table->tinyInteger('reqd2');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('info_template');
    }
};
