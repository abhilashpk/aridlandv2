<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoDespatchStatusLogSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cargo_despatch_status_log')->insert([
                ['despatch_id' => 8, 'status_id' => 7, 'created_at' => '2022-10-28 13:03:28', 'created_by' => 4, 'date' => '0000-00-00'],
                ['despatch_id' => 7, 'status_id' => 7, 'created_at' => '2022-10-28 13:03:54', 'created_by' => 4, 'date' => '0000-00-00'],
                ['despatch_id' => 9, 'status_id' => 5, 'created_at' => '2022-10-28 13:13:10', 'created_by' => 4, 'date' => '0000-00-00'],
                ['despatch_id' => 9, 'status_id' => 6, 'created_at' => '2022-10-28 13:13:43', 'created_by' => 4, 'date' => '0000-00-00'],
                ['despatch_id' => 9, 'status_id' => 7, 'created_at' => '2022-10-28 13:14:04', 'created_by' => 4, 'date' => '0000-00-00'],
        ]);
    }
}
