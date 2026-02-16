<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Itemmaster\ItemmasterInterface;
use App\Repositories\Jobmaster\JobmasterInterface;
use App\Repositories\AccountMaster\AccountMasterInterface;
use App\Repositories\VoucherNo\VoucherNoInterface;
use App\Repositories\PurchaseEnquiry\PurchaseEnquiryInterface;
use App\Repositories\AccountSetting\AccountSettingInterface;
use App\Repositories\PurchaseOrder\PurchaseOrderInterface;
use App\Repositories\SupplierDo\SupplierDoInterface;
use App\Repositories\Forms\FormsInterface;
use App\Repositories\MaterialRequisition\MaterialRequisitionInterface;
use App\Repositories\Location\LocationInterface;


use App\Http\Requests;
use Session;
use Response;
use DB;
use Excel;
use App;
use Auth;

class PurchaseEnquiryController extends Controller
{
	protected $itemmaster;
	protected $accountmaster;
	protected $voucherno;
	protected $accountsetting;
	protected $forms;
    protected $material_requisition; 
	protected $jobmaster;
	protected $formData;
	protected $purchase_order;
	protected $supplierdo;
	protected $purchase_enquiry;
	protected $mod_purchase_enquiry;
	protected $location;
	
	public function __construct(PurchaseEnquiryInterface $purchase_enquiry,MaterialRequisitionInterface $material_requisition,  JobmasterInterface $jobmaster, SupplierDOInterface $supplierdo, PurchaseOrderInterface $purchase_order,ItemmasterInterface $itemmaster, AccountMasterInterface $accountmaster, VoucherNoInterface $voucherno,FormsInterface $forms, AccountSettingInterface $accountsetting,LocationInterface $location) {
		
		parent::__construct( App::make('App\Repositories\Parameter1\Parameter1Interface'), App::make('App\Repositories\VatMaster\VatMasterInterface') );
		
		$this->middleware('auth');
		$this->itemmaster = $itemmaster;
		$this->accountmaster = $accountmaster;
		$this->voucherno = $voucherno;
		$this->purchase_order = $purchase_order;
		$this->supplierdo = $supplierdo;
		$this->jobmaster = $jobmaster;
		$this->voucherno = $voucherno;
		$this->forms = $forms;
		$this->formData = $this->forms->getFormData('PE');
        $this->material_requisition = $material_requisition;
		$this->purchase_enquiry = $purchase_enquiry;
		$this->accountsetting = $accountsetting;
		$this->location = $location;
		//$this->mod_purchase_enquiry = DB::table('parameter2')->where('keyname', 'mod_purchase_enquiry')->where('status',1)->select('is_active')->first(); //print_r($this->mod_purchase_enquiry);exit();
	}
	
