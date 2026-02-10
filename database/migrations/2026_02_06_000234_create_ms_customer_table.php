<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ms_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_no', 100);
            $table->string('name', 200);
            $table->string('phone', 25);
            $table->string('address', 400);
            $table->string('city', 100);
            $table->integer('area');
            $table->string('fax', 15);
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_customer');
    }
};
