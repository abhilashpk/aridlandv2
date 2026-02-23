<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('report_view_detail', function (Blueprint $table) {
            $table->integer('department_id')->nullable()->after('is_default');
            $table->index('department_id', 'report_view_detail_department_id');
        });
    }

    public function down(): void
    {
        Schema::table('report_view_detail', function (Blueprint $table) {
            $table->dropIndex('report_view_detail_department_id');
            $table->dropColumn('department_id');
        });
    }
};

