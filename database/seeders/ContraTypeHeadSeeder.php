<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContraTypeHeadSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contra_type_head')->insert([
                ['id' => 1, 'head' => 'prepaid_income', 'head_text' => 'Prepaid Income A/c.'],
                ['id' => 2, 'head' => 'rental_income', 'head_text' => 'Rental Income A/c.'],
                ['id' => 3, 'head' => 'deposit', 'head_text' => '>Deposit A/c'],
                ['id' => 4, 'head' => 'water_ecty', 'head_text' => '>Security Deposit A/c'],
                ['id' => 5, 'head' => 'other_deposit', 'head_text' => '>Other Deposit A/c'],
                ['id' => 6, 'head' => 'commission', 'head_text' => 'Commission'],
                ['id' => 7, 'head' => 'parking', 'head_text' => 'Parking Amount A/c.'],
                ['id' => 8, 'head' => 'cancellation', 'head_text' => 'Cancellation Fee A/c'],
                ['id' => 9, 'head' => 'repair', 'head_text' => 'Repair and Maintenance A/c.'],
                ['id' => 10, 'head' => 'water_ecty_bill', 'head_text' => 'Electricity and Water Bill A/c.'],
                ['id' => 11, 'head' => 'closing_oth', 'head_text' => 'Other Closing Charges A/c.'],
                ['id' => 12, 'head' => 'booking_oth', 'head_text' => 'Other Booking Charges A/c.'],
                ['id' => 13, 'head' => 'chq_charge', 'head_text' => 'Cheque Bounced Charges A/c.'],
                ['id' => 14, 'head' => 'ejarie_fee', 'head_text' => 'Ejarie Fee A/c'],
        ]);
    }
}
