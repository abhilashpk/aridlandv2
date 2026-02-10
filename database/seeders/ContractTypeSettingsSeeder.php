<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractTypeSettingsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contract_type_settings')->insert([
                ['id' => 1, 'contract_type_re_id' => 1, 'title' => 'Income Account', 'account_id' => 1757, 'is_tax' => 1, 'deleted_at' => null],
                ['id' => 2, 'contract_type_re_id' => 1, 'title' => 'VAT Account', 'account_id' => 1758, 'is_tax' => 0, 'deleted_at' => '2023-03-26 08:07:03'],
                ['id' => 3, 'contract_type_re_id' => 1, 'title' => 'Reading Charge', 'account_id' => 2502, 'is_tax' => 0, 'deleted_at' => '2023-04-13 04:52:18'],
                ['id' => 4, 'contract_type_re_id' => 2, 'title' => 'Connection Charges', 'account_id' => 1757, 'is_tax' => 1, 'deleted_at' => null],
                ['id' => 5, 'contract_type_re_id' => 2, 'title' => 'Security Deposit', 'account_id' => 2499, 'is_tax' => 0, 'deleted_at' => null],
                ['id' => 6, 'contract_type_re_id' => 2, 'title' => 'Test', 'account_id' => 1761, 'is_tax' => 0, 'deleted_at' => '2023-03-26 05:18:31'],
                ['id' => 7, 'contract_type_re_id' => 1, 'title' => 'Other Charges', 'account_id' => 15, 'is_tax' => 0, 'deleted_at' => null],
                ['id' => 8, 'contract_type_re_id' => 3, 'title' => 'Disconnection charge', 'account_id' => 2501, 'is_tax' => 0, 'deleted_at' => null],
                ['id' => 9, 'contract_type_re_id' => 3, 'title' => 'Other Charge', 'account_id' => 1757, 'is_tax' => 0, 'deleted_at' => null],
                ['id' => 10, 'contract_type_re_id' => 3, 'title' => 'Reading Charge', 'account_id' => 1761, 'is_tax' => 1, 'deleted_at' => null],
                ['id' => 11, 'contract_type_re_id' => 2, 'title' => 'Other Charge', 'account_id' => 2500, 'is_tax' => 1, 'deleted_at' => null],
        ]);
    }
}
