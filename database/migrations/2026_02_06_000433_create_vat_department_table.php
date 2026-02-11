<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vat_department', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vatmaster_id');
            $table->integer('department_id');
            $table->integer('collection_account');
            $table->integer('payment_account');
            $table->integer('expense_account');
            $table->integer('vatinput_import');
            $table->integer('vatoutput_import');
            $table->index('vatmaster_id', 'vatmaster_id');
            $table->index('department_id', 'department_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vat_department');
    }
};
