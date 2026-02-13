<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation_sales_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_sales_id');
            $table->string('title', 100);
            $table->string('description', 120);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index(["quotation_sales_id", "status", "deleted_at"], 'quotation_sales_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_sales_info');
    }
};
