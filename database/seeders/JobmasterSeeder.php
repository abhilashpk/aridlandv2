<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobmasterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jobmaster')->insert([
                ['id' => 44, 'code' => 'SL001', 'name' => 'SALARY', 'open_cost' => 0, 'customer_id' => 0, 'department_id' => 0, 'salesman_id' => 0, 'open_income' => 0, 'is_close' => 0, 'contract_amount' => 0, 'start_date' => '0000-00-00', 'end_date' => '0000-00-00', 'status' => 1, 'deleted_at' => null, 'incexp' => 0, 'vehicle_id' => 0, 'is_salary_job' => 1, 'transport_type' => '', 'packing' => '', 'date' => '0000-00-00', 'address' => '', 'mbl' => '', 'house_bl_no' => '', 'origin' => '', 'hbl' => '', 'por' => '', 'fnd' => '', 'no_of_pieces' => 0, 'volume' => 0, 'gross_weight' => 0, 'destination' => '', 'flight_no' => '', 'chargeable_weight' => 0, 'be_no' => '', 'flight_date' => '0000-00-00', 'container_no' => '', 'is_subjob' => 0, 'shipper' => '', 'consignee' => ''],
        ]);
    }
}
