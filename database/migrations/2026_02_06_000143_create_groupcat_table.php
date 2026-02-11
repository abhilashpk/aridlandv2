<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('groupcat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group_name', 150);
            $table->string('description', 150)->nullable();
            $table->tinyInteger('parent_id')->nullable();
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index('group_name', 'group_name');
            $table->index('parent_id', 'parent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groupcat');
    }
};
