<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;

class PurchaseEnquiryItem extends Model {

	use softDeletes;
	
	protected $table = 'purchase_enquiry_item';
	protected $primaryKey = 'id';
	protected $fillable = [
		'purchase_enquiry_id',
		'item_id',
		'item_name',
		'unit_id',
		'quantity',
		'unit_price',
		'total_price',
		'remarks',
		'balance_quantity',
		'is_transfer'
	];
	public $timestamps = false;
	protected $dates = ['deleted_at'];
}

