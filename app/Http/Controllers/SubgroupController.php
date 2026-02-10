<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Group\GroupInterface;

use App\Http\Requests;
use Session;
use App;
use DB;

class SubgroupController extends Controller
{
    protected $group;
	
	public function __construct(GroupInterface $group) {
		
		parent::__construct( App::make('App\Repositories\Parameter1\Parameter1Interface'), App::make('App\Repositories\VatMaster\VatMasterInterface') );
		$this->group = $group;
		$this->middleware('auth');
	}
	
	public function index() {
		$data = array();
		// $subgroups = $this->group->subgroupList();
		 $subgroups = $this->group->allSubgroup();
		return view('body.subgroup.index')
					->withSubgroups($subgroups)
					->withData($data);
	}
	
	public function add() {

		$data = array();
		return view('body.subgroup.add')
					->withData($data);
	}
	
	// public function save(Request $request) {
	// 	//print_r(Input::all());
	// 	$this->group->create($request->all());
	// 	Session::flash('message', 'Sub Group added successfully.');
	// 	return redirect('subgroup/add');
	// }

	public function save(Request $request) {
        // ✓ Add validation
        $validated = $request->validate([
            'group_name' => 'required|max:150',
            'parent_id' => 'required|integer|exists:groupcat,id',
            'description' => 'nullable|max:150'
        ]);
        
        try {
            $this->group->create($validated);
            Session::flash('message', 'Sub Group added successfully.');
            return redirect('subgroup/add');
        } catch(\Exception $e) {
            return redirect('subgroup/add')
                ->withErrors(['error' => 'Failed to create subgroup: ' . $e->getMessage()]);
        }
    }
	
	public function edit($id) { 

		$data = array();
		$grouprow = $this->group->find($id);//print_r($grouprow);
		return view('body.subgroup.edit')
					->withGrouprow($grouprow)
					->withData($data);
	}
	
	public function update($id, Request $request)
	{
		$this->group->update($id, $request->all());//print_r(Input::all());exit;
		//Session::flash('message', 'Category updated successfully');
		return redirect('subgroup');
	}
	
	public function destroy($id)
	{
		$this->group->delete($id);
		//check group name is already in use.........
		// code here ********************************
		Session::flash('message', 'Sub Group deleted successfully.');
		return redirect('subgroup');
	}
	
	// public function checkname(Request $request) {

	// 	$check = $this->group->check_subgroup_name($request->get('group_name'), $request->get('id'));
	// 	$isAvailable = ($check) ? false : true;
	// 	echo json_encode(array(
	// 						'valid' => $isAvailable,
	// 					));
	// }

	public function checkname(Request $request) {
        // ✓ Include parent_id
        $check = $this->group->check_subgroup_name(
            $request->get('group_name'),
            $request->get('parent_id'), // ✓ Required
            $request->get('id')
        );
        
        $isAvailable = !$check;
        
        return response()->json(['valid' => $isAvailable]);
    }

	public function destroyGroup()
	{
		$ids = Input::get('ids');
		if($ids) {
			$idarr = explode(',', $ids);
			DB::table('groupcat')->whereIn('id',$idarr)->update(['deleted_at' => date('Y-m-d H:i:s')]);
			Session::flash('message', 'Subgroups deleted successfully.');
		}
		return redirect('subgroup');
	}

	public function destroySubgroups(Request $request) {
        $ids = $request->get('ids');
        
        if ($ids) {
            // ✓ Validate and use Request injection
            $idarr = array_filter(explode(',', $ids), 'is_numeric');
            
            if (!empty($idarr)) {
                DB::table('groupcat')
                    ->whereIn('id', $idarr)
                    ->where('parent_id', '!=', 0) // ✓ Only subgroups
                    ->update(['deleted_at' => now()]);
                    
                Session::flash('message', 'Subgroups deleted successfully.');
            }
        }
        
        return redirect('subgroup');
    }
}

