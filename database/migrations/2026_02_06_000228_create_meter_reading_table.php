<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meter_reading', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id');
            $table->float('previous');
            $table->float('current');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->float('rate');
            $table->float('cons_unit');
            $table->decimal('total', 10, 2);
            $table->decimal('vat', 5, 2);
            $table->decimal('grand_total', 10, 2);
            $table->dateTime('deleted_at')->nullable();
            $table->string('sin_no', 45);
            $table->date('from_date');
            $table->date('to_date');
            $table->tinyInteger('is_read');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meter_reading');
    }
};
