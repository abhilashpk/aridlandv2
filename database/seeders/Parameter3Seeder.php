<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Parameter3Seeder extends Seeder
{
    public function run(): void
    {
        DB::table('parameter3')->insert([
                ['id' => 1, 'location_id' => 2, 'account_id' => 0],
                ['id' => 2, 'location_id' => 3, 'account_id' => 0],
                ['id' => 3, 'location_id' => 4, 'account_id' => 0],
                ['id' => 4, 'location_id' => 5, 'account_id' => 0],
                ['id' => 5, 'location_id' => 6, 'account_id' => 0],
                ['id' => 6, 'location_id' => 20, 'account_id' => 0],
                ['id' => 7, 'location_id' => 21, 'account_id' => 0],
        ]);
    }
}
