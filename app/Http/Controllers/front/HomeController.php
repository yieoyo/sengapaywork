<?php
/**
 * Home Controller
 */
namespace App\Http\Controllers\front;

use App\Http\Controllers\BaseController;
use App\Model\User;
use App\Model\UserVideo;
use App\Model\EmailAction;
use App\Model\EmailTemplate;
use App\Model\CmsDescription;
use App\Model\Faq;
use App\Model\DonationOrder;
use Illuminate\Http\Request as HttpRequest;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator,App;

class HomeController extends BaseController {
	
	public function faq(){
		$lang			=	App::getLocale();
		$faqDetail		=	DB::select( DB::raw("SELECT question,answer,id FROM faq_descriptions WHERE language_id = (select id from languages WHERE languages.lang_code = '$lang')") );
		
		if(empty($faqDetail)){
			return Redirect::to('/');
		} 
		$result	=	array();
		
		//pr($faqDetail);die;
	 /* echo '<pre>'; 
		print_r($faqCategoryResult);
		die ; 
	   */
		return View::make('front.cms.faq' , compact('faqDetail'));
	}// end faq()
	
	public function aboutUs(){
		$lang			=	App::getLocale();
		$cmsPagesDetail	=	DB::select( DB::raw("SELECT * FROM cms_page_descriptions WHERE foreign_key = (select id from cms_pages WHERE cms_pages.slug = 'about') AND language_id = (select id from languages WHERE languages.lang_code = '$lang')") );
		
		if(empty($cmsPagesDetail)){
			return Redirect::to('/');
		}
		$result	=	array();
		
		foreach($cmsPagesDetail as $cms){
			$key	=	$cms->source_col_name;
			$value	=	$cms->source_col_description;
			$result[$cms->source_col_name]	=	$cms->source_col_description;
		}
		//pr($result);die;
		return View::make('front.cms.about' , compact('result','slug','systemImage'));
	}// end faq()
	
	public function terms(){
		$lang			=	App::getLocale();
		$cmsPagesDetail	=	DB::select( DB::raw("SELECT * FROM cms_page_descriptions WHERE foreign_key = (select id from cms_pages WHERE cms_pages.slug = 'terms-of-use') AND language_id = (select id from languages WHERE languages.lang_code = '$lang')") );
		
		if(empty($cmsPagesDetail)){
			return Redirect::to('/');
		}
		$result	=	array();
		
		foreach($cmsPagesDetail as $cms){
			$key	=	$cms->source_col_name;
			$value	=	$cms->source_col_description;
			$result[$cms->source_col_name]	=	$cms->source_col_description;
		}
		//pr($result);die;
		return View::make('front.cms.terms' , compact('result','slug'));
	}// end faq()
	
	public function privacyPolicy(){
		$lang			=	App::getLocale();
		$cmsPagesDetail	=	DB::select( DB::raw("SELECT * FROM cms_page_descriptions WHERE foreign_key = (select id from cms_pages WHERE cms_pages.slug = 'privacy-policy') AND language_id = (select id from languages WHERE languages.lang_code = '$lang')") );
		
		if(empty($cmsPagesDetail)){
			return Redirect::to('/');
		}
		$result	=	array();
		
		foreach($cmsPagesDetail as $cms){
			$key	=	$cms->source_col_name;
			$value	=	$cms->source_col_description;
			$result[$cms->source_col_name]	=	$cms->source_col_description;
		}
		//pr($result);die;
		return View::make('front.cms.privacy_policy' , compact('result','slug'));
	}// end faq()
	
	public function ContactUs(){
		return View::make('front.cms.contact_us');
	}
	
