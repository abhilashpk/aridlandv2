<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderAssignSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_assign')->insert([
                ['id' => 1, 'driver_id' => 1, 'order_id' => 25, 'assign_date' => '2023-03-10', 'tr_status' => 1],
                ['id' => 2, 'driver_id' => 1, 'order_id' => 24, 'assign_date' => '2023-03-10', 'tr_status' => 0],
        ]);
    }
}
