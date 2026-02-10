<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('debit_note_entry', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('debit_note_id');
            $table->integer('dr_account_id');
            $table->string('dr_description', 150);
            $table->string('dr_reference', 150);
            $table->string('type', 10);
            $table->float('dr_amount');
            $table->integer('job_id');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('invoice_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('debit_note_entry');
    }
};
