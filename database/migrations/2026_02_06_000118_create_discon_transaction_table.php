<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discon_transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discon_id');
            $table->integer('con_settings_id');
            $table->integer('account_id');
            $table->decimal('amount', 10, 2);
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discon_transaction');
    }
};
