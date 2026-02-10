<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_order_gi', function (Blueprint $table) {
            $table->integer('row_id');
            $table->integer('gi_id');
            $table->integer('so_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_order_gi');
    }
};
