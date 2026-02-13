<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 60);
            $table->string('name', 120);
            $table->string('designation', 100);
            $table->string('nationality', 110);
            $table->date('dob');
            $table->tinyInteger('gender');
            $table->string('address1', 80);
            $table->string('address2', 80);
            $table->string('address3', 80);
            $table->string('email', 110);
            $table->string('phone', 50);
            $table->string('photo', 110);
            $table->string('pp_id', 55);
            $table->date('pp_issue_date');
            $table->date('pp_expiry_date');
            $table->string('pp_issue_place', 90);
            $table->date('join_date');
            $table->string('v_designation', 80);
            $table->string('v_id', 50);
            $table->date('v_issue_date');
            $table->date('v_expiry_date');
            $table->string('v_image', 100);
            $table->string('lc_id', 40);
            $table->date('lc_issue_date');
            $table->date('lc_expiry_date');
            $table->string('hc_id', 40);
            $table->date('hc_issue_date');
            $table->date('hc_expiry_date');
            $table->string('hc_info', 100);
            $table->string('ic_id', 40);
            $table->date('ic_issue_date');
            $table->date('ic_expiry_date');
            $table->tinyInteger('wages');
            $table->tinyInteger('contract_status');
            $table->float('nwh');
            $table->float('ot_general');
            $table->float('ot_holiday');
            $table->float('contract_salary');
            $table->float('basic_pay');
            $table->float('hra');
            $table->float('transport');
            $table->float('allowance');
            $table->tinyInteger('payment_method');
            $table->float('loan');
            $table->float('advance_salary');
            $table->tinyInteger('wage_calculation');
            $table->tinyInteger('ot_calculation');
            $table->string('remarks', 110);
            $table->tinyInteger('duty_status');
            $table->string('other_info', 120);
            $table->tinyInteger('status');
            $table->integer('created_by');
            $table->dateTime('created_at');
            $table->integer('modify_by');
            $table->dateTime('modify_at');
            $table->dateTime('deleted_at')->nullable();
            $table->float('allowance2');
            $table->string('department', 120);
            $table->string('p_image', 300);
            $table->string('nwage', 45);
            $table->string('otwage', 45);
            $table->tinyInteger('basic_pay_nw');
            $table->tinyInteger('hra_nw');
            $table->tinyInteger('transport_nw');
            $table->tinyInteger('allowance1_nw');
            $table->tinyInteger('allowance2_nw');
            $table->tinyInteger('basic_pay_otw');
            $table->tinyInteger('hra_otw');
            $table->tinyInteger('transport_otw');
            $table->tinyInteger('allowance1_otw');
            $table->tinyInteger('allowance2_otw');
            $table->decimal('net_salary', 10, 2);
            $table->string('l_image', 300);
            $table->string('h_image', 300);
            $table->string('i_image', 300);
            $table->string('me_id', 100);
            $table->date('me_issue_date');
            $table->date('me_expiry_date');
            $table->string('me_image', 300);
            $table->string('phone2', 45);
            $table->float('lev_per_mth');
            $table->float('air_tkt');
            $table->float('anual_ml');
            $table->float('anual_cl');
            $table->date('rejoin_date');
            $table->integer('department_id');
            $table->integer('division_id');
            $table->string('routing_code', 10);
            $table->string('account_number', 19);
            $table->integer('category_id');
            $table->index('code', 'code');
            $table->index('name', 'name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
