<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuotFotosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('quot_fotos')->insert([
                ['id' => 15, 'quot_id' => 2, 'photo' => '369Majestic Car Care-Firewall Renewal.pdf', 'description' => ''],
        ]);
    }
}
