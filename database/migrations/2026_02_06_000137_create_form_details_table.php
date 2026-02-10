<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id');
            $table->string('field_code', 85);
            $table->string('field_name', 85);
            $table->tinyInteger('active');
            $table->tinyInteger('status');
            $table->tinyInteger('list_ord');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_details');
    }
};
