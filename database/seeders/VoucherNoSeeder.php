<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherNoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('voucher_no')->insert([
                ['id' => 1, 'voucher_type' => 'PO', 'no' => 100, 'status' => 1, 'name' => 'Purchase Order', 'prefix' => 'AA', 'autoincrement' => 1, 'modified_at' => '2026-02-03 12:49:28', 'department_id' => 1],
                ['id' => 2, 'voucher_type' => 'SDO', 'no' => 100, 'status' => 1, 'name' => 'Goods Receipt Note', 'prefix' => 'AA', 'autoincrement' => 1, 'modified_at' => '2026-02-04 00:14:11', 'department_id' => 1],
                ['id' => 3, 'voucher_type' => 'QS', 'no' => 100, 'status' => 1, 'name' => 'Quotation Sales', 'prefix' => 'QS', 'autoincrement' => 1, 'modified_at' => '2026-01-27 12:01:44', 'department_id' => 1],
                ['id' => 4, 'voucher_type' => 'QP', 'no' => 100, 'status' => 1, 'name' => 'Quotation Purchase', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 5, 'voucher_type' => 'SO', 'no' => 100, 'status' => 1, 'name' => 'Sales Order', 'prefix' => 'SO', 'autoincrement' => 1, 'modified_at' => '2026-01-27 12:54:53', 'department_id' => 1],
                ['id' => 6, 'voucher_type' => 'CDO', 'no' => 100, 'status' => 1, 'name' => 'Delivery Order', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '2026-01-27 15:29:48', 'department_id' => 1],
                ['id' => 7, 'voucher_type' => 'SI', 'no' => 100, 'status' => 1, 'name' => 'Sales Invoice', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 8, 'voucher_type' => 'CR', 'no' => 100, 'status' => 0, 'name' => '', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 9, 'voucher_type' => 'SP', 'no' => 100, 'status' => 0, 'name' => '', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 10, 'voucher_type' => 'JV', 'no' => 100, 'status' => 0, 'name' => '', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 11, 'voucher_type' => 'PI', 'no' => 100, 'status' => 1, 'name' => 'Purchase Invoice', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 12, 'voucher_type' => 'TI', 'no' => 100, 'status' => 0, 'name' => '', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 13, 'voucher_type' => 'GI', 'no' => 100, 'status' => 1, 'name' => 'Goods Issued', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 14, 'voucher_type' => 'GR', 'no' => 100, 'status' => 1, 'name' => 'Goods Return', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 15, 'voucher_type' => 'LT', 'no' => 100, 'status' => 1, 'name' => 'Location Transfer', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '2026-02-03 12:43:08', 'department_id' => 1],
                ['id' => 16, 'voucher_type' => 'TO', 'no' => 100, 'status' => 1, 'name' => 'Stock Transfer Out', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 17, 'voucher_type' => 'JE', 'no' => 100, 'status' => 1, 'name' => 'Job Estimate', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 18, 'voucher_type' => 'JO', 'no' => 100, 'status' => 1, 'name' => 'Job Order', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 19, 'voucher_type' => 'CE', 'no' => 100, 'status' => 1, 'name' => 'Customer Enquiry', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 20, 'voucher_type' => 'LD', 'no' => 100, 'status' => 1, 'name' => 'Lead Enquiry', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 21, 'voucher_type' => 'PrO', 'no' => 100, 'status' => 1, 'name' => 'Production Order', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 22, 'voucher_type' => 'MR', 'no' => 100, 'status' => 1, 'name' => 'Material Requisition', 'prefix' => 'MR', 'autoincrement' => 1, 'modified_at' => '2026-02-03 12:41:32', 'department_id' => 1],
                ['id' => 23, 'voucher_type' => 'JM', 'no' => 100, 'status' => 1, 'name' => 'Job Master', 'prefix' => 'J/', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 24, 'voucher_type' => 'CO', 'no' => 100, 'status' => 1, 'name' => 'Contract', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 25, 'voucher_type' => 'QR', 'no' => 100, 'status' => 1, 'name' => 'Quotation Rental', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 26, 'voucher_type' => 'CJ', 'no' => 100, 'status' => 1, 'name' => 'Cargo Entry Job No', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 27, 'voucher_type' => 'CWB', 'no' => 100, 'status' => 1, 'name' => 'Cargo Way Bill', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 28, 'voucher_type' => 'CDB', 'no' => 100, 'status' => 1, 'name' => 'Cargo Despatch Bill', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 29, 'voucher_type' => 'PL', 'no' => 100, 'status' => 1, 'name' => 'Packing List', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 30, 'voucher_type' => 'PR', 'no' => 100, 'status' => 1, 'name' => 'Purchase Return', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 31, 'voucher_type' => 'SR', 'no' => 100, 'status' => 1, 'name' => 'Sales Return', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 32, 'voucher_type' => 'MV', 'no' => 100, 'status' => 1, 'name' => 'Manufacture Voucher', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 33, 'voucher_type' => 'JI', 'no' => 100, 'status' => 1, 'name' => 'Job Invoice', 'prefix' => '', 'autoincrement' => 1, 'modified_at' => '0000-00-00 00:00:00', 'department_id' => 0],
                ['id' => 34, 'voucher_type' => 'PE', 'no' => 100, 'status' => 1, 'name' => 'Purchase Enquiry', 'prefix' => 'PE', 'autoincrement' => 1, 'modified_at' => '2026-02-03 12:47:32', 'department_id' => 1],
        ]);
    }
}
