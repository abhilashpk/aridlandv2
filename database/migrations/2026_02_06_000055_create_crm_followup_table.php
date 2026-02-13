<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('crm_followup', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->date('remark_date');
            $table->text('remark');
            $table->date('next_date');
            $table->string('product_id', 200);
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_open');
            $table->integer('salesman_id');
            $table->tinyInteger('is_parent');
            $table->integer('parent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crm_followup');
    }
};
