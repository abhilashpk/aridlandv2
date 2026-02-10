<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiSellingExpSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('si_selling_exp')->insert([
                ['id' => 1, 'sales_invoice_id' => 11, 'dr_account_id' => 2500, 'se_reference' => '107', 'se_description' => 'sdgsgd', 'cr_account_id' => 2499, 'se_amount' => 155.0, 'status' => 1, 'deleted_at' => null],
                ['id' => 2, 'sales_invoice_id' => 12, 'dr_account_id' => 2501, 'se_reference' => '108', 'se_description' => 'gsdgs', 'cr_account_id' => 1761, 'se_amount' => 125.0, 'status' => 1, 'deleted_at' => null],
                ['id' => 3, 'sales_invoice_id' => 13, 'dr_account_id' => 2500, 'se_reference' => '109', 'se_description' => 'test 1', 'cr_account_id' => 2499, 'se_amount' => 250.0, 'status' => 1, 'deleted_at' => null],
                ['id' => 5, 'sales_invoice_id' => 13, 'dr_account_id' => 2501, 'se_reference' => '109', 'se_description' => 'test2', 'cr_account_id' => 2499, 'se_amount' => 50.0, 'status' => 1, 'deleted_at' => null],
                ['id' => 6, 'sales_invoice_id' => 2, 'dr_account_id' => 2752, 'se_reference' => '356', 'se_description' => '', 'cr_account_id' => 5511, 'se_amount' => 230.0, 'status' => 1, 'deleted_at' => null],
                ['id' => 7, 'sales_invoice_id' => 4, 'dr_account_id' => 2752, 'se_reference' => '3546', 'se_description' => 'vhnng', 'cr_account_id' => 5501, 'se_amount' => 123.0, 'status' => 1, 'deleted_at' => null],
                ['id' => 8, 'sales_invoice_id' => 4, 'dr_account_id' => 2753, 'se_reference' => '5768', 'se_description' => 'tele', 'cr_account_id' => 5502, 'se_amount' => 50.0, 'status' => 1, 'deleted_at' => null],
                ['id' => 9, 'sales_invoice_id' => 7, 'dr_account_id' => 2762, 'se_reference' => 'food', 'se_description' => '', 'cr_account_id' => 5613, 'se_amount' => 200.0, 'status' => 1, 'deleted_at' => null],
                ['id' => 10, 'sales_invoice_id' => 7, 'dr_account_id' => 2762, 'se_reference' => 'petrol', 'se_description' => '', 'cr_account_id' => 5616, 'se_amount' => 100.0, 'status' => 1, 'deleted_at' => null],
                ['id' => 11, 'sales_invoice_id' => 38, 'dr_account_id' => 2753, 'se_reference' => '663', 'se_description' => '', 'cr_account_id' => 2762, 'se_amount' => 5.0, 'status' => 1, 'deleted_at' => null],
                ['id' => 12, 'sales_invoice_id' => 12, 'dr_account_id' => 2762, 'se_reference' => '2314', 'se_description' => 'clearing', 'cr_account_id' => 2772, 'se_amount' => 100.0, 'status' => 1, 'deleted_at' => null],
        ]);
    }
}
