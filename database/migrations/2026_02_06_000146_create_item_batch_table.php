<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_batch', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->string('batch_no', 100);
            $table->date('mfg_date');
            $table->date('exp_date')->nullable();
            $table->float('quantity');
            $table->dateTime('deleted_at')->nullable();
            $table->index('item_id', 'item_id');
            $table->index('batch_no', 'batch_no');
            $table->index('exp_date', 'exp_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_batch');
    }
};