	public function SubmitContactUs(){
		$allData	=	Input::all();
		if(!empty($allData)){
			//print_r($allData['data']);die;
			$validator = Validator::make(
				$allData,
				array(
					'name' 			=> 'required',
					'email' 		=> 'required|email',
					'message' 		=> 'required',
					//'captcha' 		=> 'required|captcha',
				),
				array(
					'name.required' 		=> trans('Name field is required'),
					'email.required' 		=> trans('The email field is required'),
					'email.email' 			=> trans('The email is must valid required'),
					'phone_number.required' => trans('The phone field is required'),
					'subject.required'		=> trans('The subject field is required'),
					'message.required' 		=> trans('The message field is required'),
					//'captcha.required' 		=> trans('messages.the_captcha_field_is_required'),
					//'captcha.captcha' 		=> trans('messages.the_captcha_value_does_not_match'),
				)
			); 
			
			if ($validator->fails()){	
				$response	=	array(
					'success' 	=> false,
					'errors' 	=> $validator->errors()
				);
				return Response::json($response); 
				die;
				//return Redirect::back()->withErrors($validator)->withInput();
			}else{
				$date = date("Y-m-d H:i:s");
				DB::table('contact_us')->insert(
					array(
						'name'			=> $allData['name'],
						'email' 		=> $allData['email'],
						'message' 		=> $allData['message'],
						'created_at' 	=> $date,
						'updated_at' 	=> $date,
					)
				);
				
				//send email to site admin with user information,to inform that user wants to contact
				$emailActions		=  EmailAction::where('action','=','contact_us')->get()->toArray();
				$emailTemplates		=  EmailTemplate::where('action','=','contact_us')->get()->toArray();
				$cons 				=  explode(',',$emailActions[0]['options']);
				$constants 			=  array();
				
				foreach($cons as $key=>$val){
					$constants[] = '{'.$val.'}';
				}
				$name			= 	$allData['name'];
				$email			=	$allData['email'];
				$comment 		=	$allData['message'];
				
				$to				=	Config::get("Settings.sender_mail");
				$to_name		=	Config::get("Settings.business_name");
				
				$subject 		=  $emailTemplates[0]['subject'];
				$rep_Array 		=  array($name,$email,$comment); 
				$messageBody	=  str_replace($constants,$rep_Array,$emailTemplates[0]['body']);
				$settingsEmail	= 	Config::get("Settings.sender_mail"); 
				$this->sendMail($to,$to_name,$subject,$messageBody,$settingsEmail); 
				
				$response	=	array(
					'success' 	=>	'1',
					'errors' 	=>	trans("messages.thanks_for_contactus")
				); 
				return  Response::json($response);
				die;
				// Session::flash('success',  trans("messages.thanks_for_contactus")); 
				// return Redirect::back();
			}
		}
	}
		
	public function signup($email=null){
		$country_list	=	DB::table('countries')->orderBy('name','ASC')->lists('name','id');
		return View::make('front.user.sign_up',compact('country_list','email'));
	}
	
	public function newlogin(){
		if(!empty(Auth::user())){
			return Redirect::to('/dashboard');
		}
		return View::make('front.user.login');
	}
	
