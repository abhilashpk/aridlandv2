<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('budgeting')->insert([
                ['id' => 1, 'job_id' => 60, 'total' => 2000.0, 'created_at' => '2022-06-13 17:27:20', 'deleted_at' => null, 'modified_at' => '0000-00-00 00:00:00', 'total_cost' => 1000.0, 'total_income' => 1000.0],
        ]);
    }
}
