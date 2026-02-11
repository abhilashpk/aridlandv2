<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VatDepartmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vat_department')->insert([
                ['id' => 1, 'vatmaster_id' => 3, 'department_id' => 1, 'collection_account' => 0, 'payment_account' => 0, 'expense_account' => 0, 'vatinput_import' => 0, 'vatoutput_import' => 0],
        ]);
    }
}
