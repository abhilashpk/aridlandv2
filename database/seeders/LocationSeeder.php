<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('location')->insert([
                ['id' => 1, 'code' => 'MAQ', 'name' => 'MAFRAQ', 'is_default' => 1, 'status' => 1, 'department_id' => 1, 'deleted_at' => null, 'is_conloc' => 0, 'customer_id' => 0, 'is_minus_qty' => 0],
                ['id' => 33, 'code' => 'MSAF', 'name' => 'MUSAFFAH', 'is_default' => 1, 'status' => 1, 'department_id' => 2, 'deleted_at' => null, 'is_conloc' => 0, 'customer_id' => 0, 'is_minus_qty' => 0],
        ]);
    }
}
