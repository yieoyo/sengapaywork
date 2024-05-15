<?php
/**
 * User Controller
 */
namespace App\Http\Controllers\front;
use App\Http\Controllers\BaseController;
use App\Model\EmailAction;
use App\Model\EmailTemplate;
use App\Model\Globaluser;
use App\Model\User; 
use App\Model\SubProjectDefaultPlan;
use App\Model\SeatReservationSubtitle;
use App\Model\SubProjectSeatReservationPlan;
use App\Model\SubProjectQuantityPlan;
use App\Model\SubProjectSectionPlan;
use App\Model\SubProjectDanaDefaultPlan;
use App\Model\SubProjectDanaPropertyType;
use App\Model\SubProjectDanaPriceRange;
use App\Model\DonationOrder; 
use App\Model\DonationPayment; 
use App\Model\Project; 
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator,App,mPDF;
 

class GlobalusersController extends BaseController {


	public function getCmsPageDetails($pageSlug = "ansar"){
		$user_id = !empty(Auth::user())? Auth::user()->id:'';
		$lang = App::getLocale();
		if(empty($lang)){
			$lang = "en";
		}
		
		if(empty($pageSlug)){
			Session::flash('flash_notice',  trans("Pagination Error!"));
			return redirect()->back();
		}
		
		$cmsPageDetails = DB::table('cms_pages')->where('slug',$pageSlug)->where('is_deleted',0)->where('is_active',1)->first();
		if(empty($cmsPageDetails)){
			Session::flash('flash_notice',  trans("Page details not found!"));
			return redirect()->back();
		}
		
		if($lang != "en"){
			if(!empty($cmsPageDetails->title_ms)){
				$cmsPageDetails->title	=	$cmsPageDetails->title_ms;
			}
			if(!empty($cmsPageDetails->sub_title_ms)){
				$cmsPageDetails->sub_title	=	$cmsPageDetails->sub_title_ms;
			}
			if(!empty($cmsPageDetails->body_ms)){
				$cmsPageDetails->body	=	$cmsPageDetails->body_ms;
			}
			if(!empty($cmsPageDetails->footer_body_ms)){
				$cmsPageDetails->footer_body	=	$cmsPageDetails->footer_body_ms;
			}
			
		}
		
		$sliderImages = DB::table('cms_images')->where('cms_id',$cmsPageDetails->id)->orderBy('id','DESC')->get();
		
		$orderedProjectIdArray	=	Project::where('project_module',$cmsPageDetails->project)->orderBy('order','ASC')->lists('id','id')->toArray();
		$orderedProjectIds		=	!empty($orderedProjectIdArray) ? implode(",",$orderedProjectIdArray) :"";
		
		
		if($cmsPageDetails->project != "0"){
			$allProjectLists = DB::table('sub_projects')
								->select('sub_projects.*',
									DB::raw("(select image from template_slider_images where template_slider_images.sub_project_id=sub_projects.id AND is_featured=1 limit 1) as project_image"),
									DB::raw("(select name from projects where projects.id=sub_projects.project_id limit 1) as project_name")
								)	
								->where('is_deleted',0)->where('is_active',1)->where('project_module',$cmsPageDetails->project)
								->orderByRaw("FIELD(project_id, $orderedProjectIds)")->orderBy('project_id','ASC')->get();
		}else{
			$allProjectLists = "";
		}
		
		
		
		 
		
		if(!empty($allProjectLists)){
		  foreach($allProjectLists as &$allProjectList){
			$allOrderIds	=	DonationOrder::where('sub_project_id',$allProjectList->id)->where('is_deleted',0)->lists('id','id');
			$totalApprovedContribution	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
			
			$allProjectList->totalRaised	=	!empty($totalApprovedContribution)?$totalApprovedContribution:0;
			
			if(!empty($allProjectList->target_amount) && ($allProjectList->target_amount > 0)){
				$allProjectList->progressAvg	=	round((($allProjectList->totalRaised / $allProjectList->target_amount) * 100),2);
			}else{
				$allProjectList->progressAvg	=	0;
			}
			
		  }
		}
		//pr($allProjectLists); die;
		
		return View::make('front.globaluser.cms_page_details',compact("cmsPageDetails","allProjectLists","sliderImages")); 
	}


