<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_view_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_view_id');
            $table->string('name', 150);
            $table->string('print_name', 250);
            $table->tinyInteger('is_default');
            $table->index('report_view_id', 'report_view_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_view_detail');
    }
};
