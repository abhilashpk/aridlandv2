<?php 
namespace App\Repositories\PurchaseEnquiry;


use App\Models\PurchaseEnquiry;
use App\Models\PurchaseEnquiryItem;
use App\Models\ItemStock;
use App\Models\AccountTransaction;
use App\Repositories\AbstractValidator;
use App\Exceptions\Validation\ValidationException;
use App\Repositories\UpdateUtility;
use Config;
use DB;
use Session;
use Auth;

class PurchaseEnquiryRepository extends AbstractValidator implements PurchaseEnquiryInterface {
	
	
	protected $purchase_enquiry;
	public $objUtility;
	
	protected static $rules = [];
	
	public function __construct(PurchaseEnquiry $purchase_enquiry) {
		
        $this->purchase_enquiry = $purchase_enquiry;
		$this->objUtility = new UpdateUtility();
	}
	
	public function all()
	{
		return $this->purchase_enquiry->get();
	}
	
	public function find($id)
	{
		return $this->purchase_enquiry->where('id', $id)->first();
	}
	
	//set input fields values
	private function setInputValue($attributes)
	{
		$this->purchase_enquiry->voucher_no = $attributes['voucher_no']; 
		$this->purchase_enquiry->voucher_date = ($attributes['voucher_date']=='')?date('Y-m-d'):date('Y-m-d', strtotime($attributes['voucher_date']));
		$this->purchase_enquiry->job_id = isset($attributes['job_id'])?$attributes['job_id']:'';
		$this->purchase_enquiry->department_id = env('DEPARTMENT_ID');
		$this->purchase_enquiry->locfrom_id = isset($attributes['locfrom_id'])?$attributes['locfrom_id']:'';
		$this->purchase_enquiry->description = isset($attributes['description'])?$attributes['description']:'';
		$this->purchase_enquiry->salesman_id = isset($attributes['salesman_id'])?$attributes['salesman_id']:'';
		$this->purchase_enquiry->location_id = isset($attributes['location_id'])?$attributes['location_id']:'';
		$this->purchase_enquiry->prefix = isset($attributes['prefix'])?$attributes['prefix']:'';
        $this->purchase_enquiry->is_intercompany = isset($attributes['is_intercompany'])?$attributes['is_intercompany']:'';
        $this->purchase_enquiry->is_draft = (isset($attributes['is_draft']))?$attributes['is_draft']:0;
		return true;
	}
	
	
	private function setItemInputValue($attributes, $objPurchaseEnqItem, $key, $value, $total_quantity=null)
	{
		
		//echo '<pre>';print_r($attributes);exit;								 
		//$line_total = ($attributes['cost'][$key] * $attributes['quantity'][$key]) - (isset($attributes['line_discount']))?$attributes['line_discount']:''[$key];
		$line_total = ((float)$attributes['cost'][$key] * (float)$attributes['quantity'][$key]);		
		$objPurchaseEnqItem->purchase_enquiry_id = $this->purchase_enquiry->id;
		$objPurchaseEnqItem->item_id = $attributes['item_id'][$key];
		$objPurchaseEnqItem->unit_id = $attributes['unit_id'][$key];
		$objPurchaseEnqItem->item_name = $attributes['item_name'][$key];
		$objPurchaseEnqItem->quantity = isset($attributes['quantity'][$key])?$attributes['quantity'][$key]:0;
		$objPurchaseEnqItem->unit_price = isset($attributes['cost'][$key])?$attributes['cost'][$key]:0;
		$objPurchaseEnqItem->total_price = isset($attributes['line_total'][$key])?$attributes['line_total'][$key]:0;
		$objPurchaseEnqItem->remarks = isset($attributes['remarks'][$key])?$attributes['remarks'][$key]:0;
		
		return array('line_total' => $line_total);
		
	}
	
	
	public function create($attributes)
	{ 
		//echo '<pre>';print_r($attributes);exit;
		if($this->isValid($attributes)) {
			DB::beginTransaction();
			try {

				//VOUCHER NO LOGIC.....................
				$dept = env('DEPARTMENT_ID');

				 // ⿢ Get the highest numeric part from voucher_master
				$qry = DB::table('purchase_enquiry')->where('deleted_at', '0000-00-00 00:00:00')->where('status', 1)->where('department_id', env('DEPARTMENT_ID'));
				

				$maxNumeric = $qry->select(DB::raw("MAX(CAST(REGEXP_REPLACE(voucher_no, '[^0-9]', '') AS UNSIGNED)) AS max_no"))->value('max_no');
				
				$attributes['voucher_no'] = $this->objUtility->generateVoucherNoDoc('PE', $maxNumeric, $dept, $attributes['voucher_no'],$attributes['prefix']);
				//VOUCHER NO LOGIC.....................
				
				//exit;
				$maxRetries = 5; // prevent infinite loop
				$retryCount = 0;
				$saved = false;

				while (!$saved && $retryCount < $maxRetries) {
				try {
						if($this->setInputValue($attributes)) {
							$this->purchase_enquiry->status = 1;
							$this->purchase_enquiry->created_at = date('Y-m-d H:i:s');
							$this->purchase_enquiry->created_by =  Auth::User()->id;
							$this->purchase_enquiry->fill($attributes)->save();
							$saved = true;
						}
					} catch (\Illuminate\Database\QueryException $ex) {

						// Check if it's a duplicate voucher number error
						if (strpos($ex->getMessage(), 'Duplicate entry') !== false || strpos($ex->getMessage(), 'duplicate key value') !== false) {

							$dept = env('DEPARTMENT_ID');

							// ⿢ Get the highest numeric part from voucher_master
							$qry = DB::table('purchase_enquiry')->where('deleted_at', '0000-00-00 00:00:00')->where('status', 1)->where('department_id', env('DEPARTMENT_ID'));
							

							$maxNumeric = $qry->select(DB::raw("MAX(CAST(REGEXP_REPLACE(voucher_no, '[^0-9]', '') AS UNSIGNED)) AS max_no"))->value('max_no');
							
							$attributes['voucher_no'] = $this->objUtility->generateVoucherNoDoc('PE', $maxNumeric, $dept, $attributes['voucher_no'],$attributes['prefix']);

							$retryCount++;
						} else {
							throw $ex; // rethrow if different DB error
						}
					}
				}


				
				
				//invoice items insert
				if($this->purchase_enquiry->id && !empty( array_filter($attributes['item_id']))) {
					
					$line_total = 0; $total_quantity = 0;
					
					foreach($attributes['item_id'] as $key => $value){ 
						$objPurchaseEnqItem = new PurchaseEnquiryItem();
						$arrResult 	= $this->setItemInputValue($attributes, $objPurchaseEnqItem, $key, $value, $total_quantity);
					
						
					//	if($arrResult['line_total']) {
						    $line_total += $arrResult['line_total'];
							$objPurchaseEnqItem->status = 1;
							$itemObj = 	$this->purchase_enquiry->doItem()->save($objPurchaseEnqItem);
							$zero = DB::table('purchase_enquiry_item')->where('id', $itemObj->id)->where('unit_id',0)->first();
					           if($zero && $zero->item_id != 0){
						         $uid=  DB::table('item_unit')->where('itemmaster_id', $zero->item_id)->first();
						         DB::table('purchase_enquiry_item')->where('id', $itemObj->id)->update(['unit_id' => $uid->unit_id]);
						       }
					//	}
					}
					
					// $net_amount = $line_total - $attributes['discount'];
					$net_amount = $line_total;
					DB::table('purchase_enquiry')
								->where('id', $this->purchase_enquiry->id)
								->update(['voucher_no' => (isset($attributes['is_draft']) && $attributes['is_draft']==1 )?'Draft-'.$attributes['voucher_no']:$attributes['voucher_no'],
								           'total'    	  => $line_total,
										  'discount' 	  => $attributes['discount'],
										  'net_amount'	  => $net_amount ]
										 );
										 
					
					
				}
				
				DB::commit();
				return true;
				
			} catch(\Exception $e) { 
			
				DB::rollback(); echo $e->getLine().'-'.$e->getMessage();exit;
				return false;
			}
		}
		
	}
	
