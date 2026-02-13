<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reconciliation', function (Blueprint $table) {
            $table->integer('trid');
            $table->integer('account_id');
            $table->date('bank_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reconciliation');
    }
};
