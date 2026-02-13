<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('employee_category')->insert([
                ['id' => 1, 'category_name' => 'Labour', 'description' => 'Labour', 'status' => 1, 'deleted_at' => null],
                ['id' => 2, 'category_name' => 'Office Staff', 'description' => 'Office Staff', 'status' => 1, 'deleted_at' => null],
        ]);
    }
}
