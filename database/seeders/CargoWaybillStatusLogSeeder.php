<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoWaybillStatusLogSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cargo_waybill_status_log')->insert([
                ['waybill_id' => 2, 'status_id' => 14, 'created_at' => '2022-10-28 12:25:13', 'created_by' => 4],
                ['waybill_id' => 11, 'status_id' => 17, 'created_at' => '2022-10-28 12:48:27', 'created_by' => 4],
                ['waybill_id' => 11, 'status_id' => 13, 'created_at' => '2022-10-28 12:48:52', 'created_by' => 4],
                ['waybill_id' => 20, 'status_id' => 12, 'created_at' => '2022-10-28 13:39:49', 'created_by' => 4],
        ]);
    }
}
