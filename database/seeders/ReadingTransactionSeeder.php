<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReadingTransactionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reading_transaction')->insert([
                ['id' => 13, 'reading_id' => 8, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 3000.0, 'deleted_at' => null],
                ['id' => 14, 'reading_id' => 8, 'con_settings_id' => 1, 'account_id' => 2502, 'amount' => 50.0, 'deleted_at' => null],
                ['id' => 15, 'reading_id' => 9, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 3000.0, 'deleted_at' => null],
                ['id' => 16, 'reading_id' => 9, 'con_settings_id' => 1, 'account_id' => 2502, 'amount' => 250.0, 'deleted_at' => null],
                ['id' => 17, 'reading_id' => 10, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 2500.0, 'deleted_at' => null],
                ['id' => 18, 'reading_id' => 10, 'con_settings_id' => 1, 'account_id' => 2502, 'amount' => 40.0, 'deleted_at' => null],
                ['id' => 22, 'reading_id' => 12, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 12000.0, 'deleted_at' => null],
                ['id' => 23, 'reading_id' => 12, 'con_settings_id' => 1, 'account_id' => 2502, 'amount' => 500.0, 'deleted_at' => null],
                ['id' => 24, 'reading_id' => 12, 'con_settings_id' => 1, 'account_id' => 15, 'amount' => 120.0, 'deleted_at' => null],
                ['id' => 88, 'reading_id' => 34, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 18000.0, 'deleted_at' => null],
                ['id' => 89, 'reading_id' => 34, 'con_settings_id' => 1, 'account_id' => 2502, 'amount' => 125.0, 'deleted_at' => null],
                ['id' => 90, 'reading_id' => 34, 'con_settings_id' => 1, 'account_id' => 15, 'amount' => 60.0, 'deleted_at' => null],
                ['id' => 91, 'reading_id' => 35, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 30000.0, 'deleted_at' => null],
                ['id' => 92, 'reading_id' => 35, 'con_settings_id' => 1, 'account_id' => 2502, 'amount' => 60.0, 'deleted_at' => null],
                ['id' => 93, 'reading_id' => 35, 'con_settings_id' => 1, 'account_id' => 15, 'amount' => 10.0, 'deleted_at' => null],
                ['id' => 94, 'reading_id' => 36, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 9000.0, 'deleted_at' => null],
                ['id' => 95, 'reading_id' => 36, 'con_settings_id' => 1, 'account_id' => 2502, 'amount' => 15.0, 'deleted_at' => null],
                ['id' => 96, 'reading_id' => 36, 'con_settings_id' => 1, 'account_id' => 15, 'amount' => 30.0, 'deleted_at' => null],
                ['id' => 113, 'reading_id' => 45, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 1000.0, 'deleted_at' => null],
                ['id' => 114, 'reading_id' => 45, 'con_settings_id' => 1, 'account_id' => 15, 'amount' => 10.0, 'deleted_at' => null],
                ['id' => 115, 'reading_id' => 46, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 6000.0, 'deleted_at' => null],
                ['id' => 116, 'reading_id' => 46, 'con_settings_id' => 1, 'account_id' => 15, 'amount' => 50.0, 'deleted_at' => null],
                ['id' => 117, 'reading_id' => 47, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 500.0, 'deleted_at' => null],
                ['id' => 118, 'reading_id' => 47, 'con_settings_id' => 1, 'account_id' => 15, 'amount' => 0.0, 'deleted_at' => null],
                ['id' => 119, 'reading_id' => 48, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 7500.0, 'deleted_at' => null],
                ['id' => 120, 'reading_id' => 48, 'con_settings_id' => 1, 'account_id' => 15, 'amount' => 0.0, 'deleted_at' => null],
                ['id' => 121, 'reading_id' => 49, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 4500.0, 'deleted_at' => null],
                ['id' => 122, 'reading_id' => 49, 'con_settings_id' => 1, 'account_id' => 15, 'amount' => 100.0, 'deleted_at' => null],
                ['id' => 123, 'reading_id' => 50, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 7200.0, 'deleted_at' => null],
                ['id' => 124, 'reading_id' => 50, 'con_settings_id' => 1, 'account_id' => 15, 'amount' => 0.0, 'deleted_at' => null],
                ['id' => 125, 'reading_id' => 51, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 9000.0, 'deleted_at' => null],
                ['id' => 126, 'reading_id' => 51, 'con_settings_id' => 1, 'account_id' => 15, 'amount' => 0.0, 'deleted_at' => null],
                ['id' => 127, 'reading_id' => 52, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 9000.0, 'deleted_at' => null],
                ['id' => 128, 'reading_id' => 52, 'con_settings_id' => 1, 'account_id' => 15, 'amount' => 0.0, 'deleted_at' => null],
                ['id' => 129, 'reading_id' => 54, 'con_settings_id' => 1, 'account_id' => 1757, 'amount' => 8400.0, 'deleted_at' => null],
                ['id' => 130, 'reading_id' => 54, 'con_settings_id' => 1, 'account_id' => 15, 'amount' => 10.0, 'deleted_at' => null],
        ]);
    }
}
