<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('personal_access_tokens')) {
            return;
        }

        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');

            // ✅ DO NOT use morphs() because it makes tokenable_type 255 and breaks your index limit
            $table->string('tokenable_type', 191);
            $table->unsignedBigInteger('tokenable_id');

            $table->string('name', 255);
            $table->string('token', 64)->unique('personal_access_tokens_token_unique');
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            // ✅ Composite index (works with tokenable_type 191)
            $table->index(
                ['tokenable_type', 'tokenable_id'],
                'personal_access_tokens_tokenable_type_tokenable_id_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
