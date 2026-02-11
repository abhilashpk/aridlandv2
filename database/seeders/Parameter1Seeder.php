<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Parameter1Seeder extends Seeder
{
    public function run(): void
    {
        DB::table('parameter1')->insert([
                ['id' => 1, 'from_date' => '2025-01-01', 'to_date' => '2026-12-31', 'item_class' => 2, 'bcurrency_id' => 1, 'bdecimal_place' => 3, 'fcurrency_id' => 0, 'fdecimal_place' => 6, 'doc_warndays' => 15, 'pdc_warndays' => 15, 'cost_method' => 2, 'is_refresh' => 0, 'vat_entry' => 2, 'vat_value' => 10, 'credit_limit' => 0, 'item_profit' => 0, 'profit_per' => 10, 'cost_type' => 'costavg', 'item_quantity' => 0, 'py_from_date' => '2024-01-01', 'py_to_date' => '2024-12-31', 'doc_approve' => 0, 'trip_entry' => 0, 'adcd_dashboard' => 1, 'advanced_workshop' => 0, 'pi_vat_inc' => 0, 'si_vat_inc' => 0, 'vehicle_dashboard' => 0, 'pv_approval' => 0, 'special_pswd' => 'p123', 'pdc_alert' => 1, 'daily_rent' => 0, 'contract_delete' => 1],
        ]);
    }
}
