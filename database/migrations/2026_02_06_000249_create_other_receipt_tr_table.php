<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('other_receipt_tr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('other_receipt_id');
            $table->integer('cr_account_id');
            $table->string('cr_reference', 100);
            $table->string('cr_description', 120);
            $table->integer('cr_job_id');
            $table->decimal('cr_amount', 10, 2);
            $table->decimal('cr_amount_fc', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('other_receipt_tr');
    }
};
