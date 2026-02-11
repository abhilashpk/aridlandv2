<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvdashboardDetailsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('advdashboard_details')->insert([
                ['id' => 1, 'code' => 'SI'],
                ['id' => 2, 'code' => 'SO'],
                ['id' => 3, 'code' => 'DO'],
                ['id' => 5, 'code' => 'QS'],
                ['id' => 6, 'code' => 'PO'],
                ['id' => 8, 'code' => 'PI'],
                ['id' => 9, 'code' => 'CR'],
                ['id' => 10, 'code' => 'SR'],
                ['id' => 11, 'code' => 'IM'],
                ['id' => 12, 'code' => 'EM'],
                ['id' => 13, 'code' => 'BK'],
                ['id' => 14, 'code' => 'CH'],
                ['id' => 15, 'code' => 'VR'],
                ['id' => 16, 'code' => 'AM'],
                ['id' => 17, 'code' => 'APL'],
                ['id' => 19, 'code' => 'TBS'],
                ['id' => 20, 'code' => 'PAT'],
                ['id' => 21, 'code' => 'QSL'],
                ['id' => 22, 'code' => 'GS'],
                ['id' => 24, 'code' => 'GP'],
                ['id' => 26, 'code' => 'GSR'],
                ['id' => 29, 'code' => 'GCR'],
                ['id' => 30, 'code' => 'GPDC'],
        ]);
    }
}
