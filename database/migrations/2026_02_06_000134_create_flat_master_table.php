<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flat_master', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('building_id');
            $table->string('flat_no', 100);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('deleted_at')->nullable();
            $table->string('flat_name', 150);
            $table->text('description');
            $table->string('docname', 200);
            $table->index('building_id', 'building_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flat_master');
    }
};
