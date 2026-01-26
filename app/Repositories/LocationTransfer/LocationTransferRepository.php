<?php namespace App\Repositories\LocationTransfer;

use App\Models\LocationTransfer;
use App\Models\LocationTransferItem;
use App\Models\LocationTransferInfo;
use App\Repositories\AbstractValidator;
use App\Exceptions\Validation\ValidationException;
use App\Models\AccountTransaction;
use App\Repositories\UpdateUtility;
use Config;
use DB;


class LocationTransferRepository extends AbstractValidator implements LocationTransferInterface {
	
	protected $location_transfer;
	public $objUtility;
	protected static $rules = [];
	
	public function __construct(LocationTransfer $location_transfer) {
		$this->location_transfer = $location_transfer;
		$this->objUtility = new UpdateUtility();
	}
	
	public function all()
	{
		return $this->location_transfer->get();
	}
	
	public function find($id)
	{
		return $this->location_transfer->where('id', $id)->first();
	}
	
	//set input fields values
	private function setInputValue($attributes)
	{
		$this->location_transfer->voucher_no = $attributes['voucher_no'];
		$this->location_transfer->prefix = isset($attributes['prefix'])?$attributes['prefix']:'';
		$this->location_transfer->reference_no = isset($attributes['reference_no'])?$attributes['reference_no']:'';
		$this->location_transfer->description = isset($attributes['description'])?$attributes['description']:'';
		$this->location_transfer->department_id = env('DEPARTMENT_ID');
		$this->location_transfer->locfrom_id = isset($attributes['locfrom_id'])?$attributes['locfrom_id']:'';
		$this->location_transfer->locto_id = isset($attributes['locto_id'])?$attributes['locto_id']:'';
		$this->location_transfer->voucher_date = ($attributes['voucher_date']=='')?date('Y-m-d'):date('Y-m-d', strtotime($attributes['voucher_date']));
		
		return true;
	}
	
	private function setItemInputValue($attributes, $locationTransferItem, $key, $value) 
	{
			
		$locationTransferItem->location_transfer_id = $this->location_transfer->id;
		$locationTransferItem->item_id = $attributes['item_id'][$key];
		$locationTransferItem->unit_id = $attributes['unit_id'][$key];
		$locationTransferItem->item_name = $attributes['item_name'][$key];
		$locationTransferItem->quantity = (float)$attributes['quantity'][$key];
		
		return array('line_total' => (float)$attributes['quantity'][$key]);
		
	}
	
	public function create($attributes)
	{
		if($this->isValid($attributes)) {
			
		  DB::beginTransaction();
		  try {

               //VOUCHER NO LOGIC.....................
				$dept = env('DEPARTMENT_ID');

				 // ⿢ Get the highest numeric part from voucher_master
				$qry = DB::table('location_transfer')->where('deleted_at', '0000-00-00 00:00:00')->where('status', 1)->where('department_id', env('DEPARTMENT_ID'));
				

				$maxNumeric = $qry->select(DB::raw("MAX(CAST(REGEXP_REPLACE(voucher_no, '[^0-9]', '') AS UNSIGNED)) AS max_no"))->value('max_no');
				
				$attributes['voucher_no'] = $this->objUtility->generateVoucherNoDoc('LT', $maxNumeric, $dept, $attributes['voucher_no'],$attributes['prefix']);
				//VOUCHER NO LOGIC.....................
				
				//exit;
				$maxRetries = 5; // prevent infinite loop
				$retryCount = 0;
				$saved = false;

				while (!$saved && $retryCount < $maxRetries) {
				try {
						if($this->setInputValue($attributes)) {
					$this->location_transfer->status = 1;
					$this->location_transfer->created_at = date('Y-m-d H:i:s');
					$this->location_transfer->created_by = 1;
					$this->location_transfer->fill($attributes)->save();
				
							$saved = true;
						}
					} catch (\Illuminate\Database\QueryException $ex) {

						// Check if it's a duplicate voucher number error
						if (strpos($ex->getMessage(), 'Duplicate entry') !== false || strpos($ex->getMessage(), 'duplicate key value') !== false) {

							$dept = env('DEPARTMENT_ID');

							// ⿢ Get the highest numeric part from voucher_master
							$qry = DB::table('location_transfer')->where('deleted_at', '0000-00-00 00:00:00')->where('status', 1)->where('department_id', env('DEPARTMENT_ID'));
							

							$maxNumeric = $qry->select(DB::raw("MAX(CAST(REGEXP_REPLACE(voucher_no, '[^0-9]', '') AS UNSIGNED)) AS max_no"))->value('max_no');
							
							$attributes['voucher_no'] = $this->objUtility->generateVoucherNoDoc('LT', $maxNumeric, $dept, $attributes['voucher_no'],$attributes['prefix']);

							$retryCount++;
						} else {
							throw $ex; // rethrow if different DB error
						}
					}
				}


				
				
				//order items insert
				if($this->location_transfer->id && !empty( array_filter($attributes['item_id']))) {
					$line_total = 0;
					
					foreach($attributes['item_id'] as $key => $value) { 
						$locationTransferItem = new LocationTransferItem();
						$arrResult 		= $this->setItemInputValue($attributes, $locationTransferItem, $key, $value);
						if($arrResult['line_total']) {
							$line_total	+= (float)$arrResult['line_total'];
							
							$locationTransferItem->status = 1;
							$this->location_transfer->transferItem()->save($locationTransferItem);
							
							if($this->stockUpdate($attributes,$key,'from'))
								$this->stockUpdate($attributes,$key,'to');
							
						}
					}
				
					//update discount, total amount
					DB::table('location_transfer')
								->where('id', $this->location_transfer->id)
								->update(['total' => $line_total]); 
								
				}
				
											
				
				
				DB::commit();
				return true;
				
		  } catch(\Exception $e) {
				
				DB::rollback();
				return false;
		  }
		  
		}
		
	}


