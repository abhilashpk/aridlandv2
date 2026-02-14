<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;

class CustomerEnquiry extends Model {

	use softDeletes;
	
	protected $table = 'customer_enquiry';
	protected $primaryKey = 'id';
	// protected $fillable = ['voucher_no','reference_no','description','customer_id','subject','job_id','salesman_id','header_id','footer_id','is_export','vehicle_id','job_type','jobnature','fabrication','kilometer','terms_id'];
	// In your CustomerEnquiry model
	protected $fillable = [
		'voucher_no',
		'reference_no',  // ← Make sure this is included
		'voucher_date',
		'customer_id',
		'salesman_id',
		'subject',
		'description',
		'job_id',
		'header_id',
		'footer_id',
		'is_fc',
		'currency_id',
		'currency_rate',
		'total',
		'vat_amount',
		'discount',
		'net_total',
		'total_fc',
		'discount_fc',
		'net_total_fc',
		'vat_amount_fc',
		'is_export',
		'subtotal',
		'subtotal_fc',
		'vehicle_id',
		'job_type',
		'jobnature',
		'fabrication',
		'prefix',
		'kilometer',
		'footer_text',
		'terms_id',
		'lead_id',
		'location_id',
		'is_transfer',
		'is_editable',
		'doc_status',
		'comment',
		'status',
		'created_at',
		'created_by',
	];
	public $timestamps = false;
	protected $dates = ['deleted_at'];
	
	public function quotationItem()
	{
		return $this->hasMany('App\Models\CustomerEnquiryItem')->where('status',1);
	}
	
	public function quotationInfo()
	{
		return $this->hasMany('App\Models\CustomerEnquiryItem')->where('status',1);
	}


}
