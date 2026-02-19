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

class CategoryController extends Controller
{
   
	protected $category;

	public function __construct(CategoryInterface $category) {

		parent::__construct( App::make('App\Repositories\Parameter1\Parameter1Interface'), App::make('App\Repositories\VatMaster\VatMasterInterface') );
		$this->category = $category;
		$this->middleware('auth');

	}

	public function index() {
		//echo 'hi';
		//return view('simple_tables');
		$data = array();
		$categories = $this->category->categoryList();
		//Session::flash('message', 'Category added successfully.');
		return view('body.category.index')
					->withCategories($categories)
					->withData($data);
	}

	public function add() {

		$data = array();
		return view('body.category.add')
					->withData($data);
	}
	
	public function save(Request $request) {
		if (!$this->canManageMaster('it-category-create')) {
			return redirect()->back()->with('error', 'Unauthorized action.');
		}
		//print_r($request->all());
		try {
			$this->category->create($request->all());
			Session::flash('message', 'Category added successfully.');
			return redirect('category');
		} catch(ValidationException $e) { 
			return Redirect::to('category/add')->withErrors($e->getErrors());
		}
	}
	
	public function edit($id) { 
		if (!$this->canManageMaster('it-category-edit')) {
			return redirect()->back()->with('error', 'Unauthorized action.');
		}

		$data = array();
		$catrow = $this->category->find($id);//print_r($grouprow);
		return view('body.category.edit')
					->withCatrow($catrow)
					->withData($data);
	}
	
	public function update($id, Request $request)
	{
		if (!$this->canManageMaster('it-category-edit')) {
			return redirect()->back()->with('error', 'Unauthorized action.');
		}
		$this->category->update($id, $request->all());//print_r($request->all());exit;
		//Session::flash('message', 'Category updated successfully');
		return redirect('category');
	}
	
	// public function destroy($id)
	// {
	// 	$this->category->delete($id);
	// 	//check group name is already in use.........
	// 	// code here ********************************
	// 	Session::flash('message', 'Category deleted successfully.');
	// 	return redirect('category');
	// }

	public function destroy(Request $request) { // ✓ Better name
		if (!$this->canManageMaster('it-category-delete')) {
			return redirect()->back()->with('error', 'Unauthorized action.');
		}
		$ids = $request->get('ids');
		if ($ids) {
			$idarr = array_filter(explode(',', $ids), 'is_numeric'); // ✓ Validate
			if (!empty($idarr)) {
				DB::table('category')
					->whereIn('id', $idarr)
					->update(['deleted_at' => now()]); // ✓ Use now()
				Session::flash('message', 'Categories deleted successfully.');
			}
		}
		return redirect('category');
	}
	
	public function checkname(Request $request) {

		$check = $this->category->check_category_name($request->get('category_name'), $request->get('id'));
		$isAvailable = ($check) ? false : true;
		echo json_encode(array(
							'valid' => $isAvailable,
						));
	}
	public function destroyGroup(Request $request)
	{
		if (!$this->canManageMaster('it-category-delete')) {
			return redirect()->back()->with('error', 'Unauthorized action.');
		}
		$ids = $request->get('ids');
		if($ids) {
			$idarr = explode(',', $ids);
			
			DB::table('category')->whereIn('id',$idarr)->update(['deleted_at' => date('Y-m-d H:i:s')]);
			Session::flash('message', 'Categories deleted successfully.');
		}
		return redirect('category');
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

		$permissions = ['it-category-create', 'it-category-edit', 'it-category-delete'];

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
