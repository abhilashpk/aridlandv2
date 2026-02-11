<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('account_category')->insert([
                ['id' => 1, 'parent_id' => 0, 'name' => 'Assets', 'actype' => 1, 'status' => 1, 'deleted_at' => null, 'trtype' => 'Dr'],
                ['id' => 2, 'parent_id' => 0, 'name' => 'Liabilities', 'actype' => 1, 'status' => 1, 'deleted_at' => null, 'trtype' => 'Cr'],
                ['id' => 3, 'parent_id' => 0, 'name' => 'Equity', 'actype' => 1, 'status' => 1, 'deleted_at' => null, 'trtype' => 'Cr'],
                ['id' => 4, 'parent_id' => 0, 'name' => 'Direct Income', 'actype' => 2, 'status' => 1, 'deleted_at' => null, 'trtype' => 'Cr'],
                ['id' => 5, 'parent_id' => 0, 'name' => 'Indirect Income', 'actype' => 2, 'status' => 1, 'deleted_at' => null, 'trtype' => 'Cr'],
                ['id' => 6, 'parent_id' => 0, 'name' => 'Direct Expense', 'actype' => 2, 'status' => 1, 'deleted_at' => null, 'trtype' => 'Dr'],
                ['id' => 7, 'parent_id' => 0, 'name' => 'Indirect Expense', 'actype' => 2, 'status' => 1, 'deleted_at' => null, 'trtype' => 'Dr'],
                ['id' => 21, 'parent_id' => 1, 'name' => 'FIXED ASSETS', 'actype' => 0, 'status' => 1, 'deleted_at' => null, 'trtype' => ''],
                ['id' => 22, 'parent_id' => 1, 'name' => 'CURRENT ASSETS', 'actype' => 0, 'status' => 1, 'deleted_at' => null, 'trtype' => ''],
                ['id' => 23, 'parent_id' => 2, 'name' => 'CURRENT LIABLITIES', 'actype' => 0, 'status' => 1, 'deleted_at' => null, 'trtype' => ''],
                ['id' => 24, 'parent_id' => 3, 'name' => 'CAPITAL ', 'actype' => 0, 'status' => 1, 'deleted_at' => null, 'trtype' => ''],
                ['id' => 25, 'parent_id' => 3, 'name' => 'RETAINED PROFITS', 'actype' => 0, 'status' => 1, 'deleted_at' => null, 'trtype' => ''],
                ['id' => 27, 'parent_id' => 5, 'name' => 'OTHER INCOME', 'actype' => 0, 'status' => 1, 'deleted_at' => null, 'trtype' => ''],
                ['id' => 28, 'parent_id' => 6, 'name' => 'PURCHASE', 'actype' => 0, 'status' => 1, 'deleted_at' => null, 'trtype' => ''],
                ['id' => 30, 'parent_id' => 7, 'name' => 'INDIRECT EXP', 'actype' => 0, 'status' => 1, 'deleted_at' => null, 'trtype' => ''],
                ['id' => 31, 'parent_id' => 2, 'name' => 'LONG TERM LIABILITIES', 'actype' => 0, 'status' => 1, 'deleted_at' => null, 'trtype' => ''],
                ['id' => 32, 'parent_id' => 1, 'name' => 'INTANGIBLE ASSETS', 'actype' => 0, 'status' => 1, 'deleted_at' => null, 'trtype' => ''],
                ['id' => 36, 'parent_id' => 6, 'name' => 'EXPENSES', 'actype' => 0, 'status' => 1, 'deleted_at' => null, 'trtype' => ''],
                ['id' => 38, 'parent_id' => 3, 'name' => 'PARTNERS CURRENT A/C', 'actype' => 0, 'status' => 1, 'deleted_at' => null, 'trtype' => ''],
                ['id' => 42, 'parent_id' => 4, 'name' => 'REVENUE', 'actype' => 0, 'status' => 1, 'deleted_at' => null, 'trtype' => ''],
        ]);
    }
}
