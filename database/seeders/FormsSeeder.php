<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('forms')->insert([
                ['id' => 1, 'code' => 'SI', 'name' => 'Sales Invoice', 'status' => 1],
                ['id' => 2, 'code' => 'DO', 'name' => 'Delivery Order', 'status' => 1],
                ['id' => 3, 'code' => 'SO', 'name' => 'Sales Order', 'status' => 1],
                ['id' => 4, 'code' => 'QS', 'name' => 'Quotation Sales', 'status' => 1],
                ['id' => 5, 'code' => 'SR', 'name' => 'Sales Return', 'status' => 1],
                ['id' => 6, 'code' => 'PR', 'name' => 'Purchase Return', 'status' => 1],
                ['id' => 7, 'code' => 'PI', 'name' => 'Purchase Invoice', 'status' => 1],
                ['id' => 8, 'code' => 'PO', 'name' => 'Purchase Order', 'status' => 1],
                ['id' => 9, 'code' => 'RV', 'name' => 'Customer Receipts', 'status' => 1],
                ['id' => 10, 'code' => 'PV', 'name' => 'Supplier Payment', 'status' => 1],
                ['id' => 11, 'code' => 'JE', 'name' => 'Job Estimate', 'status' => 1],
                ['id' => 12, 'code' => 'JO', 'name' => 'Job Order', 'status' => 1],
                ['id' => 13, 'code' => 'JI', 'name' => 'Job Invoice', 'status' => 1],
                ['id' => 14, 'code' => 'IE', 'name' => 'Item Enquiry', 'status' => 1],
                ['id' => 15, 'code' => 'CE', 'name' => 'Customer Enquiry', 'status' => 1],
                ['id' => 16, 'code' => 'PrO', 'name' => 'Production Order', 'status' => 1],
                ['id' => 17, 'code' => 'ITMAD', 'name' => 'Item Add', 'status' => 1],
                ['id' => 18, 'code' => 'GRN', 'name' => 'Goods Receipt Note', 'status' => 1],
                ['id' => 19, 'code' => 'MR', 'name' => 'Material Requisition', 'status' => 1],
                ['id' => 20, 'code' => 'JM', 'name' => 'Job Master', 'status' => 1],
                ['id' => 21, 'code' => 'JOA', 'name' => 'Job Order Advanced', 'status' => 1],
                ['id' => 22, 'code' => 'QP', 'name' => 'Quotation Purchase', 'status' => 1],
                ['id' => 23, 'code' => 'STI', 'name' => 'Stock Transfer in', 'status' => 1],
                ['id' => 24, 'code' => 'STO', 'name' => 'Stock Transfer out', 'status' => 1],
                ['id' => 25, 'code' => 'AM', 'name' => 'Accounts Master', 'status' => 1],
                ['id' => 26, 'code' => 'GIN', 'name' => 'Goods Issued Note', 'status' => 1],
                ['id' => 27, 'code' => 'MV', 'name' => 'Manufacture Voucher', 'status' => 1],
                ['id' => 28, 'code' => 'EM', 'name' => 'Employee', 'status' => 1],
                ['id' => 29, 'code' => 'PS', 'name' => 'Purchase Split', 'status' => 1],
                ['id' => 30, 'code' => 'SS', 'name' => 'Sales Split', 'status' => 1],
                ['id' => 31, 'code' => 'DCS', 'name' => 'Dashboard Customer/Supplier', 'status' => 1],
                ['id' => 32, 'code' => 'SSR', 'name' => 'Sales Split Return', 'status' => 1],
                ['id' => 33, 'code' => 'PSR', 'name' => 'Purchase Split Return', 'status' => 1],
                ['id' => 34, 'code' => 'PE', 'name' => 'Purchase Enquiry', 'status' => 1],
        ]);
    }
}
