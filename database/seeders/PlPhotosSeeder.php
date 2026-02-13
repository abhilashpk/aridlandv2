<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlPhotosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pl_photos')->insert([
                ['id' => 1, 'timesheet_id' => 3, 'photo' => '658customer frame.jpg', 'description' => ''],
        ]);
    }
}
