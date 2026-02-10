<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimesheetSubjobSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('timesheet_subjob')->insert([
                ['id' => 1, 'subjob_value' => '{\\"subjobs\\":[{\\"subjob\\":\\"123\\",\\"workhr\\":\\"8\\"}]}'],
        ]);
    }
}
