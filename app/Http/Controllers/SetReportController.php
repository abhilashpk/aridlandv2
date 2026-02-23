<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

use App\Http\Requests;
use Notification;
use Session;
use DB;
use App;
use Auth;

class SetReportController extends Controller
{
	
	public function __construct() {
		
		parent::__construct( App::make('App\Repositories\Parameter1\Parameter1Interface'), App::make('App\Repositories\VatMaster\VatMasterInterface') );
		$this->middleware('auth');

	}

	private function getCurrentDepartmentId() {
		if(Auth::check() && (int) Auth::user()->department_id !== 0) {
			return (int) Auth::user()->department_id;
		}
		return null;
	}

	public function index()
	{  
		$reports = DB::table('report_view')->where('status',1)->get(); //
		//echo '<pre>';print_r($reports);
		//echo '<pre>';print_r($reports[0]->report_name);exit;
		
		return view('body.setreport.index')
					->withReports($reports);
	}
	
	public function update(Request $request) {
		$deptid = $this->getCurrentDepartmentId();
		$hasDeptColumn = Schema::hasColumn('report_view_detail', 'department_id');
		$savedId = null;

		if($request->get('id')!='') {
			$existing = DB::table('report_view_detail')->where('id', $request->get('id'))->first();
			if($request->get('opt')==1 && $existing) {
				$reset = DB::table('report_view_detail')->where('report_view_id', $existing->report_view_id);
				if($hasDeptColumn) {
					if($deptid) $reset->where('department_id', $deptid);
					else $reset->whereNull('department_id');
				}
				$reset->update(['is_default' => 0]);
			}
			
			$upd = DB::table('report_view_detail')->where('id', $request->get('id'));
			if($hasDeptColumn && $deptid) {
				$upd->where('department_id', $deptid);
			}
			$data = [ 'name' => $request->get('name'),
					  'print_name' => $request->get('file'),
					  'is_default' => $request->get('opt')
					];
			if($hasDeptColumn) {
				$data['department_id'] = $deptid;
			}
			$upd->update($data);
			$savedId = (int) $request->get('id');
		} else { 
			if($request->get('opt')==1) {
				$reset = DB::table('report_view_detail')->where('report_view_id', $request->get('rid'));
				if($hasDeptColumn) {
					if($deptid) $reset->where('department_id', $deptid);
					else $reset->whereNull('department_id');
				}
				$reset->update(['is_default' => 0]);
			}
			$insert = [ 'report_view_id' => $request->get('rid'),
						'name' => $request->get('name'),
						'print_name' => $request->get('file'),
						'is_default' => $request->get('opt')
					  ];
			if($hasDeptColumn) {
				$insert['department_id'] = $deptid;
			}
			$savedId = DB::table('report_view_detail')
						->insertGetId($insert);
		}
		return response()->json(['status' => true, 'id' => $savedId]);
	}
	
	public function assignPrint($id)
	{  
		$deptid = $this->getCurrentDepartmentId();
		$hasDeptColumn = Schema::hasColumn('report_view_detail', 'department_id');
		$report = DB::table('report_view')->where('id',$id)->first();

		$query = DB::table('report_view_detail')
					->join('report_view','report_view.id','=','report_view_detail.report_view_id')
					->where('report_view_detail.report_view_id',$id);
		if($hasDeptColumn && $deptid) {
			$query->where('report_view_detail.department_id', $deptid);
		}
		$reports = $query->select('report_view.name AS report_name','report_view_detail.name','report_view_detail.print_name',
								  'report_view.id','report_view_detail.is_default','report_view_detail.id AS rid')
						 ->get(); //
							//echo '<pre>';print_r($reports);exit;
							
		$files = Storage::disk('reports')->files();
		
		return view('body.setreport.detail')
					->withReports($reports)
					->withReport($report)
					->withFiles($files);
	}
	
	public function delete($id) {
		
		DB::table('report_view_detail')->where('id',$id)->delete();
	}
	
	public function save($id) {
		$rec = DB::table('report_view_detail')->where('id',$id)->first();
		DB::table('design_view')->where('id',1)->update(['view_name' => $rec->print_name]);
	}
	
	public function getInfoTemplate($code) {
		
		$items = DB::table('info_template')->where('deleted_at',null)->where('doc_type',$code)->select('*')->get();
		//echo '<pre>';print_r($items);exit;
		return view('body.setreport.infotemplate')->withItems($items);
	}
	
}


//SELECT account_master.master_name,account_master.address,account_master.phone,account_master.vat_no,receipt_voucher.voucher_no,receipt_voucher.voucher_date,receipt_voucher.tr_description,jobmaster.code AS jobode,receipt_voucher_entry.amount FROM receipt_voucher JOIN ON(receipt_voucher_entry.receipt_voucher_id=receipt_voucher.id AND receipt_voucher_entry.entry_type='Cr') JOIN ON(account_master.id=receipt_voucher_entry.account_id) LEFT JOIN ON(jobmaster.id=receipt_voucher_entry.job_id) WHERE receipt_voucher.id=
