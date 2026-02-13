<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vat_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 45);
            $table->string('name', 85);
            $table->float('percentage');
            $table->float('vat_cal');
            $table->integer('collection_account');
            $table->integer('payment_account');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('expense_account');
            $table->integer('vatinput_import');
            $table->integer('vatoutput_import');
            $table->tinyInteger('is_department');
            $table->index(["code", "name", "collection_account", "payment_account", "status", "deleted_at", "expense_account", "vatinput_import", "vatoutput_import"], 'code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vat_master');
    }
};
