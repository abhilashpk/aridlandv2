<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_type', 10);
            $table->integer('department_id')->nullable();
            $table->integer('document_id');
            $table->integer('item_id');
            $table->integer('unit_id');
            $table->float('quantity');
            $table->float('unit_cost');
            $table->tinyInteger('trtype');
            $table->float('cur_quantity');
            $table->float('cost_avg');
            $table->float('pur_cost');
            $table->float('sale_cost');
            $table->float('packing');
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('deleted_at')->nullable();
            $table->date('voucher_date');
            $table->string('sale_reference', 45);
            $table->integer('return_ref_id');
            $table->float('other_cost');
            $table->integer('item_row_id');
            $table->integer('category_id')->nullable();
            $table->index('cur_quantity', 'cur_quantity');
            $table->index('deleted_at', 'deleted_at');
            $table->index('document_id', 'document_id');
            $table->index('document_type', 'document_type');
            $table->index('item_id', 'item_id');
            $table->index('status', 'status');
            $table->index('trtype', 'trtype');
            $table->index('unit_id', 'unit_id');
            $table->index('voucher_date', 'voucher_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_log');
    }
};
