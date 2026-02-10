<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnquiryPhotosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('enquiry_photos')->insert([
                ['id' => 1, 'enquiry_id' => 5, 'photo' => '126download (1).jpg', 'description' => 'pic 1', 'deleted_at' => null],
                ['id' => 2, 'enquiry_id' => 5, 'photo' => '500download (1).png', 'description' => 'pic 2', 'deleted_at' => null],
        ]);
    }
}
