<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_id');
            $table->string('title', 80);
            $table->string('description', 100);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index(["quotation_id", "status", "deleted_at"], 'quotation_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_info');
    }
};
