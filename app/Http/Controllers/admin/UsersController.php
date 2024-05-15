<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\BaseController;
use App\Model\AdminUser;
use App\Model\User;
use App\Model\UserLevel;
use App\Model\EmailTemplate;
use App\Model\EmailAction;
use App\Model\Track;
use App\Model\TrackRecord;
use App\Model\UserMessage;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator;

/**
* Users Controller
*
* Add your methods in the class below
*
* This file will render views from views/admin/usermgmt
*/
 
class UsersController extends BaseController {

	public $model	=	'User';
	
	public function __construct() {
		View::share('modelName',$this->model);
	}

/**
* Function for display list of all users
*
* @param null
*
* @return view page. 
*/
	public function listUsers(){
		$DB 					= 	AdminUser::query();
		$searchVariable			=	array(); 
		$inputGet				=	Input::get();
		/* seacrching on the basis of username and email */ 
		if ((Input::get() && isset($inputGet['display'])) || isset($inputGet['page']) ) {
			$searchData			=	Input::get();
			unset($searchData['display']);
			unset($searchData['_token']);

			if(isset($searchData['order'])){
				unset($searchData['order']);
			}
			if(isset($searchData['sortBy'])){
				unset($searchData['sortBy']);
			}
			
			if(isset($searchData['page'])){
				unset($searchData['page']);
			}
			foreach($searchData as $fieldName => $fieldValue){
				if(!empty($fieldValue) && ($fieldName=="full_name" || $fieldName=="email" || $fieldName=="phone_number")){
					$DB->where("users.$fieldName",'like','%'.$fieldValue.'%');
				}elseif((!empty($fieldValue) || $fieldValue==0) && ($fieldName=="is_active")){
					$DB->where("users.$fieldName",'like','%'.$fieldValue.'%');
				}
				$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
			}
		}
		$DB->select('users.*');
		$sortBy 				= 	(Input::get('sortBy')) ? Input::get('sortBy') : 'created_at';
	    $order  				= 	(Input::get('order')) ? Input::get('order')   : 'DESC';
		$result 				= 	$DB->leftjoin('countries','countries.id','=','users.country')
									->select('users.*','countries.name as country_name')
									->where('users.id','<>',ADMIN_ID)
									->where('users.is_deleted',0)
									->where('users.user_role_id',SITE_USER_ROLE_ID)
									->orderBy($sortBy, $order)
									->paginate(Config::get("Reading.records_per_page"));
		$complete_string		=	Input::query();
		unset($complete_string["sortBy"]);
		unset($complete_string["order"]);
		$query_string			=	http_build_query($complete_string);
		$result->appends(Input::all())->render();
		return  View::make('admin.usermgmt.index', compact('result' ,'searchVariable','sortBy','order','userType','query_string'));
	}// end listUsers()
	
/**
* Function for add users
*
* @param null
*
* @return view page. 
*/	
	public function addUser(){
		$country_list	=	DB::table('countries')->orderBy('name','ASC')->lists('name','id');
		return  View::make('admin.usermgmt.add',compact('country_list'));
	}//end addCompany()
	
/**
* Function for save added users
*
* @param null
*
* @return view page. 
*/	
	public function saveUser(){
		Input::replace($this->arrayStripTags(Input::all()));
		$formData						=	Input::all();
		//pr($formData);die;
		if(!empty($formData)){
			Validator::extend('custom_password', function($attribute, $value, $parameters){
				if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
					return true;
				} else {
					return false;
				}
			});
			
			$validator = Validator::make(
				Input::all(),
				array(
					'first_name'		=> 'required',
					'last_name' 		=> 'required',
					'gender' 			=> 'required',
					'phone' 			=> 'required',
					'address' 			=> 'required',
					'country' 			=> 'required',
					'state' 			=> 'required',
					'city' 				=> 'required',
					'zip_code' 			=> 'required',
					'email' 			=> 'required|email|unique:users',
					'password'			=> 'required|custom_password',
					'confirm_password'  => 'required|same:password', 
					//'terms'  			=> 'required', 
					'date_of_birth'		=> 'required', 
				),
				array(
					"phone.required"			=>	trans("messages.the_phone_field_is_requird"),
					"address.required"			=>	trans("messages.the_address_field_is_requird"),
					"country.required"			=>	trans("messages.please_select_country"),
					"state.required"			=>	trans("messages.the_state_field_is_requird"),
					"city.required"				=>	trans("messages.the_city_field_is_requird"),
					"zip_code.required"			=>	trans("messages.the_zip_code_field_is_requird"),
					"first_name.required"		=>	trans("messages.the_first_name_field_is_required"),
					"last_name.required"		=>	trans("messages.the_last_name_field_is_required"),
					"email.required"			=>	trans('messages.the_email_field_is_required'),
					"email.email"				=>	trans('messages.the_email_is_must_valid_required'),
					"email.unique"				=>	trans("messages.the_email_is_already_exits"),
					"password.required"			=>	trans("messages.the_password_field_is_required"),
					"password.custom_password"	=>	trans("messages.myaccount.password_should_contain_atleast_1_numeric_and_1_special_character_with_minimum_8_character_long"),
					"confirm_password.required"	=>	trans("messages.the_confirm_password_field_is_required"),
					"confirm_password.same"		=>	trans("messages.the_confirm_password_and_password_field_is_required"),
					//"terms.required"			=>	trans("messages.please_accept_terms_and_condition"),
					"date_of_birth.required"	=>	trans("messages.please_select_date_of_birth"),
					"gender.required"			=>	trans("Select your gender"),
				)
			);
			$password 					= 	Input::get('password');
			/* if (preg_match('#[0-9]#', $password) && preg_match('#[a-zA-Z]#', $password) && preg_match('#[\W]#', $password)) {
				$correctPassword		=	Hash::make($password);
			}else{
				$errors 				=	$validator->messages();
				$errors->add('password', trans("messages.user_management.password_help_message"));
				return Redirect::back()->withErrors($errors)->withInput();
			} */
			if ($validator->fails()){
				return Redirect::back()->withErrors($validator)->withInput();
			}else{
				$obj 					=  new User;
				$validateString			=  md5(time() . Input::get('email'));
				$obj->validate_string	=  $validateString;					
				$obj->first_name 		=  Input::get('first_name');
				$obj->last_name 		=  Input::get('last_name');
				$obj->full_name 		=  Input::get('first_name')." ".Input::get('last_name');
				$obj->email 			=  Input::get('email');
				$obj->gender 			=  Input::get('gender');
				$obj->slug	 			=  $this->getSlug(Input::get('first_name')." ".Input::get('last_name'),'full_name','User');
				$obj->password	 		=  Hash::make(Input::get('password'));
				$obj->date_of_birth 	=  Input::get('date_of_birth');
				$obj->phone				=  Input::get('phone');
				$obj->address 			=  Input::get('address');
				$obj->city 				=  Input::get('city');
				$obj->state 			=  Input::get('state');
				$obj->country 			=  Input::get('country');
				$obj->zip_code 			=  Input::get('zip_code');
				$obj->user_role_id 		=  SITE_USER_ROLE_ID;
				$obj->is_verified		=  0; 
				$obj->is_active			=  1; 
				//$obj->is_approved		=  1; 
				$obj->save();
				$userId					=	$obj->id;	
				$obj->save(); 
				
				//mail email and password to new registered user
				$settingsEmail 			= 	Config::get('Site.email');
				$full_name				= 	$obj->full_name; 
				$email					= 	$obj->email;
				$password				= 	Input::get('password');
				$route_url     			= 	URL::to('account-verification/'.$obj->validate_string);
				$select_url     		= 	"<a href='".$route_url."'>Click here</a>";
				$emailActions			= 	EmailAction::where('action','=','account_verification')->get()->first();
				$emailTemplates			= 	EmailTemplate::where('action','=','account_verification')->get(array('name','subject','action','body'))->first();
			
				$cons 					= 	explode(',',$emailActions['options']);
				$constants 				= 	array();
				
				foreach($cons as $key => $val){
					$constants[] 		= 	'{'.$val.'}';
				} 
				
				$subject 				= 	$emailTemplates['subject'];
				$rep_Array 				= 	array($full_name,$select_url,$route_url); 
				$messageBody			= 	str_replace($constants, $rep_Array, $emailTemplates['body']);
				$mail					= 	$this->sendMail($email,$full_name,$subject,$messageBody,$settingsEmail);
			
				Session::flash('flash_notice',  trans("messages.please_verify_your_account"));
				Session::flash('success',trans("User added successfully"));
				return Redirect::to('admin/users');
			}
		}
	}// saveUser()
	
