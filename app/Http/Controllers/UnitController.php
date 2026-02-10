<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Unit\UnitInterface;

use App\Http\Requests;
use Session;
use Response;
use App;
use DB;

class UnitController extends Controller
{
    protected $unit;
	
	public function __construct(UnitInterface $unit) {
		
		parent::__construct( App::make('App\Repositories\Parameter1\Parameter1Interface'), App::make('App\Repositories\VatMaster\VatMasterInterface') );
		$this->unit = $unit;
		$this->middleware('auth');
		
		// $this->mod_assembly_item = DB::table('parameter2')->where('keyname', 'mod_assembly_item')->where('status',1)->select('is_active')->first();
	}
	
	public function index() {
		$data = array();
		// $aitem=$this->mod_assembly_item->is_active;
		// ✓ Query only when needed
        $aitem = DB::table('parameter2')
            ->where('keyname', 'mod_assembly_item')
            ->where('status', 1)
            ->value('is_active') ?? 0;

		$units = $this->unit->unitList();
		//echo '<pre>';print_r($aitem);exit;
		return view('body.unit.index')
					->withUnits($units)
					->withAitem($aitem)
					->withData($data);
	}
	
	public function add() {

		$data = array();
		return view('body.unit.add')
					->withData($data);
	}
	
	// public function save(Request $request) {
	// 	//print_r($request->all());
	// 	$this->unit->create($request->all());
	// 	Session::flash('message', 'Unit added successfully.');
	// 	return redirect('unit/add');
	// }

	public function save(Request $request) {
        // ✓ Add validation
        $validated = $request->validate([
            'unit_name' => 'required|max:100|unique:units,unit_name',
            'description' => 'nullable|max:120',
            'fracount' => 'nullable|integer|min:0|max:127' // tinyint range
        ]);
        
        try {
            $result = $this->unit->create($validated);
            
            if ($result) {
                Session::flash('message', 'Unit added successfully.');
            } else {
                Session::flash('error', 'Failed to add unit.');
            }
        } catch(\Exception $e) {
            Session::flash('error', 'Error: ' . $e->getMessage());
        }
        
        return redirect('unit');
    }
	
	public function edit($id) { 

		$data = array();
		$unitrow = $this->unit->find($id);//print_r($unitrow);
		return view('body.unit.edit')
					->withUnitrow($unitrow)
					->withData($data);
	}
	
	// public function update($id, Request $request)
	// {
	// 	$this->unit->update($id, $request->all());//print_r($request->all());exit;
	// 	//Session::flash('message', 'Category updated successfully');
	// 	return redirect('unit');
	// }

	public function update($id, Request $request) {
        // ✓ Add validation
        $validated = $request->validate([
            'unit_name' => 'required|max:100|unique:units,unit_name,' . $id,
            'description' => 'nullable|max:120',
            'fracount' => 'nullable|integer|min:0|max:127'
        ]);
        
        $this->unit->update($id, $validated);
        Session::flash('message', 'Unit updated successfully.');
        return redirect('unit');
    }
	
	// public function destroy($id)
	// {
	// 	if($id > 2)
	// 		$this->unit->delete($id);
	// 	//check unit name is already in use.........
	// 	// code here ********************************
	// 	Session::flash('message', 'Unit deleted successfully.');
	// 	return redirect('unit');
	// }


	public function destroy($id) {
        // ✓ Define protected units with clear names
        $protectedUnits = [1 => 'NOS', 2 => 'PCS'];
        
        if (isset($protectedUnits[$id])) {
            Session::flash('error', "Cannot delete system unit: {$protectedUnits[$id]}");
            return redirect('unit');
        }
        
        // ✓ Check if unit is in use
        $inUse = DB::table('products')->where('unit_id', $id)->exists();
        if ($inUse) {
            Session::flash('error', 'Cannot delete unit that is currently in use by products.');
            return redirect('unit');
        }
        
        try {
            $this->unit->delete($id);
            Session::flash('message', 'Unit deleted successfully.');
        } catch(\Exception $e) {
            Session::flash('error', 'Failed to delete unit.');
        }
        
        return redirect('unit');
    }
	
	public function checkname(Request $request) {

		$check = $this->unit->check_unit_name($request->get('unit_name'), $request->get('id'));
		// $isAvailable = ($check) ? false : true;
		 $isAvailable = !$check;
		// echo json_encode(array(
		// 					'valid' => $isAvailable,
		// 				));
		return response()->json(['valid' => $isAvailable]);

	}
	public function destroyGroup(Request $request)
	{
		$ids = $request->get('ids');
		if($ids) {
			$idarr = explode(',', $ids);
			DB::table('units')->whereIn('id',$idarr)->update(['deleted_at' => date('Y-m-d H:i:s')]);
			Session::flash('message', 'Units deleted successfully.');
		}
		return redirect('unit');
	}


	public function destroyUnits(Request $request) {
        $ids = $request->get('ids');
        
        if ($ids) {
            // ✓ Validate IDs
            $idarr = array_filter(explode(',', $ids), 'is_numeric');
            
            if (!empty($idarr)) {
                // ✓ Protect system units
                $protectedUnits = [1, 2];
                $idarr = array_diff($idarr, $protectedUnits);
                
                if (empty($idarr)) {
                    Session::flash('error', 'Cannot delete system units (NOS, PCS).');
                    return redirect('unit');
                }
                
                // ✓ Check if any units are in use
                $inUse = DB::table('products')
                    ->whereIn('unit_id', $idarr)
                    ->pluck('unit_id')
                    ->toArray();
                
                $idarr = array_diff($idarr, $inUse);
                
                if (!empty($idarr)) {
                    DB::table('units')
                        ->whereIn('id', $idarr)
                        ->update(['deleted_at' => now()]);
                    
                    $deletedCount = count($idarr);
                    $skippedCount = count($inUse);
                    
                    $message = "Deleted {$deletedCount} unit(s).";
                    if ($skippedCount > 0) {
                        $message .= " Skipped {$skippedCount} unit(s) in use.";
                    }
                    
                    Session::flash('message', $message);
                } else {
                    Session::flash('error', 'All selected units are in use or protected.');
                }
            }
        }
        
        return redirect('unit');
    }
}
