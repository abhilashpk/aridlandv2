<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('si_selling_exp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_invoice_id');
            $table->integer('dr_account_id');
            $table->string('se_reference', 45);
            $table->string('se_description', 255);
            $table->integer('cr_account_id');
            $table->decimal('se_amount', 8, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('si_selling_exp');
    }
};
