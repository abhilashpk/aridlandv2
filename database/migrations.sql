ALTER TABLE `account_master` CHANGE `account_id` `account_id` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `cl_balance` `cl_balance` DECIMAL(10,2) NULL, CHANGE `op_balance` `op_balance` DECIMAL(10,2) NULL;

ALTER TABLE `account_transaction` CHANGE `transaction_type` `transaction_type` VARCHAR(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `account_transaction` CHANGE `amount` `amount` DECIMAL(10,2) NULL;
ALTER TABLE `account_transaction` CHANGE `fc_amount` `fc_amount` DECIMAL(10,2) NULL;

<<<<<<< HEAD
ALTER TABLE `account_group` CHANGE `category` `category` VARCHAR(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `account_setting` CHANGE `prefix` `prefix` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `salesman` CHANGE `address1` `address1` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `address2` `address2` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `telephone` `telephone` VARCHAR(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `currency` CHANGE `rate` `rate` FLOAT NULL, CHANGE `fracode` `fracode` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `decimal_place` `decimal_place` TINYINT(4) NULL, CHANGE `decimal_name` `decimal_name` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `terms` CHANGE `description` `description` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `file` `file` VARCHAR(110) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `bank` CHANGE `name` `name` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `account_no` `account_no` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;


ALTER TABLE `account_master` CHANGE `account_category_id` `account_category_id` INT(11) NULL, CHANGE `account_group_id` `account_group_id` INT(11) NULL, CHANGE `transaction_type` `transaction_type` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL

ALTER TABLE `journal` CHANGE `difference` `difference` FLOAT NULL, CHANGE `supplier_name` `supplier_name` VARCHAR(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `trn_no` `trn_no` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `group_id` `group_id` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `is_transfer` `is_transfer` TINYINT NULL DEFAULT '0', CHANGE `balance_amount` `balance_amount` DOUBLE(10,2) NULL;
ALTER TABLE `journal_entry` CHANGE `description` `description` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `reference` `reference` VARCHAR(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `fc_amount` `fc_amount` DECIMAL(10,2) NULL, CHANGE `fc_id` `fc_id` TINYINT NULL DEFAULT '0', CHANGE `currency_rate` `currency_rate` FLOAT NULL, CHANGE `job_id` `job_id` INT NULL, CHANGE `cheque_no` `cheque_no` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `cheque_date` `cheque_date` DATE NULL, CHANGE `bank_id` `bank_id` INT NULL, CHANGE `party_account_id` `party_account_id` INT NULL, CHANGE `is_onaccount` `is_onaccount` TINYINT NULL DEFAULT '0', CHANGE `amount_transfer` `amount_transfer` TINYINT NULL DEFAULT '0', CHANGE `balance_amount` `balance_amount` DECIMAL(10,2) NULL;
ALTER TABLE `journal_voucher_tr` CHANGE `invoice_id` `invoice_id` INT NULL, CHANGE `assign_amount` `assign_amount` DECIMAL(10,2) NULL, CHANGE `bill_type` `bill_type` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `receipt_voucher` CHANGE `from_jv` `from_jv` TINYINT NULL DEFAULT '0', CHANGE `difference` `difference` FLOAT NULL, CHANGE `is_transfer` `is_transfer` TINYINT NULL DEFAULT '0';
ALTER TABLE `receipt_voucher_entry` CHANGE `is_fc` `is_fc` TINYINT NULL DEFAULT '0', CHANGE `amount_fc` `amount_fc` DECIMAL(10,2) NULL, CHANGE `is_onaccount` `is_onaccount` TINYINT NULL DEFAULT '0', CHANGE `amount_transfer` `amount_transfer` TINYINT NULL DEFAULT '0', CHANGE `balance_amount` `balance_amount` DECIMAL(10,2) NULL;
ALTER TABLE `receipt_voucher_tr` CHANGE `sales_invoice_id` `sales_invoice_id` INT NULL, CHANGE `assign_amount` `assign_amount` DECIMAL(10,2) NULL, CHANGE `bill_type` `bill_type` VARCHAR(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `payment_voucher` CHANGE `from_jv` `from_jv` TINYINT NULL DEFAULT '0', CHANGE `difference` `difference` FLOAT NULL, CHANGE `is_transfer` `is_transfer` TINYINT NULL DEFAULT '0', CHANGE `tr_description` `tr_description` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `depositor` `depositor` VARCHAR(54) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `group_id` `group_id` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `supplier_name` `supplier_name` VARCHAR(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `trn_no` `trn_no` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `opening_balance_id` `opening_balance_id` INT NULL, CHANGE `purchase_invoice_id` `purchase_invoice_id` INT NULL, CHANGE `is_fc` `is_fc` TINYINT NULL DEFAULT '0', CHANGE `currency_id` `currency_id` SMALLINT NULL, CHANGE `currency_rate` `currency_rate` FLOAT NULL, CHANGE `fc_amount` `fc_amount` DECIMAL(10,2) NULL, CHANGE `approval_status` `approval_status` TINYINT NULL DEFAULT '0';
ALTER TABLE `payment_voucher_entry` CHANGE `description` `description` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `reference` `reference` VARCHAR(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `job_id` `job_id` INT NULL, CHANGE `is_fc` `is_fc` TINYINT NULL DEFAULT '0', CHANGE `currency_id` `currency_id` INT NULL, CHANGE `currency_rate` `currency_rate` FLOAT NULL, CHANGE `amount_fc` `amount_fc` DECIMAL(10,2) NULL, CHANGE `cheque_no` `cheque_no` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `bank_id` `bank_id` INT NULL, CHANGE `is_onaccount` `is_onaccount` TINYINT NULL DEFAULT '0', CHANGE `amount_transfer` `amount_transfer` TINYINT NULL DEFAULT '0', CHANGE `balance_amount` `balance_amount` DECIMAL(10,2) NULL, CHANGE `party_account_id` `party_account_id` INT NULL;
ALTER TABLE `payment_voucher_tr` CHANGE `purchase_invoice_id` `purchase_invoice_id` INT NULL, CHANGE `assign_amount` `assign_amount` DECIMAL(10,2) NULL, CHANGE `bill_type` `bill_type` VARCHAR(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `pdc_issued` CHANGE `reference` `reference` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `description` `description` VARCHAR(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `entry_type` `entry_type` VARCHAR(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `dr_bank_id` `dr_bank_id` INT NULL;
ALTER TABLE `pdc_received` CHANGE `reference` `reference` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `description` `description` VARCHAR(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `entry_type` `entry_type` VARCHAR(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `dr_bank_id` `dr_bank_id` INT NULL;

ALTER TABLE `vehicle` CHANGE `customer_id` `customer_id` INT(11) NULL, CHANGE `name` `name` VARCHAR(85) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `jobmaster` CHANGE `open_cost` `open_cost` FLOAT NULL, CHANGE `customer_id` `customer_id` INT(11) NULL, CHANGE `department_id` `department_id` INT(11) NULL, CHANGE `salesman_id` `salesman_id` INT(11) NULL, CHANGE `open_income` `open_income` FLOAT NULL, CHANGE `is_close` `is_close` TINYINT(4) NULL DEFAULT '0', CHANGE `contract_amount` `contract_amount` FLOAT NULL, CHANGE `start_date` `start_date` DATE NULL, CHANGE `end_date` `end_date` DATE NULL, CHANGE `incexp` `incexp` TINYINT(4) NULL DEFAULT '0', CHANGE `vehicle_id` `vehicle_id` INT(11) NULL, CHANGE `is_salary_job` `is_salary_job` TINYINT(4) NULL DEFAULT '0', CHANGE `transport_type` `transport_type` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `packing` `packing` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `date` `date` DATE NULL, CHANGE `address` `address` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `mbl` `mbl` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `house_bl_no` `house_bl_no` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `origin` `origin` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `hbl` `hbl` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `por` `por` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `fnd` `fnd` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `no_of_pieces` `no_of_pieces` FLOAT NULL, CHANGE `volume` `volume` FLOAT NULL, CHANGE `gross_weight` `gross_weight` FLOAT NULL, CHANGE `destination` `destination` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `flight_no` `flight_no` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `chargeable_weight` `chargeable_weight` FLOAT NULL, CHANGE `be_no` `be_no` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `flight_date` `flight_date` DATE NULL, CHANGE `container_no` `container_no` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `is_subjob` `is_subjob` TINYINT(4) NULL DEFAULT '0', CHANGE `shipper` `shipper` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `consignee` `consignee` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

add two table vehicle_service, vehicle_servicing

INSERT INTO `form_details` (`id`, `form_id`, `field_code`, `field_name`, `active`, `status`, `list_ord`) VALUES (NULL, '12', 'servicing', 'servicing', '0', '1', '0')






=======
>>>>>>> 45aa6610d356aac74e1b3b1cf8dae75c26e83400

--------------Adland-----

ALTER TABLE `pdc_received` ADD `department_id` INT NOT NULL AFTER `department_id`;

ALTER TABLE `pdc_issued` ADD `department_id` INT NOT NULL AFTER `department_id`;

ALTER TABLE `quotation_sales` ADD `department_id` INT NOT NULL AFTER `is_draft`, ADD `is_draft` TINYINT NOT NULL AFTER `department_id`;

ALTER TABLE `location` CHANGE `is_conloc` `is_conloc` TINYINT(4) NULL, CHANGE `customer_id` `customer_id` INT(11), CHANGE `is_minus_qty` `is_minus_qty` TINYINT(4)

INSERT INTO `form_details` (`id`, `form_id`, `field_code`, `field_name`, `active`, `status`, `list_ord`) VALUES (NULL, '4', 'document_upload', 'document upload', '0', '1', '0')
INSERT INTO `form_details` (`id`, `form_id`, `field_code`, `field_name`, `active`, `status`, `list_ord`) VALUES (NULL, '3', 'due_date', 'due date', '0', '1', '0')
<<<<<<< HEAD
INSERT INTO `form_details` (`id`, `form_id`, `field_code`, `field_name`, `active`, `status`, `list_ord`) VALUES (NULL, '7', 'due_dates', 'due dates', '1', '1', '0')
=======
>>>>>>> 45aa6610d356aac74e1b3b1cf8dae75c26e83400

INSERT INTO `department` (`id`, `code`, `name`, `status`, `deleted_at`) VALUES (NULL, 'ALD', 'ARID LAND DEVELOPMENT TRADING', '1', '2026-01-27 08:02:16.000000'), (NULL, 'TAB', 'TREES AND PALMS', '1', '2026-01-27 08:02:16.000000')

INSERT INTO `parameter2` (`id`, `name`, `is_active`, `status`, `keyname`) VALUES (NULL, 'Change to multiple units while making a transaction(Service Item)', '1', '1', 'mod_unit_serviceitem')

UPDATE `voucher_no` SET `department_id` = '1' WHERE `voucher_no`.`id` = 3
UPDATE `voucher_no` SET `department_id` = '1' WHERE `voucher_no`.`id` = 5;
UPDATE `voucher_no` SET `department_id` = '1' WHERE `voucher_no`.`id` = 6;
<<<<<<< HEAD
UPDATE `voucher_no` SET `department_id` = '1' WHERE `voucher_no`.`id` = 22;
UPDATE `voucher_no` SET `department_id` = '1' WHERE `voucher_no`.`id` = 15
UPDATE `voucher_no` SET `department_id` = '1' WHERE `voucher_no`.`id` = 1;
UPDATE `voucher_no` SET `department_id` = '1' WHERE `voucher_no`.`id` = 2;
=======
>>>>>>> 45aa6610d356aac74e1b3b1cf8dae75c26e83400

ALTER TABLE `sales_order` ADD `department_id` INT NOT NULL AFTER `due_date`, ADD `is_intercompany` TINYINT NOT NULL AFTER `department_id`;
ALTER TABLE `sales_order` CHANGE `is_settled` `is_settled` TINYINT(4) NULL DEFAULT '0';
ALTER TABLE `sales_order` CHANGE `reference_no` `reference_no` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `lpo_date` `lpo_date` DATE NULL, CHANGE `quotation_id` `quotation_id` VARCHAR(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `description` `description` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `job_id` `job_id` INT(11) NULL, CHANGE `terms_id` `terms_id` INT(11) NULL, CHANGE `is_fc` `is_fc` TINYINT(4) NULL, CHANGE `currency_id` `currency_id` INT(11) NULL, CHANGE `currency_rate` `currency_rate` FLOAT NULL, CHANGE `footer_id` `footer_id` INT(11) NULL, CHANGE `discount` `discount` FLOAT NULL, CHANGE `salesman_id` `salesman_id` INT(11) NULL, CHANGE `is_export` `is_export` TINYINT(4) NULL, CHANGE `vehicle_id` `vehicle_id` INT(11) NULL, CHANGE `kilometer` `kilometer` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `job_type` `job_type` TINYINT(4) NULL, CHANGE `jobnature` `jobnature` TINYINT(4) NULL, CHANGE `fabrication` `fabrication` VARCHAR(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `prefix` `prefix` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `less_description` `less_description` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `less_amount` `less_amount` DECIMAL(10,2) NULL, CHANGE `less_amount2` `less_amount2` DECIMAL(10,2) NULL, CHANGE `less_description2` `less_description2` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `less_amount3` `less_amount3` DECIMAL(10,2) NULL, CHANGE `less_description3` `less_description3` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `net_total_pay` `net_total_pay` DECIMAL(10,2) NULL, CHANGE `footer_text` `footer_text` VARCHAR(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `doc_status` `doc_status` TINYINT(4) NULL, CHANGE `comment` `comment` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `location_id` `location_id` INT(11) NULL, CHANGE `start_time` `start_time` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `end_time` `end_time` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `jctype` `jctype` TINYINT(4) NULL, CHANGE `is_warning` `is_warning` TINYINT(4) NULL, CHANGE `items_inside` `items_inside` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `remarks` `remarks` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `signature` `signature` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `fuel_level` `fuel_level` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `is_rental` `is_rental` TINYINT(4) NULL, CHANGE `next_due` `next_due` DATE NULL, CHANGE `present_km` `present_km` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `service_km` `service_km` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `next_km` `next_km` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `items_description` `items_description` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `foot_description` `foot_description` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `metre_in` `metre_in` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `metre_out` `metre_out` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `is_transfer_po` `is_transfer_po` TINYINT(4) NULL, CHANGE `order_type` `order_type` VARCHAR(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `is_settled` `is_settled` TINYINT(4) NULL, CHANGE `duedays` `duedays` SMALLINT(6) NULL, CHANGE `due_date` `due_date` DATE NULL;

ALTER TABLE `customer_do` ADD `prefix` VARCHAR(25) NULL AFTER `foot_description`, ADD `department_id` INT NOT NULL AFTER `prefix`, ADD `is_intercompany` TINYINT NOT NULL AFTER `department_id`, ADD `doc_nos` VARCHAR(255) NULL AFTER `is_intercompany`;
ALTER TABLE `customer_do` CHANGE `reference_no` `reference_no` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `lpo_date` `lpo_date` DATE NULL, CHANGE `document_id` `document_id` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `terms_id` `terms_id` INT(11) NULL, CHANGE `job_id` `job_id` INT(11) NULL, CHANGE `is_fc` `is_fc` TINYINT(4) NULL, CHANGE `currency_id` `currency_id` INT(11) NULL, CHANGE `currency_rate` `currency_rate` FLOAT NULL, CHANGE `footer_id` `footer_id` INT(11) NULL, CHANGE `salesman_id` `salesman_id` INT(11) NULL, CHANGE `is_export` `is_export` TINYINT(4) NULL, CHANGE `doc_status` `doc_status` TINYINT(4) NULL, CHANGE `comment` `comment` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `location_id` `location_id` INT(11) NULL, CHANGE `foot_description` `foot_description` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `item_location_si` ADD `department_id` INT NOT NULL AFTER `qty_entry`;

ALTER TABLE `sales_invoice` ADD `is_cash` TINYINT NOT NULL AFTER `due_date`, ADD `prefix` VARCHAR(25) NULL AFTER `is_cash`, ADD `is_intercompany` TINYINT NOT NULL AFTER `prefix`;
ALTER TABLE `sales_invoice` CHANGE `lpo_date` `lpo_date` DATE NULL, CHANGE `job_id` `job_id` INT(11) NULL, CHANGE `is_fc` `is_fc` TINYINT(4) NULL, CHANGE `currency_id` `currency_id` INT(11) NULL, CHANGE `currency_rate` `currency_rate` FLOAT NULL, CHANGE `footer_id` `footer_id` INT(11) NULL, CHANGE `is_transfer` `is_transfer` TINYINT(4) NULL DEFAULT '0', CHANGE `amount_transfer` `amount_transfer` TINYINT(4) NULL, CHANGE `balance_amount` `balance_amount` FLOAT NULL, CHANGE `is_editable` `is_editable` TINYINT(4) NULL DEFAULT '0', CHANGE `customer_name` `customer_name` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `customer_phone` `customer_phone` VARCHAR(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `salesman_id` `salesman_id` INT(11) NULL, CHANGE `location_id` `location_id` INT(11) NULL, CHANGE `vehicle_id` `vehicle_id` INT(11) NULL, CHANGE `customer_trn` `customer_trn` VARCHAR(85) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `is_rventry` `is_rventry` TINYINT(4) NULL, CHANGE `advance` `advance` DECIMAL(10,2) NULL, CHANGE `balance` `balance` DECIMAL(10,2) NULL, CHANGE `kilometer` `kilometer` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `job_type` `job_type` TINYINT(4) NULL, CHANGE `jobnature` `jobnature` TINYINT(4) NULL, CHANGE `fabrication` `fabrication` VARCHAR(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `less_amount` `less_amount` DECIMAL(10,2) NULL, CHANGE `less_description` `less_description` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `previnv_description` `previnv_description` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `previnv_amount` `previnv_amount` DECIMAL(10,2) NULL, CHANGE `less_amount2` `less_amount2` DECIMAL(10,2) NULL, CHANGE `less_description2` `less_description2` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `less_amount3` `less_amount3` DECIMAL(10,2) NULL, CHANGE `less_description3` `less_description3` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `comment` `comment` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `so_no` `so_no` VARCHAR(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `vehicle_no` `vehicle_no` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `other_cost` `other_cost` DECIMAL(8,2) NULL, CHANGE `items_description` `items_description` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `foot_description` `foot_description` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `doc_ids` `doc_ids` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `doc_nos` `doc_nos` VARCHAR(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `metre_in` `metre_in` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `metre_out` `metre_out` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `duedays` `duedays` SMALLINT(6) NULL;
.
ALTER TABLE `other_account_setting` ADD `department_id` INT NOT NULL AFTER `status`;
ALTER TABLE `account_setting` CHANGE `dr_account_master_id` `dr_account_master_id` INT(11) NULL, CHANGE `cr_account_master_id` `cr_account_master_id` INT(11) NULL, CHANGE `cash_account_id` `cash_account_id` INT(11) NULL, CHANGE `bank_account_id` `bank_account_id` INT(11) NULL, CHANGE `pdc_account_id` `pdc_account_id` INT(11) NULL, CHANGE `is_cash_voucher` `is_cash_voucher` TINYINT(4) NULL, CHANGE `default_account_id` `default_account_id` INT(11) NULL, CHANGE `description` `description` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `dr_account_master_id_to` `dr_account_master_id_to` INT(11) NULL, CHANGE `cr_account_master_id_to` `cr_account_master_id_to` INT(11) NULL;
UPDATE `account_setting` SET `department_id` = '1' WHERE `account_setting`.`id` = 68
UPDATE `account_setting` SET `department_id` = '1' WHERE `account_setting`.`id` = 69

<<<<<<< HEAD
ALTER TABLE `sales_return` ADD `department_id` INT NOT NULL AFTER `deleted_by`, ADD `prefix` VARCHAR(25) NULL AFTER `department_id`, ADD `is_intercompany` TINYINT NULL AFTER `prefix`;

ALTER TABLE `units` CHANGE `fracount` `fracount` TINYINT(4) NULL;
ALTER TABLE `units` CHANGE `description` `description` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `groupcat` CHANGE `description` `description` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `parent_id` `parent_id` TINYINT(4) NULL;

ALTER TABLE `category` CHANGE `description` `description` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `parent_id` `parent_id` TINYINT(4) NULL COMMENT '0=category,1=subcategory';

ALTER TABLE `item_unit` CHANGE `packing` `packing` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `opn_quantity` `opn_quantity` FLOAT NULL, CHANGE `opn_cost` `opn_cost` FLOAT NULL, CHANGE `sell_price` `sell_price` FLOAT NULL, CHANGE `wsale_price` `wsale_price` FLOAT NULL, CHANGE `min_quantity` `min_quantity` SMALLINT(6) NULL, CHANGE `reorder_level` `reorder_level` INT(11) NULL, CHANGE `vat` `vat` FLOAT NULL, CHANGE `cur_quantity` `cur_quantity` INT(11) NULL, CHANGE `is_baseqty` `is_baseqty` TINYINT(4) NULL, CHANGE `received_qty` `received_qty` INT(11) NULL, CHANGE `last_purchase_cost` `last_purchase_cost` FLOAT NULL, CHANGE `pur_count` `pur_count` INT(11) NULL, CHANGE `cost_avg` `cost_avg` FLOAT NULL, CHANGE `issued_qty` `issued_qty` INT(11) NULL, CHANGE `pkno` `pkno` FLOAT NULL;
ALTER TABLE `item_unit` CHANGE `opn_quantity` `opn_quantity` FLOAT NULL DEFAULT '0', CHANGE `opn_cost` `opn_cost` FLOAT NULL DEFAULT '0', CHANGE `sell_price` `sell_price` FLOAT NULL DEFAULT '0', CHANGE `wsale_price` `wsale_price` FLOAT NULL DEFAULT '0', CHANGE `min_quantity` `min_quantity` SMALLINT(6) NULL DEFAULT '0', CHANGE `reorder_level` `reorder_level` INT(11) NULL DEFAULT '0', CHANGE `cur_quantity` `cur_quantity` INT(11) NULL DEFAULT '0', CHANGE `received_qty` `received_qty` INT(11) NULL DEFAULT '0', CHANGE `last_purchase_cost` `last_purchase_cost` FLOAT NULL DEFAULT '0', CHANGE `pur_count` `pur_count` INT(11) NULL DEFAULT '0', CHANGE `cost_avg` `cost_avg` FLOAT NULL DEFAULT '0', CHANGE `issued_qty` `issued_qty` INT(11) NULL DEFAULT '0';

ALTER TABLE `material_requisition` ADD `department_id` INT NOT NULL AFTER `approved_at`, ADD `prefix` VARCHAR(10) NULL AFTER `department_id`, ADD `locfrom_id` INT NOT NULL AFTER `prefix`;
ALTER TABLE `material_requisition` CHANGE `job_id` `job_id` INT(11) NULL, CHANGE `description` `description` VARCHAR(290) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `salesman_id` `salesman_id` INT(11) NULL, CHANGE `discount` `discount` FLOAT NULL, CHANGE `supplier_id` `supplier_id` INT(11) NULL, CHANGE `location_id` `location_id` INT(11) NULL, CHANGE `foot_description` `foot_description` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `approval_status` `approval_status` TINYINT(4) NULL, CHANGE `approved_by` `approved_by` INT(11) NULL, CHANGE `approved_at` `approved_at` DATETIME NULL, CHANGE `locfrom_id` `locfrom_id` INT(11) NULL;
ALTER TABLE `material_requisition_item` CHANGE `is_editable` `is_editable` TINYINT(4) NULL DEFAULT '0', CHANGE `is_transfer` `is_transfer` TINYINT(4) NULL DEFAULT '0';
ALTER TABLE `material_requisition_item` ADD `remarks` VARCHAR(220) NULL AFTER `balance_quantity`;

ALTER TABLE `bank` CHANGE `name` `name` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `account_no` `account_no` VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `vat_master` CHANGE `name` `name` VARCHAR(85) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `percentage` `percentage` FLOAT NULL, CHANGE `vat_cal` `vat_cal` FLOAT NULL, CHANGE `collection_account` `collection_account` INT(11) NULL, CHANGE `payment_account` `payment_account` INT(11) NULL, CHANGE `expense_account` `expense_account` INT(11) NULL, CHANGE `vatinput_import` `vatinput_import` INT(11) NULL, CHANGE `vatoutput_import` `vatoutput_import` INT(11) NULL, CHANGE `is_department` `is_department` TINYINT(4) NULL;

ALTER TABLE `buildingmaster` CHANGE `buildingname` `buildingname` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `ownername` `ownername` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `location` `location` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `area` `area` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `mobno` `mobno` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `description` `description` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `docname` `docname` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `prefix` `prefix` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `plot_no` `plot_no` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `unit_price` `unit_price` DECIMAL(6,2) NULL, CHANGE `security_deposit` `security_deposit` DECIMAL(8,2) NULL, CHANGE `connection_charge` `connection_charge` DECIMAL(8,2) NULL, CHANGE `other_charge` `other_charge` DECIMAL(8,2) NULL, CHANGE `disconnection_charge` `disconnection_charge` DECIMAL(10,2) NULL, CHANGE `other_charge_dis` `other_charge_dis` DECIMAL(10,2) NULL, CHANGE `other_charge_con` `other_charge_con` DECIMAL(10,2) NULL;
ALTER TABLE `bud_photos` CHANGE `photo` `photo` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `flat_master` CHANGE `flat_name` `flat_name` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `description` `description` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `docname` `docname` VARCHAR(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `contra_type` CHANGE `daily_rent` `daily_rent` TINYINT(4) NULL;

ALTER TABLE `location_transfer` CHANGE `reference_no` `reference_no` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `description` `description` VARCHAR(180) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `type` `type` VARCHAR(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL COMMENT 'doc item table type', CHANGE `typeid` `typeid` INT(11) NULL COMMENT 'doc item table id';
ALTER TABLE `location_transfer_item` CHANGE `item_name` `item_name` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `unit_id` `unit_id` INT(11) NULL;

ALTER TABLE `purchase_order` ADD `prefix` VARCHAR(12) NULL AFTER `is_draft`, ADD `is_intercompany` TINYINT NULL AFTER `prefix`, ADD `doc_nos` VARCHAR(150) NULL AFTER `is_intercompany`;

ALTER TABLE `purchase_order` CHANGE `lpo_date` `lpo_date` DATE NULL, CHANGE `document_type` `document_type` VARCHAR(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `document_id` `document_id` INT(11) NULL, CHANGE `terms_id` `terms_id` INT(11) NULL, CHANGE `job_id` `job_id` INT(11) NULL, CHANGE `is_fc` `is_fc` TINYINT(4) NOT NULL DEFAULT '0', CHANGE `currency_id` `currency_id` INT(11) NULL, CHANGE `currency_rate` `currency_rate` FLOAT NULL, CHANGE `header_id` `header_id` INT(11) NULL, CHANGE `footer_id` `footer_id` INT(11) NULL, CHANGE `is_transfer` `is_transfer` TINYINT(4) NULL DEFAULT '0', CHANGE `is_editable` `is_editable` TINYINT(4) NULL DEFAULT '0', CHANGE `is_import` `is_import` TINYINT(4) NOT NULL DEFAULT '0', CHANGE `other_cost` `other_cost` DECIMAL(10,2) NULL, CHANGE `other_cost_fc` `other_cost_fc` DECIMAL(10,2) NULL, CHANGE `location_id` `location_id` INT(11) NULL, CHANGE `approval_status` `approval_status` TINYINT(4) NOT NULL DEFAULT '0', CHANGE `is_settled` `is_settled` TINYINT(4) NOT NULL DEFAULT '0', CHANGE `is_draft` `is_draft` TINYINT(4) NOT NULL DEFAULT '0';

ALTER TABLE `supplier_do` ADD `prefix` VARCHAR(12) NULL AFTER `foot_description`, ADD `is_intercompany` TINYINT NULL DEFAULT '0' AFTER `prefix`, ADD `doc_nos` VARCHAR(200) NULL AFTER `is_intercompany`;

ALTER TABLE `item_location_pi` ADD `department_id` INT NOT NULL AFTER `qty_entry`;

ALTER TABLE `purchase_invoice` ADD `prefix` VARCHAR(12) NULL AFTER `due_date`, ADD `is_intercompany` TINYINT NULL DEFAULT '0' AFTER `prefix`, ADD `doc_nos` VARCHAR(200) NULL AFTER `is_intercompany`;
ALTER TABLE `purchase_invoice` CHANGE `lpo_date` `lpo_date` DATE NULL, CHANGE `document_type` `document_type` VARCHAR(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `document_id` `document_id` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `job_id` `job_id` INT(11) NULL, CHANGE `terms_id` `terms_id` INT(11) NULL, CHANGE `currency_id` `currency_id` INT(11) NULL, CHANGE `currency_rate` `currency_rate` FLOAT NULL, CHANGE `advance` `advance` DECIMAL(10,2) NULL, CHANGE `balance_amount` `balance_amount` DECIMAL(10,2) NULL, CHANGE `lpo_no` `lpo_no` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `po_no` `po_no` VARCHAR(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `supplier_name` `supplier_name` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `is_pventry` `is_pventry` TINYINT(4) NULL DEFAULT '0', CHANGE `document_no` `document_no` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `duedays` `duedays` SMALLINT(6) NULL, CHANGE `due_date` `due_date` DATE NULL;

ALTER TABLE `purchase_return` ADD `prefix` VARCHAR(12) NULL AFTER `foot_description`, ADD `is_intercompany` TINYINT NULL DEFAULT '0' AFTER `prefix`;
ALTER TABLE `purchase_return` CHANGE `job_id` `job_id` INT(11) NULL, CHANGE `is_fc` `is_fc` TINYINT(4) NULL DEFAULT '0', CHANGE `currency_id` `currency_id` INT(11) NULL, CHANGE `currency_rate` `currency_rate` FLOAT NULL, CHANGE `purchase_invoice_no` `purchase_invoice_no` VARCHAR(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `purchase_return_item` CHANGE `width` `width` FLOAT NULL, CHANGE `length` `length` FLOAT NULL, CHANGE `mp_qty` `mp_qty` FLOAT NULL;
ALTER TABLE `item_location_pr` ADD `department_id` INT NOT NULL AFTER `qty_entry`;

ALTER TABLE `item_stock` ADD `department_id` INT NOT NULL AFTER `cur_quantity`;

ALTER TABLE `sales_return` CHANGE `job_id` `job_id` INT(11) NULL, CHANGE `is_fc` `is_fc` TINYINT(4) NULL DEFAULT '0', CHANGE `currency_id` `currency_id` INT(11) NULL, CHANGE `currency_rate` `currency_rate` FLOAT NULL, CHANGE `sales_invoice_no` `sales_invoice_no` VARCHAR(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `location_id` `location_id` INT(11) NULL, CHANGE `is_prior` `is_prior` TINYINT(4) NULL DEFAULT '0', CHANGE `foot_description` `foot_description` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `is_intercompany` `is_intercompany` TINYINT(4) NULL DEFAULT '0';
ALTER TABLE `sales_return_item` CHANGE `conloc_id` `conloc_id` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `conloc_qty` `conloc_qty` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `width` `width` FLOAT NULL, CHANGE `length` `length` FLOAT NULL, CHANGE `mp_qty` `mp_qty` FLOAT NULL;
ALTER TABLE `item_location_sr` ADD `department_id` INT NOT NULL AFTER `qty_entry`;
UPDATE `account_setting` SET `department_id` = '1' WHERE `account_setting`.`id` = 77;

INSERT INTO `voucher_no` (`id`, `voucher_type`, `no`, `status`, `name`, `prefix`, `autoincrement`, `modified_at`, `department_id`) VALUES (NULL, 'PE', '100', '1', 'Purchase Enquiry', 'PE', '1', NULL, '1')

INSERT INTO `location` (`id`, `code`, `name`, `is_default`, `status`, `department_id`, `deleted_at`, `is_conloc`, `customer_id`, `is_minus_qty`) VALUES (NULL, 'MSAF', 'MUSAFFAH', '1', '1', '2', '0000-00-00 00:00:00', '0', '0', '0')

INSERT INTO `forms` (`id`, `code`, `name`, `status`) VALUES (NULL, 'PE', 'Purchase Enquiry', '1')

INSERT INTO `form_details` (`id`, `form_id`, `field_code`, `field_name`, `active`, `status`, `list_ord`) VALUES
(621, 34, 'jobname', 'Job Code', 0, 1, 0),
(622, 34, 'description', 'Description', 1, 1, 0),
(623, 34, 'salesman', 'Salesman', 1, 1, 0),
(624, 34, 'supplier_name', 'Supplier Name', 1, 1, 0),
(625, 34, 'location', 'Location', 1, 1, 0),
(626, 34, 'more_info', 'More Info', 0, 1, 0),
(627, 34, 'location_item', 'Location Item', 1, 1, 0);


--
-- Table structure for table `purchase_enquiry`
--

CREATE TABLE `purchase_enquiry` (
  `id` int NOT NULL,
  `prefix` varchar(20) NOT NULL,
  `voucher_no` varchar(100) NOT NULL,
  `voucher_date` date NOT NULL,
  `job_id` int NOT NULL,
  `department_id` int NOT NULL,
  `locfrom_id` int NOT NULL,
  `description` varchar(290) NOT NULL,
  `salesman_id` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` float NOT NULL,
  `net_amount` decimal(10,2) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  `modify_at` datetime NOT NULL,
  `modify_by` int NOT NULL,
  `deleted_at` datetime NOT NULL,
  `is_transfer` tinyint NOT NULL,
  `supplier_id` int NOT NULL,
  `location_id` int NOT NULL,
  `foot_description` text NOT NULL,
  `approval_status` tinyint NOT NULL,
  `approved_by` int NOT NULL,
  `approved_at` datetime NOT NULL,
  `is_intercompany` tinyint NOT NULL,
  `is_draft` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Indexes for dumped tables
--

--
-- Indexes for table `purchase_enquiry`
--
ALTER TABLE `purchase_enquiry`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voucher_no` (`voucher_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchase_enquiry`
--
ALTER TABLE `purchase_enquiry`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;



--
-- Table structure for table `purchase_enquiry_item`
--

CREATE TABLE `purchase_enquiry_item` (
  `id` int NOT NULL,
  `purchase_enquiry_id` int NOT NULL,
  `item_id` int NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `unit_id` int NOT NULL,
  `quantity` float NOT NULL,
  `unit_price` float NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` tinyint NOT NULL,
  `deleted_at` datetime NOT NULL,
  `is_editable` tinyint NOT NULL,
  `is_transfer` tinyint NOT NULL,
  `balance_quantity` decimal(10,2) NOT NULL,
  `remarks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Indexes for dumped tables
--

--
-- Indexes for table `purchase_enquiry_item`
--
ALTER TABLE `purchase_enquiry_item`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchase_enquiry_item`
--
ALTER TABLE `purchase_enquiry_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;



ALTER TABLE `purchase_enquiry` CHANGE `job_id` `job_id` INT(11) NULL, CHANGE `department_id` `department_id` INT(11) NULL, CHANGE `description` `description` VARCHAR(290) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `salesman_id` `salesman_id` INT(11) NULL, CHANGE `is_transfer` `is_transfer` TINYINT(4) NULL DEFAULT '0', CHANGE `supplier_id` `supplier_id` INT(11) NULL, CHANGE `foot_description` `foot_description` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `approval_status` `approval_status` TINYINT(4) NULL DEFAULT '0', CHANGE `approved_by` `approved_by` INT(11) NULL, CHANGE `approved_at` `approved_at` DATETIME NULL, CHANGE `is_intercompany` `is_intercompany` TINYINT(4) NULL DEFAULT '0', CHANGE `is_draft` `is_draft` TINYINT(4) NULL DEFAULT '0';

ALTER TABLE `purchase_enquiry_item` CHANGE `item_name` `item_name` VARCHAR(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `is_editable` `is_editable` TINYINT(4) NULL DEFAULT '0', CHANGE `is_transfer` `is_transfer` TINYINT(4) NULL DEFAULT '0', CHANGE `balance_quantity` `balance_quantity` DECIMAL(10,2) NULL, CHANGE `remarks` `remarks` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;






=======
ALTER TABLE `sales_return` ADD `department_id` INT NOT NULL AFTER `deleted_by`, ADD `prefix` VARCHAR(25) NULL AFTER `department_id`, ADD `is_intercompany` TINYINT NULL AFTER `prefix`;
>>>>>>> 45aa6610d356aac74e1b3b1cf8dae75c26e83400
