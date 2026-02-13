<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->string('description', 300);
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('image', 250);
            $table->tinyInteger('status');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('deleted_at')->nullable();
            $table->string('code', 45);
            $table->decimal('amount', 10, 2);
            $table->integer('department_id');
            $table->integer('division_id');
            $table->index('name', 'name');
            $table->index('expiry_date', 'expiry_date');
            $table->index('status', 'status');
            $table->index('deleted_at', 'deleted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_master');
    }
};
