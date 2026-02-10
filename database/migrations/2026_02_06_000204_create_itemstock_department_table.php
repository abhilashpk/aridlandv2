<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('itemstock_department', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('itemmaster_id');
            $table->integer('department_id');
            $table->integer('unit_id')->nullable();
            $table->string('packing', 100)->nullable();
            $table->decimal('opn_cost', 10, 2)->nullable()->default("0.00");
            $table->decimal('opn_quantity', 10, 2)->nullable()->default("0.00");
            $table->decimal('cur_quantity', 10, 2)->nullable()->default("0.00");
            $table->decimal('received_qty', 10, 2)->nullable()->default("0.00");
            $table->decimal('issued_qty', 10, 2)->nullable()->default("0.00");
            $table->decimal('min_quantity', 10, 2)->nullable()->default("0.00");
            $table->decimal('reorder_level', 10, 2)->nullable()->default("0.00");
            $table->decimal('vat', 5, 2)->nullable()->default("0.00");
            $table->boolean('is_baseqty')->nullable()->default("0");
            $table->integer('pur_count')->nullable()->default("0");
            $table->decimal('last_purchase_cost', 10, 2)->nullable()->default("0.00");
            $table->decimal('cost_avg', 10, 2)->nullable()->default("0.00");
            $table->boolean('status')->nullable()->default("1");
            $table->decimal('sell_price', 10, 2)->nullable()->default("0.00");
            $table->decimal('wsale_price', 10, 2)->nullable()->default("0.00");
            $table->integer('pkno')->nullable()->default("0");
            $table->nullableTimestamps();

            $table->index(["itemmaster_id", "department_id"], 'idx_item_dept');
            $table->index('department_id', 'idx_department');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('itemstock_department');
    }
};
