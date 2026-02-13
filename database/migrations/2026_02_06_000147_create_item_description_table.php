<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_description', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_type', 10);
            $table->integer('item_detail_id');
            $table->text('description');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index('deleted_at', 'deleted_at');
            $table->index('invoice_type', 'invoice_type');
            $table->index('item_detail_id', 'item_detail_id');
            $table->index('status', 'status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_description');
    }
};
