<?php 
namespace App\Model; 
use Eloquent,App,DB;

/**
 * DonationPayment Model
 */
 
class DonationPayment extends Eloquent  {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
 
	protected $table = 'donation_payments';
	
	
}// end DonationPayment class
