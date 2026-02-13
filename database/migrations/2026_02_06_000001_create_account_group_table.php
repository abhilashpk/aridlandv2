<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('name', 100);
            $table->string('code', 10);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->string('category', 12)->nullable();
            $table->index('category', 'category');
            $table->index('category_id', 'category_id');
            $table->index('name', 'name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_group');
    }
};
