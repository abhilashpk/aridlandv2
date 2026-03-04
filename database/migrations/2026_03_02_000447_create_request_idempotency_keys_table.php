<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('request_idempotency_keys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('module_code', 30);
            $table->string('token', 128)->unique('req_idem_token_unique');
            $table->integer('user_id');
            $table->tinyInteger('status')->default(0); // 0=issued, 1=used
            $table->dateTime('created_at');
            $table->dateTime('used_at')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->integer('resource_id')->nullable();

            $table->index(['module_code', 'user_id', 'status'], 'req_idem_module_user_status_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('request_idempotency_keys');
    }
};

