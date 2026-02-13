<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractTypeReSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contract_type_re')->insert([
                ['id' => 1, 'building_id' => 1, 'type' => 'HB', 'increment_no' => 517, 'created_at' => '2023-04-13 04:52:17', 'deleted_at' => null],
                ['id' => 2, 'building_id' => 1, 'type' => 'HB', 'increment_no' => 116, 'created_at' => '2023-04-21 10:25:39', 'deleted_at' => null],
                ['id' => 3, 'building_id' => 1, 'type' => 'HB', 'increment_no' => 2, 'created_at' => '2023-04-06 09:25:43', 'deleted_at' => null],
        ]);
    }
}
