<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportViewSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('report_view')->insert([
                ['id' => 1, 'code' => 'SI', 'name' => 'Sales Invoice', 'view_name' => 'SI_FixedFormat.mrt', 'status' => 1],
                ['id' => 2, 'code' => 'PI', 'name' => 'Purchase Invoice', 'view_name' => 'PI_FixedFormat.mrt', 'status' => 1],
                ['id' => 3, 'code' => 'PO', 'name' => 'Purchase Order', 'view_name' => 'PO_FixedFormat.mrt', 'status' => 1],
                ['id' => 4, 'code' => 'QS', 'name' => 'Quotation Sales', 'view_name' => 'QS_FixedFormat.mrt', 'status' => 1],
                ['id' => 5, 'code' => 'SO', 'name' => 'Sales Order', 'view_name' => 'SO_FixedFormat.mrt', 'status' => 1],
                ['id' => 6, 'code' => 'DO', 'name' => 'Delivery Order', 'view_name' => 'DO_FixedFormat.mrt', 'status' => 1],
                ['id' => 7, 'code' => 'JE', 'name' => 'Job Estimate', 'view_name' => '', 'status' => 1],
                ['id' => 8, 'code' => 'JO', 'name' => 'Job Order', 'view_name' => '', 'status' => 1],
                ['id' => 9, 'code' => 'JI', 'name' => 'Job Invoice', 'view_name' => '', 'status' => 1],
                ['id' => 10, 'code' => 'PR', 'name' => 'Purchase Return', 'view_name' => '', 'status' => 1],
                ['id' => 11, 'code' => 'SR', 'name' => 'Sales Return', 'view_name' => '', 'status' => 1],
                ['id' => 12, 'code' => 'RV', 'name' => 'Receipt Voucher', 'view_name' => '', 'status' => 1],
                ['id' => 13, 'code' => 'PV', 'name' => 'Payment Voucher', 'view_name' => '', 'status' => 1],
                ['id' => 14, 'code' => 'JV', 'name' => 'Journal Voucher', 'view_name' => '', 'status' => 1],
                ['id' => 15, 'code' => 'SDO', 'name' => 'Goods Receipt Note', 'view_name' => 'SDO_FixedFormat.mrt', 'status' => 1],
                ['id' => 16, 'code' => 'PS', 'name' => 'Purchase Split', 'view_name' => 'PS_FixedFormat.mrt', 'status' => 1],
                ['id' => 17, 'code' => 'SS', 'name' => 'Sales Split', 'view_name' => 'SS_FixedFormat.mrt', 'status' => 1],
                ['id' => 18, 'code' => 'PC', 'name' => 'Petty Cash', 'view_name' => '', 'status' => 1],
                ['id' => 19, 'code' => 'PVR', 'name' => 'Purchase Voucher', 'view_name' => '', 'status' => 1],
                ['id' => 20, 'code' => 'SVR', 'name' => 'Sales Voucher', 'view_name' => '', 'status' => 1],
                ['id' => 21, 'code' => 'DNE', 'name' => 'Debit Note', 'view_name' => '', 'status' => 1],
                ['id' => 22, 'code' => 'CNE', 'name' => 'Credit Note', 'view_name' => '', 'status' => 1],
                ['id' => 23, 'code' => 'REALINVO', 'name' => 'Print Invoice', 'view_name' => 'SALESSPLIT_FixedFormat.mrt', 'status' => 1],
                ['id' => 24, 'code' => 'CONTRACT', 'name' => 'Contract', 'view_name' => 'PO_RENTAL_FixedFormat.mrt', 'status' => 1],
                ['id' => 25, 'code' => 'QP', 'name' => 'Quotation Purchase', 'view_name' => 'QP_FixedFormat.mrt', 'status' => 1],
                ['id' => 26, 'code' => 'CD', 'name' => 'Cheque Print', 'view_name' => 'CD_PreprintFormat.mrt', 'status' => 1],
                ['id' => 27, 'code' => 'MR', 'name' => 'Material Requisition', 'view_name' => 'MaterialRequisition.mrt', 'status' => 1],
                ['id' => 28, 'code' => 'GIN', 'name' => 'Goods Issue Note', 'view_name' => '', 'status' => 1],
                ['id' => 29, 'code' => 'TI', 'name' => 'Transfer In', 'view_name' => '', 'status' => 1],
                ['id' => 30, 'code' => 'TO', 'name' => 'Transfer Out', 'view_name' => '', 'status' => 1],
                ['id' => 31, 'code' => 'MV', 'name' => 'Manufacture Voucher', 'view_name' => '', 'status' => 1],
                ['id' => 32, 'code' => 'PRO', 'name' => 'Production Order', 'view_name' => '', 'status' => 1],
                ['id' => 33, 'code' => 'GRFS', 'name' => 'Goods Return From Site', 'view_name' => '', 'status' => 1],
                ['id' => 34, 'code' => 'SIR', 'name' => 'Rental Sales ', 'view_name' => '', 'status' => 1],
                ['id' => 35, 'code' => 'PIR', 'name' => 'Rental Purchase', 'view_name' => '', 'status' => 1],
                ['id' => 36, 'code' => 'ARV', 'name' => 'Advance Receipt', 'view_name' => 'AdvanceReceipt.mrt', 'status' => 1],
                ['id' => 37, 'code' => 'WO', 'name' => 'Work Order', 'view_name' => '', 'status' => 1],
                ['id' => 38, 'code' => 'CV', 'name' => 'Contra Voucher', 'view_name' => '', 'status' => 1],
                ['id' => 39, 'code' => 'MJV', 'name' => 'Manual Journal ', 'view_name' => '', 'status' => 1],
                ['id' => 40, 'code' => 'SSR', 'name' => 'Sales Split Return', 'view_name' => '', 'status' => 1],
                ['id' => 41, 'code' => 'PSR', 'name' => 'Purchase Split Return', 'view_name' => '', 'status' => 1],
        ]);
    }
}
