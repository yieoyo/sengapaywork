<?php 
namespace App\Model; 
use Eloquent,App,DB;

/**
 * DonationOrder Model
 */
 
class DonationOrder extends Eloquent  {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
 
	protected $table = 'donation_orders';
	
	
}// end DonationOrder class
