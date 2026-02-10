<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeePayriseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('employee_payrise')->insert([
                ['id' => 1, 'employee_id' => 1, 'basicpay_old' => 1000, 'hra_old' => 0, 'transport_old' => 500, 'allowance_old' => 0, 'allowance2_old' => 0, 'netsalary_old' => 1500, 'basicpay_new' => 1500, 'hra_new' => 0, 'transport_new' => 500, 'allowance_new' => 0, 'allowance2_new' => 0, 'netsalary_new' => 2000, 'update_date' => '2025-02-04', 'remarks' => ''],
        ]);
    }
}
