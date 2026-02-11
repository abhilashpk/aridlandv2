<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supersede', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->text('items');
            $table->dateTime('deleted_at')->nullable();
            $table->index('item_id', 'item_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supersede');
    }
};
