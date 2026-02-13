<?php
declare(strict_types=1);
namespace App\Repositories\VoucherNo;

use App\Models\VoucherNo;
use App\Repositories\AbstractValidator;
use App\Exceptions\Validation\ValidationException;
use Image;
use Config;

class VoucherNoRepository extends AbstractValidator implements VoucherNoInterface {
	
	protected $voucherno;
	
	protected static $rules = [];
	
	public function __construct(VoucherNo $voucherno) {
		$this->voucherno = $voucherno;
		
	}
	
	public function all()
	{
		return $this->voucherno->get();
	}
	
	public function find($id)
	{
		return $this->voucherno->where('id', $id)->first();
	}
	
	public function create($attributes)
	{
		if($this->isValid($attributes)) { 
			
			$this->voucherno->voucherno_name = $attributes['voucherno_name'];
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
	
	public function update($id,$parameter,$departmentId = null)
	{ //echo '<pre>';print_r($parameter);exit;
		foreach($parameter['voucher_type'] as $key => $type) {
			$query = $this->voucherno->where('voucher_type', $type);
			if ($departmentId !== null && $departmentId !== '') {
				$query->where('department_id', $departmentId);
			}
			$this->voucherno = $query->first();

			if (!$this->voucherno) {
				$this->voucherno = new VoucherNo();
				$this->voucherno->voucher_type = $type;
				$this->voucherno->name = isset($parameter['name'][$key]) ? $parameter['name'][$key] : '';
				$this->voucherno->status = 1;
				$this->voucherno->department_id = $departmentId;
			}

			$this->voucherno->no = $parameter['no'][$key];
			$this->voucherno->prefix = $parameter['prefix'][$key];
			$this->voucherno->autoincrement = (isset($parameter['autoincrement'][$key]))?$parameter['autoincrement'][$key]:0;
			$this->voucherno->save();
		}
		return true;
	}
	
	
	public function delete($id)
	{
		$this->voucherno = $this->voucherno->find($id);
		$this->voucherno->delete();
	}
	
	public function getVoucherNo($type) 
	{
		return $this->voucherno->where('voucher_type', $type)->first();
	}

	public function getVoucherNoSetting($departmentId = null)
	{
		if ($departmentId === null || $departmentId === '') {
			return $this->voucherno->where('status',1)->get();
		}

		$base = $this->voucherno
			->where('status',1)
			->where(function ($q) {
				$q->whereNull('department_id')->orWhere('department_id', 0);
			})
			->get();

		$dept = $this->voucherno
			->where('status',1)
			->where('department_id', $departmentId)
			->get()
			->keyBy('voucher_type');

		$merged = $base->map(function ($row) use ($dept) {
			if ($dept->has($row->voucher_type)) {
				$deptRow = $dept->get($row->voucher_type);
				$row->id = $deptRow->id;
				$row->no = $deptRow->no;
				$row->prefix = $deptRow->prefix;
				$row->autoincrement = $deptRow->autoincrement;
				$row->department_id = $deptRow->department_id;
			}
			return $row;
		});

		$baseTypes = $base->pluck('voucher_type')->all();
		$extras = $dept->filter(function ($row) use ($baseTypes) {
			return !in_array($row->voucher_type, $baseTypes, true);
		});

		return $merged->values()->merge($extras->values());
	}
	
}
