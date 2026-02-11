<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChequeDetailsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cheque_details')->insert([
                ['id' => 1, 'cheque_no' => 3, 'cheque_date' => '2022-03-29', 'created_date' => '2022-03-24 19:57:56', 'amount_words' => ' Three Hundred and Forty Five and Sixty Seven Fils  Only', 'amount_number' => 345.67, 'customer_id' => 1766, 'bank_id' => 5, 'ac_payee' => 1, 'deleted_at' => '2022-03-24 20:06:27', 'doc_status' => 0],
                ['id' => 2, 'cheque_no' => 123, 'cheque_date' => '2022-03-16', 'created_date' => '2022-03-30 16:34:18', 'amount_words' => ' One Thousand Two Hundred and Fifty Two and   ZeroFils  Only', 'amount_number' => 1252.0, 'customer_id' => 1773, 'bank_id' => 1, 'ac_payee' => 1, 'deleted_at' => null, 'doc_status' => 0],
                ['id' => 3, 'cheque_no' => 571, 'cheque_date' => '2022-04-21', 'created_date' => '2022-04-01 11:40:06', 'amount_words' => ' Four Thousand Five Hundred Five and Fifty Fils  Only', 'amount_number' => 4505.5, 'customer_id' => 1766, 'bank_id' => 1, 'ac_payee' => 0, 'deleted_at' => null, 'doc_status' => 0],
                ['id' => 4, 'cheque_no' => 1313, 'cheque_date' => '2023-01-24', 'created_date' => '2023-01-23 15:39:05', 'amount_words' => ' Three Thousand Three Hundred Fifty and   ZeroFils  Only', 'amount_number' => 3350.0, 'customer_id' => 2497, 'bank_id' => 2, 'ac_payee' => 0, 'deleted_at' => null, 'doc_status' => 0],
                ['id' => 5, 'cheque_no' => 2147483647, 'cheque_date' => '2025-06-23', 'created_date' => '2025-06-21 13:31:46', 'amount_words' => ' One Hundred Thirty and   ZeroFils  Only', 'amount_number' => 130.0, 'customer_id' => 5974, 'bank_id' => 1, 'ac_payee' => 0, 'deleted_at' => null, 'doc_status' => 0],
                ['id' => 6, 'cheque_no' => 1254, 'cheque_date' => '2025-07-21', 'created_date' => '2025-07-22 19:53:41', 'amount_words' => ' Twenty Thousandand   ZeroFils  Only', 'amount_number' => 20000.0, 'customer_id' => 5987, 'bank_id' => 1, 'ac_payee' => 1, 'deleted_at' => null, 'doc_status' => 0],
        ]);
    }
}
