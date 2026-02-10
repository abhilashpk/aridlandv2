<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MfgWastageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mfg_wastage')->insert([
                ['id' => 3, 'manufacture_id' => 25, 'item_id' => 36, 'quantity' => 0.25, 'unit_price' => 25, 'total' => 6.25, 'deleted_at' => null],
                ['id' => 4, 'manufacture_id' => 25, 'item_id' => 37, 'quantity' => 0.36, 'unit_price' => 100, 'total' => 36, 'deleted_at' => null],
                ['id' => 5, 'manufacture_id' => 27, 'item_id' => 36, 'quantity' => 0.6, 'unit_price' => 25, 'total' => 15, 'deleted_at' => null],
                ['id' => 6, 'manufacture_id' => 27, 'item_id' => 37, 'quantity' => 0.45, 'unit_price' => 100, 'total' => 45, 'deleted_at' => null],
                ['id' => 9, 'manufacture_id' => 22, 'item_id' => 36, 'quantity' => 0.35, 'unit_price' => 25, 'total' => 8.75, 'deleted_at' => null],
                ['id' => 10, 'manufacture_id' => 22, 'item_id' => 37, 'quantity' => 0.45, 'unit_price' => 100, 'total' => 45, 'deleted_at' => null],
                ['id' => 11, 'manufacture_id' => 3, 'item_id' => 2, 'quantity' => 1, 'unit_price' => 101, 'total' => 101, 'deleted_at' => null],
        ]);
    }
}
