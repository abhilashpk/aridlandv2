<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buildingmaster', function (Blueprint $table) {
            $table->increments('id');
            $table->string('buildingcode', 100);
            $table->string('buildingname', 100);
            $table->string('ownername', 100);
            $table->string('location', 100);
            $table->string('area', 100);
            $table->string('mobno', 255);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('deleted_at')->nullable();
            $table->string('type', 25)->nullable();
            $table->text('description');
            $table->string('docname', 250);
            $table->string('prefix', 55);
            $table->string('plot_no', 45);
            $table->decimal('unit_price', 6, 2);
            $table->decimal('security_deposit', 8, 2);
            $table->decimal('connection_charge', 8, 2);
            $table->decimal('other_charge', 8, 2);
            $table->decimal('disconnection_charge', 10, 2);
            $table->decimal('other_charge_dis', 10, 2);
            $table->decimal('other_charge_con', 10, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buildingmaster');
    }
};
