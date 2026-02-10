<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id');
            $table->text('document');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_docs');
    }
};