	public function update($id, $attributes)
	{
		$this->purchase_enquiry = $this->find($id);
			//draft
				if(isset($attributes['is_draft']) && $attributes['is_draft']==0) {
				    $voucherno = explode('-',$attributes['voucher_no']);
				    //echo '<pre>';print_r($voucherno[1]);exit;
				    $attributes['voucher_no']=$voucherno[1];
				   
					}
				
				//end
			
		$line_total = 0;
		if($this->purchase_enquiry->id && !empty( array_filter($attributes['item_id']))) {
			foreach($attributes['item_id'] as $key => $value) { 
				
				if($attributes['order_item_id'][$key]!='') {
					
					$lntotal = (float)$attributes['cost'][$key] * (float)$attributes['quantity'][$key];
					$line_total += $lntotal;
					
					$objPurchaseEnqItem = PurchaseEnquiryItem::find($attributes['order_item_id'][$key]);//print_r($objMaterialReqItem);exit;//$attributes['order_item_id'][$key]);echo $attributes['order_item_id'][$key].'<pre>';
					$exi_quantity = $objPurchaseEnqItem->quantity;
					$items['item_name'] = $attributes['item_name'][$key];
					$items['item_id'] = $value;
					$items['unit_id'] = $attributes['unit_id'][$key];
					$items['quantity'] = isset($attributes['quantity'][$key])?$attributes['quantity'][$key]:0;
					$items['unit_price'] = isset($attributes['cost'][$key])?$attributes['cost'][$key]:0;
					$items['remarks'] = isset($attributes['remarks'][$key])?$attributes['remarks'][$key]:0;
					$items['total_price'] = $lntotal;
					$objPurchaseEnqItem->update($items);
						$zero = DB::table('purchase_enquiry_item')->where('id', $attributes['order_item_id'][$key])->where('unit_id',0)->first();
						    if($zero && $zero->item_id != 0){
						     $uid=  DB::table('item_unit')->where('itemmaster_id', $zero->item_id)->first();
						     DB::table('purchase_enquiry_item')->where('id', $attributes['order_item_id'][$key])->update(['unit_id' => $uid->unit_id]);
						     }
										
				} else { //new entry...
					$objPurchaseEnqItem = new PurchaseEnquiryItem();
					$arrResult 		= $this->setItemInputValue($attributes, $objPurchaseEnqItem, $key, $value);
					//if($arrResult['line_total']) {
						$line_total			     += $arrResult['line_total'];
						$objPurchaseEnqItem->status = 1;
					$itemObj=$this->purchase_enquiry->doItem()->save($objPurchaseEnqItem);
						$zero = DB::table('purchase_enquiry_item')->where('id', $itemObj->id)->where('unit_id',0)->first();
					           if($zero && $zero->item_id != 0){
						         $uid=  DB::table('item_unit')->where('itemmaster_id', $zero->item_id)->first();
						         DB::table('purchase_enquiry_item')->where('id', $itemObj->id)->update(['unit_id' => $uid->unit_id]);
						       }
					//}
				}
				
			}
		}
		
		if($this->setInputValue($attributes)) {
			$this->purchase_enquiry->modify_at = date('Y-m-d H:i:s');
			$this->purchase_enquiry->modify_by = Auth::User()->id;
			$this->purchase_enquiry->fill($attributes)->save();
		}
		
		
		//manage removed items...
		if($attributes['remove_item']!='')
		{
			$arrids = explode(',', $attributes['remove_item']);
			$remline_total = $remtax_total = 0;
			foreach($arrids as $row) {
				
				$res = DB::table('purchase_enquiry_item')->where('id',$row)->first();
				DB::table('purchase_enquiry_item')->where('id', $row)->update(['status' => 0,'deleted_at' => date('Y-m-d H:i:s')]);
					
			}
		}
		$this->purchase_enquiry->fill($attributes)->save();
		
		$net_amount = $line_total - (float)$attributes['discount'];
		
		
		//update discount, total amount
		DB::table('purchase_enquiry')
					->where('id', $this->purchase_enquiry->id)
					->update(['total'    	  => $line_total,
							  //'discount' 	  => $attributes['discount'],
							  'is_draft'	  => isset($attributes['is_draft'])?$attributes['is_draft']:0,
							  'net_amount'	  => $net_amount,
							 ]);
									  
		return true;
	}
	
