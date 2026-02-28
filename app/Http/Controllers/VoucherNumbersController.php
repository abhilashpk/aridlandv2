<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\VoucherNo\VoucherNoInterface; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use Redirect;
use App;

class VoucherNumbersController extends Controller
{
    protected $voucherno;
	
	public function __construct(VoucherNoInterface $voucherno) {
		
		parent::__construct( App::make('App\Repositories\Parameter1\Parameter1Interface'), App::make('App\Repositories\VatMaster\VatMasterInterface') );
		$this->voucherno = $voucherno;
		$this->middleware('auth');
		
	}
	
	public function index() { 
		$data = array();
		$departmentId = Auth::user()->department_id;
		$vouchers = $this->voucherno->getVoucherNoSetting($departmentId);
		return view('body.vouchernumbers.index')
					->withVouchers($vouchers)
					->withData($data);
	}
	
	public function update(Request $request)
	{ 
		$departmentId = Auth::user()->department_id;

        $data = $request->all();
        $data['department_id'] = $departmentId; // ensure department is saved

        $this->voucherno->update(null, $data);
		// $this->voucherno->update($id=null,$request->all());
		Session::flash('message', 'Voucher No. updated successfully');
		return redirect('voucher_numbers');
	}
}

