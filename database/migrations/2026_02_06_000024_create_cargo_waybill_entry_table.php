<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargo_waybill_entry', function (Blueprint $table) {
            $table->integer('waybill_id');
            $table->integer('jobentry_id');
            $table->float('loaded_qty');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargo_waybill_entry');
    }
};
