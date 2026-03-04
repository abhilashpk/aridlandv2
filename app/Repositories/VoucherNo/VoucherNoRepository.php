<?php
declare(strict_types=1);
namespace App\Repositories\VoucherNo;

use App\Models\VoucherNo;
use App\Repositories\AbstractValidator;
use App\Exceptions\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Image;
use Config;

class VoucherNoRepository extends AbstractValidator implements VoucherNoInterface {
	
	protected $voucherno;
	protected $voucher_type;
	
	protected static $rules = [];
	
	public function __construct(VoucherNo $voucherno) {
		$this->voucherno = $voucherno;
		
	}
	
	// public function all()
	// {
	// 	return $this->voucherno->get();
	// }

	public function all()
	{
		return $this->voucherno
					->where('department_id', Auth::user()->department_id)
					->get();
	}
	
	// public function find($id)
	// {
	// 	return $this->voucherno->where('id', $id)->first();
	// }

	public function find($id)
	{
		return $this->voucherno
					->where('id', $id)
					->where('department_id', Auth::user()->department_id)
					->first();
	}
	
	// public function create($attributes)
	// {
	// 	if($this->isValid($attributes)) { 
			
	// 		$this->voucherno->voucherno_name = $attributes['voucherno_name'];
	// 		$this->voucherno->fill($attributes)->save();
	// 		return true;
	// 	}
		
	// }

	public function create($attributes)
	{
		if ($this->isValid($attributes)) {

			$attributes['department_id'] = Auth::user()->department_id;
			// $this->voucherno->voucherno_name = $attributes['voucherno_name'];

			$this->voucherno->fill($attributes)->save();
			return true;
		}
	}
	
	/* public function update($id, $attributes)
	{
		$this->voucherno = $this->find($id);
		$this->voucherno->fill($attributes)->save();
		return true;
	} */
	
	// public function update($id,$parameter)
	// { //echo '<pre>';print_r($parameter);exit;
	// 	foreach($parameter['id'] as $key => $row) {
	// 		$this->voucherno = $this->find($parameter['id'][$key]); 
	// 		$this->voucherno->no = $parameter['no'][$key];
	// 		$this->voucherno->prefix = $parameter['prefix'][$key];
	// 		$this->voucherno->autoincrement = (isset($parameter['autoincrement'][$key]))?$parameter['autoincrement'][$key]:0;
	// 		$this->voucherno->save();
	// 	}
	// 	return true;
	// }


	public function update($id, $parameter)
	{
		$departmentId = Auth::user()->department_id;

		foreach ($parameter['id'] as $key => $row) {

			// Step 1: Get voucher from DB using ID (any department)
			$baseVoucher = VoucherNo::where('id', $parameter['id'][$key])->first();

			if (!$baseVoucher) {
				continue;
			}

			// Step 2: Try find same voucher_type for THIS department
			$voucher = VoucherNo::where('voucher_type', $baseVoucher->voucher_type)
				->where('department_id', $departmentId)
				->first();

			if ($voucher) {
				// UPDATE
				$voucher->no = $parameter['no'][$key];
				$voucher->prefix = $parameter['prefix'][$key];
				$voucher->autoincrement = isset($parameter['autoincrement'][$key]) ? 1 : 0;
				$voucher->modified_at = Carbon::now();
				$voucher->save();
			} else {
				// CREATE new row for this department
				VoucherNo::create([
					'voucher_type'  => $baseVoucher->voucher_type,
					'name'          => $baseVoucher->name,
					'no'            => $parameter['no'][$key],
					'prefix'        => $parameter['prefix'][$key],
					'autoincrement' => isset($parameter['autoincrement'][$key]) ? 1 : 0,
					'status'        => $baseVoucher->status,
					'modified_at'   => Carbon::now(),
					'department_id' => $departmentId,
				]);
			}
		}

		return true;
	}
	
	
	// public function delete($id)
	// {
	// 	$this->voucherno = $this->voucherno->find($id);
	// 	$this->voucherno->delete();
	// }

	public function delete($id)
	{
		$this->voucherno = $this->voucherno
								->where('id', $id)
								->where('department_id', Auth::user()->department_id)
								->first();

		if ($this->voucherno) {
			$this->voucherno->delete();
		}
	}
	
	// public function getVoucherNo($type) 
	// {
	// 	return $this->voucherno->where('voucher_type', $type)->first();
	// }

	public function getVoucherNo($type)
	{
		return $this->voucherno
					->where('voucher_type', $type)
					->where('department_id', Auth::user()->department_id)
					->first();
	}

	// public function getVoucherNoSetting()
	// {
	// 	return $this->voucherno->where('status',1)->get();
	// }

	public function getVoucherNoSetting()
	{
		return $this->voucherno
					->where('status', 1)
					->where('department_id', Auth::user()->department_id)
					->get();
	}
	
}

