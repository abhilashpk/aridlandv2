<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackingListSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('packing_list')->insert([
                ['id' => 1, 'voucher_no' => '101', 'voucher_date' => '2024-02-21', 'customer_id' => 5420, 'invoice_ids' => '1426', 'status' => 1, 'created_at' => '2024-02-21 10:50:58', 'created_by' => 4, 'modify_at' => '2024-02-21 10:51:14', 'modify_by' => 4, 'deleted_at' => '2024-02-21 11:10:16', 'invoice_nos' => '200', 'carton_qty' => 1, 'item_qty' => 1, 'description' => 'test'],
                ['id' => 2, 'voucher_no' => '102', 'voucher_date' => '2024-02-21', 'customer_id' => 5420, 'invoice_ids' => '3,1106', 'status' => 1, 'created_at' => '2024-02-21 11:56:09', 'created_by' => 27, 'modify_at' => '2024-02-21 09:39:41', 'modify_by' => 31, 'deleted_at' => null, 'invoice_nos' => '64760,65846', 'carton_qty' => 2, 'item_qty' => 4, 'description' => ''],
                ['id' => 3, 'voucher_no' => '103', 'voucher_date' => '2024-02-24', 'customer_id' => 8237, 'invoice_ids' => '1908,1985', 'status' => 1, 'created_at' => '2024-02-24 08:54:08', 'created_by' => 23, 'modify_at' => null, 'modify_by' => 0, 'deleted_at' => '2024-02-24 08:54:30', 'invoice_nos' => '66619,66695', 'carton_qty' => 0, 'item_qty' => 0, 'description' => ''],
                ['id' => 4, 'voucher_no' => '103', 'voucher_date' => '2024-02-24', 'customer_id' => 8237, 'invoice_ids' => '1908,1985', 'status' => 1, 'created_at' => '2024-02-24 08:54:10', 'created_by' => 23, 'modify_at' => null, 'modify_by' => 0, 'deleted_at' => '2024-02-24 11:26:15', 'invoice_nos' => '66619,66695', 'carton_qty' => 0, 'item_qty' => 0, 'description' => ''],
                ['id' => 5, 'voucher_no' => '105', 'voucher_date' => '2024-02-24', 'customer_id' => 8243, 'invoice_ids' => '2023', 'status' => 1, 'created_at' => '2024-02-24 11:28:26', 'created_by' => 23, 'modify_at' => '2024-02-24 11:59:49', 'modify_by' => 4, 'deleted_at' => null, 'invoice_nos' => '66733', 'carton_qty' => 1, 'item_qty' => 11, 'description' => 'CARTOON MARK: MN90 - HELENA CARGO - 3.65KGs'],
                ['id' => 6, 'voucher_no' => '106', 'voucher_date' => '2024-02-24', 'customer_id' => 7640, 'invoice_ids' => '296,2007', 'status' => 1, 'created_at' => '2024-02-24 12:09:15', 'created_by' => 4, 'modify_at' => '2024-02-24 01:44:42', 'modify_by' => 4, 'deleted_at' => null, 'invoice_nos' => '65297,66717', 'carton_qty' => 5, 'item_qty' => 515, 'description' => 'test description'],
        ]);
    }
}
