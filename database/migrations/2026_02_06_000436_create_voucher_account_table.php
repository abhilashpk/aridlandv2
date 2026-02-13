<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voucher_account', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_name', 45);
            $table->string('account_field', 45);
            $table->integer('account_id');
            $table->index(["account_field", "account_id"], 'account_field');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_account');
    }
};
