<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('itemmaster', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_code', 120);
            // Indexed on old MySQL (767-byte limit), so keep <=191.
            $table->string('description', 191);
            $table->tinyInteger('class_id');
            $table->string('model_no', 120)->nullable();
            $table->string('serial_no', 120)->nullable();
            $table->integer('group_id');
            $table->integer('subgroup_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->text('bin');
            $table->string('weight', 145)->nullable();
            $table->tinyInteger('assembly')->nullable();
            $table->string('image', 120)->nullable();
            $table->tinyInteger('status');
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('created_by');
            $table->integer('created_department')->nullable();
            $table->dateTime('modified_at');
            $table->integer('modify_by');
            $table->integer('deleted_by');
            $table->float('profit_per');
            $table->text('other_info')->nullable();
            $table->text('supersede_items');
            $table->float('surface_cost');
            $table->float('other_cost');
            $table->string('bin_location', 250)->nullable();
            $table->float('itmHt');
            $table->float('itmWd');
            $table->float('itmLt');
            $table->tinyInteger('dimension');
            $table->string('description_ar', 1000);
            $table->float('mpqty');
            $table->float('p1_qty');
            $table->float('p2_qty');
            $table->string('p1_formula', 12);
            $table->string('p2_formula', 12);
            $table->tinyInteger('is_inactive');
            $table->tinyInteger('batch_req');
            $table->index('category_id', 'category_id');
            $table->index('category_id', 'category_id_2');
            $table->index('class_id', 'class_id');
            $table->index('description', 'description');
            $table->index('group_id', 'group_id');
            $table->index('item_code', 'item_code');
            $table->index('model_no', 'model_no');
            $table->index('serial_no', 'serial_no');
            $table->index('subcategory_id', 'subcategory_id');
            $table->index('subgroup_id', 'subgroup_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('itemmaster');
    }
};
