<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_order_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_order_id');
            $table->string('title', 80);
            $table->string('description', 100);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index(["purchase_order_id", "status", "deleted_at"], 'purchase_order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_order_info');
    }
};
