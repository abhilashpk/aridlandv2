<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_type_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_type_re_id');
            $table->string('title', 250);
            $table->integer('account_id');
            $table->tinyInteger('is_tax');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_type_settings');
    }
};