/**
* Function for display user detail
*
* @param $userId 	as id of user
*
* @return view page. 
*/
	public function viewUser($userId = 0){
		$userDetails	=	AdminUser::leftjoin('countries','countries.id','=','users.country')
									->select('users.*','countries.name as country_name')->find($userId); 
		if(empty($userDetails)) {
			return Redirect::to('admin/users');
		}
		return View::make('admin.usermgmt.view',compact("userDetails"));
	} 
	
	public function submitRateUser($user_id = 0){
		Input::replace($this->arrayStripTags(Input::all()));
		$formData					=	Input::all();
		if(!empty($formData)){
			$validator 				=	Validator::make(
				Input::all(),
				array(
					'level_id'		=> 'required',
				),
				array(
					'level_id:required'		=> 'This field is required.',
				)
			);
			if ($validator->fails()){
				 return Redirect::back()->withErrors($validator)->withInput();
			}else{ 
				AdminUser::where('id', '=', $user_id)->update(array('user_level' => Input::get("level_id") ));
				Session::flash('success',trans("Level has been assigned successfully"));
				return Redirect::to('admin/users');
			}
		}
	}
	
	public function rates_user($user_id = 0){
		$userDetails	=	AdminUser::find($user_id); 
		if(empty($userDetails)) {
			return Redirect::to('admin/users');
		}
		$user_teaching_levels		=	DB::table('dropdown_managers')->where('is_active',1)->where('dropdown_type',"teaching-level")->lists("name","id");
		
		$user_rate_links		=	DB::table('user_rate_links')->where('user_id',$user_id)->first();
		return View::make('admin.usermgmt.rates_user',compact("userDetails","user_teaching_levels","user_id","user_rate_links"));
	}
	
