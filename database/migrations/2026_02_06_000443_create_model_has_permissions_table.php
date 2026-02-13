<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('model_id');
            $table->string('model_type', 191);
            $table->index(['model_id', 'model_type'], 'model_has_permissions_model_id_model_type_index');
            $table->index('permission_id', 'model_has_permissions_permission_id_foreign');
            $table->foreign('permission_id', 'model_has_permissions_permission_id_foreign')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('model_has_permissions');
    }
};
