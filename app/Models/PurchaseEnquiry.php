<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;

class PurchaseEnquiry extends Model {

	use softDeletes;
	
	protected $table = 'purchase_enquiry';
	protected $primaryKey = 'id';
	protected $fillable = ['voucher_id','job_id','description','supplier_id','salesman_id','location_id'];
	public $timestamps = false;
	protected $dates = ['deleted_at'];
	
	public function doItem()
	{
		return $this->hasMany('App\Models\PurchaseEnquiryItem');//->where('status',1)
	}
	
}