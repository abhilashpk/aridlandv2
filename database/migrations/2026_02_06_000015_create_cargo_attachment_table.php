<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargo_attachment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cargo_receipt_id');
            $table->string('file_name', 110);
            $table->index('cargo_receipt_id', 'cargo_receipt_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargo_attachment');
    }
};
