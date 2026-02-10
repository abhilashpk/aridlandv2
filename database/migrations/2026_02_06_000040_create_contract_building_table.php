<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_building', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('building_id');
            $table->date('contract_date');
            $table->string('contract_no', 50);
            $table->string('si_no', 50);
            $table->integer('customer_id');
            $table->string('flat_no', 50);
            $table->date('start_date');
            $table->string('duration', 50);
            $table->date('end_date');
            $table->decimal('rent_amount', 30, 2);
            $table->string('passport_no', 100)->nullable();
            $table->dateTime('passport_exp')->nullable();
            $table->string('nationality', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('document', 100)->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('deleted_at')->nullable();
            $table->string('file_no', 50)->nullable();
            $table->string('terms', 250)->nullable();
            $table->text('observations')->nullable();
            $table->text('observations_ot')->nullable();
            $table->decimal('grand_total', 30, 2);
            $table->tinyInteger('rv_status');
            $table->tinyInteger('drv_status');
            $table->tinyInteger('crv_status');
            $table->tinyInteger('status')->default("1");
            $table->integer('renew_id')->nullable();
            $table->tinyInteger('is_close');
            $table->tinyInteger('is_day');
            $table->tinyInteger('pv_status');
            $table->decimal('total_rent', 10, 2)->nullable();
            $table->unique('contract_no', 'contract_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_building');
    }
};
