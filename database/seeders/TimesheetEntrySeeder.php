<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimesheetEntrySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('timesheet_entry')->insert([
                ['id' => 1, 'date' => '2024-12-24', 'month' => 12, 'day_type' => 'wday', 'employee_id' => 1, 'start_time' => '08:00:00', 'end_time' => '16:30:00', 'break_time' => '', 'twh' => 8, 'nwh' => 8, 'otg' => 0, 'oth' => 0, 'job_id' => 123, 'leave_type' => 1, 'leave_status' => '', 'leave_reason' => '', 'subjob_id' => 0, 'is_approved' => 1, 'created_at' => '2024-12-24 11:18:33', 'modified_at' => '0000-00-00 00:00:00', 'leave_approve' => 0],
                ['id' => 2, 'date' => '2024-12-23', 'month' => 12, 'day_type' => 'wday', 'employee_id' => 1, 'start_time' => '08:30:00', 'end_time' => '17:30:00', 'break_time' => '', 'twh' => 9, 'nwh' => 8, 'otg' => 1, 'oth' => 0, 'job_id' => 123, 'leave_type' => 1, 'leave_status' => '', 'leave_reason' => '', 'subjob_id' => 1, 'is_approved' => 0, 'created_at' => '2024-12-24 11:58:49', 'modified_at' => '0000-00-00 00:00:00', 'leave_approve' => 0],
                ['id' => 3, 'date' => '2024-12-22', 'month' => 12, 'day_type' => 'wday', 'employee_id' => 1, 'start_time' => '00:00:00', 'end_time' => '00:00:00', 'break_time' => '', 'twh' => 0, 'nwh' => 0, 'otg' => 0, 'oth' => 0, 'job_id' => 0, 'leave_type' => 0, 'leave_status' => 'UP', 'leave_reason' => '', 'subjob_id' => 0, 'is_approved' => 0, 'created_at' => '2024-12-24 12:09:49', 'modified_at' => '0000-00-00 00:00:00', 'leave_approve' => 0],
                ['id' => 4, 'date' => '2025-02-26', 'month' => 2, 'day_type' => 'wday', 'employee_id' => 1, 'start_time' => '09:00:00', 'end_time' => '18:00:00', 'break_time' => '1', 'twh' => 9, 'nwh' => 8, 'otg' => 21, 'oth' => 0, 'job_id' => 0, 'leave_type' => 1, 'leave_status' => '', 'leave_reason' => '', 'subjob_id' => 0, 'is_approved' => 0, 'created_at' => '2025-02-26 12:08:36', 'modified_at' => '0000-00-00 00:00:00', 'leave_approve' => 0],
                ['id' => 5, 'date' => '2025-02-26', 'month' => 2, 'day_type' => 'wday', 'employee_id' => 2, 'start_time' => '00:00:00', 'end_time' => '00:00:00', 'break_time' => '', 'twh' => 0, 'nwh' => 8, 'otg' => 0, 'oth' => 0, 'job_id' => 0, 'leave_type' => 1, 'leave_status' => '', 'leave_reason' => '', 'subjob_id' => 0, 'is_approved' => 0, 'created_at' => '2025-02-26 12:08:36', 'modified_at' => '0000-00-00 00:00:00', 'leave_approve' => 0],
                ['id' => 6, 'date' => '2025-02-26', 'month' => 2, 'day_type' => 'wday', 'employee_id' => 3, 'start_time' => '00:00:00', 'end_time' => '00:00:00', 'break_time' => '', 'twh' => 0, 'nwh' => 8, 'otg' => 0, 'oth' => 0, 'job_id' => 0, 'leave_type' => 1, 'leave_status' => '', 'leave_reason' => '', 'subjob_id' => 0, 'is_approved' => 0, 'created_at' => '2025-02-26 12:08:36', 'modified_at' => '0000-00-00 00:00:00', 'leave_approve' => 0],
                ['id' => 7, 'date' => '2025-02-26', 'month' => 2, 'day_type' => 'wday', 'employee_id' => 4, 'start_time' => '00:00:00', 'end_time' => '00:00:00', 'break_time' => '', 'twh' => 0, 'nwh' => 8, 'otg' => 0, 'oth' => 0, 'job_id' => 0, 'leave_type' => 1, 'leave_status' => '', 'leave_reason' => '', 'subjob_id' => 0, 'is_approved' => 0, 'created_at' => '2025-02-26 12:08:36', 'modified_at' => '0000-00-00 00:00:00', 'leave_approve' => 0],
        ]);
    }
}
