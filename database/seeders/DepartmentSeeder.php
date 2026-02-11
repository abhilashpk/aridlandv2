<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('department')->insert([
                ['id' => 1, 'code' => 'ALD', 'name' => 'ARID LAND DEVELOPMENT TRADING', 'status' => 1, 'deleted_at' => null],
                ['id' => 2, 'code' => 'TAB', 'name' => 'TREES AND PALMS', 'status' => 1, 'deleted_at' => null],
                ['id' => 3, 'code' => 'DF', 'name' => 'DF', 'status' => 1, 'deleted_at' => null],
        ]);
    }
}
