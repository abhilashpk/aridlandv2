<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisconnectionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('disconnection')->insert([
                ['id' => 4, 'contract_id' => 13, 'previous' => 2000, 'current' => 2100, 'created_at' => '2023-04-06 09:28:05', 'created_by' => 4, 'rate' => 60, 'cons_unit' => 100, 'total' => 6000.0, 'vat' => 300.0, 'grand_total' => 6460.0, 'deleted_at' => null, 'sin_no' => '117'],
        ]);
    }
}
