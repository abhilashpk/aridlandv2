<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('department_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id');
            $table->integer('stock_acid');
            $table->integer('cost_acid');
            $table->integer('costdif_acid');
            $table->integer('purdis_acid');
            $table->integer('saledis_acid');
            $table->integer('stock_excess_acid');
            $table->integer('stock_shortage_acid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('department_accounts');
    }
};
