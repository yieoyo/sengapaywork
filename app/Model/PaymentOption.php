<?php 
namespace App\Model; 
use Eloquent,App,DB;

/**
 * PaymentOption Model
 */
 
class PaymentOption extends Eloquent  {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
 
	protected $table = 'payment_options';
	
	
}// end PaymentOption class
