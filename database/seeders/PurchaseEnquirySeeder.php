<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseEnquirySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('purchase_enquiry')->insert([
                ['id' => 19, 'prefix' => 'PEMSAF', 'voucher_no' => 'PE100', 'voucher_date' => '2026-02-02', 'job_id' => null, 'department_id' => 1, 'locfrom_id' => 33, 'description' => null, 'salesman_id' => null, 'total' => 480.0, 'discount' => 0, 'net_amount' => 480.0, 'status' => 1, 'created_at' => '2026-02-02 03:30:40', 'created_by' => 4, 'modify_at' => '2026-02-02 03:32:31', 'modify_by' => 4, 'deleted_at' => null, 'is_transfer' => 1, 'supplier_id' => 6207, 'location_id' => 1, 'foot_description' => null, 'approval_status' => 0, 'approved_by' => null, 'approved_at' => null, 'is_intercompany' => 0, 'is_draft' => 0],
                ['id' => 20, 'prefix' => 'PEMSAF', 'voucher_no' => 'PE101', 'voucher_date' => '2026-02-03', 'job_id' => null, 'department_id' => 1, 'locfrom_id' => 33, 'description' => null, 'salesman_id' => null, 'total' => 20000.0, 'discount' => 0, 'net_amount' => 20000.0, 'status' => 1, 'created_at' => '2026-02-03 12:46:25', 'created_by' => 4, 'modify_at' => '0000-00-00 00:00:00', 'modify_by' => 0, 'deleted_at' => null, 'is_transfer' => 1, 'supplier_id' => 6258, 'location_id' => 27, 'foot_description' => null, 'approval_status' => 0, 'approved_by' => null, 'approved_at' => null, 'is_intercompany' => 0, 'is_draft' => 0],
                ['id' => 21, 'prefix' => 'PEMSAF', 'voucher_no' => 'Draft-PE102', 'voucher_date' => '2026-02-03', 'job_id' => null, 'department_id' => 1, 'locfrom_id' => 33, 'description' => null, 'salesman_id' => null, 'total' => 0.0, 'discount' => 0, 'net_amount' => 0.0, 'status' => 1, 'created_at' => '2026-02-03 12:47:32', 'created_by' => 4, 'modify_at' => '0000-00-00 00:00:00', 'modify_by' => 0, 'deleted_at' => '2026-02-03 12:47:40', 'is_transfer' => 0, 'supplier_id' => 6258, 'location_id' => 28, 'foot_description' => null, 'approval_status' => 0, 'approved_by' => null, 'approved_at' => null, 'is_intercompany' => 0, 'is_draft' => 1],
        ]);
    }
}
