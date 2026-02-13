<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_do_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_do_id');
            $table->string('title', 150);
            $table->string('description', 250);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_do_info');
    }
};
