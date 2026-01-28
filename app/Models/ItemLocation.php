<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;

class ItemLocation extends Model {

	use softDeletes;
	
	protected $table = 'item_location';
	protected $primaryKey = 'id';
	protected $fillable = ['location_id'];
	public $timestamps = false;
	protected $dates = ['deleted_at'];
	
	

}
