<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('design_view', function (Blueprint $table) {
            $table->integer('id');
            $table->string('view_name', 200);
            $table->primary('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('design_view');
    }
};
