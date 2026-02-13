<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bank')->insert([
                ['id' => 1, 'code' => 'RAK', 'name' => 'RAK BANK', 'account_no' => '', 'status' => 1, 'deleted_at' => null],
                ['id' => 2, 'code' => 'EIB', 'name' => 'EMIRATES BANK INTERNATIONAL', 'account_no' => '', 'status' => 1, 'deleted_at' => null],
                ['id' => 3, 'code' => 'BOB', 'name' => 'BANK OF BARODA', 'account_no' => '', 'status' => 1, 'deleted_at' => null],
                ['id' => 4, 'code' => 'NBF', 'name' => 'NATIONAL BANK OF FUJURIAH', 'account_no' => '', 'status' => 1, 'deleted_at' => null],
                ['id' => 5, 'code' => 'NBS', 'name' => 'NATIONAL BANK OF SHARJAH', 'account_no' => '', 'status' => 1, 'deleted_at' => null],
                ['id' => 6, 'code' => 'ADCB', 'name' => 'ABUDHABI COMMERCIAL BANK', 'account_no' => '', 'status' => 1, 'deleted_at' => null],
                ['id' => 7, 'code' => 'ADIB', 'name' => 'ABUDHABI INTERNATIONAL BANK', 'account_no' => '', 'status' => 1, 'deleted_at' => null],
                ['id' => 8, 'code' => 'FAB', 'name' => 'FIRST ABUDHABI BANK', 'account_no' => '', 'status' => 1, 'deleted_at' => null],
                ['id' => 9, 'code' => 'AJB', 'name' => 'AJMAN BANK', 'account_no' => '', 'status' => 1, 'deleted_at' => null],
                ['id' => 10, 'code' => 'CNRB', 'name' => 'CANARA BANK', 'account_no' => '', 'status' => 1, 'deleted_at' => '2022-05-06 14:16:16'],
                ['id' => 11, 'code' => 'TB', 'name' => 'Test', 'account_no' => '', 'status' => 1, 'deleted_at' => '2025-06-20 10:39:41'],
                ['id' => 12, 'code' => 'ENBD', 'name' => 'ENBD', 'account_no' => '', 'status' => 1, 'deleted_at' => null],
                ['id' => 13, 'code' => 'DIB', 'name' => 'DUBAI ISLAMIC BANK', 'account_no' => '', 'status' => 1, 'deleted_at' => null],
                ['id' => 14, 'code' => 'CBD', 'name' => 'COMMERCIAL BANK OF DUBAI', 'account_no' => '', 'status' => 1, 'deleted_at' => null],
                ['id' => 15, 'code' => 'STANDARED CHARTERED BANK', 'name' => 'STANDARED CHARTERED BANK', 'account_no' => '', 'status' => 1, 'deleted_at' => null],
                ['id' => 16, 'code' => 'B1', 'name' => null, 'account_no' => null, 'status' => 1, 'deleted_at' => null],
        ]);
    }
}
