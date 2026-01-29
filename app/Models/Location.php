<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;
use Log;

class Location extends Model {

	use softDeletes;
	
	protected $table = 'location';
	protected $primaryKey = 'id';
	protected $fillable = ['code','name','is_default'];
	public $timestamps = false;
	protected $dates = ['deleted_at'];

	public function itemLocations()
    {
        return $this->hasMany(ItemLocation::class, 'location_id', 'id');
    }

}
