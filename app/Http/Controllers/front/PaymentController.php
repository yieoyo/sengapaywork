<?php
/**
 * Home Controller
 */
namespace App\Http\Controllers\front;

use App\Http\Controllers\BaseController;
use App\Model\DonationOrder;
use App\Model\DonationPayment;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
	public function senangPayManualPaymentReturn(Request $request)
    {
        $secretKey = '53-784'; // Replace with your actual secret key

        // Retrieve parameters from the request
        $status_id = $request->input('status_id');
        $order_id = $request->input('order_id');
        $transaction_id = $request->input('transaction_id');
        $msg = $request->input('msg');
        $receivedHash = $request->input('hash'); // Assuming 'hash' is the name of the received hash parameter

        // Generate the string to be hashed
        $str = $secretKey . $status_id . $order_id . $transaction_id . $msg;

        // Generate the hash values
        $hmacHash = hash_hmac('SHA256', $str, $secretKey);

        // Compare the generated hash with the received hash
        if ($receivedHash === $hmacHash) {
			// update order
			$order = DonationOrder::where('id',$order_id)->first();
			if($order){
				$payment = DonationPayment::where('order_id', $order->id)->first();
				if($status_id === 1){
					$order->update(array('bill_id'=>$transaction_id));
				}
				$payment->update(array('payment_status'=>$status_id));
			}


            return response()->json(['message' => 'Payment processed successfully'], 200);
        } else {

            return response()->json(['message' => 'Hash verification failed'], 400);
        }
    }
	
}