	public function delete($id)
	{
		$this->purchase_enquiry = $this->purchase_enquiry->find($id);
		
		//inventory update...
		$items = DB::table('purchase_enquiry_item')->where('purchase_enquiry_id', $id)->select('item_id','unit_id','quantity')->get();
		
		DB::table('purchase_enquiry_item')->where('purchase_enquiry_id', $id)
								->update(['status' => 0, 'deleted_at' => date('Y-m-d H:i:s')]);
		
		$this->purchase_enquiry->delete();
	}
	

	public function materialReqList2()
	{
		$query = $this->purchase_enquiry->where('purchase_enquiry.status',1);
		return $query->join('jobmaster AS J', function($join) {
							$join->on('J.id','=','purchase_enquiry.job_id');
						} )
					->select('purchase_enquiry.*','J.name AS jobname')
					->orderBY('purchase_enquiry.id', 'DESC')
					->get();
	}
	
	public function activePurchaseInvoiceList()
	{
		return $this->purchase_enquiry->select('id','name')->where('status', 1)->orderBy('name', 'ASC')->get()->toArray();
	}
	
	public function check_reference_no($refno, $id = null) { 
		
		if($id)
			return $this->purchase_enquiry->where('reference_no',$refno)->where('id', '!=', $id)->count();
		else
			return $this->purchase_enquiry->where('reference_no',$refno)->count();
	}
	
	
	public function getPIdata()
	{
		$query = $this->purchase_enquiry->where('purchase_enquiry.status',1);
		
		return $query->join('account_master AS am', function($join) {
							$join->on('am.id','=','purchase_enquiry.supplier_id');
						} )
					
					->select('purchase_enquiry.*','am.master_name AS supplier')
					->orderBY('purchase_enquiry.id', 'ASC')
					->get();
	}
		
