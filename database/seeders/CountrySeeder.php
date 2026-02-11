<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('country')->insert([
                ['id' => 1, 'code' => '0007', 'name' => 'UAE', 'status' => 1, 'deleted_at' => null],
                ['id' => 2, 'code' => '0091', 'name' => 'India', 'status' => 1, 'deleted_at' => null],
                ['id' => 3, 'code' => 'US', 'name' => 'US', 'status' => 1, 'deleted_at' => null],
        ]);
    }
}
