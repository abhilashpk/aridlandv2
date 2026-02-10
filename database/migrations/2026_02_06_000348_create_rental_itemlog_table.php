<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_itemlog', function (Blueprint $table) {
            $table->integer('row_id');
            $table->string('doc_type', 4);
            $table->integer('doc_id');
            $table->date('voucher_date');
            $table->date('service_date');
            $table->integer('driver_id');
            $table->integer('item_id');
            $table->integer('unit_id');
            $table->float('qty');
            $table->decimal('rate', 6, 2);
            $table->tinyInteger('trtype');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_itemlog');
    }
};