	public function getSDOitems($id)
	{
		$query = $this->purchase_enquiry->where('purchase_enquiry.voucher_no',$id);
		
		return $query->join('purchase_invoice_item AS poi', function($join) {
							$join->on('poi.material_requisition_id','=','purchase_enquiry.id');
						} )
					  ->join('units AS u', function($join){
						  $join->on('u.id','=','poi.unit_id');
					  }) 
					  ->select('poi.*','u.unit_name')->get();
		//return $this->itemmaster->where('status', 1)->orderBy('description','ASC')->select('id','item_code','description')->get();
	}
	
	public function getSupplierInvoice($supplier_id)
	{
		return $this->purchase_enquiry->where('status',1)
								   ->where('supplier_id', $supplier_id)
								   ->whereIn('amount_transfer',[0,2])
								   ->orderBY('id', 'ASC')
								   ->get();
	}
	
	
	
	public function findPOdata($id)
	{
		$query = $this->purchase_enquiry->where('purchase_enquiry.id', $id)->where('purchase_enquiry.department_id',env('DEPARTMENT_ID'));
		return $query->leftJoin('jobmaster AS J', function($join){
						  $join->on('J.id','=','purchase_enquiry.job_id');
						})
					->leftJoin('salesman AS S', function($join){
						  $join->on('S.id','=','purchase_enquiry.salesman_id');
						})
					->leftJoin('account_master AS AM', function($join){
						  $join->on('AM.id','=','purchase_enquiry.supplier_id');
						})
					->select('purchase_enquiry.*','J.name','S.name AS salesman','AM.master_name AS supplier','J.code')
					->orderBY('purchase_enquiry.id', 'ASC')
					->first();
	}
	
	public function getItems($id)
	{
		$query = $this->purchase_enquiry->where('purchase_enquiry.id',$id);
		
		return $query->join('purchase_enquiry_item AS GI', function($join) {
							$join->on('GI.purchase_enquiry_id','=','purchase_enquiry.id');
						} )
					  ->join('units AS u', function($join){
						  $join->on('u.id','=','GI.unit_id');
					  }) 
					  ->join('itemmaster AS im', function($join){
						  $join->on('im.id','=','GI.item_id');
					  })
					  ->where('GI.status',1)
					  ->where('GI.deleted_at','0000-00-00 00:00:00')
					  ->select('GI.*','u.unit_name','im.item_code')->get();
	}
	
