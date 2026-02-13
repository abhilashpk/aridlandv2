<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expiry_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->tinyInteger('doc_type');
            $table->date('expiry_date');
            $table->index('doc_type', 'doc_type');
            $table->index('employee_id', 'employee_id');
            $table->index('expiry_date', 'expiry_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expiry_docs');
    }
};
