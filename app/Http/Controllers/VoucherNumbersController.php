<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\VoucherNo\VoucherNoInterface; 

use App\Http\Requests;
use Session;
use Redirect;
use App;
use Illuminate\Support\Facades\Auth;

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
		$departmentId = Auth::user() ? Auth::user()->department_id : null;
		$vouchers = $this->voucherno->getVoucherNoSetting($departmentId);
		return view('body.vouchernumbers.index')
					->withVouchers($vouchers)
					->withData($data);
	}
	
	public function update(Request $request)
	{ 
		$departmentId = Auth::user() ? Auth::user()->department_id : null;
		$this->voucherno->update($id=null,$request->all(),$departmentId);
		Session::flash('message', 'Voucher No. updated successfully');
		return redirect('voucher_numbers');
	}
}
