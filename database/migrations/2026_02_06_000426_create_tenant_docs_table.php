<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenant_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenant_id');
            $table->string('photo', 120);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_docs');
    }
};
