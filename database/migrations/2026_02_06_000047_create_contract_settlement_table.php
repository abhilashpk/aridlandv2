<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_settlement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id');
            $table->date('settle_date');
            $table->date('vacate_date');
            $table->integer('days_stayed');
            $table->decimal('rent_period', 20, 2);
            $table->decimal('gpayable', 20, 2);
            $table->decimal('unpdc', 20, 2);
            $table->decimal('cancellation_fee', 10, 2);
            $table->decimal('rm_fee', 10, 2);
            $table->decimal('ew_fee', 10, 2);
            $table->decimal('other', 10, 2);
            $table->decimal('total', 20, 2);
            $table->decimal('refunded', 20, 2);
            $table->decimal('reveivable', 20, 2);
            $table->integer('jv_id');
            $table->dateTime('created_at')->useCurrent();
            $table->integer('created_by');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_settlement');
    }
};
