<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disable FK checks for clean seed order (MySQL)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(AccountCategorySeeder::class);
        $this->call(AccountGroupSeeder::class);
        $this->call(AccountMasterSeeder::class);
        $this->call(AccountSettingSeeder::class);
        $this->call(AccountTransactionSeeder::class);
        $this->call(AdvanceDashboardSeeder::class);
        $this->call(AdvdashboardDetailsSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(BudgetingSeeder::class);
        $this->call(CargoAttachmentSeeder::class);
        $this->call(CargoDespatchStatusLogSeeder::class);
        $this->call(CargoStatusSeeder::class);
        $this->call(CargoWaybillStatusLogSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ChequeDetailsSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ContraTypeHeadSeeder::class);
        $this->call(ContractAttachmentSeeder::class);
        $this->call(ContractConnectionSeeder::class);
        $this->call(ContractTransactionSeeder::class);
        $this->call(ContractTypeReSeeder::class);
        $this->call(ContractTypeSettingsSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CrmInfoSiSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(DashboardSeeder::class);
        $this->call(DashboardDetailsSeeder::class);
        $this->call(DefaultLocSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(DepartmentAccountsSeeder::class);
        $this->call(DesignViewSeeder::class);
        $this->call(DisconTransactionSeeder::class);
        $this->call(DisconnectionSeeder::class);
        $this->call(EmployeeCategorySeeder::class);
        $this->call(EmployeePayriseSeeder::class);
        $this->call(EnquiryPhotosSeeder::class);
        $this->call(FormDetailsSeeder::class);
        $this->call(FormsSeeder::class);
        $this->call(ItemTemplateEditSeeder::class);
        $this->call(ItemstockDepartmentSeeder::class);
        $this->call(JobmasterSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(MeterReadingSeeder::class);
        $this->call(MfgWastageSeeder::class);
        $this->call(MigrationsSeeder::class);
        $this->call(OrderAssignSeeder::class);
        $this->call(OtherAccountSettingSeeder::class);
        $this->call(PackingListSeeder::class);
        $this->call(PackingListItemsSeeder::class);
        $this->call(Parameter1Seeder::class);
        $this->call(Parameter2Seeder::class);
        $this->call(Parameter3Seeder::class);
        $this->call(Parameter4Seeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(PlPhotosSeeder::class);
        $this->call(ProformaInvoiceSeeder::class);
        $this->call(ProformaInvoiceItemSeeder::class);
        $this->call(ProjectBudgetSeeder::class);
        $this->call(PurchaseEnquirySeeder::class);
        $this->call(PurchaseEnquiryItemSeeder::class);
        $this->call(PurchasesplitReturnSeeder::class);
        $this->call(PurchasesplitReturnItemSeeder::class);
        $this->call(QuotFotosSeeder::class);
        $this->call(ReadingTransactionSeeder::class);
        $this->call(ReconciliationSeeder::class);
        $this->call(RentalDriverSeeder::class);
        $this->call(RentalItemlogSeeder::class);
        $this->call(ReportViewSeeder::class);
        $this->call(ReportViewDetailSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(SalessplitReturnSeeder::class);
        $this->call(SalessplitReturnItemSeeder::class);
        $this->call(SiPhotosSeeder::class);
        $this->call(SiSellingExpSeeder::class);
        $this->call(TenantEnquirySeeder::class);
        $this->call(TimesheetEntrySeeder::class);
        $this->call(TimesheetSubjobSeeder::class);
        $this->call(UnitsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(VatDepartmentSeeder::class);
        $this->call(VatMasterSeeder::class);
        $this->call(VoucherAccountSeeder::class);
        $this->call(VoucherNoSeeder::class);
        $this->call(VoucherTypeSeeder::class);
        $this->call(ModelHasRolesSeeder::class);
        $this->call(RoleHasPermissionsSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
