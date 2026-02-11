<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiPhotosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('si_photos')->insert([
                ['id' => 2, 'invoice_id' => 41, 'photo' => '55img.png', 'description' => 'two'],
                ['id' => 3, 'invoice_id' => 41, 'photo' => '174d3.jpg', 'description' => 'three'],
                ['id' => 4, 'invoice_id' => 42, 'photo' => '70pdf1.pdf', 'description' => 'hjkhkj'],
                ['id' => 5, 'invoice_id' => 42, 'photo' => '13pdf2.pdf', 'description' => 'bmnbn'],
                ['id' => 6, 'invoice_id' => 43, 'photo' => '303cold-999972__340.webp', 'description' => 'jkjk'],
                ['id' => 7, 'invoice_id' => 43, 'photo' => '23d1.jpg', 'description' => 'bmnb'],
                ['id' => 8, 'invoice_id' => 56, 'photo' => '480download (2).jpg', 'description' => 'testtt'],
                ['id' => 9, 'invoice_id' => 56, 'photo' => '480download (2).jpg', 'description' => 'testtt'],
                ['id' => 10, 'invoice_id' => 57, 'photo' => '88download.jpg', 'description' => 'edit modify'],
                ['id' => 11, 'invoice_id' => 58, 'photo' => '971Pv- Spider 5145.pdf', 'description' => 'Payment Voucher'],
                ['id' => 12, 'invoice_id' => 58, 'photo' => '971Pv- Spider 5145.pdf', 'description' => 'Payment Voucher'],
                ['id' => 13, 'invoice_id' => 68, 'photo' => '920chrome_proxy.exe,810Detailed Report.pdf,935Detailed Report.pdf', 'description' => 'Detailed Report'],
                ['id' => 14, 'invoice_id' => 68, 'photo' => '436Closing Qty Report.pdf', 'description' => 'Closing Qty'],
                ['id' => 15, 'invoice_id' => 70, 'photo' => '603al haramain header LOGO.jpg', 'description' => ''],
                ['id' => 16, 'invoice_id' => 71, 'photo' => '695Detailed Report.pdf', 'description' => 'Detailed'],
                ['id' => 17, 'invoice_id' => 71, 'photo' => '169accidentReport.pdf', 'description' => ''],
                ['id' => 18, 'invoice_id' => 71, 'photo' => '471A-09722.pdf', 'description' => ''],
                ['id' => 19, 'invoice_id' => 71, 'photo' => '483A-10023 (1).pdf', 'description' => 'si'],
                ['id' => 20, 'invoice_id' => 82, 'photo' => '78219d5.jpg', 'description' => 'test 1 images'],
        ]);
    }
}
