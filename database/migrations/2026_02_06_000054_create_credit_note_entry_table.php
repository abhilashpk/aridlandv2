<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credit_note_entry', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credit_note_id');
            $table->integer('cr_account_id');
            $table->string('cr_description', 100);
            $table->string('cr_reference', 80);
            $table->string('type', 10);
            $table->decimal('cr_amount', 10, 2);
            $table->integer('job_id');
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('invoice_id');
            $table->index('credit_note_id', 'credit_note_id');
            $table->index('cr_account_id', 'cr_account_id');
            $table->index('job_id', 'job_id');
            $table->index('status', 'status');
            $table->index('deleted_at', 'deleted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_note_entry');
    }
};
