<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parameter4', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('payroll_by');
            $table->float('nwh');
            $table->float('ot_general');
            $table->float('ot_holiday');
            $table->string('ot_calculation', 45);
            $table->string('holiday', 10);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parameter4');
    }
};
