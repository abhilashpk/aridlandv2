<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_enquiry_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_enquiry_id');
            $table->integer('item_id');
            $table->string('item_name', 150)->nullable();
            $table->integer('unit_id');
            $table->float('quantity');
            $table->float('unit_price');
            $table->decimal('total_price', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_editable')->nullable()->default("0");
            $table->tinyInteger('is_transfer')->nullable()->default("0");
            $table->decimal('balance_quantity', 10, 2)->nullable();
            $table->string('remarks', 250)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_enquiry_item');
    }
};
