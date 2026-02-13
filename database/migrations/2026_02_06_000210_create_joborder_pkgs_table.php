<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('joborder_pkgs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_order_id');
            $table->integer('package_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('joborder_pkgs');
    }
};