	public function getInvoice($attributes)
	{
		$invoice = $this->purchase_enquiry->where('purchase_enquiry.id', $attributes['document_id'])->where('purchase_enquiry.department_id',env('DEPARTMENT_ID'))
								   ->join('jobmaster AS J', function($join) {
									   $join->on('J.id','=','purchase_enquiry.job_id');
								   })
								    ->leftJoin('salesman AS S', function($join) {
									   $join->on('S.id','=','purchase_enquiry.salesman_id');
								   })
								   ->select('J.name AS supplier','purchase_enquiry.*','J.code','J.name','S.name AS salesman')
								   ->orderBY('purchase_enquiry.id', 'ASC')
								   ->first();
								   
		$items = $this->purchase_enquiry->where('purchase_enquiry.id', $attributes['document_id'])->where('purchase_enquiry.department_id',env('DEPARTMENT_ID'))
								   ->join('purchase_enquiry_item AS GI', function($join) {
									   $join->on('GI.purchase_enquiry_id','=','purchase_enquiry.id');
								   })
								   ->join('itemmaster AS IM', function($join) {
									   $join->on('IM.id','=','GI.item_id');
								   })
								   ->join('units AS U', function($join) {
									   $join->on('U.id','=','GI.unit_id');
								   })
								   ->select('GI.*','purchase_enquiry.id','IM.item_code','U.unit_name')
								   ->get();
								   
		return $result = ['details' => $invoice, 'items' => $items];
	}
			
	public function findQuoteData($id)
	{
		$query = $this->purchase_enquiry->where('purchase_enquiry.id', $id)->where('purchase_enquiry.is_transfer', 0);
		return $query->join('account_master AS am', function($join) {
							$join->on('am.id','=','purchase_enquiry.supplier_id');
						} )
					
					->leftJoin('salesman AS S', function($join) {
							$join->on('S.id','=','purchase_enquiry.salesman_id');
						} )
					->select('purchase_enquiry.*','am.master_name AS supplier',
							 'S.name AS salesman')
					->orderBY('purchase_enquiry.id', 'ASC')
					->first();
	}
	
	public function getCEItems($id)
	{
		$query = $this->purchase_enquiry->whereIn('purchase_enquiry.id',$id);
		
		return $query->join('purchase_enquiry_item AS poi', function($join) {
							$join->on('poi.purchase_enquiry_id','=','purchase_enquiry.id');
						} )
					  ->join('units AS u', function($join){
						  $join->on('u.id','=','poi.unit_id');
					  }) 
					  ->join('itemmaster AS im', function($join){
						  $join->on('im.id','=','poi.item_id');
					  })
					  ->join('item_unit AS iu', function($join){
						  $join->on('iu.itemmaster_id','=','im.id');
					  })
					  ->where('poi.status',1)
					  ->whereIn('poi.is_transfer',[0,2])
					  ->where('poi.deleted_at','0000-00-00 00:00:00')
					  ->select('poi.*','u.unit_name','im.item_code','iu.is_baseqty')
					  ->orderBY('poi.id')->groupBy('poi.id')
					  ->get();
					  
		
	}
	
	public function getPEdata()
	{
	    
	    //$doc=DB::table('parameter1')->select('doc_approve')->first();
	    //echo '<pre>';print_r($doc);exit;
	    
	    
	   
	    $query = $this->purchase_enquiry
                  ->join('location AS L', function($join){
						  $join->on('L.id','=','purchase_enquiry.location_id');
					  })
                    ->where('purchase_enquiry.status',1)->where('purchase_enquiry.department_id',env('DEPARTMENT_ID'))
                   ->where('purchase_enquiry.is_transfer',0);//->where('purchase_enquiry.approval_status',1)
	    
		return $query->select('purchase_enquiry.*')
					->orderBY('purchase_enquiry.id', 'ASC')
					->get();
	}
	
	
	public function findMRdata($id)
	{
		$query = $this->purchase_enquiry
						->leftjoin('account_master','account_master.id','=','purchase_enquiry.supplier_id')
						->leftJoin('jobmaster AS J',function($join) {
							$join->on('J.id','=','purchase_enquiry.job_id');
						})
						->where('purchase_enquiry.id', $id)
                        ->where('purchase_enquiry.department_id',env('DEPARTMENT_ID'));
		return $query->select('purchase_enquiry.*','account_master.master_name as supplier','J.code')
					->orderBY('purchase_enquiry.id', 'ASC')
					->first();
	}
	
