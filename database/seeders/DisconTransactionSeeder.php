<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisconTransactionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('discon_transaction')->insert([
                ['id' => 7, 'discon_id' => 4, 'con_settings_id' => 3, 'account_id' => 2501, 'amount' => 140.0, 'deleted_at' => null],
                ['id' => 8, 'discon_id' => 4, 'con_settings_id' => 3, 'account_id' => 1757, 'amount' => 20.0, 'deleted_at' => null],
                ['id' => 9, 'discon_id' => 4, 'con_settings_id' => 3, 'account_id' => 1761, 'amount' => 6000.0, 'deleted_at' => null],
        ]);
    }
}
