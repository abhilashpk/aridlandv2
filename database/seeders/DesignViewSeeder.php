<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignViewSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('design_view')->insert([
                ['id' => 1, 'view_name' => 'SalesInvoice (17).mrt'],
        ]);
    }
}