/**
* Function for display page for edit user
*
* @param $userId as id of user
*
* @return view page. 
*/
	public function editUser($userId = 0){
		$userDetails			=	AdminUser::find($userId); 
		if(empty($userDetails)) {
			return Redirect::to('admin/users');
		}
		if($userId){
			$userDetails		=	AdminUser::find($userId);
			$country_list		=	DB::table('countries')->orderBy('name','ASC')->lists('name','id');
			
			return View::make('admin.usermgmt.edit', compact('userDetails','country_list'));
		}
	} // end editUser()
	
/**
* Function for update user detail
*
* @param $userId as id of user
*
* @return redirect page. 
*/
	public function updateUser($userId = 0){	
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all(); 
		Validator::extend('custom_password', function($attribute, $value, $parameters){
			if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
				return true;
			} else {
				return false;
			}
		});
		
		$validator = Validator::make(
			Input::all(),
			array(
				'first_name'		=> 'required',
				'last_name' 		=> 'required',
				'phone' 			=> 'required',
				'gender' 			=> 'required',
				'address' 			=> 'required',
				'country' 			=> 'required',
				'state' 			=> 'required',
				'city' 				=> 'required',
				'zip_code' 			=> 'required',
				'email' 			=> "required|email|unique:users,email,$userId",
				//'password'			=> 'required|custom_password',
				//'confirm_password'  => 'required|same:password', 
				//'terms'  			=> 'required', 
				'date_of_birth'		=> 'required', 
			),
			array(
				"phone.required"			=>	trans("messages.the_phone_field_is_requird"),
				"address.required"			=>	trans("messages.the_address_field_is_requird"),
				"country.required"			=>	trans("messages.please_select_country"),
				"state.required"			=>	trans("messages.the_state_field_is_requird"),
				"city.required"				=>	trans("messages.the_city_field_is_requird"),
				"zip_code.required"			=>	trans("messages.the_zip_code_field_is_requird"),
				"first_name.required"		=>	trans("messages.the_first_name_field_is_required"),
				"last_name.required"		=>	trans("messages.the_last_name_field_is_required"),
				"email.required"			=>	trans('messages.the_email_field_is_required'),
				"email.email"				=>	trans('messages.the_email_is_must_valid_required'),
				"email.unique"				=>	trans("messages.the_email_is_already_exits"),
				"password.required"			=>	trans("messages.the_password_field_is_required"),
				"password.custom_password"	=>	trans("messages.myaccount.password_should_contain_atleast_1_numeric_and_1_special_character_with_minimum_8_character_long"),
				"confirm_password.required"	=>	trans("messages.the_confirm_password_field_is_required"),
				"confirm_password.same"		=>	trans("messages.the_confirm_password_and_password_field_is_required"),
				//"terms.required"			=>	trans("messages.please_accept_terms_and_condition"),
				"date_of_birth.required"	=>	trans("messages.please_select_date_of_birth"),
				"gender.required"			=>	trans("Select your gender"),
			)
		);
			$password 					=  Input::get('password');
			if($password !=''){
				if (preg_match('#[0-9]#', $password) && preg_match('#[a-zA-Z]#', $password) && preg_match('#[\W]#', $password)) {
					$correctPassword	=	Hash::make($password);
				}else{
					$errors 			=	$validator->messages();
					$errors->add('password', trans("messages.user_management.password_help_message"));
					return Redirect::back()->withErrors($errors)->withInput();
				}
			}
		if ($validator->fails()){	
			return Redirect::to('/admin/users/edit-user/'.$userId)
				->withErrors($validator)->withInput();
		}else{
			DB::beginTransaction();
			$obj 					=  User::find($userId);
			$obj->first_name 		=  Input::get('first_name');
			$obj->last_name 		=  Input::get('last_name');
			$obj->full_name 		=  Input::get('first_name')." ".Input::get('last_name');
			$obj->email 			=  Input::get('email');
			$get_password			=	Input::get('password');
			$get_confirm_password	=	Input::get('confirm_password');
			if(!empty($get_password) && !empty($get_confirm_password) && $get_password == $get_confirm_password){
				$obj->password	 		=  Hash::make(Input::get('password'));
			} 
			$obj->date_of_birth 	=  Input::get('date_of_birth');
			$obj->gender 			=  Input::get('gender');
			$obj->phone				=  Input::get('phone');
			$obj->address 			=  Input::get('address');
			$obj->city 				=  Input::get('city');
			$obj->state 			=  Input::get('state');
			$obj->country 			=  Input::get('country');
			$obj->zip_code 			=  Input::get('zip_code');
			//$obj->is_approved		=  1; 
			$obj->save();
			$userId					=	$obj->id;		
			if(!$userId) {
				DB::rollback();
				Session::flash('error', trans("Something went wrong.")); 
				return Redirect::back()->withInput();
			}
			DB::commit();
			return Redirect::to('/admin/users')->with('success',trans("User updated successfully"));
		}
	}// end updateUser()
	
