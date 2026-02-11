<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractTransactionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contract_transaction')->insert([
                ['id' => 13, 'contract_id' => 7, 'con_settings_id' => 2, 'account_id' => 1757, 'amount' => 150.0, 'deleted_at' => null],
                ['id' => 14, 'contract_id' => 7, 'con_settings_id' => 2, 'account_id' => 2499, 'amount' => 50.0, 'deleted_at' => null],
                ['id' => 15, 'contract_id' => 8, 'con_settings_id' => 2, 'account_id' => 1757, 'amount' => 200.0, 'deleted_at' => null],
                ['id' => 16, 'contract_id' => 8, 'con_settings_id' => 2, 'account_id' => 2499, 'amount' => 500.0, 'deleted_at' => null],
                ['id' => 17, 'contract_id' => 9, 'con_settings_id' => 2, 'account_id' => 1757, 'amount' => 150.0, 'deleted_at' => null],
                ['id' => 18, 'contract_id' => 9, 'con_settings_id' => 2, 'account_id' => 2499, 'amount' => 320.0, 'deleted_at' => null],
                ['id' => 19, 'contract_id' => 10, 'con_settings_id' => 2, 'account_id' => 1757, 'amount' => 600.0, 'deleted_at' => null],
                ['id' => 20, 'contract_id' => 10, 'con_settings_id' => 2, 'account_id' => 2499, 'amount' => 150.0, 'deleted_at' => null],
                ['id' => 23, 'contract_id' => 12, 'con_settings_id' => 2, 'account_id' => 1757, 'amount' => 500.0, 'deleted_at' => null],
                ['id' => 24, 'contract_id' => 12, 'con_settings_id' => 2, 'account_id' => 2499, 'amount' => 1000.0, 'deleted_at' => null],
                ['id' => 25, 'contract_id' => 13, 'con_settings_id' => 2, 'account_id' => 1757, 'amount' => 200.0, 'deleted_at' => null],
                ['id' => 26, 'contract_id' => 13, 'con_settings_id' => 2, 'account_id' => 2499, 'amount' => 1000.0, 'deleted_at' => null],
                ['id' => 27, 'contract_id' => 14, 'con_settings_id' => 2, 'account_id' => 1757, 'amount' => 200.0, 'deleted_at' => null],
                ['id' => 28, 'contract_id' => 14, 'con_settings_id' => 2, 'account_id' => 2499, 'amount' => 1000.0, 'deleted_at' => null],
                ['id' => 29, 'contract_id' => 15, 'con_settings_id' => 2, 'account_id' => 1757, 'amount' => 200.0, 'deleted_at' => null],
                ['id' => 30, 'contract_id' => 15, 'con_settings_id' => 2, 'account_id' => 2499, 'amount' => 1000.0, 'deleted_at' => null],
                ['id' => 31, 'contract_id' => 16, 'con_settings_id' => 2, 'account_id' => 1757, 'amount' => 120.0, 'deleted_at' => null],
                ['id' => 32, 'contract_id' => 16, 'con_settings_id' => 2, 'account_id' => 2499, 'amount' => 1500.0, 'deleted_at' => null],
                ['id' => 33, 'contract_id' => 17, 'con_settings_id' => 2, 'account_id' => 1757, 'amount' => 200.0, 'deleted_at' => null],
                ['id' => 34, 'contract_id' => 17, 'con_settings_id' => 2, 'account_id' => 2499, 'amount' => 1000.0, 'deleted_at' => null],
                ['id' => 35, 'contract_id' => 18, 'con_settings_id' => 2, 'account_id' => 1757, 'amount' => 120.0, 'deleted_at' => null],
                ['id' => 36, 'contract_id' => 18, 'con_settings_id' => 2, 'account_id' => 2499, 'amount' => 1500.0, 'deleted_at' => null],
                ['id' => 37, 'contract_id' => 19, 'con_settings_id' => 2, 'account_id' => 1757, 'amount' => 1220.0, 'deleted_at' => null],
                ['id' => 38, 'contract_id' => 19, 'con_settings_id' => 2, 'account_id' => 2499, 'amount' => 200.0, 'deleted_at' => null],
                ['id' => 48, 'contract_id' => 23, 'con_settings_id' => 2, 'account_id' => 1757, 'amount' => 200.0, 'deleted_at' => null],
                ['id' => 49, 'contract_id' => 23, 'con_settings_id' => 2, 'account_id' => 2499, 'amount' => 1000.0, 'deleted_at' => null],
                ['id' => 50, 'contract_id' => 23, 'con_settings_id' => 2, 'account_id' => 2500, 'amount' => 125.0, 'deleted_at' => null],
        ]);
    }
}
