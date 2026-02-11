<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('units')->insert([
                ['id' => 1, 'unit_name' => 'NOS', 'description' => 'NOS', 'fracount' => 0, 'status' => 1, 'deleted_at' => null],
                ['id' => 2, 'unit_name' => 'PCS', 'description' => 'PCS', 'fracount' => 0, 'status' => 1, 'deleted_at' => null],
                ['id' => 3, 'unit_name' => 'CTN', 'description' => 'CTN', 'fracount' => 0, 'status' => 1, 'deleted_at' => null],
                ['id' => 4, 'unit_name' => 'BOX', 'description' => 'BOX', 'fracount' => 0, 'status' => 1, 'deleted_at' => null],
                ['id' => 5, 'unit_name' => 'GM', 'description' => 'GM', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 6, 'unit_name' => 'PKT', 'description' => 'PKT', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 16, 'unit_name' => 'SET', 'description' => 'SET', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 18, 'unit_name' => 'ROLL', 'description' => 'ROLL', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 19, 'unit_name' => 'REEM', 'description' => 'REEM', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 20, 'unit_name' => 'LTR', 'description' => 'LTR', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 21, 'unit_name' => 'PAIR', 'description' => 'PAIR', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 22, 'unit_name' => 'LGTH', 'description' => 'LGTH', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 23, 'unit_name' => 'DOZ', 'description' => 'DOZ', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 25, 'unit_name' => 'KG', 'description' => 'KG', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 26, 'unit_name' => 'MTR', 'description' => 'MTR', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 27, 'unit_name' => 'CASE', 'description' => 'CASE', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 28, 'unit_name' => 'GLN', 'description' => 'GLN', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 29, 'unit_name' => 'KL', 'description' => 'KILO', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2019-11-30 10:47:49'],
                ['id' => 30, 'unit_name' => 'KL', 'description' => 'KILO', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 31, 'unit_name' => 'BTL', 'description' => 'BOTTLEH', 'fracount' => 15, 'status' => 1, 'deleted_at' => '2022-05-06 14:48:48'],
                ['id' => 32, 'unit_name' => 'SQM', 'description' => 'Sq.Meter', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 33, 'unit_name' => 'EACH', 'description' => 'EACH', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-04-16 13:40:19'],
                ['id' => 34, 'unit_name' => 'DOZ', 'description' => 'DOZ', 'fracount' => 0, 'status' => 1, 'deleted_at' => null],
                ['id' => 35, 'unit_name' => 'KG', 'description' => 'KG', 'fracount' => 0, 'status' => 1, 'deleted_at' => null],
                ['id' => 36, 'unit_name' => 'UNIT', 'description' => 'UNIT', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2024-05-30 14:23:45'],
                ['id' => 37, 'unit_name' => 'STATS', 'description' => 'STATS ', 'fracount' => 2, 'status' => 1, 'deleted_at' => '2024-05-30 14:23:45'],
                ['id' => 38, 'unit_name' => 'NO', 'description' => 'NUMBERS', 'fracount' => 3, 'status' => 1, 'deleted_at' => '2024-05-30 14:23:45'],
                ['id' => 39, 'unit_name' => 'Lit', 'description' => 'Lit', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2025-04-07 18:18:34'],
                ['id' => 40, 'unit_name' => 'm²', 'description' => 'm²', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2025-04-07 18:18:34'],
                ['id' => 41, 'unit_name' => 'METERS', 'description' => 'METERS', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2025-04-07 18:18:34'],
                ['id' => 42, 'unit_name' => 'NOS.', 'description' => 'NOS.', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2025-05-16 03:39:44'],
                ['id' => 43, 'unit_name' => 'Hourly', 'description' => 'Hourly', 'fracount' => 0, 'status' => 1, 'deleted_at' => null],
                ['id' => 44, 'unit_name' => 'Daily', 'description' => 'Daily', 'fracount' => 0, 'status' => 1, 'deleted_at' => null],
                ['id' => 45, 'unit_name' => 'Montly ', 'description' => 'Montly ', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2025-04-07 18:18:34'],
                ['id' => 46, 'unit_name' => 'NONE', 'description' => 'NONE', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2025-04-07 18:18:34'],
                ['id' => 47, 'unit_name' => 'RL', 'description' => 'RL', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2025-04-07 18:18:34'],
                ['id' => 48, 'unit_name' => 'CTN01', 'description' => 'CTN01', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2025-06-07 12:21:22'],
                ['id' => 49, 'unit_name' => 'BOX01', 'description' => 'BOX01', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2025-06-07 12:21:22'],
                ['id' => 50, 'unit_name' => 'Minutes', 'description' => 'Minutes', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2025-06-07 12:21:22'],
                ['id' => 51, 'unit_name' => 'Seconds ', 'description' => 'Seconds', 'fracount' => 0, 'status' => 1, 'deleted_at' => '2025-06-07 12:21:22'],
                ['id' => 53, 'unit_name' => 'N1', 'description' => 'D1', 'fracount' => null, 'status' => 1, 'deleted_at' => '2026-02-03 12:25:42'],
                ['id' => 54, 'unit_name' => 'B1', 'description' => null, 'fracount' => null, 'status' => 1, 'deleted_at' => '2026-02-03 12:25:25'],
        ]);
    }
}
