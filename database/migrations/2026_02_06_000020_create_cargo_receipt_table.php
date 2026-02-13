<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargo_receipt', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_code', 50);
            $table->date('job_date');
            $table->integer('consignee_id');
            $table->integer('shipper_id');
            $table->float('received_qty');
            $table->text('packing_type');
            $table->string('consignee_code', 100);
            $table->string('weight', 50);
            $table->string('volume', 50);
            $table->string('destination', 120);
            $table->integer('delivery_type');
            $table->string('remarks', 250);
            $table->integer('collection_type');
            $table->decimal('rate', 5, 2);
            $table->decimal('coll_charge', 8, 2)->nullable();
            $table->decimal('other_charge', 8, 2)->nullable();
            $table->decimal('total_charge', 10, 2);
            $table->decimal('amt_received', 10, 2)->nullable();
            $table->decimal('balance', 10, 2);
            $table->tinyInteger('is_lumpsum')->nullable();
            $table->string('shippers_mob', 150);
            $table->string('shippers_vehno', 150);
            $table->string('invoice_nos', 150);
            $table->dateTime('created_at');
            $table->integer('created_by');
            $table->dateTime('modify_at')->nullable();
            $table->integer('modify_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->tinyInteger('status');
            $table->integer('salesman_id');
            $table->float('despatched_qty');
            $table->string('wbill_no', 45);
            $table->tinyInteger('trans_type');
            $table->float('packing_qty');
            $table->integer('rate_unit');
            $table->index('job_code', 'jobno');
            $table->index('job_date', 'jobdate');
            $table->index('consignee_id', 'consignee_id');
            $table->index('shipper_id', 'shipper_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargo_receipt');
    }
};
