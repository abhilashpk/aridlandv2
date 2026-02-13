<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name', 200);
            $table->string('email', 150);
            $table->string('phone', 40);
            $table->string('address', 220);
            $table->string('address2', 150);
            $table->string('address3', 150);
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('country', 100);
            $table->string('pin', 10);
            $table->string('logo', 200);
            $table->string('website', 200);
            $table->tinyInteger('status');
            $table->string('department_id', 100);
            $table->string('vat_no', 50);
            $table->date('activate_date');
            $table->integer('active_days');
            $table->tinyInteger('active_status');
            $table->index('company_name', 'company_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
