<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargo_waybill', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bill_no', 50);
            $table->date('bill_date');
            $table->integer('consignee_id');
            $table->string('vehicle_no', 45);
            $table->string('driver', 85);
            $table->string('mob_uae', 45);
            $table->string('mob_ksa', 45);
            $table->string('instructions', 250);
            $table->text('cargo_receipt_ids');
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at')->nullable();
            $table->integer('modify_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->tinyInteger('status');
            $table->decimal('total_amount', 10, 2);
            $table->string('mobile', 45);
            $table->float('loaded_qty');
            $table->string('despatch_no', 50);
            $table->tinyInteger('status_id');
            $table->tinyInteger('is_reached');
            $table->float('loaded_pack_qty');
            $table->index('bill_no', 'bill_no');
            $table->index('bill_date', 'bill_date');
            $table->index('consignee_id', 'consignee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargo_waybill');
    }
};
