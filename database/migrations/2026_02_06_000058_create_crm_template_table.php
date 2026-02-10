<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('crm_template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('doc_type', 5);
            $table->string('label', 155);
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('text_no');
            $table->string('label2', 100);
            $table->tinyInteger('reqd1');
            $table->tinyInteger('reqd2');
            $table->string('values1', 200);
            $table->string('values2', 200);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crm_template');
    }
};