	public function getSupplierEnquiry($supplier_id)
	{
		return $this->purchase_enquiry
								->leftJoin('salesman AS S', function($join) {
									$join->on('S.id','=','purchase_enquiry.salesman_id');
								} )
							 ->where('purchase_enquiry.status', 1)
							 ->where('purchase_enquiry.supplier_id', $supplier_id)
							 ->where('purchase_enquiry.is_transfer', 0)
							 ->select('purchase_enquiry.id','purchase_enquiry.voucher_no','purchase_enquiry.voucher_date',
							'S.name AS salesman','purchase_enquiry.net_amount')
							 ->get();
		
	}



	public function getMRitems($id)
	{
		$query = $this->purchase_enquiry->whereIn('purchase_enquiry.id',$id)->where('purchase_enquiry.department_id',env('DEPARTMENT_ID'));
		
		return $query->join('purchase_enquiry_item AS poi', function($join) {
							$join->on('poi.purchase_enquiry_id','=','purchase_enquiry.id');
						} )
                        ->join('location AS L', function($join){
						  $join->on('L.id','=','purchase_enquiry.location_id');
					  })
					  ->join('units AS u', function($join){
						  $join->on('u.id','=','poi.unit_id');
					  }) 
                       
					  ->join('itemmaster AS im', function($join){
						  $join->on('im.id','=','poi.item_id');
					  })
					   ->join('item_unit AS iu', function($join){
						  $join->on('iu.itemmaster_id','=','im.id');
						  //$join->on('iu.unit_id','=','poi.unit_id');
					  })
                      ->join('itemstock_department AS isd', function($join){
						  $join->on('isd.itemmaster_id','=','im.id');
					  })
                      
					  ->where('poi.status',1)
					  ->whereIn('poi.is_transfer',[0,2])
					  ->where('poi.deleted_at', '0000-00-00 00:00:00')
                      ->where('isd.department_id',env('DEPARTMENT_ID'))
					  ->select('poi.*','u.unit_name','im.item_code','isd.is_baseqty') //AP16
					  ->orderBY('poi.id')
					  ->get();
					  
	}
	
	public function getReport($attributes)
	{
		$date_from = ($attributes['date_from']!='')?date('Y-m-d', strtotime($attributes['date_from'])):'';
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):'';
		
