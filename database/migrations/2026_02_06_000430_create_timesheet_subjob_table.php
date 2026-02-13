<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timesheet_subjob', function (Blueprint $table) {
            $table->increments('id');
            $table->text('subjob_value');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timesheet_subjob');
    }
};
