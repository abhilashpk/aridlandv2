<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sdo_other_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_do_id');
            $table->integer('dr_account_id');
            $table->string('oc_reference', 80);
            $table->string('oc_description', 120);
            $table->integer('cr_account_id');
            $table->decimal('oc_amount', 10, 2);
            $table->decimal('oc_fc_amount', 10, 2);
            $table->tinyInteger('status');
            $table->dateTime('deleted_at')->nullable();
            $table->float('oc_vat');
            $table->decimal('oc_vatamt', 10, 0);
            $table->tinyInteger('is_transfer');
            $table->decimal('balance_amount', 10, 2);
            $table->tinyInteger('is_fc');
            $table->integer('currency_id');
            $table->float('currency_rate');
            $table->string('tax_code', 5);
            $table->index('supplier_do_id', 'supplier_do_id');
            $table->index('dr_account_id', 'dr_account_id');
            $table->index('cr_account_id', 'cr_account_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sdo_other_cost');
    }
};
