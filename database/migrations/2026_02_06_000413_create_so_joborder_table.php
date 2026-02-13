<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('so_joborder', function (Blueprint $table) {
            $table->increments('id');
            $table->text('job_value');
            $table->text('updated_qty');
            $table->text('updated_subqty');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('so_joborder');
    }
};