	public function stockUpdate($attributes, $key, $type)
{
    $itemId     = $attributes['item_id'][$key];
    $unitId     = $attributes['unit_id'][$key];
    $quantity   = (float)$attributes['quantity'][$key];

    $fromLoc    = $attributes['locfrom_id'];
    $toLoc      = $attributes['locto_id'];

    if ($type == 'from') {

        // Get existing stock
        $row = DB::table('item_location')
                ->where('item_id', $itemId)
                ->where('unit_id', $unitId)
                ->where('location_id', $fromLoc)
                ->first();

        // If row does not exist → CANNOT transfer
        if (!$row) {
            throw new \Exception("Item not available in this location.");
        }

        // Prevent negative stock
        if ($row->quantity < $quantity) {
            throw new \Exception("Insufficient stock at location.");
        }

        // Reduce stock
        DB::table('item_location')
            ->where('item_id', $itemId)
            ->where('unit_id', $unitId)
            ->where('location_id', $fromLoc)
            ->update([
                'quantity' => DB::raw("quantity - $quantity")
            ]);

    } else {

        // Check if the row exists
        $row = DB::table('item_location')
            ->where('item_id', $itemId)
            ->where('unit_id', $unitId)
            ->where('location_id', $toLoc)
            ->first();

        if ($row) {
            // Add stock
            DB::table('item_location')
                ->where('item_id', $itemId)
                ->where('unit_id', $unitId)
                ->where('location_id', $toLoc)
                ->update([
                    'quantity' => DB::raw("quantity + $quantity")
                ]);
        } else {
            // INSERT new row
            DB::table('item_location')->insert([
                'item_id'       => $itemId,
                'unit_id'       => $unitId,
                'location_id'   => $toLoc,
                'quantity'      => $quantity,
                'status'        => 1,
                
            ]);
        }
    }

    return true;
}

	
	/*public function stockUpdate($attributes,$key,$type)
	{
		if($type=='from') {
		
			DB::table('item_location')->where('item_id', $attributes['item_id'][$key])
									  ->where('unit_id', $attributes['unit_id'][$key])
									  ->where('location_id', $attributes['locfrom_id'])
									  ->update(['quantity' => DB::raw('quantity - '.$attributes['quantity'][$key])]);
			
								  				  
		} else {
			
			DB::table('item_location')->where('item_id', $attributes['item_id'][$key])
									  ->where('unit_id', $attributes['unit_id'][$key])
									  ->where('location_id', $attributes['locto_id'])
									  ->update(['quantity' => DB::raw('quantity + '.$attributes['quantity'][$key])]);
	        
		}
		
		return true;
	}*/
	
