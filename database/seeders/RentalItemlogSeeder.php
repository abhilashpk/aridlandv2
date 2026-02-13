<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalItemlogSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rental_itemlog')->insert([
                ['row_id' => 0, 'doc_type' => 'PIR', 'doc_id' => 14, 'voucher_date' => '2022-10-05', 'service_date' => '2022-10-10', 'driver_id' => 1, 'item_id' => 0, 'unit_id' => 1, 'qty' => 10, 'rate' => 200.0, 'trtype' => 1, 'deleted_at' => null],
                ['row_id' => 14, 'doc_type' => 'PIR', 'doc_id' => 15, 'voucher_date' => '2022-10-06', 'service_date' => '2022-10-08', 'driver_id' => 2, 'item_id' => 2, 'unit_id' => 2, 'qty' => 8, 'rate' => 180.0, 'trtype' => 1, 'deleted_at' => '2022-10-25 10:50:25'],
                ['row_id' => 15, 'doc_type' => 'PIR', 'doc_id' => 16, 'voucher_date' => '2022-10-25', 'service_date' => '2022-10-25', 'driver_id' => 1, 'item_id' => 1, 'unit_id' => 1, 'qty' => 50, 'rate' => 200.0, 'trtype' => 1, 'deleted_at' => null],
                ['row_id' => 16, 'doc_type' => 'PIR', 'doc_id' => 16, 'voucher_date' => '2022-10-25', 'service_date' => '2022-10-25', 'driver_id' => 4, 'item_id' => 2, 'unit_id' => 1, 'qty' => 100, 'rate' => 250.0, 'trtype' => 1, 'deleted_at' => null],
                ['row_id' => 7, 'doc_type' => 'SIR', 'doc_id' => 7, 'voucher_date' => '2022-10-25', 'service_date' => '2022-10-25', 'driver_id' => 3, 'item_id' => 1, 'unit_id' => 2, 'qty' => 5, 'rate' => 300.0, 'trtype' => 0, 'deleted_at' => null],
        ]);
    }
}