	public function subProjectDetail($subProjectSlug = ""){
		Session::forget('SelectDonationPlanData');
		$lang = App::getLocale();
		if(empty($lang)){
			$lang = "en";
		}
		
		$user_id = !empty(Auth::user())? Auth::user()->id:'';
		if(empty($subProjectSlug)){
			Session::flash('flash_notice',  trans("Pagination Error!"));
			return redirect()->back();
		}
		
		$subProjectDetails = DB::table('sub_projects')
								->select('sub_projects.*',
									DB::raw("(select name from project_modules where id=sub_projects.project_module) as project_module_name"),
									DB::raw("(select name from projects where id=sub_projects.project_id) as project_name")
								)
								->where('slug',$subProjectSlug)->where('is_deleted',0)->where('is_active',1)->first();
		if(empty($subProjectDetails)){
			Session::flash('flash_notice',  trans("Project details not found!"));
			return redirect()->back();
		}
		
		if($lang == "ms"){
			if(!empty($subProjectDetails->daily_description_ms)){
				$subProjectDetails->daily_description	=	$subProjectDetails->daily_description_ms;
			}
			if(!empty($subProjectDetails->monthly_description_ms)){
				$subProjectDetails->monthly_description	=	$subProjectDetails->monthly_description_ms;
			}
			if(!empty($subProjectDetails->yearly_description_ms)){
				$subProjectDetails->yearly_description	=	$subProjectDetails->yearly_description_ms;
			}
			if(!empty($subProjectDetails->editor_ms)){
				$subProjectDetails->editor	=	$subProjectDetails->editor_ms;
			}
			if(!empty($subProjectDetails->title_ms)){
				$subProjectDetails->title	=	$subProjectDetails->title_ms;
			}
			if(!empty($subProjectDetails->sub_title_ms)){
				$subProjectDetails->sub_title	=	$subProjectDetails->sub_title_ms;
			}
			if(!empty($subProjectDetails->project_description_ms)){
				$subProjectDetails->project_description	=	$subProjectDetails->project_description_ms;
			}
		}
		
		$sliderImages = DB::table('template_slider_images')->select('id','image')->where('sub_project_id',$subProjectDetails->id)->orderBy('is_featured','DESC')->get();
		
		
		if($subProjectDetails->daily_status == 1){
			$Plantype	=	"daily";
		}else{
			$Plantype	=	"";
		}
		
		$dailyPlanDetails = DB::table('sub_project_plans')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('type',$Plantype)->orderBy('created_at','ASC')->get();
		$dailyPeriodDetails = DB::table('sub_project_periods')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('type',$Plantype)->orderBy('created_at','ASC')->get();
		
		
		//SPECIAL PROJECTS//
		$projectPlans	=	SubProjectDefaultPlan::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		$seatReservationPlans	=	SeatReservationSubtitle::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		if(!empty($seatReservationPlans)){
			foreach($seatReservationPlans as &$seatReservationPlan){
				$seatReservationDetails	=	DB::table('sub_project_seat_reservation_plans')->where('sub_project_id',$subProjectDetails->id)->where('sub_title_id',$seatReservationPlan->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
				
				$seatReservationPlan->ReservationSeats	=	$seatReservationDetails;
			}
		}
		
		$quantityPlans	=	SubProjectQuantityPlan::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		$sectionPlans	=	SubProjectSectionPlan::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		//pr($subProjectDetails); die;
		
		//DANA LASTARI
		$danaDefaultPlans	=	SubProjectDanaDefaultPlan::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		$danaProperyPlans	=	SubProjectDanaPropertyType::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		$danaProperyPriceRanges	=	SubProjectDanaPriceRange::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		if(!empty($subProjectDetails->vendor) && !is_array($subProjectDetails->vendor)){
			$vendorIds	=	explode(",",$subProjectDetails->vendor);
			$vendorLists =	User::select('id','full_name','short_description','slug')->whereIn('id',$vendorIds)->where('user_role_id',2)->where('is_deleted',0)->where('is_active',1)->orderBy('full_name','ASC')->get();
		}else{
			$vendorLists =	User::select('id','full_name','short_description','slug')->where('id',$subProjectDetails->vendor)->where('user_role_id',2)->where('is_deleted',0)->where('is_active',1)->orderBy('full_name','ASC')->get();
		}
		
		
		//total amount received
		$allOrderIds	=	DonationOrder::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->lists('id','id');
		$totalApprovedContribution	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
		
		
		return View::make('front.globaluser.sub_project_detail',compact("subProjectDetails","dailyPlanDetails","dailyPeriodDetails","sliderImages","totalApprovedContribution","projectPlans","seatReservationPlans","quantityPlans","sectionPlans","danaDefaultPlans","danaProperyPlans","danaProperyPriceRanges","vendorLists")); 
	}

	public function selectDonationPlan(){
		Session::forget('SelectDonationPlanData');
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	!empty(Auth::user()) ? Auth::user()->id :0;
		$sectionParticipates			=	!empty($thisData['Section'])?$thisData['Section']:'';
		$SeatReservations				=	!empty($thisData['SeatReservation'])?$thisData['SeatReservation']:'';
		
		if(!empty(Input::get('sub_project_id'))){
			$subProjectDetails = DB::table('sub_projects')->where('id',Input::get('sub_project_id'))->first();
			$projectModule			=	$subProjectDetails->project_module;
			$customizePlanOption	=	($subProjectDetails->customize_plan_option == 0) ? 10 : $subProjectDetails->customize_plan_option ;
			
			$sectionPlan			=	!empty($sectionParticipates) ? $sectionParticipates['0']['section_plan']:'';
			$sectionPlanName		=	!empty($sectionParticipates) ? $sectionParticipates['0']['name']:'';
			
			$array_2=array("project_module"=>$projectModule,"customize_plan_option"=>$customizePlanOption,"section_plan"=>$sectionPlan,"section_name"=>$sectionPlanName);
			$thisData = array_merge($thisData,$array_2);
			
		}else{
			$err						=	array();
			$err['error']				=	1;
			$err['message']				=	trans("Something Went Wrong!");
			return Response::json($err); 
			die;
		}
		
		//pr($thisData); die;
		Validator::extend('check_module', function($attribute, $value, $parameters) {
			if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
				return true;
			} else {
				return false;
			}
		});
		$validator = Validator::make(
			$thisData,
			array(
				'plan_type'					=> 'required_if:project_module,=,1',
				'plan_price'				=> 'required_if:project_module,=,1',
				'time_period'				=> 'required_if:project_module,=,1',
				'default_project_plan'		=> 'required_if:customize_plan_option,=,1',
				'total_contribution'		=> 'required_if:customize_plan_option,=,1,2,3,7',
				'quantity_project_plan'		=> 'required_if:customize_plan_option,=,3',
				'quantity'					=> 'required_if:customize_plan_option,=,3',
				'section_name'				=> 'required_if:customize_plan_option,=,4',
				'section_plan'				=> 'required_if:customize_plan_option,=,4',
				'dana_default_project_plan'	=> 'required_if:customize_plan_option,=,5',
				'dana_property_plan'		=> 'required_if:customize_plan_option,=,6',
				'dana_vendor'				=> 'required_if:customize_plan_option,=,7',
			),
			array(
				'plan_type.required_if'					=>	'Plan type is required',
				'plan_price.required_if'				=>	'Plan price is required',
				'time_period.required_if'				=>	'Plan period is required',
				'default_project_plan.required_if'		=>	'Project selection is required',
				'total_contribution.required_if'		=>	'Enter total contribution amount',
				'company_name.required_if'				=>	'Company name is required',
				'other_plan_price.required_if'			=>	'Customized Plan Price is required',
				'other_time_period.required_if'			=>	'Customized Plan Period is required',
				'section_name.required_if'				=>	'Participate name is required',
				'section_plan.required_if'				=>	'Participate Plan is required',
				'dana_default_project_plan.required_if'	=>	'Please Select Your Favourite Plan',
				'dana_property_plan.required_if'		=>	'Please Select Your Will Detail',
				'dana_vendor.required_if'				=>	'Please Select Your Vendor',
			)
		);
		
		if ($validator->fails()){	
			$response	=	array(
				'success'		=>	false,
				'errors'		=>	$validator->errors(),
			); 
			return Response::json($response); 
			die;
		}else{ 
			//pr($thisData); die;
			
			//first remove data in session
			Session::forget('SelectDonationPlanData');
			
			Session::set('SelectDonationPlanData', $thisData);
			
			$model 								=  new DonationOrder;
			
			/* $model->user_id 					=  $userId;
			$model->unique_donation_id 			=  $this->createOrderId(Input::get('sub_project_id'));
			$model->sub_project_id 				=  Input::get('sub_project_id');
			$model->plan_type 					=  !empty(Input::get('plan_type'))?Input::get('plan_type'):'';
			$model->plan_price 					=  !empty(Input::get('plan_price'))?Input::get('plan_price'):'';
			$model->time_period 				=  !empty(Input::get('time_period'))?Input::get('time_period'):'';
			$model->other_plan_price 			=  !empty(Input::get('other_plan_price'))?Input::get('other_plan_price'):'';
			$model->other_time_period 			=  !empty(Input::get('other_time_period'))?Input::get('other_time_period'):'';
			
			$model->default_project_plan 		=  !empty(Input::get('default_project_plan'))?Input::get('default_project_plan'):'';
			$model->total_contribution 			=  !empty(Input::get('total_contribution'))?Input::get('total_contribution'):0;
			$model->quantity_project_plan 		=  !empty(Input::get('quantity_project_plan'))?Input::get('quantity_project_plan'):'';
			$model->quantity 					=  !empty(Input::get('quantity'))?Input::get('quantity'):'';
			
			$model->dana_default_project_plan 	=  !empty(Input::get('dana_default_project_plan'))?Input::get('dana_default_project_plan'):'';
			$model->dana_property_plan 			=  !empty(Input::get('dana_property_plan'))?Input::get('dana_property_plan'):'';
			$model->extra_note 					=  !empty(Input::get('extra_note'))?Input::get('extra_note'):'';
			$model->dana_vendor 				=  !empty(Input::get('dana_vendor'))?Input::get('dana_vendor'):'';
			
			if(!empty($sectionParticipates)){
				$sectionTotalContribution = 0;
				foreach($sectionParticipates as $sectionParticipat){
					if(!empty($sectionParticipat['name']) && !empty($sectionParticipat['section_plan'])){
						$sectionPlanPrice = SubProjectSectionPlan::where('id',$sectionParticipat['section_plan'])->pluck('price');
						$participateModel					=	new SectionParticipate;
						//$participateModel->order_id			=	$modelId;
						$participateModel->sub_project_id	=	Input::get('sub_project_id');
						$participateModel->name				=	$sectionParticipat['name'];
						$participateModel->section_plan		=	$sectionParticipat['section_plan'];
						$participateModel->price			=	$sectionPlanPrice;
						$participateModel->save();
						
						$sectionTotalContribution +=	$sectionPlanPrice;
					}
				}
				if(!empty($sectionTotalContribution)){
					//DonationOrder::where('id',$modelId)->update(array('total_contribution'=>$sectionTotalContribution));
					
					$model->total_contribution	=	$sectionTotalContribution;
				}
			}
			
			//seat reservationPlan
			if(!empty($SeatReservations)){
				foreach($SeatReservations as $seatPlanId=>$SeatReservation){
					if(!empty($SeatReservation['total_seat'])){
						$seatPrice	=	SubProjectSeatReservationPlan::where('id',$seatPlanId)->pluck('seat_price');
						$saveReservationOrder						=	new SeatReservationOrder;
						$saveReservationOrder->amount				=	!empty($seatPrice)?$seatPrice:0;
						//$saveReservationOrder->order_id				=	$modelId;
						$saveReservationOrder->sub_project_id		=	Input::get('sub_project_id');
						$saveReservationOrder->seat_plan_id			=	$seatPlanId;
						$saveReservationOrder->seat_subtitle_id		=	$SeatReservation['seat_subtitle_id'];
						$saveReservationOrder->total_seat			=	$SeatReservation['total_seat'];
						$saveReservationOrder->save();
					}
				}
			}
			
			if($projectModule == 1){
				if(!empty($model->plan_price)){
					$activePlanPrice = DB::table('sub_project_plans')->where('id',Input::get('plan_price'))->pluck('price');
				}else{
					$activePlanPrice = $model->other_plan_price;
				}
				//DonationOrder::where('id',$modelId)->update(array('total_contribution'=>$activePlanPrice));
			}else if($projectModule == 2){
				$activePlanPrice = $model->total_contribution;
			}else if($projectModule == 3){
				if(!empty(Input::get('dana_default_project_plan'))){
					$activePlanPrice = SubProjectDanaDefaultPlan::where('id',Input::get('dana_default_project_plan'))->pluck('amount');
					//DonationOrder::where('id',$modelId)->update(array('total_contribution'=>$activePlanPrice));
				}else if(!empty(Input::get('dana_property_plan'))){
					$activePlanPrice = $model->total_contribution;
				}else if(!empty(Input::get('dana_vendor'))){
					$activePlanPrice = $model->total_contribution;
				}else{
					$activePlanPrice = 0;
				}
			} */
			
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Step One is compeleted.");
			return Response::json($err); 
			die;
			
		}
		
	}
	
