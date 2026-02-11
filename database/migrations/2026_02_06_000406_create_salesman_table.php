<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salesman', function (Blueprint $table) {
            $table->increments('id');
            $table->string('salesman_id', 45);
            $table->string('name', 100);
            $table->string('address1', 120)->nullable();
            $table->string('address2', 120)->nullable();
            $table->string('telephone', 25)->nullable();
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index(["salesman_id", "name", "status", "deleted_at"], 'salesman_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salesman');
    }
};
