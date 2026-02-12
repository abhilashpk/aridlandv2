<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Location\LocationInterface;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use Session;
use Response;
use App;
use DB;
use Log;

class LocationController extends Controller
{
    protected $location;
	
	public function __construct(LocationInterface $location) {
		
		parent::__construct( App::make('App\Repositories\Parameter1\Parameter1Interface'), App::make('App\Repositories\VatMaster\VatMasterInterface') );
		$this->location = $location;
		$this->middleware('auth');
	}
	
	public function index() {
		$data = array();
		$locations = $this->location->allLoc();
		return view('body.location.index')
					->withLocations($locations)
					->withData($data);
	}
	
	public function add() {

		$data = array();
		$customers = DB::table('account_master')->where('status',1)->where('deleted_at','0000-00-00 00:00:00')->where('category','CUSTOMER')->get();
		return view('body.location.add')
					->withCustomers($customers)
					->withData($data);
	}
	
	// public function save(Request $request) {
	// 	$this->location->create($request->all());
	// 	Session::flash('message', 'Location added successfully.');
	// 	return redirect('location/add');
	// }

	public function save(Request $request)
	{
		$rules = [
			'code' => 'required',
			'name' => 'required',
			'is_conloc' => 'required|in:0,1',
		];

		// customer required ONLY if consignment location = YES
		if ($request->is_conloc == 1) {
			$rules['customer_id'] = 'required|integer';
		}

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}

		$this->location->create($request->all());

