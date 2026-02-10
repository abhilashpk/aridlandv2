<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('guard_name', 255)->default("web");
            $table->string('display_name', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->timestamps();

            $table->unique('name', 'roles_name_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
