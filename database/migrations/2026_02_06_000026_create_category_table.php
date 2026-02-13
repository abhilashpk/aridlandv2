<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name', 120);
            $table->string('description', 150)->nullable();
            $table->tinyInteger('parent_id')->nullable();
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index('category_name', 'category_name');
            $table->index('category_name', 'category_name_2');
            $table->index('parent_id', 'parent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
