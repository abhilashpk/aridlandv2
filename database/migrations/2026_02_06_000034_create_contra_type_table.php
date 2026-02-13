<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contra_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buildingid');
            $table->string('type', 150);
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->integer('increment_no');
            $table->integer('prepaid_income')->nullable();
            $table->integer('rental_income')->nullable();
            $table->integer('deposit')->nullable();
            $table->integer('water_ecty')->nullable();
            $table->integer('other_deposit')->nullable();
            $table->integer('commission')->nullable();
            $table->integer('parking')->nullable();
            $table->integer('cancellation')->nullable();
            $table->integer('repair')->nullable();
            $table->integer('water_ecty_bill')->nullable();
            $table->integer('closing_oth')->nullable();
            $table->integer('booking_oth')->nullable();
            $table->integer('chq_charge')->nullable();
            $table->integer('ejarie_fee')->nullable();
            $table->tinyInteger('pi_tax')->nullable();
            $table->tinyInteger('ri_tax')->nullable();
            $table->tinyInteger('d_tax')->nullable();
            $table->tinyInteger('we_tax')->nullable();
            $table->tinyInteger('od_tax')->nullable();
            $table->tinyInteger('c_tax')->nullable();
            $table->tinyInteger('p_tax')->nullable();
            $table->tinyInteger('cl_tax')->nullable();
            $table->tinyInteger('r_tax')->nullable();
            $table->tinyInteger('web_tax')->nullable();
            $table->tinyInteger('co_tax')->nullable();
            $table->tinyInteger('bo_tax')->nullable();
            $table->tinyInteger('cc_tax')->nullable();
            $table->tinyInteger('ef_tax')->nullable();
            $table->tinyInteger('daily_rent');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contra_type');
    }
};
