<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalDriverSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rental_driver')->insert([
                ['id' => 1, 'driver_name' => 'ASD', 'mobile1' => '897876', 'mobile2' => '554654', 'driver_type' => 'supplier', 'account_id' => 2498, 'deleted_at' => null, 'code' => '111'],
                ['id' => 2, 'driver_name' => 'XYZ', 'mobile1' => '234243', 'mobile2' => '', 'driver_type' => 'supplier', 'account_id' => 2499, 'deleted_at' => null, 'code' => '222'],
                ['id' => 3, 'driver_name' => 'MKN', 'mobile1' => '132121', 'mobile2' => '', 'driver_type' => 'customer', 'account_id' => 2497, 'deleted_at' => null, 'code' => '333'],
                ['id' => 4, 'driver_name' => 'OPQ', 'mobile1' => '34363', 'mobile2' => '', 'driver_type' => 'supplier', 'account_id' => 2498, 'deleted_at' => null, 'code' => '444'],
                ['id' => 5, 'driver_name' => 'SSD', 'mobile1' => '4124142', 'mobile2' => '', 'driver_type' => 'supplier', 'account_id' => 0, 'deleted_at' => null, 'code' => '5252'],
        ]);
    }
}
