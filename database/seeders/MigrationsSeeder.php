<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrationsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('migrations')->insert([
                ['migration' => '2014_10_12_000000_create_users_table', 'batch' => 1],
                ['migration' => '2014_10_12_100000_create_password_resets_table', 'batch' => 1],
                ['migration' => '2017_01_30_172911_create_items_table', 'batch' => 1],
                ['migration' => '2017_01_31_173534_entrust_setup_tables', 'batch' => 1],
                ['migration' => '2019_04_22_130002_create_table_receipt_voucher', 'batch' => 2],
                ['migration' => '2019_04_22_130030_create_table_payment_voucher', 'batch' => 2],
                ['migration' => '2019_04_22_130459_add_item_cost_to_sales_invoice_item', 'batch' => 2],
                ['migration' => '2019_04_22_130608_add_customer_id_to_pdc_received', 'batch' => 2],
                ['migration' => '2019_04_22_130749_add_party_account_id_to_receipt_voucher_entry', 'batch' => 2],
                ['migration' => '2019_04_22_130859_add_is_rventry_to_sales_invoice', 'batch' => 2],
                ['migration' => '2019_04_22_130949_add_sales_invoice_id_to_receipt_voucher', 'batch' => 2],
                ['migration' => '2019_04_22_131027_create_item_log_table', 'batch' => 2],
                ['migration' => '2019_04_22_131125_add_paremeters_to_parameter1', 'batch' => 2],
                ['migration' => '2019_04_22_170523_add_new_columns_to_employee', 'batch' => 2],
                ['migration' => '2019_04_25_055128_add_discount_rv_clumns', 'batch' => 3],
                ['migration' => '2019_04_25_055204_add_discount_pv_clumns', 'batch' => 3],
                ['migration' => '2019_05_01_135349_add_net_salary_to_employee', 'batch' => 4],
                ['migration' => '2019_05_03_123838_add_holiday_in_parameter4', 'batch' => 5],
                ['migration' => '2019_05_03_214332_add_is_salary_job_jobmaster', 'batch' => 6],
                ['migration' => '2014_10_12_100000_create_password_reset_tokens_table', 'batch' => 7],
                ['migration' => '2019_08_19_000000_create_failed_jobs_table', 'batch' => 7],
                ['migration' => '2019_12_14_000001_create_personal_access_tokens_table', 'batch' => 7],
                ['migration' => '2025_11_13_140143_create_permission_tables', 'batch' => 7],
                ['migration' => '2025_11_14_084331_add_deleted_at_to_users_table', 'batch' => 7],
                ['migration' => '2025_11_14_203459_create_model_has_permissions', 'batch' => 7],
                ['migration' => '2025_11_14_204027_create_role_has_permissions_table', 'batch' => 7],
                ['migration' => '2025_11_14_204158_create_model_has_roles_table', 'batch' => 7],
                ['migration' => '2025_11_14_205619_add_guard_name_to_permissions_table', 'batch' => 7],
                ['migration' => '2025_11_14_210336_add_guard_name_to_roles_table', 'batch' => 7],
                ['migration' => '2026_02_05_000001_convert_zero_deleted_at_to_null', 'batch' => 8],
                ['migration' => '2026_02_06_000001_resanitize_deleted_at_zeroes', 'batch' => 9],
        ]);
    }
}
