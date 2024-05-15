<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Model\EmailAction;
use App\Model\EmailTemplate;
use App\Http\Requests;
use Config;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use DB,Str;
/**
 * Cron Controller
 *
 * Add your methods in the class below
 */
class CronController extends BaseController{

	
	public function send_payment_reminder(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		ini_set("max_execution_time",0);
		
		\Log::info('aayaaaaa');
		
		//send pending email 
		$pendingEmails = DB::table('pending_emails')->get();
		if(!empty($pendingEmails)){
			foreach($pendingEmails as $pendingEmail){
			  if(!empty($pendingEmail->email_to)){
				$receiver_email			=	$pendingEmail->email_to;
				$receiver_name			=	!empty($pendingEmail->receiver_name)?$pendingEmail->receiver_name:'';
				$email_from				=	!empty($pendingEmail->email_from)?$pendingEmail->email_from:Config::get('Settings.sender_mail');
				$subject				=	!empty($pendingEmail->subject)?$pendingEmail->subject:'';
				$message				=	!empty($pendingEmail->message)?$pendingEmail->message:'';
				
				
				$mail		= 	$this->sendMail($receiver_email,$receiver_name,$subject,$message,$email_from);
				
				DB::table('pending_emails')->delete($pendingEmail->id);
				
			  }
			}
		}
		
		
		//send reminder emails start 
		
		$firstReminderDays = Config::get('Settings.first_payment_reminder');
		$secondReminderDays = Config::get('Settings.second_payment_reminder');
		$thirdReminderDays = Config::get('Settings.third_payment_reminder');
		
		//order details//
		$orderRecords = DB::table('orders')->select('orders.*',
									DB::raw("(select departure_date from packages where id=orders.package_id) as departure_date"),
									DB::raw("(select email from users where id=orders.user_id) as sales_person_email")
								)
								->where('is_deleted',0)
								->where('is_active',1)
								->where('status',1)
								->where('package_status',1)
								->where('third_payment_reminder',0)
								->get();
								
		//pr($orderRecord); die;
		if(!empty($orderRecords)){
			foreach($orderRecords as $orderRecord){
				if($orderRecord->user_id == 2){
					$totalApprovedPayments = DB::table('guest_order_payments')->where('order_id',$orderRecord->id)->where('is_deleted',0)->where('is_active',1)->where('payment_status',2)->sum('amount');
				
					$firstReminderDate	=	date("Y-m-d",strtotime("+".$firstReminderDays." days",strtotime($orderRecord->created_at)));
					$secondReminderDate	=	date("Y-m-d",strtotime("+".$secondReminderDays." days",strtotime($orderRecord->created_at)));
					$thirdReminderDate	=	date("Y-m-d",strtotime("+".$thirdReminderDays." days",strtotime($orderRecord->created_at)));
					$todayDate 			=	date("Y-m-d");
				
				
					$bill_id 				= $orderRecord->bill_id;
					$order_unique_id 		= $orderRecord->order_unique_id;
					$deposit_amount 		= $totalApprovedPayments;
					$total_price 			= $orderRecord->total_price;
					$sales_person_email 	= $orderRecord->sales_person_email;
					$customer_id 			= "";
					$full_name 				= $orderRecord->contact_name;
					$phone 					= $orderRecord->contact_phone;
					$email 					= $orderRecord->contact_email;
					$currency_sign 			= Currency;
					$invoice_link 			= WEBSITE_URL."invoice/".$orderRecord->order_unique_id;  //"https://www.billplz.com/bills/".$orderRecord->bill_id;
					$booking_expiry_date 	= $orderRecord->booking_expiry_date;
					$remainingAmount		= $orderRecord->total_price - $totalApprovedPayments;
					$due_date				= date("d/m/Y",strtotime($orderRecord->departure_date));
					
					
					$settingsEmail 			= 	Config::get('Settings.sender_mail');
					$SiteTitle 				= 	Config::get('Settings.business_name');
					
					
					$emailActions			= 	EmailAction::where('action','=','send_remainder')->get()->first();
					$emailTemplates			= 	EmailTemplate::where('action','=','send_remainder')->get(array('name','subject','action','body'))->first();
				
					$cons1 					= 	explode(',',$emailActions['options']);
					$constants1 			= 	array();
					
					foreach($cons1 as $key => $val){
						$constants1[] 		= 	'{'.$val.'}';
					} 
					
					$subject 				= 	$emailTemplates['subject'];
					$rep_Array 				= 	array($bill_id,$order_unique_id,$deposit_amount,$total_price,$remainingAmount,$email,$customer_id,$phone,$currency_sign,$invoice_link,$SiteTitle,$full_name,$due_date); 
					$messageBody			= 	str_replace($constants1, $rep_Array, $emailTemplates['body']);
					$mail					= 	$this->sendMail($email,$full_name,$subject,$messageBody,$settingsEmail);
				
					//send email to agent
					if(!empty($sales_person_email)){
						$emailActions			= 	EmailAction::where('action','=','send_remainder_sales_person')->get()->first();
						$emailTemplates			= 	EmailTemplate::where('action','=','send_remainder_sales_person')->get(array('name','subject','action','body'))->first();
					
						$cons1 					= 	explode(',',$emailActions['options']);
						$constants1 			= 	array();
						
						foreach($cons1 as $key => $val){
							$constants1[] 		= 	'{'.$val.'}';
						} 
						
						$subject 				= 	$emailTemplates['subject'];
						$rep_Array 				= 	array($bill_id,$order_unique_id,$deposit_amount,$total_price,$remainingAmount,$email,$customer_id,$phone,$currency_sign,$invoice_link,$SiteTitle,$full_name,$due_date); 
						$messageBody			= 	str_replace($constants1, $rep_Array, $emailTemplates['body']);
						$mail					= 	$this->sendMail($sales_person_email,$full_name,$subject,$messageBody,$settingsEmail);
					}
					
					DB::table('orders')->where('id',$orderRecord->id)->update(array('first_payment_reminder'=>1));
					
				}
				
				$totalApprovedPayments = DB::table('guest_order_payments')->where('order_id',$orderRecord->id)->where('is_deleted',0)->where('is_active',1)->where('payment_status',2)->sum('amount');
				
				if($totalApprovedPayments < $orderRecord->total_price){
					$firstReminderDate	=	date("Y-m-d",strtotime("+".$firstReminderDays." days",strtotime($orderRecord->created_at)));
					$secondReminderDate	=	date("Y-m-d",strtotime("+".$secondReminderDays." days",strtotime($orderRecord->created_at)));
					$thirdReminderDate	=	date("Y-m-d",strtotime("+".$thirdReminderDays." days",strtotime($orderRecord->created_at)));
					$todayDate 			=	date("Y-m-d");
					
					
					$bill_id 				= $orderRecord->bill_id;
					$order_unique_id 		= $orderRecord->order_unique_id;
					$deposit_amount 		= $totalApprovedPayments;
					$total_price 			= $orderRecord->total_price;
					$sales_person_email 	= $orderRecord->sales_person_email;
					$customer_id 			= "";
					$full_name 				= $orderRecord->contact_name;
					$phone 					= $orderRecord->contact_phone;
					$email 					= $orderRecord->contact_email;
					$currency_sign 			= Currency;
					$invoice_link 			= WEBSITE_URL."invoice/".$orderRecord->order_unique_id;  //"https://www.billplz.com/bills/".$orderRecord->bill_id;
					$booking_expiry_date 	= $orderRecord->booking_expiry_date;
					$remainingAmount		= $orderRecord->total_price - $totalApprovedPayments;
					$due_date				= date("d/m/Y",strtotime($orderRecord->departure_date));
					
					//$this->sendAmountPaidEmailUser($bill_id,$order_unique_id,$deposit_amount,$total_price,$remainingAmount,$email,$customer_id,$phone,$currency_sign,$invoice_link,$siteTitle,$full_name,$due_date);
					
					if($orderRecord->first_payment_reminder == 0 && ($todayDate == $firstReminderDate)){
						$settingsEmail 			= 	Config::get('Settings.sender_mail');
						$SiteTitle 				= 	Config::get('Settings.business_name');
						
						
						$emailActions			= 	EmailAction::where('action','=','send_remainder')->get()->first();
						$emailTemplates			= 	EmailTemplate::where('action','=','send_remainder')->get(array('name','subject','action','body'))->first();
					
						$cons1 					= 	explode(',',$emailActions['options']);
						$constants1 			= 	array();
						
						foreach($cons1 as $key => $val){
							$constants1[] 		= 	'{'.$val.'}';
						} 
						
						$subject 				= 	$emailTemplates['subject'];
						$rep_Array 				= 	array($bill_id,$order_unique_id,$deposit_amount,$total_price,$remainingAmount,$email,$customer_id,$phone,$currency_sign,$invoice_link,$SiteTitle,$full_name,$due_date); 
						$messageBody			= 	str_replace($constants1, $rep_Array, $emailTemplates['body']);
						$mail					= 	$this->sendMail($email,$full_name,$subject,$messageBody,$settingsEmail);
					
						//send email to agent
						if(!empty($sales_person_email)){
							$emailActions			= 	EmailAction::where('action','=','send_remainder_sales_person')->get()->first();
							$emailTemplates			= 	EmailTemplate::where('action','=','send_remainder_sales_person')->get(array('name','subject','action','body'))->first();
						
							$cons1 					= 	explode(',',$emailActions['options']);
							$constants1 			= 	array();
							
							foreach($cons1 as $key => $val){
								$constants1[] 		= 	'{'.$val.'}';
							} 
							
							$subject 				= 	$emailTemplates['subject'];
							$rep_Array 				= 	array($bill_id,$order_unique_id,$deposit_amount,$total_price,$remainingAmount,$email,$customer_id,$phone,$currency_sign,$invoice_link,$SiteTitle,$full_name,$due_date); 
							$messageBody			= 	str_replace($constants1, $rep_Array, $emailTemplates['body']);
							$mail					= 	$this->sendMail($sales_person_email,$full_name,$subject,$messageBody,$settingsEmail);
						}
						
						DB::table('orders')->where('id',$orderRecord->id)->update(array('first_payment_reminder'=>1));
					
					}else if($orderRecord->second_payment_reminder == 0 && ($todayDate == $secondReminderDate)){
						$settingsEmail 			= 	Config::get('Settings.sender_mail');
						$SiteTitle 				= 	Config::get('Settings.business_name');
						
						
						$emailActions			= 	EmailAction::where('action','=','send_remainder')->get()->first();
						$emailTemplates			= 	EmailTemplate::where('action','=','send_remainder')->get(array('name','subject','action','body'))->first();
					
						$cons1 					= 	explode(',',$emailActions['options']);
						$constants1 			= 	array();
						
						foreach($cons1 as $key => $val){
							$constants1[] 		= 	'{'.$val.'}';
						} 
						
						$subject 				= 	$emailTemplates['subject'];
						$rep_Array 				= 	array($bill_id,$order_unique_id,$deposit_amount,$total_price,$remainingAmount,$email,$customer_id,$phone,$currency_sign,$invoice_link,$SiteTitle,$full_name,$due_date); 
						$messageBody			= 	str_replace($constants1, $rep_Array, $emailTemplates['body']);
						$mail					= 	$this->sendMail($email,$full_name,$subject,$messageBody,$settingsEmail);
					
						//send email to agent
						if(!empty($sales_person_email)){
							$emailActions			= 	EmailAction::where('action','=','send_remainder_sales_person')->get()->first();
							$emailTemplates			= 	EmailTemplate::where('action','=','send_remainder_sales_person')->get(array('name','subject','action','body'))->first();
						
							$cons1 					= 	explode(',',$emailActions['options']);
							$constants1 			= 	array();
							
							foreach($cons1 as $key => $val){
								$constants1[] 		= 	'{'.$val.'}';
							} 
							
							$subject 				= 	$emailTemplates['subject'];
							$rep_Array 				= 	array($bill_id,$order_unique_id,$deposit_amount,$total_price,$remainingAmount,$email,$customer_id,$phone,$currency_sign,$invoice_link,$SiteTitle,$full_name,$due_date); 
							$messageBody			= 	str_replace($constants1, $rep_Array, $emailTemplates['body']);
							$mail					= 	$this->sendMail($sales_person_email,$full_name,$subject,$messageBody,$settingsEmail);
						}
						
						DB::table('orders')->where('id',$orderRecord->id)->update(array('second_payment_reminder'=>1));
					
					}else if($orderRecord->third_payment_reminder == 0 && ($todayDate == $thirdReminderDate)){
						$settingsEmail 			= 	Config::get('Settings.sender_mail');
						$SiteTitle 				= 	Config::get('Settings.business_name');
						
						
						$emailActions			= 	EmailAction::where('action','=','send_remainder')->get()->first();
						$emailTemplates			= 	EmailTemplate::where('action','=','send_remainder')->get(array('name','subject','action','body'))->first();
					
						$cons1 					= 	explode(',',$emailActions['options']);
						$constants1 			= 	array();
						
						foreach($cons1 as $key => $val){
							$constants1[] 		= 	'{'.$val.'}';
						} 
						
						$subject 				= 	$emailTemplates['subject'];
						$rep_Array 				= 	array($bill_id,$order_unique_id,$deposit_amount,$total_price,$remainingAmount,$email,$customer_id,$phone,$currency_sign,$invoice_link,$SiteTitle,$full_name,$due_date); 
						$messageBody			= 	str_replace($constants1, $rep_Array, $emailTemplates['body']);
						$mail					= 	$this->sendMail($email,$full_name,$subject,$messageBody,$settingsEmail);
					
						//send email to agent
						if(!empty($sales_person_email)){
							$emailActions			= 	EmailAction::where('action','=','send_remainder_sales_person')->get()->first();
							$emailTemplates			= 	EmailTemplate::where('action','=','send_remainder_sales_person')->get(array('name','subject','action','body'))->first();
						
							$cons1 					= 	explode(',',$emailActions['options']);
							$constants1 			= 	array();
							
							foreach($cons1 as $key => $val){
								$constants1[] 		= 	'{'.$val.'}';
							} 
							
							$subject 				= 	$emailTemplates['subject'];
							$rep_Array 				= 	array($bill_id,$order_unique_id,$deposit_amount,$total_price,$remainingAmount,$email,$customer_id,$phone,$currency_sign,$invoice_link,$SiteTitle,$full_name,$due_date); 
							$messageBody			= 	str_replace($constants1, $rep_Array, $emailTemplates['body']);
							$mail					= 	$this->sendMail($sales_person_email,$full_name,$subject,$messageBody,$settingsEmail);
						}
						
						DB::table('orders')->where('id',$orderRecord->id)->update(array('third_payment_reminder'=>1));
					
					}
				
				}
			}
		}
		
		echo "Success"; die;
		
	}


