<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DashboardSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dashboard')->insert([
                ['id' => 1, 'code' => 'SI', 'name' => 'Sales Invoice'],
                ['id' => 2, 'code' => 'SO', 'name' => 'Sales Order'],
                ['id' => 3, 'code' => 'DO', 'name' => 'Delivery Order'],
                ['id' => 4, 'code' => 'QS', 'name' => 'Quotation Sales'],
                ['id' => 5, 'code' => 'PO', 'name' => 'Purchase Order'],
                ['id' => 6, 'code' => 'PI', 'name' => 'Purchase Invoice'],
                ['id' => 7, 'code' => 'CR', 'name' => 'Customer'],
                ['id' => 8, 'code' => 'SR', 'name' => 'Supplier'],
                ['id' => 9, 'code' => 'IM', 'name' => 'Items'],
                ['id' => 10, 'code' => 'EM', 'name' => 'Employees'],
                ['id' => 11, 'code' => 'PR', 'name' => 'Payroll'],
        ]);
    }
}
