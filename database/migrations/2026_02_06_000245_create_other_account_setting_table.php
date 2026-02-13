<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('other_account_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_setting_name', 100);
            $table->integer('account_id');
            $table->tinyInteger('status');
            $table->integer('department_id');
            $table->index(["account_setting_name", "account_id", "status"], 'account_setting_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('other_account_setting');
    }
};