	public function login() {
		Input::replace($this->arrayStripTags(Input::all()));
		$formData								=	Input::all();
		if(!empty($formData)){
			$validator = Validator::make(
				Input::all(),
				array(
					'login_email' 					=> 	'required|email',
					'login_password'				=> 	'required',
				),
				array(
					"login_email.required"			=>	trans('Email field is required'),
					"login_email.email"				=>	trans('Enter valid email address'),
					"login_password.required"		=>	trans("Password field is required"),
				)
			);
		}
		if ($validator->fails()){
			$response							=	array(
				'success' 						=> 	0,
				'message' 						=> 	$validator->errors()
			);
			return Response::json($response); 
			die;
		}else {
			$checkUser = User::where('email',Input::get('login_email'))->count('id');
			if(empty($checkUser)){
				$donationUserData = DonationOrder::where('is_deleted',0)->where('is_active',1)->where('email',Input::get('login_email'))->first();
				if(!empty($donationUserData) && (!empty($donationUserData->id))){
					$obj 					=  new User;
					$validateString			=  md5(time() . $donationUserData->email);
					$obj->validate_string	=  $validateString;					
					$obj->full_name 		=  $donationUserData->full_name;
					$obj->email 			=  $donationUserData->email;
					$obj->phone 			=  $donationUserData->phone;
					$obj->slug	 			=  $this->getSlug($donationUserData->full_name,'full_name','User');
					$password				=  rand(100000,999999);
					$obj->password	 		=  Hash::make($password);
					$obj->user_role_id 		=  3;
					$obj->is_verified		=  1; 
					$obj->is_active			=  1; 
					//$obj->is_approved		=  1; 
					$obj->save();
					$userId					=	$obj->id;	
					$obj->save(); 
					
					//mail email and password to new registered user
					//$settingsEmail 			= 	Config::get('Site.email');
					$settingsEmail 			= 	Config::get('Settings.sender_mail');
					$SiteTitle 				= 	Config::get('Settings.business_name');
					
					$full_name				= 	$obj->full_name; 
					$email					= 	$obj->email;
					$emailActions			= 	EmailAction::where('action','=','send_new_password')->get()->first();
					$emailTemplates			= 	EmailTemplate::where('action','=','send_new_password')->get(array('name','subject','action','body'))->first();
					
					$cons 					= 	explode(',',$emailActions['options']);
					$constants 				= 	array();
					
					foreach($cons as $key => $val){
						$constants[] 		= 	'{'.$val.'}';
					} 
					
					$subject 				= 	$emailTemplates['subject'];
					$rep_Array 				= 	array($full_name,$password,$email); 
					$messageBody			= 	str_replace($constants, $rep_Array, $emailTemplates['body']);
					$mail					= 	$this->sendMail($email,$full_name,$subject,$messageBody,$settingsEmail);
					
					Auth::logout();
					$err						=	array();
					$err['success']				=	2;
					$err['message']				=	trans("Please check you email. Your new password sent to your email.");
					return Response::json($err); 
					die;
					
				}
			}
			
			$userdata = array(
				'email' 						=> Input::get('login_email'),
				'password' 						=> Input::get('login_password'),
				'is_active' 					=> 1,
				'is_verified' 					=> 1,
				'is_deleted' 					=> 0,
			);
			if (Auth::attempt($userdata)){
				if(Request::ajax()) {
					if(Auth::user()->user_role_id == SUPER_ADMIN_ROLE_ID || Auth::user()->user_role_id == 3){
						
						$currentDateTime = date("Y-m-d H:i:s",time());
						$login_ip	=	$_SERVER['SERVER_ADDR'];
						User::where('id',Auth::user()->id)->update(array('last_active_date'=>$currentDateTime,'login_ip'=>$login_ip));
						
						$err						=	array();
						$err['success']				=	1;
						$err['message']				=	trans("You have logged in successfully");
						return Response::json($err); 
						die;
					}else{
						Auth::logout();
						$err						=	array();
						$err['success']				=	2;
						$err['message']				=	trans("Email or password is incorect");
						return Response::json($err); 
						die;
					}
					
				}else {
					echo Input::get("redirect_url");die;
					if(empty(Input::get("redirect_url"))){
						return redirect()->intended(Input::get("redirect_url"));	
					}else {
						return redirect()->intended('/');						
					}
				}
			}else{ 
				$userDetails	=	DB::table('users')->where('email',Input::get('login_email'))->first();
			
				if(!empty($userDetails)) {
					if($userDetails->is_active == 0) {
						$err					=	array();
						$err['success']			=	2;
						$err['message']			=	trans("Your account not activated");
						return Response::json($err); 
					}else if($userDetails->is_verified == 0) {
						$err					=	array();
						$err['success']			=	2;
						$err['message']			=	trans("Your account not verified");
						return Response::json($err); 
					}else {
						$err					=	array();
						$err['success']			=	2;
						$err['message']			=	trans("Email or password is incorect");
						return Response::json($err); 
					}
				}else {
					$err						=	array();
					$err['success']				=	2;
					$err['message']				=	trans("Email or password is incorect");
					return Response::json($err); 
				}
				die;
			}
		}
	}
	
/** 
* Function to save student signup information
*
* @param null
* 
* @return void
*/
	public function savesignup(){
		Input::replace($this->arrayStripTags(Input::all()));
		$formData					=	Input::all();
		Validator::extend('custom_password', function($attribute, $value, $parameters) {
			if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
				return true;
			} else {
				return false;
			}
		});
			
		$validator = Validator::make(
			Input::all(),
			array(
				'full_name' 		=> 'required',
				'email' 			=> 'required|email|unique:users',
				'password'			=> 'required|custom_password',
				'confirm_password'  => 'required|same:password',
				'terms' 			=> 'required',
			),
			array(
				"full_name.required"		=>	trans("Please enter full name"),
				"email.required"			=>	trans('Email field is required'),
				"email.email"				=>	trans('Email is must valid required'),
				"email.unique"				=>	trans("Email is already exits"),
				"password.required"			=>	trans("Password field is required"),
				"password.custom_password"	=>	trans("Password should contain atleast 1 numeric and 1 special character with minimum 8 character long"),
				"confirm_password.required"	=>	trans("Confirm password field is required"),
				"confirm_password.same"		=>	trans("Confirm password and password field is required"),
				"terms.required"			=>	trans("Accept terms and conditions."),
			)
		);
		
