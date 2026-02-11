<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipper', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shipper_name', 100);
            $table->string('phone', 50);
            $table->string('address', 250);
            $table->dateTime('deleted_at')->nullable();
            $table->index('shipper_name', 'shipper_name');
            $table->index('phone', 'phone');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipper');
    }
};
