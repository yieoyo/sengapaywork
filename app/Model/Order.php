<?php 
namespace App\Model; 
use Eloquent,App,DB;

/**
 * Order Model
 */
 
class Order extends Eloquent  {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
 
	protected $table = 'orders';
	
	
}// end Order class
