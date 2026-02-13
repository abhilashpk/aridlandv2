<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargo_despatch_entry', function (Blueprint $table) {
            $table->integer('despatch_id');
            $table->integer('billentry_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargo_despatch_entry');
    }
};
