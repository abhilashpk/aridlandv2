<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectBudgetSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('project_budget')->insert([
                ['id' => 1, 'budgeting_id' => 1, 'ac_id' => 1681, 'amount' => 1000.0, 'created_at' => '2022-06-13 17:27:20', 'description' => 'COST WORKSHOP', 'deleted_at' => null, 'status' => 0, 'is_log' => 0],
                ['id' => 2, 'budgeting_id' => 1, 'ac_id' => 1700, 'amount' => 1000.0, 'created_at' => '2022-06-13 17:27:20', 'description' => 'SALES DISCOUNT WORKSHOP', 'deleted_at' => null, 'status' => 0, 'is_log' => 1],
        ]);
    }
}
