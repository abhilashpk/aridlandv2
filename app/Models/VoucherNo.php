<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

class VoucherNo extends Model {

	protected $table = 'voucher_no';
	protected $primaryKey = 'id';
	// protected $fillable = ['voucher_type','no'];
	protected $fillable = [
		'voucher_type',
		'name',
		'status',
		'no',
		'prefix',
		'autoincrement',
		'modified_at',
		'department_id'
	];
	public $timestamps = false;
	//protected $dates = ['deleted_at'];
	
		
	
	

}