		if($attributes['search_type']=='summary') {
			
			$query = $this->purchase_enquiry
							->join('purchase_enquiry_item AS POI', function($join) {
								$join->on('POI.purchase_enquiry_id','=','purchase_enquiry.id');
							})
							->join('itemmaster AS IM', function($join) {
								$join->on('IM.id','=','POI.item_id');
							})
							->leftjoin('account_master AS AM', function($join) {
								$join->on('AM.id','=','purchase_enquiry.supplier_id');
							})
							->leftjoin('jobmaster AS JB', function($join) {
								$join->on('JB.id','=','purchase_enquiry.job_id');
							})
							->leftJoin('salesman AS S', function($join) {
								$join->on('S.id','=','purchase_enquiry.salesman_id');
							})
                            ->where('purchase_enquiry.department_id',env('DEPARTMENT_ID'))
							->where('POI.status',1);
							
					if( $date_from!='' && $date_to!='' ) { 
						$query->whereBetween('purchase_enquiry.voucher_date', array($date_from, $date_to));
					}
					
					if($attributes['salesman']!='') { 
						$query->where('purchase_enquiry.salesman_id', $attributes['salesman']);
					}
					
					if($attributes['item_id']!='') { 
						$query->where('POI.item_id', $attributes['item_id']);
					}
					
					if(isset($attributes['job_id']))
						$query->whereIn('purchase_enquiry.job_id', $attributes['job_id']);
					
			return $query->select('purchase_enquiry.voucher_no','IM.item_code','IM.description','purchase_enquiry.total',
									  'purchase_enquiry.description','POI.quantity','POI.balance_quantity','POI.unit_price','AM.account_id',
									  'AM.master_name','purchase_enquiry.net_amount','JB.code as jobcode','S.name as salesman','JB.name AS jobname')
							->groupBy('purchase_enquiry.id')->get();
									  
			
		}
		elseif($attributes['search_type']=='summary_pending') {
			
			$query = $this->purchase_enquiry
							->join('purchase_enquiry_item AS POI', function($join) {
								$join->on('POI.purchase_enquiry_id','=','purchase_enquiry.id');
							})
							->join('itemmaster AS IM', function($join) {
								$join->on('IM.id','=','POI.item_id');
							})
							->leftjoin('account_master AS AM', function($join) {
								$join->on('AM.id','=','purchase_enquiry.supplier_id');
							})
							->leftjoin('jobmaster AS JB', function($join) {
								$join->on('JB.id','=','purchase_enquiry.job_id');
							})
							->leftJoin('salesman AS S', function($join) {
								$join->on('S.id','=','purchase_enquiry.salesman_id');
							})
                            ->where('purchase_enquiry.department_id',env('DEPARTMENT_ID'))
							->where('POI.is_transfer','!=',1)
							->where('POI.status',1);
							
					if( $date_from!='' && $date_to!='' ) { 
						$query->whereBetween('purchase_enquiry.voucher_date', array($date_from, $date_to));
					}
					
					if($attributes['salesman']!='') { 
						$query->where('purchase_enquiry.salesman_id', $attributes['salesman']);
					}
					
					if($attributes['item_id']!='') { 
						$query->where('POI.item_id', $attributes['item_id']);
					}
					
					if(isset($attributes['job_id']))
						$query->whereIn('purchase_enquiry.job_id', $attributes['job_id']);
					
			return $query->select('purchase_enquiry.voucher_no','purchase_enquiry.total','S.name AS salesman',
								  'purchase_enquiry.voucher_date','POI.quantity','POI.unit_price','JB.code as jobcode','JB.name AS jobname',
								  'purchase_enquiry.net_amount','purchase_enquiry.is_transfer','AM.master_name','POI.balance_quantity')
							->get();
		}
		elseif($attributes['search_type']=='detail') {
			
			$query = $this->purchase_enquiry
							->join('purchase_enquiry_item AS POI', function($join) {
								$join->on('POI.purchase_enquiry_id','=','purchase_enquiry.id');
							})
							->leftjoin('jobmaster AS JB', function($join) {
								$join->on('JB.id','=','purchase_enquiry.job_id');
							})
							->leftjoin('account_master AS AM', function($join) {
								$join->on('AM.id','=','purchase_enquiry.supplier_id');
							})
							->join('itemmaster AS IM', function($join) {
									$join->on('IM.id','=','POI.item_id');
							})
							->leftJoin('salesman AS S', function($join) {
								$join->on('S.id','=','purchase_enquiry.salesman_id');
							})
                            ->where('purchase_enquiry.department_id',env('DEPARTMENT_ID'))
							->where('POI.status',1);
							
					if( $date_from!='' && $date_to!='' ) { 
						$query->whereBetween('purchase_enquiry.voucher_date', array($date_from, $date_to));
					}
					
					if($attributes['salesman']!='') { 
						$query->where('purchase_enquiry.salesman_id', $attributes['salesman']);
					}
					
					if($attributes['item_id']!='') { 
						$query->where('POI.item_id', $attributes['item_id']);
					}
					
					if(isset($attributes['job_id']))
						$query->whereIn('purchase_enquiry.job_id', $attributes['job_id']);
					
			return $query->select('purchase_enquiry.voucher_no','IM.item_code','IM.description','purchase_enquiry.total','S.name AS salesman','AM.master_name',
								  'purchase_enquiry.voucher_date','POI.quantity','POI.unit_price','JB.code as jobcode','JB.name AS jobname',
								  'purchase_enquiry.net_amount','POI.item_name','POI.total_price','POI.balance_quantity')
								  ->get(); 
		}
		elseif(($attributes['search_type']=='detail_pending')||($attributes['search_type']=='qty_report')) {
			
			$query = $this->purchase_enquiry
							->join('purchase_enquiry_item AS POI', function($join) {
								$join->on('POI.purchase_enquiry_id','=','purchase_enquiry.id');
							})
							->leftjoin('jobmaster AS JB', function($join) {
								$join->on('JB.id','=','purchase_enquiry.job_id');
							})
							->leftjoin('account_master AS AM', function($join) {
								$join->on('AM.id','=','purchase_enquiry.supplier_id');
							})
							->join('itemmaster AS IM', function($join) {
									$join->on('IM.id','=','POI.item_id');
							})
							->leftJoin('salesman AS S', function($join) {
								$join->on('S.id','=','purchase_enquiry.salesman_id');
							})
                            ->where('purchase_enquiry.department_id',env('DEPARTMENT_ID'))
							->where('POI.is_transfer','!=',1)
							->where('POI.status',1);
							
					if( $date_from!='' && $date_to!='' ) { 
						$query->whereBetween('purchase_enquiry.voucher_date', array($date_from, $date_to));
					}
					
					if($attributes['salesman']!='') { 
						$query->where('purchase_enquiry.salesman_id', $attributes['salesman']);
					}
					
					if($attributes['item_id']!='') { 
						$query->where('POI.item_id', $attributes['item_id']);
					}
					
					if(isset($attributes['job_id']))
						$query->whereIn('purchase_enquiry.job_id', $attributes['job_id']);
					
			return $query->select('purchase_enquiry.voucher_no','purchase_enquiry.total','S.name AS salesman','AM.master_name','IM.description',
								  'purchase_enquiry.voucher_date','POI.quantity','POI.unit_price','JB.code as jobcode','JB.name AS jobname',
								  'purchase_enquiry.net_amount','POI.item_name','POI.total_price','IM.item_code','POI.balance_quantity')
							      ->get();  
		}
	}
	
	
	public function purchaseenqListCount()
	{
		$query = $this->purchase_enquiry->where('purchase_enquiry.status',1)->where('purchase_enquiry.department_id',env('DEPARTMENT_ID'));
		return $query->join('jobmaster AS J', function($join) {
							$join->on('J.id','=','purchase_enquiry.job_id');
						} )
					->count();
	}
	
	public function purchaseenqList($type,$start,$limit,$order,$dir,$search)
	{
		$query = $this->purchase_enquiry->where('purchase_enquiry.status',1)->where('purchase_enquiry.department_id',env('DEPARTMENT_ID'));
		$query->leftjoin('jobmaster AS J', function($join) {
							$join->on('J.id','=','purchase_enquiry.job_id');
						} )
						->leftjoin('account_master AS am', function($join) {
							$join->on('am.id','=','purchase_enquiry.supplier_id');
						} )
						->join('location AS LF', function($join) {
							$join->on('LF.id','=','purchase_enquiry.locfrom_id');
						} )
						->join('location AS LT', function($join) {
							$join->on('LT.id','=','purchase_enquiry.location_id');
						} )
						->leftjoin('users AS AU', function($join) {
							$join->on('AU.id','=','purchase_enquiry.approved_by');
						} );
						
		if($search) {
				
			$query->where(function($qry) use($search) {
				$qry->where('purchase_enquiry.voucher_no','LIKE',"%{$search}%")
				->orWhere('am.master_name', 'LIKE',"%{$search}%")
				->orWhere('LF.name', 'LIKE',"%{$search}%")
				  ->orWhere('LT.name', 'LIKE',"%{$search}%")
					->orWhere('J.name', 'LIKE',"%{$search}%");
			});
		}
			
		$query->select('purchase_enquiry.*','J.name AS jobname','am.master_name AS supplier','J.code','AU.name AS approved_user','LF.name AS location_from','LT.name AS location_to')
					->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir);
					
		if($type=='get')
			return $query->get();
		else
			return $query->count();
	}
	
}