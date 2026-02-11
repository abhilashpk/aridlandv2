<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentAccountsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('department_accounts')->insert([
                ['id' => 1, 'department_id' => 1, 'stock_acid' => 0, 'cost_acid' => 0, 'costdif_acid' => 0, 'purdis_acid' => 0, 'saledis_acid' => 0, 'stock_excess_acid' => 0, 'stock_shortage_acid' => 0],
        ]);
    }
}
