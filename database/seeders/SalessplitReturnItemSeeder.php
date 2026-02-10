<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalessplitReturnItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('salessplit_return_item')->insert([
                ['id' => 8, 'salessplit_return_id' => 15, 'account_id' => 2753, 'item_description' => 'TEL. EXP', 'unit_id' => 'NOS', 'quantity' => 1, 'unit_price' => 1500.0, 'vat' => 5, 'item_vat' => 75, 'item_jobid' => 0, 'tax_code' => 'SR', 'tax_include' => 0, 'item_total' => 1500.0, 'unit_price_fc' => 1500.0, 'item_vat_fc' => 75.0, 'line_total' => 1500.0, 'line_total_fc' => 1500.0, 'item_total_fc' => 1500.0, 'status' => 1, 'deleted_at' => null, 'sales_split_return_id' => 15],
                ['id' => 9, 'salessplit_return_id' => 15, 'account_id' => 5451, 'item_description' => 'RAK BANK', 'unit_id' => 'NOS', 'quantity' => 1, 'unit_price' => 1600.0, 'vat' => 5, 'item_vat' => 80, 'item_jobid' => 0, 'tax_code' => 'SR', 'tax_include' => 0, 'item_total' => 1600.0, 'unit_price_fc' => 1600.0, 'item_vat_fc' => 80.0, 'line_total' => 1600.0, 'line_total_fc' => 1600.0, 'item_total_fc' => 1600.0, 'status' => 1, 'deleted_at' => null, 'sales_split_return_id' => 15],
                ['id' => 10, 'salessplit_return_id' => 16, 'account_id' => 5961, 'item_description' => 'Credit Note', 'unit_id' => 'NOS', 'quantity' => 1, 'unit_price' => 150.0, 'vat' => 5, 'item_vat' => 7.5, 'item_jobid' => 197, 'tax_code' => 'SR', 'tax_include' => 0, 'item_total' => 150.0, 'unit_price_fc' => 150.0, 'item_vat_fc' => 7.5, 'line_total' => 150.0, 'line_total_fc' => 150.0, 'item_total_fc' => 150.0, 'status' => 1, 'deleted_at' => null, 'sales_split_return_id' => 16],
                ['id' => 11, 'salessplit_return_id' => 16, 'account_id' => 5961, 'item_description' => 'Credit Note', 'unit_id' => 'NOS', 'quantity' => 1, 'unit_price' => 350.0, 'vat' => 5, 'item_vat' => 17.5, 'item_jobid' => 197, 'tax_code' => 'SR', 'tax_include' => 0, 'item_total' => 350.0, 'unit_price_fc' => 350.0, 'item_vat_fc' => 17.5, 'line_total' => 350.0, 'line_total_fc' => 350.0, 'item_total_fc' => 350.0, 'status' => 1, 'deleted_at' => null, 'sales_split_return_id' => 16],
                ['id' => 12, 'salessplit_return_id' => 17, 'account_id' => 5956, 'item_description' => 'Do Charges(Income)', 'unit_id' => 'NOS', 'quantity' => 1, 'unit_price' => 500.0, 'vat' => 5, 'item_vat' => 25, 'item_jobid' => 200, 'tax_code' => 'SR', 'tax_include' => 0, 'item_total' => 500.0, 'unit_price_fc' => 500.0, 'item_vat_fc' => 25.0, 'line_total' => 500.0, 'line_total_fc' => 500.0, 'item_total_fc' => 500.0, 'status' => 1, 'deleted_at' => null, 'sales_split_return_id' => 17],
                ['id' => 13, 'salessplit_return_id' => 18, 'account_id' => 5956, 'item_description' => 'Credit Note', 'unit_id' => 'NOS', 'quantity' => 1, 'unit_price' => 250.0, 'vat' => 5, 'item_vat' => 12.5, 'item_jobid' => 201, 'tax_code' => 'SR', 'tax_include' => 0, 'item_total' => 250.0, 'unit_price_fc' => 250.0, 'item_vat_fc' => 12.5, 'line_total' => 250.0, 'line_total_fc' => 250.0, 'item_total_fc' => 250.0, 'status' => 1, 'deleted_at' => null, 'sales_split_return_id' => 18],
                ['id' => 14, 'salessplit_return_id' => 19, 'account_id' => 5956, 'item_description' => 'Do Charges(Income)', 'unit_id' => 'NOS', 'quantity' => 1, 'unit_price' => 50.0, 'vat' => 5, 'item_vat' => 2.5, 'item_jobid' => 196, 'tax_code' => 'SR', 'tax_include' => 0, 'item_total' => 50.0, 'unit_price_fc' => 50.0, 'item_vat_fc' => 2.5, 'line_total' => 50.0, 'line_total_fc' => 50.0, 'item_total_fc' => 50.0, 'status' => 1, 'deleted_at' => null, 'sales_split_return_id' => 19],
        ]);
    }
}
