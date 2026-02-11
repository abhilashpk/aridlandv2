<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();

            $table->integer('department_id');
            $table->integer('location_id');
            $table->integer('role_id');
            $table->timestamp('deleted_at')->nullable();
            $table->unique('email', 'users_email_unique');
            $table->index(["name", "email", "password"], 'name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
