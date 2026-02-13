<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('guard_name', 255)->default("web");
            $table->string('display_name', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->timestamps();

            $table->string('section', 40);
            $table->unique('name', 'permissions_name_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
