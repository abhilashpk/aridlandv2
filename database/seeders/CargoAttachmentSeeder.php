<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoAttachmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cargo_attachment')->insert([
                ['id' => 1, 'cargo_receipt_id' => 2, 'file_name' => 'd2_585.jpg'],
                ['id' => 2, 'cargo_receipt_id' => 3, 'file_name' => 'pdf1_675.pdf'],
                ['id' => 3, 'cargo_receipt_id' => 6, 'file_name' => 'p3_343.jpg'],
                ['id' => 4, 'cargo_receipt_id' => 7, 'file_name' => 'but_732.png'],
                ['id' => 5, 'cargo_receipt_id' => 7, 'file_name' => 'd3_696.jpg'],
                ['id' => 6, 'cargo_receipt_id' => 7, 'file_name' => 'img_198.png'],
        ]);
    }
}
