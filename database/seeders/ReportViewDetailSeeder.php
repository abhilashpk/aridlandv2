<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportViewDetailSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('report_view_detail')->insert([
                ['id' => 5, 'report_view_id' => 1, 'name' => 'Print', 'print_name' => 'SalesInvoice (17).mrt', 'is_default' => 1],
                ['id' => 9, 'report_view_id' => 2, 'name' => 'Print', 'print_name' => 'PurchaseInvoice.mrt', 'is_default' => 1],
                ['id' => 10, 'report_view_id' => 3, 'name' => 'Print', 'print_name' => 'PurchaseOrder.mrt', 'is_default' => 1],
                ['id' => 11, 'report_view_id' => 4, 'name' => 'Print', 'print_name' => 'QuotationSales.mrt', 'is_default' => 1],
                ['id' => 12, 'report_view_id' => 5, 'name' => 'Print', 'print_name' => 'SalesOrder.mrt', 'is_default' => 1],
                ['id' => 13, 'report_view_id' => 6, 'name' => 'Print', 'print_name' => 'DeliveryOrder.mrt', 'is_default' => 1],
                ['id' => 15, 'report_view_id' => 9, 'name' => 'Print', 'print_name' => 'JobInvoice3.mrt', 'is_default' => 1],
                ['id' => 16, 'report_view_id' => 8, 'name' => 'Print', 'print_name' => 'JobOrder2.mrt', 'is_default' => 1],
                ['id' => 17, 'report_view_id' => 7, 'name' => 'Print', 'print_name' => 'JobEstimate.mrt', 'is_default' => 1],
                ['id' => 18, 'report_view_id' => 11, 'name' => 'Print', 'print_name' => 'SalesReturn.mrt', 'is_default' => 1],
                ['id' => 19, 'report_view_id' => 10, 'name' => 'Print', 'print_name' => 'PurchaseReturn.mrt', 'is_default' => 1],
                ['id' => 21, 'report_view_id' => 15, 'name' => 'Print', 'print_name' => 'GoodsReceiptNote.mrt', 'is_default' => 1],
                ['id' => 22, 'report_view_id' => 16, 'name' => 'Print', 'print_name' => 'PurchaseSplitcayon.mrt', 'is_default' => 1],
                ['id' => 23, 'report_view_id' => 17, 'name' => 'Print', 'print_name' => 'SalesSplitcayon.mrt', 'is_default' => 1],
                ['id' => 25, 'report_view_id' => 12, 'name' => 'Print 1', 'print_name' => 'ReceiptVoucher.mrt', 'is_default' => 1],
                ['id' => 27, 'report_view_id' => 14, 'name' => 'Print', 'print_name' => 'JournalVoucher.mrt', 'is_default' => 1],
                ['id' => 28, 'report_view_id' => 18, 'name' => 'Print', 'print_name' => 'pettycash.mrt', 'is_default' => 1],
                ['id' => 29, 'report_view_id' => 19, 'name' => 'Print', 'print_name' => 'PurchaseVoucher.mrt', 'is_default' => 1],
                ['id' => 30, 'report_view_id' => 20, 'name' => 'Print', 'print_name' => 'SalesVoucher.mrt', 'is_default' => 1],
                ['id' => 32, 'report_view_id' => 21, 'name' => 'Print', 'print_name' => 'MeterReading.mrt', 'is_default' => 1],
                ['id' => 33, 'report_view_id' => 22, 'name' => 'Print', 'print_name' => '', 'is_default' => 1],
                ['id' => 34, 'report_view_id' => 23, 'name' => 'Print Invoice', 'print_name' => 'PrintInvoiceRealestate.mrt', 'is_default' => 1],
                ['id' => 35, 'report_view_id' => 24, 'name' => 'Contract', 'print_name' => 'PO_RENTAL_FixedFormat.mrt', 'is_default' => 1],
                ['id' => 36, 'report_view_id' => 25, 'name' => 'Quotation', 'print_name' => 'QuotationPurchase.mrt', 'is_default' => 1],
                ['id' => 37, 'report_view_id' => 26, 'name' => 'RBank Print', 'print_name' => 'RBank_FixedFormat.mrt', 'is_default' => 1],
                ['id' => 38, 'report_view_id' => 26, 'name' => 'Emirates Print', 'print_name' => 'EBank_FixedFormat.mrt', 'is_default' => 0],
                ['id' => 39, 'report_view_id' => 27, 'name' => 'Print', 'print_name' => 'MatReq.mrt', 'is_default' => 1],
                ['id' => 40, 'report_view_id' => 28, 'name' => 'Goods Issue Note', 'print_name' => 'GoodsIssueNote.mrt', 'is_default' => 1],
                ['id' => 41, 'report_view_id' => 29, 'name' => 'Transfer In', 'print_name' => '', 'is_default' => 1],
                ['id' => 42, 'report_view_id' => 30, 'name' => 'Transfer Out', 'print_name' => '', 'is_default' => 1],
                ['id' => 44, 'report_view_id' => 31, 'name' => 'Manufacture Voucher', 'print_name' => '', 'is_default' => 1],
                ['id' => 45, 'report_view_id' => 32, 'name' => 'Print', 'print_name' => 'Production.mrt', 'is_default' => 1],
                ['id' => 46, 'report_view_id' => 33, 'name' => 'Goods Return From Site', 'print_name' => '', 'is_default' => 1],
                ['id' => 47, 'report_view_id' => 34, 'name' => 'Print', 'print_name' => 'RentalSalesInvoice.mrt', 'is_default' => 1],
                ['id' => 48, 'report_view_id' => 35, 'name' => 'Print', 'print_name' => 'RentalPurchaseInvoiceCopy.mrt', 'is_default' => 1],
                ['id' => 53, 'report_view_id' => 1, 'name' => 'Preprint', 'print_name' => 'SalesInvoicePreprintFormat.mrt', 'is_default' => 0],
                ['id' => 56, 'report_view_id' => 36, 'name' => 'Print', 'print_name' => 'AdvanceReceipt.mrt', 'is_default' => 1],
                ['id' => 60, 'report_view_id' => 1, 'name' => 'Job Order', 'print_name' => 'SalesInvoice - Copy (2).mrt', 'is_default' => 0],
                ['id' => 69, 'report_view_id' => 1, 'name' => 'Print1', 'print_name' => 'SalesInvoice.mrt', 'is_default' => 0],
                ['id' => 70, 'report_view_id' => 1, 'name' => 'Landscape', 'print_name' => 'invoice_landscape (1).mrt', 'is_default' => 0],
                ['id' => 71, 'report_view_id' => 7, 'name' => 'Print2', 'print_name' => 'JI_FixedFormatNewL.mrt', 'is_default' => 0],
                ['id' => 72, 'report_view_id' => 8, 'name' => 'Print2', 'print_name' => 'JO_FixedFormatMaj.mrt', 'is_default' => 0],
                ['id' => 73, 'report_view_id' => 37, 'name' => 'Print', 'print_name' => '', 'is_default' => 1],
                ['id' => 74, 'report_view_id' => 2, 'name' => 'barcode', 'print_name' => 'PurchaseInvoicebarcode.mrt', 'is_default' => 0],
                ['id' => 78, 'report_view_id' => 12, 'name' => 'Print RV', 'print_name' => 'ReceiptVoucherSIMPLE.mrt', 'is_default' => 0],
                ['id' => 81, 'report_view_id' => 13, 'name' => 'Print PV', 'print_name' => 'pv.mrt', 'is_default' => 1],
                ['id' => 83, 'report_view_id' => 38, 'name' => 'print', 'print_name' => 'ContraVoucher.mrt', 'is_default' => 0],
                ['id' => 84, 'report_view_id' => 39, 'name' => 'Print', 'print_name' => 'manualjournal.mrt', 'is_default' => 1],
                ['id' => 85, 'report_view_id' => 40, 'name' => 'print', 'print_name' => 'SalesSplitReturncayon.mrt', 'is_default' => 1],
                ['id' => 86, 'report_view_id' => 41, 'name' => 'print', 'print_name' => 'PurchaseSplitReturncayon.mrt', 'is_default' => 1],
                ['id' => 87, 'report_view_id' => 5, 'name' => 'FC', 'print_name' => 'SalesOrderFC.mrt', 'is_default' => 0],
        ]);
    }
}
