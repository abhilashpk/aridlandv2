<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_pvs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id');
            $table->integer('pv_id');
            $table->decimal('amount', 30, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_pvs');
    }
};
