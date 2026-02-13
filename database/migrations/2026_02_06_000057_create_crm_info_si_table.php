<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('crm_info_si', function (Blueprint $table) {
            $table->integer('temp_id');
            $table->string('textval', 250);
            $table->integer('doc_id');
            $table->string('textval2', 150);
            $table->index('textval', 'textval');
            $table->index('doc_id', 'doc_id');
            $table->index('textval2', 'textval2');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crm_info_si');
    }
};
