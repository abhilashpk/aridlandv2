<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('voucher_type')->insert([
                ['id' => 1, 'name' => 'Purchase Stock', 'status' => 1],
                ['id' => 2, 'name' => 'Purchase Return', 'status' => 1],
                ['id' => 3, 'name' => 'Sales Stock', 'status' => 1],
                ['id' => 4, 'name' => 'Sales Return', 'status' => 1],
                ['id' => 5, 'name' => 'Purchase Non Stock', 'status' => 1],
                ['id' => 6, 'name' => 'Sales Non Stock', 'status' => 1],
                ['id' => 7, 'name' => 'Credit Note', 'status' => 1],
                ['id' => 8, 'name' => 'Debit Note', 'status' => 1],
                ['id' => 9, 'name' => 'Receipt Voucher', 'status' => 1],
                ['id' => 10, 'name' => 'Payment Voucher', 'status' => 1],
                ['id' => 13, 'name' => 'Goods Issued Note', 'status' => 1],
                ['id' => 14, 'name' => 'Goods Return From Site', 'status' => 1],
                ['id' => 15, 'name' => 'Manufacturing Voucher', 'status' => 1],
                ['id' => 16, 'name' => 'Journal Voucher', 'status' => 1],
                ['id' => 17, 'name' => 'Adjustment Voucher', 'status' => 1],
                ['id' => 18, 'name' => 'PDC Received', 'status' => 1],
                ['id' => 19, 'name' => 'PDC Issued', 'status' => 1],
                ['id' => 20, 'name' => 'Petty Cash', 'status' => 1],
                ['id' => 21, 'name' => 'Stock Transfer in', 'status' => 1],
                ['id' => 22, 'name' => 'Stock Transfer out', 'status' => 1],
                ['id' => 23, 'name' => 'Purchase Split', 'status' => 1],
                ['id' => 24, 'name' => 'Sales Split', 'status' => 1],
                ['id' => 25, 'name' => 'Purchase Rental', 'status' => 1],
                ['id' => 26, 'name' => 'Sales Rental', 'status' => 1],
                ['id' => 27, 'name' => 'Contra Voucher', 'status' => 1],
                ['id' => 28, 'name' => 'Manual Journal', 'status' => 1],
                ['id' => 29, 'name' => 'Sales Split Return', 'status' => 1],
                ['id' => 30, 'name' => 'Purchase Split Return', 'status' => 1],
        ]);
    }
}
