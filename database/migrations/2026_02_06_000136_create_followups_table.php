<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('followups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lead_id');
            $table->date('date');
            $table->string('title', 200);
            $table->text('description');
            $table->tinyInteger('status');
            $table->integer('created_by');
            $table->dateTime('created_at')->useCurrent();
            $table->integer('modified_by');
            $table->dateTime('modified_at');
            $table->integer('deleted_by');
            $table->dateTime('deleted_at')->nullable();
            $table->index(["lead_id", "date", "status", "deleted_at"], 'lead_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('followups');
    }
};
