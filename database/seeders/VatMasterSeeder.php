<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VatMasterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vat_master')->insert([
                ['id' => 1, 'code' => 'VAT5', 'name' => 'VAT5', 'percentage' => 5, 'vat_cal' => 1.05, 'collection_account' => 23, 'payment_account' => 24, 'status' => 1, 'deleted_at' => null, 'expense_account' => 27, 'vatinput_import' => 25, 'vatoutput_import' => 26, 'is_department' => 0],
                ['id' => 3, 'code' => 'VATDPT', 'name' => 'VAT Department', 'percentage' => 5, 'vat_cal' => 1.05, 'collection_account' => 0, 'payment_account' => 0, 'status' => 0, 'deleted_at' => '2022-10-25 00:00:00', 'expense_account' => 0, 'vatinput_import' => 0, 'vatoutput_import' => 0, 'is_department' => 1],
        ]);
    }
}
