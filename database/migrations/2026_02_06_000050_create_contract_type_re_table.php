<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_type_re', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('building_id');
            $table->string('type', 150);
            $table->integer('increment_no');
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_type_re');
    }
};
