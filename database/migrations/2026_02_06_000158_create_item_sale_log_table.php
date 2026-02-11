<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_sale_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_type', 10);
            $table->integer('document_id');
            $table->integer('item_id');
            $table->integer('unit_id');
            $table->integer('quantity');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('deleted_at')->nullable();
            $table->float('unit_cost');
            $table->integer('balance_qty');
            $table->text('item_stock_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_sale_log');
    }
};