	public function editProfile(){
		return View::make("front.globaluser.edit");
	}
	
	public function saveProfile(){
		Input::replace($this->arrayStripTags(Input::all()));
		$formData			=	Input::all();
		$login_user		 	= 	Auth::user();
		$user_id		 	=   $login_user->id;
	
		$validator = Validator::make(
			Input::all(),
			array(
				'full_name'			=> 'required',
				'phone'				=> 'required',
				'email'				=> 'required',
			),	
			array(
				'full_name.required'	=>	trans("Name is required"),
				'phone.required'		=>	trans("Phone number isrequired"),
				'email.required'		=>	trans("Email is required"),
			)
		);
		if ($validator->fails()){
			$errors 				=	$validator->messages();
		}
	
		if ($validator->fails()){
			$response	=	array(
				'success' 	=> false,
				'errors' 	=> $validator->errors()
			);
			return Response::json($response); 
			die;
		}else{
			$obj 					=  User::find(Auth::user()->id);
			
			if(!empty(Input::file('image'))){
				//$extension 			=	Input::file('itinery_file')->getClientOriginalExtension();
				$file_name 			=	Input::file('image')->getClientOriginalName();
				$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
				$folderPath			=	USER_PROFILE_IMAGE_ROOT_PATH.'/'.$newFolder; 
				if(!File::exists($folderPath)){
					File::makeDirectory($folderPath, $mode = 0777,true);
				}
				
				$obj->image	=	$newFolder.$file_name;
				Input::file('image')->move($folderPath, $file_name);
				
			}
			
			$obj->full_name 		=  Input::get('full_name');
			$obj->phone 			=  Input::get('phone');
			$obj->email				=  Input::get('email');
			$obj->save();
			$user = User::find(Auth::user()->id);
			Auth::setUser($user);
			$response	=	array(
				'success' 	=>	'1',
				'errors' 	=>	 trans("Profile updated successfully")
			); 
			
			Session::flash('flash_notice',  trans("Profile updated successfully"));
			return  Response::json($response); 
			die;
		}
	}
	
