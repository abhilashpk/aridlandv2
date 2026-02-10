<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Parameter4Seeder extends Seeder
{
    public function run(): void
    {
        DB::table('parameter4')->insert([
                ['id' => 1, 'payroll_by' => 30, 'nwh' => 8, 'ot_general' => 1.25, 'ot_holiday' => 2, 'ot_calculation' => '1', 'holiday' => 'Fri'],
        ]);
    }
}
