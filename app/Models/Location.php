<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;
use Log;

class Location extends Model {

	use softDeletes;
	
	protected $table = 'location';
	protected $primaryKey = 'id';
	// protected $fillable = ['code','name','is_default'];
	protected $fillable = [
		'code',
		'name',
		'is_default',
		'status',
		'department_id',
		'is_conloc',
		'customer_id',
		'is_minus_qty'
	];
	public $timestamps = false;
	protected $dates = ['deleted_at'];

	public function itemLocations()
    {
        return $this->hasMany(ItemLocation::class, 'location_id', 'id');
    }

	// public function itemLocations()
	// {
	// 	return $this->hasMany(ItemLocation::class, 'location_id');
	// }

	public function customer()
	{
		return $this->belongsTo(AccountMaster::class, 'customer_id');
	}

}