	public function index() {
		
		$data = array();
		$matrec = [];
		$salesman = DB::table('salesman')->where('status',1)->where('deleted_at','0000-00-00 00:00:00')->orderBy('name','ASC')->get();
		$jobs = $this->jobmaster->activeJobmasterList();
		$items = $this->itemmaster->activeItemmasterList();
		
           //print_r($matrec);exit();
             return view('body.purchaseenquiry.index')
					->withMatrec($matrec)
					->withSalesman($salesman)
					->withJobs($jobs)
					->withItems($items)
					->withData($data);
	}
	
	
	public function ajaxPaging(Request $request)
	{
		$columns = array( 
                            0 => 'voucher_no',
							1 => 'voucher_date',
							2 => 'supplier',
                            3 => 'jobname',
                            4 => 'net_amount',
                            5=>'approved_user',
							6=>'locfrom',
							7=>'locto'
                        );
						
		$totalData = $this->purchase_enquiry->purchaseenqListCount();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = 'purchase_enquiry.id';//$columns[$request->input('order.0.column')];
        $dir = 'desc';//$request->input('order.0.dir');
		$search = (empty($request->input('search.value')))?null:$request->input('search.value');
        
		$invoices = $this->purchase_enquiry->purchaseenqList('get', $start, $limit, $order, $dir, $search);
		
		if($search)
			$totalFiltered =  $this->purchase_enquiry->purchaseenqList('count', $start, $limit, $order, $dir, $search);
		$prints = DB::table('report_view_detail')
							->join('report_view','report_view.id','=','report_view_detail.report_view_id')
							->where('report_view.code','PE')
							->select('report_view_detail.name','report_view_detail.id','report_view_detail.print_name')
							->get();
		
        $data = array();
        if(!empty($invoices))
        {
           
			foreach ($invoices as $row)
            {
                $edit =  '"'.url('purchase_enquiry/edit/'.$row->id).'"';
                 $editd =  '"'.url('purchase_enquiry/edit_draft/'.$row->id).'"';
                $delete =  'funDelete("'.$row->id.'")';
				$print = url('purchase_enquiry/print/'.$row->id);
				$view =  url('purchase_enquiry/views/'.$row->id);
				$opts = '';					
				foreach($prints as $doc) {
					$opts .= "<li role='presentation'><a href='{$print}/".$doc->id."' target='_blank' role='menuitem'>".$doc->name."</a></li>";
				}
				
                $nestedData['id'] = $row->id;
                $nestedData['voucher_no'] = $row->voucher_no;
				$nestedData['voucher_date'] = date('d-m-Y', strtotime($row->voucher_date));
				$nestedData['supplier'] = $row->supplier;
				$nestedData['jobname'] = $row->code;
				$nestedData['locfrom'] = $row->location_from;
				$nestedData['locto'] = $row->location_to;
				$nestedData['net_amount'] = number_format($row->net_amount,2);
				$nestedData['approved_user'] = ($row->approval_status==1)?$row->approved_user:'';
				if($row->is_draft==1) {								
			     $nestedData['edit'] = "<p><button class='btn btn-primary btn-xs' onClick='location.href={$editd}'>
												<span class='glyphicon glyphicon-pencil'></span></button></p>";						
				}else{	
				$nestedData['edit'] = "<p><button class='btn btn-primary btn-xs' onClick='location.href={$edit}'>
												<span class='glyphicon glyphicon-pencil'></span></button></p>";
				}								
				$nestedData['delete'] = "<button class='btn btn-danger btn-xs delete' onClick='{$delete}'>
											<span class='glyphicon glyphicon-trash'></span>";
				
				$nestedData['view'] = "<p><a href='{$view}' class='btn btn-info btn-xs' target='_blank'><i class='fa fa-fw fa-eye'></i></a></p>";								
				 //$nestedData['print'] = "<p><a href='{$print}' class='btn btn-primary btn-xs' target='_blank'><span class='fa fa-fw fa-print'></span></a></p>";
				 $nestedData['print'] = "<div class='btn-group drop_btn' role='group'>
											<button type='button' class='btn btn-primary btn-xs dropdown-toggle m-r-50'
													id='exampleIconDropdown1' data-toggle='dropdown' aria-expanded='false'>
												<i class='fa fa-fw fa-print' aria-hidden='true'></i><span class='caret'></span>
											</button>
											<ul style='min-width:100px !important;' class='dropdown-menu' aria-labelledby='exampleIconDropdown1' role='menu'>
												".$opts."
											</ul>
										</div>"; 
											
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data);
	}
	
	
	public function add(Request $request, $id = null, $doctype = null) {

		$data = array();
		$itemmaster = $this->itemmaster->activeItemmasterList();
		//echo '<pre>';print_r($itemmaster);exit;
		$jobs = $this->jobmaster->activeJobmasterList();
		
		$location = $this->location->locationList();
        $locationfrom = $this->location->locationFrom();
        $locationto = $this->location->locationTo();
        $defaultInter = DB::table('location')
                         ->where('department_id','!=',auth()->user()->department_id ?? 1)
                         ->where('is_default', 1) ->first();
		$res = $this->voucherno->getVoucherNo('PE'); //echo '<pre>';print_r($location);exit;
		$settings = $this->accountsetting->getAccountPeriod();//
		
		if($id) {
		    
			$ids = explode(',', $id); //
		    
			$ocrow = $getItemLocation = $itemlocedit = [];
			if($doctype=='PO') {
		
				$docRow = $this->purchase_order->findPOdata($ids);
		       // echo '<pre>';print_r($docRow);exit;
				$docItems = $this->purchase_order->getPOitems($ids);
				//echo '<pre>';print_r($docItems);exit;
				$ocrow = $this->purchase_order->getOtherCost($ids[0]);
			}  else if($doctype=='SDO') {
				$docRow = $this->supplierdo->findSDOdata($ids[0]);
				$docItems = $this->supplierdo->getSDOitems($ids);
				$ocrow = $this->supplierdo->getOtherCost($ids[0]);
				
				$getItemLocation = $this->itemmaster->getItemLocation($id,'SDO');
				$itemlocedit = $this->makeTreeArr( $this->itemmaster->getItemLocEdit($id,'SDO') ); //echo '<pre>';print_r($getItemLocation); print_r($itemlocedit); exit;
			}
			$total = 0; $discount = 0; $nettotal = 0; $vat_total = 0;
			foreach($docItems as $item) {
				$total += $item->total_price;
				$discount += $item->discount;
				$vat_total += $item->vat_amount;
			}
			 $nettotal = $total - $discount + $vat_total;
			  return view('body.purchaseenquiry.addsdo')
			                     ->withItems($itemmaster)
								 ->withSettings($settings)
								 ->withItems($itemmaster)
								 ->withJobs($jobs)
								 ->withDocrow($docRow)
								 ->withDocitems($docItems)
								 ->withLocation($location)
								 ->withPordid($id)
								 ->withTotal($total)
								 ->withDiscount($discount)
								 ->withVattotal($vat_total)
								 ->withDoctype($doctype)
								 ->withDocitems($docItems)
			                     ->withPordid($id)
			                     ->withTotal($total)
			                     ->withVoucherno($res)
								 ->withFormdata($this->formData)
								 ->withData($data);
		}	  

		return view('body.purchaseenquiry.add')
					->withItems($itemmaster)
					->withSettings($settings)
					->withVoucherno($res)
					->withFormdata($this->formData)
					->withLocation($location)
                    ->withLocationfrom($locationfrom)
                    ->withLocationto($locationto)
                    ->withInterid($defaultInter->id)
                    ->withIntercode($defaultInter->code)
					->withIntername($defaultInter->name)
					->withJobs($jobs)
					->withData($data);
	}
	
	public function save(Request $request,$id = null) {
	    
	    
		//echo '<pre>';print_r($request->all());exit;
		$attributes	= $request->all();
		$is_inter=isset($attributes['is_intercompany'])?$attributes['is_intercompany']:0;
	
		$this->validate(
				$request, 
				[ 
				// 'supplier_name' => 'required','supplier_id' => 'required',
				// 'jobname' => 'required','job_id' => 'required',
				'locfrom_id' =>($is_inter==1)?'required':'nullable',//'required','locfrom_id' => 'required',
				 'location_id' =>'required','location_id' => 'required',
				  'item_code.*'  => 'required', 'item_id.*' => 'required',
				// 'unit_id.*' => 'required',
				 'quantity.*' => 'required',
				 //'cost.*' => 'required' 
				],
				[
				
				// 'supplier_name.required' => 'Supplier Name is required.','supplier_id.required' => 'Supplier name is invalid.',
				// 'jobname.required' => 'Job Code is required.','job_id.required' => 'Job Code is invalid.',
				'locfrom_id' => 'From Location is required.',
				//'locfrom_id.required' => 'From Location is required.','locfrom_id.required' => 'Location From is invalid.',
				'location_id.required' => 'TO Location is required.','location_id.required' => 'Location To is invalid.',
				 'item_code.*.required'   => 'Item code is required.', 'item_id.*' => 'Item code is invalid.',
				 //'unit_id.*' => 'Item unit is required.',
				 'quantity.*' => 'Item quantity is required.',
				 //'cost.*' => 'Item cost is required.' 
				]
			);
				
		$this->purchase_enquiry->create($request->all());
		Session::flash('message', 'Purchase enquiry added successfully.');
		return redirect('purchase_enquiry/add');
	}
	
	public function saveDraft(Request $request,$id = null) {
	    
	    
		//echo '<pre>';print_r($request->all());exit;
		
		 $this->validate(
				$request, 
				[ 
				// 'supplier_name' => 'required','supplier_id' => 'required',
				// 'jobname' => 'required','job_id' => 'required',
				'locfrom_id' =>'required','locfrom_id' => 'required',
				 'location_id' =>'required','location_id' => 'required',
				  'item_code.*'  => 'required', 'item_id.*' => 'required',
				// 'unit_id.*' => 'required',
				 'quantity.*' => 'required',
				 //'cost.*' => 'required' 
				],
				[
				
				// 'supplier_name.required' => 'Supplier Name is required.','supplier_id.required' => 'Supplier name is invalid.',
				// 'jobname.required' => 'Job Code is required.','job_id.required' => 'Job Code is invalid.',
				'locfrom_id.required' => 'From Location is required.','locfrom_id.required' => 'Location From is invalid.',
				'location_id.required' => 'TO Location is required.','location_id.required' => 'Location To is invalid.',
				 'item_code.*.required'   => 'Item code is required.', 'item_id.*' => 'Item code is invalid.',
				 //'unit_id.*' => 'Item unit is required.',
				 'quantity.*' => 'Item quantity is required.',
				 //'cost.*' => 'Item cost is required.' 
				]
			);
		$this->purchase_enquiry->create($request->all());
		Session::flash('message', 'Purchase enquiry drafted successfully.');
		return redirect('purchase_enquiry/add');
	}
	
	
	public function edit($id) { 

		$data = array();
		$itemmaster = $this->itemmaster->activeItemmasterList();
		$orderrow = $this->purchase_enquiry->findPOdata($id);
		$orditems = $this->purchase_enquiry->getItems($id);
		$location = $this->location->locationList();
        $locationfrom = $this->location->locationFrom();
        $locationto = $this->location->locationTo();
		//echo '<pre>';print_r($orderrow);exit;
		return view('body.purchaseenquiry.edit')
					->withItems($itemmaster)
					->withOrditems($orditems)
					->withOrderrow($orderrow)
					->withFormdata($this->formData)
					->withLocation($location)
                    ->withLocationfrom($locationfrom)
                    ->withLocationto($locationto)
					->withData($data);


	}
	
	
	public function update(Request $request,$id)
	{
	    $this->validate(
				$request, 
				[ 
				 //'supplier_name' => 'required','supplier_id' => 'required',
				 //'jobname' => 'required','job_id' => 'required',
				 'locfrom_id' =>'required','locfrom_id' => 'required',
				 'location_id' =>'required','location_id' => 'required',
				  'item_code.*'  => 'required', 'item_id.*' => 'required',
				// 'unit_id.*' => 'required',
				 'quantity.*' => 'required',
				 //'cost.*' => 'required' 
				],
				[
				
				// 'supplier_name.required' => 'Supplier Name is required.','supplier_id.required' => 'Supplier name is invalid.',
				// 'jobname.required' => 'Job Code is required.','job_id.required' => 'Job Code is invalid.',
				'locfrom_id.required' => 'From Location is required.','locfrom_id.required' => 'Location From is invalid.',
				'location_id.required' => 'TO Location is required.','location_id.required' => 'Location To is invalid.',
				 'item_code.*.required'   => 'Item code is required.', 'item_id.*' => 'Item code is invalid.',
				 //'unit_id.*' => 'Item unit is required.',
				 'quantity.*' => 'Item quantity is required.',
				 //'cost.*' => 'Item cost is required.' 
				]
			);
	    
		$this->purchase_enquiry->update($id, $request->all());
		Session::flash('message', 'Purchase Enquiry updated successfully');
		return redirect('purchase_enquiry');
	}
	
		public function editDraft($id) { 

		$data = array();
		$itemmaster = $this->itemmaster->activeItemmasterList();
		$orderrow = $this->purchase_enquiry->findPOdata($id);
		$orditems = $this->purchase_enquiry->getItems($id);
		$location = $this->location->locationList();
        $locationfrom = $this->location->locationFrom();
        $locationto = $this->location->locationTo();
		//echo '<pre>';print_r($orderrow);exit;
		return view('body.purchaseenquiry.edit-draft')
					->withItems($itemmaster)
					->withOrditems($orditems)
					->withOrderrow($orderrow)
					->withFormdata($this->formData)
					->withLocation($location)
                    ->withLocationfrom($locationfrom)
                    ->withLocationto($locationto)
					->withData($data);


	}
	
	
	public function updateDraft(Request $request,$id)
	{
	    $this->validate(
				$request, 
				[ 
				 //'supplier_name' => 'required','supplier_id' => 'required',
				 //'jobname' => 'required','job_id' => 'required',
				 'locfrom_id' =>'required','locfrom_id' => 'required',
				 'location_id' =>'required','location_id' => 'required',
				  'item_code.*'  => 'required', 'item_id.*' => 'required',
				// 'unit_id.*' => 'required',
				 'quantity.*' => 'required',
				 //'cost.*' => 'required' 
				],
				[
				
				// 'supplier_name.required' => 'Supplier Name is required.','supplier_id.required' => 'Supplier name is invalid.',
				// 'jobname.required' => 'Job Code is required.','job_id.required' => 'Job Code is invalid.',
				'locfrom_id.required' => 'From Location is required.','locfrom_id.required' => 'Location From is invalid.',
				'location_id.required' => 'TO Location is required.','location_id.required' => 'Location To is invalid.',
				 'item_code.*.required'   => 'Item code is required.', 'item_id.*' => 'Item code is invalid.',
				 //'unit_id.*' => 'Item unit is required.',
				 'quantity.*' => 'Item quantity is required.',
				 //'cost.*' => 'Item cost is required.' 
				]
			);
	    
		$this->purchase_enquiry->update($id, $request->all());
		Session::flash('message', 'Purchase Enquiry draft updated successfully');
		return redirect('purchase_enquiry');
	}
	
	public function getViews($id) { 

		$data = array();
		$itemmaster = $this->itemmaster->activeItemmasterList();
		$orderrow = $this->purchase_enquiry->findPOdata($id);
		$orditems = $this->purchase_enquiry->getItems($id);
		$location = $this->location->locationList();
        $locationfrom = $this->location->locationFrom();
        $locationto = $this->location->locationTo();
		//echo '<pre>';print_r($orderrow);exit;
		return view('body.purchaseenquiry.viewapproval')
					->withItems($itemmaster)
					->withOrditems($orditems)
					->withOrderrow($orderrow)
					->withFormdata($this->formData)
					->withLocation($location)
                    ->withLocationfrom($locationfrom)
                    ->withLocationto($locationto)
					->withData($data);


	}
		public function getApproval($id)
	{
		DB::table('purchase_enquiry')->where('id',$id)->update(['approval_status' => 1,'approved_by'=>Auth::User()->id,'approved_at'=>date('Y-m-d H:i:s')]);
		Session::flash('message', 'Purchase Enquiry approved successfully.');
		return redirect('purchase_enquiry');
	}
		public function getReject($id)
	{
		DB::table('purchase_enquiry')->where('id',$id)->update(['approval_status' => 2,'approved_by'=>Auth::User()->id,'approved_at'=>date('Y-m-d H:i:s')]);
		Session::flash('message', 'Purchase Enquiry rejected successfully.');
		return redirect('purchase_enquiry');
	}
	
	public function getEnquiry($supplier_id, $url)
	{
		$data = array();
		$enquiry = $this->purchase_enquiry->getSupplierEnquiry($supplier_id);//print_r($quotations);exit;
		return view('body.purchaseenquiry.enquiry')
					->withEnqs($enquiry)
					->withUrl($url)
					->withData($data);
	}
	public function destroy($id)
	{
		DB::table('purchase_enquiry')->where('id',$id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
		Session::flash('message', 'Purchase Enquiry deleted successfully.');
		return redirect('purchase_enquiry');
	}
	
	
	public function getPrint($id,$rid=null)
	{
	    
	    $viewfile = DB::table('report_view_detail')->where('id', $rid)->select('print_name')->first(); 
			//echo '<pre>';print_r($viewfile);exit;
		if(isset($viewfile) && $viewfile->print_name=='') {
		$attributes['document_id'] = $id;
		$result = $this->purchase_enquiry->getInvoice($attributes);
		$titles = ['main_head' => 'Material Requisition','subhead' => 'Material Requisition'];
		return view('body.purchaseenquiry.print')
					->withDetails($result['details'])
					->withTitles($titles)
					->withItems($result['items']);
		//echo '<pre>';print_r($result);exit;
		}
		
		else {
					
			$path = app_path() . '/stimulsoft/helper.php';
			if(isset($viewfile))
				return view('body.salesinvoice.viewer')->withPath($path)->withView($viewfile->print_name);
		}
	}
		
	
	public function getItemDetails($id) {
		$data = array();
		$items = $this->purchase_enquiry->getMRitems(array($id));
		return view('body.purchaseorder.itemdetails')
					->withItems($items)
					->withData($data);
	}
	
	protected function makeArrGroup($result,$cur)
	{
		$childs = array();
		foreach($result as $item)
			$childs[$item['voucher_no']][] = $item;
		
		$arr = array();
		foreach($childs as $child) {
			$pending_qty = $pending_amt = $net_amount = 0;
			foreach($child as $row) {
			    $pending_qty = ($row->balance_quantity==0)?$row->quantity:$row->balance_quantity;
				$unit_price = ($cur=='')?$row->unit_price:($row->unit_price / $row->currency_rate);
				
			    $pending_amt += $pending_qty * $unit_price;
				$net_amount = $pending_amt;
				$voucher_no = $row->voucher_no;
				$suppname = $row->master_name;
				$jobcode = $row->jobcode;
				$salesman = $row->salesman;
				$jobname = $row->jobname;
			}
			$arr[] = ['voucher_no' => $voucher_no,'jobname' => $jobname,'jobcode' => $jobcode, 'master_name' => $suppname, 'total' => $pending_amt,'net_amount' => $net_amount,'salesman'=>$salesman];
			
		}

		return $arr;
	}
	
	public function getSearch(Request $request)
	{
	    //echo '<pre>';print_r($request->all());exit;
		$data = array();$curcode = '';
		if($request->get('currency_id')!='') {
			$cur = DB::table('currency')->where('id',$request->get('currency_id'))->select('code')->first();
			$curcode = ' in '.$cur->code;
		}
		
		$reports = $this->purchase_enquiry->getReport($request->all());
		
		if($request->get('search_type')=="summary")
			$voucher_head = 'Purchase Enquiry Summary'.$curcode;
		elseif($request->get('search_type')=="summary_pending") {

			$voucher_head = 'Purchase Enquiry Pending Summary'.$curcode;
			$reports = $this->makeArrGroup($reports,$curcode);

		} elseif($request->get('search_type')=="detail") {
			$voucher_head = 'Purchase Enquiry Detail'.$curcode;
			$reports = $this->makeTree($reports);
		} else {
		    if($request->get('search_type')=="detail_pending"){
			$voucher_head = 'Purchase Enquiry Pending Detail'.$curcode;
		    }
		    else{
		       $voucher_head = 'Purchase Enquiry Quantity Detail'.$curcode; 
		    }
			
			$reports = $this->makeTree($reports);
		}
		//echo '<pre>';print_r($reports);exit;
		return view('body.purchaseenquiry.preprint')
					->withReports($reports)
					->withVoucherhead($voucher_head)
					->withType($request->get('search_type'))
					->withFromdate($request->get('date_from'))
					->withTodate($request->get('date_to'))
					->withI(0)
					->withSettings($this->acsettings)
					->withCur($curcode)
					->withItemid($request->get('item_id'))
					->withCurid($request->get('currency_id'))
					->withSalesman($request->get('salesman'))
					->withData($data);
	}
	
	
	protected function makeTree($reports)
	{
		$childs = array();
		foreach($reports as $item)
			$childs[$item['voucher_no']][] = $item;
		
		return $childs;
	}

	

	
	
	public function dataExport(Request $request)
	{
		$data = array();
		//echo '<pre>';print_r($request->all());exit;
		$reports = $this->purchase_enquiry->getReport($request->all());
		
		$datareport[] = ['','','',strtoupper(Session::get('company')),'','',''];
		$datareport[] = ['','','','','','',''];
		$curcode = '';
		if($request->get('search_type')=="summary")
			$voucher_head = 'Purchase Enquiry Summary';
		elseif($request->get('search_type')=="summary_pending") {
			$voucher_head = 'Purchase Enquiry Pending Summary';
			$reports = $this->makeArrGroup($reports,$curcode);
		} elseif($request->get('search_type')=="detail") {
			$voucher_head = 'Purchase Enquiry Detail'.$curcode;
			//$reports = $this->makeTree($reports);
		} elseif($request->get('search_type')=="detail_pending"){
			$voucher_head = 'Purchase Enquiry Pending Detail'.$curcode;
			//$reports = $this->makeTree($reports);
		}
		else {
			$voucher_head = 'Purchase Enquiry Quantity Detail'.$curcode;
			//$reports = $this->makeTree($reports);
			
		}
		
		$datareport[] = ['','','',strtoupper($voucher_head), '','',''];
		$datareport[] = ['','','','','','',''];
		
		 
		
		if($request->get('search_type')=='summary') {
			
			$datareport[] = ['SI.No.','MR.No', 'Job No','Job Name','Engineer','Total','Net Amount'];
			$i = $net_total = 0;
			
			foreach ($reports as $row) {
					$i++;
					$datareport[] = [ 'si' => $i,
									  'po' => $row->voucher_no,
									  'jobcode' => $row->jocode,
									  'name' => $row->jobname,
									  'salesman' => $row->salesman,
									  'description' => $row->total,
									  'total' => $row->net_amount
									];
									
				  $net_total += $row->net_amount;
			}
			$datareport[] = ['','','','','','',''];
			$datareport[] = ['','','','','','Total:',number_format($net_total,2)];
		} else if($request->get('search_type')=='summary_pending') {
			
			$datareport[] = ['SI.No.','MR.No', 'Job No','Job Name','Engineer','Total','Net Amount'];
			$i=$net_total=0;
			foreach ($reports as $row) {
					$i++;
					$datareport[] = [ 'si' => $i,
									  'po' => $row['voucher_no'],
									  'jobno' => $row['jobcode'],
									  'supplier' => $row['jobname'],
									  'salesman' => $row['salesman'],
									  'gross' => number_format($row['total'],2),
									  'total' => number_format($row['net_amount'],2)
									];
									$net_total += $row['net_amount'];
			}
			$datareport[] = ['','','','','','',''];
			$datareport[] = ['','','','','','Total:',number_format($net_total,2)];
			
		} else if($request->get('search_type')=='detail' ) {
			
			$datareport[] = ['SI.No.','MR#', 'Job No', 'Job Name','Engineer','Item Code','Description','MR.Qty','Rate','Total Amt.'];
			$i=0;
			foreach ($reports as $row) {
				$i++;
				$datareport[] = [ 'si' => $i,
								  'po' => $row['voucher_no'], 
								  'jobno' => $row['jobcode'],
								  'supplier' => $row['jobname'],
								  'salesman' => $row['salesman'],
								  'item_code' => $row['item_code'],
								  'description' => $row['description'],
								  'quantity' => $row['quantity'],
								  'unit_price' => number_format($row['unit_price'],2),
								  'net_amount' => number_format($row['net_amount'],2)
								];
			}
		} else if( $request->get('search_type')=='detail_pending') {
			
			$datareport[] = ['SI.No.','MR#', 'Job No', 'Job Name','Engineer','Item Code','Description','MR.Qty','Rate','Total Amt.','Inv.Qty','Pending Qty','Rate','Total Amt.'];
			$i=$inv_qty=$pending_qty=$pending_amt=0;
			foreach ($reports as $row) {
				$i++;
				$inv_qty = ($row['balance_quantity']==0)?0:$row['quantity']- $row['balance_quantity'];
					$pending_qty = ($row['balance_quantity']==0)?$row['quantity']:$row['balance_quantity'];
						$pending_amt = $pending_qty * $row['unit_price'];
				$datareport[] = [ 'si' => $i,
								  'po' => $row['voucher_no'], 
								  'jobno' => $row['jobcode'],
								  'supplier' => $row['jobname'],
								  'salesman' => $row['salesman'],
								  'item_code' => $row['item_code'],
								  'description' => $row['description'],
								  'quantity' => $row['quantity'],
								  'unit_price' => number_format($row['unit_price'],2),
								  'net_amount' => number_format($row['net_amount'],2),
								   'inv_qty' => $inv_qty,
								    'pending' => $pending_qty,
								    'unit_pric' => number_format($row['unit_price'],2),
								    'pending_amount' => number_format($pending_amt,2)
								  
								];
			}
		} 
		
		
		
		
		else if($request->get('search_type')=='qty_report')  {
			
			$datareport[] = ['SI.No.','MR#', 'MR.Ref#', 'Job No', 'Supplier','Item Code','Description','Ordered','Processed','Balance'];
			$i=$inv_qty=$pending_qty=0;
			foreach ($reports as $row) {
				$i++;
					$inv_qty = ($row['balance_quantity']==0)?0:$row['quantity']- $row['balance_quantity'];
					$pending_qty = ($row['balance_quantity']==0)?$row['quantity']:$row['balance_quantity'];
				$datareport[] = [ 'si' => $i,
								  'po' => $row['voucher_no'], 
								  'ref' => $row['reference_no'],
								  'jobno' => $row['jobcode'],
								  'supplier' => $row['master_name'],
								  'item_code' => $row['item_code'],
								  'description' => $row['description'],
								  'quantity' => $row['quantity'],
								  'processed' => $inv_qty,
								  'bal' => $pending_qty
								];
			}
		} 
		
		
		//echo $voucher_head.'<pre>';print_r($datareport);exit;
		Excel::create($voucher_head, function($excel) use ($datareport,$voucher_head) {
			
        // Set the spreadsheet title, creator, and description
        $excel->setTitle($voucher_head);
        $excel->setCreator('Profit Acc 365')->setCompany(Session::get('company'));
        $excel->setDescription($voucher_head);

        // Build the spreadsheet, passing in the payments array
		$excel->sheet('sheet1', function($sheet) use ($datareport) {
			
			$sheet->fromArray($datareport, null, 'A1', false, false);
		       
		});
        //echo '<pre>';print_r($datareport);exit;
		})->download('xlsx');
		
	}
	
}
