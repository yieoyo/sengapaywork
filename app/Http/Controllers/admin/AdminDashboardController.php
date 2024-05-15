<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\BaseController;
use App\Model\AdminUser;
use App\Model\User;
use App\Model\ResellerRequest;
use App\Model\Ticket;
use App\Model\Booking;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator;
/**
* AdminDashBoard Controller
*
* Add your methods in the class below
*
* This file will render views\admin\dashboard
*/
	class AdminDashBoardController extends BaseController {
/**
* Function for display admin dashboard
*
* @param null
*
* @return view page. 
*/
	public function showdashboard(){
		$userCount 						=	DB::table('users')
											->where('user_role_id',SITE_USER_ROLE_ID)
											->where('is_deleted','!=',1)
											->count();
											
		$ArtistCount 					=	DB::table('users')
											->where('user_role_id',ARTIST_USER_ROLE_ID)
											->where('is_deleted','!=',1)
											->count();
											
											
		$adminUserCount 				=	DB::table('users')->where('user_role_id','=',SUPER_ADMIN_ROLE_ID)->where('is_deleted','!=',1)->where('id','!=',ADMIN_ID)->count();
		$jobsCount 						=	1;
		$cadidateCount 					=	1;
		
		//User Graph Data
		$month							=	date('m');
		$year							=	date('Y');
		for ($i = 0; $i < 12; $i++) {
			$months[] 					=	date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
		}
		$months							=	array_reverse($months);
		$num							=	0;
		$allUsers						=	array();
		//Active Users
		$thisMothUsers					=	0;
		foreach($months as $month){
			$month_start_date			=	date('Y-m-01 00:00:00', strtotime($month));
			$month_end_date				=	date('Y-m-t 23:59:59', strtotime($month));
			$allUsers[$num]['month']	=	$month;
			$allUsers[$num]['users']	=	DB::table('users')->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->where('is_deleted','!=',1)->where('user_role_id',SITE_USER_ROLE_ID)->count();
			if($month_start_date == date( 'Y-m-01 00:00:00', strtotime( 'first day of ' . date( 'F Y')))){
				$thisMothUsers	=	$allUsers[$num]['users'];
			}	
			$num ++;
		}
		
		
		$num							=	0;
		$allArtists						=	array();
		//Active Users
		$thisMothUsers					=	0;
		foreach($months as $month){
			$month_start_date			=	date('Y-m-01 00:00:00', strtotime($month));
			$month_end_date				=	date('Y-m-t 23:59:59', strtotime($month));
			$allArtists[$num]['month']	=	$month;
			$allArtists[$num]['users']	=	DB::table('users')->where('created_at','>=',$month_start_date)->where('user_role_id',ARTIST_USER_ROLE_ID)->where('created_at','<=',$month_end_date)->where('is_deleted','!=',1)->count();
			if($month_start_date == date( 'Y-m-01 00:00:00', strtotime( 'first day of ' . date( 'F Y')))){
				$thisMothUsers	=	$allArtists[$num]['users'];
			}	
			$num ++;
		}
		
		
		return  View::make('admin.dashboard.dashboard',compact('userCount','allUsers','adminUserCount',"allArtists","ArtistCount"));
	}
/**
* Function for display admin account detail
*
* @param null
*
* @return view page. 
*/
	public function myaccount(){
		return  View::make('admin.dashboard.myaccount');
	}// end myaccount()
/**
* Function for change_password
*
* @param null
*
* @return view page. 
*/	
	public function change_password(){
		return  View::make('admin.dashboard.change_password');
	}// end myaccount()
/**
* Function for update admin account update
*
* @param null
*
* @return redirect page. 
*/
	public function myaccountUpdate(){
		$thisData				=	Input::all(); 
		Input::replace($this->arrayStripTags($thisData));
		$old_password     		= 	Input::get('old_password');
        $password        		= 	Input::get('new_password');
        $confirm_password 		= 	Input::get('confirm_password');
		$ValidationRule = array(
            'first_name' 		=> 'required',
            'last_name' 		=> 'required',
            'email' 			=> 'required|email',
			'image' 			=> 'mimes:'.IMAGE_EXTENSION,
        );
        $validator 				= 	Validator::make(Input::all(), $ValidationRule);
		if ($validator->fails()){	
			return Redirect::to('admin/myaccount')
				->withErrors($validator)->withInput();
		}else{
			$user 				= 	User::find(Auth::user()->id);
			$user->first_name 	= 	Input::get('first_name'); 
			$user->last_name 	= 	Input::get('last_name'); 
			$user->email	 	= 	Input::get('email');
			/* if(input::hasFile('image')){
				$extension 				=	 Input::file('image')->getClientOriginalExtension();
				$fileName				=	time().'-user-image.'.$extension;
				$newFolder     			= 	strtoupper(date('M'). date('Y')).DS;
				$folderPath				=	USER_PROFILE_IMAGE_ROOT_PATH.$newFolder; 
				$userImage   			= 	$fileName;
				if(!File::exists($folderPath)){
					File::makeDirectory($folderPath, $mode = 0777,true);
				}
				if(Input::file('image')->move($folderPath, $fileName)){
					$user->image			=	$newFolder.$fileName;
				}
			} */
			if($user->save()) {
				return Redirect::intended('admin/myaccount')
					->with('success', 'Information updated successfully.');
			}
		}
	}// end myaccountUpdate()
/**
* Function for changedPassword
*
* @param null
*
* @return redirect page. 
*/	
	public function changedPassword(){
		$thisData				=	Input::all(); 
		Input::replace($this->arrayStripTags($thisData));
		$old_password    		= 	Input::get('old_password');
        $password         		= 	Input::get('new_password');
        $confirm_password 		= 	Input::get('confirm_password');
		Validator::extend('custom_password', function($attribute, $value, $parameters) {
			if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
				return true;
			} else {
				return false;
			}
		});
		$rules        		  	= 	array(
			'old_password' 		=>	'required',
			'new_password'		=>	'required',
			'confirm_password'  =>	'required|same:new_password'
		);
		$validator 				= 	Validator::make(Input::all(), $rules,
		array(
			"new_password.custom_password"	=>	"Password must have combination of numeric, alphabet and special characters.",
		));
		if ($validator->fails()){	
			return Redirect::to('admin/change-password')
				->withErrors($validator)->withInput();
		}else{
			$user 				= User::find(Auth::user()->id);
			$old_password 		= Input::get('old_password'); 
			$password 			= Input::get('new_password');
			$confirm_password 	= Input::get('confirm_password');
			if($old_password !=''){
				if(!Hash::check($old_password, $user->getAuthPassword())){
					/* return Redirect::intended('change-password')
						->with('error', 'Your old password is incorrect.');
						 */
					Session::flash('error',trans("Your old password is incorrect."));
					return Redirect::to('admin/change-password');
				}
			}
			if(!empty($old_password) && !empty($password ) && !empty($confirm_password )){
				if(Hash::check($old_password, $user->getAuthPassword())){
					$user->password = Hash::make($password);
				// save the new password
					if($user->save()) {
						Session::flash('success',trans("Password changed successfully."));
						return Redirect::to('admin/change-password');
					}
				} else {
					/* return Redirect::intended('change-password')
						->with('error', 'Your old password is incorrect.'); */
					Session::flash('error',trans("Your old password is incorrect."));
					return Redirect::to('admin/change-password');
				}
			}else{
				$user->username = $username;
				if($user->save()) {
					Session::flash('success',trans("Password changed successfully."));
					return Redirect::to('admin/change-password');
					/* return Redirect::intended('change-password')
						->with('success', 'Password changed successfully.'); */
				}
			}
		}
	}// end myaccountUpdate()
/* 
* For User Listing Demo 
*/
	public function usersListing(){
		return View::make('admin.user.user');
	}
} //end AdminDashBoardController()