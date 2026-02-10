<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractAttachmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contract_attachment')->insert([
                ['id' => 7, 'contract_id' => 7, 'file_name' => '', 'title' => '', 'deleted_at' => null],
                ['id' => 8, 'contract_id' => 8, 'file_name' => '', 'title' => '', 'deleted_at' => null],
                ['id' => 9, 'contract_id' => 9, 'file_name' => '', 'title' => '', 'deleted_at' => null],
                ['id' => 10, 'contract_id' => 10, 'file_name' => '496d1.jpg', 'title' => 't1', 'deleted_at' => null],
                ['id' => 11, 'contract_id' => 10, 'file_name' => '261co4.png', 'title' => 't2', 'deleted_at' => null],
                ['id' => 12, 'contract_id' => 12, 'file_name' => '', 'title' => '', 'deleted_at' => null],
                ['id' => 13, 'contract_id' => 13, 'file_name' => '', 'title' => '', 'deleted_at' => null],
                ['id' => 14, 'contract_id' => 14, 'file_name' => '', 'title' => '', 'deleted_at' => null],
                ['id' => 15, 'contract_id' => 15, 'file_name' => '', 'title' => '', 'deleted_at' => null],
                ['id' => 16, 'contract_id' => 16, 'file_name' => '', 'title' => '', 'deleted_at' => null],
                ['id' => 17, 'contract_id' => 17, 'file_name' => '', 'title' => '', 'deleted_at' => null],
                ['id' => 18, 'contract_id' => 18, 'file_name' => '', 'title' => '', 'deleted_at' => null],
                ['id' => 19, 'contract_id' => 19, 'file_name' => '', 'title' => '', 'deleted_at' => null],
                ['id' => 23, 'contract_id' => 23, 'file_name' => '', 'title' => '', 'deleted_at' => null],
        ]);
    }
}