	public function saveProfileImage(){
		$newFolder     	= 	strtoupper(date('M'). date('Y')).'/';
		$folderPath		=	USER_PROFILE_IMAGE_ROOT_PATH.$newFolder; 
		$userImage    = 	file_get_contents(Input::get('base64_image'));
		if(!File::exists($folderPath)){
			File::makeDirectory($folderPath, $mode = 0777,true);
		}
		$userImageName = time().'-user.png';
		file_put_contents($folderPath.'/'.$userImageName,$userImage);
		$profile_image = $newFolder.$userImageName;
	
		$login_user		 	= 	Auth::user();
		$model_id		 	=   $login_user->id;
		$obj 				=  	User::find($model_id);
		$obj->id 			= 	$model_id;
		$obj->image 		= 	$profile_image;
		$obj->save();
		echo "success";
		die;
	}
	
	public function changePassword(){
		$login_user			=	Auth::user();
		if(empty($login_user)) {
			return Redirect::to('/');
		}
		$login_user		 	= 	Auth::user();
		$userData			=	DB::table('users')->where('id',$login_user->id)->first();
		return  View::make('front.globaluser.changepassword',compact('userData'));		
	} //end changePassword()
	
/** 
 * Function to saveChangePassword
 *
 * @param null
 * 
 * @return view page
 */
	public function saveChangePassword(){
		Input::replace($this->arrayStripTags(Input::all()));
		$formData			=	Input::all();
		$login_user		 	= 	Auth::user();
		$model_id		 	=   $login_user->id;
		$old_password    	= 	Input::get('old_password');
        $password         	= 	Input::get('new_password');
		Validator::extend('custom_password', function($attribute, $value, $parameters) {
			if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
				return true;
			} else {
				return false;
			}
		});
		$rules    = 	array(
			'old_password' 		=>	'required',
			'new_password'		=>	'required|min:8|custom_password',
			'confirm_password'  =>	'required|same:new_password', 
		);
		$validator 				= 	Validator::make(Input::all(), $rules,
		array(
			"old_password.required"			=>	trans("messages.messages.old_password_is_required"),
			"new_password.required"			=>	trans("messages.new_password_is_required"),
			"new_password.min"				=>	trans("messages.new_password_must_be_atleast"),
			"new_password.custom_password"	=>	trans("messages.password_must_be_a_combination"),
			"confirm_password.required"		=>	trans("messages.confirm_password_field_is_required"),
			"confirm_password.same"			=>	trans("messages.confirm_password_doesnot_match"),
		));
		if($validator->fails()){
			$response	=	array(
				'success' 	=> false,
				'errors' 	=> $validator->errors()
			);
			return Response::json($response); 
			die;
		}else{
			$obj 					=  User::find($model_id);
			$old_password 			= Input::get('old_password'); 
			$password 				= Input::get('new_password');
			if(Hash::check($old_password, $obj->getAuthPassword())){
				$obj->password = Hash::make($password);
				if($obj->save()){
					$data					=	array();
					$data['success']			=	true;
					Session::flash('flash_notice', trans("messages.password_updated_successfully")); 
					return Response::json($data); 
					die;
				}
			}else{
				$err							=	array();
				$err['success']					=	false;
				$err['errors']['old_password']	=	trans("messages.old_password_is_incorrect");
				return Response::json($err); 
				die;
			}
		}
	} //end changePassword()



	public function downloadInvoicePDF($invoiceNumber = ""){
		$pdf = new \mPDF();
        $pdf->SetHeader('header');
        $pdf->WriteHTML('Hello World');
        $pdf->SetFooter('footer');
        $pdf->Output('MyPDF.pdf', 'D');
		
		/* $data				=	Session::get('filter_sites');
		$thead				=	[];
		//$thead[] = array('sn'=>'#','name'=>'Site Name','email'=>'Email','phone'=>'Phone','status'=>'Status');
		$serial_no = 0 ;
		if(!empty($data)){
			foreach($data as $result){
				$serial_no++;
				$status				=   ($result->is_active ==1) ? "Active" :'Disable';
				$name				=	!empty($result->full_name)?$result->full_name:'';
				$email				=	!empty($result->email)?$result->email:'';
				$phone				=	!empty($result->phone)?$result->phone:'';
				$thead[] 			=	array('sn'=>$serial_no,'name'=>$name,'email'=>$email,'phone'=>$phone,'status'=>$status);
			}
		} */
		
		//return View::make('front.globaluser.download_invoice');
	}	
	

}
