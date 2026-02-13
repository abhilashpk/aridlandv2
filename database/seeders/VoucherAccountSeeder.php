<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherAccountSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('voucher_account')->insert([
                ['id' => 1, 'account_name' => 'Stock', 'account_field' => 'stock', 'account_id' => 0],
                ['id' => 2, 'account_name' => 'Cost of Sale', 'account_field' => 'cost_of_sale', 'account_id' => 0],
        ]);
    }
}
