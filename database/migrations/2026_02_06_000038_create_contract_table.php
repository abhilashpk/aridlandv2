<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contract_no', 120);
            $table->date('contract_date');
            $table->integer('customer_id');
            $table->text('contract_type_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->smallInteger('duration');
            $table->smallInteger('machine_id');
            $table->text('paper_id');
            $table->text('remarks');
            $table->dateTime('created_at')->useCurrent();
            $table->integer('created_by');
            $table->dateTime('modify_at')->nullable();
            $table->integer('modify_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract');
    }
};
