<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manual_journal_voucher_tr', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('manual_journal_entry_id');
            $table->integer('invoice_id');
            $table->decimal('assign_amount', 10, 0);
            $table->string('bill_type', 100);
            $table->tinyInteger('status');
            $table->integer('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manual_journal_voucher_tr');
    }
};
