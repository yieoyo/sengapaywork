<?php 
namespace App\Model; 
use Eloquent,App,DB;

/**
 * SubProjectPlan Model
 */
 
class SubProjectPlan extends Eloquent  {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
 
	protected $table = 'sub_project_plans';

	protected $fillable = ['sub_project_id', 'price', 'is_primary', 'type', 'is_deleted', 'senangpay_id'];
	
	
}// end SubProjectPlan class
