<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parameter1', function (Blueprint $table) {
            $table->integer('id');
            $table->date('from_date');
            $table->date('to_date');
            $table->tinyInteger('item_class');
            $table->integer('bcurrency_id');
            $table->tinyInteger('bdecimal_place');
            $table->integer('fcurrency_id');
            $table->tinyInteger('fdecimal_place');
            $table->smallInteger('doc_warndays');
            $table->smallInteger('pdc_warndays');
            $table->tinyInteger('cost_method');
            $table->tinyInteger('is_refresh');
            $table->tinyInteger('vat_entry');
            $table->float('vat_value');
            $table->tinyInteger('credit_limit');
            $table->tinyInteger('item_profit');
            $table->float('profit_per');
            $table->string('cost_type', 25);
            $table->tinyInteger('item_quantity');
            $table->date('py_from_date');
            $table->date('py_to_date');
            $table->tinyInteger('doc_approve');
            $table->tinyInteger('trip_entry');
            $table->tinyInteger('adcd_dashboard');
            $table->tinyInteger('advanced_workshop');
            $table->tinyInteger('pi_vat_inc');
            $table->tinyInteger('si_vat_inc');
            $table->tinyInteger('vehicle_dashboard');
            $table->tinyInteger('pv_approval');
            $table->string('special_pswd', 50);
            $table->tinyInteger('pdc_alert');
            $table->tinyInteger('daily_rent');
            $table->tinyInteger('contract_delete');
            $table->primary('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parameter1');
    }
};
