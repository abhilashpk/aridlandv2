<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packing_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no', 50);
            $table->date('voucher_date');
            $table->integer('customer_id');
            $table->string('invoice_ids', 150);
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at')->nullable();
            $table->smallInteger('modify_by');
            $table->dateTime('deleted_at')->nullable();
            $table->string('invoice_nos', 200);
            $table->float('carton_qty');
            $table->float('item_qty');
            $table->string('description', 250);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packing_list');
    }
};
