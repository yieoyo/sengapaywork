<?php 
namespace App\Model; 
use Eloquent,App,DB;

/**
 * SeatReservationOrder Model
 */
 
class SeatReservationOrder extends Eloquent  {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
 
	protected $table = 'seat_reservation_orders';
	
	
}// end SeatReservationOrder class
