<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_rvs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id');
            $table->integer('rv_id');
            $table->tinyInteger('installment')->nullable();
            $table->decimal('amount', 20, 2);
            $table->string('type', 5);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_rvs');
    }
};
