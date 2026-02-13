<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('area')->insert([
                ['id' => 1, 'code' => 'CR', 'name' => 'CR', 'status' => 1, 'deleted_at' => null],
        ]);
    }
}
