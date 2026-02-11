<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DashboardDetailsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dashboard_details')->insert([
                ['id' => 1, 'code' => 'SI', 'position' => 'L'],
                ['id' => 3, 'code' => 'QS', 'position' => 'L'],
                ['id' => 5, 'code' => 'DO', 'position' => 'L'],
                ['id' => 6, 'code' => 'PI', 'position' => 'R'],
                ['id' => 8, 'code' => 'PO', 'position' => 'L'],
                ['id' => 9, 'code' => 'SR', 'position' => 'R'],
                ['id' => 10, 'code' => '', 'position' => 'R'],
                ['id' => 16, 'code' => '', 'position' => 'L'],
                ['id' => 20, 'code' => '', 'position' => ''],
                ['id' => 22, 'code' => '', 'position' => ''],
        ]);
    }
}