	public function update($id, $attributes)
	{
		 //echo '<pre>';print_r($attributes);exit;
		$this->location_transfer = $this->find($id);
		$line_total = 0;
		
		DB::beginTransaction();
		try {
			
          if($this->location_transfer->id && !empty( array_filter($attributes['item_id']))) { 
				//echo '<pre>';print_r($this->location_transfer->id);exit;
				$line_total_new = 0;
				 
				$oldRows = DB::table('location_transfer_item')->where('location_transfer_id', $id) 
						                 ->join('location_transfer AS LT', function($join) {
									   $join->on('LT.id','=','location_transfer_item.location_transfer_id');
								   })
								   ->select('location_transfer_item.item_id','location_transfer_item.unit_id','location_transfer_item.quantity','LT.locfrom_id','LT.locto_id')
								   ->get();
								   
		 //echo '<pre>';print_r($oldRows);exit;
                          
                    // 2️⃣ Reverse old stock movement
                       foreach ($oldRows as $old) {
    
                          // Reverse FROM stock (add back)
                         DB::table('item_location')->where('item_id', $old->item_id)->where('unit_id', $old->unit_id)
                                                  ->where('location_id', $old->locfrom_id)
                                                  ->update([ 'quantity' => DB::raw("quantity + $old->quantity") ]);

                             // Reverse TO stock (subtract)
                         DB::table('item_location') ->where('item_id', $old->item_id)->where('unit_id', $old->unit_id)
                                                   ->where('location_id', $old->locto_id)
                                                  ->update(['quantity' => DB::raw("quantity - $old->quantity") ]);
                 }
 	             foreach($attributes['item_id'] as $key => $value) { 
					
					if($attributes['transfer_item_id'][$key]!='') { 
						
						$locationTransferItem = LocationTransferItem::find($attributes['transfer_item_id'][$key]);
						$items['item_name'] = $attributes['item_name'][$key];
						$items['item_id'] = $value;
						$items['unit_id'] = $attributes['unit_id'][$key];
						$items['quantity'] = $attributes['quantity'][$key];
						$locationTransferItem->update($items);
						$line_total	+=(float) $attributes['quantity'][$key];
						if($this->stockUpdate($attributes,$key,'from'))
								$this->stockUpdate($attributes,$key,'to');
						 /*if($type=='from') {
							
							if($locationTransferItem->quantity < $attributes['quantity'][$key])
								$qty_diff = $attributes['quantity'][$key] - $locationTransferItem->quantity;
							else 
								$qty_diff = $locationTransferItem->quantity - $attributes['quantity'][$key];
							
							DB::table('item_location')->where('item_id', $attributes['item_id'][$key])
													  ->where('unit_id', $attributes['unit_id'][$key])
													  ->where('location_id', $attributes['locfrom_id'])
													  ->update(['quantity' => DB::raw('quantity - '.$attributes['quantity'][$key])]);
						} else {
							
							DB::table('item_location')->where('item_id', $attributes['item_id'][$key])
													  ->where('unit_id', $attributes['unit_id'][$key])
													  ->where('location_id', $attributes['locto_id'])
													  ->update(['quantity' => DB::raw('quantity + '.$attributes['quantity'][$key])]);
						} */
						
					} else { //new entry...
					
						$locationTransferItem = new LocationTransferItem();
						$arrResult 		= $this->setItemInputValue($attributes, $locationTransferItem, $key, $value);
						if($arrResult['line_total']) {
							$line_total_new	+= $arrResult['line_total'];
							$line_total	+= $arrResult['line_total'];
							$locationTransferItem->status = 1;
							$this->location_transfer->transferItem()->save($locationTransferItem);
							if($this->stockUpdate($attributes,$key,'from'))
								$this->stockUpdate($attributes,$key,'to');
						}
						
						
					}
					
				}
			}
			
			//manage removed items...
			if($attributes['remove_item']!='')
			{
				$arrids = explode(',', $attributes['remove_item']);
				$remline_total = $remtax_total = 0;
				foreach($arrids as $row) {
					DB::table('location_transfer_item')->where('id', $row)->update(['status' => 0]);
				}
			}
			
			$this->location_transfer->fill($attributes)->save();
			
			//$total = $line_total + $line_total_new;
			
			//update discount, total amount
			DB::table('location_transfer')
						->where('id', $id)
						->update(['total' => $line_total ]); //CHG
			
			DB::commit();
			return true;
			
		 } catch(\Exception $e) {
			
			DB::rollback();
			return false;
		}
	}
	
