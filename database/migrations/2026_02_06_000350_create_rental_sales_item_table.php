<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_sales_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rental_sales_id');
            $table->date('service_date');
            $table->integer('item_id');
            $table->integer('driver_id');
            $table->integer('unit_id');
            $table->float('quantity');
            $table->decimal('rate', 8, 2);
            $table->float('extra_hr')->nullable();
            $table->decimal('extra_rate', 8, 2)->nullable();
            $table->float('vat')->nullable();
            $table->decimal('vat_amount', 8, 2)->nullable();
            $table->decimal('line_total', 10, 2);
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_sales_item');
    }
};
