<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_report_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->text('group_ids');
            $table->text('account_ids');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_report_setting');
    }
};