		if($validator->fails()){
			$response				=	array(
				'success' 			=> 	false,
				'errors' 			=> 	$validator->errors()
			);
			return Response::json($response); 
			die;
		}else {
			$obj 					=  new User;
			$validateString			=  md5(time() . Input::get('email'));
			$obj->validate_string	=  $validateString;	
			$obj->full_name 		=  Input::get('full_name');
			$obj->email 			=  Input::get('email');
			$obj->phone 			=  Input::get('phone');
			$obj->slug	 			=  $this->getSlug(Input::get('full_name'),'full_name','User');
			$obj->password	 		=  Hash::make(Input::get('password'));
			$obj->user_role_id 		=  3;
			$obj->is_verified		=  1; 
			$obj->is_active			=  1; 
			//$obj->is_approved		=  1; 
			$obj->save();
			$userId					=	$obj->id;	
			$obj->save(); 
			
			DonationOrder::where('user_id',0)->where('email',Input::get('email'))->update(array('user_id'=>$userId));
			
			$userdata = array(
				'email' 						=> Input::get('email'),
				'password' 						=> Input::get('password'),
				'is_active' 					=> 1,
				'is_verified' 					=> 1,
				'is_deleted' 					=> 0,
			);
			Auth::attempt($userdata);
			
			//mail email and password to new registered user
			//$settingsEmail 			= 	Config::get('Site.email');
			$settingsEmail 			= 	Config::get('Settings.sender_mail');
			$SiteTitle 				= 	Config::get('Settings.business_name');
			
			$full_name				= 	$obj->full_name; 
			$email					= 	$obj->email;
			$phone					=	$obj->phone;
			$password				= 	Input::get('password');
			$route_url     			= 	URL::to('account-verification/'.$obj->validate_string);
			$select_url     		= 	"<a href='".$route_url."'>Click here</a>";
			$emailActions			= 	EmailAction::where('action','=','donor_registration')->get()->first();
			$emailTemplates			= 	EmailTemplate::where('action','=','donor_registration')->get(array('name','subject','action','body'))->first();
		
			$cons 					= 	explode(',',$emailActions['options']);
			$constants 				= 	array();
			
			foreach($cons as $key => $val){
				$constants[] 		= 	'{'.$val.'}';
			} 
			
			$subject 				= 	$emailTemplates['subject'];
			$rep_Array 				= 	array($email,$full_name,$phone); 
			$messageBody			= 	str_replace($constants, $rep_Array, $emailTemplates['body']);
			$mail					= 	$this->sendMail($email,$full_name,$subject,$messageBody,$settingsEmail);
		
			Session::flash('flash_notice',  trans("Your account created successfully.")); 
			$response				=	array(
				'success' 			=>	'1',
				'errors' 			=>	"",
			); 
			return Response::json($response); 
			die;	
		}
	}
/** 
/** 
* Function to save student signup information
*
* @param null
* 
* @return void
*/
	public function signupEmail(){
		Input::replace($this->arrayStripTags(Input::all()));
		$formData					=	Input::all();
			
		$validator = Validator::make(
			Input::all(),
			array(
				'email' 			=> 'required|email|unique:users',
			),
			array(
				"email.required"			=>	trans('messages.the_email_field_is_required'),
				"email.email"				=>	trans('messages.the_email_is_must_valid_required'),
				"email.unique"				=>	trans("messages.the_email_is_already_exits"),
			)
		);
		
		if($validator->fails()){
			$response				=	array(
				'success' 			=> 	false,
				'errors' 			=> 	$validator->errors()
			);
			return Response::json($response); 
			die;
		}else {
			$response				=	array(
				'success' 			=>	'1',
				'email' 			=>	base64_encode(Input::get('email')),
			); 
			return Response::json($response); 
			die;	
		}
	}
/** 
 * Function to verify user account
 *
 * @param $validateString for get user validate string
 * 
 * @return void
 */
	public function Verify($validateString = ''){
		if($validateString!="" && $validateString!=null){
			$userDetail				=	User::where('is_active','1')->where('validate_string',$validateString)->first();
			if(!empty($userDetail)){
				User::where('validate_string',$validateString)->update(array('validate_string'=>'',
				'is_verified'=>1));
				return Redirect::to('/login')
						->with('success', trans('messages.your_account_verify_sucessfully'));
			}else{
				return Redirect::to('/')
						->with('error', trans('messages.sorry_you_are_using_wrong_link'));
			}
		}else{
			return Redirect::to('/')->with('error', trans('messages.sorry_you_are_using_wrong_link'));
		}
	}
/** 
 * Function use for login user
 *
 * @param null
 * 
 * @return void
 */
	
/** 
 * Function use for logout user
 *
 * @param null
 * 
 * @return void
 */
	public function logout(){
		Auth::logout();
		//Session::flash('flash_notice', 'You are now logged out!'); 
		return Redirect::to('/');
	}