		return redirect('location')
			->with('message', 'Location added successfully.');
	}

	
	public function edit($id) { 

		$data = array();
		$locationrow = $this->location->find($id);
		$customers = DB::table('account_master')->where('status',1)->where('deleted_at','0000-00-00 00:00:00')->where('category','CUSTOMER')->get();
		return view('body.location.edit')
					->withLocationrow($locationrow)
					->withCustomers($customers)
					->withData($data);
	}
	
	// public function update($id, Request $request)
	// {
	// 	$this->location->update($id, $request->all());//print_r($request->all());exit;
	// 	//Session::flash('message', 'Category updated successfully');
	// 	return redirect('location');
	// }


	public function update($id, Request $request)
	{
		$rules = [
			'code' => 'required|max:45',
			'name' => 'required|max:55',
			'is_conloc' => 'required|in:0,1',
		];

		if ($request->is_conloc == 1) {
			$rules['customer_id'] = 'required|integer';
		}

		$validated = $request->validate($rules);
		
		try {
			$this->location->update($id, $validated);
			Session::flash('message', 'Location updated successfully.');
		} catch(\Exception $e) {
			Log::error('Location update failed: ' . $e->getMessage());
			Session::flash('error', 'Failed to update location.');
		}
		
		return redirect('location');
	}

	
	// public function destroy($id)
	// {
	// 	$this->location->delete($id);
	// 	//check location name is already in use.........
	// 	// code here ********************************
	// 	Session::flash('message', 'Location deleted successfully.');
	// 	return redirect('location');
	// }

	public function destroy($id)
	{
		try {
			// Check if location is in use
			$inUse = $this->location->isLocationInUse($id);
			
			if ($inUse) {
				Session::flash('error', 'Location is in use and cannot be deleted.');
				return redirect('location');
			}
			
			// Check if it's the default location
			$location = $this->location->find($id);
			if ($location && $location->is_default == 1) {
				Session::flash('error', 'Cannot delete the default location.');
				return redirect('location');
			}
			
			$this->location->delete($id);
			Session::flash('message', 'Location deleted successfully.');
			
		} catch(\Exception $e) {
			Log::error('Location deletion failed: ' . $e->getMessage());
			Session::flash('error', 'Failed to delete location.');
		}
		
		return redirect('location');
	}
	
	// public function checkcode(Request $request) {

	// 	$check = $this->location->check_location_code($request->get('code'), $request->get('id'));
	// 	$isAvailable = ($check) ? false : true;
	// 	echo json_encode(array(
	// 						'valid' => $isAvailable,
	// 					));
	// }

	public function checkcode(Request $request) {
		$request->validate([
			'code' => 'required|max:45',
			'id' => 'nullable|integer'
		]);
		
		$check = $this->location->check_location_code(
			trim($request->get('code')), 
			$request->get('id')
		);
		
		return response()->json(['valid' => !$check]);
	}

	public function checkname(Request $request) {
		$request->validate([
			'name' => 'required|max:55',
			'id' => 'nullable|integer'
		]);
		
		$check = $this->location->check_location_name(
			trim($request->get('name')), 
			$request->get('id')
		);
		
		return response()->json(['valid' => !$check]);
	}
	
	// public function checkname(Request $request) {

	// 	$check = $this->location->check_location_name($request->get('name'), $request->get('id'));
	// 	$isAvailable = ($check) ? false : true;
	// 	echo json_encode(array(
	// 						'valid' => $isAvailable,
	// 					));
	// }
	
	public function getLocation($id=null)
	{
		$info = $this->location->locationList();
		//  dd($this->location->locationList());
		 Log::info('General location query result', [
            'count' => $info->count(),
            'locations' => $info->toArray()
        ]);
		return view('body.location.locinfo')
					->withId($id)
					->withInfo($info);		
	}

	// public function getLocation($id = null)
	// {
	// 	// If this is for general location listing (not item-specific)
	// 	$info = $this->location->getItemStockByLocation();
		
	// 	return view('body.location.locinfo')
	// 		->with('id', $id)
	// 		->with('info', $info);
	// }
		
	// 	return view('body.location.locinfo')
	// 		->with('id', $id)
	// 		->with('info', $info);
	// }

	// public function getCode($id)
	// {
	// 	$loc = DB::table('location')->where('id', $id)->first();

	// 	return $loc ? $loc->code : '';
	// }

	public function getCode($id)
	{
		\Log::info('Location ID:', ['id' => $id]);

		$loc = DB::table('location')->where('id', $id)->first();

		\Log::info('Location Result:', ['data' => $loc]);

		return $loc ? $loc->code : '';
	}


	public function getBin($num,$mod=null)
	{
		$binloc = DB::table('bin_location')->where('deleted_at',null)->get();
		return view('body.location.binloc')
					->withBinloc($binloc)
					->withNum($num);
	}

	// public function ajaxSave(Request $request) {
		
	// 	$check1 = DB::table('bin_location')->where('code', trim($request->get('bin_code')))->where('deleted_at',null)->count();
	// 	if(($check1 > 0))
	// 		return 0;
		
	// 	$check2 = DB::table('bin_location')->where('name', trim($request->get('name')))->where('deleted_at',null)->count();
	// 	if(($check2 > 0))
	// 		return -1;
		
	// 	$id = DB::table('bin_location')
	// 			->insertGetId([
	// 				'code' => trim($request->get('bin_code')),
	// 				'name' => trim($request->get('name'))
	// 			]);
			
	// 	return $id;
			
	// }

	public function ajaxSave(Request $request) {
		try {
			$validated = $request->validate([
				'bin_code' => 'required|max:45',
				'name' => 'required|max:100'
			]);
			
			$bin_code = trim($validated['bin_code']);
			$name = trim($validated['name']);
			
			// Check for duplicate code
			$codeExists = DB::table('bin_location')
				->where('code', $bin_code)
				->whereNull('deleted_at')
				->exists();
			
			if ($codeExists) {
				return response()->json([
					'success' => false,
					'error' => 'Bin code already exists'
				], 400);
			}
			
			// Check for duplicate name
			$nameExists = DB::table('bin_location')
				->where('name', $name)
				->whereNull('deleted_at')
				->exists();
			
			if ($nameExists) {
				return response()->json([
					'success' => false,
					'error' => 'Bin name already exists'
				], 400);
			}
			
			$id = DB::table('bin_location')->insertGetId([
				'code' => $bin_code,
				'name' => $name,
				'created_at' => now(),
				'created_by' => Auth::id()
			]);
			
			return response()->json([
				'success' => true,
				'id' => $id
			]);
			
		} catch(\Exception $e) {
			Log::error('Bin location creation failed: ' . $e->getMessage());
			return response()->json([
				'success' => false,
				'error' => 'Failed to create bin location'
			], 500);
		}
	}

}

