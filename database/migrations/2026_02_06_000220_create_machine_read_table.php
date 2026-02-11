<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('machine_read', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contract_id');
            $table->date('read_date');
            $table->text('paper_and_qty');
            $table->dateTime('created_at')->useCurrent();
            $table->integer('created_by');
            $table->integer('modify_by')->nullable();
            $table->dateTime('modify_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('machine_read');
    }
};