	public function delete($id)
	{
		$this->location_transfer = $this->location_transfer->find($id);//echo '<pre>';print_r($this->location_transfer);exit;
		
		$items = DB::table('location_transfer_item')->where('location_transfer_id',$id)->get();
		
		foreach($items as $row) {
			DB::table('item_location')->where('item_id', $this->location_transfer->item_id)
										  ->where('unit_id', $row->unit_id)
										  ->where('location_id', $this->location_transfer->locfrom_id)
										  ->update(['quantity' => DB::raw('quantity + '.$row->quantity)]);
													  
										  
			DB::table('item_location')->where('item_id', $this->location_transfer->item_id)
										  ->where('unit_id', $row->unit_id)
										  ->where('location_id', $this->location_transfer->locto_id)
										  ->update(['quantity' => DB::raw('quantity - '.$row->quantity)]);
										  
		}
		
		DB::table('location_transfer_item')->where('location_transfer_id',$id)->update(['status' => 0, 'deleted_at' => date('Y-m-d H:i:s')]);					  
		$this->location_transfer->delete($id);
	}
	
	public function check_order($id)
	{
		$count = DB::table('location_transfer')->where('id', $id)->where('is_editable',1)->count();
		if($count > 0)
			return false;
		else
			return true;
	}
	
	public function locationTransList()
	{
		return $this->location_transfer->where('location_transfer.status',1)
					->join('location AS LF', function($join) {
							$join->on('LF.id','=','location_transfer.locfrom_id');
						} )
					->join('location AS LT', function($join) {
							$join->on('LT.id','=','location_transfer.locto_id');
						} )
					->where('location_transfer.department_id',env('DEPARTMENT_ID'))
					->select('LF.name AS locfrom','LT.name AS locto','location_transfer.*')
					->orderBY('location_transfer.id', 'DESC')->get();
		
	}
	
	
	public function findRow($id)
	{
		return $this->location_transfer->where('location_transfer.id', $id)
					->join('location AS LF', function($join) {
							$join->on('LF.id','=','location_transfer.locfrom_id');
						} )
					->join('location AS LT', function($join) {
							$join->on('LT.id','=','location_transfer.locto_id');
						} )
					->select('LF.name AS locfrom','LT.name AS locto','location_transfer.*')
					->first();
	}
	
	public function activeLocationTransferList()
	{
		return $this->location_transfer->select('id','name')->where('status', 1)->orderBy('name', 'ASC')->get()->toArray();
	}
	
	public function check_reference_no($refno, $id = null) { 
		
		if($id)
			return $this->location_transfer->where('reference_no',$refno)->where('id', '!=', $id)->count();
		else
			return $this->location_transfer->where('reference_no',$refno)->count();
	}
		
	
	public function getItems($id)
	{
		
		$query = $this->location_transfer->where('location_transfer.id',$id);
		
		return $query->join('location_transfer_item AS poi', function($join) {
							$join->on('poi.location_transfer_id','=','location_transfer.id');
						} )
					  ->join('units AS u', function($join){
						  $join->on('u.id','=','poi.unit_id');
					  }) 
					  ->join('itemmaster AS im', function($join){
						  $join->on('im.id','=','poi.item_id');
					  })
					  ->where('poi.status',1)
					  ->select('poi.*','u.unit_name','im.item_code')->get();
	}
	
	public function getDoc($attributes)
	{
		$invoice = $this->location_transfer->where('location_transfer.id', $attributes['document_id'])
								   ->join('location AS CR', function($join) {
									   $join->on('CR.id','=','location_transfer.locfrom_id');
								   })
								   ->join('location AS DR', function($join) {
									   $join->on('DR.id','=','location_transfer.locto_id');
								   })
								   ->select('CR.name AS cr_account','DR.name AS dr_account','location_transfer.*')
								   ->orderBY('location_transfer.id', 'ASC')
								   ->first();
								   
		$items = $this->location_transfer->where('location_transfer.id', $attributes['document_id'])
								   ->join('location_transfer_item AS STI', function($join) {
									   $join->on('STI.location_transfer_id','=','location_transfer.id');
								   })
								   ->join('itemmaster AS IM', function($join) {
									   $join->on('IM.id','=','STI.item_id');
								   })
								   ->join('units AS U', function($join) {
									   $join->on('U.id','=','STI.unit_id');
								   })
								   ->where('STI.status', 1)
								   ->where('STI.deleted_at', '0000-00-00 00:00:00')
								   ->select('STI.*','IM.item_code','U.unit_name')//'sales_invoice.id',
								   ->get();
								   
		return $result = ['details' => $invoice, 'items' => $items];
	}
	
}
