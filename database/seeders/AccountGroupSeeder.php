<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountGroupSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('account_group')->insert([
                ['id' => 1, 'category_id' => 21, 'name' => 'MOTOR VEHICLES', 'code' => 'MV', 'status' => 1, 'deleted_at' => null, 'category' => 'FASSET'],
                ['id' => 2, 'category_id' => 21, 'name' => 'FURNITURE AND FIXTURES', 'code' => 'FAF', 'status' => 1, 'deleted_at' => null, 'category' => 'FASSET'],
                ['id' => 3, 'category_id' => 21, 'name' => 'LAND AND BUILDING', 'code' => 'LAB', 'status' => 1, 'deleted_at' => null, 'category' => 'FASSET'],
                ['id' => 4, 'category_id' => 22, 'name' => 'CASH', 'code' => 'CSH', 'status' => 1, 'deleted_at' => null, 'category' => 'CASH'],
                ['id' => 5, 'category_id' => 22, 'name' => 'BANK', 'code' => 'BNK', 'status' => 1, 'deleted_at' => null, 'category' => 'BANK'],
                ['id' => 6, 'category_id' => 22, 'name' => 'PDC RECEIVED', 'code' => 'PDCR', 'status' => 1, 'deleted_at' => null, 'category' => 'PDCR'],
                ['id' => 7, 'category_id' => 22, 'name' => 'TENANT (RENTAL )', 'code' => 'CUST', 'status' => 1, 'deleted_at' => null, 'category' => 'CUSTOMER'],
                ['id' => 8, 'category_id' => 23, 'name' => 'PDC ISSUED', 'code' => 'PDCI', 'status' => 1, 'deleted_at' => null, 'category' => 'PDCI'],
                ['id' => 9, 'category_id' => 23, 'name' => 'SUPPLIERS/CREDITORS', 'code' => 'CRD', 'status' => 1, 'deleted_at' => null, 'category' => 'SUPPLIER'],
                ['id' => 10, 'category_id' => 24, 'name' => 'CAPITAL', 'code' => 'CAP', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 12, 'category_id' => 30, 'name' => 'GEN & ADM. EXP', 'code' => 'GEXP', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 14, 'category_id' => 25, 'name' => 'RETAINED PROFIT', 'code' => 'RT', 'status' => 1, 'deleted_at' => null, 'category' => 'PROFIT'],
                ['id' => 18, 'category_id' => 30, 'name' => 'SALARY', 'code' => 'SAL', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 23, 'category_id' => 22, 'name' => 'VAT ACCOUNT', 'code' => 'VATI', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 25, 'category_id' => 23, 'name' => 'LOANS AND ADVANCES', 'code' => 'LOAD', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 31, 'category_id' => 28, 'name' => 'PURCHASE', 'code' => 'PUR', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 32, 'category_id' => 28, 'name' => 'LABOUR CHARGES', 'code' => 'LC', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 44, 'category_id' => 38, 'name' => 'CURRENT A/C', 'code' => 'GRP44', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 48, 'category_id' => 36, 'name' => 'BANK CHARGES ', 'code' => 'GRP48', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 51, 'category_id' => 42, 'name' => 'OTHER REVENUE', 'code' => 'GRP51', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 52, 'category_id' => 22, 'name' => 'PRE-RECEIVED INCOME (RENTAL)', 'code' => 'GRP52', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 53, 'category_id' => 42, 'name' => 'RENTAL INCOME', 'code' => 'GRP53', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 54, 'category_id' => 22, 'name' => 'DEPOSITS', 'code' => 'GRP54', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 55, 'category_id' => 23, 'name' => 'PROVISION FOR STAFF ', 'code' => 'GRP55', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 56, 'category_id' => 23, 'name' => 'Govt Payables', 'code' => 'GRP56', 'status' => 1, 'deleted_at' => null, 'category' => ''],
                ['id' => 57, 'category_id' => 22, 'name' => 'CUSTOMERS', 'code' => 'GRP57', 'status' => 1, 'deleted_at' => null, 'category' => 'CUSTOMER'],
                ['id' => 58, 'category_id' => 23, 'name' => 'SUPPLIERS', 'code' => 'GRP58', 'status' => 1, 'deleted_at' => null, 'category' => 'SUPPLIER'],
                ['id' => 59, 'category_id' => 22, 'name' => 'STOCK', 'code' => 'GRP59', 'status' => 1, 'deleted_at' => null, 'category' => null],
        ]);
    }
}
