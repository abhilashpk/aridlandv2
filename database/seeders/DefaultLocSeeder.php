<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultLocSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('default_loc')->insert([
                ['id' => 1, 'pur_loc' => 1, 'sales_loc' => 1, 'mfg_loc' => 0],
        ]);
    }
}
