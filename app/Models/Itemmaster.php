<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Itemmaster extends Model
{
    use softDeletes;
	
	protected $table = 'itemmaster';
	protected $primaryKey = 'id';

	protected $fillable = ['item_code','description','description_ar','class_id','model_no','serial_no','group_id',
	'subgroup_id','category_id','subcategory_id', 'bin','weight','assembly','image','status',
    'created_at','created_by','created_department','modified_at','modify_by','profit_per','other_info','supersede_items',
    'surface_cost','surface_cost','other_cost','bin_location','itmHt','itmWd','itmLt','dimension','mpqty','p1_qty',
    'p2_qty','p1_formula','p2_formula','batch_req'];

	public $timestamps = false;
	protected $dates = ['deleted_at'];
	
	public function itemUnits()
	{
		return $this->hasMany('App\Models\ItemUnit')->where('status',1);
	}
}

