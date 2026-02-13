<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batch_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('batch_id');
            $table->integer('item_id');
            $table->string('document_type', 4);
            $table->integer('document_id');
            $table->integer('doc_row_id');
            $table->float('quantity');
            $table->tinyInteger('trtype');
            $table->date('invoice_date');
            $table->integer('log_id');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at')->nullable();
            $table->integer('modify_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('ref_doc_id');
            $table->integer('ref_docrow_id');
            $table->integer('do_id')->nullable();
            $table->integer('do_row_id')->nullable();
            $table->index('batch_id', 'batch_id');
            $table->index('item_id', 'item_id');
            $table->index('invoice_date', 'invoice_date');
            $table->index('log_id', 'log_id');
            $table->index('document_id', 'document_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batch_log');
    }
};
