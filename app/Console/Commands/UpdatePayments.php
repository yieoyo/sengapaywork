<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\DonationPayment;
use Config;
use Carbon\Carbon;

class UpdatePayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'updating payment status';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $api_key = Config::get("Settings.payment_secret_key"); //'af6b3ddc-5152-4852-b3b8-5605aed427a1';
        //$api_key = 'af6b3ddc-5152-4852-b3b8-5605aed427a1';
        
        $payments = DonationPayment::where('payment_status',0)->where('payment_option',5)->whereMonth('created_at','=', Carbon::now()->month)->get();
        if(!empty($payments)){
            foreach($payments as $payment){
				if(!empty($payment->invoice_id)){
                    $billID = $payment->invoice_id;
                    $host = 'https://www.billplz.com/api/v3/bills/'.$billID;
                    
                    //get success bill response
                    $process = curl_init($host);
                    
                    curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
                    curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($process);
                    //curl_close($process);
                    
                    //\Log::info($response);
                    $paymentArray = json_decode($response); 
                    if(isset($paymentArray->error)){
                        $errorType = $paymentArray->error->type;
                        $errorMessage = $paymentArray->error->message;
                        
                    }else{
                        $billUrl 	= $paymentArray->url;
                        $billId 	= $paymentArray->id;
                        if(!empty($paymentArray->paid_amount)){
                            $paidAmount = ($paymentArray->paid_amount / 100);
                        }else{
                            $paidAmount = $paymentArray->paid_amount;
                        }
                        
                        if($paymentArray->state != "due"){
                            DonationPayment::where('id',$payment->id)->update(array('payment_status'=>2));
                        }
                    }
                }
            }
        }

    }
}
