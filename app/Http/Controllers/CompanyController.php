<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Company\CompanyInterface; 
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Http\Requests;
use Input;
use Session;
use Redirect;
use App;


class CompanyController extends Controller
{
    protected $company;
	
	public function __construct(CompanyInterface $company) {
		
		parent::__construct( App::make('App\Repositories\Parameter1\Parameter1Interface'), App::make('App\Repositories\VatMaster\VatMasterInterface') );
		$this->company = $company;
		$this->middleware('auth');
		
	}
	
	public function index() { 
		$data = array();
		$departmentId = Auth::user() ? Auth::user()->department_id : null;
		$company = $this->company->getCompany($departmentId);
		$isNew = false;
		if (!$company) {
			$company = new Company();
			$company->id = 0;
			$company->company_name = '';
			$company->email = '';
			$company->phone = '';
			$company->address = '';
			$company->city = '';
			$company->state = '';
			$company->country = '';
			$company->pin = '';
			$company->website = '';
			$company->vat_no = '';
			$company->logo = '';
			$isNew = true;
		}
		
		return view('body.company.index')
					->withCompany($company)
					->withData($data)
					->withIsNew($isNew);
	}

	public function store()
	{
		$departmentId = Auth::user() ? Auth::user()->department_id : null;
		$attributes = Input::all();
		$attributes['department_id'] = $departmentId;
		$this->company->create($attributes);
		Session::flash('message', 'Company details created successfully');
		return redirect('company');
	}

	public function update($id)
	{ 
	    //echo '<pre>';print_r(Input::all());exit;
		$this->company->update($id, Input::all());
		//echo '<pre>';print_r($id);exit;
		Session::flash('message', 'Company details updated successfully');
		return redirect('company');
	}
}
