<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiry_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enquiry_id');
            $table->string('photo', 250);
            $table->string('description', 250);
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiry_photos');
    }
};
