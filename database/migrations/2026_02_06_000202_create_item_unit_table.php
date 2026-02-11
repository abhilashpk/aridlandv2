<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_unit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('itemmaster_id');
            $table->integer('unit_id');
            $table->string('packing', 55)->nullable();
            $table->float('opn_quantity')->nullable()->default("0");
            $table->float('opn_cost')->nullable()->default("0");
            $table->float('sell_price')->nullable()->default("0");
            $table->float('wsale_price')->nullable()->default("0");
            $table->smallInteger('min_quantity')->nullable()->default("0");
            $table->integer('reorder_level')->nullable()->default("0");
            $table->float('vat')->nullable();
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('cur_quantity')->nullable()->default("0");
            $table->tinyInteger('is_baseqty')->nullable();
            $table->integer('received_qty')->nullable()->default("0");
            $table->float('last_purchase_cost')->nullable()->default("0");
            $table->integer('pur_count')->nullable()->default("0");
            $table->float('cost_avg')->nullable()->default("0");
            $table->integer('issued_qty')->nullable()->default("0");
            $table->float('pkno')->nullable();
            $table->index(["itemmaster_id", "unit_id", "status", "deleted_at", "is_baseqty"], 'itemmaster_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_unit');
    }
};