/**
* Function for mark a user as deleted 
*
* @param $userId as id of user
*
* @return redirect page. 
*/
	public function deleteUser($userId = 0){
		$userDetails	=	AdminUser::find($userId); 
		if(empty($userDetails)) {
			return Redirect::to('admin/users');
		}
		if($userId){	
			$email = 'delete_'.$userDetails->id.'_'.$userDetails->email;
			$userModel					=	AdminUser::where('id',$userId)->update(array('email'=>$email,'is_deleted'=>1));
			Session::flash('flash_notice',trans("User removed successfully")); 
		}
		return Redirect::to('admin/users/');
	} // end deleteUser()
	
	
	public function listTrack($userId = 0){
	
		$DB					=	Track::query();
		$searchVariable		=	array(); 
		$inputGet			=	Input::get();
		
		if ((Input::get() && isset($inputGet['display'])) || isset($inputGet['page']) ) {
			$searchData	=	Input::get();
			unset($searchData['display']);
			unset($searchData['_token']);
			
			if(isset($searchData['page'])){
				unset($searchData['page']);
			}
			
			foreach($searchData as $fieldName => $fieldValue){
				if(!empty($fieldValue)){
					$DB->where("$fieldName",'like','%'.$fieldValue.'%');
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		$sortBy = (Input::get('sortBy')) ? Input::get('sortBy') : 'updated_at';
	    $order  = (Input::get('order')) ? Input::get('order')   : 'DESC';
		//$model = $DB->leftjoin('fonts','fonts.id','=','font_requests.font_id')->select('fonts.font_name as font_name','font_requests.*')->orderBy($sortBy, $order)->paginate(Config::get("Reading.records_per_page"));
		
		$result = $DB->select('tracks.*',DB::raw("(select full_name from users where id=tracks.user_id) as user_name"))->where('user_id',$userId)->orderBy($sortBy, $order)->paginate(Config::get("Reading.records_per_page"));
		
		// echo "<pre>";
		// print_r($result);
		// echo "</pre>";
		// die;
		
		$complete_string		=	Input::query();
		unset($complete_string["sortBy"]);
		unset($complete_string["order"]);
		$query_string			=	http_build_query($complete_string);
		$result->appends(Input::all())->render();
		
		return  View::make("admin.usermgmt.track_records",compact('result','searchVariable','sortBy','order','query_string'));
		
	}// end listBlock()
	
	
	public function viewTrack($modelId = 0){
		$trackData	=	Track::find($modelId);  
		if(empty($trackData)){ 
			return Redirect::Back(); 
		}
		
		if($modelId){	  
			//$trackDetails		=	Track::leftjoin('track_details','track_details.user_id','=','tracks.user_id')->select('tracks.*',DB::raw("(select GROUP_CONCAT(group_name SEPARATOR ', ') from groups WHERE FIND_IN_SET(id,broadcasts.group_ids)) as group_name"),'locations.name as location_name','locations.code as location_code',DB::raw("(select name from categories WHERE id=category_id) as category_name"))->where('broadcasts.id',$broadcast_id)->first(); 
			if(!empty($trackData)){
				
				$trackDetails		=	DB::table('track_records')->select('track_records.*',DB::raw("(select name from dropdown_managers where id=track_records.title) as name"))->where('track_id',$trackData->track_id)->where('is_active',1)->where('is_deleted',0)->orderBy('track_records.id','ASC')->get();
				$trackData->TrackDetail = $trackDetails;
			}
			//print_r("<pre>");
			//print_r($trackData);die;
			return  View::make("admin.usermgmt.track_records_view",compact('trackData')); 
		}
		
	}
	
/**
* Function for update user status
*
* @param $userId as id of user
* @param $userStatus as status of user
*
* @return redirect page. 
*/
	public function updateUserStatus($userId = 0, $userStatus = 0){
		if($userStatus == 0	){
			$statusMessage	=	trans("User deactivated successfully");
		}else{
			$statusMessage	=	trans("User activated successfully");
		}
		$this->_update_all_status('users',$userId,$userStatus);
		
		Session::flash('flash_notice', $statusMessage); 
		return Redirect::to('admin/users');
	} // end updateUserStatus()

	public function sendMessage($userId=null){
		$userDetails			=	AdminUser::find($userId); 
		if(empty($userDetails)) {
			return Redirect::to('admin/users');
		}
		if($userId){
			$userMessages	=	UserMessage::where('receiver_id',$userId)->where('is_deleted',0)->orderBy('created_at','DESC')->get();
			return View::make('admin.usermgmt.message', compact('userDetails','userMessages','userId'));
		}
	}
	
	 
	public function saveMessage($userId=null){
		Input::replace($this->arrayStripTags(Input::all()));
		$formData						=	Input::all();
		 
		if(!empty($formData)){ 
			
			$validator = Validator::make(
				Input::all(),
				array(
					'subject'		=> 'required',
					'message'		=> 'required', 
				)
			); 
			if ($validator->fails()){
				 return Redirect::back()->withErrors($validator)->withInput();
			}else{
				$obj 					=  new UserMessage;  					
				$obj->user_id 			=  Auth::user()->id;
				$obj->receiver_id 		=  $userId;  
				$obj->subject 			=  Input::get('subject');  
				$obj->message 			=  Input::get('message');  
				$obj->save();  
				Session::flash('success',trans("Message send successfully"));
				return Redirect::to('admin/users/message/'.$userId);
			}
		}
	}// saveMessage() 
/**
* Function for verify user
*
* @param $userId as id of user
*
* @return redirect page. 
*/
	public function verifiedUser($userId = 0){
		DB::beginTransaction();
		$user_details		=		AdminUser::where('id', '=', $userId)->update(array('is_verified' => 1));
		if(!$user_details) {
			DB::rollback();
			Session::flash('error', trans("Something went wrong.")); 
			return Redirect::back()->withInput();
		}
		DB::commit();
		Session::flash('flash_notice', 'User status updated successfully.'); 
		return Redirect::to('admin/users');
	} // end verifiedUser()
	
/**
* Function for delete,active,deactive user
*
* @param $userId as id of users
*
* @return redirect page. 
*/
 	public function performMultipleAction($userId = 0){
		if(Request::ajax()){
			$actionType = ((Input::get('type'))) ? Input::get('type') : '';
			if(!empty($actionType) && !empty(Input::get('ids'))){
				if($actionType	==	'active'){
					AdminUser::whereIn('id', Input::get('ids'))->update(array('is_active' => 1));
				}
				elseif($actionType	==	'inactive'){
					AdminUser::whereIn('id', Input::get('ids'))->update(array('is_active' => 0));
				}
				elseif($actionType	==	'verified'){
					AdminUser::whereIn('id', Input::get('ids'))->update(array('is_verified' => 1));
				}
				elseif($actionType	==	'notverified'){
					AdminUser::whereIn('id', Input::get('ids'))->update(array('is_verified' => 0));
				}
				elseif($actionType	==	'delete'){
					AdminUser::whereIn('id', Input::get('ids'))->update(array('is_deleted' => 1));
				}
				Session::flash('flash_notice', trans("messages.user_management.action_performed_message")); 
			}
		}
	}//end performMultipleAction()
	
/**
* Function for send credential to user
*
* @param $id as id of users
*
* @return redirect page. 
*/
	public function sendCredential($id){
		$obj			=	AdminUser::find($id);
		$settingsEmail 	= 	Config::get('Site.email');
		$full_name		= 	$obj->full_name; 
		$email			= 	$obj->email;
		$password		=	substr(uniqid(rand(10,1000),false),rand(0,10),8);
		$obj->password	=	Hash::make($password);
		$obj->save();
		$route_url      =	URL::to('login');
		$click_link   	=   $route_url;
		$emailActions	= 	EmailAction::where('action','=','send_login_credentials')->get()->toArray();
		$emailTemplates	= 	EmailTemplate::where('action','=','send_login_credentials')->get(array('name','subject','action','body'))->toArray();
		$cons 			= 	explode(',',$emailActions[0]['options']);
		$constants 		= 	array();
		foreach($cons as $key => $val){
			$constants[] = '{'.$val.'}';
		} 
		$subject 		= 	$emailTemplates[0]['subject'];
		$rep_Array 		= 	array($full_name,$email,$password,$click_link,$route_url); 
		$messageBody	= 	str_replace($constants, $rep_Array, $emailTemplates[0]['body']);
		$mail			= 	$this->sendMail($email,$full_name,$subject,$messageBody,$settingsEmail);
		Session::flash('flash_notice', trans("Login credientials send successfully"));
		return Redirect::back();
	}	
}//end UsersController