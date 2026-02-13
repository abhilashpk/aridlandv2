<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_payrise', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->float('basicpay_old');
            $table->float('hra_old');
            $table->float('transport_old');
            $table->float('allowance_old');
            $table->float('allowance2_old');
            $table->float('netsalary_old');
            $table->float('basicpay_new');
            $table->float('hra_new');
            $table->float('transport_new');
            $table->float('allowance_new');
            $table->float('allowance2_new');
            $table->float('netsalary_new');
            $table->date('update_date');
            $table->string('remarks', 250);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_payrise');
    }
};
