<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cargo_status')->insert([
                ['id' => 1, 'name' => 'AT SILA', 'type' => 1, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 2, 'name' => 'AT BATHA', 'type' => 1, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 3, 'name' => 'IN INSPECTION', 'type' => 1, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 4, 'name' => 'IN CLEARANCE', 'type' => 1, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 5, 'name' => 'WAITING FOR DUTY/GATE PASS', 'type' => 1, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 6, 'name' => 'CLEARED BORDER', 'type' => 1, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 7, 'name' => 'REACHED DESTINATION', 'type' => 1, 'is_reached' => 1, 'deleted_at' => null],
                ['id' => 8, 'name' => 'RETURN FROM BORDER', 'type' => 1, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 9, 'name' => 'DELIVERY COMPLETED', 'type' => 1, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 10, 'name' => 'HOLD AT BORDER', 'type' => 1, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 11, 'name' => 'OTHER', 'type' => 1, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 12, 'name' => 'PENDING', 'type' => 2, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 13, 'name' => 'DELIVERED', 'type' => 2, 'is_reached' => 1, 'deleted_at' => null],
                ['id' => 14, 'name' => 'CONSIGNMENT SHORT', 'type' => 2, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 15, 'name' => 'NOT RECEIVED', 'type' => 2, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 16, 'name' => 'MOBILE NO WRONG', 'type' => 2, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 17, 'name' => 'CONSIGNEE NOT RESPONDING', 'type' => 2, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 18, 'name' => 'HOLD-DUBAI OFFICE', 'type' => 2, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 19, 'name' => 'HOLD-OTEX', 'type' => 2, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 20, 'name' => 'CONSIGNEE REFUSED', 'type' => 2, 'is_reached' => 0, 'deleted_at' => null],
                ['id' => 21, 'name' => 'OTHER', 'type' => 2, 'is_reached' => 0, 'deleted_at' => null],
        ]);
    }
}
