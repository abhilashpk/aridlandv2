<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeterReadingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('meter_reading')->insert([
                ['id' => 45, 'contract_id' => 8, 'previous' => 500, 'current' => 600, 'created_at' => '2023-04-13 05:27:29', 'created_by' => 4, 'rate' => 10, 'cons_unit' => 100, 'total' => 1000.0, 'vat' => 50.0, 'grand_total' => 1060.0, 'deleted_at' => null, 'sin_no' => '119', 'from_date' => '2023-03-01', 'to_date' => '2023-03-31', 'is_read' => 1],
                ['id' => 46, 'contract_id' => 16, 'previous' => 100, 'current' => 200, 'created_at' => '2023-04-13 06:07:22', 'created_by' => 4, 'rate' => 60, 'cons_unit' => 100, 'total' => 6000.0, 'vat' => 300.0, 'grand_total' => 6350.0, 'deleted_at' => null, 'sin_no' => '120', 'from_date' => '2023-03-01', 'to_date' => '2023-03-31', 'is_read' => 1],
                ['id' => 47, 'contract_id' => 8, 'previous' => 750, 'current' => 800, 'created_at' => '2023-04-13 09:35:16', 'created_by' => 4, 'rate' => 10, 'cons_unit' => 50, 'total' => 500.0, 'vat' => 25.0, 'grand_total' => 525.0, 'deleted_at' => null, 'sin_no' => '121', 'from_date' => '2023-04-01', 'to_date' => '2023-04-14', 'is_read' => 1],
                ['id' => 48, 'contract_id' => 14, 'previous' => 250, 'current' => 375, 'created_at' => '2023-04-13 09:39:26', 'created_by' => 4, 'rate' => 60, 'cons_unit' => 125, 'total' => 7500.0, 'vat' => 375.0, 'grand_total' => 7875.0, 'deleted_at' => null, 'sin_no' => '122', 'from_date' => '2023-03-01', 'to_date' => '2023-03-31', 'is_read' => 1],
                ['id' => 49, 'contract_id' => 14, 'previous' => 375, 'current' => 450, 'created_at' => '2023-04-14 03:46:08', 'created_by' => 4, 'rate' => 60, 'cons_unit' => 75, 'total' => 4500.0, 'vat' => 225.0, 'grand_total' => 4825.0, 'deleted_at' => null, 'sin_no' => '123', 'from_date' => '2023-04-01', 'to_date' => '2023-04-30', 'is_read' => 1],
                ['id' => 50, 'contract_id' => 14, 'previous' => 450, 'current' => 570, 'created_at' => '2023-04-14 04:07:17', 'created_by' => 4, 'rate' => 60, 'cons_unit' => 120, 'total' => 7200.0, 'vat' => 360.0, 'grand_total' => 7560.0, 'deleted_at' => null, 'sin_no' => '124', 'from_date' => '2023-05-01', 'to_date' => '2023-05-31', 'is_read' => 0],
                ['id' => 51, 'contract_id' => 14, 'previous' => 450, 'current' => 600, 'created_at' => '2023-04-14 04:10:02', 'created_by' => 4, 'rate' => 60, 'cons_unit' => 150, 'total' => 9000.0, 'vat' => 450.0, 'grand_total' => 9450.0, 'deleted_at' => null, 'sin_no' => '125', 'from_date' => '2023-05-01', 'to_date' => '2023-05-31', 'is_read' => 0],
                ['id' => 52, 'contract_id' => 14, 'previous' => 450, 'current' => 600, 'created_at' => '2023-04-14 04:10:40', 'created_by' => 4, 'rate' => 60, 'cons_unit' => 150, 'total' => 9000.0, 'vat' => 450.0, 'grand_total' => 9450.0, 'deleted_at' => null, 'sin_no' => '126', 'from_date' => '2023-05-01', 'to_date' => '2023-05-31', 'is_read' => 0],
                ['id' => 53, 'contract_id' => 18, 'previous' => 0, 'current' => 110, 'created_at' => '2023-04-18 11:33:22', 'created_by' => 4, 'rate' => 0, 'cons_unit' => 0, 'total' => 0.0, 'vat' => 0.0, 'grand_total' => 0.0, 'deleted_at' => null, 'sin_no' => '0', 'from_date' => '0000-00-00', 'to_date' => '0000-00-00', 'is_read' => 1],
                ['id' => 54, 'contract_id' => 18, 'previous' => 110, 'current' => 250, 'created_at' => '2023-04-18 11:35:24', 'created_by' => 4, 'rate' => 60, 'cons_unit' => 140, 'total' => 8400.0, 'vat' => 420.0, 'grand_total' => 8830.0, 'deleted_at' => null, 'sin_no' => '129', 'from_date' => '2023-03-01', 'to_date' => '2023-03-31', 'is_read' => 0],
        ]);
    }
}
