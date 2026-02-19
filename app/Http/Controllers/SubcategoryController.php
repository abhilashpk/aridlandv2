<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryInterface; 

use App\Http\Requests;
use Notification;
use Session;
use App;
use DB;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{
   
	protected $category;

	public function __construct(CategoryInterface $category) {
		
		parent::__construct( App::make('App\Repositories\Parameter1\Parameter1Interface'), App::make('App\Repositories\VatMaster\VatMasterInterface') );
		$this->category = $category;
		$this->middleware('auth');
	}

	public function index() {

		$data = array();
		// $subcategories = $this->category->subcategoryList();
		$subcategories = $this->category->allSubcategory();

		//Session::flash('message', 'Category added successfully.');
		return view('body.subcategory.index')
					->withSubcategories($subcategories)
					->withData($data);
	}

	public function add() {

		$data = array();
		return view('body.subcategory.add')
					->withData($data);
	}
	
	// public function save(Request $request) {
	// 	//print_r($request->all());
	// 	try {
	// 		$this->category->create($request->all());
	// 		Session::flash('message', 'Sub Category added successfully.');
	// 		return redirect('subcategory/add');
	// 	} catch(ValidationException $e) { 
	// 		return Redirect::to('subcategory/add')->withErrors($e->getErrors());
	// 	}
	// }

	public function save(Request $request) {
        if (!$this->canManageMaster('it-subcategory-create')) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
        // ✓ Add validation
        $validated = $request->validate([
            'category_name' => 'required|max:120',
            'parent_id' => 'required|integer|exists:category,id',
            'description' => 'nullable|max:150'
        ]);
        
        try {
            $this->category->create($validated);
            Session::flash('message', 'Sub Category added successfully.');
            return redirect('subcategory/add');
        } catch(\Exception $e) {
            return redirect('subcategory/add')
                ->withErrors(['error' => 'Failed to create subcategory: ' . $e->getMessage()]);
        }
    }
	
	public function edit($id) { 
		if (!$this->canManageMaster('it-subcategory-edit')) {
			return redirect()->back()->with('error', 'Unauthorized action.');
		}

		$data = array();
		$catrow = $this->category->find($id);//print_r($grouprow);
		return view('body.subcategory.edit')
					->withCatrow($catrow)
					->withData($data);
	}
	
	public function update($id, Request $request)
	{
		if (!$this->canManageMaster('it-subcategory-edit')) {
			return redirect()->back()->with('error', 'Unauthorized action.');
		}
		$this->category->update($id, $request->all());//print_r($request->all());exit;
		//Session::flash('message', 'Category updated successfully');
		return redirect('subcategory');
	}
	
	public function destroy($id)
	{
		if (!$this->canManageMaster('it-subcategory-delete')) {
			return redirect()->back()->with('error', 'Unauthorized action.');
		}
		$this->category->delete($id);
		//check group name is already in use.........
		// code here ********************************
		Session::flash('message', 'Sub Category deleted successfully.');
		return redirect('subcategory');
	}
	
	// public function checkname(Request $request) {

	// 	$check = $this->category->check_subcategory_name($request->get('category_name'), $request->get('id'));
	// 	$isAvailable = ($check) ? false : true;
	// 	echo json_encode(array(
	// 						'valid' => $isAvailable,
	// 					));
	// }

	public function checkname(Request $request) {
        // ✓ Include parent_id
        $check = $this->category->check_subcategory_name(
            $request->get('category_name'),
            $request->get('parent_id'), // ✓ Required
            $request->get('id')
        );
        
        $isAvailable = !$check;
        
        return response()->json(['valid' => $isAvailable]);
    }

	public function destroyGroup(Request $request)
	{
		if (!$this->canManageMaster('it-subcategory-delete')) {
			return redirect()->back()->with('error', 'Unauthorized action.');
		}
		$ids = $request->get('ids');
		if($ids) {
			$idarr = explode(',', $ids);
			DB::table('category')->whereIn('id',$idarr)->update(['deleted_at' => date('Y-m-d H:i:s')]);
			Session::flash('message', 'subcategories deleted successfully.');
		}
		return redirect('subcategory');
	}

	public function destroySubcategories(Request $request) {
        if (!$this->canManageMaster('it-subcategory-delete')) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
        $ids = $request->get('ids');
        
        if ($ids) {
            // ✓ Validate IDs
            $idarr = array_filter(explode(',', $ids), 'is_numeric');
            
            if (!empty($idarr)) {
                DB::table('category')
                    ->whereIn('id', $idarr)
                    ->where('parent_id', '!=', 0) // ✓ Only subcategories
                    ->update(['deleted_at' => now()]);
                    
                Session::flash('message', 'Subcategories deleted successfully.');
            }
        }
        
        return redirect('subcategory');
    }

	private function canManageMaster(?string $permission = null): bool
	{
		$user = Auth::user();
		if (!$user) {
			return false;
		}

		if ($permission !== null) {
			if (method_exists($user, 'can')) {
				return $user->can($permission);
			}
			if (method_exists($user, 'hasPermissionTo')) {
				return $user->hasPermissionTo($permission);
			}
			return false;
		}

		$permissions = ['it-subcategory-create', 'it-subcategory-edit', 'it-subcategory-delete'];

		if (method_exists($user, 'can')) {
			foreach ($permissions as $perm) {
				if ($user->can($perm)) {
					return true;
				}
			}
			return false;
		}

		if (method_exists($user, 'hasAnyPermission')) {
			return $user->hasAnyPermission($permissions);
		}

		return false;
	}
}
