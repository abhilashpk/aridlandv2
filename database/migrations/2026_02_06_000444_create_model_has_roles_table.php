<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('model_id');
            $table->string('model_type', 255);
            $table->index('role_id', 'model_has_roles_role_id_foreign');
            $table->foreign('role_id', 'model_has_roles_role_id_foreign')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('model_has_roles');
    }
};
