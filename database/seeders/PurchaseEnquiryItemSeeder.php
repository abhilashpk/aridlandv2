<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseEnquiryItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('purchase_enquiry_item')->insert([
                ['id' => 25, 'purchase_enquiry_id' => 19, 'item_id' => 50, 'item_name' => 'LOC ITM 2', 'unit_id' => 2, 'quantity' => 4, 'unit_price' => 120, 'total_price' => 480.0, 'status' => 1, 'deleted_at' => null, 'is_editable' => 0, 'is_transfer' => 1, 'balance_quantity' => 0.0, 'remarks' => '0'],
                ['id' => 26, 'purchase_enquiry_id' => 20, 'item_id' => 52, 'item_name' => 'Fortigate 80f', 'unit_id' => 2, 'quantity' => 25, 'unit_price' => 800, 'total_price' => 20000.0, 'status' => 1, 'deleted_at' => null, 'is_editable' => 0, 'is_transfer' => 1, 'balance_quantity' => 0.0, 'remarks' => '0'],
                ['id' => 27, 'purchase_enquiry_id' => 21, 'item_id' => 38, 'item_name' => 'ball', 'unit_id' => 1, 'quantity' => 600, 'unit_price' => 0, 'total_price' => 0.0, 'status' => 1, 'deleted_at' => null, 'is_editable' => 0, 'is_transfer' => 0, 'balance_quantity' => null, 'remarks' => '0'],
        ]);
    }
}