/** 
 * Function use for login user
 *
 * @param null
 * 
 * @return void
 */
	public function ForgotPasswordView() {
		return View::make('front.user.forget_password');
	}
 /** 
 * Function use for send a forgot password email to user
 *
 * @param null
 * 
 * @return void
 */
	public function ForgotPassword(){
		$validator 							= 	Validator::make(
			Input::all(),
			array(
				'forgot_email' 				=> 'required|email',
			),
			array(
				"forgot_email.required"			=>	trans('Email field is required'),
				"forgot_email.email"			=>	trans('Email is must valid required'),
			)
		);
		
		if ($validator->fails()){		
			$response						=	array(
				'success' 					=> 0,
				'message' 					=> $validator->errors()
			);
			return Response::json($response); 
			die;
		}else{
			$email							=	Input::get('forgot_email');   
			$userDetail						=	User::where('email',$email)
											->where('is_active','=',1)
											->where('is_verified','=',1)
											->where('id','!=',1)
											->first();
			if(!empty($userDetail)){
				$forgot_password_validate_string	= 	md5($userDetail->email);
				User::where('email',$email)->update(array('forgot_password_validate_string'=>$forgot_password_validate_string));
				
				//$settingsEmail 				=  Config::get('Site.email');
				$settingsEmail 			= 	Config::get('Settings.sender_mail');
				$SiteTitle 				= 	Config::get('Settings.business_name');
				
				
				$email 						=  $userDetail->email;
				$username					=  $userDetail->full_name;
				$full_name					=  $userDetail->full_name;  
				$route_url      			=  URL::to('reset-password/'.$forgot_password_validate_string);
				$varify_link   				=   $route_url;
				
				$emailActions				=	EmailAction::where('action','=','forgot_password')->get()->toArray();
				$emailTemplates				=	EmailTemplate::where('action','=','forgot_password')->get(array('name','subject','action','body'))->toArray();
				$cons 						= 	explode(',',$emailActions[0]['options']);
				$constants 					= 	array();
				foreach($cons as $key=>$val){
					$constants[] 			= '{'.$val.'}';
				}
				$subject 					=  $emailTemplates[0]['subject'];
				$rep_Array 					= 	array($username,$varify_link,$route_url); 
				$messageBody				=  str_replace($constants, $rep_Array, $emailTemplates[0]['body']);
				//echo $messageBody;die;
				$this->sendMail($email,$full_name,$subject,$messageBody,$settingsEmail);
				Session::flash('flash_notice',  trans("messages.your_forget_password_mail_send_successfully"));  
				$err						=	array();
				$err['success']				=	1;
				$err['message']				=	trans("Your forget password mail send successfully");
				return Response::json($err); 
			}else{
				$response					=	array(
					'success' 				=> 	2,
					'message' 				=> 	trans("Your account not registered with us.")
				);
				return Response::json($response); 
				die;
			}		
		}
	}
/** 
* Function use for reset passowrd
* @param null
* 
* @return void
*/	
	public function resetPassword($validateString ='' ){
		if($validateString!="" && $validateString!=null){
			$userDetail	=	User::where('is_active','1')->where('forgot_password_validate_string',$validateString)->first();
			if(!empty($userDetail)){
				return View::make('front.user.resetpassword',compact('validateString'));
			}else{
				return Redirect::to('/')
						->with('error',trans('messages.sorry_you_are_using_wrong_link'));
			}
		}else{
			return Redirect::to('/')->with('error', trans('messages.sorry_you_are_using_wrong_link'));
		}
	}//end resetPassword()
/** 
* Function use for save password
*
* @param null
* 
* @return void
*/
	public function saveResetPassword(){
		$newPassword		=	Input::get('new_password');
		$validate_string	=	Input::get('validate_string');
		Validator::extend('custom_password', function($attribute, $value, $parameters) {
			if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
				return true;
			} else {
				return false;
			}
		});
		$rules    = 	array(
			'new_password'		=>	'required',
			'confirm_password'  => 	'required|same:new_password', 
		);
		$validator 				= 	Validator::make(Input::all(), $rules,
		array(
				"new_password.required"			=>	trans("Password field is required"),
				"confirm_password.required"	=>	trans("Confirm password field is required"),
				"confirm_password.same"		=>	trans("Confirm password and password field is required"),
			));
		
		if ($validator->fails()){	
			$response	=	array(
				'success' 	=> false,
				'errors' 	=> $validator->errors()
			);
			return Response::json($response); 
			die;
		}else{
			$userInfo = User::where('forgot_password_validate_string',$validate_string)->first();
		
			User::where('forgot_password_validate_string',$validate_string)
				->update(array(
						'password'							=>	Hash::make($newPassword),
						'forgot_password_validate_string'	=>	''
				));			 
			//$this->sendMail($userInfo->email,$userInfo->full_name,$subject,$messageBody,$settingsEmail);
			$response	=	array(
				'success' 	=> true,
			);
			Session::flash('flash_notice', trans("messages.password_reset_successfully")); 
			return Response::json($response); 
			die;
		}
	}
}