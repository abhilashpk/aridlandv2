<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wage_entry_others', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wage_entry_id');
            $table->float('oth_allowance1');
            $table->string('desc_allowance1', 150);
            $table->float('oth_allowance2');
            $table->string('desc_allowance2', 150);
            $table->float('oth_allowance3');
            $table->string('desc_allowance3', 150);
            $table->float('oth_allowance4');
            $table->string('desc_allowance4', 150);
            $table->float('oth_deduction1');
            $table->string('desc_deduction1', 150);
            $table->float('oth_deduction2');
            $table->string('desc_deduction2', 150);
            $table->float('oth_deduction3');
            $table->string('desc_deduction3', 150);
            $table->float('oth_deduction4');
            $table->string('desc_deduction4', 150);
            $table->index('wage_entry_id', 'wage_entry_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wage_entry_others');
    }
};
