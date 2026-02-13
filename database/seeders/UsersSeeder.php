<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
                ['id' => 4, 'name' => 'John', 'email' => 'john@numaktech.com', 'password' => '$2y$10$keofUxWmm4VdzrRknngkYeD9vElbtgyguzyvsgnn.M/ZYtYaXeAX6', 'remember_token' => 'CWBbtaEaX4rPY7gFpMfu8K0qRgs5kAopN66nLfOSwEklFTaikbZszwyNcne0', 'created_at' => '2026-02-06 10:17:47', 'updated_at' => '2026-01-06 09:36:26', 'department_id' => 0, 'location_id' => 0, 'deleted_at' => null],
                ['id' => 24, 'name' => 'SAYED DESSOUKI', 'email' => 'sdesoukey@hotmail.com', 'password' => '$2y$10$yQNx6yM6rfgcR9cD0EMVP./YbZRZGajuyh9cpWhw00ZrCa/x4Qhvi', 'remember_token' => 'sg7rSZenc0U2OnTyla009oXEDDO6GIVxPuLVUH6EFGCDdqhJ1rp5WL2lmVNT', 'created_at' => '2026-02-06 10:17:47', 'updated_at' => '2026-01-13 13:24:23', 'department_id' => 0, 'location_id' => 0, 'deleted_at' => null],
                ['id' => 25, 'name' => 'ADMIN', 'email' => 'bhredxb4001@gmail.com', 'password' => '$2y$10$6BBiUvBMVv9u3uPGNvVP3O6oz2jSL4s8v8J0qJV356D0XMsvGpq2W', 'remember_token' => '06WmC0b2dtVSEohacRR0EiFqDzxstMcPyTR054Z7rU1vddCObBIdpBOrlHqN', 'created_at' => '2026-02-06 10:17:47', 'updated_at' => '2026-01-05 06:49:14', 'department_id' => 0, 'location_id' => 0, 'deleted_at' => null],
        ]);
    }
}
