<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->string('name', 100);
            $table->tinyInteger('actype');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->string('trtype', 5);
            $table->index('parent_id', 'parent_id');
            $table->index('actype', 'actype');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_category');
    }
};
