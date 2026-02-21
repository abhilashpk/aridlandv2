<?php namespace App\Repositories\Itemmaster;

use App\Models\Itemmaster;
use App\Models\ItemUnit;
use App\Models\ItemLocation;
use App\Repositories\AbstractValidator;
use App\Exceptions\Validation\ValidationException;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Log;

use Image;
use Config;
use DB;
use Cache;
use Session;
use Auth;


class ItemmasterRepository extends AbstractValidator implements ItemmasterInterface {
	
	protected $itemmaster;
	
	protected static $rules = [
		'item_code' => 'required',
	];
	
	public function __construct(Itemmaster $itemmaster) {
		$this->itemmaster = $itemmaster;
		$config = Config::get('siteconfig');
		$this->width = $config['modules']['item']['image_size']['width'];
        $this->height = $config['modules']['item']['image_size']['height'];
        $this->thumbWidth = $config['modules']['item']['thumb_size']['width'];
        $this->thumbHeight = $config['modules']['item']['thumb_size']['height'];
        $this->imgDir = $config['modules']['item']['image_dir'];
		$this->api_url = $config['modules']['api_url'];
		
	}
	
	public function all()
	{
		return $this->itemmaster->get();
	}
	
	public function find($id)
	{
		return $this->itemmaster->where('id', $id)->first();
	}
	
	public function testimg() {
		//$destinationPath = public_path() . $this->imgDir.'/'.$image;
		$imgurl = 'https://urban-vision.crm.elateapps.com/assets/uploads/products/Screen_Shot_2022-12-19_at_5_18_04_PM.png';
		if($imgurl!='') {
			$ar1 = explode('products/',$imgurl);
			if(isset($ar1[1])) {
				$ex = explode('.',$ar1[1]);
				
				$destinationPath = public_path() . $this->imgDir.'/';
		
				$content = file_get_contents($imgurl);
				//Store in the filesystem.
				$fp = fopen($destinationPath."/".time().'.'.$ex[1], "w");
				fwrite($fp, $content);
				fclose($fp);
			}
			exit;
		}
		
	}
	
	// public function create($attributes)
	// {	
		
	// 	if($attributes['dimension']==1) {

	// 		$attributes['unit'] = $attributes['unit_d'];
	// 		$attributes['packing'] = $attributes['packing_d'];	
	// 		$attributes['opn_quantity'] = $attributes['opn_quantity_d'];	
	// 		$attributes['opn_cost'] = $attributes['opn_cost_d'];
	// 		//$attributes['vat'] = $attributes['vat_d'];

	// 		$attributes['vat'] = $attributes['selvat'];
	// 	}

	// 	//echo '<pre>';print_r($attributes);exit;
	// 	if($this->isValid($attributes)) { 
			
	// 		$image = '';
	// 		$file = (isset($attributes['image'])) ? $attributes['image'] : null;
	// 		//---------------image uploading section-----------------
	// 		if($file) {
	// 			$image = time().'.'.$file->getClientOriginalExtension();
	// 			//
	// 			$destinationPath = public_path() . $this->imgDir.'/'.$image;
	// 			$destinationPathThumb = public_path() . $this->imgDir.'/thumb_'.$image;

	// 			// resizing an uploaded file
	// 			Image::make($file->getRealPath())->resize($this->width, $this->height, function($constraint) { $constraint->aspectRatio(); })->save($destinationPath);

	// 			// thumb
	// 			Image::make($file->getRealPath())->resize($this->thumbWidth, $this->thumbHeight, function($constraint) { $constraint->aspectRatio(); })->save($destinationPathThumb);
	// 		}
			
	// 		$this->itemmaster->item_code = $attributes['item_code'];
	// 		$this->itemmaster->description = $attributes['description'];
	// 		$this->itemmaster->description_ar =(isset($attributes['descriptionar']))?$attributes['descriptionar']:'';
	// 		$this->itemmaster->class_id = $attributes['item_class'];
	// 		$this->itemmaster->model_no = $attributes['model_no'];
	// 		$this->itemmaster->serial_no = $attributes['serial_no'];
	// 		$this->itemmaster->group_id = $attributes['group_id'] ?? 0;
	// 		$this->itemmaster->subgroup_id = $attributes['subgroup_id'] ?? 0;
	// 		$this->itemmaster->category_id = $attributes['category_id'] ?? 0;
	// 		$this->itemmaster->subcategory_id = $attributes['subcategory_id'] ?? 0;
	// 		$this->itemmaster->assembly = $attributes['assembly'] ?? 0;
	// 		$this->itemmaster->image = $image;
	// 		$this->itemmaster->status = 1;
	// 		$this->itemmaster->created_department = auth()->user()->department_id;
	// 		$this->itemmaster->profit_per = $attributes['profit_per'] ?? 0;
	// 		$this->itemmaster->bin = $attributes['machine_model'] ?? '';
	// 		$this->itemmaster->weight = $attributes['size'] ?? 0;
	// 		$this->itemmaster->other_info = $attributes['other_info'] ?? '';
	// 		$this->itemmaster->created_at = date('Y-m-d H:i:s');
	// 		$this->itemmaster->created_by = Auth::User()->id;
	// 		$this->itemmaster->supersede_items = (isset($attributes['supersede']))?implode(',', $attributes['supersede']):'';
	// 		$this->itemmaster->surface_cost = (isset($attributes['surface_cost']))?$attributes['surface_cost']:'';
	// 		$this->itemmaster->other_cost = (isset($attributes['other_cost']))?$attributes['other_cost']:'';
	// 		$this->itemmaster->bin_location = (isset($attributes['bin_location']))?$attributes['bin_location']:'';//SP7

	// 		$this->itemmaster->itmHt = (isset($attributes['itmHt']))?$attributes['itmHt']:'';//SP7
	// 		$this->itemmaster->itmWd = (isset($attributes['itmWd']))?$attributes['itmWd']:'';//SP7
	// 		$this->itemmaster->itmLt = (isset($attributes['itmLt']))?$attributes['itmLt']:'';//SP7

	// 		$this->itemmaster->mpqty = (isset($attributes['mpqty']))?$attributes['mpqty']:'';
    //         $this->itemmaster->p1_qty = (isset($attributes['opn_quantity'][1]))?$attributes['opn_quantity'][1]:'';
    //         $this->itemmaster->p2_qty = (isset($attributes['opn_quantity'][2]))?$attributes['opn_quantity'][2]:'';  
	// 		$this->itemmaster->dimension = (isset($attributes['dimension']))?$attributes['dimension']:'';
	// 		$this->itemmaster->batch_req = (isset($attributes['batch_req']))?$attributes['batch_req']:'';
			
	// 		$this->itemmaster->p1_formula = (isset($attributes['packing'][1]) && isset($attributes['pkno'][1]))?(($attributes['packing'][1]>$attributes['pkno'][1])?$attributes['packing'][1].',/':$attributes['pkno'][1].',*'):'';
    //         $this->itemmaster->p2_formula = (isset($attributes['packing'][2]) && isset($attributes['pkno'][2]))?(($attributes['packing'][2]>$attributes['pkno'][2])?$attributes['packing'][2].',/':$attributes['pkno'][2].',*'):'';
	// 		//$this->itemmaster->fill($attributes)->save();
	// 		$this->itemmaster->save();
			
	// 		if($this->itemmaster->id) {
	// 			$c = 1;
				
	// 			foreach($attributes['unit'] as $key => $val){
	// 				$itemunit = new ItemUnit();
	// 				if($attributes['unit'][$key]!="" || $c==1) {
	// 				     $unitdat = DB::table('units')->where('id',$attributes['unit'][$key])->first();
	// 				    if($attributes['unit'][$key]=='') {
	// 				        $unitdat = DB::table('units')->where('deleted_at')->first();
	// 				        //echo $unitdat->unit_name;exit;
	// 				    }
					    
	// 					$itemunit->itemmaster_id = $this->itemmaster->id;
	// 					$itemunit->unit_id = ($attributes['unit'][$key]=='')?$unitdat->id:$attributes['unit'][$key];//$attributes['unit'][$key];
	// 					$itemunit->packing = ($attributes['packing'][$key]=='')?$unitdat->unit_name:$attributes['packing'][$key];
	// 					$itemunit->opn_quantity = $attributes['opn_quantity'][$key] ?? 0;
	// 					$itemunit->opn_cost = $attributes['opn_cost'][$key] ?? 0;
	// 					$itemunit->sell_price = isset($attributes['sell_price'][$key])?$attributes['sell_price'][$key]:''; //($c==1)?(float)$attributes['sell_price'][$key]:((float)$attributes['sell_price'][$key] * (float)$attributes['packing'][$key]);
	// 					$itemunit->wsale_price = $attributes['wsale_price'][$key] ?? 0;
	// 					$itemunit->min_quantity = $attributes['min_quantity'][$key] ?? 0;
	// 					$itemunit->reorder_level = $attributes['reorder_level'][$key] ?? 0; //selvat
	// 					$itemunit->vat = $attributes['selvat'][0] ?? 0;
	// 					$itemunit->status = 1;
	// 					$itemunit->cur_quantity = $attributes['opn_quantity'][$key] ?? 0;
	// 					$itemunit->is_baseqty = ($c==1)?$is_baseqty=1:$is_baseqty=0;
	// 					$itemunit->received_qty = $attributes['opn_quantity'][$key] ?? 0;
	// 					$itemunit->last_purchase_cost = $attributes['opn_cost'][$key] ?? 0;
	// 					$itemunit->pur_count = 1;
	// 					$itemunit->cost_avg = $attributes['opn_cost'][$key] ?? 0;
	// 					$itemunit->pkno = ($attributes['packing'][$key]=='')?1:$attributes['pkno'][$key];
	// 					$this->itemmaster->itemUnits()->save($itemunit);
	// 					if($c==1) {
														
	// 						//-----------ITEM LOG----------------		
	// 						$dtrow = DB::table('parameter1')->select('from_date')->first();
	// 						$log_id = DB::table('item_log')->insertGetId([
	// 										 'document_type' => 'OQ',
	// 										 'department_id'=>auth()->user()->department_id,
	// 										 'item_id' 	  => $this->itemmaster->id,
	// 										 'unit_id'    => ($attributes['unit'][$key]=='')?$unitdat->id:$attributes['unit'][$key],
	// 										 'quantity'   => $attributes['opn_quantity'][$key] ?? 0,
	// 										 'unit_cost'  => $attributes['opn_cost'][$key] ?? 0,
	// 										 'trtype'	  => 1,
	// 										 'cur_quantity' => $attributes['opn_quantity'][$key] ?? 0,
	// 										 'cost_avg' => $attributes['opn_cost'][$key] ?? 0,
	// 										 'pur_cost' => $attributes['opn_cost'][$key] ?? 0,
	// 										 'sale_cost' => '',
	// 										 'packing' => 1,
	// 										 'status'     => 1,
	// 										 'created_at' => date('Y-m-d H:i:s'),
	// 										 'created_by' => Auth::User()->id,
	// 										 'voucher_date' => $dtrow->from_date
	// 										 //'voucher_date' => date('Y-m-d', strtotime('-1 day', strtotime($dtrow->from_date)))
	// 										]);
	// 						//-------------ITEM LOG------------------
						    
						    
	// 					    //---------------DEPARTMENT STOCK--------
							
	// 						$departmentId = auth()->user()->department_id;
	// 						if($attributes['unit'][0]!="") {
    // 					        $unitdat = DB::table('units')->where('id',$attributes['unit'][0])->first();
    // 						}
    						
    // 					    if($attributes['unit'][0]=='') {
    // 					        $unitdat = DB::table('units')->where('deleted_at')->first();
    // 					        //echo $unitdat->unit_name;exit;
    // 					    }
	// 					    $unit=($attributes['unit'][0]=='')?$unitdat->id:$attributes['unit'][0];
	// 						$packing= ($attributes['packing'][0]=='')?$unitdat->unit_name:$attributes['packing'][0];
    //                         $openingQty   = isset($attributes['opn_quantity'][0]) ? (float)$attributes['opn_quantity'][0] : 0;
    //                         $openingCost  = isset($attributes['opn_cost'][0]) ? (float)$attributes['opn_cost'][0] : 0;
    //                         $sellPrice    = isset($attributes['sell_price'][0])?$attributes['sell_price'][0]:0;
	// 						$wsalePrice   = isset($attributes['wsale_price'][0])?$attributes['wsale_price'][0]:0;
	// 						$minqty       =  isset($attributes['min_quantity'][0])?$attributes['min_quantity'][0]:0;
	// 						$reorder      =  isset($attributes['reorder_level'][0])?$attributes['reorder_level'][0]:''; 
	// 						$vat          =isset($attributes['selvat'][0])?$attributes['selvat'][0]:0;
	// 						$pkno = ($attributes['packing'][0]=='')?1:$attributes['pkno'][0];
							
    //                         $departments = DB::table('department')->where('deleted_at')->get();

    //                                   foreach ($departments as $dept) {
    //                                            $isCurrent = ($dept->id == $departmentId);

    //                                          DB::table('itemstock_department')->insert([
    //                                                     'itemmaster_id'      => $this->itemmaster->id,
    //                                                      'department_id'      => $dept->id,
	// 													 'unit_id'         =>$unit,
	// 													 'packing'         =>$packing,
    //                                                       'opn_cost'       => $isCurrent ? $openingCost : 0,
    //                                                       'opn_quantity'        => $isCurrent ? $openingQty : 0,
    //                                                         'cur_quantity'            => $isCurrent ? $openingQty : 0,
    //                                                         'received_qty'       => $isCurrent ? $openingQty : 0,
    //                                                          'issued_qty'         => 0,
	// 														 'min_quantity'        =>$isCurrent ? $minqty :0,
	// 														 'reorder_level'       =>$isCurrent ? $reorder :0,
	// 														 'vat'                =>$isCurrent ? $vat :$vat,
	// 														 'is_baseqty'         =>1,
	// 														 'pur_count'          => 1,
    //                                                          'last_purchase_cost' => $isCurrent ? $openingCost : 0,
    //                                                          'cost_avg'           => $isCurrent ? $openingCost : 0,
	// 														 'status'             =>1,
	// 														 'sell_price'          =>$isCurrent?$sellPrice:0,
	// 														 'wsale_price'        =>$isCurrent?$wsalePrice:0,
	// 														 'pkno'               =>  $isCurrent?$pkno:1,
    //                                                        // 'created_at'         => date('Y-m-d H:i:s'),
            
    //                                                       ]);
    //                                      }
    //                          //------------------DEPT STOCK------------------------------------------------
										
    // 						//...............ITEM LOCATION........
    // 						if(isset($attributes['locid']) && isset($attributes['locqty'])) {
    // 							$arrLoc = [];
    // 							foreach($attributes['locid'] as $k => $v) {
    // 								if($c==1)
    // 									$quantity = $attributes['locqty'][$k] ?? 0;
    // 								else {
    // 									$quantity = $attributes['locqty'][$k]/$attributes['packing'][$key];
    // 								}
    // 								$itemLocation = new ItemLocation();
    // 								$itemLocation->location_id = $v;
    // 								$itemLocation->item_id = $this->itemmaster->id;
    // 								$itemLocation->unit_id = ($attributes['unit'][$key]=='')?$unitdat->id:$attributes['unit'][$key];
	// 								$itemLocation->department_id = auth()->user()->department_id;
    // 								$itemLocation->quantity = $quantity ?? 0;
    // 								$itemLocation->status = 1;
    // 								$itemLocation->opn_qty = $attributes['locqty'][$k] ?? 0;
    // 								$itemLocation->bin_id = $attributes['binid'][$k] ?? 0;
    // 								$itemLocation->save();
    // 							}
    							
    // 							//ADD OTHER ITEMS TO OTHER LOCATIONS...
    // 							$rows = DB::table('location')->where('department_id',auth()->user()->department_id)->where('status',1)->where('deleted_at')->get();
    // 							if($rows){
    // 								foreach($rows as $row) {
    // 									if(!in_array($row->id, $attributes['locid'])) {
    // 										$itemLocation = new ItemLocation();
    // 										$itemLocation->location_id = $row->id;
    // 										$itemLocation->department_id = auth()->user()->department_id;
    // 										$itemLocation->item_id = $this->itemmaster->id;
    // 										$itemLocation->unit_id = ($attributes['unit'][$key]=='')?$unitdat->id:$attributes['unit'][$key];
    // 										$itemLocation->quantity = 0;
    // 										$itemLocation->status = 1;
    // 										$itemLocation->opn_qty = 0;
    // 										$itemLocation->bin_id = $attributes['binid'][$k];
    // 										$itemLocation->save();
    // 									}
    // 								}
    // 							}
    								
    // 						} else {
    // 							//$row = DB::table('location')->where('is_default',1)->where('status',1)->where('deleted_at')->first();
    // 							if($c==1) {
    // 								$rows = DB::table('location')->where('department_id',auth()->user()->department_id)->where('status',1)->where('deleted_at')->get();
    // 								if($rows){
    // 									foreach($rows as $row) {
    										
    // 										$itemLocation = new ItemLocation();
    // 										$itemLocation->location_id = $row->id;
    // 										$itemLocation->department_id = auth()->user()->department_id;
    // 										$itemLocation->item_id = $this->itemmaster->id;
    // 										$itemLocation->unit_id = ($attributes['unit'][$key]=='')?$unitdat->id:$attributes['unit'][$key];
    // 										$itemLocation->quantity = ($row->is_default==1)?($attributes['opn_quantity'][0] ?? 0):0;
    // 										$itemLocation->status = 1;
    // 										$itemLocation->opn_qty = ($row->is_default==1)?($attributes['opn_quantity'][0] ?? 0):0;
    // 										$itemLocation->bin_id = isset($attributes['binid'][$key])?$attributes['binid'][$key]:0;
    // 										//$itemLocation->doc_type = 'OQ';
    // 										$itemLocation->save();
    // 									}
    // 								}
    // 							}
    // 						}
	// 				    }
	// 					$c++;
	// 				}
					
	// 			}
				
			
	// 			//Manufacture item row materials add.....
	// 			if($attributes['assembly']==1) { $a=1;
	// 				foreach($attributes['item_id'] as $ky => $item) {
	// 					if($item!='') { 
	// 						DB::table('mfg_items')
	// 								->insert([
	// 									'item_id'	=> $this->itemmaster->id,
	// 									'subitem_id'	=> $item,
	// 									'quantity'	=> $attributes['quantity'][$ky] ?? 0,
	// 									'unit_price'	=> $attributes['cost'][$ky] ?? 0,
	// 									'total'	=> $attributes['line_total'][$ky] ?? 0
	// 								]);
	// 					}
	// 				}
	// 			}
				
	// 			//BATCH NO ENTRY............
	// 			$isbatch = (isset($attributes['batch_req']))?$attributes['batch_req']:'';
	// 			if($isbatch==1 && $attributes['batchNos']!='' && $attributes['mfgDates']!='' && $attributes['qtyBatchs']!='') {
				    
	// 			    $batchArr = explode(',', $attributes['batchNos']);
	// 			    $mfgArr = explode(',', $attributes['mfgDates']);
	// 			    $expArr = explode(',', $attributes['expDates']);
	// 			    $qtyArr = explode(',', $attributes['qtyBatchs']);
				    
	// 			    foreach($batchArr as $bkey => $bval) {
				        
	// 			        $batch_id = DB::table('item_batch')
    //         				                ->insertGetId([
    //         				                    'item_id' => $this->itemmaster->id,
    //         				                    'batch_no' => $bval,
    //         				                    'mfg_date' => date('Y-m-d', strtotime($mfgArr[$bkey])),
    //         				                    'exp_date' => ($expArr[$bkey]!='')?date('Y-m-d', strtotime($expArr[$bkey])):'',
    //         				                    'quantity' => $qtyArr[$bkey]
    //         				                ]);
            				                
    //         			if($batch_id) {
    //         			    DB::table('batch_log')
    //     				                ->insert([
    //     				                    'batch_id' => $batch_id,
    //     				                    'item_id' => $this->itemmaster->id,
    //     				                    'document_type' => 'OQ',
    //     				                    'quantity' => $qtyArr[$bkey],
    //     				                    'trtype' => 1,
    //     				                    'invoice_date' => $dtrow->from_date,
    //     				                    'log_id' => $log_id,
    //     				                    'created_at' => date('Y-m-d h:i:s'),
    //     				                    'created_by' => Auth::User()->id
    //     				                    ]);
    //         			}	                
            				                
            				                
            				                
	// 			    }
				
	// 			}
	// 			//.....END BATCH ENTRY
	// 			return true;
	// 		}
	// 	}
		
	// 	//throw new ValidationException('itemmaster validation error!', $this->getErrors());
	// }



	public function create($attributes) {
		DB::beginTransaction();
		try {
			Log::info('Within save create - Raw attributes:', $attributes);
			
			// ✓ DIMENSION HANDLING - This was missing!
			if (isset($attributes['dimension']) && $attributes['dimension'] == 1) {
				$attributes['unit'] = $attributes['unit_d'];
				$attributes['packing'] = $attributes['packing_d'];	
				$attributes['opn_quantity'] = $attributes['opn_quantity_d'];	
				$attributes['opn_cost'] = $attributes['opn_cost_d'];
				$attributes['vat'] = $attributes['selvat'];
				
				Log::info('Dimension mode enabled - using _d fields');
			}
			
			Log::info('After dimension processing:', [
				'unit' => $attributes['unit'] ?? null,
				'opn_quantity' => $attributes['opn_quantity'] ?? null
			]);
			
			if ($this->isValid($attributes)) {
				// Image handling
				$image = '';
				if (isset($attributes['image']) && $attributes['image']) {
					$image = $this->handleImageUpload($attributes['image']);
				}
				
				$departmentId = auth()->user()->department_id ?? 1;
				
				// Create item
				$this->itemmaster->item_code = $attributes['item_code'];
				$this->itemmaster->description = $attributes['description'];
				$this->itemmaster->description_ar = $attributes['descriptionar'] ?? '';
				$this->itemmaster->class_id = $attributes['item_class'] ?? 0;
				$this->itemmaster->model_no = $attributes['model_no'] ?? '';
				$this->itemmaster->serial_no = $attributes['serial_no'] ?? '';
				$this->itemmaster->group_id = $attributes['group_id'] ?? 0;
				$this->itemmaster->subgroup_id = $attributes['subgroup_id'] ?? 0;
				$this->itemmaster->category_id = $attributes['category_id'] ?? 0;
				$this->itemmaster->subcategory_id = $attributes['subcategory_id'] ?? 0;
				$this->itemmaster->assembly = $attributes['assembly'] ?? 0;
				$this->itemmaster->image = $image;
				$this->itemmaster->status = 1;
				$this->itemmaster->created_department = $departmentId;
				$this->itemmaster->profit_per = $attributes['profit_per'] ?? 0;
				$this->itemmaster->bin = $attributes['machine_model'] ?? '';
				$this->itemmaster->weight = $attributes['size'] ?? 0;
				$this->itemmaster->other_info = $attributes['other_info'] ?? '';
				$this->itemmaster->created_at = now();
				$this->itemmaster->created_by = Auth::id();
				$this->itemmaster->supersede_items = isset($attributes['supersede']) ? implode(',', $attributes['supersede']) : '';
				$this->itemmaster->surface_cost = $attributes['surface_cost'] ?? '';
				$this->itemmaster->other_cost = $attributes['other_cost'] ?? '';
				$this->itemmaster->bin_location = $attributes['bin_location'] ?? '';
				$this->itemmaster->itmHt = $attributes['itmHt'] ?? '';
				$this->itemmaster->itmWd = $attributes['itmWd'] ?? '';
				$this->itemmaster->itmLt = $attributes['itmLt'] ?? '';
				$this->itemmaster->mpqty = $attributes['mpqty'] ?? '';
				$this->itemmaster->p1_qty = $attributes['opn_quantity'][1] ?? '';
				$this->itemmaster->p2_qty = $attributes['opn_quantity'][2] ?? '';
				$this->itemmaster->dimension = $attributes['dimension'] ?? 0;
				$this->itemmaster->batch_req = $attributes['batch_req'] ?? 0;
				
				// Formulas
				$this->itemmaster->p1_formula = (isset($attributes['packing'][1]) && isset($attributes['pkno'][1])) 
					? (($attributes['packing'][1] > $attributes['pkno'][1]) ? $attributes['packing'][1].',/' : $attributes['pkno'][1].',*') 
					: '';
				$this->itemmaster->p2_formula = (isset($attributes['packing'][2]) && isset($attributes['pkno'][2])) 
					? (($attributes['packing'][2] > $attributes['pkno'][2]) ? $attributes['packing'][2].',/' : $attributes['pkno'][2].',*') 
					: '';
				
				$this->itemmaster->save();
				
				Log::info('Item created successfully:', [
					'id' => $this->itemmaster->id,
					'item_code' => $this->itemmaster->item_code
				]);
				
				if ($this->itemmaster->id) {
					// Create item units, locations, and department stock
					$this->createItemUnitsAndRelated($this->itemmaster->id, $attributes, $departmentId);
					
					// Create manufacturing items if assembly
					if (isset($attributes['assembly']) && $attributes['assembly'] == 1) {
						$this->createMfgItems($this->itemmaster->id, $attributes);
					}
					
					// Create batch entries if batch required
					if (isset($attributes['batch_req']) && $attributes['batch_req'] == 1) {
						$this->createBatchEntries($this->itemmaster->id, $attributes);
					}
				}
				
				DB::commit();
				return true;
			}
			
			DB::rollback();
			return false;
			
		} catch(\Exception $e) {
			DB::rollback();
			Log::error('Item creation failed: ' . $e->getMessage(), [
				'trace' => $e->getTraceAsString()
			]);
			throw $e;
		}
	}


	/**
	 * Create item units and related data (locations, dept stock, logs)
	 * This matches the old working logic exactly
	 */
	private function createItemUnitsAndRelated($itemmaster_id, $attributes, $departmentId)
	{
		$c = 1;
		$dtrow = DB::table('parameter1')->select('from_date')->first();
		
		if (!isset($attributes['unit']) || !is_array($attributes['unit'])) {
			Log::warning('No units array found');
			return;
		}
		
		foreach ($attributes['unit'] as $key => $val) {
			// Skip empty units except first one
			if (empty($val) && $c != 1) {
				$c++;
				continue;
			}
			
			// Get unit data
			if (empty($val)) {
				$unitdat = DB::table('units')->whereNull('deleted_at')->first();
				$unit_id = $unitdat->id;
				$unit_name = $unitdat->unit_name;
			} else {
				$unitdat = DB::table('units')->where('id', $val)->first();
				$unit_id = $val;
				$unit_name = $unitdat->unit_name;
			}
			
			$packing = empty($attributes['packing'][$key]) ? $unit_name : $attributes['packing'][$key];
			$pkno = empty($attributes['packing'][$key]) ? 1 : ($attributes['pkno'][$key] ?? 1);
			
			// Extract values
			$opnQuantity = $attributes['opn_quantity'][$key] ?? 0;
			$opnCost = $attributes['opn_cost'][$key] ?? 0;
			$sellPrice = $attributes['sell_price'][$key] ?? '';
			$wsalePrice = $attributes['wsale_price'][$key] ?? 0;
			$minQuantity = $attributes['min_quantity'][$key] ?? 0;
			$reorderLevel = $attributes['reorder_level'][$key] ?? 0;
			$vat = $attributes['selvat'][0] ?? 0;
			
			Log::info("Creating unit {$c}", [
				'key' => $key,
				'unit_id' => $unit_id,
				'packing' => $packing,
				'quantity' => $opnQuantity,
				'cost' => $opnCost
			]);
			
			// Create item unit
			$itemunit = new ItemUnit();
			$itemunit->itemmaster_id = $itemmaster_id;
			$itemunit->unit_id = $unit_id;
			$itemunit->packing = $packing;
			$itemunit->opn_quantity = $opnQuantity;
			$itemunit->opn_cost = $opnCost;
			$itemunit->sell_price = $sellPrice;
			$itemunit->wsale_price = $wsalePrice;
			$itemunit->min_quantity = $minQuantity;
			$itemunit->reorder_level = $reorderLevel;
			$itemunit->vat = $vat;
			$itemunit->status = 1;
			$itemunit->cur_quantity = $opnQuantity;
			$itemunit->is_baseqty = ($c == 1) ? 1 : 0;
			$itemunit->received_qty = $opnQuantity;
			$itemunit->last_purchase_cost = $opnCost;
			$itemunit->pur_count = 1;
			$itemunit->cost_avg = $opnCost;
			$itemunit->pkno = $pkno;
			$itemunit->save();
			
			// For base unit only (first unit)
			if ($c == 1) {
				// Create item log
				$log_id = DB::table('item_log')->insertGetId([
					'document_type' => 'OQ',
					'department_id' => $departmentId,
					'item_id' => $itemmaster_id,
					'unit_id' => $unit_id,
					'quantity' => $opnQuantity,
					'unit_cost' => $opnCost,
					'trtype' => 1,
					'cur_quantity' => $opnQuantity,
					'cost_avg' => $opnCost,
					'pur_cost' => $opnCost,
					'sale_cost' => '',
					'packing' => 1,
					'status' => 1,
					'created_at' => now(),
					'created_by' => Auth::id(),
					'voucher_date' => $dtrow->from_date ?? now()
				]);
				
				// Get base unit data for department stock
				$baseUnitId = empty($attributes['unit'][0]) ? $unitdat->id : $attributes['unit'][0];
				$basePacking = empty($attributes['packing'][0]) ? $unit_name : $attributes['packing'][0];
				$baseOpnQty = isset($attributes['opn_quantity'][0]) ? (float)$attributes['opn_quantity'][0] : 0;
				$baseOpnCost = isset($attributes['opn_cost'][0]) ? (float)$attributes['opn_cost'][0] : 0;
				$baseSellPrice = $attributes['sell_price'][0] ?? 0;
				$baseWsalePrice = $attributes['wsale_price'][0] ?? 0;
				$baseMinQty = $attributes['min_quantity'][0] ?? 0;
				$baseReorder = $attributes['reorder_level'][0] ?? '';
				$baseVat = $attributes['selvat'][0] ?? 0;
				$basePkno = empty($attributes['packing'][0]) ? 1 : ($attributes['pkno'][0] ?? 1);
				
				// Create department stock for all departments
				$departments = DB::table('department')->whereNull('deleted_at')->get();
				
				foreach ($departments as $dept) {
					$isCurrent = ($dept->id == $departmentId);
					
					DB::table('itemstock_department')->insert([
						'itemmaster_id' => $itemmaster_id,
						'department_id' => $dept->id,
						'unit_id' => $baseUnitId,
						'packing' => $basePacking,
						'opn_cost' => $isCurrent ? $baseOpnCost : 0,
						'opn_quantity' => $isCurrent ? $baseOpnQty : 0,
						'cur_quantity' => $isCurrent ? $baseOpnQty : 0,
						'received_qty' => $isCurrent ? $baseOpnQty : 0,
						'issued_qty' => 0,
						'min_quantity' => $isCurrent ? $baseMinQty : 0,
						'reorder_level' => $isCurrent ? $baseReorder : 0,
						'vat' => $baseVat, // All depts get same VAT
						'is_baseqty' => 1,
						'pur_count' => 1,
						'last_purchase_cost' => $isCurrent ? $baseOpnCost : 0,
						'cost_avg' => $isCurrent ? $baseOpnCost : 0,
						'status' => 1,
						'sell_price' => $isCurrent ? $baseSellPrice : 0,
						'wsale_price' => $isCurrent ? $baseWsalePrice : 0,
						'pkno' => $isCurrent ? $basePkno : 1,
					]);
				}
				
				// Create item locations (only for first unit)
				if (isset($attributes['locid']) && isset($attributes['locqty'])) {
					// User specified locations
					foreach ($attributes['locid'] as $k => $locationId) {
						$quantity = $attributes['locqty'][$k] ?? 0;
						
						$itemLocation = new ItemLocation();
						$itemLocation->location_id = $locationId;
						$itemLocation->item_id = $itemmaster_id;
						$itemLocation->unit_id = $unit_id;
						$itemLocation->department_id = $departmentId;
						$itemLocation->quantity = $quantity;
						$itemLocation->status = 1;
						$itemLocation->opn_qty = $quantity;
						$itemLocation->bin_id = $attributes['binid'][$k] ?? 0;
						$itemLocation->save();
					}
					
					// Add other locations with zero quantity
					$allLocations = DB::table('location')
						->where('department_id', $departmentId)
						->where('status', 1)
						->whereNull('deleted_at')
						->get();
					
					foreach ($allLocations as $location) {
						if (!in_array($location->id, $attributes['locid'])) {
							$itemLocation = new ItemLocation();
							$itemLocation->location_id = $location->id;
							$itemLocation->department_id = $departmentId;
							$itemLocation->item_id = $itemmaster_id;
							$itemLocation->unit_id = $unit_id;
							$itemLocation->quantity = 0;
							$itemLocation->status = 1;
							$itemLocation->opn_qty = 0;
							$itemLocation->bin_id = 0;
							$itemLocation->save();
						}
					}
				} else {
					// No specific locations - add to all locations
					$allLocations = DB::table('location')
						->where('department_id', $departmentId)
						->where('status', 1)
						->whereNull('deleted_at')
						->get();
					
					foreach ($allLocations as $location) {
						$itemLocation = new ItemLocation();
						$itemLocation->location_id = $location->id;
						$itemLocation->department_id = $departmentId;
						$itemLocation->item_id = $itemmaster_id;
						$itemLocation->unit_id = $unit_id;
						$itemLocation->quantity = ($location->is_default == 1) ? $baseOpnQty : 0;
						$itemLocation->status = 1;
						$itemLocation->opn_qty = ($location->is_default == 1) ? $baseOpnQty : 0;
						$itemLocation->bin_id = $attributes['binid'][0] ?? 0;
						$itemLocation->save();
					}
				}
			}
			
			$c++;
		}
		
		Log::info("Item units and related data created for item {$itemmaster_id}");
	}

	/**
	 * Calculate packing formula based on index
	 */
	private function calculatePackingFormula($attributes, $index)
	{
		if (!isset($attributes['packing'][$index]) || !isset($attributes['pkno'][$index])) {
			return '';
		}
		
		$packing = $attributes['packing'][$index];
		$pkno = $attributes['pkno'][$index];
		
		if ($packing > $pkno) {
			return $packing . ',/';
		} else {
			return $pkno . ',*';
		}
	}
	/**```

	## Also Check Your createItemLocations() Method

	Looking at your payload, you have:
	```
	// locid[] = 1
	// locqty[] = 13
	// locid[] = 34
	// locqty[] = 14
	
	
	 * Create item units for the item
	 */
	private function createItemUnits($itemmaster_id, $attributes)
	{
		$dtrow = DB::table('parameter1')->select('from_date')->first();
		$c = 1;
		$departmentId = auth()->user()->department_id ?? 1;
		Log::info('with in save createItemUnits');
		foreach($attributes['unit'] as $key => $val) {
			if($attributes['unit'][$key] != "" || $c == 1) {
				
				// Get unit data
				if($attributes['unit'][$key] == '') {
					$unitdat = DB::table('units')
						// ->where('deleted_at', '0000-00-00 00:00:00')
						->whereNull('deleted_at')
						->first();
					$unit_id = $unitdat->id;
					$packing = $unitdat->unit_name;
				} else {
					$unitdat = DB::table('units')
						->where('id', $attributes['unit'][$key])
						->first();
					$unit_id = $attributes['unit'][$key];
					$packing = $attributes['packing'][$key] ?? $unitdat->unit_name;
				}
				
				// Create item unit
				$itemunit = new ItemUnit();
				$itemunit->itemmaster_id = $itemmaster_id;
				$itemunit->unit_id = $unit_id;
				$itemunit->packing = $packing;
				$itemunit->opn_quantity = $attributes['opn_quantity'][$key] ?? 0;
				$itemunit->opn_cost = $attributes['opn_cost'][$key] ?? 0;
				$itemunit->sell_price = $attributes['sell_price'][$key] ?? 0;
				$itemunit->wsale_price = $attributes['wsale_price'][$key] ?? 0;
				$itemunit->min_quantity = $attributes['min_quantity'][$key] ?? 0;
				$itemunit->reorder_level = $attributes['reorder_level'][$key] ?? 0;
				$itemunit->vat = $attributes['selvat'][0] ?? 0;
				$itemunit->status = 1;
				$itemunit->cur_quantity = $attributes['opn_quantity'][$key] ?? 0;
				$itemunit->is_baseqty = ($c == 1) ? 1 : 0;
				$itemunit->received_qty = $attributes['opn_quantity'][$key] ?? 0;
				$itemunit->last_purchase_cost = $attributes['opn_cost'][$key] ?? 0;
				$itemunit->pur_count = 1;
				$itemunit->cost_avg = $attributes['opn_cost'][$key] ?? 0;
				$itemunit->pkno = $attributes['pkno'][$key] ?? 1;
				$itemunit->save();
				
				// Create item log for base quantity only
				if($c == 1) {
					$log_id = DB::table('item_log')->insertGetId([
						'document_type' => 'OQ',
						'department_id' => $departmentId,
						'item_id' => $itemmaster_id,
						'unit_id' => $unit_id,
						'quantity' => $attributes['opn_quantity'][$key] ?? 0,
						'unit_cost' => $attributes['opn_cost'][$key] ?? 0,
						'trtype' => 1,
						'cur_quantity' => $attributes['opn_quantity'][$key] ?? 0,
						'cost_avg' => $attributes['opn_cost'][$key] ?? 0,
						'pur_cost' => $attributes['opn_cost'][$key] ?? 0,
						'sale_cost' => '',
						'packing' => 1,
						'status' => 1,
						'created_at' => now(),
						'created_by' => Auth::id(),
						'voucher_date' => $dtrow->from_date
					]);
					
					// Create department stock entries
					$this->createDepartmentStock($itemmaster_id, $attributes, $key, $log_id, $unit_id, $packing);
				}
				
				$c++;
			}
		}
	}

	/**
	 * Create department stock for all departments
	 */
	private function createDepartmentStock($itemmaster_id, $attributes, $key, $unit_id, $packing)
	{
		$departmentId = auth()->user()->department_id ?? 1;
		Log::info('with in save createDepartmentStock');
		$openingQty = isset($attributes['opn_quantity'][0]) ? (float)$attributes['opn_quantity'][0] : 0;
		$openingCost = isset($attributes['opn_cost'][0]) ? (float)$attributes['opn_cost'][0] : 0;
		$sellPrice = isset($attributes['sell_price'][0]) ? $attributes['sell_price'][0] : 0;
		$wsalePrice = isset($attributes['wsale_price'][0]) ? $attributes['wsale_price'][0] : 0;
		$minqty = isset($attributes['min_quantity'][0]) ? $attributes['min_quantity'][0] : 0;
		$reorder = isset($attributes['reorder_level'][0]) ? $attributes['reorder_level'][0] : 0;
		$vat = isset($attributes['selvat'][0]) ? $attributes['selvat'][0] : 0;
		$pkno = isset($attributes['pkno'][0]) ? $attributes['pkno'][0] : 1;
		
		$departments = DB::table('department')
			// ->where('deleted_at', '0000-00-00 00:00:00')
			->whereNull('deleted_at')
			->get();
		
		foreach ($departments as $dept) {
			$isCurrent = ($dept->id == $departmentId);
			
			DB::table('itemstock_department')->insert([
				'itemmaster_id' => $itemmaster_id,
				'department_id' => $dept->id,
				'unit_id' => $unit_id,
				'packing' => $packing,
				'opn_cost' => $isCurrent ? $openingCost : 0,
				'opn_quantity' => $isCurrent ? $openingQty : 0,
				'cur_quantity' => $isCurrent ? $openingQty : 0,
				'received_qty' => $isCurrent ? $openingQty : 0,
				'issued_qty' => 0,
				'min_quantity' => $isCurrent ? $minqty : 0,
				'reorder_level' => $isCurrent ? $reorder : 0,
				'vat' => $vat,
				'is_baseqty' => 1,
				'pur_count' => 1,
				'last_purchase_cost' => $isCurrent ? $openingCost : 0,
				'cost_avg' => $isCurrent ? $openingCost : 0,
				'status' => 1,
				'sell_price' => $isCurrent ? $sellPrice : 0,
				'wsale_price' => $isCurrent ? $wsalePrice : 0,
				'pkno' => $isCurrent ? $pkno : 1,
			]);
		}
	}


	private function handleImageUpload($file) {
		Log::info('with in save handleImageUpload');
		$image = time() . '.' . $file->getClientOriginalExtension();
		$destinationPath = public_path() . $this->imgDir . '/' . $image;
		
		Image::make($file->getRealPath())
			->resize($this->width, $this->height, function($constraint) {
				$constraint->aspectRatio();
			})
			->save($destinationPath);
		
		return $image;
	}

	/**
	 * Create item ajaxCreateations
	 */
	private function createItemLocations($itemmaster_id, $attributes)
	{
		Log::info('with in save createItemLocations');
		$departmentId = auth()->user()->department_id ?? 1;
		$unitdat = DB::table('units')
			// ->where('deleted_at', '0000-00-00 00:00:00')
			->whereNull('deleted_at')
			->first();
		
		$unit_id = isset($attributes['unit'][0]) && $attributes['unit'][0] != '' 
			? $attributes['unit'][0] 
			: $unitdat->id;
		
		if(isset($attributes['locid']) && isset($attributes['locqty'])) {
			// User specified locations
			foreach($attributes['locid'] as $k => $v) {
				$itemLocation = new ItemLocation();
				$itemLocation->location_id = $v;
				$itemLocation->item_id = $itemmaster_id;
				$itemLocation->unit_id = $unit_id;
				$itemLocation->department_id = $departmentId;
				$itemLocation->quantity = $attributes['locqty'][$k] ?? 0;
				$itemLocation->status = 1;
				$itemLocation->opn_qty = $attributes['locqty'][$k] ?? 0;
				$itemLocation->bin_id = $attributes['binid'][$k] ?? 0;
				$itemLocation->save();
			}
			
			// Add other locations with zero quantity
			$rows = DB::table('location')
				->where('department_id', $departmentId)
				->where('status', 1)
				// ->where('deleted_at', '0000-00-00 00:00:00')
				->whereNull('deleted_at')
				->get();
			
			if($rows) {
				foreach($rows as $row) {
					if(!in_array($row->id, $attributes['locid'])) {
						$itemLocation = new ItemLocation();
						$itemLocation->location_id = $row->id;
						$itemLocation->department_id = $departmentId;
						$itemLocation->item_id = $itemmaster_id;
						$itemLocation->unit_id = $unit_id;
						$itemLocation->quantity = 0;
						$itemLocation->status = 1;
						$itemLocation->opn_qty = 0;
						$itemLocation->bin_id = 0;
						$itemLocation->save();
					}
				}
			}
		} else {
			// Default: add to all locations
			$rows = DB::table('location')
				->where('department_id', $departmentId)
				->where('status', 1)
				// ->where('deleted_at', '0000-00-00 00:00:00')
				->whereNull('deleted_at')
				->get();
			
			if($rows) {
				foreach($rows as $row) {
					$itemLocation = new ItemLocation();
					$itemLocation->location_id = $row->id;
					$itemLocation->department_id = $departmentId;
					$itemLocation->item_id = $itemmaster_id;
					$itemLocation->unit_id = $unit_id;
					$itemLocation->quantity = ($row->is_default == 1) 
						? ($attributes['opn_quantity'][0] ?? 0) 
						: 0;
					$itemLocation->status = 1;
					$itemLocation->opn_qty = ($row->is_default == 1) 
						? ($attributes['opn_quantity'][0] ?? 0) 
						: 0;
					$itemLocation->bin_id = isset($attributes['binid'][0]) 
						? $attributes['binid'][0] 
						: 0;
					$itemLocation->save();
				}
			}
		}
		Log::info('out from save createItemLocations rows:',$rows->toarray());
	}

	/**
	 * Create manufacturing items (raw materials)
	 */
	private function createMfgItems($itemmaster_id, $attributes)
	{
		Log::info('with in save createMfgItems');
		if(!isset($attributes['item_id'])) {
			return;
		}
		
		foreach($attributes['item_id'] as $ky => $item) {
			if($item != '') {
				DB::table('mfg_items')->insert([
					'item_id' => $itemmaster_id,
					'subitem_id' => $item,
					'quantity' => $attributes['quantity'][$ky] ?? 0,
					'unit_price' => $attributes['cost'][$ky] ?? 0,
					'total' => $attributes['line_total'][$ky] ?? 0
				]);
			}
		}
	}

	/**
	 * Create batch entries
	 */
	private function createBatchEntries($itemmaster_id, $attributes)
	{
		Log::info('with in save createBatchEntries');
		if(!isset($attributes['batchNos']) || $attributes['batchNos'] == '') {
			return;
		}
		
		if(!isset($attributes['mfgDates']) || !isset($attributes['qtyBatchs'])) {
			return;
		}
		
		$dtrow = DB::table('parameter1')->select('from_date')->first();
		$logrow = DB::table('item_log')
			->where('document_type', 'OQ')
			->where('item_id', $itemmaster_id)
			->where('packing', 1)
			->select('id')
			->first();
		
		$batchArr = explode(',', $attributes['batchNos']);
		$mfgArr = explode(',', $attributes['mfgDates']);
		$expArr = explode(',', $attributes['expDates']);
		$qtyArr = explode(',', $attributes['qtyBatchs']);
		
		foreach($batchArr as $bkey => $bval) {
			if($bval == '') continue;
			
			$batch_id = DB::table('item_batch')->insertGetId([
				'item_id' => $itemmaster_id,
				'batch_no' => $bval,
				'mfg_date' => date('Y-m-d', strtotime($mfgArr[$bkey])),
				'exp_date' => ($expArr[$bkey] != '') 
					? date('Y-m-d', strtotime($expArr[$bkey])) 
					: null,
				'quantity' => $qtyArr[$bkey]
			]);
			
			if($batch_id && $logrow) {
				DB::table('batch_log')->insert([
					'batch_id' => $batch_id,
					'item_id' => $itemmaster_id,
					'document_type' => 'OQ',
					'quantity' => $qtyArr[$bkey],
					'trtype' => 1,
					'invoice_date' => $dtrow->from_date,
					'log_id' => $logrow->id,
					'created_at' => now(),
					'created_by' => Auth::id()
				]);
			}
		}
	}

	
	// public function update($id, $attributes) //sell_price
	// { //

	// 	//echo '<pre>';print_r($attributes);exit;
	// 	if($attributes['dimension']==1) {

	// 		$attributes['unit'] = $attributes['unit_d'];
	// 		$attributes['packing'] = $attributes['packing_d'];	
	// 		$attributes['opn_quantity'] = $attributes['opn_quantity_d'];	
	// 		$attributes['opn_cost'] = $attributes['opn_cost_d'];
	// 		//$attributes['vat'] = $attributes['vat_d'];

	// 		$attributes['vat'] = $attributes['selvat'];
	// 	}
		
	// 	$this->itemmaster = $this->find($id);
	// 	if($this->isValid($attributes, ['item_code' => 'required'])) {
			
	// 		$image = $attributes['current_image'];
	// 		$file = (isset($attributes['image'])) ? $attributes['image'] : null;
	// 	//	echo '<pre>';print_r($attributes['image']);exit;
	// 		//---------------image uploading section-----------------
	// 		if($file) {
	// 			//echo '<pre>';print_r($file->getClientOriginalExtension());exit;
	// 			$image = time().'.'.$file->getClientOriginalExtension();
				
	// 			$destinationPath = public_path() . $this->imgDir.'/'.$image;
	// 			$destinationPathThumb = public_path() . $this->imgDir.'/thumb_'.$image;

	// 			// resizing an uploaded file
	// 			Image::make($file->getRealPath())->resize($this->width, $this->height, function($constraint) { $constraint->aspectRatio(); })->save($destinationPath);

	// 			// thumb
	// 			Image::make($file->getRealPath())->resize($this->thumbWidth, $this->thumbHeight, function($constraint) { $constraint->aspectRatio(); })->save($destinationPathThumb);
	// 		}
			
	// 		$this->itemmaster->item_code = $attributes['item_code']; //opn_quantity
	// 		$this->itemmaster->description = $attributes['description'];
	// 		$this->itemmaster->description_ar =(isset($attributes['descriptionar']))?$attributes['descriptionar']:'';
	// 		$this->itemmaster->class_id = $attributes['item_class'];
	// 		$this->itemmaster->model_no = $attributes['model_no'];
	// 		$this->itemmaster->serial_no = $attributes['serial_no'];
	// 		$this->itemmaster->group_id = $attributes['group_id'];
	// 		$this->itemmaster->subgroup_id = $attributes['subgroup_id'];
	// 		$this->itemmaster->category_id = $attributes['category_id'];
	// 		$this->itemmaster->subcategory_id = $attributes['subcategory_id'];
	// 		$this->itemmaster->assembly = $attributes['assembly'];
	// 		$this->itemmaster->image = $image;
	// 		$this->itemmaster->profit_per = $attributes['profit_per'];
	// 		$this->itemmaster->bin = $attributes['machine_model'];
	// 		$this->itemmaster->weight = $attributes['size'];
	// 		$this->itemmaster->other_info = $attributes['other_info'];
	// 		$this->itemmaster->modify_by = Auth::User()->id;
	// 		$this->itemmaster->modified_at = date('Y-m-d H:i:s');
	// 		$this->itemmaster->supersede_items = (isset($attributes['supersede']))?implode(',', $attributes['supersede']):'';
	// 		$this->itemmaster->bin_location = (isset($attributes['bin_location']))?$attributes['bin_location']:'';//SP7

	// 		$this->itemmaster->itmHt = (isset($attributes['itmHt']))?$attributes['itmHt']:'';//SP7
	// 		$this->itemmaster->itmWd = (isset($attributes['itmWd']))?$attributes['itmWd']:'';//SP7
	// 		$this->itemmaster->itmLt = (isset($attributes['itmLt']))?$attributes['itmLt']:'';//SP7
	// 		$this->itemmaster->mpqty = (isset($attributes['mpqty']))?$attributes['mpqty']:'';
    //         $this->itemmaster->p1_qty = (isset($attributes['opn_quantity'][1]))?$attributes['opn_quantity'][1]:'';
    //         $this->itemmaster->p2_qty = (isset($attributes['opn_quantity'][2]))?$attributes['opn_quantity'][2]:'';
	// 		$this->itemmaster->dimension = (isset($attributes['dimension']))?$attributes['dimension']:'';
			
	// 		//$this->itemmaster->p1_formula = (isset($attributes['packing'][1]))?$attributes['packing'][1]:'';
    //        // $this->itemmaster->p2_formula = (isset($attributes['packing'][2]))?$attributes['packing'][2]:'';   
            
    //         $this->itemmaster->p1_formula = (isset($attributes['packing'][1]) && isset($attributes['pkno'][1]))?(($attributes['packing'][1]>$attributes['pkno'][1])?$attributes['packing'][1].',/':$attributes['pkno'][1].',*'):'';
    //         $this->itemmaster->p2_formula = (isset($attributes['packing'][2]) && isset($attributes['pkno'][2]))?(($attributes['packing'][2]>$attributes['pkno'][2])?$attributes['packing'][2].',/':$attributes['pkno'][2].',*'):'';
			
			
			
	// 		$this->itemmaster->fill($attributes)->save();
			
	// 		//$units = $this->getUnits($id);//echo '<pre>';print_r($units);exit;
	// 		$key = 0;
	// 		$currentDeptId = auth()->user()->department_id;
			
	// 		foreach($attributes['unit'] as $key => $val) {
				
	// 			if(isset($attributes['item_unit_id'][$key]) && $attributes['item_unit_id'][$key]!='')
	// 				$itemunit = ItemUnit::find($attributes['item_unit_id'][$key]);
	// 			else
	// 				$itemunit = new ItemUnit();
				
	// 				$logs = DB::table('item_log')->where('document_type','!=','OQ')->where('item_id',$id)->where('department_id',$currentDeptId)->count();
	// 			if($attributes['unit'][$key]!="" || $key==0) {
	// 				if(isset($attributes['opn_quantity_cur'][$key])&& isset($attributes['opn_quantity'][$key])&&$attributes['opn_quantity_cur'][$key] != $attributes['opn_quantity'][$key]){
	// 					if($logs==0)
	// 						$itemunit->cur_quantity = $attributes['opn_quantity'][$key];// + $itemunit->cur_quantity;
	// 				}
					
	// 				if($attributes['unit'][$key]=='') {
	// 			        $unitdat = DB::table('units')->where('deleted_at')->first();
	// 			    }
    //                   //echo '<pre>';print_r($attributes['unit'][$key]);exit;
    //                   $unitId = ($attributes['unit'][$key] == '') ? $unitdat->id : $attributes['unit'][$key];
    //                  $opnQty = isset($attributes['opn_quantity'][$key]) ? (float)$attributes['opn_quantity'][$key] : 0;
    //                  $opnCost = isset($attributes['opn_cost'][$key]) ? (float)$attributes['opn_cost'][$key] : 0;
	// 				  $sellPrice=isset($attributes['sell_price'][$key])?$attributes['sell_price'][$key]:0;
    //                    $wsalePrice=isset($attributes['wsale_price'][$key])?$attributes['wsale_price'][$key]:0;
	// 				   $minQty=    isset($attributes['min_quantity'][$key])?$attributes['min_quantity'][$key]:0;
    //                  // ----------------------------------------------
    //                    // DETERMINE WHETHER TO REPLACE OR ADD
    //                  // ----------------------------------------------
    //                      $existingDeptStock = DB::table('itemstock_department')->where('itemmaster_id', $id)
	// 					                           ->where('department_id', $currentDeptId)->first();

    //                     $isSameDept = false;
    //                     if ($existingDeptStock) {
    //         // If this department already has non-zero stock, it’s the same dept
	// 		          if($existingDeptStock->opn_quantity > 0 || $existingDeptStock->opn_cost > 0)
    //                     $isSameDept =true ;
    //                    }
    //                    //echo '<pre>';print_r($isSameDept);exit;
        
    //                   // UPDATE GLOBAL ITEM_UNIT TABLE
        
    //                     if ($isSameDept) {
    //                         // SAME STORE → REPLACE
    //                             $itemunit->opn_quantity = $opnQty;
    //                             $itemunit->opn_cost = $opnCost;
    //                             $itemunit->cur_quantity = $opnQty;
	// 							$itemunit->sell_price=$sellPrice;
	// 							$itemunit->wsale_price=$wsalePrice;
	// 							$itemunit->min_quantity=$minQty;
	// 							$itemunit->cost_avg = $opnCost;
    //                     } else {
    //                        // 🆕 DIFFERENT STORE → ADD
    //                           $itemunit->opn_quantity = ($itemunit->opn_quantity ?: 0) + $opnQty;
    //                            $itemunit->opn_cost = ($itemunit->opn_cost ?: 0) + $opnCost;
    //                            $itemunit->cur_quantity = ($itemunit->cur_quantity ?: 0) + $opnQty;
	// 						   $itemunit->sell_price=($itemunit->sell_price ?: 0) + $sellPrice;
	// 						   $itemunit->wsale_price=($itemunit->wsell_price ?: 0) + $wsalePrice;
	// 						   $itemunit->min_quantity=($itemunit->min_quantity ?: 0) + $minQty;
	// 						   $itemunit->cost_avg =($itemunit->cost_avg ?: 0) + $opnCost;
							   
    //                     }

    //                      //echo '<pre>';print_r($itemunit->opn_quantity);exit;
    //                          // COMMON FIELD UPDATES
        
    //                 $itemunit->unit_id = $unitId;
	// 				$itemunit->packing = $attributes['packing'][$key];
	// 				//$itemunit->opn_quantity = $attributes['opn_quantity'][$key];
	// 				//$itemunit->opn_cost = $attributes['opn_cost'][$key];
	// 				//$itemunit->sell_price = isset($attributes['sell_price'][$key])?$attributes['sell_price'][$key]:'';
	// 				//$itemunit->wsale_price = isset($attributes['wsale_price'][$key])?$attributes['wsale_price'][$key]:'';
	// 				//$itemunit->min_quantity = isset($attributes['min_quantity'][$key])?$attributes['min_quantity'][$key]:'';
	// 				$itemunit->reorder_level = isset($attributes['reorder_level'][$key])?$attributes['reorder_level'][$key]:'';
	// 				$itemunit->vat = isset($attributes['selvat'][0])?$attributes['selvat'][0]:'';
	// 				$itemunit->is_baseqty = ($key==0)?$is_baseqty=1:$is_baseqty=0;
	// 				//$itemunit->cost_avg = isset($attributes['opn_cost'][$key])?$attributes['opn_cost'][$key]:'';
	// 				$itemunit->pkno = isset($attributes['pkno'][$key])?$attributes['pkno'][$key]:'';
	// 				$itemunit->status = 1;
	// 				//$itemunit->received_qty = $attributes['opn_quantity'][$key];
	// 				//echo '<pre>';print_r($itemunit);exit;
	// 				if(isset($attributes['item_unit_id'][$key]) && $attributes['item_unit_id'][$key]!='')
						
	// 					$itemunit->save();
	// 				else
	// 					$this->itemmaster->itemUnits()->save($itemunit);
	// 				// ----------------------------------------------
    //     // UPDATE ITEMSTOCK_DEPARTMENT (per-store)
    //     // ----------------------------------------------
    //                    if ($existingDeptStock) {
    //               if ($isSameDept) {
    //                         // ✅ SAME STORE → REPLACE
    //             DB::table('itemstock_department')
    //                 ->where('itemmaster_id', $id)
    //                 ->where('department_id', $currentDeptId)
    //                 ->update([
    //                     'opn_quantity' => $opnQty,
    //                     'opn_cost'     => $opnCost,
    //                     'cur_quantity' => $opnQty,
	// 					'received_qty' =>$opnQty,
    //                     'last_purchase_cost' => $opnCost,
    //                     'cost_avg'     => $opnCost,
                        
    //                 ]);
    //         } else {
    //             // 🆕 DIFFERENT STORE → ADD stock to that department
    //             DB::table('itemstock_department')
    //                 ->where('itemmaster_id', $id)
    //                 ->where('department_id', $currentDeptId)
    //                 ->update([
    //                     'opn_quantity' => DB::raw('opn_quantity + ' . $opnQty),
    //                     'opn_cost'     => DB::raw('opn_cost + ' . $opnCost),
    //                     'cur_quantity' => DB::raw('cur_quantity + ' . $opnQty),
	// 					'received_qty' =>DB::raw('received_qty + ' . $opnQty),
    //                     'last_purchase_cost' => $opnCost,
    //                     'cost_avg'     => $opnCost,

                        
    //                 ]);
    //         }
    //     }
                    
    //                        // END UPDATE ITEMSTOCK_DEPARTMENT (per-store)
        
        
	// 				if($key==0) {
	// 					//-----------ITEM LOG----------------							
	// 					DB::table('item_log')
	// 								->where('document_type', 'OQ')
	// 								->where('item_id', $this->itemmaster->id) 
	// 								->where('department_id', $currentDeptId)
	// 								->where('packing', 1)
	// 								->update([
	// 								     'unit_id' => $attributes['unit'][$key],
	// 									 'quantity'   => $attributes['opn_quantity'][$key],
	// 									 'unit_cost'  => $attributes['opn_cost'][$key],
	// 									 'cur_quantity' => $attributes['opn_quantity'][$key],
	// 									 'cost_avg' => $attributes['opn_cost'][$key],
	// 									 'pur_cost' => $attributes['opn_cost'][$key],
	// 									]);
	// 					//-------------ITEM LOG--------------
	// 				}		
	// 				$key++;

	// 				//-----------ITEM LOG----------------	
	// 				$log_count=DB::table('item_log')
	// 								->where('document_type', 'OQ')
	// 								->where('item_id', $this->itemmaster->id) 
	// 								->where('department_id', $currentDeptId)->count();
					
    //               if ($log_count==0) {	
	// 						$dtrow = DB::table('parameter1')->select('from_date')->first();
	// 						$log_id = DB::table('item_log')->insertGetId([
	// 										 'document_type' => 'OQ',
	// 										 'department_id'=>auth()->user()->department_id,
	// 										 'item_id' 	  => $this->itemmaster->id,
	// 										 'unit_id'    => $unitId,
	// 										 'quantity'   => isset($attributes['opn_quantity'][0])?$attributes['opn_quantity'][0]:0,
	// 										 'unit_cost'  => isset($attributes['opn_cost'][0])?$attributes['opn_cost'][0]:0,
	// 										 'trtype'	  => 1,
	// 										 'cur_quantity' => isset($attributes['opn_quantity'][0])?$attributes['opn_quantity'][0]:0,
	// 										 'cost_avg' => isset($attributes['opn_cost'][0])?$attributes['opn_cost'][0]:0,
	// 										 'pur_cost' => isset($attributes['opn_cost'][0])?$attributes['opn_cost'][0]:0,
	// 										 'sale_cost' => '',
	// 										 'packing' => 1,
	// 										 'status'     => 1,
	// 										 'created_at' => date('Y-m-d H:i:s'),
	// 										 'created_by' => Auth::User()->id,
	// 										 'voucher_date' => $dtrow->from_date
	// 										 //'voucher_date' => date('Y-m-d', strtotime('-1 day', strtotime($dtrow->from_date)))
	// 										]);
	// 									}
									

	// 								//echo '<pre>';print_r($log_id);exit;
	// 						//-------------ITEM LOG------------------
						
					
	// 				if(isset($attributes['locid']) && isset($attributes['locqty'])) {
	// 					foreach($attributes['locid'] as $k => $v) {
	// 						$itlocid = isset($attributes['itlocid'][$k])?$attributes['itlocid'][$k]:0;
	// 						if($itlocid!='')
	// 							DB::table('item_location')->where('id', $itlocid)->where('department_id', auth()->user()->department_id ?? 1)->update(['quantity' => $attributes['locqty'][$k],'opn_qty' => $attributes['locqty'][$k], 'bin_id' => $attributes['binid'][$k]]);
	// 						else {
	// 						    $unitdat = DB::table('units')->where('deleted_at')->first();
	// 							$itemLocation = new ItemLocation();
	// 							$itemLocation->location_id = $v;
	// 							$itemLocation->item_id = $this->itemmaster->id;
	// 							$itemLocation->department_id = auth()->user()->department_id;
	// 							$itemLocation->unit_id = (isset($attributes['unit'][$key]) && $attributes['unit'][$key]!='')?$attributes['unit'][$key]:$unitdat->id;
	// 							$itemLocation->quantity = $attributes['locqty'][$k];
	// 							$itemLocation->status = 1;
	// 							$itemLocation->opn_qty = $attributes['locqty'][$k];
	// 							$itemLocation->bin_id = $attributes['binid'][$k];
	// 							//$itemLocation->doc_type = 'OQ';
	// 							$itemLocation->save();
	// 						}
	// 					}
	// 				}  
	// 			}
				
	// 		}
			
			
	// 		//Manufacture item row materials add.....
	// 		if($attributes['assembly']==1) { $a=1;
	// 			foreach($attributes['item_id'] as $ky => $item) { 
	// 				if($attributes['row_id'][$ky]!='') {
						
	// 					DB::table('mfg_items')
	// 								->where('id', $attributes['row_id'][$ky])
	// 								->update([
	// 									'subitem_id'	=> $attributes['item_id'][$ky],
	// 									'quantity'	=> $attributes['quantity'][$ky],
	// 									'unit_price'	=> $attributes['cost'][$ky],
	// 									'total'	=> $attributes['line_total'][$ky]
	// 								]);
						
	// 				} else {
						
	// 					if($item!='') { 
	// 						DB::table('mfg_items')
	// 								->insert([
	// 									'item_id'	=> $this->itemmaster->id,
	// 									'subitem_id'	=> $item,
	// 									'quantity'	=> $attributes['quantity'][$ky],
	// 									'unit_price'	=> $attributes['cost'][$ky],
	// 									'total'	=> $attributes['line_total'][$ky]
	// 								]);
	// 					}
	// 				}
	// 			}
				
	// 			if($attributes['remove_item']!='') {
					
	// 				$arrids = explode(',', $attributes['remove_item']);
	// 				foreach($arrids as $row) {
	// 					DB::table('mfg_items')->where('id', $row)->update(['deleted_at' => date('Y-m-d H:i:s')]);
	// 				}
	// 			}
	// 		}
			
	// 		$this->formatLogs($id);
			
			
	// 		//BATCH NO ENTRY............
	// 		$isbatch = (isset($attributes['batch_req']))?$attributes['batch_req']:'';
	// 		if($isbatch==1 && $attributes['batchNos']!='' && $attributes['mfgDates']!='' && $attributes['qtyBatchs']!='') {
			    
	// 		    $dtrow = DB::table('parameter1')->select('from_date')->first();
	// 		    $logrow = DB::table('item_log')->where('document_type', 'OQ')->where('item_id', $this->itemmaster->id)->where('packing', 1)->select('id')->first();
			    
	// 		    $batchArr = explode(',', $attributes['batchNos']);
	// 		    $mfgArr = explode(',', $attributes['mfgDates']);
	// 		    $expArr = explode(',', $attributes['expDates']);
	// 		    $qtyArr = explode(',', $attributes['qtyBatchs']);
	// 		    $bthidsArr = explode(',', $attributes['batchIds']);
	// 		    $remArr = explode(',', $attributes['batchRem']);
	// 		    //echo '<pre>';print_r($batchArr);print_r($bthidsArr);exit;
	// 		    foreach($batchArr as $bkey => $bval) {
			        
	// 		        if(isset($bthidsArr[$bkey]) && $bthidsArr[$bkey]!='') { //UPDATE...
			            
	// 		            DB::table('item_batch')
	// 		                            ->where('id', $bthidsArr[$bkey])
    //     				                ->update([
    //     				                    'batch_no' => $bval,
    //     				                    'mfg_date' => date('Y-m-d', strtotime($mfgArr[$bkey])),
    //     				                    'exp_date' => ($expArr[$bkey]!='')?date('Y-m-d', strtotime($expArr[$bkey])):'',
    //     				                    'quantity' => $qtyArr[$bkey]
    //     				                ]);
        				                
    //     				DB::table('batch_log')
    //     				                ->where('batch_id', $bthidsArr[$bkey])
    //     				                ->where('document_type','OQ')
    //     				                ->update([
    //     				                    'quantity' => $qtyArr[$bkey],
    //     				                    'modify_at' => date('Y-m-d h:i:s'),
    //     				                    'modify_by' => Auth::User()->id
    //     				                    ]);
        				                    
	// 		        } else {  //INSERT NEW....
			        
    // 			        $batch_id = DB::table('item_batch')
    //         				                ->insertGetId([
    //         				                    'item_id' => $this->itemmaster->id,
    //         				                    'batch_no' => $bval,
    //         				                    'mfg_date' => date('Y-m-d', strtotime($mfgArr[$bkey])),
    //         				                    'exp_date' => ($expArr[$bkey]!='')?date('Y-m-d', strtotime($expArr[$bkey])):'',
    //         				                    'quantity' => $qtyArr[$bkey]
    //         				                ]);
            				                
    //         			if($batch_id) {
    //         			    DB::table('batch_log')
    //     				                ->insert([
    //     				                    'batch_id' => $batch_id,
    //     				                    'item_id' => $this->itemmaster->id,
    //     				                    'document_type' => 'OQ',
    //     				                    'quantity' => $qtyArr[$bkey],
    //     				                    'trtype' => 1,
    //     				                    'invoice_date' => $dtrow->from_date,
    //     				                    'log_id' => $logrow->id,
    //     				                    'created_at' => date('Y-m-d h:i:s'),
    //     				                    'created_by' => Auth::User()->id
    //     				                    ]);
    //         			}	                
        				                
	// 		        }                
        				                
	// 		    }
			    
	// 		    //DELETE...
	// 		    foreach($remArr as $rem) {
			        
	// 		        DB::table('item_batch')->where('id',$rem)->update(['deleted_at' => date('Y-m-d h:i:s')]);
			        
	// 		        DB::table('batch_log')->where('batch_id',$rem)->where('document_type','OQ')->update(['deleted_at' => date('Y-m-d h:i:s'), 'deleted_by' => Auth::User()->id]);
	// 		    }
			
	// 		}

	// 		return true;
	// 	}
	// 	//throw new ValidationException('Itemmaster validation error!', $this->getErrors());
	// }


	public function update($id, $attributes) {
		DB::beginTransaction();
		try {
			if (!$this->isValid($attributes, ['item_code' => 'required'])) {
				DB::rollback();
				return false;
			}
			
			$this->itemmaster = $this->find($id);
			
			// Update basic item info
			$this->updateItemBasicInfo($attributes);
			
			// Update item units
			$this->updateItemUnits($id, $attributes);
			
			// Update locations
			$this->updateItemLocations($id, $attributes);
			
			// Update manufacturing items if assembly
			if(isset($attributes['assembly']) && $attributes['assembly'] == 1) {
				$this->updateMfgItems($id, $attributes);
			}
			
			// Update batch entries if batch required
			if(isset($attributes['batch_req']) && $attributes['batch_req'] == 1) {
				$this->updateBatchEntries($id, $attributes);
			}
			
			// Format item logs
			$this->formatLogs($id);
			
			DB::commit();
			return true;
			
		} catch(\Exception $e) {
			DB::rollback();
			Log::error('Item update failed: ' . $e->getMessage());
			throw $e;
		}
	}

	private function updateItemBasicInfo($attributes) {
		// Handle image upload
		$image = $attributes['current_image'];
		if (isset($attributes['image']) && $attributes['image']) {
			$image = $this->handleImageUpload($attributes['image']);
		}
		
		$this->itemmaster->fill([
			'item_code' => $attributes['item_code'],
			'description' => $attributes['description'],
			'description_ar' => $attributes['descriptionar'] ?? '',
			'class_id' => $attributes['item_class'],
			'model_no' => $attributes['model_no'],
			'serial_no' => $attributes['serial_no'],
			'group_id' => $attributes['group_id'],
			'subgroup_id' => $attributes['subgroup_id'],
			'category_id' => $attributes['category_id'],
			'subcategory_id' => $attributes['subcategory_id'],
			'assembly' => $attributes['assembly'],
			'image' => $image,
			'profit_per' => $attributes['profit_per'],
			'bin' => $attributes['machine_model'],
			'weight' => $attributes['size'],
			'other_info' => $attributes['other_info'],
			'modified_at' => now(),
			'modify_by' => Auth::id(),
			// ... other fields
		]);
		
		$this->itemmaster->save();
	}


	/**
	 * Update item units
	 */
	private function updateItemUnits($id, $attributes)
	{
		$departmentId = auth()->user()->department_id ?? 1;
		$dtrow = DB::table('parameter1')->select('from_date')->first();
		$c = 1;
		
		// Get existing item units
		$existingUnits = ItemUnit::where('itemmaster_id', $id)->get()->keyBy('id');
		$processedUnitIds = [];
		
		if (!isset($attributes['unit']) || !is_array($attributes['unit'])) {
			return;
		}
		
		foreach ($attributes['unit'] as $key => $val) {
			if (empty($val) && $c != 1) {
				continue; // Skip empty units except first one
			}
			
			// Determine unit ID
			if (empty($val)) {
				$unitdat = DB::table('units')->whereNull('deleted_at')->first();
				$unit_id = $unitdat->id;
				$packing = $unitdat->unit_name;
			} else {
				$unitdat = DB::table('units')->where('id', $val)->first();
				$unit_id = $val;
				$packing = $attributes['packing'][$key] ?? $unitdat->unit_name;
			}
			
			// Check if this unit already exists
			$itemUnitId = $attributes['item_unit_id'][$key] ?? null;
			
			if ($itemUnitId && isset($existingUnits[$itemUnitId])) {
				// Update existing unit
				$itemunit = $existingUnits[$itemUnitId];
				$processedUnitIds[] = $itemUnitId;
			} else {
				// Create new unit
				$itemunit = new ItemUnit();
				$itemunit->itemmaster_id = $id;
			}
			
			// Set unit data
			$itemunit->unit_id = $unit_id;
			$itemunit->packing = $packing;
			$itemunit->sell_price = $attributes['sell_price'][$key] ?? 0;
			$itemunit->wsale_price = $attributes['wsale_price'][$key] ?? 0;
			$itemunit->min_quantity = $attributes['min_quantity'][$key] ?? 0;
			$itemunit->reorder_level = $attributes['reorder_level'][$key] ?? 0;
			$itemunit->vat = $attributes['selvat'][0] ?? 0;
			$itemunit->pkno = $attributes['pkno'][$key] ?? 1;
			$itemunit->status = 1;
			
			// Handle opening quantity/cost updates (only for base unit)
			if ($c == 1) {
				$itemunit->is_baseqty = 1;
				
				// Check if quantities changed
				$newOpnQty = $attributes['opn_quantity'][$key] ?? 0;
				$newOpnCost = $attributes['opn_cost'][$key] ?? 0;
				
				if ($itemunit->exists) {
					// Calculate difference
					$qtyDiff = $newOpnQty - $itemunit->opn_quantity;
					$costDiff = $newOpnCost - $itemunit->opn_cost;
					
					// Update quantities
					$itemunit->opn_quantity = $newOpnQty;
					$itemunit->opn_cost = $newOpnCost;
					$itemunit->cur_quantity = $itemunit->cur_quantity + $qtyDiff;
					$itemunit->received_qty = $itemunit->received_qty + $qtyDiff;
					
					// Recalculate average cost
					if ($itemunit->cur_quantity > 0) {
						$totalCost = ($itemunit->cost_avg * ($itemunit->cur_quantity - $qtyDiff)) + ($newOpnCost * $qtyDiff);
						$itemunit->cost_avg = $totalCost / $itemunit->cur_quantity;
						$itemunit->last_purchase_cost = $newOpnCost;
					}
				} else {
					// New unit - set initial values
					$itemunit->opn_quantity = $newOpnQty;
					$itemunit->opn_cost = $newOpnCost;
					$itemunit->cur_quantity = $newOpnQty;
					$itemunit->received_qty = $newOpnQty;
					$itemunit->last_purchase_cost = $newOpnCost;
					$itemunit->cost_avg = $newOpnCost;
					$itemunit->pur_count = 1;
				}
			} else {
				$itemunit->is_baseqty = 0;
			}
			
			$itemunit->save();
			
			if ($c == 1 && !$itemunit->wasRecentlyCreated) {
				// Update department stock for base unit
				$this->updateDepartmentStockOnEdit($id, $attributes, $key, $unit_id, $departmentId);
			}
			
			$c++;
		}
		
		// Delete units that were removed
		$unitsToDelete = array_diff($existingUnits->pluck('id')->toArray(), $processedUnitIds);
		if (!empty($unitsToDelete)) {
			ItemUnit::whereIn('id', $unitsToDelete)->delete();
		}
	}

	/**
	 * Update department stock when editing item
	 */
	private function updateDepartmentStockOnEdit($itemmaster_id, $attributes, $key, $unit_id, $departmentId)
	{
		$dtrow = DB::table('parameter1')->select('from_date')->first();
		$newOpnQty = $attributes['opn_quantity'][$key] ?? 0;
		$newOpnCost = $attributes['opn_cost'][$key] ?? 0;
		$sellPrice = $attributes['sell_price'][$key] ?? 0;
		$wsalePrice = $attributes['wsale_price'][$key] ?? 0;
		$minQty = $attributes['min_quantity'][$key] ?? 0;
		$reorderLevel = $attributes['reorder_level'][$key] ?? 0;
		$vat = $attributes['selvat'][0] ?? 0;
		$pkno = $attributes['pkno'][$key] ?? 1;
		
		// Get current stock
		$currentStock = DB::table('itemstock_department')
			->where('itemmaster_id', $itemmaster_id)
			->where('department_id', $departmentId)
			->where('is_baseqty', 1)
			->first();
		
		if ($currentStock) {
			$qtyDiff = $newOpnQty - $currentStock->opn_quantity;
			
			DB::table('itemstock_department')
				->where('itemmaster_id', $itemmaster_id)
				->where('department_id', $departmentId)
				->where('is_baseqty', 1)
				->update([
					'opn_quantity' => $newOpnQty,
					'opn_cost' => $newOpnCost,
					'cur_quantity' => $currentStock->cur_quantity + $qtyDiff,
					'received_qty' => $currentStock->received_qty + $qtyDiff,
					'sell_price' => $sellPrice,
					'wsale_price' => $wsalePrice,
					'min_quantity' => $minQty,
					'reorder_level' => $reorderLevel,
					'vat' => $vat,
					'pkno' => $pkno,
					'last_purchase_cost' => $newOpnCost,
				]);
		} else {
			DB::table('itemstock_department')->insert([
				'itemmaster_id' => $itemmaster_id,
				'department_id' => $departmentId,
				'unit_id' => $unit_id,
				'packing' => $attributes['packing'][$key] ?? '',
				'opn_cost' => $newOpnCost,
				'opn_quantity' => $newOpnQty,
				'cur_quantity' => $newOpnQty,
				'received_qty' => $newOpnQty,
				'issued_qty' => 0,
				'min_quantity' => $minQty,
				'reorder_level' => $reorderLevel,
				'vat' => $vat,
				'is_baseqty' => 1,
				'pur_count' => 1,
				'last_purchase_cost' => $newOpnCost,
				'cost_avg' => $newOpnCost,
				'status' => 1,
				'sell_price' => $sellPrice,
				'wsale_price' => $wsalePrice,
				'pkno' => $pkno,
			]);
		}

		$oqLog = DB::table('item_log')
			->where('item_id', $itemmaster_id)
			->where('department_id', $departmentId)
			->where('document_type', 'OQ')
			->where('status', 1)
			->whereNull('deleted_at')
			->orderBy('id', 'desc')
			->first();

		if ($oqLog) {
			DB::table('item_log')
				->where('id', $oqLog->id)
				->update([
					'unit_id' => $unit_id,
					'quantity' => $newOpnQty,
					'unit_cost' => $newOpnCost,
					'cur_quantity' => $newOpnQty,
					'cost_avg' => $newOpnCost,
					'pur_cost' => $newOpnCost,
					'voucher_date' => $dtrow->from_date ?? now()->toDateString(),
				]);
		} else {
			DB::table('item_log')->insert([
				'document_type' => 'OQ',
				'department_id' => $departmentId,
				'item_id' => $itemmaster_id,
				'unit_id' => $unit_id,
				'quantity' => $newOpnQty,
				'unit_cost' => $newOpnCost,
				'trtype' => 1,
				'cur_quantity' => $newOpnQty,
				'cost_avg' => $newOpnCost,
				'pur_cost' => $newOpnCost,
				'sale_cost' => '',
				'packing' => 1,
				'status' => 1,
				'created_at' => now(),
				'created_by' => Auth::id(),
				'voucher_date' => $dtrow->from_date ?? now()->toDateString(),
			]);
		}
	}

	/**
	 * Update item locations
	 */
	private function updateItemLocations($id, $attributes)
	{
		$departmentId = auth()->user()->department_id ?? 1;
		
		// Get base unit
		$baseUnit = ItemUnit::where('itemmaster_id', $id)
			->where('is_baseqty', 1)
			->first();
		
		if (!$baseUnit) {
			return;
		}
		
		$unit_id = $baseUnit->unit_id;
		
		// Delete existing locations
		ItemLocation::where('item_id', $id)
			->where('department_id', $departmentId)
			->delete();
		
		if (isset($attributes['locid']) && isset($attributes['locqty'])) {
			// User specified locations
			foreach ($attributes['locid'] as $k => $v) {
				$itemLocation = new ItemLocation();
				$itemLocation->location_id = $v;
				$itemLocation->item_id = $id;
				$itemLocation->unit_id = $unit_id;
				$itemLocation->department_id = $departmentId;
				$itemLocation->quantity = $attributes['locqty'][$k] ?? 0;
				$itemLocation->status = 1;
				$itemLocation->opn_qty = $attributes['locqty'][$k] ?? 0;
				$itemLocation->bin_id = $attributes['binid'][$k] ?? 0;
				$itemLocation->save();
			}
			
			// Add remaining locations with zero quantity
			$allLocations = DB::table('location')
				->where('department_id', $departmentId)
				->where('status', 1)
				->whereNull('deleted_at')
				->pluck('id')
				->toArray();
			
			$missingLocations = array_diff($allLocations, $attributes['locid']);
			
			foreach ($missingLocations as $locationId) {
				$itemLocation = new ItemLocation();
				$itemLocation->location_id = $locationId;
				$itemLocation->item_id = $id;
				$itemLocation->unit_id = $unit_id;
				$itemLocation->department_id = $departmentId;
				$itemLocation->quantity = 0;
				$itemLocation->status = 1;
				$itemLocation->opn_qty = 0;
				$itemLocation->bin_id = 0;
				$itemLocation->save();
			}
		} else {
			// Add to all locations (default location gets opening quantity)
			$locations = DB::table('location')
				->where('department_id', $departmentId)
				->where('status', 1)
				->whereNull('deleted_at')
				->get();
			
			$opnQty = $attributes['opn_quantity'][0] ?? 0;
			
			foreach ($locations as $location) {
				$itemLocation = new ItemLocation();
				$itemLocation->location_id = $location->id;
				$itemLocation->item_id = $id;
				$itemLocation->unit_id = $unit_id;
				$itemLocation->department_id = $departmentId;
				$itemLocation->quantity = ($location->is_default == 1) ? $opnQty : 0;
				$itemLocation->status = 1;
				$itemLocation->opn_qty = ($location->is_default == 1) ? $opnQty : 0;
				$itemLocation->bin_id = 0;
				$itemLocation->save();
			}
		}
	}

	/**
	 * Update manufacturing items (BOM - Bill of Materials)
	 */
	private function updateMfgItems($id, $attributes)
	{
		// Delete existing manufacturing items
		DB::table('mfg_items')->where('item_id', $id)->delete();
		
		if (!isset($attributes['item_id']) || !is_array($attributes['item_id'])) {
			return;
		}
		
		foreach ($attributes['item_id'] as $key => $item) {
			if (empty($item)) {
				continue;
			}
			
			DB::table('mfg_items')->insert([
				'item_id' => $id,
				'subitem_id' => $item,
				'quantity' => $attributes['quantity'][$key] ?? 0,
				'unit_price' => $attributes['cost'][$key] ?? 0,
				'total' => $attributes['line_total'][$key] ?? 0
			]);
		}
	}

	/**
	 * Update batch entries
	 */
	private function updateBatchEntries($id, $attributes)
	{
		if (!isset($attributes['batchNos']) || empty($attributes['batchNos'])) {
			return;
		}
		
		if (!isset($attributes['mfgDates']) || !isset($attributes['qtyBatchs'])) {
			return;
		}
		
		// Delete existing batches
		DB::table('item_batch')->where('item_id', $id)->delete();
		DB::table('batch_log')->where('item_id', $id)->delete();
		
		$dtrow = DB::table('parameter1')->select('from_date')->first();
		$batchArr = explode(',', $attributes['batchNos']);
		$mfgArr = explode(',', $attributes['mfgDates']);
		$expArr = explode(',', $attributes['expDates']);
		$qtyArr = explode(',', $attributes['qtyBatchs']);
		
		foreach ($batchArr as $bkey => $bval) {
			if (empty($bval)) {
				continue;
			}
			
			$mfgDate = isset($mfgArr[$bkey]) && !empty($mfgArr[$bkey]) 
				? date('Y-m-d', strtotime($mfgArr[$bkey])) 
				: null;
			
			$expDate = isset($expArr[$bkey]) && !empty($expArr[$bkey]) 
				? date('Y-m-d', strtotime($expArr[$bkey])) 
				: null;
			
			$quantity = isset($qtyArr[$bkey]) ? (float)$qtyArr[$bkey] : 0;
			
			$batch_id = DB::table('item_batch')->insertGetId([
				'item_id' => $id,
				'batch_no' => trim($bval),
				'mfg_date' => $mfgDate,
				'exp_date' => $expDate,
				'quantity' => $quantity
			]);
			
			if ($batch_id) {
				// Create batch log
				$logrow = DB::table('item_log')
					->where('document_type', 'OQ')
					->where('item_id', $id)
					->where('packing', 1)
					->select('id')
					->first();
				
				if ($logrow) {
					DB::table('batch_log')->insert([
						'batch_id' => $batch_id,
						'item_id' => $id,
						'document_type' => 'OQ',
						'quantity' => $quantity,
						'trtype' => 1,
						'invoice_date' => $dtrow ? $dtrow->from_date : now(),
						'log_id' => $logrow->id,
						'created_at' => now(),
						'created_by' => Auth::id()
					]);
				}
			}
		}
	}

	
	
	public function delete($id)
	{
		$this->itemmaster = $this->itemmaster->find($id);
		$this->itemmaster->delete();
	}
	
	// public function getItemUnit($id)
	// {
	// 	return DB::table('item_unit AS u')
	// 		->leftJoin('itemstock_department AS ID', function($join) {
	// 			$join->on('ID.itemmaster_id', '=', 'u.itemmaster_id')
	// 				->on('ID.unit_id', '=', 'u.unit_id')
	// 				->on('ID.is_baseqty', '=', 'u.is_baseqty');
	// 		})
	// 		->where('u.itemmaster_id', $id)
	// 		->where('u.status', 1)
	// 		->where(function($query) {
	// 			$query->where('ID.department_id', auth()->user()->department_id ?? 1)
	// 				->orWhereNull('ID.department_id');
	// 		})
	// 		->orderBy('u.id', 'ASC')
	// 		->select(
	// 			'u.id as iuid', 
	// 			'u.unit_id',
	// 			'u.packing',
	// 			'u.pkno',
								
				
    //                    // All item_unit fields
	// 			'ID.opn_quantity as dept_opn_quantity',
	// 			'ID.opn_cost as dept_opn_cost',
	// 			'ID.cur_quantity',
	// 			'ID.received_qty',
	// 			'ID.issued_qty',
	// 			'ID.min_quantity as dept_min_quantity',
	// 			'ID.reorder_level as dept_reorder_level',
	// 			'ID.sell_price as dept_sell_price',
	// 			'ID.wsale_price as dept_wsale_price'
	// 		)
	// 		->get();
	// }

	public function getItemUnit($id)
	{
		return DB::table('item_unit as u')
			->join('itemstock_department as sd', function ($join) {
				$join->on('sd.itemmaster_id', '=', 'u.itemmaster_id');
				$join->on('sd.unit_id', '=', 'u.unit_id');
			})
			->where('u.itemmaster_id', $id)
			->where('sd.department_id', auth()->user()->department_id)
			// ->where('sd.deleted_at', '0000-00-00 00:00:00')
			->orderBy('u.id', 'ASC')
			->select([
				'u.id as iuid',
				'u.unit_id',
				'u.packing',
				'u.pkno',

				'sd.opn_quantity',
				'sd.opn_cost',
				'sd.sell_price',
				'sd.wsale_price',
				'sd.min_quantity',
				'sd.reorder_level',
				'sd.vat'
			])
			->get();
	}

	
	public function getItemUnits($id)
	{
		$query = $this->itemmaster->where('itemmaster.id', $id);
		
		return $query->join('item_unit AS u', function($join) {
							$join->on('u.itemmaster_id','=','itemmaster.id');
						})
						->join('units','units.id','=','u.unit_id')
						->orderBy('u.id','ASC')
						->select('u.*','units.unit_name')->get();
	}
	
	
	public function getItemUnitsArr($items)
	{
		foreach($items as $item) {
    		$query = $this->itemmaster->where('itemmaster.id', $item->item_id);
    		
    		$result[$item->item_id] = $query->join('item_unit AS u', function($join) {
    							$join->on('u.itemmaster_id','=','itemmaster.id');
    						})
    						->join('units','units.id','=','u.unit_id')
    						->orderBy('u.id','ASC')
    						->select('u.*','units.unit_name')->get();
		}
		return $result;
	}
	
	//paging count...
	public function getActiveItemListCount($mod)
	{	
		$query = $this->itemmaster->where('itemmaster.status', 1);
		
		$query->join('item_unit AS u', function($join) {
							$join->on('u.itemmaster_id','=','itemmaster.id');
						} )
						->join('itemstock_department AS ISD', function($join) {
							$join->on('ISD.itemmaster_id','=','itemmaster.id');
						} )
						->leftJoin('groupcat AS GC', function($join) {
							$join->on('GC.id','=','itemmaster.group_id');
						} );
						
						if($mod) {
							$val = ($mod=='ser')?2:1;
							$query->where('itemmaster.class_id',$val);
						}
						
		return $query->where('u.is_baseqty','=',1)->where('ISD.department_id','=',auth()->user()->department_id)->count();
	}
	
	//paging..
    public function getActiveItemList($mod=null,$type,$start,$limit,$order,$dir,$search)
	{
		$query = $this->itemmaster->where('itemmaster.status',1);
		
		$query->join('item_unit AS iu', function($join) {
							$join->on('iu.itemmaster_id','=','itemmaster.id');
							$join->where('iu.is_baseqty','=',1);
						} )
						->join('itemstock_department AS ISD', function($join) {
							$join->on('ISD.itemmaster_id','=','itemmaster.id');
							$join->where('ISD.department_id','=',auth()->user()->department_id);
						} )
						->join('units AS u', function($join) {
							$join->on('u.id','=','iu.unit_id');
						} );
						
						
						if($search) {
							$query->where('itemmaster.item_code','LIKE',"%{$search}%")
								  ->orWhere('itemmaster.description', 'LIKE',"%{$search}%");
						}
				
						if($mod) {
							$val = ($mod=='ser')?2:1;
							$query->where('itemmaster.class_id',$val);
						}
						
			 $query->groupBy('iu.itemmaster_id')
						//->orderBy('itemmaster.description','ASC')
						->select('itemmaster.id','itemmaster.item_code','itemmaster.model_no','itemmaster.description','itemmaster.description_ar','ISD.vat','itemmaster.class_id',
						'u.unit_name',DB::raw('CASE WHEN ISD.cost_avg IS NULL OR ISD.cost_avg = 0 THEN iu.cost_avg ELSE ISD.cost_avg END AS cost_avg'),'ISD.sell_price','ISD.last_purchase_cost AS pur_cost','ISD.cur_quantity','itemmaster.itmLt','itemmaster.itmWd','itemmaster.batch_req')
						->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir);
					if($type=='get')
						return $query->get();
					else
						return $query->count();
	}

	
	public function itemmasterList($type, $start, $limit, $order, $dir, $search)
	{	
		$query = $this->itemmaster->where('itemmaster.status', 1);
		
		// Add the conditions INSIDE the join (like you did in itemmasterListCount)
		$query->join('item_unit AS u', function($join) {
					$join->on('u.itemmaster_id', '=', 'itemmaster.id')
						->where('u.is_baseqty', 1);  // ← MOVED HERE
				})
				->join('itemstock_department AS ID', function($join) {
					$join->on('ID.itemmaster_id', '=', 'itemmaster.id')
						->where('ID.department_id', auth()->user()->department_id); // ← MOVED HERE
				})
				->leftJoin('groupcat AS GC', function($join) {
					$join->on('GC.id', '=', 'itemmaster.group_id');
				})
				->leftJoin('groupcat AS GS', function($join) {
					$join->on('GS.id', '=', 'itemmaster.subgroup_id');
				})
				->leftJoin('category AS C', function($join) {
					$join->on('C.id', '=', 'itemmaster.category_id');
				})
				->leftJoin('category AS S', function($join) {
					$join->on('S.id', '=', 'itemmaster.subcategory_id');
				});
		
		if($search) {
			$query->where(function($qry) use($search) {
				$qry->where('item_code', 'LIKE', "%{$search}%")
					->orWhere('itemmaster.description', 'LIKE', "%{$search}%")
					->orWhere('GC.description', 'LIKE', "%{$search}%");
			});
		}
		
		// REMOVE these lines - they're now in the join conditions above
		// $query->where('u.is_baseqty', 1)
		//       ->where('ID.department_id', auth()->user()->department_id);
		
		$query->select(
				'itemmaster.*',
				'ID.cur_quantity AS quantity',
				'ID.received_qty',
				'ID.opn_quantity',
				'C.category_name AS category',
				'S.category_name AS subcategory',
				'ID.last_purchase_cost',
				DB::raw('CASE WHEN ID.cost_avg IS NULL OR ID.cost_avg = 0 THEN u.cost_avg ELSE ID.cost_avg END AS cost_avg'),
				'ID.issued_qty',
				'u.packing',
				'GC.description AS group_name',
				'u.reorder_level',
				'ID.sell_price',
				'GS.description AS subgroup'
			)
			->groupBy('u.itemmaster_id')
			->offset($start)
			->limit($limit)
			->orderBy($order, $dir);
		
		if($type == 'get')
			return $query->get();
		else
			return $query->count();
	}
	
	
	// public function itemmasterListCount()
	// {	
	// 	$query = $this->itemmaster->where('itemmaster.status', 1);
		
	// 	return $query->join('item_unit AS u', function($join) {
	// 						$join->on('u.itemmaster_id','=','itemmaster.id');
	// 					} )
	// 					->leftJoin('groupcat AS GC', function($join) {
	// 						$join->on('GC.id','=','itemmaster.group_id');
	// 					} )
	// 					->where('u.is_baseqty','=',1)
	// 					//->groupBy('u.itemmaster_id')
	// 					//->select('itemmaster.*','u.cur_quantity AS quantity','u.received_qty','u.last_purchase_cost','u.cost_avg','u.issued_qty','GC.description AS group_name')
	// 					->count();
	// }

	public function itemmasterListCount()
	{
		$departmentId = auth()->user()->department_id ?? 1;
		return $this->itemmaster
		->where('itemmaster.status', 1)
		->join('item_unit AS u', function ($join) {
			$join->on('u.itemmaster_id','=','itemmaster.id')
				->where('u.is_baseqty', 1);
		})
		->join('itemstock_department AS ID', function ($join) use ($departmentId) {
			$join->on('ID.itemmaster_id','=','itemmaster.id')
				->where('ID.department_id', $departmentId);
		})
		->count();

	}

	
	public function activeItemmasterList()
	{
		return $this->itemmaster->where('status', 1)->orderBy('description','ASC')->select('id','item_code','description')->get();
	}
	
	public function itemmasterView($id)
	{
		return $this->itemmaster->where('id', $id);
	}
	
	public function check_item_code($item_code, $id = null) {
		
		if($id)
			return $this->itemmaster->where('item_code',$item_code)->where('id', '!=', $id)->count();
		else
			return $this->itemmaster->where('item_code',$item_code)->count();
	}
	
	public function check_item_description($description, $id = null) {
		
		if($id)
			return $this->itemmaster->where('description',$description)->where('id', '!=', $id)->count();
		else
			return $this->itemmaster->where('description',$description)->count();
	}
	
	public function getActiveItemmasterList($mod=null)
	{
		$query = $this->itemmaster->where('itemmaster.status',1);
		
		$query->join('item_unit AS iu', function($join) {
							$join->on('iu.itemmaster_id','=','itemmaster.id');
						} )
						->join('units AS u', function($join) {
							$join->on('u.id','=','iu.unit_id');
						} );
						
						if($mod) {
							$val = ($mod=='ser')?2:1;
							$query->where('itemmaster.class_id',$val);
						}
						//->orderBy('iu.id','ASC')
						
			return $query->groupBy('iu.itemmaster_id')
						->orderBy('itemmaster.description','ASC')
						->select('itemmaster.id','itemmaster.item_code','itemmaster.model_no','itemmaster.description','iu.vat','itemmaster.class_id',
						'u.unit_name','iu.cost_avg','iu.sell_price','iu.last_purchase_cost AS pur_cost','iu.cur_quantity')->get();
		//return $this->itemmaster->where('status', 1)->orderBy('description','ASC')->select('id','item_code','description')->get();
	}
	
	public function getItemmasterSearch($search, $type)
	{

		$query = $this->itemmaster->where('itemmaster.status',1);

		$query->join('item_unit AS iu', function($join) {
							$join->on('iu.itemmaster_id','=','itemmaster.id');
						} )
						->join('units AS u', function($join) {
							$join->on('u.id','=','iu.unit_id');
						} );
					if($type=='C') {
						$query->where(function($qry) use($search) {
							$qry->where('itemmaster.item_code','LIKE',"%{$search}%")
								->orWhere('itemmaster.description','LIKE',"%{$search}%");
						});
					} else
						$query->where('itemmaster.description','LIKE','%'.$search.'%');
						
				  $query->groupBy('iu.itemmaster_id')
						->orderBy('itemmaster.description','ASC');
						
		return $query->select('itemmaster.id','itemmaster.item_code','itemmaster.description','iu.vat','u.unit_name','iu.cost_avg','iu.sell_price')->get();


	}
	
	public function getUnits($id)
	{
		$query = $this->itemmaster->where('itemmaster.id', $id);
		
		return $query->join('item_unit AS u', function($join) {
							$join->on('u.itemmaster_id','=','itemmaster.id');
						} )
						->join('units AS us', function($join) {
							$join->on('us.id','=','u.unit_id');
						} )
						->select('us.unit_name','us.id','u.id AS item_unit_id','u.cur_quantity','u.is_baseqty')
						->orderBy('u.is_baseqty','DESC')->get();
	}
	
	public function getVatByUnit($id,$item=null) 
	{
		return $result = DB::table('item_unit')->where('itemmaster_id',$item)->where('unit_id', $id)->first();
	}
	
	public function getItemInfo($id)
	{
		return $result = DB::table('item_unit')
							->join('itemmaster', 'itemmaster.id', '=', 'item_unit.itemmaster_id')
			                ->join('units', 'units.id', '=', 'item_unit.unit_id')
							->where('item_unit.itemmaster_id', $id)
							->select('units.unit_name','item_unit.cur_quantity','item_unit.sell_price','item_unit.cost_avg','item_unit.reorder_level','itemmaster.itmWd','itemmaster.itmLt',
							         'itemmaster.mpqty','item_unit.is_baseqty','item_unit.packing','item_unit.pkno')
							->orderBy('item_unit.is_baseqty','DESC')->get();
	}
	
	
	public function getRawmat($id)
	{
		
		return DB::table('mfg_items')->where('mfg_items.item_id', $id)
								->join('itemmaster AS IM', 'IM.id', '=', 'mfg_items.subitem_id')
								->join('item_unit AS IU', 'IU.itemmaster_id', '=', 'IM.id')
								->whereNull('mfg_items.deleted_at')
								->where('IU.is_baseqty',1)//AUG25
								->select('mfg_items.*','IU.unit_id','IM.item_code','IM.description')
								->get();
								
	}
	
	
	public function itemenquiryList()
	{
		//return $this->itemmaster->get();
		$query = $this->itemmaster->where('itemmaster.status', 1);
		
		return $query->join('item_unit AS u', function($join) {
							$join->on('u.itemmaster_id','=','itemmaster.id');
						} )
						->where('u.is_baseqty','=',1)
						->select('itemmaster.*','u.cur_quantity AS quantity','u.received_qty','u.last_purchase_cost','u.cost_avg','u.packing','u.sell_price','u.wsale_price','u.issued_qty')
						->get();
	}
	
	public function getLastPurchaseCost($attributes)
	{
		$result = DB::table('purchase_invoice')
							->join('purchase_invoice_item', 'purchase_invoice_item.purchase_invoice_id', '=', 'purchase_invoice.id')
							->where('purchase_invoice_item.item_id', $attributes['item_id'])
							->where('purchase_invoice_item.unit_id', $attributes['unit_id'])
							->where('purchase_invoice.supplier_id', $attributes['supplier_id'])
							->select('purchase_invoice_item.unit_price')
							->orderBy('purchase_invoice.id','DESC')
							->first();
							
		if(!$result) {
			
			$result = DB::table('item_unit')
							->where('item_unit.itemmaster_id', $attributes['item_id'])
							->where('item_unit.unit_id', $attributes['unit_id'])
							->select('item_unit.opn_cost AS unit_price')//->select('item_unit.cost_avg AS unit_price')
							->first();
							
		}
		
		return $result;
	}
	
	public function getLastSaleCost($attributes)
	{
		$result = DB::table('sales_invoice')
							->join('sales_invoice_item', 'sales_invoice_item.sales_invoice_id', '=', 'sales_invoice.id')
							->where('sales_invoice_item.item_id', $attributes['item_id'])
							//->where('sales_invoice_item.unit_id', $attributes['unit_id'])
							->where('sales_invoice.customer_id', $attributes['customer_id'])
							->select('sales_invoice_item.unit_price')
							->orderBy('sales_invoice.id','DESC')
							->first(); 
		if(!$result) {
			
			$qry = DB::table('item_unit')->where('item_unit.itemmaster_id', $attributes['item_id']);
							
					if($attributes['unit_id']!='')
							$qry->where('item_unit.unit_id', $attributes['unit_id']);
							
				$result = $qry->select('item_unit.sell_price AS unit_price') //cost_avg
							    ->first();
							
		}
		
		return $result;
	}
	
	public function getSaleCostAvg($attributes)
	{
		$result = DB::table('item_unit')
							->where('item_unit.itemmaster_id', $attributes['item_id'])
							->select('item_unit.sell_price AS unit_price')
							->first(); 
		
		if(!$result || $result->unit_price=='' || $result->unit_price==0) {
			
			$result = DB::table('item_unit')
							->where('item_unit.itemmaster_id', $attributes['item_id'])
							->select('item_unit.cost_avg AS unit_price')
							->first();
		}
		
		return $result;
	}
	
	public function getCostAvg($attributes)
	{
		
		$qry = DB::table('item_unit')
							->where('item_unit.itemmaster_id', $attributes['item_id']);
							
						if($attributes['unit_id']!='')
							$qry->where('item_unit.unit_id', $attributes['unit_id']);
							
		return $result = $qry->select('item_unit.cost_avg')->first();
		
	}
	
	
	public function getCostAvgMfg($attributes)
	{
		$itm = DB::table('itemmaster')->where('id', $attributes['item_id'])->select('assembly')->first();
		if($itm->assembly==1) {
			
			return $result = DB::table('mfg_items')->where('item_id', $attributes['item_id'])
									// ->where('deleted_at', '0000-00-00 00:00:00')
									->whereNull('deleted_at')
									->select(DB::raw('SUM(total) AS cost_avg'))->first();
		} else {
			$qry = DB::table('item_unit')
								->where('item_unit.itemmaster_id', $attributes['item_id']);
								
							if($attributes['unit_id']!='')
								$qry->where('item_unit.unit_id', $attributes['unit_id']);
								
			return $result = $qry->select('item_unit.cost_avg')->first();
		}
	}
	
	
	public function getCostSale($attributes)
	{
		$query = DB::table('item_unit')
							->where('item_unit.itemmaster_id', $attributes['item_id']);
						if(isset($attributes['unit_id']))
							$query->where('item_unit.unit_id', $attributes['unit_id']);
						
				return $query->select('item_unit.sell_price AS cost_avg')
							->first();
		
	}
	
	public function getItemCostAvg($attributes)
	{
		
		return $result = DB::table('item_unit')
							->where('item_unit.itemmaster_id', $attributes['item_id'])
							->select('item_unit.cost_avg AS unit_price')
							->first();
		
	}
	
	public function getQuantityReport($attributes)
	{
		$result = array();
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):'';
		$dt = DB::table('parameter1')->select('from_date')->first();
		$date_from = $dt->from_date;
	
		if($attributes['search_type']=='opening_quantity') {
			//echo '<pre>';print_r($date_from);exit;
			$query = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->join('itemstock_department AS ISD', function($join) {
								$join->on('ISD.itemmaster_id','=','itemmaster.id');
							} )
							->join('item_log AS IL', function($join) {
								$join->on('IL.item_id','=','itemmaster.id');
							} )
							->where('IL.document_type','OQ')
							->where('IL.status',1)
							
							->where('IL.department_id',auth()->user()->department_id)
							->whereNull('IL.deleted_at')
							->where('ISD.department_id',auth()->user()->department_id)
							->where('ISD.is_baseqty','=',1);
							
			if(($date_from!='') && ($date_to!='')) {
				$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
				$query->whereBetween('IL.voucher_date', array($date_from, $date_to));
			}
			
						if($attributes['itemtype']!='')
							$query->where('itemmaster.class_id', $attributes['itemtype']);
						
						if(isset($attributes['group_id']) && $attributes['group_id']!='')
							$query->whereIn('itemmaster.group_id', $attributes['group_id']);
						
						if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
							$query->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
						
						if(isset($attributes['category_id']) && $attributes['category_id']!='')
							$query->whereIn('itemmaster.category_id', $attributes['category_id']);
						
						if(isset($attributes['subcategory_id']) && $attributes['subcategory_id']!='' )
							$query->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
						
						
						
						if(isset($attributes['document_id'])&& $attributes['document_id']!='' )
							$query->whereIn('itemmaster.id', $attributes['document_id']);
						
						$quantity_col = 'ISD.opn_quantity'; 
						
						if($attributes['quantity_type']=='minus')
							$query->where($quantity_col, '<', 0);
						else if($attributes['quantity_type']=='positive')
							$query->where($quantity_col, '>', 0);
						else if($attributes['quantity_type']=='zero')
							$query->where($quantity_col,0);
						else if($attributes['quantity_type']=='nonzero')
							$query->where($quantity_col,'!=',0);
							
			$result = $query->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','itemmaster.mpqty','itemmaster.p1_qty','itemmaster.p2_qty','IL.*','ISD.packing','ISD.opn_cost','ISD.opn_quantity','itemmaster.bin_location')->get()->toArray();
		
			return $result;
		
		} else if($attributes['search_type']=='qtyhand_ason_date' || $attributes['search_type']=='price_list_qty') {
			
			$date_to = ($attributes['date_to']=='')?date('Y-m-d'):date('Y-m-d', strtotime($attributes['date_to']));
			$query = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->join('itemstock_department AS ISD', function($join) {
								$join->on('ISD.itemmaster_id','=','itemmaster.id');
							} )
							->join('item_log AS IL', function($join) {
								$join->on('IL.item_id','=','itemmaster.id');
							} )
							->where('IL.status',1)
							->where('ISD.department_id',auth()->user()->department_id)
							->where('IL.department_id',auth()->user()->department_id)
							->whereNull('IL.deleted_at')
							->where('u.is_baseqty','=',1);
				
				if(($date_from!='') && ($date_to!='')) {
					$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
					$query->whereBetween('IL.voucher_date', array($date_from, $date_to));
				}
				
				//$query->whereBetween('IL.voucher_date', array($date_from, $date_to));
						
						if(isset($attributes['document_id']) && $attributes['document_id']!='')
							$query->whereIn('itemmaster.id', $attributes['document_id']);
						
						if(isset($attributes['itemtype']) && $attributes['itemtype']!='')
							$query->where('itemmaster.class_id', $attributes['itemtype']);
						
						if(isset($attributes['group_id']) && $attributes['group_id']!='')
							$query->whereIn('itemmaster.group_id', $attributes['group_id']);
						
						if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
							$query->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
						
						if(isset($attributes['category_id']) && $attributes['category_id']!='') {
							$query->whereIn('itemmaster.category_id', $attributes['category_id'])
							->orWhereIn('IL.category_id', $attributes['category_id']);
						}
						
						if(isset($attributes['subcategory_id'])&& $attributes['subcategory_id']!='')
							$query->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
						
						/*$quantity_col = 'u.cur_quantity'; 
						
						if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='minus')
							$query->where($quantity_col, '<', 0);
						else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='positive')
							$query->where($quantity_col, '>', 0);
						else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='zero')
							$query->where($quantity_col,0);
						else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='nonzero')
							$query->where($quantity_col,'!=',0);*/
							
			$result = $query->select('itemmaster.id','itemmaster.item_code','itemmaster.description','itemmaster.mpqty',
			                    'itemmaster.p1_qty','itemmaster.p2_qty','IL.*','ISD.packing','ISD.opn_cost','ISD.opn_quantity','itemmaster.bin_location','ISD.sell_price','itemmaster.p1_formula','itemmaster.p2_formula',
			                    DB::raw("(SELECT IL2.pur_cost FROM item_log as IL2 WHERE (IL.item_id=IL2.item_id) AND (IL2.document_type='PI') AND IL2.status=1 AND IL2.deleted_at IS NULL ORDER BY IL2.id DESC LIMIT 1) AS pr_cost")
			                    )
			                    ->orderBy('IL.voucher_date')->get()->toArray();
		
			return $result;
		
	} else if($attributes['search_type']=='qtyhand_ason_priordate') {
			
			$query = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->join('itemstock_department AS ISD', function($join) {
								$join->on('ISD.itemmaster_id','=','itemmaster.id');
							} )
							->join('item_log AS IL', function($join) {
								$join->on('IL.item_id','=','itemmaster.id');
							} )
							->where('IL.status',1)
							->where('IL.department_id',auth()->user()->department_id)
							->where('ISD.department_id',auth()->user()->department_id)
							->whereNull('IL.deleted_at')
							->where('u.is_baseqty','=',1);
							
			if(($date_from!='') && ($date_to!='')) {
				$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
				$query->whereBetween('IL.voucher_date', array($date_from, $date_to));
			}
						if(isset($attributes['document_id']) && $attributes['document_id']!='')
							$query->whereIn('itemmaster.id', $attributes['document_id']);
						
						if($attributes['itemtype']!='')
							$query->where('itemmaster.class_id', $attributes['itemtype']);
						
						if(isset($attributes['group_id']) && $attributes['group_id']!='')
							$query->whereIn('itemmaster.group_id', $attributes['group_id']);
						
						if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
							$query->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
						
						if(isset($attributes['category_id']) && $attributes['category_id']!='')
							$query->whereIn('itemmaster.category_id', $attributes['category_id']);
						
						if(isset($attributes['subcategory_id']) && $attributes['subcategory_id']!='')
							$query->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
						
						/*$quantity_col = 'u.cur_quantity'; 
						
						if($attributes['quantity_type']=='minus')
							$query->where($quantity_col, '<', 0);
						else if($attributes['quantity_type']=='positive')
							$query->where($quantity_col, '>', 0);
						else if($attributes['quantity_type']=='zero')
							$query->where($quantity_col,0);
						else if($attributes['quantity_type']=='nonzero')
							$query->where($quantity_col,'!=',0);*/
							
			$result = $query->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','itemmaster.mpqty','itemmaster.p1_qty','itemmaster.p2_qty','IL.*','ISD.packing','ISD.opn_cost','ISD.opn_quantity','itemmaster.bin_location',
			                DB::raw("(SELECT IL2.pur_cost FROM item_log as IL2 WHERE (IL.item_id=IL2.item_id) AND (IL2.document_type='PI') AND IL2.status=1 AND IL2.deleted_at IS NULL ORDER BY IL2.id DESC LIMIT 1) AS pr_cost"))
			                ->orderBy('IL.voucher_date')->get()->toArray();
		
			return $result;
			
	} else if($attributes['search_type']=='qtyhand_ason_date_loc' || $attributes['search_type']=='qtyhand_ason_priordate_loc') { 
			//echo '<pre>';print_r($attributes);exit;
			if($attributes['search_type']=='qtyhand_ason_date_loc')
				$date_to = ($attributes['date_to']=='')?date('Y-m-d'):date('Y-m-d', strtotime($attributes['date_to']));
			
			//OPENING QUANTITY
			$query0 = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) { $join->on('u.itemmaster_id','=','itemmaster.id'); })
							->join('itemstock_department AS ISD', function($join) { $join->on('ISD.itemmaster_id','=','itemmaster.id'); })
							->join('item_log AS ILG', function($join) { $join->on('ILG.item_id','=','itemmaster.id'); })
							->join('item_location AS IL','IL.item_id','=','itemmaster.id')
							->join('location AS L','L.id','=','IL.location_id')->where('ISD.department_id',auth()->user()->department_id) 							
							->where('ILG.document_type','OQ')->where('IL.status',1)->where('ILG.department_id',auth()->user()->department_id)
							->whereNull('IL.deleted_at')->where('IL.department_id',auth()->user()->department_id)
							->where('ILG.status',1)->where('ILG.deleted_at')->where('u.is_baseqty','=',1)
							->whereNull('L.deleted_at')->where('L.department_id',auth()->user()->department_id)
;
						
				if(($date_from!='') && ($date_to!='')) {
					$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
					$query0->whereBetween('ILG.voucher_date', array($date_from, $date_to));
				}
				
				if(isset($attributes['document_id']) && $attributes['document_id']!='')
					$query0->whereIn('itemmaster.id', $attributes['document_id']);
			
				if(isset($attributes['location_id']) && ($attributes['location_id']!='all'))
					$query0->whereIn('IL.location_id', $attributes['location_id']);
			
				if(isset($attributes['account_id']) && ($attributes['account_id']!='all'))
					$query0->whereIn('L.customer_id', $attributes['account_id']);
			
				if($attributes['itemtype']!='')
					$query0->where('itemmaster.class_id', $attributes['itemtype']);
			
				if(isset($attributes['group_id']) && $attributes['group_id']!='')
					$query0->whereIn('itemmaster.group_id', $attributes['group_id']);
			
				if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
					$query0->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
			
				if(isset($attributes['category_id'])&& $attributes['category_id']!='')
					$query0->whereIn('itemmaster.category_id', $attributes['category_id']);
			
				if(isset($attributes['subcategory_id']) && $attributes['subcategory_id']!='')
					$query0->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
				
				/*$quantity_col = 'u.opn_quantity'; 
				$quantity_col2 = 'IL.opn_qty'; 
			
				if($attributes['quantity_type']=='minus')
					$query0->where($quantity_col, '<', 0)->where($quantity_col2, '<', 0);
				else if($attributes['quantity_type']=='positive')
					$query0->where($quantity_col, '>', 0)->where($quantity_col2, '<', 0);
				else if($attributes['quantity_type']=='zero')
					$query0->where($quantity_col,0)->where($quantity_col2, '<', 0);
				else if($attributes['quantity_type']=='nonzero')
					$query0->where($quantity_col,'!=',0)->where($quantity_col2, '<', 0);*/
			
			$query0->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','L.code','L.name','ILG.id AS logid','ISD.packing',
						'ILG.voucher_date',DB::raw('"1" AS trtype'),'ILG.cost_avg','ILG.pur_cost','IL.item_id','IL.unit_id','IL.opn_qty AS quantity','L.id AS location_id','itemmaster.bin_location');
						
			//$res = $query0->get()->toArray();echo '<pre>';print_r($res);exit;			
						
			//TRANSFER OUT
			$query1 = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) { $join->on('u.itemmaster_id','=','itemmaster.id'); })
							->join('itemstock_department AS ISD', function($join) { $join->on('ISD.itemmaster_id','=','itemmaster.id'); })
							->join('item_log AS ILG', function($join) { $join->on('ILG.item_id','=','itemmaster.id'); })
							->Join('item_location_to AS LSI', function($join) {
								$join->on('LSI.logid','=','ILG.id')->where('LSI.status','=',1)->whereNull('LSI.deleted_at');//->where('LSI.deleted_at');
							})
							->join('location AS L','L.id','=','LSI.location_id')
							->where('ISD.department_id',auth()->user()->department_id)->where('L.department_id',auth()->user()->department_id)
							->where('ILG.status',1)->where('ILG.department_id',auth()->user()->department_id)
							->whereNull('ILG.deleted_at')->where('u.is_baseqty','=',1) //->where('LSI.is_sdo',0)
							->whereNull('L.deleted_at');
							/*->join('item_unit AS u', function($join) { $join->on('u.itemmaster_id','=','itemmaster.id'); })
							->join('location_transfer_item AS LTI', function($join) { $join->on('LTI.item_id','=','itemmaster.id'); })
							->Join('location_transfer AS LT', function($join) {
								$join->on('LT.id','=','LTI.location_transfer_id')->where('LT.status','=',1)->where('LT.deleted_at');
							})
							->join('location AS L','L.id','=','LT.locto_id') 
							->where('LTI.status',1)->where('LTI.deleted_at')->where('u.is_baseqty','=',1)
							->where('L.deleted_at');*/
							
				if(($date_from!='') && ($date_to!='')) {
					$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
					$query1->whereBetween('ILG.voucher_date', array($date_from, $date_to));
				}
						
				if(isset($attributes['document_id']) && $attributes['document_id']!='')
					$query1->whereIn('itemmaster.id', $attributes['document_id']);
			
				if(isset($attributes['location_id']) && ($attributes['location_id']!='all'))
					$query1->whereIn('LSI.location_id', $attributes['location_id']);
			
				if(isset($attributes['account_id']) && ($attributes['account_id']!='all'))
					$query1->whereIn('L.customer_id', $attributes['account_id']);
			
				if($attributes['itemtype']!='')
					$query1->where('itemmaster.class_id', $attributes['itemtype']);
			
				if(isset($attributes['group_id']) && $attributes['group_id']!='')
					$query1->whereIn('itemmaster.group_id', $attributes['group_id']);
			
				if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
					$query1->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
			
				if(isset($attributes['category_id'])&& $attributes['category_id']!='')
					$query1->whereIn('itemmaster.category_id', $attributes['category_id']);
			
				if(isset($attributes['subcategory_id'])&& $attributes['subcategory_id']!='')
					$query1->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
				
			/*	$quantity_col = 'u.cur_quantity'; 
				if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='minus')
					$query1->where($quantity_col, '<', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='positive')
					$query1->where($quantity_col, '>', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='zero')
					$query1->where($quantity_col,0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='nonzero')
					$query1->where($quantity_col,'!=',0);*/
						
			$query1->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','L.code','L.name','ILG.id AS logid','ISD.packing',
						'ILG.voucher_date','ILG.trtype','ILG.cost_avg','ILG.pur_cost','LSI.item_id','LSI.unit_id','LSI.quantity','L.id AS location_id','itemmaster.bin_location')
						->orderBy('ILG.voucher_date');
						
			/*$query1->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','L.code','L.name','LT.id AS logid','u.packing',
						'LT.voucher_date',DB::raw('"1" AS trtype'),DB::raw('"0" AS cost_avg'),DB::raw('"0" AS pur_cost'),'LTI.item_id','LTI.unit_id','LTI.quantity','L.id AS location_id','itemmaster.bin_location');*/
			

			//TRANSFER IN 
			$query4 = $this->itemmaster->where('itemmaster.status', 1)	
			                ->join('item_unit AS u', function($join) { $join->on('u.itemmaster_id','=','itemmaster.id'); })
							->join('itemstock_department AS ISD', function($join) { $join->on('ISD.itemmaster_id','=','itemmaster.id'); })
                            ->join('item_log AS ILG', function($join) { $join->on('ILG.item_id','=','itemmaster.id'); })
							->Join('item_location_ti AS LSI', function($join) {
								$join->on('LSI.logid','=','ILG.id')->where('LSI.status','=',1)->whereNull('LSI.deleted_at');//->where('LSI.deleted_at');
							})
							->join('location AS L','L.id','=','LSI.location_id')->where('ISD.department_id',auth()->user()->department_id) 
							->where('ILG.status',1)->where('ILG.department_id',auth()->user()->department_id)
							->whereNull('ILG.deleted_at')->where('u.is_baseqty','=',1) //->where('LSI.is_sdo',0)
							->whereNull('L.deleted_at');
							
						/*	->join('location AS L','L.id','=','LSI.location_id') 
							->where('ILG.status',1)->where('ILG.deleted_at')->where('u.is_baseqty','=',1)//->where('LSI.is_do',0)
							->where('L.deleted_at');
							->join('item_unit AS u', function($join) { $join->on('u.itemmaster_id','=','itemmaster.id'); })
							->join('location_transfer_item AS LTI', function($join) { $join->on('LTI.item_id','=','itemmaster.id'); })
							->Join('location_transfer AS LT', function($join) {
								$join->on('LT.id','=','LTI.location_transfer_id')->where('LT.status','=',1)->where('LT.deleted_at');
							})
							->join('location AS L','L.id','=','LT.locfrom_id') 
							->where('LTI.status',1)->where('LTI.deleted_at')->where('u.is_baseqty','=',1)
							->where('L.deleted_at');*/
							
				if(($date_from!='') && ($date_to!='')) {
					$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
					$query4->whereBetween('ILG.voucher_date', array($date_from, $date_to));
				}
						
				if(isset($attributes['document_id']) && $attributes['document_id']!='')
					$query4->whereIn('itemmaster.id', $attributes['document_id']);
			
				if(isset($attributes['location_id']) && ($attributes['location_id']!='all'))
					$query4->whereIn('LSI.location_id', $attributes['location_id']);
			
				if(isset($attributes['account_id']) && ($attributes['account_id']!='all'))
					$query4->whereIn('L.customer_id', $attributes['account_id']);
			
				if($attributes['itemtype']!='' )
					$query4->where('itemmaster.class_id', $attributes['itemtype']);
			
				if(isset($attributes['group_id']) && $attributes['group_id']!='')
					$query4->whereIn('itemmaster.group_id', $attributes['group_id']);
			
				if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
					$query4->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
			
				if(isset($attributes['category_id']) && $attributes['category_id']!='')
					$query4->whereIn('itemmaster.category_id', $attributes['category_id']);
			
				if(isset($attributes['subcategory_id'])&& $attributes['subcategory_id']!='')
					$query4->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
			
			/*	$quantity_col = 'u.cur_quantity'; 
				if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='minus')
					$query4->where($quantity_col, '<', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='positive')
					$query4->where($quantity_col, '>', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='zero')
					$query4->where($quantity_col,0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='nonzero')
					$query4->where($quantity_col,'!=',0); */
			
			$query4->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','L.code','L.name','ILG.id AS logid','ISD.packing',
						'ILG.voucher_date','ILG.trtype','ILG.cost_avg','ILG.pur_cost','LSI.item_id','LSI.unit_id','LSI.quantity','L.id AS location_id','itemmaster.bin_location')
						->orderBy('ILG.voucher_date');
						
			/*$query4->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','L.code','L.name','LT.id AS logid','u.packing',
						'LT.voucher_date',DB::raw('"0" AS trtype'),DB::raw('"0" AS cost_avg'),DB::raw('"0" AS pur_cost'),'LTI.item_id','LTI.unit_id','LTI.quantity','L.id AS location_id','itemmaster.bin_location');*/
						
			//$res = $query4->get()->toArray();echo '<pre>';print_r($res);exit;	
			
			
			//LOCATION TRANSFER (FROM LOCATION) 
			$query9 = $this->itemmaster->where('itemmaster.status', 1)	
							->join('item_unit AS u', function($join) { $join->on('u.itemmaster_id','=','itemmaster.id'); })
							->join('itemstock_department AS ISD', function($join) { $join->on('ISD.itemmaster_id','=','itemmaster.id'); })
							->join('location_transfer_item AS LTI', function($join) { $join->on('LTI.item_id','=','itemmaster.id'); })
							->Join('location_transfer AS LT', function($join) {
								$join->on('LT.id','=','LTI.location_transfer_id')->where('LT.status','=',1)->whereNull('LT.deleted_at');
							})
							->join('location AS L','L.id','=','LT.locfrom_id')->where('ISD.department_id',auth()->user()->department_id)->where('LT.department_id',auth()->user()->department_id)
							->where('LTI.status',1)->where('L.department_id',auth()->user()->department_id)->whereNull('LTI.deleted_at')->where('u.is_baseqty','=',1)
							->whereNull('L.deleted_at');
							
				if(($date_from!='') && ($date_to!='')) {
					$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
					$query9->whereBetween('LT.voucher_date', array($date_from, $date_to));
				}
						
				if(isset($attributes['document_id']) && $attributes['document_id']!='')
					$query9->whereIn('itemmaster.id', $attributes['document_id']);
			
				if(isset($attributes['location_id']) && ($attributes['location_id']!='all'))
					$query9->whereIn('LT.locfrom_id', $attributes['location_id']);
			
				if(isset($attributes['account_id']) && ($attributes['account_id']!='all'))
					$query4->whereIn('L.customer_id', $attributes['account_id']);
			
				if($attributes['itemtype']!='' )
					$query9->where('itemmaster.class_id', $attributes['itemtype']);
			
				if(isset($attributes['group_id']) && $attributes['group_id']!='')
					$query9->whereIn('itemmaster.group_id', $attributes['group_id']);
			
				if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
					$query9->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
			
				if(isset($attributes['category_id']) && $attributes['category_id']!='')
					$query9->whereIn('itemmaster.category_id', $attributes['category_id']);
			
				if(isset($attributes['subcategory_id'])&& $attributes['subcategory_id']!='')
					$query9->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
			
			/*	$quantity_col = 'u.cur_quantity'; 
				if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='minus')
					$query9->where($quantity_col, '<', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='positive')
					$query9->where($quantity_col, '>', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='zero')
					$query9->where($quantity_col,0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='nonzero')
					$query9->where($quantity_col,'!=',0); */
			
            
						
			$query9->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','L.code','L.name','LT.id AS logid','ISD.packing',
						'LT.voucher_date',DB::raw('"0" AS trtype'),DB::raw('"0" AS cost_avg'),DB::raw('"0" AS pur_cost'),'LTI.item_id','LTI.unit_id','LTI.quantity','L.id AS location_id','itemmaster.bin_location');
						
			
			//LOCATION TRANSFER (TO LOCATION) 
			$query10 = $this->itemmaster->where('itemmaster.status', 1)	
							->join('item_unit AS u', function($join) { $join->on('u.itemmaster_id','=','itemmaster.id'); })
							->join('itemstock_department AS ISD', function($join) { $join->on('ISD.itemmaster_id','=','itemmaster.id'); })
							->join('location_transfer_item AS LTI', function($join) { $join->on('LTI.item_id','=','itemmaster.id'); })
							->Join('location_transfer AS LT', function($join) {
								$join->on('LT.id','=','LTI.location_transfer_id')->where('LT.status','=',1)->whereNull('LT.deleted_at');
							})
							->join('location AS L','L.id','=','LT.locto_id')->where('L.department_id',auth()->user()->department_id)
							->where('ISD.department_id',auth()->user()->department_id)->where('LT.department_id',auth()->user()->department_id) 
							->where('LTI.status',1)->whereNull('LTI.deleted_at')->where('u.is_baseqty','=',1)
							->whereNull('L.deleted_at');
							
				if(($date_from!='') && ($date_to!='')) {
					$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
					$query10->whereBetween('LT.voucher_date', array($date_from, $date_to));
				}
						
				if(isset($attributes['document_id']) && $attributes['document_id']!='')
					$query10->whereIn('itemmaster.id', $attributes['document_id']);
			
				if(isset($attributes['location_id']) && ($attributes['location_id']!='all'))
					$query10->whereIn('LT.locto_id', $attributes['location_id']);
			
				if(isset($attributes['account_id']) && ($attributes['account_id']!='all'))
					$query10->whereIn('L.customer_id', $attributes['account_id']);
			
				if($attributes['itemtype']!='' )
					$query10->where('itemmaster.class_id', $attributes['itemtype']);
			
				if(isset($attributes['group_id']) && $attributes['group_id']!='')
					$query10->whereIn('itemmaster.group_id', $attributes['group_id']);
			
				if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
					$query10->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
			
				if(isset($attributes['category_id']) && $attributes['category_id']!='')
					$query10->whereIn('itemmaster.category_id', $attributes['category_id']);
			
				if(isset($attributes['subcategory_id'])&& $attributes['subcategory_id']!='')
					$query10->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
			
			/*	$quantity_col = 'u.cur_quantity'; 
				if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='minus')
					$query10->where($quantity_col, '<', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='positive')
					$query10->where($quantity_col, '>', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='zero')
					$query10->where($quantity_col,0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='nonzero')
					$query10->where($quantity_col,'!=',0); */
			
            
						
			$query10->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','L.code','L.name','LT.id AS logid','ISD.packing',
						'LT.voucher_date',DB::raw('"1" AS trtype'),DB::raw('"0" AS cost_avg'),DB::raw('"0" AS pur_cost'),'LTI.item_id','LTI.unit_id','LTI.quantity','L.id AS location_id','itemmaster.bin_location');
						
			//$res = $query10->get()->toArray();echo '<pre>';print_r($res);exit;	
			
			
			//SALES
			$query2 = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) { $join->on('u.itemmaster_id','=','itemmaster.id'); })
							->join('itemstock_department AS ISD', function($join) { $join->on('ISD.itemmaster_id','=','itemmaster.id'); })
							->join('item_log AS ILG', function($join) { $join->on('ILG.item_id','=','itemmaster.id'); })
							->Join('item_location_si AS LSI', function($join) {
								$join->on('LSI.logid','=','ILG.id')->where('LSI.status','=',1)->whereNull('LSI.deleted_at');
							})
							->join('location AS L','L.id','=','LSI.location_id')->where('LSI.department_id',auth()->user()->department_id)
							->where('ISD.department_id',auth()->user()->department_id)  
							->where('ILG.status',1)->where('ILG.department_id',auth()->user()->department_id)->whereNull('ILG.deleted_at')->where('u.is_baseqty','=',1)//->where('LSI.is_do',0)
							->whereNull('L.deleted_at')->where('L.department_id',auth()->user()->department_id);
							
				if(($date_from!='') && ($date_to!='')) {
					$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
					$query2->whereBetween('ILG.voucher_date', array($date_from, $date_to));
				}
						
				if(isset($attributes['document_id']) && $attributes['document_id']!='')
					$query2->whereIn('itemmaster.id', $attributes['document_id']);
			
				if(isset($attributes['location_id']) && ($attributes['location_id']!='all'))
					$query2->whereIn('LSI.location_id', $attributes['location_id']);
			
				if(isset($attributes['account_id']) && ($attributes['account_id']!='all'))
					$query2->whereIn('L.customer_id', $attributes['account_id']);
			
				if($attributes['itemtype']!='')
					$query2->where('itemmaster.class_id', $attributes['itemtype']);
			
				if(isset($attributes['group_id']) && $attributes['group_id']!='')
					$query2->whereIn('itemmaster.group_id', $attributes['group_id']);
			
				if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
					$query2->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
			
				if(isset($attributes['category_id']) && $attributes['category_id']!='')
					$query2->whereIn('itemmaster.category_id', $attributes['category_id']);
			
				if(isset($attributes['subcategory_id']) && $attributes['subcategory_id']!='')
					$query2->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
			
		/*		$quantity_col = 'u.cur_quantity'; 
				if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='minus')
					$query2->where($quantity_col, '<', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='positive')
					$query2->where($quantity_col, '>', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='zero')
					$query2->where($quantity_col,0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='nonzero')
					$query2->where($quantity_col,'!=',0); */
				
			$query2->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','L.code','L.name','ILG.id AS logid','ISD.packing',
						'ILG.voucher_date','ILG.trtype','ILG.cost_avg','ILG.pur_cost','LSI.item_id','LSI.unit_id','LSI.quantity','L.id AS location_id','itemmaster.bin_location')
						->orderBy('ILG.voucher_date');
						
			//GOODS ISSUE
			$query6 = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) { $join->on('u.itemmaster_id','=','itemmaster.id'); })
							->join('itemstock_department AS ISD', function($join) { $join->on('ISD.itemmaster_id','=','itemmaster.id'); })
							->join('item_log AS ILG', function($join) { $join->on('ILG.item_id','=','itemmaster.id'); })
							->Join('item_location_gi AS LSI', function($join) {
								$join->on('LSI.logid','=','ILG.id')->where('LSI.status','=',1)->whereNull('LSI.deleted_at');
							})
							->join('location AS L','L.id','=','LSI.location_id')->where('ISD.department_id',auth()->user()->department_id) 
							->where('ILG.status',1)->where('ILG.department_id',auth()->user()->department_id)->whereNull('ILG.deleted_at')->where('u.is_baseqty','=',1)//->where('LSI.is_do',0)
							->whereNull('L.deleted_at')->where('L.department_id',auth()->user()->department_id);
							
				if(($date_from!='') && ($date_to!='')) {
					$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
					$query6->whereBetween('ILG.voucher_date', array($date_from, $date_to));
				}
						
				if(isset($attributes['document_id']) && $attributes['document_id']!='')
					$query6->whereIn('itemmaster.id', $attributes['document_id']);
			
				if(isset($attributes['location_id']) && ($attributes['location_id']!='all'))
					$query6->whereIn('LSI.location_id', $attributes['location_id']);
			
				if(isset($attributes['account_id']) && ($attributes['account_id']!='all'))
					$query6->whereIn('L.customer_id', $attributes['account_id']);
			
				if($attributes['itemtype']!='')
					$query6->where('itemmaster.class_id', $attributes['itemtype']);
			
				if(isset($attributes['group_id']) && $attributes['group_id']!='')
					$query6->whereIn('itemmaster.group_id', $attributes['group_id']);
			
				if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
					$query6->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
			
				if(isset($attributes['category_id']) && $attributes['category_id']!='')
					$query6->whereIn('itemmaster.category_id', $attributes['category_id']);
			
				if(isset($attributes['subcategory_id']) && $attributes['subcategory_id']!='')
					$query6->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
			
			/*	$quantity_col = 'u.cur_quantity'; 
				if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='minus')
					$query6->where($quantity_col, '<', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='positive')
					$query6->where($quantity_col, '>', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='zero')
					$query6->where($quantity_col,0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='nonzero')
					$query6->where($quantity_col,'!=',0); */
				
			$query6->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','L.code','L.name','ILG.id AS logid','ISD.packing',
						'ILG.voucher_date','ILG.trtype','ILG.cost_avg','ILG.pur_cost','LSI.item_id','LSI.unit_id','LSI.quantity','L.id AS location_id','itemmaster.bin_location')
						->orderBy('ILG.voucher_date');
						
			//GOODS RETURN
			$query8 = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) { $join->on('u.itemmaster_id','=','itemmaster.id'); })
							->join('itemstock_department AS ISD', function($join) { $join->on('ISD.itemmaster_id','=','itemmaster.id'); })
							->join('item_log AS ILG', function($join) { $join->on('ILG.item_id','=','itemmaster.id'); })
							->Join('item_location_gr AS LSI', function($join) {
								$join->on('LSI.logid','=','ILG.id')->where('LSI.status','=',1)->whereNull('LSI.deleted_at');
							})
							->join('location AS L','L.id','=','LSI.location_id')->where('ISD.department_id',auth()->user()->department_id) 
							->where('ILG.status',1)->where('ILG.department_id',auth()->user()->department_id)->whereNull('ILG.deleted_at')->where('u.is_baseqty','=',1)//->where('LSI.is_do',0)
							->whereNull('L.deleted_at')->where('L.department_id',auth()->user()->department_id);
							
				if(($date_from!='') && ($date_to!='')) {
					$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
					$query8->whereBetween('ILG.voucher_date', array($date_from, $date_to));
				}
						
				if(isset($attributes['document_id']) && $attributes['document_id']!='')
					$query8->whereIn('itemmaster.id', $attributes['document_id']);
			
				if(isset($attributes['location_id']) && ($attributes['location_id']!='all'))
					$query8->whereIn('LSI.location_id', $attributes['location_id']);
			
				if(isset($attributes['account_id']) && ($attributes['account_id']!='all'))
					$query8->whereIn('L.customer_id', $attributes['account_id']);
			
				if($attributes['itemtype']!='')
					$query8->where('itemmaster.class_id', $attributes['itemtype']);
			
				if(isset($attributes['group_id']) && $attributes['group_id']!='')
					$query8->whereIn('itemmaster.group_id', $attributes['group_id']);
			
				if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
					$query8->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
			
				if(isset($attributes['category_id']) && $attributes['category_id']!='')
					$query8->whereIn('itemmaster.category_id', $attributes['category_id']);
			
				if(isset($attributes['subcategory_id']) && $attributes['subcategory_id']!='')
					$query8->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
			
			/*	$quantity_col = 'u.cur_quantity'; 
				if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='minus')
					$query8->where($quantity_col, '<', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='positive')
					$query8->where($quantity_col, '>', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='zero')
					$query8->where($quantity_col,0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='nonzero')
					$query8->where($quantity_col,'!=',0); */
				
			$query8->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','L.code','L.name','ILG.id AS logid','ISD.packing',
						'ILG.voucher_date','ILG.trtype','ILG.cost_avg','ILG.pur_cost','LSI.item_id','LSI.unit_id','LSI.quantity','L.id AS location_id','itemmaster.bin_location')
						->orderBy('ILG.voucher_date');
						
			//SALES RETURN
			$query5 = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) { $join->on('u.itemmaster_id','=','itemmaster.id'); })
							->join('itemstock_department AS ISD', function($join) { $join->on('ISD.itemmaster_id','=','itemmaster.id'); })
							->join('item_log AS ILG', function($join) { $join->on('ILG.item_id','=','itemmaster.id'); })
							->Join('item_location_sr AS LSI', function($join) {
								$join->on('LSI.logid','=','ILG.id')->where('LSI.status','=',1)->whereNull('LSI.deleted_at');
							})
							->join('location AS L','L.id','=','LSI.location_id')->where('ISD.department_id',auth()->user()->department_id)
							->where('ILG.status',1)->where('ILG.department_id',auth()->user()->department_id)->whereNull('ILG.deleted_at')->where('u.is_baseqty','=',1)//->where('LSI.is_do',0)
							->whereNull('L.deleted_at')->where('L.department_id',auth()->user()->department_id);
							
				if(($date_from!='') && ($date_to!='')) {
					$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
					$query5->whereBetween('ILG.voucher_date', array($date_from, $date_to));
				}
						
				if(isset($attributes['document_id']) && $attributes['document_id']!='')
					$query5->whereIn('itemmaster.id', $attributes['document_id']);
			
				if(isset($attributes['location_id']) && ($attributes['location_id']!='all'))
					$query5->whereIn('LSI.location_id', $attributes['location_id']);
			
				if(isset($attributes['account_id']) && ($attributes['account_id']!='all'))
					$query5->whereIn('L.customer_id', $attributes['account_id']);
			
				if($attributes['itemtype']!='')
					$query5->where('itemmaster.class_id', $attributes['itemtype']);
			
				if(isset($attributes['group_id']) && $attributes['group_id']!='')
					$query5->whereIn('itemmaster.group_id', $attributes['group_id']);
			
				if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
					$query5->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
			
				if(isset($attributes['category_id']) && $attributes['category_id']!='')
					$query5->whereIn('itemmaster.category_id', $attributes['category_id']);
			
				if(isset($attributes['subcategory_id']) && $attributes['subcategory_id']!='')
					$query5->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
			
			/*	$quantity_col = 'u.cur_quantity'; 
				if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='minus')
					$query5->where($quantity_col, '<', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='positive')
					$query5->where($quantity_col, '>', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='zero')
					$query5->where($quantity_col,0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='nonzero')
					$query5->where($quantity_col,'!=',0);  */
				
			$query5->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','L.code','L.name','ILG.id AS logid','ISD.packing',
						'ILG.voucher_date','ILG.trtype','ILG.cost_avg','ILG.pur_cost','LSI.item_id','LSI.unit_id','LSI.quantity','L.id AS location_id','itemmaster.bin_location')
						->orderBy('ILG.voucher_date');
						
		//$res = $query2->get();print_r($res);exit;
						
						
			//PURCHASE	
			$query3 = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) { $join->on('u.itemmaster_id','=','itemmaster.id'); })
							->join('itemstock_department AS ISD', function($join) { $join->on('ISD.itemmaster_id','=','itemmaster.id'); })
							->join('item_log AS ILG', function($join) { $join->on('ILG.item_id','=','itemmaster.id'); })
							->Join('item_location_pi AS LSI', function($join) {
								$join->on('LSI.logid','=','ILG.id')->where('LSI.status','=',1)->whereNull('LSI.deleted_at');
							})
							->join('location AS L','L.id','=','LSI.location_id')->where('ISD.department_id',auth()->user()->department_id) 
							->where('ILG.status',1)->where('ILG.department_id',auth()->user()->department_id)->whereNull('ILG.deleted_at')->where('u.is_baseqty','=',1) //->where('LSI.is_sdo',0)
							->whereNull('L.deleted_at')->where('L.department_id',auth()->user()->department_id);
							
				if(($date_from!='') && ($date_to!='')) {
					$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
					$query3->whereBetween('ILG.voucher_date', array($date_from, $date_to));
				}
						
				if(isset($attributes['document_id']) && $attributes['document_id']!='')
					$query3->whereIn('itemmaster.id', $attributes['document_id']);
			
				if(isset($attributes['location_id']) && ($attributes['location_id']!='all'))
					$query3->whereIn('LSI.location_id', $attributes['location_id']);
			
				if(isset($attributes['account_id']) && ($attributes['account_id']!='all'))
					$query3->whereIn('L.customer_id', $attributes['account_id']);
			
				if($attributes['itemtype']!='')
					$query3->where('itemmaster.class_id', $attributes['itemtype']);
			
				if(isset($attributes['group_id']) && $attributes['group_id']!='')
					$query3->whereIn('itemmaster.group_id', $attributes['group_id']);
			
				if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
					$query3->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
			
				if(isset($attributes['category_id']) && $attributes['category_id']!='')
					$query3->whereIn('itemmaster.category_id', $attributes['category_id']);
			
				if(isset($attributes['subcategory_id']) && $attributes['subcategory_id']!='')
					$query3->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
			
			/*	$quantity_col = 'u.cur_quantity'; 
				if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='minus')
					$query3->where($quantity_col, '<', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='positive')
					$query3->where($quantity_col, '>', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='zero')
					$query3->where($quantity_col,0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='nonzero')
					$query3->where($quantity_col,'!=',0); */
				
			$query3->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','L.code','L.name','ILG.id AS logid','ISD.packing',
						'ILG.voucher_date','ILG.trtype','ILG.cost_avg','ILG.pur_cost','LSI.item_id','LSI.unit_id','LSI.quantity','L.id AS location_id','itemmaster.bin_location')
						->orderBy('ILG.voucher_date');
						
			//PURCHASE RETURN
			$query7 = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) { $join->on('u.itemmaster_id','=','itemmaster.id'); })
							->join('itemstock_department AS ISD', function($join) { $join->on('ISD.itemmaster_id','=','itemmaster.id'); })
							->join('item_log AS ILG', function($join) { $join->on('ILG.item_id','=','itemmaster.id'); })
							->Join('item_location_pr AS LSI', function($join) {
								$join->on('LSI.logid','=','ILG.id')->where('LSI.status','=',1)->whereNull('LSI.deleted_at');
							})
							->join('location AS L','L.id','=','LSI.location_id')->where('ISD.department_id',auth()->user()->department_id) 
							->where('ILG.status',1)->where('ILG.department_id',auth()->user()->department_id)->whereNull('ILG.deleted_at')->where('u.is_baseqty','=',1) //->where('LSI.is_sdo',0)
							->whereNull('L.deleted_at')->where('L.department_id',auth()->user()->department_id);
							
				if(($date_from!='') && ($date_to!='')) {
					$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
					$query7->whereBetween('ILG.voucher_date', array($date_from, $date_to));
				}
						
				if(isset($attributes['document_id']) && $attributes['document_id']!='')
					$query7->whereIn('itemmaster.id', $attributes['document_id']);
			
				if(isset($attributes['location_id']) && ($attributes['location_id']!='all'))
					$query7->whereIn('LSI.location_id', $attributes['location_id']);
			
				if(isset($attributes['account_id']) && ($attributes['account_id']!='all'))
					$query7->whereIn('L.customer_id', $attributes['account_id']);
			
				if($attributes['itemtype']!='')
					$query7->where('itemmaster.class_id', $attributes['itemtype']);
			
				if(isset($attributes['group_id']) && $attributes['group_id']!='')
					$query7->whereIn('itemmaster.group_id', $attributes['group_id']);
			
				if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
					$query7->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
			
				if(isset($attributes['category_id']) && $attributes['category_id']!='')
					$query7->whereIn('itemmaster.category_id', $attributes['category_id']);
			
				if(isset($attributes['subcategory_id']) && $attributes['subcategory_id']!='')
					$query7->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
			
			/*	$quantity_col = 'u.cur_quantity'; 
				if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='minus')
					$query7->where($quantity_col, '<', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='positive')
					$query7->where($quantity_col, '>', 0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='zero')
					$query7->where($quantity_col,0);
				else if(isset($attributes['quantity_type']) && $attributes['quantity_type']=='nonzero')
					$query7->where($quantity_col,'!=',0); */
				
			$query7->select('itemmaster.p1_formula','itemmaster.p2_formula','itemmaster.id','itemmaster.item_code','itemmaster.description','L.code','L.name','ILG.id AS logid','ISD.packing',
						'ILG.voucher_date','ILG.trtype','ILG.cost_avg','ILG.pur_cost','LSI.item_id','LSI.unit_id','LSI.quantity','L.id AS location_id','itemmaster.bin_location')
						->orderBy('ILG.voucher_date');
				
			$result = $query0->union($query1)->union($query4)->union($query2)->union($query3)->union($query5)->union($query6)->union($query7)->union($query8)->union($query9)->union($query10)->get()->toArray();			
			//$result = $query1->get()->toArray();			
			//echo '<pre>';print_r($result);exit;
			return $result;
			
		}
	}
	
	//NOV24
	public function getOpeningQuantityLocReport($attributes) {

		$result = array();
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):'';
		$dt = DB::table('parameter1')->select('from_date')->first();
		$date_from = $dt->from_date;
		//echo '<pre>';print_r($attributes);exit;
			$query = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->join('itemstock_department AS ISD', function($join) {
								$join->on('ISD.itemmaster_id','=','itemmaster.id');
							} )
							->join('item_location AS L', function($join) {
								$join->on('L.item_id','=','u.itemmaster_id');
							} )
							->join('item_log AS IL', function($join) {
								$join->on('IL.item_id','=','itemmaster.id');
							} )
							->join('location AS L2', function($join) {
								$join->on('L2.id','=','L.location_id');
							} )
							->join('units AS UN', function($join) {
								$join->on('UN.id','=','u.unit_id');
							} )
							->where('IL.status',1)->where('L.status',1)->where('L2.status',1)
							->where('ISD.department_id',auth()->user()->department_id)
							->where('IL.department_id',auth()->user()->department_id)
							->whereNull('IL.deleted_at')
							->whereNull('L.deleted_at')
							->whereNull('L2.deleted_at')
							->where('L.department_id',auth()->user()->department_id)
							//->where('L2.department_id',auth()->user()->department_id)
							->where('L.opn_qty','>',0)
							->where('u.is_baseqty','=',1);
							
			if(($date_from!='') && ($date_to!='')) {
				$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
				$query->whereBetween('IL.voucher_date', array($date_from, $date_to));
			}
						if(isset($attributes['document_id']) && $attributes['document_id']!='')
							$query->whereIn('itemmaster.id', $attributes['document_id']);
						
						if($attributes['itemtype']!='')
							$query->where('itemmaster.class_id', $attributes['itemtype']);
						
						if(isset($attributes['group_id']) && $attributes['group_id']!='')
							$query->whereIn('itemmaster.group_id', $attributes['group_id']);
						
						if(isset($attributes['subgroup_id']) && $attributes['subgroup_id']!='')
							$query->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
						
						if(isset($attributes['category_id']) && $attributes['category_id']!='')
							$query->whereIn('itemmaster.category_id', $attributes['category_id']);
						
						if(isset($attributes['subcategory_id']) && $attributes['subcategory_id']!='')
							$query->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);

						if(isset($attributes['location_id']) && $attributes['location_id']!='')
							$query->whereIn('L.location_id', $attributes['location_id']);
						
						$quantity_col = 'u.opn_quantity'; 
						
						if($attributes['quantity_type']=='minus')
							$query->where($quantity_col, '<', 0);
						else if($attributes['quantity_type']=='positive')
							$query->where($quantity_col, '>', 0);
						else if($attributes['quantity_type']=='zero')
							$query->where($quantity_col,0);
						else if($attributes['quantity_type']=='nonzero')
							$query->where($quantity_col,'!=',0);
							
			$result = $query->select('itemmaster.id','itemmaster.item_code','itemmaster.description','IL.voucher_date','ISD.packing','ISD.opn_cost','ISD.opn_quantity',
									'UN.unit_name AS unit','L.opn_qty','L.location_id','L.id AS lid','L2.code','L2.name')
			->groupBy('lid')->get()->toArray();
		
			return $result;
		
	}
	
	//NOV24
	public function getStockLedgerReportSummary() {

		$result = DB::table('item_log')->join('itemmaster','itemmaster.id','=','item_log.item_id')
						->where('item_log.status',1)->whereNull('item_log.deleted_at')
						->where('itemmaster.status',1)->whereNull('itemmaster.deleted_at')
						->where('itemmaster.class_id',1)
						->select('itemmaster.item_code','itemmaster.description',
							DB::raw("(SELECT SUM(IL.quantity) FROM item_log as IL WHERE (item_log.item_id=IL.item_id) AND (IL.trtype=1) AND IL.status=1 AND IL.deleted_at IS NULL) AS qty_in"),
							DB::raw("(SELECT SUM(IL.quantity) FROM item_log as IL WHERE (item_log.item_id=IL.item_id) AND (IL.trtype=0) AND IL.status=1 AND IL.deleted_at IS NULL) AS qty_out")
						)->groupBy('itemmaster.id')->get();

		return $result;
	}
	

	public function getOpeningQuantityLocReportBkp($attributes) {

		$result = array();
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):'';
		$dt = DB::table('parameter1')->select('from_date')->first();
		$date_from = $dt->from_date;
		
			$query = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->join('item_location AS L', function($join) {
								$join->on('L.item_id','=','u.itemmaster_id');
							} )
							->join('item_log AS IL', function($join) {
								$join->on('IL.item_id','=','itemmaster.id');
							} )
							->join('location AS L2', function($join) {
								$join->on('L2.id','=','L.location_id');
							} )
							->join('units AS UN', function($join) {
								$join->on('UN.id','=','u.unit_id');
							} )
							->where('IL.status',1)->where('L.status',1)->where('L2.status',1)
							->whereNull('IL.deleted_at')
							->whereNull('L.deleted_at')
							->where('L.opn_qty','>',0)->whereNull('L2.deleted_at')
							->where('u.is_baseqty','=',1);
							
			if(($date_from!='') && ($date_to!='')) {
				$date_from = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
				$query->whereBetween('IL.voucher_date', array($date_from, $date_to));
			}
						if(isset($attributes['document_id']))
							$query->whereIn('itemmaster.id', $attributes['document_id']);
						
						if($attributes['itemtype']!='')
							$query->where('itemmaster.class_id', $attributes['itemtype']);
						
						if(isset($attributes['group_id']))
							$query->whereIn('itemmaster.group_id', $attributes['group_id']);
						
						if(isset($attributes['subgroup_id']))
							$query->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
						
						if(isset($attributes['category_id']))
							$query->whereIn('itemmaster.category_id', $attributes['category_id']);
						
						if(isset($attributes['subcategory_id']))
							$query->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);

						if(isset($attributes['location_id']))
							$query->whereIn('L.location_id', $attributes['location_id']);
						
						$quantity_col = 'u.opn_quantity'; 
						
						if($attributes['quantity_type']=='minus')
							$query->where($quantity_col, '<', 0);
						else if($attributes['quantity_type']=='positive')
							$query->where($quantity_col, '>', 0);
						else if($attributes['quantity_type']=='zero')
							$query->where($quantity_col,0);
						else if($attributes['quantity_type']=='nonzero')
							$query->where($quantity_col,'!=',0);
							
			$result = $query->select('itemmaster.id','itemmaster.item_code','itemmaster.description','IL.voucher_date','u.packing','u.opn_cost','u.opn_quantity',
									'UN.unit_name AS unit','L.opn_qty','L.location_id','L.id AS lid','L2.code','L2.name')
			->groupBy('lid')->get()->toArray();
		
			return $result;
		
	}


	public function getQuantityReport2($attributes)
	{
		$result = array();
		if($attributes['search_type']=='opening_quantity' || $attributes['search_type']=='qtyhand_ason_date') {
		
			$query = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->join('item_log AS IL', function($join) {
								$join->on('IL.item_id','=','itemmaster.id');
							} )
							->where('IL.status',1)
							->whereNull('IL.deleted_at')
							->where('u.is_baseqty','=',1);
						if($attributes['itemtype']!='')
							$query->where('itemmaster.class_id', $attributes['itemtype']);
						
						if(isset($attributes['group_id']))
							$query->whereIn('itemmaster.group_id', $attributes['group_id']);
						
						if(isset($attributes['subgroup_id']))
							$query->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
						
						if(isset($attributes['category_id']))
							$query->whereIn('itemmaster.category_id', $attributes['category_id']);
						
						if(isset($attributes['subcategory_id']))
							$query->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
						
						$quantity_col = ($attributes['search_type']=='qtyhand_ason_date')?'IL.cur_quantity':'u.opn_quantity'; 
						
						if($attributes['quantity_type']=='minus')
							$query->where($quantity_col, '<', 0);
						else if($attributes['quantity_type']=='positive')
							$query->where($quantity_col, '>', 0);
						else if($attributes['quantity_type']=='zero')
							$query->where($quantity_col,0);
						else if($attributes['quantity_type']=='nonzero')
							$query->where($quantity_col,'!=',0);
							
			$result = $query->select('itemmaster.id','itemmaster.item_code','itemmaster.description','IL.*')->get();
		
		} else if($attributes['search_type']=='qtyhand_ason_date_loc') {
		
			$query = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->join('item_location AS IL', function($join) {
								$join->on('IL.item_id','=','itemmaster.id');
								$join->on('IL.unit_id','=','u.unit_id');
							} )
							->join('location AS L', function($join) {
								$join->on('L.id','=','IL.location_id');
							} )
							->where('u.is_baseqty','=',1)
							->where('IL.status','=',1)
							->whereNull('IL.deleted_at');
							
						if(isset($attributes['location_id']) && ($attributes['location_id']!='all'))
							$query->whereIn('L.id', $attributes['location_id']);
						
						if($attributes['itemtype']!='')
							$query->where('itemmaster.class_id', $attributes['itemtype']);
						
						if(isset($attributes['group_id']))
							$query->whereIn('itemmaster.group_id', $attributes['group_id']);
						
						if(isset($attributes['subgroup_id']))
							$query->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
						
						if(isset($attributes['category_id']))
							$query->whereIn('itemmaster.category_id', $attributes['category_id']);
						
						if(isset($attributes['subcategory_id']))
							$query->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
						
						$quantity_col = ($attributes['search_type']=='qtyhand_ason_date')?'u.cur_quantity':'u.opn_quantity'; 
						$quantity_col2 = ($attributes['search_type']=='qtyhand_ason_date')?'IL.opn_qty':'IL.quantity'; 
						
						if($attributes['quantity_type']=='minus')
							$query->where($quantity_col, '<', 0)->where($quantity_col2, '<', 0);
						else if($attributes['quantity_type']=='positive')
							$query->where($quantity_col, '>', 0)->where($quantity_col2, '<', 0);
						else if($attributes['quantity_type']=='zero')
							$query->where($quantity_col,0)->where($quantity_col2, '<', 0);
						else if($attributes['quantity_type']=='nonzero')
							$query->where($quantity_col,'!=',0)->where($quantity_col2, '<', 0);
							
			$result = $query->select('itemmaster.id','itemmaster.item_code','itemmaster.description','u.*','L.id AS location_id','L.code','IL.quantity AS lqty','L.name','IL.opn_qty')->get();//->toArray();
							
		
		} else if($attributes['search_type']=='qtyhand_ason_priordate') {
			
			$date_from = $attributes['date_from'].' 00:00:00';
			$date_to = ($attributes['date_to']=='')?date('Y-m-d').' 23:59:59':date('Y-m-d', strtotime($attributes['date_to'])).' 23:59:59';
			
			//PURCHASE SECTION LOGS...........
			$query1 = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->join('item_stock AS P', function($join) {
								$join->on('P.item_id','=','itemmaster.id');
							} )
							->where('u.is_baseqty','=',1)
							->whereBetween('P.created_at', array($date_from, $date_to));
							
						if($attributes['itemtype']!='')
							$query1->where('itemmaster.class_id', $attributes['itemtype']);
						
						if(isset($attributes['group_id']))
							$query->whereIn('itemmaster.group_id', $attributes['group_id']);
						
						if(isset($attributes['subgroup_id']))
							$query->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
						
						if(isset($attributes['category_id']))
							$query->whereIn('itemmaster.category_id', $attributes['category_id']);
						
						if(isset($attributes['subcategory_id']))
							$query->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
						
						$quantity_col = 'u.cur_quantity'; 
						
						if($attributes['quantity_type']=='minus')
							$query1->where($quantity_col, '<', 0);
						else if($attributes['quantity_type']=='positive')
							$query1->where($quantity_col, '>', 0);
						else if($attributes['quantity_type']=='zero')
							$query1->where($quantity_col,0);
						else if($attributes['quantity_type']=='nonzero')
							$query1->where($quantity_col,'!=',0);
						
			/* $result['purchase'] = $query1->select('itemmaster.id','itemmaster.item_code','itemmaster.description','u.*','P.balance_qty AS balance_qty','P.created_at')
								->orderBy('P.id', 'DESC')->get()->toArray(); */
			
			//SALES SECTION LOGS...........			
			$query2 = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->join('item_sale_log AS P', function($join) {
								$join->on('P.item_id','=','itemmaster.id');
							} )
							->where('u.is_baseqty','=',1)
							->whereBetween('P.created_at', array($date_from, $date_to));
							
						if($attributes['itemtype']!='')
							$query2->where('itemmaster.class_id', $attributes['itemtype']);
						
						if(isset($attributes['group_id']))
							$query->whereIn('itemmaster.group_id', $attributes['group_id']);
						
						if(isset($attributes['subgroup_id']))
							$query->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
						
						if(isset($attributes['category_id']))
							$query->whereIn('itemmaster.category_id', $attributes['category_id']);
						
						if(isset($attributes['subcategory_id']))
							$query->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
						
						$quantity_col = 'u.cur_quantity';
						
						if($attributes['quantity_type']=='minus')
							$query2->where($quantity_col, '<', 0);
						else if($attributes['quantity_type']=='positive')
							$query2->where($quantity_col, '>', 0);
						else if($attributes['quantity_type']=='zero')
							$query2->where($quantity_col,0);
						else if($attributes['quantity_type']=='nonzero')
							$query2->where($quantity_col,'!=',0);
						
			$result = $query2->select('itemmaster.id','itemmaster.item_code','itemmaster.description','u.*','P.balance_qty AS balance_qty','P.created_at')
					 ->orderBy('P.id', 'DESC')->groupBy('u.itemmaster_id')->get();//->groupBy('u.itemmaster_id') ['sales']
					 
			//$result = $res1->union($res2)->get()->toArray();
			
		}
		
		return $result;
	}
	
	public function getQuantityReportOld($attributes)
	{
		$result = array();
		if($attributes['search_type']=='opening_quantity' || $attributes['search_type']=='qtyhand_ason_date') {
		
			$query = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->where('u.is_baseqty','=',1);
						if($attributes['itemtype']!='')
							$query->where('itemmaster.class_id', $attributes['itemtype']);
						
						$quantity_col = ($attributes['search_type']=='qtyhand_ason_date')?'u.cur_quantity':'u.opn_quantity'; 
						
						if($attributes['quantity_type']=='minus')
							$query->where($quantity_col, '<', 0);
						else if($attributes['quantity_type']=='positive')
							$query->where($quantity_col, '>', 0);
						else if($attributes['quantity_type']=='zero')
							$query->where($quantity_col,0);
						else if($attributes['quantity_type']=='nonzero')
							$query->where($quantity_col,'!=',0);
							
			$result = $query->select('itemmaster.id','itemmaster.item_code','itemmaster.description','u.*')->get();
		
		} else if($attributes['search_type']=='qtyhand_ason_date_loc') {
		
			$query = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->join('item_location AS IL', function($join) {
								$join->on('IL.item_id','=','itemmaster.id');
								$join->on('IL.unit_id','=','u.unit_id');
							} )
							->join('location AS L', function($join) {
								$join->on('L.id','=','IL.location_id');
							} )
							->where('u.is_baseqty','=',1)
							->where('IL.status','=',1)
							->whereNull('IL.deleted_at');
							
						if($attributes['location_id']!='all')
							$query->whereIn('L.id', $attributes['location_id']);
						
						if($attributes['itemtype']!='')
							$query->where('itemmaster.class_id', $attributes['itemtype']);
						
						$quantity_col = ($attributes['search_type']=='qtyhand_ason_date')?'u.cur_quantity':'u.opn_quantity'; 
						$quantity_col2 = ($attributes['search_type']=='qtyhand_ason_date')?'IL.opn_qty':'IL.quantity'; 
						
						if($attributes['quantity_type']=='minus')
							$query->where($quantity_col, '<', 0)->where($quantity_col2, '<', 0);
						else if($attributes['quantity_type']=='positive')
							$query->where($quantity_col, '>', 0)->where($quantity_col2, '<', 0);
						else if($attributes['quantity_type']=='zero')
							$query->where($quantity_col,0)->where($quantity_col2, '<', 0);
						else if($attributes['quantity_type']=='nonzero')
							$query->where($quantity_col,'!=',0)->where($quantity_col2, '<', 0);
							
			$result = $query->select('itemmaster.id','itemmaster.item_code','itemmaster.description','u.*','L.id AS location_id','L.code','IL.quantity AS lqty','L.name','IL.opn_qty')->get();//->toArray();
							
		
		} else if($attributes['search_type']=='qtyhand_ason_priordate') {
			
			$date_from = $attributes['date_from'].' 00:00:00';
			$date_to = ($attributes['date_to']=='')?date('Y-m-d').' 23:59:59':date('Y-m-d', strtotime($attributes['date_to'])).' 23:59:59';
			
			//PURCHASE SECTION LOGS...........
			$query1 = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->join('item_stock AS P', function($join) {
								$join->on('P.item_id','=','itemmaster.id');
							} )
							->where('u.is_baseqty','=',1)
							->whereBetween('P.created_at', array($date_from, $date_to));
							
						if($attributes['itemtype']!='')
							$query1->where('itemmaster.class_id', $attributes['itemtype']);
						
						$quantity_col = 'u.cur_quantity'; 
						
						if($attributes['quantity_type']=='minus')
							$query1->where($quantity_col, '<', 0);
						else if($attributes['quantity_type']=='positive')
							$query1->where($quantity_col, '>', 0);
						else if($attributes['quantity_type']=='zero')
							$query1->where($quantity_col,0);
						else if($attributes['quantity_type']=='nonzero')
							$query1->where($quantity_col,'!=',0);
						
			/* $result['purchase'] = $query1->select('itemmaster.id','itemmaster.item_code','itemmaster.description','u.*','P.balance_qty AS balance_qty','P.created_at')
								->orderBy('P.id', 'DESC')->get()->toArray(); */
			
			//SALES SECTION LOGS...........			
			$query2 = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->join('item_sale_log AS P', function($join) {
								$join->on('P.item_id','=','itemmaster.id');
							} )
							->where('u.is_baseqty','=',1)
							->whereBetween('P.created_at', array($date_from, $date_to));
							
						if($attributes['itemtype']!='')
							$query2->where('itemmaster.class_id', $attributes['itemtype']);
						
						$quantity_col = 'u.cur_quantity';
						
						if($attributes['quantity_type']=='minus')
							$query2->where($quantity_col, '<', 0);
						else if($attributes['quantity_type']=='positive')
							$query2->where($quantity_col, '>', 0);
						else if($attributes['quantity_type']=='zero')
							$query2->where($quantity_col,0);
						else if($attributes['quantity_type']=='nonzero')
							$query2->where($quantity_col,'!=',0);
						
			$result = $query2->select('itemmaster.id','itemmaster.item_code','itemmaster.description','u.*','P.balance_qty AS balance_qty','P.created_at')
					 ->orderBy('P.id', 'DESC')->groupBy('u.itemmaster_id')->get();//->groupBy('u.itemmaster_id') ['sales']
					 
			//$result = $res1->union($res2)->get()->toArray();
			
		}
		
		return $result;
	}
	
	public function getStockLedger()//$attributes
	{
		$result = array();
		/* if($attributes['search_type']=='quantity') {
		
			$result = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->where('u.is_baseqty','=',1)->where('itemmaster.class_id',1)
							->select('itemmaster.id','itemmaster.item_code','itemmaster.description','u.cur_quantity','u.packing','u.cost_avg')
							->get();
		} else { */
			$result = $this->itemmaster->where('itemmaster.status', 1)
							->join('itemstock_department AS isd', function($join) {
								$join->on('isd.itemmaster_id','=','itemmaster.id');
								$join->where('isd.department_id','=',auth()->user()->department_id);
								$join->where('isd.is_baseqty','=',1);
							} )
							->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
								$join->where('u.is_baseqty','=',1);
							} )
							->where('itemmaster.class_id',1)
							->select('itemmaster.id','itemmaster.item_code','itemmaster.description','isd.cur_quantity','u.packing',DB::raw('CASE WHEN isd.cost_avg IS NULL OR isd.cost_avg = 0 THEN u.cost_avg ELSE isd.cost_avg END AS cost_avg'))
							->groupBy('itemmaster.id')
							->get();
		//}
		
		return $result;
	}
	
	public function getStockLedgerReportBkp($attributes)
	{
		$result = array();
		$date_from = ($attributes['date_from']!='')?date('Y-m-d', strtotime($attributes['date_from'])):'';
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):''; 
		
			//OPENING DETAILS...
			$result['opn_details'] = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemmaster AS itemmaster','itemmaster.id','=','item_log.item_id')
									 ->whereNull('item_log.deleted_at')
									 ->where('item_log.document_type','OQ')
									 ->where('u.is_baseqty','1')
									 ->select('itemmaster.id','itemmaster.item_code','itemmaster.description','u.opn_quantity','u.opn_cost AS cost_avg')
									 ->get();
			
			
			//PURCHASE INVOICE..	
			$query1 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->leftjoin('purchase_invoice','purchase_invoice.id','=','item_log.document_id')
									 ->leftjoin('account_master','account_master.id','=','purchase_invoice.supplier_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','purchase_invoice.job_id')
									 ->where('item_log.document_type','=','PI')
									 ->where('purchase_invoice.status',1);
									 
									 
			if(($date_from!='') && ($date_to!=''))
				$query1->whereBetween('purchase_invoice.voucher_date', array($date_from, $date_to));
			
			$result1 = $query1->select('item_log.id','purchase_invoice.voucher_no','purchase_invoice.voucher_date','account_master.master_name',DB::raw('"PI" AS type'),'purchase_invoice.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','purchase_invoice.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
			
			//SDO..	
			$query1_1 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->leftjoin('supplier_do','supplier_do.id','=','item_log.document_id')
									 ->leftjoin('account_master','account_master.id','=','supplier_do.supplier_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','supplier_do.job_id')
									 ->where('item_log.document_type','=','SDO')
									 ->whereNull('item_log.deleted_at')
									 ->where('supplier_do.status',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query1_1->whereBetween('supplier_do.voucher_date', array($date_from, $date_to));
			
			$result1_1 = $query1_1->select('item_log.id','supplier_do.voucher_no','supplier_do.voucher_date','account_master.master_name',DB::raw('"SDO" AS type'),'supplier_do.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','supplier_do.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');

										
			//SALES INVOICE...	
			$query2 = DB::table('item_log')->where('item_log.item_id', $attributes['document_id'])
									 ->leftjoin('sales_invoice','sales_invoice.id','=','item_log.document_id')
									 ->leftjoin('account_master','account_master.id','=','sales_invoice.customer_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','sales_invoice.job_id')
									 ->where('item_log.document_type','=','SI')
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									 ->where('sales_invoice.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query2->whereBetween('sales_invoice.voucher_date', array($date_from, $date_to));
			
			$result2 = $query2->select('item_log.id','sales_invoice.voucher_no','sales_invoice.voucher_date','account_master.master_name',DB::raw('"SI" AS type'),'sales_invoice.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','sales_invoice.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
				
				
			//PURCHASE RETURN.....
			$query3 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->leftjoin('purchase_return','purchase_return.id','=','item_log.document_id')
									 ->leftjoin('account_master','account_master.id','=','purchase_return.supplier_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','purchase_return.job_id')
									 ->where('item_log.document_type','=','PR')
									 ->whereNull('item_log.deleted_at')
									 ->where('purchase_return.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query3->whereBetween('purchase_return.voucher_date', array($date_from, $date_to));
			
			$result3 = $query3->select('item_log.id','purchase_return.voucher_no','purchase_return.voucher_date','account_master.master_name',DB::raw('"PR" AS type'),'purchase_return.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','purchase_return.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
			
			//SALES RETURN...						 
			$query4 = DB::table('item_log')->where('item_log.item_id', $attributes['document_id'])
									 ->leftjoin('sales_return','sales_return.id','=','item_log.document_id')
									 ->leftjoin('account_master','account_master.id','=','sales_return.customer_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','sales_return.job_id')
									 ->where('item_log.document_type','=','SR')
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									 ->where('sales_return.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query4->whereBetween('sales_return.voucher_date', array($date_from, $date_to));
			
			$result4 = $query4->select('item_log.id','sales_return.voucher_no','sales_return.voucher_date','account_master.master_name',DB::raw('"SR" AS type'),'sales_return.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','sales_return.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
			
			//TRANSFER IN...						 
			$query5 = DB::table('item_log')->where('item_log.item_id', $attributes['document_id'])
									 ->leftjoin('stock_transferin','stock_transferin.id','=','item_log.document_id')
									 ->leftjoin('account_master','account_master.id','=','stock_transferin.account_dr')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','stock_transferin.job_id')
									 ->where('item_log.document_type','=','TI')
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									 ->where('stock_transferin.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query5->whereBetween('stock_transferin.voucher_date', array($date_from, $date_to));
			
			$result5 = $query5->select('item_log.id','stock_transferin.voucher_no','stock_transferin.voucher_date','account_master.master_name',DB::raw('"TI" AS type'),'stock_transferin.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','stock_transferin.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
										
			
			//GOODS RETURN...						 
			$query6 = DB::table('item_log')->where('item_log.item_id', $attributes['document_id'])
									 ->leftjoin('goods_return','goods_return.id','=','item_log.document_id')
									 ->leftjoin('account_master','account_master.id','=','goods_return.account_master_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','goods_return.job_id')
									 ->where('item_log.document_type','=','GR')
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									 ->where('goods_return.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query6->whereBetween('goods_return.voucher_date', array($date_from, $date_to));
			
			$result6 = $query6->select('item_log.id','goods_return.voucher_no','goods_return.voucher_date','account_master.master_name',DB::raw('"GR" AS type'),'goods_return.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','goods_return.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
			
			//TRANSFER OUT...						 
			$query7 = DB::table('item_log')->where('item_log.item_id', $attributes['document_id'])
									 ->leftjoin('stock_transferout','stock_transferout.id','=','item_log.document_id')
									 ->leftjoin('account_master','account_master.id','=','stock_transferout.account_dr')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','stock_transferout.job_id')
									 ->where('item_log.document_type','=','TO')
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									 ->where('stock_transferout.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query7->whereBetween('stock_transferout.voucher_date', array($date_from, $date_to));
			
			$result7 = $query7->select('item_log.id','stock_transferout.voucher_no','stock_transferout.voucher_date','account_master.master_name',DB::raw('"TO" AS type'),'stock_transferout.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','stock_transferout.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
			
			//GOODS ISSUED...						 
			$query8 = DB::table('item_log')->where('item_log.item_id', $attributes['document_id'])
									 ->leftjoin('goods_issued','goods_issued.id','=','item_log.document_id')
									 ->leftjoin('account_master','account_master.id','=','goods_issued.account_master_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','goods_issued.job_id')
									 ->where('item_log.document_type','=','GI')
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									 ->where('goods_issued.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query8->whereBetween('goods_issued.voucher_date', array($date_from, $date_to));
			
			$result8 = $query8->select('item_log.id','goods_issued.voucher_no','goods_issued.voucher_date','account_master.master_name',DB::raw('"GI" AS type'),'goods_issued.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','goods_issued.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');

			//CDO..	
			$query9 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->leftjoin('customer_do','customer_do.id','=','item_log.document_id')
									 ->leftjoin('account_master','account_master.id','=','customer_do.customer_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','customer_do.job_id')
									 ->where('item_log.document_type','=','CDO')
									 ->whereNull('item_log.deleted_at')
									 ->where('customer_do.status',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query9->whereBetween('customer_do.voucher_date', array($date_from, $date_to));
			
			$result9 = $query9->select('item_log.id','customer_do.voucher_no','customer_do.voucher_date','account_master.master_name',DB::raw('"CDO" AS type'),'customer_do.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','customer_do.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
										
			$result['pursales'] = $result1->union($result1_1)->union($result2)->union($result3)->union($result4)->union($result5)->union($result6)->union($result7)->union($result8)->union($result9)->orderBy('vdate','ASC')->orderBy('id','ASC')->get();
		 
		return $result;
	}
	
	
	public function getStockLedgerReport($attributes)
	{
		$result = array();
		$date_from = ($attributes['date_from']!='')?date('Y-m-d', strtotime($attributes['date_from'])):'';
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):''; 
		$start_date = $attributes['start_date'] ?? DB::table('item_log')
                    ->where('item_id', $attributes['document_id'])
                    ->where('status', 1)
                    ->whereNull('deleted_at')
                    ->min('voucher_date');
		
			//OPENING DETAILS...
			$result['opn_details'] = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->join('itemmaster AS itemmaster','itemmaster.id','=','item_log.item_id')
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->where('isd.department_id',auth()->user()->department_id)
									 ->whereNull('item_log.deleted_at')
									 ->where('item_log.document_type','OQ')
									 ->where('u.is_baseqty','1')
									 ->select('itemmaster.id','itemmaster.item_code','itemmaster.description','isd.opn_quantity','isd.opn_cost AS cost_avg')
									 ->get();
			
			//NOV24
			// if($date_from!='' && ($date_from!=$attributes['start_date'])) {
			// 	$enddate = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));
				
			// 	$qtyin = DB::table('item_log')->where('item_id', $attributes['document_id'])->where('trtype',1)
			// 				->whereBetween('voucher_date', array($attributes['start_date'], $enddate))
			// 				->where('status',1)->where('item_log.department_id',auth()->user()->department_id)->whereNull('deleted_at')->sum('quantity');
		
			// 	$qtyout = DB::table('item_log')->where('item_id', $attributes['document_id'])->where('item_log.department_id',auth()->user()->department_id)
			// 				->whereBetween('voucher_date', array($attributes['start_date'], $enddate))
			// 				->where('trtype',0)->where('status',1)->whereNull('deleted_at')->sum('quantity');
				
			// 	$result['opn_details'][0]->opn_quantity = $qtyin - $qtyout;
			// 	//echo '1<pre>';print_r($qtyin);print_r($qtyout);exit;
			// }

			if ($date_from != '' && $date_from != $start_date) {

				$enddate = date('Y-m-d', strtotime('-1 day', strtotime($date_from)));

				$qtyin = DB::table('item_log')
					->where('item_id', $attributes['document_id'])
					->where('trtype', 1)
					->whereBetween('voucher_date', [$start_date, $enddate])
					->where('status', 1)
					->where('department_id', auth()->user()->department_id)
					->whereNull('deleted_at')
					->sum('quantity');

				$qtyout = DB::table('item_log')
					->where('item_id', $attributes['document_id'])
					->where('trtype', 0)
					->whereBetween('voucher_date', [$start_date, $enddate])
					->where('status', 1)
					->where('department_id', auth()->user()->department_id)
					->whereNull('deleted_at')
					->sum('quantity');

				if (!empty($result['opn_details']) && isset($result['opn_details'][0])) {
					$result['opn_details'][0]->opn_quantity = $qtyin - $qtyout;
				}
			}
			
			//PURCHASE INVOICE..	
			$query1 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('purchase_invoice','purchase_invoice.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','purchase_invoice.supplier_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','purchase_invoice.job_id')
									 ->where('item_log.document_type','=','PI')
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->where('isd.department_id',auth()->user()->department_id)
									 ->where('purchase_invoice.department_id',auth()->user()->department_id)
									 ->where('purchase_invoice.status',1);
									 
									 
			if(($date_from!='') && ($date_to!=''))
				$query1->whereBetween('purchase_invoice.voucher_date', array($date_from, $date_to));
			
			$result1 = $query1->select('item_log.id','purchase_invoice.voucher_no','purchase_invoice.voucher_date','account_master.master_name',DB::raw('"PI" AS type'),'purchase_invoice.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','purchase_invoice.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
			
			//SDO..	
			$query1_1 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('supplier_do','supplier_do.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','supplier_do.supplier_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','supplier_do.job_id')
									 ->where('item_log.document_type','=','SDO')
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->where('isd.department_id',auth()->user()->department_id)
									 ->whereNull('item_log.deleted_at')
									  ->where('supplier_do.department_id',auth()->user()->department_id)
									 ->where('supplier_do.status',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query1_1->whereBetween('supplier_do.voucher_date', array($date_from, $date_to));
			
			$result1_1 = $query1_1->select('item_log.id','supplier_do.voucher_no','supplier_do.voucher_date','account_master.master_name',DB::raw('"SDO" AS type'),'supplier_do.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','supplier_do.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');

										
			//SALES INVOICE...	
			$query2 = DB::table('item_log')->where('item_log.item_id', $attributes['document_id'])
									 ->join('sales_invoice','sales_invoice.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','sales_invoice.customer_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','sales_invoice.job_id')
									 ->where('item_log.document_type','=','SI')
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->where('isd.department_id',auth()->user()->department_id)
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									 ->where('sales_invoice.department_id',auth()->user()->department_id)
									 ->where('sales_invoice.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query2->whereBetween('sales_invoice.voucher_date', array($date_from, $date_to));
			
			$result2 = $query2->select('item_log.id','sales_invoice.voucher_no','sales_invoice.voucher_date','account_master.master_name',DB::raw('"SI" AS type'),'sales_invoice.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','sales_invoice.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
				
				
			//PURCHASE RETURN.....
			$query3 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('purchase_return','purchase_return.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','purchase_return.supplier_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','purchase_return.job_id')
									 ->where('item_log.document_type','=','PR')
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->where('isd.department_id',auth()->user()->department_id)
									 ->whereNull('item_log.deleted_at')
									 ->where('purchase_return.department_id',auth()->user()->department_id)
									 ->where('purchase_return.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query3->whereBetween('purchase_return.voucher_date', array($date_from, $date_to));
			
			$result3 = $query3->select('item_log.id','purchase_return.voucher_no','purchase_return.voucher_date','account_master.master_name',DB::raw('"PR" AS type'),'purchase_return.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','purchase_return.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
			
			//SALES RETURN...						 
			$query4 = DB::table('item_log')->where('item_log.item_id', $attributes['document_id'])
									 ->join('sales_return','sales_return.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','sales_return.customer_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','sales_return.job_id')
									 ->where('item_log.document_type','=','SR')
									 ->where('item_log.status',1)
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->whereNull('item_log.deleted_at')
									 ->where('isd.department_id',auth()->user()->department_id)
									 ->where('sales_return.department_id',auth()->user()->department_id)
									 ->where('sales_return.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query4->whereBetween('sales_return.voucher_date', array($date_from, $date_to));
			
			$result4 = $query4->select('item_log.id','sales_return.voucher_no','sales_return.voucher_date','account_master.master_name',DB::raw('"SR" AS type'),'sales_return.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','sales_return.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
			
			//TRANSFER IN...						 
			$query5 = DB::table('item_log')->where('item_log.item_id', $attributes['document_id'])
									 ->join('stock_transferin','stock_transferin.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','stock_transferin.account_dr')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','stock_transferin.job_id')
									 ->where('item_log.document_type','=','TI')
									 ->where('item_log.status',1)
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->whereNull('item_log.deleted_at')
									 ->where('isd.department_id',auth()->user()->department_id)
									 ->where('stock_transferin.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query5->whereBetween('stock_transferin.voucher_date', array($date_from, $date_to));
			
			$result5 = $query5->select('item_log.id','stock_transferin.voucher_no','stock_transferin.voucher_date','account_master.master_name',DB::raw('"TI" AS type'),'stock_transferin.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','stock_transferin.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
										
			
			//GOODS RETURN...						 
			$query6 = DB::table('item_log')->where('item_log.item_id', $attributes['document_id'])
									 ->join('goods_return','goods_return.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','goods_return.account_master_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','goods_return.job_id')
									 ->where('item_log.document_type','=','GR')
									 ->where('item_log.status',1)
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->whereNull('item_log.deleted_at')
									 ->where('isd.department_id',auth()->user()->department_id)
									 ->where('goods_return.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query6->whereBetween('goods_return.voucher_date', array($date_from, $date_to));
			
			$result6 = $query6->select('item_log.id','goods_return.voucher_no','goods_return.voucher_date','account_master.master_name',DB::raw('"GR" AS type'),'goods_return.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','goods_return.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
			
			//TRANSFER OUT...						 
			$query7 = DB::table('item_log')->where('item_log.item_id', $attributes['document_id'])
									 ->join('stock_transferout','stock_transferout.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','stock_transferout.account_dr')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','stock_transferout.job_id')
									 ->where('item_log.document_type','=','TO')
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									 ->where('isd.department_id',auth()->user()->department_id)
									 ->where('stock_transferout.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query7->whereBetween('stock_transferout.voucher_date', array($date_from, $date_to));
			
			$result7 = $query7->select('item_log.id','stock_transferout.voucher_no','stock_transferout.voucher_date','account_master.master_name',DB::raw('"TO" AS type'),'stock_transferout.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','stock_transferout.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
			
			//GOODS ISSUED...						 
			$query8 = DB::table('item_log')->where('item_log.item_id', $attributes['document_id'])
									 ->join('goods_issued','goods_issued.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','goods_issued.account_master_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','goods_issued.job_id')
									 ->where('item_log.document_type','=','GI')
									 ->where('item_log.status',1)
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->whereNull('item_log.deleted_at')
									 ->where('isd.department_id',auth()->user()->department_id)
									 ->where('goods_issued.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query8->whereBetween('goods_issued.voucher_date', array($date_from, $date_to));
			
			$result8 = $query8->select('item_log.id','goods_issued.voucher_no','goods_issued.voucher_date','account_master.master_name',DB::raw('"GI" AS type'),'goods_issued.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','goods_issued.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');

			//CDO..	
			$query9 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('customer_do','customer_do.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','customer_do.customer_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->leftJoin('jobmaster','jobmaster.id','=','customer_do.job_id')
									 ->where('item_log.document_type','=','CDO')
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->whereNull('item_log.deleted_at')
									 ->where('isd.department_id',auth()->user()->department_id)
									 ->where('customer_do.department_id',auth()->user()->department_id)
									 ->where('customer_do.status',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query9->whereBetween('customer_do.voucher_date', array($date_from, $date_to));
			
			$result9 = $query9->select('item_log.id','customer_do.voucher_no','customer_do.voucher_date','account_master.master_name',DB::raw('"CDO" AS type'),'customer_do.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','customer_do.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno');
										
			$result['pursales'] = $result1->union($result1_1)->union($result2)->union($result3)->union($result4)->union($result5)->union($result6)->union($result7)->union($result8)->union($result9)->orderBy('vdate','ASC')->orderBy('id','ASC')->get();
		 
		return $result;
	}
	
	public function getStockLedgerLocReport($attributes)
	{
		$result = array();
		$date_from = ($attributes['date_from']!='')?date('Y-m-d', strtotime($attributes['date_from'])):'';
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):'';
						
			//OPENING QUANTITY DETAILS...
			$query0 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('itemmaster','itemmaster.id','=','item_log.item_id')
									 ->join('item_location AS IL', function($join) {
										$join->on('IL.item_id','=','item_log.item_id');
										} )
										->join('location AS L', function($join) {
											$join->on('L.id','=','IL.location_id');
										} )
									->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id');	
									 if(isset($attributes['location_id']) && $attributes['location_id']!='all')
										$query0->whereIn('IL.location_id', $attributes['location_id']);
									
									
										$query0->where('IL.status','=',1)
											  ->whereNull('IL.deleted_at')
											 ->where('item_log.document_type','=','OQ')
											 ->where('IL.opn_qty','>',0)
											 ->where('IL.department_id',auth()->user()->department_id)
											 ->where('L.status','=',1)
											 ->where('L.department_id',auth()->user()->department_id)
											  ->where('item_log.department_id',auth()->user()->department_id)
											   ->where('isd.department_id',auth()->user()->department_id)
											 ->where('itemmaster.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query0->whereBetween('item_log.voucher_date', array($date_from, $date_to));
			
			$result0 = $query0->select(DB::raw('" " AS voucher_no'),'item_log.voucher_date','itemmaster.description AS master_name',DB::raw('"OQ" AS type'),'item_log.created_at',
										'u.cost_avg','IL.opn_qty AS quantity','item_log.cur_quantity','item_log.unit_cost',DB::raw('" " AS vat_no'),'item_log.voucher_date AS vdate',
										'L.code','L.name','IL.opn_qty AS lqty','IL.location_id','item_log.sale_cost','item_log.pur_cost');
			
			//PURCHASE INVOICE..			
			$query1 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('purchase_invoice','purchase_invoice.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','purchase_invoice.supplier_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->join('item_location_pi AS IL', function($join) {
										$join->on('IL.logid','=','item_log.id');
										} )
										->join('location AS L', function($join) {
											$join->on('L.id','=','IL.location_id');
										} );
										
									 if(isset($attributes['location_id']) && $attributes['location_id']!='all')
										$query1->whereIn('IL.location_id', $attributes['location_id']);
									
									 if(isset($attributes['account_id']) && $attributes['account_id']!='all')
										$query1->whereIn('purchase_invoice.supplier_id', $attributes['account_id']);
									
										$query1->where('IL.status','=',1)
											 ->whereNull('IL.deleted_at')
											  ->where('L.department_id',auth()->user()->department_id)
											 ->where('item_log.document_type','=','PI')
											 ->where('item_log.status','=',1)
											  ->where('item_log.department_id',auth()->user()->department_id)
											  ->where('isd.department_id',auth()->user()->department_id)
											  ->where('purchase_invoice.department_id',auth()->user()->department_id)
											 ->where('purchase_invoice.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query1->whereBetween('purchase_invoice.voucher_date', array($date_from, $date_to));
			
			$result1 = $query1->select('purchase_invoice.voucher_no','purchase_invoice.voucher_date','account_master.master_name',DB::raw('"PI" AS type'),'purchase_invoice.created_at',
										'u.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','purchase_invoice.voucher_date AS vdate',
										'L.code','L.name','IL.quantity AS lqty','IL.location_id','item_log.sale_cost','item_log.pur_cost');
			//$result1 = $result1->orderBy('vdate','ASC')->orderBy('created_at','ASC');
			
			//SDO..	
			$query1_1 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('supplier_do','supplier_do.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','supplier_do.supplier_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->join('item_location_pi AS IL', function($join) {
										$join->on('IL.logid','=','item_log.id');
										})
									 ->join('location AS L', function($join) {
										$join->on('L.id','=','IL.location_id');
									 });
									 
									 if(isset($attributes['location_id']) && $attributes['location_id']!='all')
										$query1_1->whereIn('IL.location_id', $attributes['location_id']);
									
									 if(isset($attributes['account_id']) && $attributes['account_id']!='all')
										$query1_1->whereIn('supplier_do.supplier_id', $attributes['account_id']);
									 
									 $query1_1->where('IL.status','=',1)
											 ->whereNull('IL.deleted_at')
											 ->where('L.department_id',auth()->user()->department_id)
											 ->where('item_log.document_type','=','SDO')
											 ->where('supplier_do.status','=',1)
											 ->where('item_log.department_id',auth()->user()->department_id)
											 ->whereNull('item_log.deleted_at')
											 ->where('isd.department_id',auth()->user()->department_id)
											 ->where('supplier_do.department_id',auth()->user()->department_id)
											 ->where('supplier_do.status',1);
											 
				if(($date_from!='') && ($date_to!=''))
					$query1_1->whereBetween('supplier_do.voucher_date', array($date_from, $date_to));
				
				/* $result1_1 = $query1_1->select('item_log.id','supplier_do.voucher_no','supplier_do.voucher_date','account_master.master_name',DB::raw('"SDO" AS type'),'supplier_do.created_at','item_log.pur_cost',
										'item_log.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','supplier_do.voucher_date AS vdate','item_log.sale_cost',
										'jobmaster.code AS jobno'); */
										
				$result1_1 = $query1_1->select('supplier_do.voucher_no','supplier_do.voucher_date','account_master.master_name',DB::raw('"SDO" AS type'),'supplier_do.created_at',
										'u.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','supplier_do.voucher_date AS vdate',
										'L.code','L.name','IL.quantity AS lqty','IL.location_id','item_log.sale_cost','item_log.pur_cost');
									 
			//LOCATION TRANSFER...
			$query7 = DB::table('location_transfer')->where('location_transfer.status',1)
								->join('location_transfer_item','location_transfer_item.location_transfer_id','=','location_transfer.id')
								->leftJoin('customer_do_item AS DOI', function($join) {
									$join->on('DOI.id','=','location_transfer.typeid')
									->where('location_transfer.type','=','');
								})
								->join('location AS L', function($join) {
									$join->on('L.id','=','location_transfer.locfrom_id');
								})
								->join('item_location','item_location.id','=','location_transfer.locfrom_id')
								->where('location_transfer_item.item_id', $attributes['document_id']);
								
								if(isset($attributes['location_id']) && $attributes['location_id']!='all')
									$query7->whereIn('location_transfer.locto_id', $attributes['location_id']);

								$query7->whereNull('location_transfer.deleted_at')
								             ->where('location_transfer.department_id',auth()->user()->department_id)
											 ->where('L.department_id',auth()->user()->department_id)
											 ->where('item_location.department_id',auth()->user()->department_id)
									->whereNull('location_transfer_item.deleted_at');
									
								if(($date_from!='') && ($date_to!=''))
									$query7->whereBetween('location_transfer.voucher_date', array($date_from, $date_to));
											 
			$result7 = $query7->select('location_transfer.voucher_no','location_transfer.voucher_date','L.name AS master_name',DB::raw('"LT IN" AS type'),'location_transfer.created_at',
										'DOI.unit_price AS cost_avg','location_transfer_item.quantity','item_location.quantity AS cur_quantity','DOI.unit_price AS unit_cost',
										DB::raw('" " AS vat_no'),'location_transfer.voucher_date AS vdate','L.code','L.name','location_transfer_item.quantity AS lqty',
										'location_transfer.locto_id AS location_id',DB::raw('" " AS sale_cost'),DB::raw('" " AS pur_cost'));
										
			$query8 = DB::table('location_transfer')->where('location_transfer.status',1)
								->join('location_transfer_item','location_transfer_item.location_transfer_id','=','location_transfer.id')
								->leftJoin('customer_do_item AS DOI', function($join) {
									$join->on('DOI.id','=','location_transfer.typeid')
									->where('location_transfer.type','=','');
								})
								->join('location AS L', function($join) {
									$join->on('L.id','=','location_transfer.locto_id');
								})
								->join('item_location','item_location.id','=','location_transfer.locfrom_id')
								->where('location_transfer_item.item_id', $attributes['document_id']);
								
								if(isset($attributes['location_id']) && $attributes['location_id']!='all')
									$query8->whereIn('location_transfer.locfrom_id', $attributes['location_id']);

								$query8->whereNull('location_transfer.deleted_at')
								        ->where('location_transfer.department_id',auth()->user()->department_id)
											 ->where('L.department_id',auth()->user()->department_id)
											 ->where('item_location.department_id',auth()->user()->department_id)
									->whereNull('location_transfer_item.deleted_at');
									
								if(($date_from!='') && ($date_to!=''))
									$query8->whereBetween('location_transfer.voucher_date', array($date_from, $date_to));
											 
			$result8 = $query8->select('location_transfer.voucher_no','location_transfer.voucher_date','L.name AS master_name',DB::raw('"LT OUT" AS type'),'location_transfer.created_at',
										'DOI.unit_price AS cost_avg','location_transfer_item.quantity','item_location.quantity AS cur_quantity','DOI.unit_price AS unit_cost',
										DB::raw('" " AS vat_no'),'location_transfer.voucher_date AS vdate','L.code','L.name','location_transfer_item.quantity AS lqty',
										'location_transfer.locfrom_id AS location_id',DB::raw('" " AS sale_cost'),DB::raw('" " AS pur_cost'));
										
			
			//LOCATION TRANSFER (DO)...
			$query2 = DB::table('location_transfer')->where('location_transfer.status',1)
								->join('location_transfer_item','location_transfer_item.location_transfer_id','=','location_transfer.id')
								->join('customer_do_item AS DOI', function($join) {
									$join->on('DOI.id','=','location_transfer.typeid')
									->where('location_transfer.type','=','');
								})
								->join('location AS L', function($join) {
									$join->on('L.id','=','location_transfer.locfrom_id');
								})
								->join('item_location','item_location.id','=','location_transfer.locfrom_id')
								->where('location_transfer_item.item_id', $attributes['document_id']);
								
								if(isset($attributes['location_id']) && $attributes['location_id']!='all')
									$query2->whereIn('location_transfer.locto_id', $attributes['location_id']);

								$query2->whereNull('location_transfer.deleted_at')
								          ->where('location_transfer.department_id',auth()->user()->department_id)
											 ->where('L.department_id',auth()->user()->department_id)
											 ->where('item_location.department_id',auth()->user()->department_id)
									->whereNull('location_transfer_item.deleted_at');
									
								if(($date_from!='') && ($date_to!=''))
									$query2->whereBetween('location_transfer.voucher_date', array($date_from, $date_to));
											 
			$result2 = $query2->select('location_transfer.voucher_no','location_transfer.voucher_date','L.name AS master_name',DB::raw('"LT" AS type'),'location_transfer.created_at',
										'DOI.unit_price AS cost_avg','location_transfer_item.quantity','item_location.quantity AS cur_quantity','DOI.unit_price AS unit_cost',
										DB::raw('" " AS vat_no'),'location_transfer.voucher_date AS vdate','L.code','L.name','location_transfer_item.quantity AS lqty',
										'location_transfer.locto_id AS location_id',DB::raw('" " AS sale_cost'),DB::raw('" " AS pur_cost'));
										//->orderBy('vdate','ASC')->orderBy('created_at','ASC')->get();
			//echo '<pre>';print_r($result2);exit;
		
		//LOCATION TRANSFER DO CONSIGNMENT LOCATION...
			if($attributes['search_type']=='quantity_conloc' || $attributes['search_type']=='quantity_conloc_cost') {
				$query6 = DB::table('location_transfer')->where('location_transfer.status',1)
								->join('location_transfer_item','location_transfer_item.location_transfer_id','=','location_transfer.id')
								->join('customer_do_item AS DOI', function($join) {
									$join->on('DOI.id','=','location_transfer.typeid')
									->where('location_transfer.type','=','DO');
								})
								->join('location AS L', function($join) {
									$join->on('L.id','=','location_transfer.locto_id');
								})
								->join('item_location','item_location.id','=','location_transfer.locto_id')
								->where('location_transfer_item.item_id', $attributes['document_id']);
								
								if(isset($attributes['location_id']) && $attributes['location_id']!='all')
									$query6->whereIn('location_transfer.locto_id', $attributes['location_id']);

								$query6->whereNull('location_transfer.deleted_at')
								        ->where('location_transfer.department_id',auth()->user()->department_id)
											 ->where('L.department_id',auth()->user()->department_id)
											->where('item_location.department_id',auth()->user()->department_id)
									->whereNull('location_transfer_item.deleted_at');
									
								if(($date_from!='') && ($date_to!=''))
									$query6->whereBetween('location_transfer.voucher_date', array($date_from, $date_to));
											 
				$result6 = $query6->select('location_transfer.voucher_no','location_transfer.voucher_date','L.name AS master_name',DB::raw('"DO" AS type'),'location_transfer.created_at',
										'DOI.unit_price AS cost_avg','location_transfer_item.quantity','item_location.quantity AS cur_quantity','DOI.unit_price AS unit_cost',
										DB::raw('" " AS vat_no'),'location_transfer.voucher_date AS vdate','L.code','L.name','location_transfer_item.quantity AS lqty',
										'location_transfer.locto_id AS location_id',DB::raw('" " AS sale_cost'),DB::raw('" " AS pur_cost'));
				//$result6 = $query6->get();							
				//echo '<pre>';print_r($result6);exit;	
			}
			
			//SALES INVOICE...						 
			$query3 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('sales_invoice','sales_invoice.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','sales_invoice.customer_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->join('item_location_si AS IL', function($join) {
										$join->on('IL.logid','=','item_log.id');
									})
									->join('location AS L', function($join) {
											$join->on('L.id','=','IL.location_id');
									});
										
									 if(isset($attributes['location_id']) && $attributes['location_id']!='all')
										$query3->whereIn('IL.location_id', $attributes['location_id']);
									 
									  if(isset($attributes['account_id']) && $attributes['account_id']!='all')
										$query3->whereIn('sales_invoice.customer_id', $attributes['account_id']);
									
										$query3->where('IL.status','=',1)
											 ->whereNull('IL.deleted_at')
											 ->where('item_log.document_type','=','SI')
											 ->where('item_log.status','=',1)
											 ->where('IL.department_id',auth()->user()->department_id)
											 ->where('L.department_id',auth()->user()->department_id)
											 ->where('item_log.department_id',auth()->user()->department_id)
											 ->where('isd.department_id',auth()->user()->department_id)
											 ->where('sales_invoice.department_id',auth()->user()->department_id)
											 ->where('sales_invoice.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query3->whereBetween('sales_invoice.voucher_date', array($date_from, $date_to));
			
			$result3 = $query3->select('sales_invoice.voucher_no','sales_invoice.voucher_date','account_master.master_name',DB::raw('"SI" AS type'),'sales_invoice.created_at',
										'u.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','sales_invoice.voucher_date AS vdate',
										'L.code','L.name','IL.quantity AS lqty','IL.location_id','item_log.sale_cost','item_log.pur_cost');
			//$res = $result3->orderBy('vdate','ASC')->orderBy('created_at','ASC')->get();
				//echo "<pre>";print_r($res);exit;
				
				
		    //CDO...						 
			$query3_1 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('customer_do','customer_do.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','customer_do.customer_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->join('item_location_si AS IL', function($join) {
										$join->on('IL.logid','=','item_log.id');
									})
									->join('location AS L', function($join) {
											$join->on('L.id','=','IL.location_id');
									});
										
									 if(isset($attributes['location_id']) && $attributes['location_id']!='all')
										$query3_1->whereIn('IL.location_id', $attributes['location_id']);
									 
									  if(isset($attributes['account_id']) && $attributes['account_id']!='all')
										$query3_1->whereIn('customer_do.customer_id', $attributes['account_id']);
									
										$query3_1->where('IL.status','=',1)
											 ->whereNull('IL.deleted_at')
											 ->where('item_log.document_type','=','CDO')
											 ->where('IL.department_id',auth()->user()->department_id)
											 ->where('L.department_id',auth()->user()->department_id)
											 ->where('item_log.department_id',auth()->user()->department_id)
											 ->where('isd.department_id',auth()->user()->department_id)
											  ->where('customer_do.department_id',auth()->user()->department_id)
											 ->where('item_log.status','=',1)
											 ->where('customer_do.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query3_1->whereBetween('customer_do.voucher_date', array($date_from, $date_to));
			
			$result3_1 = $query3_1->select('customer_do.voucher_no','customer_do.voucher_date','account_master.master_name',DB::raw('"CDO" AS type'),'customer_do.created_at',
										'u.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','customer_do.voucher_date AS vdate',
										'L.code','L.name','IL.quantity AS lqty','IL.location_id','item_log.sale_cost','item_log.pur_cost');
										
										
			//PURCHASE RETURN.....
			$query4 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('purchase_return','purchase_return.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','purchase_return.supplier_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									  ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->join('item_location_pi AS IL', function($join) {
										$join->on('IL.logid','=','item_log.id');
										} )
									->join('location AS L', function($join) {
											$join->on('L.id','=','IL.location_id');
										} );
										
									 if(isset($attributes['location_id']) && $attributes['location_id']!='all')
										$query4->whereIn('IL.location_id', $attributes['location_id']);
									
									 if(isset($attributes['account_id']) && $attributes['account_id']!='all')
										$query4->whereIn('purchase_return.supplier_id', $attributes['account_id']);
									
										$query4->where('IL.status','=',1)
											 ->whereNull('IL.deleted_at')
											 ->where('item_log.document_type','=','PR')
											 ->where('item_log.department_id',auth()->user()->department_id)
											 ->where('isd.department_id',auth()->user()->department_id)
											 ->where('L.department_id',auth()->user()->department_id)
											 ->where('item_log.status','=',1)
											  ->where('purchase_return.department_id',auth()->user()->department_id)
											 ->where('purchase_return.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query4->whereBetween('purchase_return.voucher_date', array($date_from, $date_to));
			
			$result4 = $query4->select('purchase_return.voucher_no','purchase_return.voucher_date','account_master.master_name',DB::raw('"PR" AS type'),'purchase_return.created_at',
										'u.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','purchase_return.voucher_date AS vdate',
										'L.code','L.name','IL.quantity AS lqty','IL.location_id','item_log.sale_cost','item_log.pur_cost');
										
			//SALES RETURN...						 
			$query5 = DB::table('item_log')->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('sales_return','sales_return.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','sales_return.customer_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->join('item_location_sr AS CL', function($join) {
										$join->on('CL.logid','=','item_log.id');
									})
									->join('location AS L', function($join) {
											$join->on('L.id','=','CL.location_id');
									});
										
									 if(isset($attributes['location_id']) && $attributes['location_id']!='all')
										$query5->whereIn('CL.location_id', $attributes['location_id']);
									
									 if(isset($attributes['account_id']) && $attributes['account_id']!='all')
										$query5->whereIn('sales_return.customer_id', $attributes['account_id']);
									
										$query5->where('CL.status','=',1)
											 ->whereNull('CL.deleted_at')
											 ->where('L.department_id',auth()->user()->department_id)
											 ->where('item_log.document_type','=','SR')
											 ->where('item_log.department_id',auth()->user()->department_id)
											 ->where('isd.department_id',auth()->user()->department_id)
											 ->where('item_log.status','=',1)
											  ->where('sales_return.department_id',auth()->user()->department_id)
											 ->where('sales_return.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query5->whereBetween('sales_return.voucher_date', array($date_from, $date_to));
			
			$result5 = $query5->select('sales_return.voucher_no','sales_return.voucher_date','account_master.master_name',DB::raw('"SR" AS type'),'sales_return.created_at',
										'u.cost_avg','item_log.quantity','item_log.cur_quantity','item_log.unit_cost','account_master.vat_no','sales_return.voucher_date AS vdate',
										'L.code','L.name','CL.quantity AS lqty','CL.location_id','item_log.sale_cost','item_log.pur_cost');			
			
			if($attributes['search_type']=='quantity_conloc' || $attributes['search_type']=='quantity_conloc_cost')
				$result['pursales'] = $result0->union($result1)->union($result8)->union($result2)->union($result6)->union($result3)->union($result4)->union($result5)->orderBy('vdate','ASC')->orderBy('created_at','ASC')->get();//->toArray();
			else
				$result['pursales'] = $result0->union($result1)->union($result1_1)->union($result7)->union($result8)->union($result2)->union($result3)->union($result3_1)->union($result4)->union($result5)->orderBy('vdate','ASC')->orderBy('created_at','ASC')->get();//->toArray();
		
		//echo '<pre>';print_r($result);exit; //->union($result2)
		return $result;
	}
	
	public function getItemEnquiry($attributes) 
	{
		$date_from = ($attributes['date_from']!='')?date('Y-m-d', strtotime($attributes['date_from'])):'';
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):'';
		
		switch($attributes['search_type']) 
		{
			case 'PI';
				$qry = DB::table('purchase_invoice_item')->where('purchase_invoice_item.item_id', $attributes['item_id'])
								->join('purchase_invoice','purchase_invoice.id','=','purchase_invoice_item.purchase_invoice_id')
								->join('account_master','account_master.id','=','purchase_invoice.supplier_id')
								->join('itemmaster','itemmaster.id','=','purchase_invoice_item.item_id')
								->where('purchase_invoice.status',1)
								->whereNull('purchase_invoice.deleted_at')
								->whereNull('purchase_invoice_item.deleted_at');
								
						if(($date_from!='') && ($date_to!=''))
							$qry->whereBetween('purchase_invoice.voucher_date', array($date_from, $date_to));
			
						if($attributes['custsupp_id']!='')
							$qry->where('purchase_invoice.supplier_id', $attributes['custsupp_id']);
								
				$result	= $qry->select('purchase_invoice.voucher_no','purchase_invoice.reference_no','purchase_invoice.voucher_date','purchase_invoice.other_cost','purchase_invoice_item.othercost_unit',
										 'purchase_invoice_item.unit_price','purchase_invoice_item.total_price','itemmaster.description AS item_name','purchase_invoice_item.netcost_unit',
										 'account_master.master_name','purchase_invoice_item.item_id','itemmaster.item_code', DB::raw('SUM(purchase_invoice_item.quantity) As quantity'))
								->orderBy('purchase_invoice.voucher_date')->groupBy('purchase_invoice.id') //MY27
								->get();
			break;
			
			case 'SI';
				$qry = DB::table('sales_invoice_item')->where('sales_invoice_item.item_id', $attributes['item_id'])
								->join('sales_invoice','sales_invoice.id','=','sales_invoice_item.sales_invoice_id')
								->join('account_master','account_master.id','=','sales_invoice.customer_id')
								->join('itemmaster','itemmaster.id','=','sales_invoice_item.item_id')
								->where('sales_invoice.status',1)->whereNull('sales_invoice.deleted_at')
								->where('sales_invoice_item.status',1)->whereNull('sales_invoice_item.deleted_at');
						
						if(($date_from!='') && ($date_to!=''))
							$qry->whereBetween('sales_invoice.voucher_date', array($date_from, $date_to));
						
						if($attributes['custsupp_id']!='')
							$qry->where('sales_invoice.customer_id', $attributes['custsupp_id']);
						
					$result = $qry->select('sales_invoice.voucher_no','sales_invoice.reference_no','sales_invoice.voucher_date',DB::raw('0 AS othercost_unit'),
										 'sales_invoice_item.unit_price','sales_invoice_item.line_total AS total_price','itemmaster.description AS item_name',
										 'account_master.master_name','sales_invoice_item.item_id',DB::raw('0 AS other_cost'),'itemmaster.item_code',
										 DB::raw('SUM(sales_invoice_item.quantity) As quantity'))
								->orderBy('sales_invoice.voucher_date')->groupBy('sales_invoice.id')
								->get();
			break;
			
			case 'PO';
				$qry = DB::table('purchase_order_item')->where('purchase_order_item.item_id', $attributes['item_id'])
								->join('purchase_order','purchase_order.id','=','purchase_order_item.purchase_order_id')
								->join('account_master','account_master.id','=','purchase_order.supplier_id')
								->join('itemmaster','itemmaster.id','=','purchase_order_item.item_id')
								->where('purchase_order.status',1)
								->whereNull('purchase_order.deleted_at');
					
					if(($date_from!='') && ($date_to!=''))
							$qry->whereBetween('purchase_order.voucher_date', array($date_from, $date_to));
						
					if($attributes['custsupp_id']!='')
							$qry->where('purchase_order.supplier_id', $attributes['custsupp_id']);
								
				$result = $qry->select('purchase_order.voucher_no','purchase_order.reference_no','purchase_order.voucher_date',DB::raw('0 AS othercost_unit'),
										 'purchase_order_item.unit_price','purchase_order_item.total_price','itemmaster.description AS item_name',
										 'account_master.master_name','purchase_order_item.item_id',DB::raw('0 AS other_cost'),'itemmaster.item_code',
										  DB::raw('SUM(purchase_order_item.quantity) As quantity'))
								->orderBy('purchase_order.voucher_date')->groupBy('purchase_order.id')->get();
			break;
			
			case 'SO';
				$qry = DB::table('sales_order_item')->where('sales_order_item.item_id', $attributes['item_id'])
								->join('sales_order','sales_order.id','=','sales_order_item.sales_order_id')
								->join('account_master','account_master.id','=','sales_order.customer_id')
								->join('itemmaster','itemmaster.id','=','sales_order_item.item_id')
								->where('sales_order.status',1)
								->whereNull('sales_order.deleted_at');
					
					if(($date_from!='') && ($date_to!=''))
							$qry->whereBetween('sales_order.voucher_date', array($date_from, $date_to));
						
					if($attributes['custsupp_id']!='')
							$qry->where('sales_order.customer_id', $attributes['custsupp_id']);
								
				$result = $qry->select('sales_order.voucher_no','sales_order.reference_no','sales_order.voucher_date',DB::raw('0 AS othercost_unit'),
										 'sales_order_item.quantity','sales_order_item.unit_price','sales_order_item.line_total AS total_price','itemmaster.description AS item_name',
										 'account_master.master_name','sales_order_item.item_id',DB::raw('0 AS other_cost'),'itemmaster.item_code',
										 DB::raw('SUM(sales_order_item.quantity) As quantity'))
								->orderBy('sales_order.voucher_date')->groupBy('sales_order.id')->get();
			break;
			
			case 'PR';
				$qry = DB::table('purchase_return_item')->where('purchase_return_item.item_id', $attributes['item_id'])
								->join('purchase_return','purchase_return.id','=','purchase_return_item.purchase_return_id')
								->join('account_master','account_master.id','=','purchase_return.supplier_id')
								->join('itemmaster','itemmaster.id','=','purchase_return_item.item_id')
								->where('purchase_return.status',1)
								->whereNull('purchase_return.deleted_at');
						
						if(($date_from!='') && ($date_to!=''))
							$qry->whereBetween('purchase_return.voucher_date', array($date_from, $date_to));
						
						if($attributes['custsupp_id']!='')
							$qry->where('purchase_return.supplier_id', $attributes['custsupp_id']);
								
				$result = $qry->select('purchase_return.voucher_no','purchase_return.reference_no','purchase_return.voucher_date',DB::raw('0 AS othercost_unit'),
										 'purchase_return_item.unit_price','purchase_return_item.total_price','itemmaster.description AS item_name',
										 'account_master.master_name','purchase_return_item.item_id',DB::raw('0 AS other_cost'),'itemmaster.item_code',
										 DB::raw('SUM(purchase_return_item.quantity) As quantity'))
								->orderBy('purchase_return.voucher_date')->groupBy('purchase_return.id')->get();
			break;
			
			case 'SR';
				$qry = DB::table('sales_return_item')->where('sales_return_item.item_id', $attributes['item_id'])
								->join('sales_return','sales_return.id','=','sales_return_item.sales_return_id')
								->join('account_master','account_master.id','=','sales_return.customer_id')
								->join('itemmaster','itemmaster.id','=','sales_return_item.item_id')
								->where('sales_return.status',1)
								->whereNull('sales_return.deleted_at');
						
						if(($date_from!='') && ($date_to!=''))
							$qry->whereBetween('sales_return.voucher_date', array($date_from, $date_to));
						
						if($attributes['custsupp_id']!='')
							$qry->where('sales_return.customer_id', $attributes['custsupp_id']);
								
				$result = $qry->select('sales_return.voucher_no','sales_return.reference_no','sales_return.voucher_date',DB::raw('0 AS othercost_unit'),
										 'sales_return_item.quantity','sales_return_item.unit_price','sales_return_item.total_price','itemmaster.description AS item_name',
										 'account_master.master_name','sales_return_item.item_id',DB::raw('0 AS other_cost'),'itemmaster.item_code',
										 DB::raw('SUM(sales_return_item.quantity) As quantity'))
								->orderBy('sales_return.voucher_date')->groupBy('sales_return.id')->get();
			break;
								
			default;
				$result = array();
		}
		
		return $result;
	}
	
	public function check_item($id)
	{
	    $count3 = DB::table('location_transfer_item')
		        ->join('location_transfer', 'location_transfer.id', '=', 'location_transfer_item.location_transfer_id')
				->where('location_transfer_item.item_id', $id)->where('location_transfer.department_id',auth()->user()->department_id)->where('location_transfer_item.status',1)
				->whereNull('location_transfer_item.deleted_at')->count();
		$count = DB::table('purchase_invoice_item')->where('status',1)->whereNull('deleted_at')->where('item_id', $id)->count();
		if($count > 0 || $count3 > 0 )
			return false;
		else {
			$count1 = DB::table('sales_invoice_item')
			->join('sales_invoice', 'sales_invoice.id', '=', 'sales_invoice_item.sales_invoice_id')->where('sales_invoice.department_id',auth()->user()->department_id)
			->where('sales_invoice_item.status',1)->whereNull('sales_invoice_item.deleted_at')->where('sales_invoice_item.item_id', $id)->count();
			$count2 = DB::table('item_log')->where('document_type','!=','OQ')->where('department_id',auth()->user()->department_id)
			->where('status',1)->whereNull('deleted_at')->where('item_id', $id)->count();
			if($count1 > 0 || $count2 > 0 )
				return false;
			else
				return true;
		}
			
	}
	
	public function updateUtility()
	{
		$result = DB::table('item_log')->where('item_log.status', 1)
							//->join('item_stock','item_stock.item_id', '=', 'item_unit.itemmaster_id')
							->whereNull('item_log.deleted_at')
							->where('item_log.cost_avg',0)
							->where('item_log.sale_cost',0)
							->where('item_log.document_type','SI')
							->select('item_log.*')
							->get();
					
		return $result;
	}
	
	public function updateAvgCost($itemid, $unitid, $avg_cost)
	{
		DB::table('item_unit')
					->where('itemmaster_id', $itemid)->where('unit_id', $unitid)
					->update(['cost_avg' => $avg_cost]);
	}
	
	// public function ajaxCreate($attributes)
	// {
	// 	DB::beginTransaction();
	// 	try { 
			
	// 		$check1 = $this->itemmaster->where('description', trim($attributes['description']))->where('status',1)->count();
	// 		$check2 = $this->itemmaster->where('item_code', trim($attributes['item_code']))->where('status',1)->count();
	// 		if(($check1 > 0) || ($check2 > 0))
	// 			return 0;
				
	// 		$this->itemmaster->item_code = trim($attributes['item_code']);
	// 		$this->itemmaster->description = trim($attributes['description']);
	// 		$this->itemmaster->description_ar =isset($attributes['descriptionar'])?$attributes['descriptionar']:'';
	// 		$this->itemmaster->class_id = $attributes['class_id'];
	// 		$this->itemmaster->status = 1;
	// 		$this->itemmaster->created_at = date('Y-m-d H:i:s');
	// 		$this->itemmaster->created_by = Auth::User()->id;
	// 		$this->itemmaster->fill($attributes)->save();
			
	// 		if($this->itemmaster->id) {
	// 			$itemunit = new ItemUnit();
	// 			$itemunit->itemmaster_id = $this->itemmaster->id;
	// 			$itemunit->unit_id = $attributes['unit'];
	// 			$itemunit->vat = $attributes['vat'];
	// 			$itemunit->packing = $attributes['uname'];
	// 			$itemunit->status = 1;
	// 			$itemunit->is_baseqty = 1;
	// 			$this->itemmaster->itemUnits()->save($itemunit);
				
	// 				//Item Stock Department
	// 			$departmentId = auth()->user()->department_id;
	// 			 $departments = DB::table('department')->where('deleted_at')->get();

    //                                   foreach ($departments as $dept) {
    //                                            $isCurrent = ($dept->id == $departmentId);

    //                                          DB::table('itemstock_department')->insert([
    //                                                     'itemmaster_id'      => $this->itemmaster->id,
    //                                                      'department_id'      => $dept->id,
	// 													 'unit_id'         => $attributes['unit'],
	// 													 'packing'         =>$attributes['uname'],
    //                                                       'is_baseqty'      =>1,
    //                                                       'vat'            =>$attributes['vat'],
	// 													 'status'             =>1
	// 													 ]);
                                         

    //                                   } 
	// 			//Item Stock Department End
				
	// 			$dtrow = DB::table('parameter1')->select('from_date')->first();
	// 			DB::table('item_log')->insert([
	// 							 'document_type' => 'OQ',
	// 							 'item_id' 	  => $this->itemmaster->id,
	// 							 'department_id'  =>auth()->user()->department_id,
	// 							 'unit_id'    => $attributes['unit'],
	// 							 'trtype'	  => 1,
	// 							 'packing' => 1,
	// 							 'status'     => 1,
	// 							 'created_at' => date('Y-m-d H:i:s'),
	// 							 'created_by' => Auth::User()->id,
	// 							 'voucher_date' => $dtrow->from_date
	// 							 //'voucher_date' => date('Y-m-d', strtotime('-1 day', strtotime($dtrow->from_date)))
	// 							]);
                        			
	// 			//...............ITEM LOCATION........
	// 			//$row = DB::table('location')->where('is_default',1)->where('status',1)->where('deleted_at')->first();
	// 			$rows = DB::table('location')->where('status',1)->where('department_id',auth()->user()->department_id)->where('deleted_at')->get();
	// 			if($rows){
	// 				foreach($rows as $row) {
	// 					$loc_id = ($row->is_default==1)?$row->id:'';
	// 					$itemLocation = new ItemLocation();
	// 					$itemLocation->location_id = $row->id;
	// 					$itemLocation->department_id = auth()->user()->department_id;
	// 					$itemLocation->item_id = $this->itemmaster->id;
	// 					$itemLocation->unit_id = ($attributes['unit']=='')?2:$attributes['unit'];
	// 					$itemLocation->status = 1;
	// 					$itemLocation->save();
						
	// 					if($loc_id) {
	// 						//API CALL...
	// 						$attributes['location_id'] = $loc_id;
	// 						$attributes['item_class'] = $attributes['class_id'];
	// 						$attributes['via'] = 'ajax';
	// 						$response = Curl::to($this->api_url.'itemadd.php')
	// 									->withData($attributes)
	// 									->asJson()
	// 									->post();
	// 					}
	// 				}
					
	// 			}
						
	// 		}
							
	// 		DB::commit();
	// 		return $this->itemmaster->id;
			
	// 	} catch(\Exception $e) {
				
	// 		DB::rollback();
	// 		return -1;
	// 	}
	// }


	/**
	 * Create item via AJAX (for quick add from other modules)
	 */
	public function ajaxCreate($attributes)
	{
		DB::beginTransaction();
		try {
			// Validate required fields
			if (empty($attributes['item_code']) || empty($attributes['description'])) {
				DB::rollback();
				return -1; // Missing required fields
			}
			
			// Sanitize inputs
			$item_code = trim($attributes['item_code']);
			$description = trim($attributes['description']);
			
			// Validate length constraints
			if (strlen($item_code) > 120) {
				DB::rollback();
				return -2; // Item code too long
			}
			
			if (strlen($description) > 1000) {
				DB::rollback();
				return -3; // Description too long
			}
			
			// Check for existing items (item_code OR description)
			$exists = $this->itemmaster
				->where(function($query) use ($item_code, $description) {
					$query->where('item_code', $item_code)
						->orWhere('description', $description);
				})
				->where('status', 1)
				->exists();
			
			if ($exists) {
				DB::rollback();
				return 0; // Duplicate found
			}
			
			// Get default unit
			$unitdat = DB::table('units')
				->whereNull('deleted_at')
				->orderBy('id')
				->first();
			
			if (!$unitdat) {
				DB::rollback();
				return -4; // No unit available
			}
			
			$departmentId = auth()->user()->department_id ?? 1;
			
			// Create item
			$this->itemmaster->fill([
				'item_code' => $item_code,
				'description' => $description,
				'description_ar' => $attributes['description_ar'] ?? '',
				'class_id' => $attributes['class_id'] ?? 0,
				'group_id' => $attributes['group_id'] ?? 0,
				'subgroup_id' => $attributes['subgroup_id'] ?? 0,
				'category_id' => $attributes['category_id'] ?? 0,
				'subcategory_id' => $attributes['subcategory_id'] ?? 0,
				'assembly' => 0,
				'status' => 1,
				'created_at' => now(),
				'created_by' => Auth::id(),
				'created_department' => $departmentId,
				'batch_req' => 0
			]);
			
			$this->itemmaster->save();
			$itemmaster_id = $this->itemmaster->id;
			
			if (!$itemmaster_id) {
				DB::rollback();
				return -5; // Save failed
			}
			
			// Create default item unit
			$this->createAjaxItemUnit($itemmaster_id, $unitdat->id, $departmentId);
			
			// Create item locations
			$this->createAjaxItemLocations($itemmaster_id, $unitdat->id, $departmentId);
			
			// Create department stock entries
			$this->createAjaxDepartmentStock($itemmaster_id, $unitdat->id, $departmentId);
			
			DB::commit();
			return $itemmaster_id; // Success - return new item ID
			
		} catch (\Exception $e) {
			DB::rollback();
			Log::error('AJAX item creation failed: ' . $e->getMessage(), [
				'attributes' => $attributes,
				'trace' => $e->getTraceAsString()
			]);
			return -99; // System error
		}
	}

	/**
	 * Create default item unit for AJAX created item
	 */
	private function createAjaxItemUnit($itemmaster_id, $unit_id, $departmentId)
	{
		$itemunit = new ItemUnit();
		$itemunit->itemmaster_id = $itemmaster_id;
		$itemunit->unit_id = $unit_id;
		$itemunit->packing = DB::table('units')->where('id', $unit_id)->value('unit_name') ?? '';
		$itemunit->opn_quantity = 0;
		$itemunit->opn_cost = 0;
		$itemunit->sell_price = 0;
		$itemunit->wsale_price = 0;
		$itemunit->min_quantity = 0;
		$itemunit->reorder_level = 0;
		$itemunit->vat = 0;
		$itemunit->status = 1;
		$itemunit->cur_quantity = 0;
		$itemunit->is_baseqty = 1;
		$itemunit->received_qty = 0;
		$itemunit->last_purchase_cost = 0;
		$itemunit->pur_count = 1;
		$itemunit->cost_avg = 0;
		$itemunit->pkno = 1;
		$itemunit->save();
	}

	/**
	 * Create item locations for AJAX created item
	 */
	private function createAjaxItemLocations($itemmaster_id, $unit_id, $departmentId)
	{
		$locations = DB::table('location')
			->where('department_id', $departmentId)
			->where('status', 1)
			->whereNull('deleted_at')
			->get();
		
		foreach ($locations as $location) {
			$itemLocation = new ItemLocation();
			$itemLocation->location_id = $location->id;
			$itemLocation->item_id = $itemmaster_id;
			$itemLocation->unit_id = $unit_id;
			$itemLocation->department_id = $departmentId;
			$itemLocation->quantity = 0;
			$itemLocation->status = 1;
			$itemLocation->opn_qty = 0;
			$itemLocation->bin_id = 0;
			$itemLocation->save();
		}
	}

	/**
	 * Create department stock for AJAX created item
	 */
	private function createAjaxDepartmentStock($itemmaster_id, $unit_id, $departmentId)
	{
		$departments = DB::table('department')
			->whereNull('deleted_at')
			->get();
		
		$packing = DB::table('units')->where('id', $unit_id)->value('unit_name') ?? '';
		
		foreach ($departments as $dept) {
			DB::table('itemstock_department')->insert([
				'itemmaster_id' => $itemmaster_id,
				'department_id' => $dept->id,
				'unit_id' => $unit_id,
				'packing' => $packing,
				'opn_cost' => 0,
				'opn_quantity' => 0,
				'cur_quantity' => 0,
				'received_qty' => 0,
				'issued_qty' => 0,
				'min_quantity' => 0,
				'reorder_level' => 0,
				'vat' => 0,
				'is_baseqty' => 1,
				'pur_count' => 1,
				'last_purchase_cost' => 0,
				'cost_avg' => 0,
				'status' => 1,
				'sell_price' => 0,
				'wsale_price' => 0,
				'pkno' => 1,
			]);
		}
	}


	
	public function getLocation()
	{
		return DB::table('location')->where('status',1)->where('department_id',auth()->user()->department_id)->where('is_conloc',0)->whereNull('deleted_at')->orderBy('id','ASC')->get();
	}
	
	public function getStockLocation($id)
	{
		return DB::table('item_location')
			->leftJoin('bin_location', 'bin_location.id', '=', 'item_location.bin_id')
			->leftJoin('location', 'location.id', '=', 'item_location.location_id')
			->where('item_location.status', 1)
			->where('item_location.item_id', $id)
			->where('item_location.department_id', auth()->user()->department_id ?? 1)
			->whereNull('item_location.deleted_at')
			->select(
				'item_location.*','bin_location.code',
				'bin_location.code as bin_code',
				'location.name as location_name',
				'location.code as location_code'
			)
			->orderBy('item_location.location_id', 'ASC')
			->get();
	}
	
	
	// public function getStockLocInfo($id,$invid,$type)
	// {
	// 	/* return DB::table('item_location')->where('item_location.status',1)
	// 						->leftJoin('location AS L', function($join){
	// 									$join->on('L.id','=','item_location.location_id');
	// 						})
	// 						->where('item_location.item_id',$id)
	// 						->where('item_location.deleted_at', '0000-00-00 00:00:00')
	// 						->select('L.name','item_location.quantity')
	// 						->get(); */
	// 	if(!$invid) {				
	// 		$qry =  DB::table('location')->where('location.status',1)->where('location.is_conloc',0)->where('location.department_id',auth()->user()->department_id)
	// 							->leftJoin('item_location AS IL', function($join) use($id){
	// 								$join->on('IL.location_id','=','location.id')->where('IL.item_id','=',$id)
	// 								->whereNull('IL.deleted_at');
	// 							})
	// 							->leftJoin('bin_location AS BL', function($join) {
	// 								$join->on('BL.id','=','IL.bin_id');
	// 							})
	// 						->whereNull('location.deleted_at');
							
	// 				if(Auth::user()->location_id > 0)
	// 					$qry->where('location.id', Auth::user()->location_id);
								
	// 		return $qry->select('location.code','location.name','IL.quantity','location.id','BL.code AS bin')->orderBy('location.id')->get();
			
	// 	} else {
	// 		if($type=='PI') {
				
	// 			$qry = DB::table('location')->where('location.status',1)->where('location.is_conloc',0)->where('location.department_id',auth()->user()->department_id)
	// 							->leftJoin('item_location AS IL', function($join) use($id){
	// 								$join->on('IL.location_id','=','location.id')->where('IL.item_id','=',$id)
	// 								->whereNull('IL.deleted_at');
	// 							})
	// 							->leftJoin('bin_location AS BL', function($join) {
	// 								$join->on('BL.id','=','IL.bin_id');
	// 							})
	// 							->leftJoin('item_location_pi AS PI', function($join) use($invid){
	// 								$join->on('PI.location_id','=','location.id')->where('PI.invoice_id','=',$invid)
	// 								->whereNull('PI.deleted_at')
	// 								->where('PI.is_sdo','=', 0);
	// 							})->whereNull('location.deleted_at');
								
	// 				if(Auth::user()->location_id > 0)
	// 					$qry->where('location.id', Auth::user()->location_id);
								
	// 			return $qry->select('location.code','location.name','IL.quantity','location.id','PI.quantity AS curqty','BL.code AS bin')->orderBy('location.id')->get();
								
	// 		} else if($type=='SI') {
				
	// 			$qry = DB::table('location')->where('location.status',1)->where('location.is_conloc',0)->where('location.department_id',auth()->user()->department_id)
	// 							->leftJoin('item_location AS IL', function($join) use($id){
	// 								$join->on('IL.location_id','=','location.id')->where('IL.item_id','=',$id)
	// 								->whereNull('IL.deleted_at');
	// 							})
	// 							->leftJoin('bin_location AS BL', function($join) use($id){
	// 								$join->on('BL.id','=','IL.bin_id');
	// 							})
	// 							->leftJoin('item_location_si AS SI', function($join) use($invid){
	// 								$join->on('SI.location_id','=','location.id')->where('SI.invoice_id','=',$invid)
	// 								->whereNull('SI.deleted_at')
	// 								->where('SI.is_do','=', 0);
	// 							})->whereNull('location.deleted_at');
								
	// 				if(Auth::user()->location_id > 0)
	// 					$qry->where('location.id', Auth::user()->location_id);
								
	// 			return $qry->select('location.code','location.name','IL.quantity','location.id','SI.quantity AS curqty','BL.code AS bin')->orderBy('location.id')->get();
			
	// 		} else if($type=='CDO') {
				
	// 			$qry = DB::table('location')->where('location.status',1)->where('location.is_conloc',0)->where('location.department_id',auth()->user()->department_id)
	// 							->leftJoin('item_location AS IL', function($join) use($id){
	// 								$join->on('IL.location_id','=','location.id')->where('IL.item_id','=',$id)
	// 								->whereNull('IL.deleted_at');
	// 							})
	// 							->leftJoin('bin_location AS BL', function($join) {
	// 								$join->on('BL.id','=','IL.bin_id');
	// 							})
	// 							->leftJoin('item_location_si AS SI', function($join) use($invid){
	// 								$join->on('SI.location_id','=','location.id')->where('SI.invoice_id','=',$invid)
	// 								->whereNull('SI.deleted_at')
	// 								->where('SI.is_do','=', 1);
	// 							})->whereNull('location.deleted_at');
								
	// 				if(Auth::user()->location_id > 0)
	// 					$qry->where('location.id', Auth::user()->location_id);
								
	// 			return $qry->select('location.code','location.name','IL.quantity','location.id','SI.quantity AS curqty','BL.code AS bin')->orderBy('location.id')->get();
				
	// 		} elseif($type=='SDO') {
				
	// 			$qry = DB::table('location')->where('location.status',1)->where('location.is_conloc',0)->where('location.department_id',auth()->user()->department_id)
	// 							->leftJoin('item_location AS IL', function($join) use($id){
	// 								$join->on('IL.location_id','=','location.id')->where('IL.item_id','=',$id)
	// 								->whereNull('IL.deleted_at');
	// 							})
	// 							->leftJoin('bin_location AS BL', function($join) {
	// 								$join->on('BL.id','=','IL.bin_id');
	// 							})
	// 							->leftJoin('item_location_pi AS PI', function($join) use($invid){
	// 								$join->on('PI.location_id','=','location.id')->where('PI.invoice_id','=',$invid)
	// 								->whereNull('PI.deleted_at')
	// 								->where('PI.is_sdo','=', 1);
	// 							})->whereNull('location.deleted_at');
								
	// 				if(Auth::user()->location_id > 0)
	// 					$qry->where('location.id', Auth::user()->location_id);
								
	// 			return $qry->select('location.code','location.name','IL.quantity','location.id','PI.quantity AS curqty','PI.qty_entry','BL.code AS bin')->orderBy('location.id')->get();
								
	// 		}
	// 	}
	// }


	public function getStockLocInfo($id, $invid = null, $type = null)
	{
		$deptId = auth()->user()->department_id;
		
		Log::info('getStockLocInfo called', [
			'item_id' => $id,
			'invoice_id' => $invid,
			'type' => $type,
			'department_id' => $deptId
		]);
		
		// Base query - always start with locations
		$qry = DB::table('location')
			->where('location.status', 1)
			->where('location.is_conloc', 0)
			->where('location.department_id', $deptId)
			->whereNull('location.deleted_at');
		
		// Filter by user's assigned location if applicable
		if (Auth::check() && Auth::user()->location_id > 0) {
			$qry->where('location.id', Auth::user()->location_id);
		}

		// Create subquery for item_location aggregated by location
		$ilSubquery = DB::table('item_location')
			->select(
				'location_id',
				DB::raw('SUM(quantity) as total_quantity'),
				DB::raw('SUM(opn_qty) as total_opn_qty'),
				DB::raw('GROUP_CONCAT(DISTINCT bin_id) as bin_ids'),
				DB::raw('MIN(id) as item_location_id')
			)
			->where('item_id', $id)
			->where('department_id', $deptId)
			->where('status', 1)
			->whereNull('deleted_at')
			->groupBy('location_id');
		
		// Join the aggregated item_location subquery
		$qry->leftJoinSub($ilSubquery, 'IL', function($join) {
			$join->on('IL.location_id', '=', 'location.id');
		});
		
		// Join bin_location using FIND_IN_SET for the concatenated bin_ids
		$qry->leftJoin('bin_location AS BL', function($join) {
			$join->whereRaw('FIND_IN_SET(BL.id, IL.bin_ids) > 0')
				->whereNull('BL.deleted_at');
		});
		
		// Add type-specific joins and selects
		if (!$invid) {
			// No invoice - just show item locations with current quantity
			$result = $qry->select(
				'location.id',
				'location.code',
				'location.name',
				// 'IL.quantity',           // Current quantity in this location
				// 'IL.opn_qty',            // Opening quantity
				// 'BL.code AS bin',
				// 'IL.id as item_location_id'
				'IL.total_quantity as quantity',
                'IL.total_opn_qty as opn_qty',
                DB::raw('GROUP_CONCAT(DISTINCT BL.code SEPARATOR ", ") as bin'),
            	'IL.item_location_id'
			)
			->groupBy('location.id', 'location.code', 'location.name', 'IL.total_quantity', 'IL.total_opn_qty', 'IL.item_location_id')
            ->orderBy('location.id')
            ->get();
			
		} else {
			switch ($type) {
				case 'PI': // Purchase Invoice
                // Create subquery for item_location_pi aggregated by location
                $piSubquery = DB::table('item_location_pi')
                    ->select(
                        'location_id',
                        DB::raw('SUM(quantity) as total_pi_quantity')
                    )
                    ->where('invoice_id', $invid)
                    ->where('is_sdo', 0)
                    ->whereNull('deleted_at')
                    ->groupBy('location_id');
                
                $qry->leftJoinSub($piSubquery, 'PI', function($join) {
                    $join->on('PI.location_id', '=', 'location.id');
                });
                
                $result = $qry->select(
                        'location.id',
                        'location.code',
                        'location.name',
                        'IL.total_quantity as quantity',
                        'PI.total_pi_quantity as curqty',
                        DB::raw('GROUP_CONCAT(DISTINCT BL.code SEPARATOR ", ") as bin'),
                        'IL.item_location_id'
                    )
                    ->groupBy('location.id', 'location.code', 'location.name', 'IL.total_quantity', 'PI.total_pi_quantity', 'IL.item_location_id')
                    ->orderBy('location.id')
                    ->get();
                break;
					
				case 'SI': // Sales Invoice
                // Create subquery for item_location_si aggregated by location
                $siSubquery = DB::table('item_location_si')
                    ->select(
                        'location_id',
                        DB::raw('SUM(quantity) as total_si_quantity')
                    )
                    ->where('invoice_id', $invid)
                    ->where('is_do', 0)
                    ->whereNull('deleted_at')
                    ->groupBy('location_id');
                
                $qry->leftJoinSub($siSubquery, 'SI', function($join) {
                    $join->on('SI.location_id', '=', 'location.id');
                });
                
                $result = $qry->select(
                        'location.id',
                        'location.code',
                        'location.name',
                        'IL.total_quantity as quantity',
                        'SI.total_si_quantity as curqty',
                        DB::raw('GROUP_CONCAT(DISTINCT BL.code SEPARATOR ", ") as bin'),
                        'IL.item_location_id'
                    )
                    ->groupBy('location.id', 'location.code', 'location.name', 'IL.total_quantity', 'SI.total_si_quantity', 'IL.item_location_id')
                    ->orderBy('location.id')
                    ->get();
                break;
					
				case 'CDO': // Customer Delivery Order
                // Create subquery for item_location_si aggregated by location
                $siSubquery = DB::table('item_location_si')
                    ->select(
                        'location_id',
                        DB::raw('SUM(quantity) as total_si_quantity')
                    )
                    ->where('invoice_id', $invid)
                    ->where('is_do', 1)
                    ->whereNull('deleted_at')
                    ->groupBy('location_id');
                
                $qry->leftJoinSub($siSubquery, 'SI', function($join) {
                    $join->on('SI.location_id', '=', 'location.id');
                });
                
                $result = $qry->select(
                        'location.id',
                        'location.code',
                        'location.name',
                        'IL.total_quantity as quantity',
                        'SI.total_si_quantity as curqty',
                        DB::raw('GROUP_CONCAT(DISTINCT BL.code SEPARATOR ", ") as bin'),
                        'IL.item_location_id'
                    )
                    ->groupBy('location.id', 'location.code', 'location.name', 'IL.total_quantity', 'SI.total_si_quantity', 'IL.item_location_id')
                    ->orderBy('location.id')
                    ->get();
                break;
            
				case 'SDO': // Supplier Delivery Order
					// Create subquery for item_location_pi aggregated by location
					$piSubquery = DB::table('item_location_pi')
						->select(
							'location_id',
							DB::raw('SUM(quantity) as total_pi_quantity'),
							DB::raw('SUM(qty_entry) as total_qty_entry')
						)
						->where('invoice_id', $invid)
						->where('is_sdo', 1)
						->whereNull('deleted_at')
						->groupBy('location_id');
					
					$qry->leftJoinSub($piSubquery, 'PI', function($join) {
						$join->on('PI.location_id', '=', 'location.id');
					});
					
					$result = $qry->select(
							'location.id',
							'location.code',
							'location.name',
							'IL.total_quantity as quantity',
							'PI.total_pi_quantity as curqty',
							'PI.total_qty_entry as qty_entry',
							DB::raw('GROUP_CONCAT(DISTINCT BL.code SEPARATOR ", ") as bin'),
							'IL.item_location_id'
						)
						->groupBy('location.id', 'location.code', 'location.name', 'IL.total_quantity', 'PI.total_pi_quantity', 'PI.total_qty_entry', 'IL.item_location_id')
						->orderBy('location.id')
						->get();
					break;
					
					default:
						$result = $qry->select(
							'location.id',
							'location.code',
							'location.name',
							'IL.total_quantity as quantity',
							DB::raw('GROUP_CONCAT(DISTINCT BL.code SEPARATOR ", ") as bin'),
							'IL.item_location_id'
						)
						->groupBy('location.id', 'location.code', 'location.name', 'IL.total_quantity', 'IL.item_location_id')
						->orderBy('location.id')
						->get();
					break;
			}
		}
		
		Log::info('getStockLocInfo result', [
			'item_id' => $id,
			'invoice_id' => $invid,
			'type' => $type,
			'count' => $result->count(),
			'sample_data' => $result->first()
		]);
		
		return $result;
	}
	

	// public function getStockIntraLocInfo($id,$invid,$type)
	// {
		
	// 	if(!$invid) {				
	// 		$qry =  DB::table('location')->where('location.status',1)->where('location.is_conloc',0)->where('location.department_id','!=',auth()->user()->department_id)
	// 							->leftJoin('item_location AS IL', function($join) use($id){
	// 								$join->on('IL.location_id','=','location.id')->where('IL.item_id','=',$id)
	// 								->whereNull('IL.deleted_at');
	// 							})
	// 							->leftJoin('bin_location AS BL', function($join) {
	// 								$join->on('BL.id','=','IL.bin_id');
	// 							})
	// 						->whereNull('location.deleted_at');
							
	// 				if(Auth::user()->location_id > 0)
	// 					$qry->where('location.id', Auth::user()->location_id);
								
	// 		return $qry->select('location.code','location.name','IL.quantity','location.id','BL.code AS bin')->orderBy('location.id')->get();
			
	// 	} else {
	// 		if($type=='PI') {
				
	// 			$qry = DB::table('location')->where('location.status',1)->where('location.is_conloc',0)->where('location.department_id','!=',auth()->user()->department_id)
	// 							->leftJoin('item_location AS IL', function($join) use($id){
	// 								$join->on('IL.location_id','=','location.id')->where('IL.item_id','=',$id)
	// 								->whereNull('IL.deleted_at');
	// 							})
	// 							->leftJoin('bin_location AS BL', function($join) {
	// 								$join->on('BL.id','=','IL.bin_id');
	// 							})
	// 							->leftJoin('item_location_pi AS PI', function($join) use($invid){
	// 								$join->on('PI.location_id','=','location.id')->where('PI.invoice_id','=',$invid)
	// 								->whereNull('PI.deleted_at')
	// 								->where('PI.is_sdo','=', 0);
	// 							})->whereNull('location.deleted_at');
								
	// 				if(Auth::user()->location_id > 0)
	// 					$qry->where('location.id', Auth::user()->location_id);
								
	// 			return $qry->select('location.code','location.name','IL.quantity','location.id','PI.quantity AS curqty','BL.code AS bin')->orderBy('location.id')->get();
								
	// 		} else if($type=='SI') {
				
	// 			$qry = DB::table('location')->where('location.status',1)->where('location.is_conloc',0)->where('location.department_id','!=',auth()->user()->department_id)
	// 							->leftJoin('item_location AS IL', function($join) use($id){
	// 								$join->on('IL.location_id','=','location.id')->where('IL.item_id','=',$id)
	// 								->whereNull('IL.deleted_at');
	// 							})
	// 							->leftJoin('bin_location AS BL', function($join) use($id){
	// 								$join->on('BL.id','=','IL.bin_id');
	// 							})
	// 							->leftJoin('item_location_si AS SI', function($join) use($invid){
	// 								$join->on('SI.location_id','=','location.id')->where('SI.invoice_id','=',$invid)
	// 								->whereNull('SI.deleted_at')
	// 								->where('SI.is_do','=', 0);
	// 							})->whereNull('location.deleted_at');
								
	// 				if(Auth::user()->location_id > 0)
	// 					$qry->where('location.id', Auth::user()->location_id);
								
	// 			return $qry->select('location.code','location.name','IL.quantity','location.id','SI.quantity AS curqty','BL.code AS bin')->orderBy('location.id')->get();
			
	// 		} else if($type=='CDO') {
				
	// 			$qry = DB::table('location')->where('location.status',1)->where('location.is_conloc',0)->where('location.department_id','!=',auth()->user()->department_id)
	// 							->leftJoin('item_location AS IL', function($join) use($id){
	// 								$join->on('IL.location_id','=','location.id')->where('IL.item_id','=',$id)
	// 								->whereNull('IL.deleted_at');
	// 							})
	// 							->leftJoin('bin_location AS BL', function($join) {
	// 								$join->on('BL.id','=','IL.bin_id');
	// 							})
	// 							->leftJoin('item_location_si AS SI', function($join) use($invid){
	// 								$join->on('SI.location_id','=','location.id')->where('SI.invoice_id','=',$invid)
	// 								->whereNull('SI.deleted_at')
	// 								->where('SI.is_do','=', 1);
	// 							})->whereNull('location.deleted_at');
								
	// 				if(Auth::user()->location_id > 0)
	// 					$qry->where('location.id', Auth::user()->location_id);
								
	// 			return $qry->select('location.code','location.name','IL.quantity','location.id','SI.quantity AS curqty','BL.code AS bin')->orderBy('location.id')->get();
				
	// 		} elseif($type=='SDO') {
				
	// 			$qry = DB::table('location')->where('location.status',1)->where('location.is_conloc',0)->where('location.department_id','!=',auth()->user()->department_id)
	// 							->leftJoin('item_location AS IL', function($join) use($id){
	// 								$join->on('IL.location_id','=','location.id')->where('IL.item_id','=',$id)
	// 								->whereNull('IL.deleted_at');
	// 							})
	// 							->leftJoin('bin_location AS BL', function($join) {
	// 								$join->on('BL.id','=','IL.bin_id');
	// 							})
	// 							->leftJoin('item_location_pi AS PI', function($join) use($invid){
	// 								$join->on('PI.location_id','=','location.id')->where('PI.invoice_id','=',$invid)
	// 								->whereNull('PI.deleted_at')
	// 								->where('PI.is_sdo','=', 1);
	// 							})->whereNull('location.deleted_at');
								
	// 				if(Auth::user()->location_id > 0)
	// 					$qry->where('location.id', Auth::user()->location_id);
								
	// 			return $qry->select('location.code','location.name','IL.quantity','location.id','PI.quantity AS curqty','PI.qty_entry','BL.code AS bin')->orderBy('location.id')->get();
								
	// 		}
	// 	}
	// }


	public function getStockIntraLocInfo($id, $invid = null, $type = null)
	{
		$deptId = auth()->user()->department_id;
		
		Log::info('getStockIntraLocInfo called', [
			'item_id' => $id,
			'invoice_id' => $invid,
			'type' => $type,
			'department_id' => $deptId
		]);
		
		// Base query - locations from OTHER departments
		$qry = DB::table('location')
			->where('location.status', 1)
			->where('location.is_conloc', 0)
			->where('location.department_id', '!=', $deptId)  // Different department
			->whereNull('location.deleted_at');
		
		// Filter by user's assigned location if applicable
		if (Auth::check() && Auth::user()->location_id > 0) {
			$qry->where('location.id', Auth::user()->location_id);
		}
		
		// Join item_location - need to match department too
		$qry->leftJoin('item_location AS IL', function($join) use ($id) {
			$join->on('IL.location_id', '=', 'location.id')
				->where('IL.item_id', '=', $id)
				->where('IL.status', '=', 1)
				->whereNull('IL.deleted_at');
		});
		
		// Join bin_location
		$qry->leftJoin('bin_location AS BL', function($join) {
			$join->on('BL.id', '=', 'IL.bin_id')
				->whereNull('BL.deleted_at');
		});
		
		// Rest is same as getStockLocInfo...
		if (!$invid) {
			$result = $qry->select(
				'location.id',
				'location.code',
				'location.name',
				'IL.quantity',
				'BL.code AS bin',
				'location.department_id'
			)
			->orderBy('location.id')
			->get();
		} else {
			// ... same switch logic as above
		}
		
		Log::info('getStockIntraLocInfo result', [
			'count' => $result->count()
		]);
		
		return $result;
	}

	
	public function getcnItemLocations() {
		
		return  DB::table('location')->where('location.status',1)->where('location.is_conloc',1)->get();
	}
	
	
	public function getStockcnLocInfo($id,$invid,$cst_id)
	{
		if(!$invid) {				
			$qry =  DB::table('location')->where('location.status',1)->where('location.is_conloc',1)
								->leftJoin('item_location AS IL', function($join) use($id){
									$join->on('IL.location_id','=','location.id')->where('IL.item_id','=',$id)
									->whereNull('IL.deleted_at');
								})->where('location.customer_id',$cst_id);
					if(Auth::user()->location_id > 0)
						$qry->where('location.id', Auth::user()->location_id);
								
			return $qry->select('location.name','IL.quantity','location.id')->orderBy('location.id')->get();
			
		} else {
			
			if($type=='SI') {
				
				$qry = DB::table('location')->where('location.status',1)->where('location.is_conloc',1)
								->leftJoin('item_location AS IL', function($join) use($id){
									$join->on('IL.location_id','=','location.id')->where('IL.item_id','=',$id)
									->whereNull('IL.deleted_at');
								})
								->leftJoin('item_location_si AS SI', function($join) use($invid){
									$join->on('SI.location_id','=','location.id')->where('SI.invoice_id','=',$invid)
									->whereNull('SI.deleted_at');
								})->where('location.customer_id',$cst_id);
								
					if(Auth::user()->location_id > 0)
						$qry->where('location.id', Auth::user()->location_id);
								
				return $qry->select('location.name','IL.quantity','location.id','SI.quantity AS curqty')->orderBy('location.id')->get();
			
			} elseif($type=='CDO') {
				
				$qry = DB::table('location')->where('location.status',1)->where('location.is_conloc',1)
								->leftJoin('item_location AS IL', function($join) use($id){
									$join->on('IL.location_id','=','location.id')->where('IL.item_id','=',$id)
									->whereNull('IL.deleted_at');
								})
								->leftJoin('item_location_si AS SI', function($join) use($invid){
									$join->on('SI.location_id','=','location.id')->where('SI.invoice_id','=',$invid)
									->whereNull('SI.deleted_at');
								})->where('location.customer_id',$cst_id);
								
					if(Auth::user()->location_id > 0)
						$qry->where('location.id', Auth::user()->location_id);
								
				return $qry->select('location.name','IL.quantity','location.id','SI.quantity AS curqty')->orderBy('location.id')->get();
								
			}
		}
	}
	
	
	public function getItemLocEdit($id,$type)
	{
		
		if($type=='PI') {
			return DB::table('purchase_invoice')
							->join('purchase_invoice_item AS QSI', function($join) {
								$join->on('QSI.purchase_invoice_id', '=', 'purchase_invoice.id');
							})
							->join('item_location_pi AS D', function($join) {
								$join->on('D.invoice_id', '=', 'QSI.id')->where('D.is_sdo','=',0); //NOV24
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.location_id','=','D.location_id');
								$join->on('IL.item_id','=','D.item_id');
								//$join->on('IL.unit_id','=', 'D.unit_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','D.location_id');
							})
							->where('purchase_invoice.id', $id)
							->where('QSI.status',1)
							->whereNull('QSI.deleted_at')
							//->where('D.status',1) NOV24
							//->where('D.deleted_at') NOV24
							->where('L.is_conloc',0)
							->where('L.status',1)
							->where('L.department_id',auth()->user()->department_id)
							->whereNull('L.deleted_at')
							->select('D.*','L.name','IL.quantity AS cqty')
							->orderBy('D.id','ASC')->groupBy('D.id')
							->get();
							
		} else if($type=='PR') {
			
			return DB::table('purchase_invoice')
						->join('purchase_invoice_item AS QSI', function($join) {
							$join->on('QSI.purchase_invoice_id', '=', 'purchase_invoice.id');
						})
						->join('item_location_pr AS D', function($join) {
							$join->on('D.invoice_id', '=', 'QSI.id');//NOV24
						})
						->join('item_location AS IL', function($join) {
							$join->on('IL.location_id','=','D.location_id');
							$join->on('IL.item_id','=','D.item_id');
							//$join->on('IL.unit_id','=', 'D.unit_id');
						})
						->join('location AS L', function($join) {
							$join->on('L.id','=','D.location_id');
						})
						->where('purchase_invoice.id', $id)
						->where('QSI.status',1)
						->whereNull('QSI.deleted_at')
						//->where('D.status',1)//NOV24
						->where('L.department_id',auth()->user()->department_id)
						->where('L.is_conloc',0)
						//->where('D.deleted_at')//NOV24
						->where('L.status',1)
						->whereNull('L.deleted_at')
						->select('D.*','L.name','IL.quantity AS cqty')
						->orderBy('D.id','ASC')->groupBy('D.id')
						->get();
							
		} else if($type=='SI') {
			
			return DB::table('sales_invoice')
						->join('sales_invoice_item AS QSI', function($join) {
							$join->on('QSI.sales_invoice_id', '=', 'sales_invoice.id');
						})
						->join('item_location_si AS D', function($join) {
							$join->on('D.invoice_id', '=', 'QSI.id')->where('D.is_do','=',0);//NOV24
						})
						->join('item_location AS IL', function($join) {
							$join->on('IL.location_id','=','D.location_id');
							$join->on('IL.item_id','=','D.item_id');
							//$join->on('IL.unit_id','=', 'D.unit_id');
						})
						->join('location AS L', function($join) {
							$join->on('L.id','=','D.location_id');
						})
						->where('sales_invoice.id', $id)
						->where('QSI.status',1)
						->whereNull('QSI.deleted_at')
						//->where('D.status',1)//NOV24
						->where('L.is_conloc',0)
						->where('L.department_id',auth()->user()->department_id)
						//->where('D.deleted_at')//NOV24
						->where('L.status',1)
						->whereNull('L.deleted_at')
						->select('D.*','L.name','IL.quantity AS cqty')
						->orderBy('D.id','ASC')->groupBy('D.id')
						->get();
						
		} else if($type=='SR') {
			
			return DB::table('sales_return')
						->join('sales_return_item AS QSI', function($join) {
							$join->on('QSI.sales_return_id', '=', 'sales_return.id');
						})
						->join('item_location_sr AS D', function($join) {
							$join->on('D.invoice_id', '=', 'QSI.id');
						})
						->join('item_location AS IL', function($join) {
							$join->on('IL.location_id','=','D.location_id');
							$join->on('IL.item_id','=','D.item_id');
							//$join->on('IL.unit_id','=', 'D.unit_id');
						})
						->join('location AS L', function($join) {
							$join->on('L.id','=','D.location_id');
						})
						->where('sales_return.id', $id)
						->where('sales_return.department_id',auth()->user()->department_id)
						->where('QSI.status',1)
						->whereNull('QSI.deleted_at')
						->where('D.status',1)
						->where('L.is_conloc',0)
						->where('L.department_id',auth()->user()->department_id)
						->whereNull('D.deleted_at')
						->where('L.status',1)
						->whereNull('L.deleted_at')
						->select('D.*','L.name','IL.quantity AS cqty')
						->orderBy('D.id','ASC')->groupBy('D.id')
						->get();
						
		} else if($type=='SDO') {
			return DB::table('supplier_do')
							->join('supplier_do_item AS QSI', function($join) {
								$join->on('QSI.supplier_do_id', '=', 'supplier_do.id');
							})
							->join('item_location_pi AS D', function($join) {
								$join->on('D.invoice_id', '=', 'QSI.id')->where('D.is_sdo','=',1);
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.location_id','=','D.location_id');
								$join->on('IL.item_id','=','D.item_id');
								//$join->on('IL.unit_id','=', 'D.unit_id'); //MAY25
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','D.location_id');
							})
							->where('supplier_do.id', $id)
							->where('QSI.status',1)
							->whereNull('QSI.deleted_at')
							//->where('D.status',1) NOV24
							->where('L.is_conloc',0)
							//->where('D.deleted_at') NOV24
							->where('L.status',1)
							->where('L.department_id',auth()->user()->department_id)
							->whereNull('L.deleted_at')
							->select('D.*','L.name','IL.quantity AS cqty')
							->orderBy('D.id','ASC')->groupBy('D.id')
							->get();
							
		} else if($type=='CDO') {
			return DB::table('customer_do')
							->join('customer_do_item AS QSI', function($join) {
								$join->on('QSI.customer_do_id', '=', 'customer_do.id');
							})
							->join('item_location_si AS D', function($join) {
								$join->on('D.invoice_id', '=', 'QSI.id')->where('D.is_do','=',1);
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.location_id','=','D.location_id');
								$join->on('IL.item_id','=','D.item_id');
								//$join->on('IL.unit_id','=', 'D.unit_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','D.location_id');
							})
							->where('customer_do.id', $id)
							->where('QSI.status',1)
							->whereNull('QSI.deleted_at')
							//->where('D.status',1)NOV24
							->where('L.is_conloc',0)
							//->where('D.deleted_at')NOV24
							->where('L.status',1)
							->where('customer_do.department_id',auth()->user()->department_id)
							->where('L.department_id',auth()->user()->department_id)
							->whereNull('L.deleted_at')
							->select('D.*','L.name','IL.quantity AS cqty')
							->orderBy('D.id','ASC')->groupBy('D.id')
							->get();
						
		} else if($type=='TI') {
			
			return DB::table('stock_transferin')
							->join('stock_transferin_item AS QSI', function($join) {
								$join->on('QSI.stock_transferin_id', '=', 'stock_transferin.id');
							})
							->join('item_location_ti AS D', function($join) {
								$join->on('D.trin_id', '=', 'QSI.id');
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.location_id','=','D.location_id');
								$join->on('IL.item_id','=','D.item_id');
								//$join->on('IL.unit_id','=', 'D.unit_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','D.location_id');
							})
							->where('stock_transferin.id', $id)
							->where('QSI.status',1)
							->whereNull('QSI.deleted_at')
							->where('D.status',1)
							->where('D.deleted_at',null)
							->where('L.is_conloc',0)
							->where('L.status',1)
							->whereNull('L.deleted_at')
							->select('D.*','L.name','IL.quantity AS cqty')
							->orderBy('D.id','ASC')->groupBy('D.id')
							->get();
							
		} else if($type=='TO') {
			
			return DB::table('stock_transferout')
							->join('stock_transferout_item AS QSI', function($join) {
								$join->on('QSI.stock_transferout_id', '=', 'stock_transferout.id');
							})
							->join('item_location_to AS D', function($join) {
								$join->on('D.trout_id', '=', 'QSI.id');
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.location_id','=','D.location_id');
								$join->on('IL.item_id','=','D.item_id');
								//$join->on('IL.unit_id','=', 'D.unit_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','D.location_id');
							})
							->where('stock_transferout.id', $id)
							->where('QSI.status',1)
							->whereNull('QSI.deleted_at')
							->where('D.status',1)
							->where('D.deleted_at',null)
							->where('L.is_conloc',0)
							->where('L.status',1)
							->whereNull('L.deleted_at')
							->select('D.*','L.name','IL.quantity AS cqty')
							->orderBy('D.id','ASC')->groupBy('D.id')
							->get();
							
		} else if($type=='GI') {
			
			return DB::table('goods_issued')
							->join('goods_issued_item AS QSI', function($join) {
								$join->on('QSI.goods_issued_id', '=', 'goods_issued.id');
							})
							->join('item_location_gi AS D', function($join) {
								$join->on('D.gi_id', '=', 'QSI.id');
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.location_id','=','D.location_id');
								$join->on('IL.item_id','=','D.item_id');
								//$join->on('IL.unit_id','=', 'D.unit_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','D.location_id');
							})
							->where('goods_issued.id', $id)
							->where('QSI.status',1)
							->whereNull('QSI.deleted_at')
							//->where('D.status',1)//NOV24
							//->where('D.deleted_at',null)//NOV24
							->where('L.is_conloc',0)
							->where('L.status',1)
							->where('L.department_id',auth()->user()->department_id)
							->whereNull('L.deleted_at')
							->select('D.*','L.name','IL.quantity AS cqty')
							->orderBy('D.id','ASC')->groupBy('D.id')
							->get();
		} else if($type=='GR') {
			
			return DB::table('goods_return')
							->join('goods_return_item AS QSI', function($join) {
								$join->on('QSI.goods_return_id', '=', 'goods_return.id');
							})
							->join('item_location_gr AS D', function($join) {
								$join->on('D.gr_id', '=', 'QSI.id');
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.location_id','=','D.location_id');
								$join->on('IL.item_id','=','D.item_id');
								//$join->on('IL.unit_id','=', 'D.unit_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','D.location_id');
							})
							->where('goods_return.id', $id)
							->where('QSI.status',1)
							->whereNull('QSI.deleted_at')
							->where('D.status',1)
							->where('D.deleted_at',null)
							->where('L.is_conloc',0)
							->where('L.department_id',auth()->user()->department_id)
							->where('L.status',1)
							->whereNull('L.deleted_at')
							->select('D.*','L.name','IL.quantity AS cqty')
							->orderBy('D.id','ASC')->groupBy('D.id')
							->get();
		}
	}
	
	public function getcnItemLocEdit($id,$type) 
	{
		
		if($type=='SI') {
			
			return DB::table('sales_invoice')
						->join('sales_invoice_item AS QSI', function($join) {
							$join->on('QSI.sales_invoice_id', '=', 'sales_invoice.id');
						})
						->join('con_location AS D', function($join) {
							$join->on('D.invoice_id', '=', 'QSI.id')->where('D.is_do','=',0);
						})
						->join('location AS L', function($join) {
							$join->on('L.id','=','D.location_id')
								 ->where('L.is_conloc','=',1);
						})
						->where('sales_invoice.id', $id)
						->where('QSI.status',1)
						->whereNull('QSI.deleted_at')
						->where('D.status',1)
						->whereNull('D.deleted_at')
						->select('D.*','L.name')
						->get();
						
		} else if($type=='SR') {
			
			return DB::table('sales_return')
						->join('sales_return_item AS QSI', function($join) {
							$join->on('QSI.sales_return_id', '=', 'sales_return.id');
						})
						->join('con_location_sr AS D', function($join) {
							$join->on('D.invoice_id', '=', 'QSI.id');
						})
						->join('location AS L', function($join) {
							$join->on('L.id','=','D.location_id')->where('L.is_conloc','=',1);;
						})
						->where('sales_return.id', $id)
						->where('QSI.status',1)
						->whereNull('QSI.deleted_at')
						->where('D.status',1)
						->whereNull('D.deleted_at')
						->select('D.*','L.name')
						->get();
						
							
		} else if($type=='CDO') {
			return DB::table('customer_do')
							->join('customer_do_item AS QSI', function($join) {
								$join->on('QSI.customer_do_id', '=', 'customer_do.id');
							})
							->join('con_location AS D', function($join) {
								$join->on('D.invoice_id', '=', 'QSI.id')->where('D.is_do','=',1);
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','D.location_id')
								->where('L.is_conloc','=',1);
							})
							->where('customer_do.id', $id)
							->where('QSI.status',1)
							->whereNull('QSI.deleted_at')
							->where('D.status',1)
							->whereNull('D.deleted_at')
							->select('D.*','L.name')
							->get();
						
		}
	}
	
	public function getItemLocation($id,$type)
	{
		if($type=='PI') {						
			return DB::table('purchase_invoice')
							->join('purchase_invoice_item AS QSI', function($join) {
								$join->on('QSI.purchase_invoice_id', '=', 'purchase_invoice.id');
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.item_id','=','QSI.item_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','IL.location_id');
							})
							->where('purchase_invoice.id', $id)
							->where('QSI.status',1)
							->where('L.is_conloc',0)
							->whereNull('QSI.deleted_at')
							->where('L.status',1)
							->whereNull('L.deleted_at')
							->select('L.id','L.name','IL.quantity AS cqty')
							->groupBy('L.id')
							->get();
							
		} else if($type=='PR') {
			
			return DB::table('purchase_return')
							->join('purchase_return_item AS QSI', function($join) {
								$join->on('QSI.purchase_return_id', '=', 'purchase_return.id');
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.item_id','=','QSI.item_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','IL.location_id');
							})
							->where('purchase_return.id', $id)
							->where('QSI.status',1)
							->where('L.is_conloc',0)
							->whereNull('QSI.deleted_at')
							->where('L.status',1)
							->whereNull('L.deleted_at')
							->select('L.id','L.name','IL.quantity AS cqty')
							->groupBy('L.id')
							->get();
							
		} else if($type=='SI') {
			
			return DB::table('sales_invoice')
						->join('sales_invoice_item AS QSI', function($join) {
							$join->on('QSI.sales_invoice_id', '=', 'sales_invoice.id');
						})
						->join('item_location AS IL', function($join) {
							$join->on('IL.item_id','=','QSI.item_id');
						})
						->join('location AS L', function($join) {
							$join->on('L.id','=','IL.location_id');
						})
						->where('sales_invoice.id', $id)
						->where('QSI.status',1)
						->where('L.is_conloc',0)
						->whereNull('QSI.deleted_at')
						->where('L.status',1)
							->whereNull('L.deleted_at')
						->select('L.id','L.name','IL.quantity AS cqty')
						->groupBy('L.id')
						->get();
						
		} else if($type=='SR') {
			
			return DB::table('sales_return')
						->join('sales_return_item AS QSI', function($join) {
							$join->on('QSI.sales_return_id', '=', 'sales_return.id');
						})
						->join('item_location AS IL', function($join) {
							$join->on('IL.item_id','=','QSI.item_id');
						})
						->join('location AS L', function($join) {
							$join->on('L.id','=','IL.location_id');
						})
						->where('sales_return.id', $id)
						->where('QSI.status',1)
						->where('L.is_conloc',0)
						->whereNull('QSI.deleted_at')
						->where('L.status',1)
							->whereNull('L.deleted_at')
						->select('L.id','L.name','IL.quantity AS cqty')
						->groupBy('L.id')
						->get();
						
		} else if($type=='SDO') {						
			return DB::table('supplier_do')
							->join('supplier_do_item AS QSI', function($join) {
								$join->on('QSI.supplier_do_id', '=', 'supplier_do.id');
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.item_id','=','QSI.item_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','IL.location_id');
							})
							->where('supplier_do.id', $id)
							->where('QSI.status',1)
							->where('L.is_conloc',0)
							->whereNull('QSI.deleted_at')
							->where('L.status',1)
							->whereNull('L.deleted_at')
							->select('L.id','L.name','IL.quantity AS cqty')
							->groupBy('L.id')
							->get();
		
		} else if($type=='CDO') {						
			return DB::table('customer_do')
							->join('customer_do_item AS QSI', function($join) {
								$join->on('QSI.customer_do_id', '=', 'customer_do.id');
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.item_id','=','QSI.item_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','IL.location_id');
							})
							->where('customer_do.id', $id)
							->where('QSI.status',1)
							->where('L.is_conloc',0)
							->whereNull('QSI.deleted_at')
							->where('L.status',1)
							->whereNull('L.deleted_at')
							->select('L.id','L.name','IL.quantity AS cqty')
							->groupBy('L.id')
							->get();
		} else if($type=='TI') {
			return DB::table('stock_transferin')
							->join('stock_transferin_item AS QSI', function($join) {
								$join->on('QSI.stock_transferin_id', '=', 'stock_transferin.id');
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.item_id','=','QSI.item_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','IL.location_id');
							})
							->where('stock_transferin.id', $id)
							->where('QSI.status',1)
							->where('L.is_conloc',0)
							->whereNull('QSI.deleted_at')
							->where('L.status',1)
							->whereNull('L.deleted_at')
							->select('L.id','L.name','IL.quantity AS cqty')
							->groupBy('L.id')
							->get();
		} else if($type=='TO') {
			return DB::table('stock_transferout')
							->join('stock_transferout_item AS QSI', function($join) {
								$join->on('QSI.stock_transferout_id', '=', 'stock_transferout.id');
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.item_id','=','QSI.item_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','IL.location_id');
							})
							->where('stock_transferout.id', $id)
							->where('QSI.status',1)
							->where('L.is_conloc',0)
							->whereNull('QSI.deleted_at')
							->where('L.status',1)
							->whereNull('L.deleted_at')
							->select('L.id','L.name','IL.quantity AS cqty')
							->groupBy('L.id')
							->get();
							
		} else if($type=='GI') {
			return DB::table('goods_issued')
							->join('goods_issued_item AS QSI', function($join) {
								$join->on('QSI.goods_issued_id', '=', 'goods_issued.id');
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.item_id','=','QSI.item_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','IL.location_id');
							})
							->where('goods_issued.id', $id)
							->where('QSI.status',1)
							->where('L.is_conloc',0)
							->whereNull('QSI.deleted_at')
							->where('L.status',1)
							->whereNull('L.deleted_at')
							->select('L.id','L.name','IL.quantity AS cqty')
							->groupBy('L.id')
							->get();
		} else if($type=='GR') {
			return DB::table('goods_return')
							->join('goods_return_item AS QSI', function($join) {
								$join->on('QSI.goods_return_id', '=', 'goods_return.id');
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.item_id','=','QSI.item_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','IL.location_id');
							})
							->where('goods_return.id', $id)
							->where('QSI.status',1)
							->where('L.is_conloc',0)
							->whereNull('QSI.deleted_at')
							->where('L.status',1)
							->whereNull('L.deleted_at')
							->select('L.id','L.name','IL.quantity AS cqty')
							->groupBy('L.id')
							->get();
		}
	}
	
	
	public function getcnItemLocation($id,$type)
	{
		 if($type=='SI') {
			
			return DB::table('sales_invoice')
						->join('sales_invoice_item AS QSI', function($join) {
							$join->on('QSI.sales_invoice_id', '=', 'sales_invoice.id');
						})
						->join('item_location AS IL', function($join) {
							$join->on('IL.item_id','=','QSI.item_id');
						})
						->join('location AS L', function($join) {
							$join->on('L.id','=','IL.location_id');
						})
						->where('sales_invoice.id', $id)
						->where('QSI.status',1)
						->where('L.is_conloc',0)
						->whereNull('QSI.deleted_at')
						->select('L.id','L.name','IL.quantity AS cqty')
						->groupBy('L.id')
						->get();
						
		} else if($type=='SR') {
			
			return DB::table('sales_return')
						->join('sales_return_item AS QSI', function($join) {
							$join->on('QSI.sales_return_id', '=', 'sales_return.id');
						})
						->join('item_location AS IL', function($join) {
							$join->on('IL.item_id','=','QSI.item_id');
						})
						->join('location AS L', function($join) {
							$join->on('L.id','=','IL.location_id');
						})
						->where('sales_return.id', $id)
						->where('QSI.status',1)
						->where('L.is_conloc',0)
						->whereNull('QSI.deleted_at')
						->select('L.id','L.name','IL.quantity AS cqty')
						->groupBy('L.id')
						->get();
						
		} else if($type=='CDO') {						
			return DB::table('customer_do')
							->join('customer_do_item AS QSI', function($join) {
								$join->on('QSI.customer_do_id', '=', 'customer_do.id');
							})
							->join('item_location AS IL', function($join) {
								$join->on('IL.item_id','=','QSI.item_id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','IL.location_id');
							})
							->where('customer_do.id', $id)
							->where('QSI.status',1)
							->where('L.is_conloc',1)
							->whereNull('QSI.deleted_at')
							->select('L.id','L.name','IL.quantity AS cqty')
							->groupBy('L.id')
							->get();
		}
	}
	
	public function StockLocation($item_id) {
		
		return $this->itemmaster->where('itemmaster.status',1)->where('itemmaster.id', $item_id)
							->join('item_location AS IL', function($join) {
								$join->on('IL.item_id','=','itemmaster.id');
							})
							->join('location AS L', function($join) {
								$join->on('L.id','=','IL.location_id');
							})
							->where('L.is_conloc',0)
							->select('L.name','IL.quantity','L.id')
							->groupBy('IL.location_id')
							->get();
	}
	
	public function ItemLogProcess() {
		
		//API ...
		$location = DB::table('location')->where('is_default',1)->where('status',1)->whereNull('deleted_at')->select('id')->first();
		$response = Curl::to($this->api_url.'itemlog-process.php')
					->withData( array('id' => $location->id))
					//->asJson()
					->get();
					
		if($response) {
			$data = json_decode($response, true);
			//echo '<pre>';print_r($data);
			if(isset($data['items'])) {
				
				foreach($data['items'] as $item) {
					$res = $this->createByLogProcess($item,$location);
					//print_r($res);exit;
				}
				
			} 
		} 
	}
	
	private function createByLogProcess($attributes,$location) 
	{
		
		if($attributes['type']=='add') {
			$image = '';
			$this->itemmaster->item_code = $attributes['item']['item_code'];
			$this->itemmaster->description = $attributes['item']['description'];
			$this->itemmaster->class_id = $attributes['item']['class_id'];
			$this->itemmaster->model_no = $attributes['item']['model_no'];
			$this->itemmaster->serial_no = $attributes['item']['serial_no'];
			$this->itemmaster->group_id = $attributes['item']['group_id'];
			$this->itemmaster->subgroup_id = $attributes['item']['subgroup_id'];
			$this->itemmaster->category_id = $attributes['item']['category_id'];
			$this->itemmaster->subcategory_id = $attributes['item']['subcategory_id'];
			//$this->itemmaster->bin = $attributes['bin'];
			$this->itemmaster->assembly = $attributes['item']['assembly'];
			$this->itemmaster->image = $image;
			$this->itemmaster->status = 1;
			$this->itemmaster->created_at = date('Y-m-d H:i:s');
			$this->itemmaster->created_by = Auth::User()->id;
			$this->itemmaster->fill($attributes)->save();
			
			if($this->itemmaster->id) {
				$c = 1;
				foreach($attributes['item_unit'] as $row){
					$itemunit = new ItemUnit();
					if($row['unit_id']!="" || $c==1) {
						$itemunit->itemmaster_id = $this->itemmaster->id;
						$itemunit->unit_id = ($row['unit_id']=='')?2:$row['unit_id'];
						$itemunit->packing = ($row['packing']=='')?'PCS':$row['packing'];
						$itemunit->opn_quantity = 0;//$row['opn_quantity'];
						$itemunit->opn_cost = $row['opn_cost'];
						$itemunit->sell_price = $row['sell_price'];
						$itemunit->wsale_price = $row['wsale_price'];
						$itemunit->min_quantity = $row['min_quantity'];
						$itemunit->reorder_level = $row['reorder_level'];
						$itemunit->vat = $row['vat'];
						$itemunit->status = 1;
						$itemunit->cur_quantity = 0;//$row['opn_quantity'];
						$itemunit->is_baseqty = ($c==1)?$is_baseqty=1:$is_baseqty=0;
						$itemunit->received_qty = 0;//$row['opn_quantity'];
						$itemunit->cost_avg = ($row['opn_cost']==0)?$row['sell_price']:$row['opn_cost'];
						$this->itemmaster->itemUnits()->save($itemunit);
						$c++;

					}
				}
				
				//...............ITEM LOCATION........
				if(isset($attributes['item_location'])) {
					foreach($attributes['item_location'] as $loc) {
						$itemLocation = new ItemLocation();
						$itemLocation->location_id = $loc['location_id'];
						$itemLocation->department_id = auth()->user()->department_id;
						$itemLocation->item_id = $this->itemmaster->id;
						$itemLocation->unit_id = ($loc['unit_id']=='')?2:$loc['unit_id'];
						$itemLocation->quantity = $loc['quantity'];
						$itemLocation->status = 1;
						$itemLocation->opn_qty = $loc['opn_qty'];
						$itemLocation->save();
					}
				} 
				
				$response = Curl::to($this->api_url.'itemlog-process.php')
							->withData( array('id' => $attributes['process_id']))
							->asJson()
							->put();
				
			}
		} else {
			
			//...............ITEM LOCATION........
			if(isset($attributes['item_location'])) {
				foreach($attributes['item_location'] as $loc) {
					if($loc['location_id']!=$location->id) { //echo $loc['location_id'].$loc['item_id'];exit;
						DB::table('item_location')->where('location_id', $loc['location_id'])
												  ->where('item_id',$loc['item_id'])
												  ->where('unit_id',$loc['unit_id'])
												  ->update(['quantity' => $loc['quantity']]);
					}
				}
			} 
			
			$response = Curl::to($this->api_url.'itemlog-process.php')
						->withData( array('id' => $attributes['process_id']))
						->asJson()
						->put();
		}
		return true;
	}
	
	public function getItemsinLocation()
	{
		$result = Curl::to($this->api_url.'item.php')
						->get();
						
		return $result;
	}
	
	// public function ImportItems($data)
	// {  ##################  EXCEL FORMAT:   Item Code|Description|Unit|Quantity|Rate|Sales Price|Item Class|Group|Image|Model|Subgroup|Serial No|Other Info|Weight|Wsales Price  ######################
	// 	DB::beginTransaction();
	// 	try { //echo '<pre>';print_r($data);exit;
	// 		//foreach($data as $value) { open_quantity cost_avg rate item_class
				
	// 			//echo $value;exit;
    //             $item_id = null;
	// 			$mod_location = DB::table('parameter2')->where('keyname', 'mod_location')->where('status',1)->select('is_active')->first();

	// 			$location = DB::table('location')->where('is_default',1)->where('status',1)->where('deleted_at')->get();
	// 			$vat = DB::table('vat_master')->where('status',1)->where('deleted_at')->select('percentage')->first();
	// 			$dtrow = DB::table('parameter1')->select('from_date')->first();
	// 			foreach ($data as $row) { //
	// 			//	echo $row;exit;
				 
	// 			 if($row->item_code!='' && $row->description!='') {
	// 				//CHECK ITEM EXIST OR NOT
	// 				$item = DB::table('itemmaster')->where( function ($query) use($row) {
	// 													$query->where('item_code', '=', $row->item_code);
	// 														  //->orWhere('description', '=', $row->description);
	// 											   })->select('id')->get();
	// 				if(!$item) {
						
	// 					//CHECK GROUP NAME EXIST OR NOT....
	// 					$group_id = $subgroup_id = '';
	// 					if($row->group!='') {
	// 						$group = DB::table('groupcat')->where('group_name', $row->group)->where('status',1)
	// 											->where('deleted_at')->select('id')->first();
	// 						if($group)
	// 							$group_id = $group->id;
	// 						else {
	// 							$group_id = DB::table('groupcat')->insertGetId(['group_name' => $row->group, 'description' => $row->group, 'status'=>1]);
	// 						}

	// 						//SUBGROUP......
	// 						if($row->subgroup!='') {
	// 							$subgroup = DB::table('groupcat')->where('group_name', $row->subgroup)->where('status',1)->where('parent_id','!=',0)
	// 											->where('deleted_at')->select('id')->first();

	// 							if($subgroup)
	// 								$subgroup_id = $subgroup->id;
	// 							else {
	// 								$subgroup_id = DB::table('groupcat')->insertGetId(['group_name' => $row->subgroup, 'description' => $row->subgroup, 'parent_id' => $group_id, 'status'=>1]);
	// 							}
	// 						}
						
	// 					}
						
	// 					//$imgurl = 'https://urban-vision.crm.elateapps.com/assets/uploads/products/Screen_Shot_2022-12-19_at_5_18_04_PM.png';
	// 					$image_name = '';
	// 					//IMAGE UPLOAD FROM URL.............
	// 					if(isset($row->image) && $row->image!='') {
	// 						$ar1 = explode('products/',$row->image); //IF PRODUCT PATH CONTAINS 'products/' ONLY
	// 						if(isset($ar1[1])) {
	// 							$ex = explode('.',$ar1[1]); //EXPLODE BY FILE EXTESION
	// 							$destinationPath = public_path() . $this->imgDir.'/';
	// 							$content = file_get_contents($ar1[0].'products/'.rawurlencode($ar1[1]));
	// 							if(isset($ex[1])) {
	// 								//$image_name = time().'.'.$ex[1];
	// 								$image_name = $ar1[1];//$row->item_code.'.'.$ex[1];
	// 								//Store in the filesystem.
	// 								$fp = fopen($destinationPath."/".$image_name, "w");
	// 								fwrite($fp, $content);
	// 								fclose($fp);
	// 							}
	// 						}
	// 					}
						
	// 					//BATCH NO SECTION...
	// 					$batch_req = 0;
	// 					if($row->batch_no!='' && $row->mfg_date!='' && $row->exp_date!='' && $row->quantity!='') {
	// 					    $isbatch = DB::table('item_batch')->where('batch_no',$row->batch_no)->whereNull('deleted_at')->select('id')->first();
	// 					    if(!$isbatch)
	// 					        $batch_req = 1;
	// 					}
	// 					// end batch
						
	// 					$insert = ['item_code' => $row->item_code, 
	// 								 'description' => $row->description,
	// 								 'class_id' => ($row->item_class=='')?1:$row->item_class, 
	// 								 'model_no' => $row->model,
	// 								 'serial_no' => $row->serial_no,
	// 								 'group_id' => $group_id,
	// 								 'subgroup_id' => $subgroup_id,
	// 								 'weight'	=> $row->weight,
	// 								 'image' => $image_name,
	// 								 'status'   => 1,
	// 								 'created_at' => date('Y-m-d H:i:s'),
	// 								 'other_info' => $row->other_info,
	// 								 'batch_req' => $batch_req
	// 							  ];
						
	// 					if(isset($row->unit)) {
	// 						//GET UNIT ID
	// 						$unit = DB::table('units')->where('unit_name', strtoupper($row->unit))->select('id')->first();
	// 						if(!$unit) { //IF UNIT NOT EXIST...
	// 							if($row->unit!='')
	// 								$unit_id = DB::table('units')->insertGetId(['unit_name' => strtoupper($row->unit),'description' => strtoupper($row->unit),'status' => 1]);
	// 							else {
	// 								$unit_id = 2; $row->unit = 'PCS';
	// 							}
	// 						} else
	// 							$unit_id = $unit->id;
	// 					} else
	// 						$unit_id = 2;
						
	// 					$item_id = DB::table('itemmaster')->insertGetId($insert);
	// 					DB::table('item_unit')->insert(['itemmaster_id' => $item_id,
	// 													'unit_id' => $unit_id,
	// 													'packing' => strtoupper($row->unit),
	// 													'opn_quantity' => ($row->quantity=='')?0:$row->quantity,
	// 													'opn_cost' => ($row->rate=='')?0:$row->rate,
	// 													'sell_price' => ($row->sales_price=='')?0:$row->sales_price,
	// 													'wsale_price' => ($row->wsales_price=='')?0:$row->wsales_price,
	// 													'vat' => $vat->percentage,
	// 													'status' => 1,
	// 													'cur_quantity' => ($row->quantity=='')?0:$row->quantity,
	// 													'is_baseqty' => 1,
	// 													'cost_avg' => ($row->rate=='')?0:$row->rate
	// 													]);
														
	// 					$log_id = DB::table('item_log')->insertGetId([
    // 								'document_type' => 'OQ',
    // 								'document_id' => 0,
    // 								'item_id' => $item_id,
    // 								'unit_id' => $unit_id,
    // 								'quantity' => ($row->quantity=='')?0:$row->quantity,
    // 								'unit_cost' => ($row->rate=='')?0:$row->rate,
    // 								'trtype' => 1,
    // 								'cur_quantity' => ($row->quantity=='')?0:$row->quantity,
    // 								'cost_avg' => ($row->rate=='')?0:$row->rate,
    // 								'pur_cost' => ($row->rate=='')?0:$row->rate,
    // 								'packing' => 1,
    // 								'status' => 1,
    // 								'created_at' => date('Y-m-d H:i:s'),
    // 								'voucher_date' => $dtrow->from_date
    // 								//'voucher_date' => date('Y-m-d', strtotime('-1 day', strtotime($dtrow->from_date)))
    // 								]);
									
						    
	// 					    //BATCH SECTION....
	// 					    if($batch_req==1) {
    // 					    	$batch_id = DB::table('item_batch')
    //             				                ->insertGetId([
    //             				                    'item_id' => $item_id,
    //             				                    'batch_no' => $row->batch_no,
    //             				                    'mfg_date' => date('Y-m-d', strtotime($row->mfg_date)),
    //             				                    'exp_date' => date('Y-m-d', strtotime($row->exp_date)),
    //             				                    'quantity' => $row->quantity
    //             				                ]);
                				                
    //                     			if($batch_id) {
    //                     			    DB::table('batch_log')
    //                 				                ->insert([
    //                 				                    'batch_id' => $batch_id,
    //                 				                    'item_id' => $item_id,
    //                 				                    'document_type' => 'OQ',
    //                 				                    'quantity' => $row->quantity,
    //                 				                    'trtype' => 1,
    //                 				                    'invoice_date' => $dtrow->from_date,
    //                 				                    'log_id' => $log_id,
    //                 				                    'created_at' => date('Y-m-d h:i:s'),
    //                 				                    'created_by' => Auth::User()->id
    //                 				                    ]);
    //                     			}
	// 					        }
    //                 			//END BATCH
                    			
	// 					if($mod_location->is_active==0) {
	// 						if($location) {
	// 							foreach($location as $res) {
	// 								$itemLocation = new ItemLocation();
	// 								$itemLocation->location_id = $res->id;
	// 								$itemLocation->item_id = $item_id;
	// 								$itemLocation->unit_id = $unit_id;
	// 								$itemLocation->quantity = ($row->quantity=='')?0:$row->quantity;
	// 								$itemLocation->status = 1;
	// 								$itemLocation->opn_qty = ($row->quantity=='')?0:$row->quantity;
	// 								$itemLocation->save();
	// 							}
	// 						}

	// 					} else {

	// 						$locations = DB::table('location')->where('status',1)->where('deleted_at')->where('is_conloc',0)->get();
	// 						if($location) {
	// 							foreach($locations as $res) {

	// 								$strcode = strtolower($res->code).'_qty';
	// 								$strbin = strtolower($res->code).'_bin';
	// 								//echo '<br>'.$row->{$strbin}; exit;

	// 								$brow = DB::table('bin_location')->where('code',$row->{$strbin})->first();
	// 								if($brow) {
	// 									$binid = $brow->id;
	// 								} else {
	// 									$binid = DB::table('bin_location')->insertGetId(['code' => $row->{$strbin}, 'name' => $row->{$strbin}]);
	// 								}

	// 								$itemLocation = new ItemLocation();
	// 								$itemLocation->location_id = $res->id;
	// 								$itemLocation->item_id = $item_id;
	// 								$itemLocation->unit_id = $unit_id;
	// 								$itemLocation->quantity = ($row->{$strcode}=='')?0:$row->{$strcode};
	// 								$itemLocation->status = 1;
	// 								$itemLocation->opn_qty = ($row->{$strcode}=='')?0:$row->{$strcode};
	// 								$itemLocation->bin_id = $binid;
	// 								$itemLocation->save();
	// 							}
	// 						}

	// 					}
	// 			   }
	// 			 }
	// 			}
	// 		//}
			
	// 		DB::commit();
	// 		return $item_id;
			
	// 	} catch(\Exception $e) { 
		
	// 		DB::rollback(); echo $e->getLine().' - '.$e->getMessage();exit;
	// 		return false;
	// 	}
		
	// }


	/**
	 * Import items from Excel/CSV
	 * 
	 * @param array $data Array of row objects with properties
	 * @return array ['success' => bool, 'imported' => int, 'skipped' => int, 'errors' => array]
	 */
	public function ImportItems($data)
	{
		DB::beginTransaction();
		
		try {
			$imported = 0;
			$skipped = 0;
			$errors = [];
			$departmentId = auth()->user()->department_id ?? 1;
			
			// Get default unit once
			$defaultUnit = DB::table('units')
				->whereNull('deleted_at')
				->orderBy('id')
				->first();
			
			if (!$defaultUnit) {
				DB::rollback();
				return [
					'success' => false,
					'imported' => 0,
					'skipped' => 0,
					'errors' => ['No units available in system']
				];
			}
			
			foreach ($data as $index => $row) {
				$rowNumber = $index + 1;
				
				try {
					// Validate required fields
					$validationResult = $this->validateImportRow($row, $rowNumber);
					if ($validationResult !== true) {
						$errors[] = $validationResult;
						$skipped++;
						continue;
					}
					
					// Sanitize inputs
					$item_code = trim($row->item_code);
					$description = trim($row->description);
					$description_ar = isset($row->description_ar) ? trim($row->description_ar) : '';
					
					// Check for duplicate
					$exists = DB::table('itemmaster')
						->where('item_code', $item_code)
						->exists();
					
					if ($exists) {
						$errors[] = "Row $rowNumber: Item code '$item_code' already exists";
						$skipped++;
						continue;
					}
					
					// Get or create group/category IDs
					$groupData = $this->resolveImportGroupCategory($row);
					
					// Get unit ID
					$unit_id = $this->resolveImportUnit($row, $defaultUnit->id);
					
					// Prepare item data
					$itemData = $this->prepareImportItemData(
						$row, 
						$item_code, 
						$description, 
						$description_ar, 
						$groupData, 
						$departmentId
					);
					
					// Insert item
					$itemmaster_id = DB::table('itemmaster')->insertGetId($itemData);
					
					if (!$itemmaster_id) {
						$errors[] = "Row $rowNumber: Failed to insert item";
						$skipped++;
						continue;
					}
					
					// Create item unit
					$this->createImportItemUnit($itemmaster_id, $unit_id, $row, $departmentId);
					
					// Create item locations
					$this->createImportItemLocations($itemmaster_id, $unit_id, $departmentId);
					
					// Create department stock
					$this->createImportDepartmentStock($itemmaster_id, $unit_id, $row, $departmentId);
					
					// Create item log if opening quantity exists
					if (isset($row->opn_quantity) && $row->opn_quantity > 0) {
						$this->createImportItemLog($itemmaster_id, $unit_id, $row, $departmentId);
					}
					
					$imported++;
					
				} catch (\Exception $e) {
					$errors[] = "Row $rowNumber: " . $e->getMessage();
					$skipped++;
					Log::error("Import row $rowNumber failed", [
						'error' => $e->getMessage(),
						'row' => $row
					]);
				}
			}
			
			DB::commit();
			
			return [
				'success' => true,
				'imported' => $imported,
				'skipped' => $skipped,
				'errors' => $errors,
				'total' => count($data)
			];
			
		} catch (\Exception $e) {
			DB::rollback();
			Log::error('Import failed completely: ' . $e->getMessage());
			
			return [
				'success' => false,
				'imported' => 0,
				'skipped' => 0,
				'errors' => ['System error: ' . $e->getMessage()],
				'total' => count($data)
			];
		}
	}

	/**
	 * Validate import row data
	 */
	private function validateImportRow($row, $rowNumber)
	{
		// Check required fields
		if (empty($row->item_code) || empty($row->description)) {
			return "Row $rowNumber: Missing required fields (item_code or description)";
		}
		
		// Validate item_code length
		if (strlen(trim($row->item_code)) > 120) {
			return "Row $rowNumber: Item code exceeds 120 characters";
		}
		
		// Validate description length
		if (strlen(trim($row->description)) > 1000) {
			return "Row $rowNumber: Description exceeds 1000 characters";
		}
		
		// Validate numeric fields if present
		$numericFields = ['opn_quantity', 'opn_cost', 'sell_price', 'wsale_price', 'min_quantity', 'reorder_level'];
		foreach ($numericFields as $field) {
			if (isset($row->$field) && $row->$field !== '' && !is_numeric($row->$field)) {
				return "Row $rowNumber: Invalid numeric value for $field";
			}
		}
		
		return true;
	}

	/**
	 * Resolve group and category IDs from import data
	 */
	private function resolveImportGroupCategory($row)
	{
		$groupData = [
			'group_id' => 0,
			'subgroup_id' => 0,
			'category_id' => 0,
			'subcategory_id' => 0
		];
		
		// Resolve group
		if (isset($row->group_name) && !empty($row->group_name)) {
			$group = DB::table('groupcat')
				->where('group_name', trim($row->group_name))
				->where('parent_id', 0)
				->whereNull('deleted_at')
				->first();
			
			if ($group) {
				$groupData['group_id'] = $group->id;
			} else {
				// Create new group
				$groupData['group_id'] = DB::table('groupcat')->insertGetId([
					'group_name' => trim($row->group_name),
					'parent_id' => 0,
					'status' => 1,
					'created_at' => now(),
					'created_by' => Auth::id()
				]);
			}
		}
		
		// Resolve subgroup
		if (isset($row->subgroup_name) && !empty($row->subgroup_name) && $groupData['group_id'] > 0) {
			$subgroup = DB::table('groupcat')
				->where('group_name', trim($row->subgroup_name))
				->where('parent_id', $groupData['group_id'])
				->whereNull('deleted_at')
				->first();
			
			if ($subgroup) {
				$groupData['subgroup_id'] = $subgroup->id;
			} else {
				// Create new subgroup
				$groupData['subgroup_id'] = DB::table('groupcat')->insertGetId([
					'group_name' => trim($row->subgroup_name),
					'parent_id' => $groupData['group_id'],
					'status' => 1,
					'created_at' => now(),
					'created_by' => Auth::id()
				]);
			}
		}
		
		// Resolve category
		if (isset($row->category_name) && !empty($row->category_name)) {
			$category = DB::table('category')
				->where('category_name', trim($row->category_name))
				->where('parent_id', 0)
				->whereNull('deleted_at')
				->first();
			
			if ($category) {
				$groupData['category_id'] = $category->id;
			} else {
				// Create new category
				$groupData['category_id'] = DB::table('category')->insertGetId([
					'category_name' => trim($row->category_name),
					'parent_id' => 0,
					'status' => 1,
					'created_at' => now(),
					'created_by' => Auth::id()
				]);
			}
		}
		
		// Resolve subcategory
		if (isset($row->subcategory_name) && !empty($row->subcategory_name) && $groupData['category_id'] > 0) {
			$subcategory = DB::table('category')
				->where('category_name', trim($row->subcategory_name))
				->where('parent_id', $groupData['category_id'])
				->whereNull('deleted_at')
				->first();
			
			if ($subcategory) {
				$groupData['subcategory_id'] = $subcategory->id;
			} else {
				// Create new subcategory
				$groupData['subcategory_id'] = DB::table('category')->insertGetId([
					'category_name' => trim($row->subcategory_name),
					'parent_id' => $groupData['category_id'],
					'status' => 1,
					'created_at' => now(),
					'created_by' => Auth::id()
				]);
			}
		}
		
		return $groupData;
	}

	/**
	 * Resolve unit ID from import data
	 */
	private function resolveImportUnit($row, $defaultUnitId)
	{
		if (isset($row->unit_name) && !empty($row->unit_name)) {
			$unit = DB::table('units')
				->where('unit_name', trim($row->unit_name))
				->whereNull('deleted_at')
				->first();
			
			if ($unit) {
				return $unit->id;
			}
		}
		
		return $defaultUnitId;
	}

	/**
	 * Prepare item data array for import insert
	 */
	private function prepareImportItemData($row, $item_code, $description, $description_ar, $groupData, $departmentId)
	{
		return [
			'item_code' => $item_code,
			'description' => $description,
			'description_ar' => $description_ar,
			'class_id' => isset($row->class_id) ? (int)$row->class_id : 0,
			'model_no' => isset($row->model_no) ? trim($row->model_no) : '',
			'serial_no' => isset($row->serial_no) ? trim($row->serial_no) : '',
			'group_id' => $groupData['group_id'],
			'subgroup_id' => $groupData['subgroup_id'],
			'category_id' => $groupData['category_id'],
			'subcategory_id' => $groupData['subcategory_id'],
			'assembly' => 0,
			'status' => 1,
			'created_at' => now(),
			'created_by' => Auth::id(),
			'created_department' => $departmentId,
			'batch_req' => isset($row->batch_req) ? (int)$row->batch_req : 0,
			'profit_per' => isset($row->profit_per) ? (float)$row->profit_per : 0,
			'other_info' => isset($row->other_info) ? trim($row->other_info) : '',
		];
	}

	/**
	 * Create item unit for imported item
	 */
	private function createImportItemUnit($itemmaster_id, $unit_id, $row, $departmentId)
	{
		$unitName = DB::table('units')->where('id', $unit_id)->value('unit_name') ?? '';
		
		$opnQuantity = isset($row->opn_quantity) ? (float)$row->opn_quantity : 0;
		$opnCost = isset($row->opn_cost) ? (float)$row->opn_cost : 0;
		$sellPrice = isset($row->sell_price) ? (float)$row->sell_price : 0;
		$wsalePrice = isset($row->wsale_price) ? (float)$row->wsale_price : 0;
		$minQuantity = isset($row->min_quantity) ? (float)$row->min_quantity : 0;
		$reorderLevel = isset($row->reorder_level) ? (float)$row->reorder_level : 0;
		$vat = isset($row->vat) ? (float)$row->vat : 0;
		
		DB::table('item_unit')->insert([
			'itemmaster_id' => $itemmaster_id,
			'unit_id' => $unit_id,
			'packing' => $unitName,
			'opn_quantity' => $opnQuantity,
			'opn_cost' => $opnCost,
			'sell_price' => $sellPrice,
			'wsale_price' => $wsalePrice,
			'min_quantity' => $minQuantity,
			'reorder_level' => $reorderLevel,
			'vat' => $vat,
			'status' => 1,
			'cur_quantity' => $opnQuantity,
			'is_baseqty' => 1,
			'received_qty' => $opnQuantity,
			'last_purchase_cost' => $opnCost,
			'pur_count' => 1,
			'cost_avg' => $opnCost,
			'pkno' => 1,
		]);
	}

	/**
	 * Create item locations for imported item
	 */
	private function createImportItemLocations($itemmaster_id, $unit_id, $departmentId)
	{
		$locations = DB::table('location')
			->where('department_id', $departmentId)
			->where('status', 1)
			->whereNull('deleted_at')
			->get();
		
		foreach ($locations as $location) {
			DB::table('item_location')->insert([
				'location_id' => $location->id,
				'item_id' => $itemmaster_id,
				'unit_id' => $unit_id,
				'department_id' => $departmentId,
				'quantity' => 0,
				'status' => 1,
				'opn_qty' => 0,
				'bin_id' => 0,
			]);
		}
	}

	/**
	 * Create department stock for imported item
	 */
	private function createImportDepartmentStock($itemmaster_id, $unit_id, $row, $departmentId)
	{
		$departments = DB::table('department')->whereNull('deleted_at')->get();
		$unitName = DB::table('units')->where('id', $unit_id)->value('unit_name') ?? '';
		
		$opnQuantity = isset($row->opn_quantity) ? (float)$row->opn_quantity : 0;
		$opnCost = isset($row->opn_cost) ? (float)$row->opn_cost : 0;
		$sellPrice = isset($row->sell_price) ? (float)$row->sell_price : 0;
		$wsalePrice = isset($row->wsale_price) ? (float)$row->wsale_price : 0;
		$minQuantity = isset($row->min_quantity) ? (float)$row->min_quantity : 0;
		$reorderLevel = isset($row->reorder_level) ? (float)$row->reorder_level : 0;
		$vat = isset($row->vat) ? (float)$row->vat : 0;
		
		foreach ($departments as $dept) {
			$isCurrentDept = ($dept->id == $departmentId);
			
			DB::table('itemstock_department')->insert([
				'itemmaster_id' => $itemmaster_id,
				'department_id' => $dept->id,
				'unit_id' => $unit_id,
				'packing' => $unitName,
				'opn_cost' => $isCurrentDept ? $opnCost : 0,
				'opn_quantity' => $isCurrentDept ? $opnQuantity : 0,
				'cur_quantity' => $isCurrentDept ? $opnQuantity : 0,
				'received_qty' => $isCurrentDept ? $opnQuantity : 0,
				'issued_qty' => 0,
				'min_quantity' => $isCurrentDept ? $minQuantity : 0,
				'reorder_level' => $isCurrentDept ? $reorderLevel : 0,
				'vat' => $vat,
				'is_baseqty' => 1,
				'pur_count' => 1,
				'last_purchase_cost' => $isCurrentDept ? $opnCost : 0,
				'cost_avg' => $isCurrentDept ? $opnCost : 0,
				'status' => 1,
				'sell_price' => $isCurrentDept ? $sellPrice : 0,
				'wsale_price' => $isCurrentDept ? $wsalePrice : 0,
				'pkno' => 1,
			]);
		}
	}

	/**
	 * Create item log for imported item with opening quantity
	 */
	private function createImportItemLog($itemmaster_id, $unit_id, $row, $departmentId)
	{
		$dtrow = DB::table('parameter1')->select('from_date')->first();
		$voucherDate = $dtrow ? $dtrow->from_date : now();
		
		$opnQuantity = (float)$row->opn_quantity;
		$opnCost = isset($row->opn_cost) ? (float)$row->opn_cost : 0;
		
		DB::table('item_log')->insert([
			'document_type' => 'OQ',
			'department_id' => $departmentId,
			'item_id' => $itemmaster_id,
			'unit_id' => $unit_id,
			'quantity' => $opnQuantity,
			'unit_cost' => $opnCost,
			'trtype' => 1,
			'cur_quantity' => $opnQuantity,
			'cost_avg' => $opnCost,
			'pur_cost' => $opnCost,
			'sale_cost' => '',
			'packing' => 1,
			'status' => 1,
			'created_at' => now(),
			'created_by' => Auth::id(),
			'voucher_date' => $voucherDate
		]);
	}	


	
	public function addIteminAPI() {
		
		$items = DB::table('itemmaster')->join('item_unit', 'item_unit.itemmaster_id', '=', 'itemmaster.id')
								->select('item_unit.itemmaster_id','item_unit.unit_id','item_unit.cur_quantity')->get();
		foreach($items as $row) {
			
			DB::table('item_location1')->insert([
				'location_id' => 1,
				'item_id' => $row->itemmaster_id,
				'unit_id' => $row->unit_id,
				'quantity' => $row->cur_quantity,
				'status' => 1
			]);
		}
	}
	
	public function getItemByCode($code)
	{
		return $this->itemmaster->where('itemmaster.item_code',$code)
						->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
						->select('itemmaster.id','itemmaster.description','u.vat','u.unit_id','u.packing','u.cost_avg',
								 'u.last_purchase_cost')->first();
	}
	
	public function getPurchaseInfo($id)
	{
		//return DB::table('purchase_invoice')->where('purchase_invoice.satus',1)
		return $this->itemmaster->where('itemmaster.id',$id)
						->join('purchase_invoice_item AS PITM', function($join) {
								$join->on('PITM.item_id','=','itemmaster.id');
							} )
						->join('purchase_invoice AS PI', function($join) {
								$join->on('PI.id','=','PITM.purchase_invoice_id');
							} )
						->join('account_master AS AM', function($join) {
								$join->on('AM.id','=','PI.supplier_id');
							} )
						->join('units AS U', function($join) {
								$join->on('U.id','=','PITM.unit_id');
							} )
						->where('PITM.status',1)->whereNull('PITM.deleted_at')
						->select('PI.voucher_no','PI.voucher_date','PITM.quantity','PITM.unit_price','AM.master_name','U.unit_name')
						->orderBy('PI.voucher_date')
						->get();
	}
	
	public function getSalesInfo($id)
	{
		//return DB::table('purchase_invoice')->where('purchase_invoice.satus',1)
		return $this->itemmaster->where('itemmaster.id',$id)
						->join('sales_invoice_item AS SITM', function($join) {
								$join->on('SITM.item_id','=','itemmaster.id');
							} )
						->join('sales_invoice AS SI', function($join) {
								$join->on('SI.id','=','SITM.sales_invoice_id');
							} )
						->join('account_master AS AM', function($join) {
								$join->on('AM.id','=','SI.customer_id');
							} )
						->join('units AS U', function($join) {
								$join->on('U.id','=','SITM.unit_id');
							} )
						->select('SI.voucher_no','SI.voucher_date','SITM.quantity','SITM.unit_price','AM.master_name','U.unit_name')
						->orderBy('SI.voucher_date')
						->get();
	}
	
	public function getallUnits()
	{
		return DB::table('units')->where('status',1)->whereNull('deleted_at')->select('id','unit_name')->get();
	}
	
	public function getCustSalesInfo($id,$uid)
	{
		
		return $this->itemmaster->where('itemmaster.id',$id)
						->join('sales_invoice_item AS SITM', function($join) {
								$join->on('SITM.item_id','=','itemmaster.id');
							} )
						->join('sales_invoice AS SI', function($join) {
								$join->on('SI.id','=','SITM.sales_invoice_id');
							} )
						->join('account_master AS AM', function($join) {
								$join->on('AM.id','=','SI.customer_id');
							} )
						->where('SI.customer_id',$uid)
						->select('SI.voucher_no','SI.voucher_date','SITM.quantity',
								 'SITM.unit_price','AM.master_name')
						->orderBy('SI.voucher_date')
						->get();
	}
	
	public function getStockValue($attributes) {
		
		if($attributes['date_from']!='')
			$date_from = date('Y-m-d', strtotime($attributes['date_from']));
		else {
			$dt = DB::table('parameter1')->select('from_date')->first();
			$date_from = $dt->from_date;
		}
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):date('Y-m-d');
	
		$query = DB::table('itemmaster')->where('itemmaster.status', 1)		
						->join('item_unit AS u', function($join) {
							$join->on('u.itemmaster_id','=','itemmaster.id');
						} )
						->join('item_log AS IL', function($join) {
							$join->on('IL.item_id','=','itemmaster.id');
						} )
						->where('IL.status',1)
						->whereNull('IL.deleted_at')
						->where('u.is_baseqty','=',1);
		
		$query->whereBetween('IL.voucher_date', array($date_from, $date_to));
						
		$result = $query->select('IL.item_id','IL.cost_avg','IL.quantity','IL.trtype')->get();
	
		return $result;
	}
	
	public function getSupersedeInfo($id)
	{
		$res = $this->itemmaster->where('id',$id)->select('supersede_items')->first();
		if($res) {
			$ids = explode(',',$res->supersede_items);
			
			$query = $this->itemmaster->where('itemmaster.status', 1);
		
			return $query->join('item_unit AS u', function($join) {
								$join->on('u.itemmaster_id','=','itemmaster.id');
							} )
							->where('u.is_baseqty','=',1)
							->whereIn('itemmaster.id', $ids)
							->select('itemmaster.*','u.cur_quantity AS quantity','u.received_qty','u.last_purchase_cost','u.cost_avg','u.packing','u.sell_price','u.wsale_price','u.issued_qty')
							->get();
		}
		
	}
	
	public function getMargine($id,$cost) {
		
		$margin = 0;
		/* $res = $this->itemmaster->where('id',$id)->select('surface_cost','other_cost')->first();
		if($res) {
			$margin = $cost - $res->surface_cost+$res->other_cost;
		} */
		
		$res = DB::table('item_unit')->where('itemmaster_id',$id)->select('cost_avg')->first();
		if($res) {
			$val = $cost - $res->cost_avg;
			$per = $val / $cost;
			$margin = number_format($val,2).'('.number_format($per,2).'%)';
		}
		
		return $margin;
	}
	
	
	public function getStockTransactionReport($attributes)
	{
		$result = array();
		$date_from = ($attributes['date_from']!='')?date('Y-m-d', strtotime($attributes['date_from'])):date('Y-m-d');
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):date('Y-m-d');
		
			//OPENING DETAILS... 
			/* $result['OQ'] = DB::table('item_log')->where('item_log.status',1)//->where('item_log.item_id', $attributes['document_id'])
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemmaster AS itemmaster','itemmaster.id','=','item_log.item_id')
									 ->where('item_log.status',1)->where('item_log.deleted_at')
									 ->where('item_log.document_type','OQ')
									 ->where('u.is_baseqty','1')
									 ->whereBetween('item_log.voucher_date', array($date_from, $date_to))
									 ->select('itemmaster.id','itemmaster.item_code','itemmaster.description','u.opn_quantity','u.opn_cost AS cost_avg');
									 ->get(); */
			
			
			//PURCHASE INVOICE..	
			$query1 = DB::table('item_log')->where('item_log.status',1)//->where('item_log.item_id', $attributes['document_id'])
									 ->join('purchase_invoice','purchase_invoice.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','purchase_invoice.supplier_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->join('itemmaster AS itemmaster','itemmaster.id','=','item_log.item_id')
									 ->where('item_log.document_type','=','PI')
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->where('item_log.status',1)
									 ->where('purchase_invoice.department_id',auth()->user()->department_id)
									 ->where('purchase_invoice.status',1)
									 ->where('isd.department_id',auth()->user()->department_id);
									 
			if(($date_from!='') && ($date_to!=''))
				$query1->whereBetween('purchase_invoice.voucher_date', array($date_from, $date_to));
			
			$result['Purchase Invoice'] = $query1->select('item_log.id','purchase_invoice.voucher_no','purchase_invoice.voucher_date','account_master.master_name',DB::raw('"PI" AS type'),
										'item_log.quantity','item_log.cur_quantity','item_log.unit_cost','purchase_invoice.voucher_date AS vdate',
										'itemmaster.id','itemmaster.item_code','itemmaster.description','item_log.sale_reference')->orderBy('item_log.id','ASC')->get();
			
			//SALES INVOICE...	
			$query2 = DB::table('item_log')//->where('item_log.item_id', $attributes['document_id'])
									 ->join('sales_invoice','sales_invoice.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','sales_invoice.customer_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->join('itemmaster AS itemmaster','itemmaster.id','=','item_log.item_id')
									 ->where('item_log.document_type','=','SI')
									  ->where('item_log.department_id',auth()->user()->department_id)
									 ->whereNull('item_log.deleted_at')
									  ->where('sales_invoice.department_id',auth()->user()->department_id)
									 ->where('sales_invoice.status','=',1)
									  ->where('isd.department_id',auth()->user()->department_id);
									 
			if(($date_from!='') && ($date_to!=''))
				$query2->whereBetween('sales_invoice.voucher_date', array($date_from, $date_to));
			
			$result['Sales Invoice'] = $query2->select('item_log.id','sales_invoice.voucher_no','sales_invoice.voucher_date','account_master.master_name',DB::raw('"SI" AS type'),
										'item_log.quantity','item_log.cur_quantity','item_log.unit_cost','sales_invoice.voucher_date AS vdate',
										'itemmaster.id','itemmaster.item_code','itemmaster.description','item_log.sale_reference')->orderBy('item_log.id','ASC')->get();
				
				
			//PURCHASE RETURN.....
			$query3 = DB::table('item_log')->where('item_log.status',1)//->where('item_log.item_id', $attributes['document_id'])
									 ->join('purchase_return','purchase_return.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','purchase_return.supplier_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->join('itemmaster AS itemmaster','itemmaster.id','=','item_log.item_id')
									 ->where('item_log.document_type','=','PR')
									 ->where('item_log.status','=',1)
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->whereNull('item_log.deleted_at')
									 ->where('isd.department_id',auth()->user()->department_id)
									 ->where('purchase_return.department_id',auth()->user()->department_id)
									 ->where('purchase_return.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query3->whereBetween('purchase_return.voucher_date', array($date_from, $date_to));
			
			$result['Purchase Return'] = $query3->select('item_log.id','purchase_return.voucher_no','purchase_return.voucher_date','account_master.master_name',DB::raw('"PR" AS type'),
										'item_log.quantity','item_log.cur_quantity','item_log.unit_cost','purchase_return.voucher_date AS vdate',
										'itemmaster.id','itemmaster.item_code','itemmaster.description','item_log.sale_reference')->orderBy('item_log.id','ASC')->get();
			
			//SALES RETURN...						 
			$query4 = DB::table('item_log')//->where('item_log.item_id', $attributes['document_id'])
									 ->join('sales_return','sales_return.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','sales_return.customer_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->join('itemmaster AS itemmaster','itemmaster.id','=','item_log.item_id')
									 ->where('item_log.document_type','=','SR')
									 ->where('item_log.status',1)
									  ->where('item_log.department_id',auth()->user()->department_id)
									 ->whereNull('item_log.deleted_at')
									  ->where('isd.department_id',auth()->user()->department_id)
									  ->where('sales_return.department_id',auth()->user()->department_id)
									 ->where('sales_return.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query4->whereBetween('sales_return.voucher_date', array($date_from, $date_to));
			
			$result['Sales Return'] = $query4->select('item_log.id','sales_return.voucher_no','sales_return.voucher_date','account_master.master_name',DB::raw('"SR" AS type'),
										'item_log.quantity','item_log.cur_quantity','item_log.unit_cost','sales_return.voucher_date AS vdate',
										'itemmaster.id','itemmaster.item_code','itemmaster.description','item_log.sale_reference')->orderBy('item_log.id','ASC')->get();
			
			//TRANSFER IN...						 
			$query5 = DB::table('item_log')//->where('item_log.item_id', $attributes['document_id'])
									 ->join('stock_transferin','stock_transferin.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','stock_transferin.account_dr')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemmaster AS itemmaster','itemmaster.id','=','item_log.item_id')
									 ->where('item_log.document_type','=','TI')
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									 ->where('stock_transferin.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query5->whereBetween('stock_transferin.voucher_date', array($date_from, $date_to));
			
			$result['Transfer In'] = $query5->select('item_log.id','stock_transferin.voucher_no','stock_transferin.voucher_date','account_master.master_name',DB::raw('"TI" AS type'),
										'item_log.quantity','item_log.cur_quantity','item_log.unit_cost','stock_transferin.voucher_date AS vdate',
										'itemmaster.id','itemmaster.item_code','itemmaster.description','item_log.sale_reference')->orderBy('item_log.id','ASC')->get();
										
			
			//GOODS RETURN...						 
			$query6 = DB::table('item_log')//->where('item_log.item_id', $attributes['document_id'])
									 ->join('goods_return','goods_return.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','goods_return.account_master_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemmaster AS itemmaster','itemmaster.id','=','item_log.item_id')
									 ->where('item_log.document_type','=','GR')
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									 ->where('goods_return.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query6->whereBetween('goods_return.voucher_date', array($date_from, $date_to));
			
			$result['Goods Return'] = $query6->select('item_log.id','goods_return.voucher_no','goods_return.voucher_date','account_master.master_name',DB::raw('"GR" AS type'),
										'item_log.quantity','item_log.cur_quantity','item_log.unit_cost','goods_return.voucher_date AS vdate',
										'itemmaster.id','itemmaster.item_code','itemmaster.description','item_log.sale_reference')->orderBy('item_log.id','ASC')->get();
			
			//TRANSFER OUT...						 
			$query7 = DB::table('item_log')//->where('item_log.item_id', $attributes['document_id'])
									 ->join('stock_transferout','stock_transferout.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','stock_transferout.account_dr')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemmaster AS itemmaster','itemmaster.id','=','item_log.item_id')
									 ->where('item_log.document_type','=','TO')
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									 ->where('stock_transferout.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query7->whereBetween('stock_transferout.voucher_date', array($date_from, $date_to));
			
			$result['Transfer Out'] = $query7->select('item_log.id','stock_transferout.voucher_no','stock_transferout.voucher_date','account_master.master_name',DB::raw('"TO" AS type'),
										'item_log.quantity','item_log.cur_quantity','item_log.unit_cost','stock_transferout.voucher_date AS vdate',
										'itemmaster.id','itemmaster.item_code','itemmaster.description','item_log.sale_reference')->orderBy('item_log.id','ASC')->get();
			
			//GOODS RETURN...						 
			$query8 = DB::table('item_log')//->where('item_log.item_id', $attributes['document_id'])
									 ->join('goods_issued','goods_issued.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','goods_issued.account_master_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemmaster AS itemmaster','itemmaster.id','=','item_log.item_id')
									 ->where('item_log.document_type','=','GI')
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									 ->where('goods_issued.status','=',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query8->whereBetween('goods_issued.voucher_date', array($date_from, $date_to));
			
			$result['Goods Isued'] = $query8->select('item_log.id','goods_issued.voucher_no','goods_issued.voucher_date','account_master.master_name',DB::raw('"GI" AS type'),
										'item_log.quantity','item_log.cur_quantity','item_log.unit_cost','goods_issued.voucher_date AS vdate',
										'itemmaster.id','itemmaster.item_code','itemmaster.description','item_log.sale_reference')->orderBy('item_log.id','ASC')->get();
										
				//SDO..	
			$query9 = DB::table('item_log')//->where('item_log.status',1)->where('item_log.item_id', $attributes['document_id'])
									 ->join('supplier_do','supplier_do.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','supplier_do.supplier_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->join('itemmaster','itemmaster.id','=','item_log.item_id')
									 ->where('item_log.document_type','=','SDO')
									  ->where('item_log.department_id',auth()->user()->department_id)
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									  ->where('isd.department_id',auth()->user()->department_id)
									  ->where('supplier_do.department_id',auth()->user()->department_id)
									 ->where('supplier_do.status',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query9->whereBetween('supplier_do.voucher_date', array($date_from, $date_to));
			
			$result['Supplier DO'] = $query9->select('item_log.id','supplier_do.voucher_no','supplier_do.voucher_date','account_master.master_name',DB::raw('"SDO" AS type'),
										'item_log.quantity','item_log.cur_quantity','item_log.unit_cost','supplier_do.voucher_date AS vdate',
										'itemmaster.id','itemmaster.item_code','itemmaster.description','item_log.sale_reference')->orderBy('item_log.id','ASC')->get();
			//CDO
			$query10 = DB::table('item_log')//->where('item_log.item_id', $attributes['document_id'])
									 ->join('customer_do','customer_do.id','=','item_log.document_id')
									 ->join('account_master','account_master.id','=','customer_do.customer_id')
									 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
									 ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
									 ->join('itemmaster','itemmaster.id','=','item_log.item_id')
									 ->where('item_log.document_type','=','CDO')
									 ->where('item_log.department_id',auth()->user()->department_id)
									 ->where('item_log.status',1)
									 ->whereNull('item_log.deleted_at')
									 ->where('isd.department_id',auth()->user()->department_id)
									  ->where('customer_do.department_id',auth()->user()->department_id)
									 ->where('customer_do.status',1);
									 
			if(($date_from!='') && ($date_to!=''))
				$query10->whereBetween('customer_do.voucher_date', array($date_from, $date_to));
			
			$result['Customer DO'] = $query10->select('item_log.id','customer_do.voucher_no','customer_do.voucher_date','account_master.master_name',DB::raw('"CDO" AS type'),
			                                'item_log.quantity','item_log.cur_quantity','item_log.unit_cost','customer_do.voucher_date AS vdate',
										'itemmaster.id','itemmaster.item_code','itemmaster.description','item_log.sale_reference')->orderBy('item_log.id','ASC')->get();				
																
										
			//$result['pursales'] = $result1->union($result2)->union($result3)->union($result4)->union($result5)->union($result6)->union($result7)->union($result8)->orderBy('vdate','ASC')->get();
		 
		return $result;
	}
	
	public function getStockMovementReport($attributes)
	{
		$result = array();
		$date_from = ($attributes['date_from']!='')?date('Y-m-d', strtotime($attributes['date_from'])):date('Y-m-d');
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):date('Y-m-d');
		
		$query = DB::table('item_log')
						 ->join('sales_invoice','sales_invoice.id','=','item_log.document_id')
						 ->join('account_master','account_master.id','=','sales_invoice.customer_id')
						 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
						 ->join('itemmaster AS itemmaster','itemmaster.id','=','item_log.item_id')
						 ->where('item_log.document_type','=','SI')
						 ->whereNull('item_log.deleted_at')
						 ->where('sales_invoice.status','=',1);
									 
		if(($date_from!='') && ($date_to!=''))
			$query->whereBetween('sales_invoice.voucher_date', array($date_from, $date_to));
		
		
		if(isset($attributes['group_id']))
			$query->whereIn('itemmaster.group_id', $attributes['group_id']);
		
		if(isset($attributes['subgroup_id']))
			$query->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
		
		if(isset($attributes['category_id']))
			$query->whereIn('itemmaster.category_id', $attributes['category_id']);
		
		if(isset($attributes['subcategory_id']))
			$query->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
		
		$result = $query->select('item_log.id','sales_invoice.voucher_no','sales_invoice.voucher_date','account_master.master_name',DB::raw('"SI" AS type'),
									'item_log.quantity','item_log.cur_quantity','item_log.unit_cost','sales_invoice.voucher_date AS vdate',
									'itemmaster.id','itemmaster.item_code','itemmaster.description','item_log.sale_reference',
									DB::raw('SUM(item_log.quantity) As quantity')
									)->orderBy('item_log.id','ASC')->groupBy('item_log.item_id')
									->get();
		
		return $result;
		
	}
	
	public function getStocknonMovementReport($attributes)
	{
		$result = array();
		$date_from = ($attributes['date_from']!='')?date('Y-m-d', strtotime($attributes['date_from'])):date('Y-m-d');
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):date('Y-m-d');
		
		/* $query2 = DB::table('itemmaster')
						 ->leftJoin('item_log','item_log.item_id','=','itemmaster.id')
						 ->where('item_log.document_type','=','SI')
						 ->where('item_log.item_id','=',null)
						 ->where('item_log.deleted_at');
									 
		if(($date_from!='') && ($date_to!=''))
			$query2->whereBetween('item_log.voucher_date', array($date_from, $date_to));
		
		$result = $query2->select('item_log.id',
									'item_log.quantity',
									'itemmaster.id','itemmaster.item_code','itemmaster.description',
									DB::raw('SUM(item_log.quantity) As quantity')
									)->orderBy('item_log.id','ASC')->groupBy('item_log.item_id')
									->get(); */
		
		$result = DB::table("itemmaster")->select('*')->whereNotIn('id',function($query) {

		   $query->select('item_id')->from('item_log');

		})->get();
		
		/* $result = DB::table('itemmaster')
            ->join('item_log', 'itemmaster.id', '=', 'item_log.item_id')
            ->get(); */

		return $result;
		
	}

	//paging count...
	public function getConLocListCount($custid,$itemid)
	{	
		
		$qry = DB::table('location')
						->join('item_location AS IL','IL.location_id','=','location.id')
						->where('location.status',1)
						->where('IL.status',1)
						->where('location.is_conloc',1)
						->whereNull('location.deleted_at')
						->whereNull('IL.deleted_at')
						->where('location.customer_id',$custid)->where('IL.item_id',$itemid)->count();
		return $qry;
	}
	
	//paging..
	public function getConLocList($type,$start,$limit,$order,$dir,$search,$custid,$itemid)
	{		
		$qry = DB::table('location')
						->join('item_location AS IL','IL.location_id','=','location.id')
						->where('location.status',1)
						->where('IL.status',1)
						->where('location.is_conloc',1)
						->whereNull('location.deleted_at')
						->whereNull('IL.deleted_at')
						->where('location.customer_id',$custid)
						->where('IL.item_id',$itemid);
						
		$qry->select('location.id','location.code','location.name','IL.quantity')
								->offset($start)
		                        ->limit($limit)
		                        ->orderBy($order,$dir); 
					
							if($type=='get')
								return $qry->get();
							else
								return $qry->count();
		
			
	}
	
	// public function getLocQuantity($id) {
		
	// 	return DB::table('item_location')
	// 			->join('location','location.id','=','item_location.location_id')
	// 			->leftjoin('bin_location','bin_location.id','=','item_location.bin_id')
	// 			->where('item_location.item_id',$id)
	// 			->where('item_location.status',1)
	// 			->where('item_location.department_id', auth()->user()->department_id)
	// 			->whereNull('item_location.deleted_at')
	// 			->where('location.status',1)
	// 			->whereNull('location.deleted_at')
	// 			->where('item_location.quantity','>',0)
	// 			->select('location.code','location.name','item_location.quantity','bin_location.code AS bin')
	// 			->get();
	// }

	public function getLocQuantity($id)
	{
    
		return DB::table('item_location')
				->join('location','location.id','=','item_location.location_id')
				->leftJoin('bin_location','bin_location.id','=','item_location.bin_id')
				->where('item_location.item_id', $id)
				->where('item_location.status', 1)
				->where('item_location.department_id', auth()->user()->department_id)
				->whereNull('item_location.deleted_at')
				->where('location.status', 1)
				->whereNull('location.deleted_at')
				->where('item_location.quantity', '>', 0)
				->select(
					'location.code as location_code',
					'location.name as location_name',
					'item_location.quantity',
					'bin_location.code AS bin_code'
				)
				->get();
	}

	public function getInLocQuantity($id) 
	{
    
		$query = DB::table('item_location')
				->join('location','location.id','=','item_location.location_id')
				->leftJoin('bin_location','bin_location.id','=','item_location.bin_id')
				->where('item_location.item_id', $id)
				->where('item_location.status', 1)
				->where('item_location.department_id', '!=', auth()->user()->department_id)
				->whereNull('item_location.deleted_at')
				->where('location.status', 1)
				->whereNull('location.deleted_at')
				->where('item_location.quantity', '>', 0)
				->select(
					'location.code as location_code',
					'location.name as location_name',
					'item_location.quantity',
					'bin_location.code AS bin_code',
					'item_location.department_id' // Add this to verify
				);
		
		// Debug: Print the SQL query
		// dd($query->toSql(), $query->getBindings());
		
		return $query->get();
	}
	
	public function getStockMovementSummaryReport($attributes)
	{
		$result = array();
		$date_from = ($attributes['date_from']!='')?date('Y-m-d', strtotime($attributes['date_from'])):'';
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):'';
		
		$query = DB::table('item_log')
						 ->join('item_unit AS u','u.itemmaster_id','=','item_log.item_id')
						  ->join('itemstock_department AS isd','isd.itemmaster_id','=','item_log.item_id')
						 ->join('itemmaster AS itemmaster','itemmaster.id','=','item_log.item_id')
						 ->whereNull('item_log.deleted_at')
						 ->where('item_log.department_id',auth()->user()->department_id)
						 ->where('isd.department_id',auth()->user()->department_id)
						 ->where('item_log.status','=',1);
									 
		if(($date_from!='') && ($date_to!=''))
			$query->whereBetween('item_log.voucher_date', array($date_from, $date_to));
		
		
		if(isset($attributes['group_id']))
			$query->whereIn('itemmaster.group_id', $attributes['group_id']);
		
		if(isset($attributes['subgroup_id']))
			$query->whereIn('itemmaster.subgroup_id', $attributes['subgroup_id']);
		
		if(isset($attributes['category_id']))
			$query->whereIn('itemmaster.category_id', $attributes['category_id']);
		
		if(isset($attributes['subcategory_id']))
			$query->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);
		
		$result = $query->select('item_log.id','item_log.cost_avg','item_log.quantity',
								 'item_log.item_id','itemmaster.item_code','itemmaster.description','item_log.sale_reference','item_log.trtype','item_log.unit_cost','item_log.pur_cost','item_log.sale_cost','isd.opn_quantity','isd.opn_cost')
								->orderBy('item_log.id','ASC')
								->get();
		
		return $result;
		
	}

	private function formatLogs($itemid) {

			$itemlog = DB::table('item_log')
								  ->where('item_id', $itemid)
								//   ->where('department_id', auth()->user()->department_id)
								  ->where('department_id', auth()->user()->department_id ?? 1)
								  ->where('status',1)
								  ->whereNull('deleted_at')
								  ->select('item_log.*')
								  ->orderBy('id','DESC')
								  ->first(); 
				if($itemlog) {
					
					$qty_rec = $qty_isd = $curr_qnty = 0;
					$qntys = $this->getItemQtyFromLog($itemid);
					$opqntys = $this->getItemOpnQtyFromLog($itemid);
					if($qntys) {
						$qty_rec = $qntys['in'];
						$qty_isd = $qntys['out'];
						$curr_qnty = $qty_rec - $qty_isd;
					}
					if($opqntys){
						$qty_opn = $opqntys['opq'];
					}
					//echo '<pre>';print_r($itemlog); exit;
					if($itemlog->document_type=='SI'||$itemlog->document_type=='PR'||$itemlog->document_type=='GR'||$itemlog->document_type=='TO') {
						
						DB::table('item_unit')->where('itemmaster_id', $itemid)
											  ->update([
												'cur_quantity' => $curr_qnty,
												'issued_qty' => $qty_isd, 'received_qty' => $qty_rec,
												'last_purchase_cost' => $itemlog->pur_cost,
												'cost_avg' => $itemlog->cost_avg
											  ]);
					} else if($itemlog->document_type=='PI'||$itemlog->document_type=='SR'||$itemlog->document_type=='GI'||$itemlog->document_type=='TI') { 
						DB::table('item_unit')->where('itemmaster_id', $itemid)
											  ->update([
												'cur_quantity' => $curr_qnty,
												'last_purchase_cost' => $itemlog->pur_cost,
												'cost_avg' => $itemlog->cost_avg,
												'received_qty' => $qty_rec, 'issued_qty' => $qty_isd
											  ]);
					} else if($itemlog->document_type=='OQ') { 
						DB::table('item_unit')->where('itemmaster_id', $itemid)
											  ->update([
												'opn_quantity'=>$qty_opn ,
												'cur_quantity' => $curr_qnty,
												'last_purchase_cost' => $itemlog->pur_cost,
												'cost_avg' => $itemlog->cost_avg,
												'received_qty' => $qty_rec,
												'issued_qty' => 0
											  ]);
					}
				}

			return true;
	}

	private function getItemOpnQtyFromLog($item_id){
		$departmentId = auth()->user()->department_id ?? 1;
       $oqtyin = DB::table('item_log')->where('item_id', $item_id)->where('department_id', $departmentId)->where('document_type', 'OQ')->where('trtype',1)->where('status',1)->whereNull('deleted_at')->sum('quantity');
		return ['opq' => $oqtyin];
	}
	

	private function getItemQtyFromLog($item_id)
	{
		$departmentId = auth()->user()->department_id ?? 1;
		$qtyin = DB::table('item_log')->where('item_id', $item_id)->where('department_id', $departmentId)->where('trtype',1)->where('status',1)->whereNull('deleted_at')->sum('quantity');
		
		$qtyout = DB::table('item_log')->where('item_id', $item_id)->where('department_id', $departmentId)->where('trtype',0)->where('status',1)->whereNull('deleted_at')->sum('quantity');
		
		return ['in' => $qtyin, 'out' => $qtyout];
	}
	
	public function ImportItemsUpdate($data)
	{  ##################  EXCEL FORMAT:   Item Code|Description|Unit|Quantity|Rate|Sales Price|Item Class|Group|Image|Model|Subgroup|Serial No|Other Info|Weight|Wsales Price  ######################
		DB::beginTransaction();
		try { //echo '<pre>';print_r($data);exit;
			//foreach($data as $value) { open_quantity cost_avg rate item_class
				
				foreach ($data as $row) { 
				//	echo $row;exit;
				 
				 if($row->item_code!='' && $row->description!='') {
					//CHECK ITEM EXIST OR NOT
					$item = DB::table('itemmaster')->where( function ($query) use($row) {
														$query->where('item_code', '=', $row->item_code);
															  //->orWhere('description', '=', $row->description);
												   })->select('id')->first();
					if($item) {
						
						DB::table('item_unit')
						        ->where('itemmaster_id',$item->id)
					            ->update(['opn_quantity' => ($row->quantity=='')?0:$row->quantity,
										  'opn_cost' => ($row->rate=='')?0:$row->rate
										]);
														
						DB::table('item_log')->where('item_id',$item->id)->where('document_type','OQ')
						->update([
								'quantity' => ($row->quantity=='')?0:$row->quantity,
								'unit_cost' => ($row->rate=='')?0:$row->rate,
								'cost_avg' => ($row->rate=='')?0:$row->rate,
								'pur_cost' => ($row->rate=='')?0:$row->rate,
								]);
														
						
				   }
				 }
				}

			DB::commit();
			return true;
			
		} catch(\Exception $e) { 
		
			DB::rollback(); echo $e->getLine().' - '.$e->getMessage();exit;
			return false;
		}
		
	}
	
	public function getBatchReport($attributes) {
	    
	    $result = array();
		$date_from = ($attributes['date_from']!='')?date('Y-m-d', strtotime($attributes['date_from'])):'';
		$date_to = ($attributes['date_to']!='')?date('Y-m-d', strtotime($attributes['date_to'])):'';

		if($attributes['search_type']=='batch_expiry') {
		
			$query = $this->itemmaster->where('itemmaster.status', 1)		
							->join('item_batch AS B', function($join) {
								$join->on('B.item_id','=','itemmaster.id');
							})
							->join('item_unit AS U', function($join) {
								$join->on('U.itemmaster_id','=','itemmaster.id');
							})
							->leftjoin('category AS C', function($join) {
								$join->on('C.id','=','itemmaster.subcategory_id');
							})
							->where('itemmaster.batch_req', 1)
							->whereNull('B.deleted_at');

    			if(($date_from!='') && ($date_to!='')) {
    				$query->whereBetween('B.exp_date', array($date_from, $date_to));
    			}
			
				if(isset($attributes['category_id']) && $attributes['category_id']!='')
					$query->whereIn('itemmaster.category_id', $attributes['category_id']);
				
				if(isset($attributes['subcategory_id']) && $attributes['subcategory_id']!='' )
					$query->whereIn('itemmaster.subcategory_id', $attributes['subcategory_id']);

				if(isset($attributes['document_id'])&& $attributes['document_id']!='' )
					$query->whereIn('itemmaster.id', $attributes['document_id']);
						

			$result = $query->select('itemmaster.id','itemmaster.item_code','itemmaster.description','B.*','U.cost_avg','C.category_name')->orderBy('B.exp_date','ASC')->get()->toArray();
		
			return $result;
		
		}
	}	
	
}

//