    public function captureRecurringPayments(){  
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		ini_set("max_execution_time",0);
		 
		 
		$recurringOrders = DB::table('donation_orders')->where('is_recurring',1)->where('is_active',1)->where('is_deleted',0)->get();
		if(!empty($recurringOrders)){
			foreach($recurringOrders as $record){
				if(!empty($record->plan_type)){
					if($record->plan_type == "daily"){
						$todayStartDate = date("Y-m-d 00:00:01");
						$todayEndDate = date("Y-m-d 23:59:59");
						$checkPayment = DB::table('donation_payments')->where('is_deleted',0)->where('is_active',1)->where('order_id',$record->id)->where('created_at','>=',$todayStartDate)->where('created_at','<=',$todayEndDate)->count('id');
						if(empty($checkPayment) || $checkPayment == 0){
							echo "send email";
							
						}
						
					}else if($record->plan_type == "monthly"){
						$monthStartDate = date("Y-m-01 00:00:01");
						$monthEndDate = date("Y-m-t 23:59:59");
						$currentMonth	=	date("m");
						$currentYear	=	date("Y");
						$PlanStartDate	=	date($currentYear."-".$currentMonth."-d 00:00:01",strtotime($record->created_at));
						$PlanEndDate	=	date($currentYear."-".$currentMonth."-d 23:59:59",strtotime($record->created_at));
						$checkPayment = DB::table('donation_payments')->where('is_deleted',0)->where('is_active',1)->where('order_id',$record->id)->where('created_at','>=',$monthStartDate)->where('created_at','<=',$monthEndDate)->where('created_at','>=',$PlanStartDate)->where('created_at','<=',$PlanEndDate)->count('id');
						if(empty($checkPayment) || $checkPayment == 0){
							echo "send email";
							
						}
						
					}else if($record->plan_type == "yearly"){
						$yearStartDate = date("Y-01-01 00:00:01");
						$yearEndDate = date("Y-12-t 23:59:59");
						$currentMonth	=	date("m");
						$currentYear	=	date("Y");
						$PlanStartDate	=	date($currentYear."-".$currentMonth."-d 00:00:01",strtotime($record->created_at));
						$PlanEndDate	=	date($currentYear."-".$currentMonth."-d 23:59:59",strtotime($record->created_at));
						$checkPayment = DB::table('donation_payments')->where('is_deleted',0)->where('is_active',1)->where('order_id',$record->id)->where('created_at','>=',$yearStartDate)->where('created_at','<=',$yearEndDate)->where('created_at','>=',$PlanStartDate)->where('created_at','<=',$PlanEndDate)->count('id');
						if(empty($checkPayment) || $checkPayment == 0){
							echo "send email";
							
						}
						
					}
					
					
				}
				
				
			}
			
			
		}
		
		
		
		//$broadcasts = DB::table('broadcasts')->where('is_send',0)->where('is_deleted',0)->where('is_draft',0)->where('date_time','<=',date('Y-m-d H:i:s'))->get();
		$officer_list = DB::table('broadcast_subscribers')->leftJoin("broadcasts","broadcasts.id","=",".broadcast_subscribers.broadcast_id")->where('broadcast_subscribers.delivered',0)->where('broadcasts.date_time','<=',date('Y-m-d H:i:s'))->where('broadcasts.is_draft',0)->select("broadcast_subscribers.broadcast_id","broadcast_subscribers.officer_id","broadcast_subscribers.id")->get(); 
		 
		if(!empty($officer_list)){
			 
			foreach($officer_list as $officer_subscriber){  
				/* $officer_list = DB::table('broadcast_subscribers')->where('broadcast_id',$broadcast->id)->get();
				if(!empty($officer_list)){
					foreach($officer_list as $officer_subscriber){ */
						$broadcast	=	DB::table('broadcasts')->where('id',$officer_subscriber->broadcast_id)->first();
						$officer				=	DB::table('users')->where('id',$officer_subscriber->officer_id)->first();
						if(!empty($officer)){
    						$device_type			=	$officer->device_type;
    						$device_token			=	$officer->device_token;
    						if(!empty($device_token)){
    							if($device_type == "iphone"){ 
    							}elseif($device_type == "android"){  
    								$res	=	$this->mobilePushNotification($device_type,$device_token,$broadcast->message,$broadcast->name,$broadcast->id,"message");  
    								if($res){ 
    									$delivered			=  1;   
    								}else{ 
    									$delivered			=  0;  
    								} 
    								DB::table('broadcast_subscribers')->where('id',$officer_subscriber->id)->update(array('delivered'=>$delivered)); 
    							} 
    						} 
						} 
				DB::table('broadcasts')->where('id',$broadcast->id)->update(array('is_send'=>1));
			} 
		} 
		die;
	}

}// end
