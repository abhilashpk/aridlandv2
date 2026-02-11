<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advdashboard_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 85);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advdashboard_details');
    }
};
