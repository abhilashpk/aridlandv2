<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sti_other_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transfer_id');
            $table->integer('dr_account_id');
            $table->string('reference', 200);
            $table->string('description', 250);
            $table->decimal('amount', 10, 2);
            $table->integer('cr_account_id');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sti_other_cost');
    }
};
