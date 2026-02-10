<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenant_enquiry', function (Blueprint $table) {
            $table->increments('id');
            $table->string('enquiry_no', 50);
            $table->date('enquiry_date');
            $table->integer('building_id');
            $table->string('flat_no', 100);
            $table->string('tenant', 100);
            $table->text('description');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('tenant_id');
            $table->tinyInteger('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_enquiry');
    }
};
