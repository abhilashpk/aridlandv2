<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('company')->insert([
                ['id' => 1, 'company_name' => 'AHMAD ABDULLA BUHUSSAIN', 'email' => 'bhredxb4001@gmail.com', 'phone' => '042630822', 'address' => 'AL QUSAIS 1', 'address2' => '', 'address3' => '', 'city' => 'Building No. 27, Buhussain Building', 'state' => 'Dubai', 'country' => 'UAE', 'pin' => '11228', 'logo' => '1768054243.jpg', 'website' => '', 'status' => 1, 'vat_no' => '100014506800003', 'activate_date' => '2020-06-01', 'active_days' => 30, 'active_status' => 0],
        ]);
    }
}
