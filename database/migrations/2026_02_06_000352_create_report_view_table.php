<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_view', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 45);
            $table->string('name', 200);
            $table->string('view_name', 200);
            $table->tinyInteger('status');
            $table->index(["code", "status"], 'code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_view');
    }
};
