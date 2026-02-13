<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('joborder_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('joborder_id');
            $table->text('description');
            $table->text('comment');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index('joborder_id', 'joborder_id');
            $table->index('status', 'status');
            $table->index('deleted_at', 'deleted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('joborder_details');
    }
};
