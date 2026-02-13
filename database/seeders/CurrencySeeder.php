<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('currency')->insert([
                ['id' => 1, 'code' => 'DHS', 'name' => 'DHS', 'rate' => 0.104822, 'fracode' => '', 'decimal_place' => 8, 'status' => 1, 'deleted_at' => null, 'is_default' => 1, 'decimal_name' => 'Fills'],
                ['id' => 2, 'code' => 'USD', 'name' => 'USD', 'rate' => 3.674, 'fracode' => '', 'decimal_place' => 0, 'status' => 1, 'deleted_at' => null, 'is_default' => 0, 'decimal_name' => 'Cents'],
                ['id' => 3, 'code' => 'AED', 'name' => 'AED', 'rate' => 1, 'fracode' => '', 'decimal_place' => 0, 'status' => 1, 'deleted_at' => '2020-03-06 10:54:36', 'is_default' => 0, 'decimal_name' => ''],
                ['id' => 4, 'code' => 'AED', 'name' => 'AED', 'rate' => 0, 'fracode' => '', 'decimal_place' => 0, 'status' => 1, 'deleted_at' => '2020-03-06 11:03:45', 'is_default' => 0, 'decimal_name' => ''],
                ['id' => 5, 'code' => 'OMR', 'name' => 'OMANI RIYAL', 'rate' => 0, 'fracode' => '', 'decimal_place' => 0, 'status' => 1, 'deleted_at' => null, 'is_default' => 0, 'decimal_name' => ''],
                ['id' => 6, 'code' => 'INR', 'name' => 'Rupee', 'rate' => 0, 'fracode' => '', 'decimal_place' => 0, 'status' => 1, 'deleted_at' => '2025-06-20 12:03:30', 'is_default' => 0, 'decimal_name' => ''],
                ['id' => 7, 'code' => 'INR', 'name' => 'INR', 'rate' => 25.5, 'fracode' => null, 'decimal_place' => null, 'status' => 1, 'deleted_at' => null, 'is_default' => 0, 'decimal_name' => 'PS'],
        ]);
    }
}
