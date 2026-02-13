<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantEnquirySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tenant_enquiry')->insert([
                ['id' => 4, 'enquiry_no' => '100', 'enquiry_date' => '2023-03-18', 'building_id' => 1, 'flat_no' => '', 'tenant' => 'TGR', 'description' => 'noo', 'deleted_at' => null, 'tenant_id' => 2517, 'status' => 0],
                ['id' => 5, 'enquiry_no' => '101', 'enquiry_date' => '2023-03-23', 'building_id' => 1, 'flat_no' => '', 'tenant' => 'TOM', 'description' => '', 'deleted_at' => null, 'tenant_id' => 2516, 'status' => 0],
                ['id' => 6, 'enquiry_no' => '102', 'enquiry_date' => '2023-03-24', 'building_id' => 1, 'flat_no' => '', 'tenant' => 'NUMAK TECHNOLOGY LLC', 'description' => '', 'deleted_at' => null, 'tenant_id' => 2497, 'status' => 0],
                ['id' => 7, 'enquiry_no' => '102', 'enquiry_date' => '2023-03-24', 'building_id' => 1, 'flat_no' => '', 'tenant' => 'NUMAK TECHNOLOGY LLC', 'description' => '', 'deleted_at' => null, 'tenant_id' => 2497, 'status' => 0],
                ['id' => 8, 'enquiry_no' => '100', 'enquiry_date' => '2023-03-31', 'building_id' => 1, 'flat_no' => '1', 'tenant' => 'bmnbmn', 'description' => 'njkh', 'deleted_at' => null, 'tenant_id' => 2518, 'status' => 0],
                ['id' => 9, 'enquiry_no' => '101', 'enquiry_date' => '2023-03-31', 'building_id' => 1, 'flat_no' => '1', 'tenant' => 'TOM', 'description' => 'vnbvn', 'deleted_at' => null, 'tenant_id' => 2516, 'status' => 0],
                ['id' => 10, 'enquiry_no' => '102', 'enquiry_date' => '2023-04-18', 'building_id' => 2, 'flat_no' => '3', 'tenant' => 'TGR', 'description' => 'test', 'deleted_at' => null, 'tenant_id' => 2517, 'status' => 0],
                ['id' => 11, 'enquiry_no' => '103', 'enquiry_date' => '2023-04-20', 'building_id' => 1, 'flat_no' => '6', 'tenant' => 'TCM', 'description' => 'jkhjkh', 'deleted_at' => null, 'tenant_id' => 2526, 'status' => 1],
        ]);
    }
}
