<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReconciliationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reconciliation')->insert([
                ['trid' => 13823, 'account_id' => 2509, 'bank_date' => '2022-01-10'],
                ['trid' => 13839, 'account_id' => 2509, 'bank_date' => null],
        ]);
    }
}
