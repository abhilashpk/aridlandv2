<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
                ['id' => 1, 'name' => 'Admin', 'guard_name' => 'web', 'display_name' => 'Administrator', 'description' => null, 'created_at' => '2026-01-15 08:12:41', 'updated_at' => '2026-01-15 08:12:41'],
                ['id' => 2, 'name' => 'Accountant', 'guard_name' => 'web', 'display_name' => 'Accountant', 'description' => null, 'created_at' => '2026-01-15 08:12:41', 'updated_at' => '2026-01-15 08:12:41'],
                ['id' => 3, 'name' => 'User', 'guard_name' => 'web', 'display_name' => 'User', 'description' => null, 'created_at' => '2026-01-15 08:12:41', 'updated_at' => '2026-01-15 08:12:41'],
                ['id' => 4, 'name' => 'Technician', 'guard_name' => 'web', 'display_name' => 'Technician', 'description' => null, 'created_at' => '2026-01-15 08:12:41', 'updated_at' => '2026-01-15 08:12:41'],
                ['id' => 5, 'name' => 'Supervisor', 'guard_name' => 'web', 'display_name' => 'Supervisor', 'description' => null, 'created_at' => '2026-01-15 08:12:41', 'updated_at' => '2026-01-15 08:12:41'],
                ['id' => 6, 'name' => 'Data Entry', 'guard_name' => 'web', 'display_name' => 'Data Entry', 'description' => null, 'created_at' => '2026-01-15 08:12:41', 'updated_at' => '2026-01-15 08:12:41'],
        ]);
    }
}
