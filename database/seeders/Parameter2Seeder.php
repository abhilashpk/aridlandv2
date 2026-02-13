<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Parameter2Seeder extends Seeder
{
    public function run(): void
    {
        DB::table('parameter2')->insert([
                ['id' => 1, 'name' => 'Update Quantity by GRN', 'is_active' => 1, 'status' => 1, 'keyname' => 'mod_sdo_qty_update'],
                ['id' => 2, 'name' => 'Protect Code Editing', 'is_active' => 0, 'status' => 1, 'keyname' => ''],
                ['id' => 3, 'name' => 'Sort by Item Code/Otherwise Default Item Name', 'is_active' => 0, 'status' => 1, 'keyname' => ''],
                ['id' => 4, 'name' => 'Enable Cost Accounting', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_cost_accounting'],
                ['id' => 5, 'name' => 'Due Date Compulsory', 'is_active' => 0, 'status' => 1, 'keyname' => ''],
                ['id' => 6, 'name' => 'Protect Name Editing of Stock Description while
Invoicing', 'is_active' => 0, 'status' => 1, 'keyname' => ''],
                ['id' => 7, 'name' => 'Item List on Demand', 'is_active' => 0, 'status' => 1, 'keyname' => ''],
                ['id' => 8, 'name' => 'Auto Listing', 'is_active' => 0, 'status' => 1, 'keyname' => ''],
                ['id' => 9, 'name' => 'Warn for entry on Existing Item during Invoice', 'is_active' => 0, 'status' => 1, 'keyname' => ''],
                ['id' => 10, 'name' => 'Department Verification', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_department'],
                ['id' => 11, 'name' => 'For Leave Entry Add HRA with Basic', 'is_active' => 0, 'status' => 1, 'keyname' => ''],
                ['id' => 12, 'name' => 'Enable Auto Cost Refreshing Process', 'is_active' => 1, 'status' => 1, 'keyname' => 'mod_autocost_refresh'],
                ['id' => 13, 'name' => 'Refresh Before Purchase and Sales Saving', 'is_active' => 0, 'status' => 1, 'keyname' => ''],
                ['id' => 14, 'name' => 'Change Unit while Invoicing', 'is_active' => 0, 'status' => 1, 'keyname' => ''],
                ['id' => 15, 'name' => 'Update Discount in Purchase Invoice', 'is_active' => 1, 'status' => 1, 'keyname' => ''],
                ['id' => 16, 'name' => 'Update Discount in Sales Invoice', 'is_active' => 1, 'status' => 1, 'keyname' => ''],
                ['id' => 17, 'name' => 'Enable Location with User', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_location'],
                ['id' => 18, 'name' => 'Enable Material(Item) & Service Module', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_material_service'],
                ['id' => 19, 'name' => 'Enable Workshop Module', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_workshop'],
                ['id' => 20, 'name' => 'Job Order Manual Entry(Workshop Module)', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_joborder_manual'],
                ['id' => 21, 'name' => 'HR Oriented Module Only', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_hrbase'],
                ['id' => 22, 'name' => 'Maintenance System Only', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_maintenance'],
                ['id' => 23, 'name' => 'Enable Opening and Closing Stock in P&L,Balance Sheet', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_opcl'],
                ['id' => 24, 'name' => 'Enable Purchase Enquiry', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_purchase_enquiry'],
                ['id' => 25, 'name' => 'Enable Sales Invoice Round Off', 'is_active' => 1, 'status' => 1, 'keyname' => 'mod_si_roundoff'],
                ['id' => 26, 'name' => 'Update Quantity by Delivery Order(Sales)', 'is_active' => 1, 'status' => 1, 'keyname' => 'mod_do_qty_update'],
                ['id' => 27, 'name' => 'Enable Consignment Location', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_con_location'],
                ['id' => 28, 'name' => 'Enable Realestate Module', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_realestate'],
                ['id' => 29, 'name' => 'Enable Detailed Statement', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_statement_det'],
                ['id' => 30, 'name' => 'Enable Consolidate Item List', 'is_active' => 1, 'status' => 1, 'keyname' => 'mod_consolidate_item'],
                ['id' => 31, 'name' => 'Enable Manual Packing Quantity', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_mp_qty'],
                ['id' => 32, 'name' => 'Enable Minus Quantity Location', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_mnsqty_location'],
                ['id' => 33, 'name' => 'Enable Purchase Split As Petty Cash', 'is_active' => 1, 'status' => 1, 'keyname' => 'mod_ps_pettycash'],
                ['id' => 34, 'name' => 'Enable Sales Split As Petty Cash', 'is_active' => 1, 'status' => 1, 'keyname' => 'mod_sp_pettycash'],
                ['id' => 35, 'name' => 'Enable Item wise Location with Warning', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_item_location_warn'],
                ['id' => 36, 'name' => 'Enable Job Order to Estimate Cycle(Workshop)', 'is_active' => 1, 'status' => 1, 'keyname' => 'mod_jo_to_je'],
                ['id' => 37, 'name' => 'Vehicle Customer Cycle(Workshop)', 'is_active' => 1, 'status' => 1, 'keyname' => 'mod_vehicle_cust'],
                ['id' => 38, 'name' => 'Enable Timesheet Entry', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_timesheet'],
                ['id' => 39, 'name' => 'Enable Assembly Item ', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_assembly_item'],
                ['id' => 40, 'name' => 'Enable Service Item with Multiple Units', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_multiple_units'],
                ['id' => 41, 'name' => 'Enable Work Order', 'is_active' => 0, 'status' => 1, 'keyname' => 'mod_workorder'],
                ['id' => 42, 'name' => 'Enable Item Batch System', 'is_active' => 1, 'status' => 1, 'keyname' => 'mod_item_batch'],
                ['id' => 43, 'name' => 'Enable Sales Return with Category', 'is_active' => 1, 'status' => 1, 'keyname' => 'mod_sr_with_cat'],
                ['id' => 44, 'name' => 'Change to multiple units while making a transaction(Service Item)', 'is_active' => 1, 'status' => 1, 'keyname' => 'mod_unit_serviceitem'],
        ]);
    }
}
