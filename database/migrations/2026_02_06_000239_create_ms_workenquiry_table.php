<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ms_workenquiry', function (Blueprint $table) {
            $table->increments('id');
            $table->string('enq_no', 100);
            $table->dateTime('enquiry_datetime');
            $table->integer('customer_id');
            $table->integer('location_id');
            $table->integer('type_id');
            $table->text('description');
            $table->tinyInteger('status');
            $table->text('remarks');
            $table->dateTime('created_at');
            $table->dateTime('modified_at');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_transfer');
            $table->string('location', 250);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_workenquiry');
    }
};
