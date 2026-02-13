<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvanceDashboardSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('advance_dashboard')->insert([
                ['id' => 1, 'code' => 'SI', 'name' => 'Sales Invoice'],
                ['id' => 2, 'code' => 'SO', 'name' => 'Sales Order'],
                ['id' => 3, 'code' => 'DO', 'name' => 'Delivery Order'],
                ['id' => 4, 'code' => 'QS', 'name' => 'Quotation Sales'],
                ['id' => 5, 'code' => 'PO', 'name' => 'Purchase Order'],
                ['id' => 6, 'code' => 'PI', 'name' => 'Purchase Invoice'],
                ['id' => 7, 'code' => 'CR', 'name' => 'Customer'],
                ['id' => 8, 'code' => 'SR', 'name' => 'Supplier'],
                ['id' => 9, 'code' => 'IM', 'name' => 'Items'],
                ['id' => 10, 'code' => 'EM', 'name' => 'Employees'],
                ['id' => 11, 'code' => 'CH', 'name' => 'Cash'],
                ['id' => 12, 'code' => 'BK', 'name' => 'Bank'],
                ['id' => 13, 'code' => 'VR', 'name' => 'Voucher'],
                ['id' => 14, 'code' => 'APL', 'name' => 'Account Statement and Profit & Loss Report'],
                ['id' => 15, 'code' => 'TBS', 'name' => 'Trial Balance & Balance Sheet Report'],
                ['id' => 16, 'code' => 'QSL', 'name' => 'Quantity & Stock Ledger Report'],
                ['id' => 17, 'code' => 'PAT', 'name' => 'Profit Analysis & Transaction List'],
                ['id' => 18, 'code' => 'GS', 'name' => 'Graph Sales'],
                ['id' => 19, 'code' => 'GP', 'name' => 'Graph Purchase'],
                ['id' => 20, 'code' => 'GSR', 'name' => 'Graph Supplier'],
                ['id' => 21, 'code' => 'GCR', 'name' => 'Graph Customer'],
                ['id' => 22, 'code' => 'GPDC', 'name' => 'Graph PDC'],
                ['id' => 23, 'code' => 'AM', 'name' => 'Account Master'],
        ]);
    }
}
