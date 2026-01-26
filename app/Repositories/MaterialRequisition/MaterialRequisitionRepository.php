<?php namespace App\Repositories\MaterialRequisition;

use App\Models\MaterialRequisition;
use App\Models\MaterialRequisitionItem;
use App\Models\ItemStock;
use App\Models\AccountTransaction;
use App\Repositories\AbstractValidator;
use App\Exceptions\Validation\ValidationException;
use App\Repositories\UpdateUtility;
use Config;
use DB;
use Session;
use Auth;

class MaterialRequisitionRepository extends AbstractValidator implements MaterialRequisitionInterface {
	
	protected $material_requisition;
	
	public $objUtility;
	
	protected static $rules = [];
	
	public function __construct(MaterialRequisition $material_requisition) {
		$this->material_requisition = $material_requisition;
		$this->objUtility = new UpdateUtility();
	}
	
	public function all()
	{
		return $this->material_requisition->get();
	}
	
	public function find($id)
	{
		return $this->material_requisition->where('id', $id)->first();
	}
	
	//set input fields values
	private function setInputValue($attributes)
	{
		$this->material_requisition->voucher_no = $attributes['voucher_no']; 
		$this->material_requisition->voucher_date = ($attributes['voucher_date']=='')?date('Y-m-d'):date('Y-m-d', strtotime($attributes['voucher_date']));
		$this->material_requisition->job_id = isset($attributes['job_id'])?$attributes['job_id']:'';
		$this->material_requisition->department_id = env('DEPARTMENT_ID');
		$this->material_requisition->locfrom_id = isset($attributes['locfrom_id'])?$attributes['locfrom_id']:'';
		$this->material_requisition->description = isset($attributes['description'])?$attributes['description']:'';
		$this->material_requisition->salesman_id = isset($attributes['salesman_id'])?$attributes['salesman_id']:'';
		$this->material_requisition->location_id = isset($attributes['location_id'])?$attributes['location_id']:'';
		$this->material_requisition->prefix = isset($attributes['prefix'])?$attributes['prefix']:'';
		return true;
	}
	
	
	private function setItemInputValue($attributes, $objMaterialReqItem, $key, $value, $total_quantity=null)
	{
		
		//echo '<pre>';print_r($attributes);exit;								 
		//$line_total = ($attributes['cost'][$key] * $attributes['quantity'][$key]) - (isset($attributes['line_discount']))?$attributes['line_discount']:''[$key];
		$line_total = ((float)$attributes['cost'][$key] * (float)$attributes['quantity'][$key]);		
		$objMaterialReqItem->material_requisition_id = $this->material_requisition->id;
		$objMaterialReqItem->item_id = $attributes['item_id'][$key];
		$objMaterialReqItem->unit_id = $attributes['unit_id'][$key];
		$objMaterialReqItem->item_name = $attributes['item_name'][$key];
		$objMaterialReqItem->quantity = isset($attributes['quantity'][$key])?$attributes['quantity'][$key]:0;
		$objMaterialReqItem->unit_price = isset($attributes['cost'][$key])?$attributes['cost'][$key]:0;
		$objMaterialReqItem->total_price = isset($attributes['line_total'][$key])?$attributes['line_total'][$key]:0;
		$objMaterialReqItem->remarks = isset($attributes['remarks'][$key])?$attributes['remarks'][$key]:0;
		
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
				$qry = DB::table('material_requisition')->where('deleted_at', '0000-00-00 00:00:00')->where('status', 1)->where('department_id', env('DEPARTMENT_ID'));
				

				$maxNumeric = $qry->select(DB::raw("MAX(CAST(REGEXP_REPLACE(voucher_no, '[^0-9]', '') AS UNSIGNED)) AS max_no"))->value('max_no');
				
				$attributes['voucher_no'] = $this->objUtility->generateVoucherNoDoc('MR', $maxNumeric, $dept, $attributes['voucher_no'],$attributes['prefix']);
				//VOUCHER NO LOGIC.....................
				
				//exit;
				$maxRetries = 5; // prevent infinite loop
				$retryCount = 0;
				$saved = false;

				while (!$saved && $retryCount < $maxRetries) {
				try {
						if($this->setInputValue($attributes)) {
							$this->material_requisition->status = 1;
							$this->material_requisition->created_at = date('Y-m-d H:i:s');
							$this->material_requisition->created_by =  Auth::User()->id;
							$this->material_requisition->fill($attributes)->save();
							$saved = true;
						}
					} catch (\Illuminate\Database\QueryException $ex) {

						// Check if it's a duplicate voucher number error
						if (strpos($ex->getMessage(), 'Duplicate entry') !== false || strpos($ex->getMessage(), 'duplicate key value') !== false) {

							$dept = env('DEPARTMENT_ID');

							// ⿢ Get the highest numeric part from voucher_master
							$qry = DB::table('material_requisition')->where('deleted_at', '0000-00-00 00:00:00')->where('status', 1)->where('department_id', env('DEPARTMENT_ID'));
							

							$maxNumeric = $qry->select(DB::raw("MAX(CAST(REGEXP_REPLACE(voucher_no, '[^0-9]', '') AS UNSIGNED)) AS max_no"))->value('max_no');
							
							$attributes['voucher_no'] = $this->objUtility->generateVoucherNoDoc('MR', $maxNumeric, $dept, $attributes['voucher_no'],$attributes['prefix']);

							$retryCount++;
						} else {
							throw $ex; // rethrow if different DB error
						}
					}
				}


				/*if($this->setInputValue($attributes)) {
					$this->material_requisition->status = 1;
					$this->material_requisition->created_at = date('Y-m-d H:i:s');
					$this->material_requisition->created_by =  Auth::User()->id;
					$this->material_requisition->fill($attributes)->save();
				}*/
				
				//invoice items insert
				if($this->material_requisition->id && !empty( array_filter($attributes['item_id']))) {
					
					$line_total = 0; $total_quantity = 0;
					
					foreach($attributes['item_id'] as $key => $value){ 
						$objMaterialReqItem = new MaterialRequisitionItem();
						$arrResult 	= $this->setItemInputValue($attributes, $objMaterialReqItem, $key, $value, $total_quantity);
					
						
					//	if($arrResult['line_total']) {
						    $line_total += $arrResult['line_total'];
							$objMaterialReqItem->status = 1;
								$itemObj =$this->material_requisition->doItem()->save($objMaterialReqItem);
								$zero = DB::table('material_requisition_item')->where('id', $itemObj->id)->where('unit_id',0)->first();
					           if($zero && $zero->item_id != 0){
						         $uid=  DB::table('item_unit')->where('itemmaster_id', $zero->item_id)->first();
						         DB::table('material_requisition_item')->where('id', $itemObj->id)->update(['unit_id' => $uid->unit_id]);
						       }
							
					//	}
					}
					
					// $net_amount = $line_total - $attributes['discount'];
					$net_amount = $line_total;
					DB::table('material_requisition')
								->where('id', $this->material_requisition->id)
								->update(['total'    	  => $line_total,
										  'discount' 	  => $attributes['discount'],
										  'net_amount'	  => $net_amount ]
										 );
										 
					/*if($this->material_requisition->id) {
						 DB::table('voucher_no')
							->where('voucher_type', 'MR')
							->where('department_id', env('DEPARTMENT_ID'))
							->update(['no' => $attributes['voucher_no'] + 1]);
					}*/
					
				}
				
				DB::commit();
				return true;
				
			} catch(\Exception $e) { 
			
				DB::rollback(); echo $e->getLine().'-'.$e->getMessage();exit;
				return false;
			}
		}
		//throw new ValidationException('material_requisition validation error12!', $this->getErrors());
	}
	
	public function update($id, $attributes)
	{
		$this->material_requisition = $this->find($id);
		$line_total = 0;
		if($this->material_requisition->id && !empty( array_filter($attributes['item_id']))) {
			foreach($attributes['item_id'] as $key => $value) { 
				
				if($attributes['order_item_id'][$key]!='') {
					
					$lntotal = (float)$attributes['cost'][$key] * (float)$attributes['quantity'][$key];
					$line_total += $lntotal;
					
					$objMaterialReqItem = MaterialRequisitionItem::find($attributes['order_item_id'][$key]);//print_r($objMaterialReqItem);exit;//$attributes['order_item_id'][$key]);echo $attributes['order_item_id'][$key].'<pre>';
					$exi_quantity = $objMaterialReqItem->quantity;
					$items['item_name'] = $attributes['item_name'][$key];
					$items['item_id'] = $value;
					$items['unit_id'] = $attributes['unit_id'][$key];
					$items['quantity'] = isset($attributes['quantity'][$key])?$attributes['quantity'][$key]:0;
					$items['unit_price'] = isset($attributes['cost'][$key])?$attributes['cost'][$key]:0;
					$items['remarks'] = isset($attributes['remarks'][$key])?$attributes['remarks'][$key]:0;
					$items['total_price'] = $lntotal;
					$objMaterialReqItem->update($items);
						$zero = DB::table('material_requisition_item')->where('id', $attributes['order_item_id'][$key])->where('unit_id',0)->first();
						    if($zero && $zero->item_id != 0){
						     $uid=  DB::table('item_unit')->where('itemmaster_id', $zero->item_id)->first();
						     DB::table('material_requisition_item')->where('id', $attributes['order_item_id'][$key])->update(['unit_id' => $uid->unit_id]);
						     }
										
				} else { //new entry...
					$objMaterialReqItem = new MaterialRequisitionItem();
					$arrResult 		= $this->setItemInputValue($attributes, $objMaterialReqItem, $key, $value);
					//if($arrResult['line_total']) {
						$line_total			     += $arrResult['line_total'];
						$objMaterialReqItem->status = 1;
						$itemObj =$this->material_requisition->doItem()->save($objMaterialReqItem);
							$zero = DB::table('material_requisition_item')->where('id', $itemObj->id)->where('unit_id',0)->first();
					           if($zero && $zero->item_id != 0){
						         $uid=  DB::table('item_unit')->where('itemmaster_id', $zero->item_id)->first();
						         DB::table('material_requisition_item')->where('id', $itemObj->id)->update(['unit_id' => $uid->unit_id]);
						       }
					//}
				}
				
			}
		}
		
		if($this->setInputValue($attributes)) {
			$this->material_requisition->modify_at = date('Y-m-d H:i:s');
			$this->material_requisition->modify_by = Auth::User()->id;
			$this->material_requisition->fill($attributes)->save();
		}
		
		
		//manage removed items...
		if($attributes['remove_item']!='')
		{
			$arrids = explode(',', $attributes['remove_item']);
			$remline_total = $remtax_total = 0;
			foreach($arrids as $row) {
				
				$res = DB::table('material_requisition_item')->where('id',$row)->first();
				DB::table('material_requisition_item')->where('id', $row)->update(['status' => 0,'deleted_at' => date('Y-m-d H:i:s')]);
					
			}
		}
		$this->material_requisition->fill($attributes)->save();
		
		$net_amount = $line_total - (float)$attributes['discount'];
		
		
		//update discount, total amount
		DB::table('material_requisition')
					->where('id', $this->material_requisition->id)
					->update(['total'    	  => $line_total,
							  //'discount' 	  => $attributes['discount'],
							  'net_amount'	  => $net_amount,
							 ]);
									  
		return true;
	}
	
	public function delete($id)
	{
		$this->material_requisition = $this->material_requisition->find($id);
		
		//inventory update...
		$items = DB::table('material_requisition_item')->where('material_requisition_id', $id)->select('item_id','unit_id','quantity')->get();
		
		DB::table('material_requisition_item')->where('material_requisition_id', $id)
								->update(['status' => 0, 'deleted_at' => date('Y-m-d H:i:s')]);
		
		$this->material_requisition->delete();
	}
	

	public function materialReqList2()
	{
		$query = $this->material_requisition->where('material_requisition.status',1);
		return $query->join('jobmaster AS J', function($join) {
							$join->on('J.id','=','material_requisition.job_id');
						} )
					->select('material_requisition.*','J.name AS jobname')
					->orderBY('material_requisition.id', 'DESC')
					->get();
	}
	
	public function activePurchaseInvoiceList()
	{
		return $this->material_requisition->select('id','name')->where('status', 1)->orderBy('name', 'ASC')->get()->toArray();
	}
	
	public function check_reference_no($refno, $id = null) { 
		
		if($id)
			return $this->material_requisition->where('reference_no',$refno)->where('id', '!=', $id)->count();
		else
			return $this->material_requisition->where('reference_no',$refno)->count();
	}
	
	
	public function getPIdata()
	{
		$query = $this->material_requisition->where('material_requisition.status',1);
		
		return $query->join('account_master AS am', function($join) {
							$join->on('am.id','=','material_requisition.job_account_id');
						} )
					->where('material_requisition.is_return',0)
					->select('material_requisition.*','am.master_name AS supplier')
					->orderBY('material_requisition.id', 'ASC')
					->get();
	}
		
	public function getSDOitems($id)
	{
		$query = $this->material_requisition->where('material_requisition.voucher_no',$id);
		
		return $query->join('purchase_invoice_item AS poi', function($join) {
							$join->on('poi.material_requisition_id','=','material_requisition.id');
						} )
					  ->join('units AS u', function($join){
						  $join->on('u.id','=','poi.unit_id');
					  }) 
					  ->select('poi.*','u.unit_name')->get();
		//return $this->itemmaster->where('status', 1)->orderBy('description','ASC')->select('id','item_code','description')->get();
	}
	
	public function getSupplierInvoice($supplier_id)
	{
		return $this->material_requisition->where('status',1)
								   ->where('supplier_id', $supplier_id)
								   ->whereIn('amount_transfer',[0,2])
								   ->orderBY('id', 'ASC')
								   ->get();
	}
	
	
	
	public function findPOdata($id)
	{
		$query = $this->material_requisition->where('material_requisition.id', $id);
		return $query->leftJoin('jobmaster AS J', function($join){
						  $join->on('J.id','=','material_requisition.job_id');
						})
					->leftJoin('salesman AS S', function($join){
						  $join->on('S.id','=','material_requisition.salesman_id');
						})
					->leftJoin('account_master AS AM', function($join){
						  $join->on('AM.id','=','material_requisition.supplier_id');
						})
					->select('material_requisition.*','J.name','S.name AS salesman','AM.master_name AS supplier','J.code')
					->orderBY('material_requisition.id', 'ASC')
					->first();
	}
	
	public function getItems($id)
	{
		$query = $this->material_requisition->where('material_requisition.id',$id);
		
		return $query->join('material_requisition_item AS GI', function($join) {
							$join->on('GI.material_requisition_id','=','material_requisition.id');
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
		$invoice = $this->material_requisition->where('material_requisition.id', $attributes['document_id'])
								   ->join('jobmaster AS J', function($join) {
									   $join->on('J.id','=','material_requisition.job_id');
								   })
								    ->leftJoin('salesman AS S', function($join) {
									   $join->on('S.id','=','material_requisition.salesman_id');
								   })
								   ->select('J.name AS supplier','material_requisition.*','J.code','J.name','S.name AS salesman')
								   ->orderBY('material_requisition.id', 'ASC')
								   ->first();
								   
		$items = $this->material_requisition->where('material_requisition.id', $attributes['document_id'])
								   ->join('material_requisition_item AS GI', function($join) {
									   $join->on('GI.material_requisition_id','=','material_requisition.id');
								   })
								   ->join('itemmaster AS IM', function($join) {
									   $join->on('IM.id','=','GI.item_id');
								   })
								   ->join('units AS U', function($join) {
									   $join->on('U.id','=','GI.unit_id');
								   })
								   ->select('GI.*','material_requisition.id','IM.item_code','U.unit_name')
								   ->get();
								   
		return $result = ['details' => $invoice, 'items' => $items];
	}
			
	public function findQuoteData($id)
	{
		$query = $this->material_requisition->where('material_requisition.id', $id)->where('material_requisition.is_transfer', 0);
		return $query->join('account_master AS am', function($join) {
							$join->on('am.id','=','material_requisition.supplier_id');
						} )
					// ->leftJoin('header_footer AS h',function($join) {
					// 	$join->on('h.id','=','material_requisition.header_id');
					// })
					// ->leftJoin('header_footer AS f',function($join) {
					// 	$join->on('f.id','=','material_requisition.footer_id');
					// })
					->leftJoin('salesman AS S', function($join) {
							$join->on('S.id','=','material_requisition.salesman_id');
						} )
					->select('material_requisition.*','am.master_name AS supplier',
							 'S.name AS salesman')
					->orderBY('material_requisition.id', 'ASC')
					->first();
	}
	
	public function getCEItems($id)
	{
		$query = $this->material_requisition->whereIn('material_requisition.id',$id);
		
		return $query->join('material_requisition_item AS poi', function($join) {
							$join->on('poi.material_requisition_id','=','material_requisition.id');
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
	
	public function getMRdata()
	{
	    
	    //$doc=DB::table('parameter1')->select('doc_approve')->first();
	    //echo '<pre>';print_r($doc);exit;
	    $mod_purchase_enquiry= DB::table('parameter2')->where('keyname', 'mod_purchase_enquiry')->where('status',1)->select('is_active')->first();
	    //echo '<pre>';print_r($mod_purchase_enquiry);exit;
	    //if($doc->doc_approve==0){
	   
		$query = $this->material_requisition->where('material_requisition.status',1)->where('material_requisition.is_transfer',0);
	   
		return $query->select('material_requisition.*')
					->orderBY('material_requisition.id', 'ASC')
					->get();
	}
	
	
	public function findMRdata($id)
	{
		$query = $this->material_requisition
						->leftjoin('account_master','account_master.id','=','material_requisition.supplier_id')
						->leftJoin('jobmaster AS J',function($join) {
							$join->on('J.id','=','material_requisition.job_id');
						})
						->where('material_requisition.id', $id);
		return $query->select('material_requisition.*','account_master.master_name as supplier','J.code')
					->orderBY('material_requisition.id', 'ASC')
					->first();
	}
	
	public function getSupplierEnquiry($supplier_id)
	{
		return $this->material_requisition
								->leftJoin('salesman AS S', function($join) {
									$join->on('S.id','=','material_requisition.salesman_id');
								} )
							 ->where('material_requisition.status', 1)
							 ->where('material_requisition.supplier_id', $supplier_id)
							 ->where('material_requisition.is_transfer', 0)
							 ->select('material_requisition.id','material_requisition.voucher_no','material_requisition.voucher_date',
							'S.name AS salesman','material_requisition.net_amount')
							 ->get();
		
	}



	public function getMRitems($id)
	{
		$query = $this->material_requisition->whereIn('material_requisition.id',$id);
		
		return $query->join('material_requisition_item AS poi', function($join) {
							$join->on('poi.material_requisition_id','=','material_requisition.id');
						} )
					  ->join('units AS u', function($join){
						  $join->on('u.id','=','poi.unit_id');
					  }) 
					  ->join('itemmaster AS im', function($join){
						  $join->on('im.id','=','poi.item_id');
					  })
					   ->join('item_unit AS iu', function($join){
						  $join->on('iu.itemmaster_id','=','im.id');
						  $join->on('iu.unit_id','=','poi.unit_id');
					  })
					  ->where('poi.status',1)
					  ->whereIn('poi.is_transfer',[0,2])
					  ->where('poi.deleted_at', '0000-00-00 00:00:00')
					  ->select('poi.*','u.unit_name','im.item_code','iu.is_baseqty') //AP16
					  ->orderBY('poi.id')
					  ->get();
					  
	}
	
	public function getReport($attributes)
	{
		$date_from = ($attributes['date_from']!='')?date('Y-m-d', strtotime($attributes['date_from'])):'';
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):'';
		
		if($attributes['search_type']=='summary') {
			
			$query = $this->material_requisition
							->join('material_requisition_item AS POI', function($join) {
								$join->on('POI.material_requisition_id','=','material_requisition.id');
							})
							->join('itemmaster AS IM', function($join) {
								$join->on('IM.id','=','POI.item_id');
							})
							->leftjoin('account_master AS AM', function($join) {
								$join->on('AM.id','=','material_requisition.supplier_id');
							})
							->join('jobmaster AS JB', function($join) {
								$join->on('JB.id','=','material_requisition.job_id');
							})
							->leftJoin('salesman AS S', function($join) {
								$join->on('S.id','=','material_requisition.salesman_id');
							})
							->where('material_requisition.department_id',env('DEPARTMENT_ID'))
							->where('POI.status',1);
							
					if( $date_from!='' && $date_to!='' ) { 
						$query->whereBetween('material_requisition.voucher_date', array($date_from, $date_to));
					}
					
					if($attributes['salesman']!='') { 
						$query->where('material_requisition.salesman_id', $attributes['salesman']);
					}
					
					if($attributes['item_id']!='') { 
						$query->where('POI.item_id', $attributes['item_id']);
					}
					
					if(isset($attributes['job_id']))
						$query->whereIn('material_requisition.job_id', $attributes['job_id']);
					
			return $query->select('material_requisition.voucher_no','IM.item_code','IM.description','material_requisition.total',
									  'material_requisition.description','POI.quantity','POI.balance_quantity','POI.unit_price','AM.account_id',
									  'AM.master_name','material_requisition.net_amount','JB.code as jobcode','S.name as salesman','JB.name AS jobname')
							->groupBy('material_requisition.id')->get();
									  
			/* return $query->select('material_requisition.voucher_no','material_requisition.total','S.name AS salesman',
								  'material_requisition.voucher_date','POI.quantity','POI.unit_price','JB.code','JB.name AS jobname',
								  'material_requisition.net_amount')
							->groupBy('material_requisition.id')->get(); */
		}
		elseif($attributes['search_type']=='summary_pending') {
			
			$query = $this->material_requisition
							->join('material_requisition_item AS POI', function($join) {
								$join->on('POI.material_requisition_id','=','material_requisition.id');
							})
							->join('itemmaster AS IM', function($join) {
								$join->on('IM.id','=','POI.item_id');
							})
							->leftjoin('account_master AS AM', function($join) {
								$join->on('AM.id','=','material_requisition.supplier_id');
							})
							->join('jobmaster AS JB', function($join) {
								$join->on('JB.id','=','material_requisition.job_id');
							})
							->leftJoin('salesman AS S', function($join) {
								$join->on('S.id','=','material_requisition.salesman_id');
							})
							->where('material_requisition.department_id',env('DEPARTMENT_ID'))
							->where('POI.is_transfer','!=',1)
							->where('POI.status',1);
							
					if( $date_from!='' && $date_to!='' ) { 
						$query->whereBetween('material_requisition.voucher_date', array($date_from, $date_to));
					}
					
					if($attributes['salesman']!='') { 
						$query->where('material_requisition.salesman_id', $attributes['salesman']);
					}
					
					if($attributes['item_id']!='') { 
						$query->where('POI.item_id', $attributes['item_id']);
					}
					
					if(isset($attributes['job_id']))
						$query->whereIn('material_requisition.job_id', $attributes['job_id']);
					
			return $query->select('material_requisition.voucher_no','material_requisition.total','S.name AS salesman',
								  'material_requisition.voucher_date','POI.quantity','POI.unit_price','JB.code as jobcode','JB.name AS jobname',
								  'material_requisition.net_amount','material_requisition.is_transfer','AM.master_name','POI.balance_quantity')
							->get();
		}
		elseif($attributes['search_type']=='detail') {
			
			$query = $this->material_requisition
							->join('material_requisition_item AS POI', function($join) {
								$join->on('POI.material_requisition_id','=','material_requisition.id');
							})
							->join('jobmaster AS JB', function($join) {
								$join->on('JB.id','=','material_requisition.job_id');
							})
							->leftjoin('account_master AS AM', function($join) {
								$join->on('AM.id','=','material_requisition.supplier_id');
							})
							->join('itemmaster AS IM', function($join) {
									$join->on('IM.id','=','POI.item_id');
							})
							->leftJoin('salesman AS S', function($join) {
								$join->on('S.id','=','material_requisition.salesman_id');
							})
							->where('material_requisition.department_id',env('DEPARTMENT_ID'))
							->where('POI.status',1);
							
					if( $date_from!='' && $date_to!='' ) { 
						$query->whereBetween('material_requisition.voucher_date', array($date_from, $date_to));
					}
					
					if($attributes['salesman']!='') { 
						$query->where('material_requisition.salesman_id', $attributes['salesman']);
					}
					
					if($attributes['item_id']!='') { 
						$query->where('POI.item_id', $attributes['item_id']);
					}
					
					if(isset($attributes['job_id']))
						$query->whereIn('material_requisition.job_id', $attributes['job_id']);
					
			return $query->select('material_requisition.voucher_no','IM.item_code','IM.description','material_requisition.total','S.name AS salesman','AM.master_name',
								  'material_requisition.voucher_date','POI.quantity','POI.unit_price','JB.code as jobcode','JB.name AS jobname',
								  'material_requisition.net_amount','POI.item_name','POI.total_price','POI.balance_quantity')
								  ->get(); //>groupBy('material_requisition.id')->
		}
		elseif(($attributes['search_type']=='detail_pending')||($attributes['search_type']=='qty_report')) {
			
			$query = $this->material_requisition
							->join('material_requisition_item AS POI', function($join) {
								$join->on('POI.material_requisition_id','=','material_requisition.id');
							})
							->join('jobmaster AS JB', function($join) {
								$join->on('JB.id','=','material_requisition.job_id');
							})
							->leftjoin('account_master AS AM', function($join) {
								$join->on('AM.id','=','material_requisition.supplier_id');
							})
							->join('itemmaster AS IM', function($join) {
									$join->on('IM.id','=','POI.item_id');
							})
							->leftJoin('salesman AS S', function($join) {
								$join->on('S.id','=','material_requisition.salesman_id');
							})
							->where('material_requisition.department_id',env('DEPARTMENT_ID'))
							->where('POI.is_transfer','!=',1)
							->where('POI.status',1);
							
					if( $date_from!='' && $date_to!='' ) { 
						$query->whereBetween('material_requisition.voucher_date', array($date_from, $date_to));
					}
					
					if($attributes['salesman']!='') { 
						$query->where('material_requisition.salesman_id', $attributes['salesman']);
					}
					
					if($attributes['item_id']!='') { 
						$query->where('POI.item_id', $attributes['item_id']);
					}
					
					if(isset($attributes['job_id']))
						$query->whereIn('material_requisition.job_id', $attributes['job_id']);
					
			return $query->select('material_requisition.voucher_no','material_requisition.total','S.name AS salesman','AM.master_name','IM.description',
								  'material_requisition.voucher_date','POI.quantity','POI.unit_price','JB.code as jobcode','JB.name AS jobname',
								  'material_requisition.net_amount','POI.item_name','POI.total_price','IM.item_code','POI.balance_quantity')
							      ->get();  //->groupBy('material_requisition.id')
		}
	}
	
	
	public function materialReqListCount()
	{
		$query = $this->material_requisition->where('material_requisition.status',1);
		return $query->join('jobmaster AS J', function($join) {
							$join->on('J.id','=','material_requisition.job_id');
						} )
					->count();
	}
	
	public function materialReqList($type,$start,$limit,$order,$dir,$search)
	{
		$query = $this->material_requisition->where('material_requisition.status',1)->where('material_requisition.department_id',env('DEPARTMENT_ID'));
		$query->leftjoin('jobmaster AS J', function($join) {
							$join->on('J.id','=','material_requisition.job_id');
						} )
						->leftjoin('account_master AS am', function($join) {
							$join->on('am.id','=','material_requisition.supplier_id');
						} )
						->join('location AS LF', function($join) {
							$join->on('LF.id','=','material_requisition.locfrom_id');
						} )
						->join('location AS LT', function($join) {
							$join->on('LT.id','=','material_requisition.location_id');
						} )
						->leftjoin('users AS AU', function($join) {
							$join->on('AU.id','=','material_requisition.approved_by');
						} );
						
		if($search) {
				
			$query->where(function($qry) use($search) {
				$qry->where('material_requisition.voucher_no','LIKE',"%{$search}%")
				->orWhere('am.master_name', 'LIKE',"%{$search}%")
				->orWhere('LF.name', 'LIKE',"%{$search}%")
				  ->orWhere('LT.name', 'LIKE',"%{$search}%")
					->orWhere('J.name', 'LIKE',"%{$search}%");
			});
		}
			
		$query->select('material_requisition.*','J.name AS jobname','am.master_name AS supplier','J.code','AU.name AS approved_user','LF.name AS location_from','LT.name AS location_to')
					->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir);
					
		if($type=='get')
			return $query->get();
		else
			return $query->count();
	}
	
}