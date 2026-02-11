<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_prepaid', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id');
            $table->integer('account_id')->nullable();
            $table->decimal('amount', 20, 2)->nullable();
            $table->decimal('tax_amount', 10, 2)->nullable();
            $table->tinyInteger('is_add');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_prepaid');
    }
};
