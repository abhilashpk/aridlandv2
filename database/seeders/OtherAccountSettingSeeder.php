<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtherAccountSettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('other_account_setting')->insert([
                ['id' => 1, 'account_setting_name' => 'Discount in Sales', 'account_id' => 0, 'status' => 1, 'department_id' => 0],
                ['id' => 2, 'account_setting_name' => 'Discount in Purchase', 'account_id' => 0, 'status' => 1, 'department_id' => 0],
                ['id' => 3, 'account_setting_name' => 'Stock Account', 'account_id' => 0, 'status' => 1, 'department_id' => 0],
                ['id' => 4, 'account_setting_name' => 'Stock Excess', 'account_id' => 0, 'status' => 1, 'department_id' => 0],
                ['id' => 5, 'account_setting_name' => 'Stock Storage', 'account_id' => 0, 'status' => 1, 'department_id' => 0],
                ['id' => 6, 'account_setting_name' => 'Cost Difference', 'account_id' => 0, 'status' => 1, 'department_id' => 0],
                ['id' => 7, 'account_setting_name' => 'Cost of Sales', 'account_id' => 0, 'status' => 1, 'department_id' => 0],
                ['id' => 8, 'account_setting_name' => 'MF Wastage Dr Account', 'account_id' => 0, 'status' => 1, 'department_id' => 0],
                ['id' => 9, 'account_setting_name' => 'MF Wastage Cr Account', 'account_id' => 0, 'status' => 1, 'department_id' => 0],
        ]);
    }
}
