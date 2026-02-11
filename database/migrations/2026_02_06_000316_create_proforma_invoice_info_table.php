<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proforma_invoice_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proforma_invoice_id');
            $table->string('title', 100);
            $table->string('description', 120);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index(["proforma_invoice_id", "status", "deleted_at"], 'sales_order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proforma_invoice_info');
    }
};
