<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('other_payment_tr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('other_payment_id');
            $table->integer('dr_account_id');
            $table->string('dr_reference', 100);
            $table->string('dr_description', 120);
            $table->integer('dr_job_id');
            $table->decimal('dr_amount', 10, 2);
            $table->decimal('dr_amount_fc', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->index(["other_payment_id", "dr_account_id", "dr_job_id", "dr_amount", "status", "deleted_at"], 'other_payment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('other_payment_tr');
    }
};
