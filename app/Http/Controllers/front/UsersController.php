<?php 
namespace App\Http\Controllers\front;
use App\Http\Controllers\BaseController;
use App\Model\EmailAction;
use App\Model\EmailTemplate;
use App\Model\SmsAction;
use App\Model\SmsTemplate;
use App\Model\User;
use App\Model\Cms;
use App\Model\CmsImage;
use App\Model\ProjectModule;
use App\Model\Project;
use App\Model\SubProject;
use App\Model\SubProjectPlan;
use App\Model\SubProjectPeriod;
use App\Model\TemplateSliderImage;
use App\Model\DonationOrder;
use App\Model\SubProjectDefaultPlan;
use App\Model\SeatReservationSubtitle;
use App\Model\SubProjectSeatReservationPlan;
use App\Model\SubProjectQuantityPlan;
use App\Model\SubProjectSectionPlan;
use App\Model\SubProjectDanaDefaultPlan;
use App\Model\SubProjectDanaPropertyType;
use App\Model\SubProjectDanaPriceRange;
use App\Model\DonationPayment;
use App\Model\SectionParticipate;
use App\Model\SeatReservationOrder;
use App\Model\PaymentOption;

use App\Model\GeneralSetting;
use App\Model\SeatHistory;
use App\Model\Block;
use App\Model\AdminPermission;
use App\Model\DropDown;
use App\Model\Setting;
use App\Model\NewsLettersubscriber;
use App\Model\Notification;
use App\Model\AdminLanguageSetting;
use Illuminate\Routing\Route;


use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator,App,Billplz;

class UsersController extends BaseController {
	
	
	public $model	=	'User';
	
	public function __construct(Route $route) {
		$viewDashboardValGlobal = "0";
		$addDashboardValGlobal = "0";
		$editDashboardValGlobal = "0";
		$deleteDashboardValGlobal = "0";
		
		$viewAnsarValGlobal = "0";
		$addAnsarValGlobal = "0";
		$editAnsarValGlobal = "0";
		$deleteAnsarValGlobal = "0";
		
		$viewSpecialProjectValGlobal = "0";
		$addSpecialProjectValGlobal = "0";
		$editSpecialProjectValGlobal = "0";
		$deleteSpecialProjectValGlobal = "0";
		
		$viewDanaProjectValGlobal = "0";
		$addDanaProjectValGlobal = "0";
		$editDanaProjectValGlobal = "0";
		$deleteDanaProjectValGlobal = "0";
		
		$viewTemplateValGlobal = "0";
		$addTemplateValGlobal = "0";
		$editTemplateValGlobal = "0";
		$deleteTemplateValGlobal = "0";
		
		$viewgeneralValGlobal = "0";
		$addgeneralValGlobal = "0";
		$editgeneralValGlobal = "0";
		$deletegeneralValGlobal = "0";
		
		$viewaccountValGlobal = "0";
		$addaccountValGlobal = "0";
		$editaccountValGlobal = "0";
		$deleteaccountValGlobal = "0";
		
		if(!empty(Auth::user())){
			$userId			=	Auth::user()->id;
			$adminPermissions = AdminPermission::where('is_deleted',0)->where('is_active',1)->where('user_id',$userId)->first();
			if(!empty($adminPermissions)){
				if(!empty($adminPermissions->dashboard)){
					$dashboardArray = explode(",",$adminPermissions->dashboard);
					if(!empty($dashboardArray)){
						if(in_array('1',$dashboardArray)){
							$viewDashboardValGlobal = "1";
						}
						if(in_array('2',$dashboardArray)){
							$addDashboardValGlobal = "2";
						}
						if(in_array('3',$dashboardArray)){
							$editDashboardValGlobal = "3";
						}
						if(in_array('4',$dashboardArray)){
							$deleteDashboardValGlobal = "4";
						}
						
					}
				}
				if(!empty($adminPermissions->ansar)){
					$ansarArray = explode(",",$adminPermissions->ansar);
					if(!empty($ansarArray)){
						if(in_array('1',$ansarArray)){
							$viewAnsarValGlobal = "1";
						}
						if(in_array('2',$ansarArray)){
							$addAnsarValGlobal = "2";
						}
						if(in_array('3',$ansarArray)){
							$editAnsarValGlobal = "3";
						}
						if(in_array('4',$ansarArray)){
							$deleteAnsarValGlobal = "4";
						}
						
					}
				}
				if(!empty($adminPermissions->special_project)){
					$specialProjectArray = explode(",",$adminPermissions->special_project);
					//pr($adminPermissions); die;
					if(!empty($specialProjectArray)){
						if(in_array('1',$specialProjectArray)){
							$viewSpecialProjectValGlobal = "1";
						}
						if(in_array('2',$specialProjectArray)){
							$addSpecialProjectValGlobal = "2";
						}
						if(in_array('3',$specialProjectArray)){
							$editSpecialProjectValGlobal = "3";
						}
						if(in_array('4',$specialProjectArray)){
							$deleteSpecialProjectValGlobal = "4";
						}
						
					}
				}
				if(!empty($adminPermissions->dana_project)){
					$danaProjectArray = explode(",",$adminPermissions->dana_project);
					//pr($adminPermissions); die;
					if(!empty($danaProjectArray)){
						if(in_array('1',$danaProjectArray)){
							$viewDanaProjectValGlobal = "1";
						}
						if(in_array('2',$danaProjectArray)){
							$addDanaProjectValGlobal = "2";
						}
						if(in_array('3',$danaProjectArray)){
							$editDanaProjectValGlobal = "3";
						}
						if(in_array('4',$danaProjectArray)){
							$deleteDanaProjectValGlobal = "4";
						}
						
					}
				}
				if(!empty($adminPermissions->template)){
					$templateArray = explode(",",$adminPermissions->template);
					//pr($adminPermissions); die;
					if(!empty($templateArray)){
						if(in_array('1',$templateArray)){
							$viewTemplateValGlobal = "1";
						}
						if(in_array('2',$templateArray)){
							$addTemplateValGlobal = "2";
						}
						if(in_array('3',$templateArray)){
							$editTemplateValGlobal = "3";
						}
						if(in_array('4',$templateArray)){
							$deleteTemplateValGlobal = "4";
						}
						
					}
				}
				if(!empty($adminPermissions->general)){
					$generalArray = explode(",",$adminPermissions->general);
					if(!empty($generalArray)){
						if(in_array('1',$generalArray)){
							$viewgeneralValGlobal = "1";
						}
						if(in_array('2',$generalArray)){
							$addgeneralValGlobal = "2";
						}
						if(in_array('3',$generalArray)){
							$editgeneralValGlobal = "3";
						}
						if(in_array('4',$generalArray)){
							$deletegeneralValGlobal = "4";
						}
						
					}
				}
				if(!empty($adminPermissions->account)){
					$accountArray = explode(",",$adminPermissions->account);
					if(!empty($accountArray)){
						if(in_array('1',$accountArray)){
							$viewaccountValGlobal = "1";
						}
						if(in_array('2',$accountArray)){
							$addaccountValGlobal = "2";
						}
						if(in_array('3',$accountArray)){
							$editaccountValGlobal = "3";
						}
						if(in_array('4',$accountArray)){
							$deleteaccountValGlobal = "4";
						}
						
					}
				}
				
				//pr($viewpackageValGlobal); die;
			}
			if(!empty($route)){
				//$CurrentSlug = Request::path();
				//pr($route); die;
				$url = explode('@', $route->getActionName());
				if(!empty($url['1'])){
					if($url['1'] == "AdminDashboard" && $viewDashboardValGlobal == 0){
						Redirect::to('/')->send();
					}
					/* else if($url['1'] == "BookingTemplate" && $viewbookingValGlobal == 0){
						if($viewDashboardValGlobal != 0){
							Redirect::to('/admin-dashboard')->send();
						}else if($viewpackageValGlobal != 0){
							Redirect::to('/personal-information')->send();
						}else if($viewgeneralValGlobal != 0){
							Redirect::to('/personal-information')->send();
						}else if($viewaccountValGlobal != 0){
							Redirect::to('/personal-information')->send();
						}else{
							Redirect::to('/logout')->send();
						}
					} */
				}
			
			}
		}
		
		//pr($viewpackageValGlobal); die;
		
		View::share('viewDashboardValGlobal',$viewDashboardValGlobal);
		View::share('addDashboardValGlobal',$addDashboardValGlobal);
		View::share('editDashboardValGlobal',$editDashboardValGlobal);
		View::share('deleteDashboardValGlobal',$deleteDashboardValGlobal);
		View::share('viewAnsarValGlobal',$viewAnsarValGlobal);
		View::share('addAnsarValGlobal',$addAnsarValGlobal);
		View::share('editAnsarValGlobal',$editAnsarValGlobal);
		View::share('deleteAnsarValGlobal',$deleteAnsarValGlobal);
		View::share('viewSpecialProjectValGlobal',$viewSpecialProjectValGlobal);
		View::share('addSpecialProjectValGlobal',$addSpecialProjectValGlobal);
		View::share('editSpecialProjectValGlobal',$editSpecialProjectValGlobal);
		View::share('deleteSpecialProjectValGlobal',$deleteSpecialProjectValGlobal);
		View::share('viewDanaProjectValGlobal',$viewDanaProjectValGlobal);
		View::share('addDanaProjectValGlobal',$addDanaProjectValGlobal);
		View::share('editDanaProjectValGlobal',$editDanaProjectValGlobal);
		View::share('deleteDanaProjectValGlobal',$deleteDanaProjectValGlobal);
		View::share('viewTemplateValGlobal',$viewTemplateValGlobal);
		View::share('addTemplateValGlobal',$addTemplateValGlobal);
		View::share('editTemplateValGlobal',$editTemplateValGlobal);
		View::share('deleteTemplateValGlobal',$deleteTemplateValGlobal);
		View::share('viewgeneralValGlobal',$viewgeneralValGlobal);
		View::share('addgeneralValGlobal',$addgeneralValGlobal);
		View::share('editgeneralValGlobal',$editgeneralValGlobal);
		View::share('deletegeneralValGlobal',$deletegeneralValGlobal);
		View::share('viewaccountValGlobal',$viewaccountValGlobal);
		View::share('addaccountValGlobal',$addaccountValGlobal);
		View::share('editaccountValGlobal',$editaccountValGlobal);
		View::share('deleteaccountValGlobal',$deleteaccountValGlobal);
		
	}
	
	
	
/** 
* Function to display website home page
*
* @param null
* 
* @return view page
*/
	public function index(){
		$homePageSlug	=	DB::table('cms_pages')->where('is_deleted',0)->where('is_active',1)->where('project',1)->pluck('slug');
		return Redirect::to('/projects/'.$homePageSlug);
		
		/* if(empty(Auth::user())){
			//return Redirect::to('/');
		}else{
			if(Auth::user()->user_role_id == 1){
				return Redirect::to('/admin-dashboard');				
			}else{
				return Redirect::to('/dashboard');				
			}
		} */
		return View::make('front.user.index',compact(""));
	}
	
	public function PageDetails(){
		
		return View::make('front.user.page_details',compact(""));
	}
	
	public function showCms($slug) { 
		$lang			=	App::getLocale();
		//echo $lang;die;
		$cmsPagesDetail	=	DB::select(DB::raw("SELECT * FROM cms_page_descriptions WHERE foreign_key = (select id from cms_pages WHERE cms_pages.slug = '$slug') AND language_id = (select id from languages WHERE languages.lang_code = '$lang')"));
		if(empty($cmsPagesDetail)){
			return Redirect::to('/');
		} 
		$result	=	array();
		foreach($cmsPagesDetail as $cms){
			$key	=	$cms->source_col_name;
			$value	=	$cms->source_col_description;
			$result[$cms->source_col_name]	=		$cms->source_col_description;
		}
		return View::make('front.user.show_cms' , compact('result','slug'));
	}
	
	public function createOrderId($package_id){
		$charectors = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		$uniqueOrderId = $charectors[rand(0, strlen($charectors)-1)].$charectors[rand(0, strlen($charectors)-1)].rand(10,98).rand(10,89).rand(11,99);
		$checkOrder = DonationOrder::where('unique_donation_id',$uniqueOrderId)->count('id');
		if($checkOrder > 0){
			$uniqueOrderId = $charectors[rand(0, strlen($charectors)-1)].$uniqueOrderId;
		}
		
		return "$uniqueOrderId";
	}
	
	
	public function dashboard(){
		Session::forget('SelectDonationPlanData');
		//pr(Auth::user()); die;
		if(Auth::user()->user_role_id == 1){
			return Redirect::to('/admin-dashboard');				
		}
		$userId				=	Auth::user()->id;
		
		$allOrderIds	=	DonationOrder::leftJoin('sub_projects', function($join) {
											  $join->on('donation_orders.sub_project_id', '=', 'sub_projects.id');
											})->where('sub_projects.is_deleted',0)->where('donation_orders.is_deleted',0)
											->where('donation_orders.user_id',$userId)->lists('donation_orders.id','donation_orders.id');
		
		//total contribution funds -total approved payments
		$totalApprovedContribution	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
		
		$allContributions		=	count($allOrderIds);
		
		$chartData				=	array();
		
		//ansar chart data
		$ansarSubprojectIds		=	SubProject::where('project_module',1)->lists('id','id');
		$ansarOrderIds			=	DonationOrder::whereIn('id',$allOrderIds)->where('is_deleted',0)->where('user_id',$userId)->whereIn('sub_project_id',$ansarSubprojectIds)->lists('id','id');
		$AnsarTotalPayments		=	DonationPayment::whereIn('order_id',$ansarOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
		
		//special project chart data
		$specialSubprojectIds		=	SubProject::where('project_module',2)->lists('id','id');
		$specialOrderIds			=	DonationOrder::whereIn('id',$allOrderIds)->where('is_deleted',0)->where('user_id',$userId)->whereIn('sub_project_id',$specialSubprojectIds)->lists('id','id');
		$SpecialTotalPayments		=	DonationPayment::whereIn('order_id',$specialOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
		
		//dana lestari chart data
		$danaLestariSubprojectIds	=	SubProject::where('project_module',3)->lists('id','id');
		$danaLestariOrderIds		=	DonationOrder::whereIn('id',$allOrderIds)->where('is_deleted',0)->where('user_id',$userId)->whereIn('sub_project_id',$danaLestariSubprojectIds)->lists('id','id');
		$DanaLestariTotalPayments	=	DonationPayment::whereIn('order_id',$danaLestariOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
		
		$AnsarTotalPayments			=	!empty($AnsarTotalPayments) ? $AnsarTotalPayments:0;
		$SpecialTotalPayments		=	!empty($SpecialTotalPayments) ? $SpecialTotalPayments:0;
		$DanaLestariTotalPayments	=	!empty($DanaLestariTotalPayments) ? $DanaLestariTotalPayments:0;
		
		if(!empty($totalApprovedContribution)){
			$pieChartData = '{
								label: "Ansar",
								
								value: "'.round((($AnsarTotalPayments/$totalApprovedContribution) * 100),2).'"
							},{
								label: "Special Project",
								
								value: "'.round((($SpecialTotalPayments/$totalApprovedContribution) * 100),2).'"
							},{
								label: "Dana Lestari",
								
								value: "'.round((($DanaLestariTotalPayments/$totalApprovedContribution) * 100),2).'"
							}';
		
		}else{
			$pieChartData = '{
								label: "Ansar",
								
								value: "0"
							},{
								label: "Special Project",
								
								value: "0"
							},{
								label: "Dana Lestari",
								
								value: "0"
							}';
		}
		
		
		$DB							=	DonationOrder::query(); 
		$idsData					=	array(); 
		$searchVariable				=	array(); 
		$selectedSort_by			=	"";
		$inputGet					=	Input::get();
		if(Input::get()) {
			$searchData				=	Input::get();
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
			if(isset($searchData['per_page'])){
				unset($searchData['per_page']);
			}
			if(isset($searchData['sort_by'])){
				unset($searchData['sort_by']);
			}
			
			foreach($searchData as $fieldName => $fieldValue){
				if(!empty($fieldValue) || $fieldValue == 0){
				    if($fieldName == "keyword"){
						$DB->where("full_name",'like','%'.$fieldValue.'%');
					}else if($fieldName == "status"){
					  if($fieldValue != ""){
						$PaymentStatusIds = array();
						if($fieldValue == 1){
							$PaymentStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',1)->lists('order_id','order_id');
						}else if($fieldValue == 2){
							$PaymentStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',2)->lists('order_id','order_id');
						}else if($fieldValue == 3){
							$PaymentStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',3)->lists('order_id','order_id');
						}else if($fieldValue == 5){
							$PaymentStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',5)->lists('order_id','order_id');
						}
						
						$DB->whereIn("id",$PaymentStatusIds);
					  }
					}else if($fieldName == "special_project_seat_plan"){
						if($fieldValue != ""){
							$seatProjectOrderIds = SeatReservationOrder::where('seat_plan_id',$fieldValue)->where('is_deleted',0)->where('is_active',1)->lists('order_id','order_id')->toArray();
							
							$DB->whereIn('id',$seatProjectOrderIds);
						}
					}else if($fieldName == "special_project_section_plan"){
						if($fieldValue != ""){
							$sectionProjectOrderIds = SectionParticipate::where('section_plan',$fieldValue)->lists('order_id','order_id')->toArray();
							
							$DB->whereIn('id',$sectionProjectOrderIds);
						}
					}else if($fieldName == "dana_vendor"){
						if($fieldValue != ""){
							$DB->whereRaw("FIND_IN_SET(?,dana_vendor)",[$fieldValue]);
						}
					}else{
						$DB->where("$fieldName",'=',$fieldValue);
						//$DB->where("$fieldName",'like','%'.$fieldValue.'%');
					}
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		
		$sortBy 					= 	(Input::get('sortBy')) ? Input::get('sortBy') : 'created_at';
	    $order  					= 	(Input::get('order')) ? Input::get('order')   : 'DESC';
		
		
		$result 					= 	$DB
											->select('donation_orders.*',
												DB::raw("(select project_module from sub_projects where id=donation_orders.sub_project_id) as project_module"),
												DB::raw("(select customize_plan_option from sub_projects where id=donation_orders.sub_project_id) as customize_plan_option"),
												DB::raw("(select sub_project_name from sub_projects where id=donation_orders.sub_project_id) as sub_project_name")
											)
											->whereIn('id',$allOrderIds)
											->where('user_id',$userId)
											->where('is_deleted',0)
											->orderBy($sortBy, $order)
											->paginate(Config::get("Reading.records_per_page"));
											
		if(!empty($result)){
			foreach($result as &$record){
				if($record->project_module == 1){
					$record->project_module_name	=	"Ansar";
					if(!empty($record->plan_price)){
						$projectPayment = DB::table('sub_project_plans')->where('id',$record->plan_price)->pluck('price');
					}else{
						$projectPayment = $record->other_plan_price;
					}
				}else if($record->project_module == 2){
					$record->project_module_name	=	"Special Project";
					if($record->customize_plan_option == 1){
						$projectPayment = !empty($record->total_contribution) ? $record->total_contribution : 0;
					}else if($record->customize_plan_option == 2){
						$reservationArray = SeatReservationOrder::select('seat_reservation_orders.*',DB::raw("(select seat_name from sub_project_seat_reservation_plans where id=seat_reservation_orders.seat_plan_id) as seat_name"))->where('order_id',$record->id)->where('is_active',1)->get();
						$totalAmountOfSeat = 0;
						if(!empty($reservationArray)){
						  foreach($reservationArray as $reservationSeats){
							$totalAmountOfSeat += $reservationSeats->amount;
						  }
						}
						
						$projectPayment = !empty($record->total_contribution) ? ($record->total_contribution + $totalAmountOfSeat): 0;
					}else if($record->customize_plan_option == 4){
						$participateArray = SectionParticipate::where('order_id',$record->id)->where('is_active',1)->lists('section_plan','section_plan')->toArray();
						$sectionPlanArray	=	SubProjectSectionPlan::whereIn('id',$participateArray)->get();
						$totalAmountOfParticipate = 0;
						if(!empty($sectionPlanArray)){
						  foreach($sectionPlanArray as $paricipateArray){
							$totalAmountOfParticipate += $paricipateArray->price;
						  }
						}
						
						$projectPayment = !empty($record->total_contribution) ? ($record->total_contribution + $totalAmountOfParticipate) : $totalAmountOfParticipate;
						
					}else{
						$projectPayment = !empty($record->total_contribution) ? ($record->total_contribution): 0;	
					}
				}else if($record->project_module == 3){
					$record->project_module_name	=	"Dana Lestari";
					$projectPayment = !empty($record->total_contribution) ? ($record->total_contribution): 0;	
				}
				
				$record->projectPayment	=	$projectPayment;
				
				$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',1)->pluck('payment_status');
				if(empty($checkMainPaymentStatus)){
					$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',3)->pluck('payment_status');
					if(empty($checkMainPaymentStatus)){
						$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',5)->pluck('payment_status');
						if(empty($checkMainPaymentStatus)){
							$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',2)->pluck('payment_status');
						}
					}
				}
				$record->main_payment_status	=	$checkMainPaymentStatus;
				
			}
		}
		
		
		return View::make('front.user.dashboard',compact('totalApprovedContribution','allContributions','pieChartData','AnsarTotalPayments','SpecialTotalPayments','DanaLestariTotalPayments','result'));
	}
	
	
	
	public function QrCodeGenerate($OrderUniqueId){
		if(empty($OrderUniqueId)){
			return Redirect::to('/home');
		}
		$orderDetails = Order::select('orders.*',DB::raw("(select full_name from users WHERE id=orders.user_id) as sales_person_name"),DB::raw("(select refrral_id from users WHERE id=orders.user_id) as refrral_id"))->where('is_deleted',0)->where('is_active',1)->where('order_unique_id',$OrderUniqueId)->first();
		if(empty($orderDetails)){
			return Redirect::to('/home');	
		}
		
		$userId = $orderDetails->user_id;
		$packageId = $orderDetails->package_id;
		
		$totalGuests = 0;
		
		$depositAmount = 0;
		
		$api_key = Config::get("Settings.payment_secret_key"); //'af6b3ddc-5152-4852-b3b8-5605aed427a1';
		if(empty($orderDetails->bill_id)){
			if($orderDetails->package_category == 1){
				$packageCategory = "Direct Flight";
				$packageCollectionId = Config::get("Settings.payment_collection_id_df");
			}else if($orderDetails->package_category == 2){
				$packageCategory = "Umrah Ziarah";
				$packageCollectionId = Config::get("Settings.payment_collection_id_uz");
			}else if($orderDetails->package_category == 3){
				$packageCategory = "Umrah Transit";
				$packageCollectionId = Config::get("Settings.payment_collection_id_ut");
			}else if($orderDetails->package_category == 4){
				$packageCategory = "Holidays";
				$packageCollectionId = Config::get("Settings.payment_collection_id_holiday");
			}else{
				$packageCategory = "";
				$packageCollectionId = "";
			}
			
			if(empty($packageCollectionId)){
				$packageCollectionId = Package::where('id',$packageId)->pluck('collection_id');
				if(empty($packageCollectionId)){
					
					//$host = 'https://www.billplz.com/api/v4/webhook_rank';
					$host = 'https://www.billplz.com/api/v3/collections';
					//$host = 'https://www.billplz.com/api/v3/collections/dfza4e2q'; 
					
					//create collection id
					$process = curl_init($host);
					
					$postdata = Array(
									  'title' => $packageCategory,
									  'logo' => ''
									);
					
					curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
					curl_setopt($process, CURLOPT_POSTFIELDS, $postdata);
					curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
					$return = curl_exec($process);
					$collectionArray = json_decode($return);
					//pr($collectionArray); die;
					
					$packageCollectionId = $collectionArray->id;
					Package::where('id',$packageId)->update(array('collection_id'=>$packageCollectionId));
					
				}
			}
			
			
			//bill generate
			$hostBill = 'https://www.billplz.com/api/v3/bills';
			$process = curl_init($hostBill);
			
			$totalPrice = $orderDetails->total_price * 100;
			$Date = date("d/m/Y",strtotime($orderDetails->created_at))."  check out: ".date("d/m/Y",strtotime($orderDetails->arrival_date))." to ".date("d/m/Y",strtotime($orderDetails->departure_date));
			
			$quantityAmount = $totalGuests."/".$orderDetails->total_price;
			$callbackUrl	=	WEBSITE_URL.'payment-success';
				
			$postdata = Array(
							  'collection_id' => $packageCollectionId,
							  'email' => $orderDetails->contact_email,
							  //'mobile' => $orderDetails->contact_phone,
							  'name' => $orderDetails->contact_name,
							  'amount' => $totalPrice,
							  'callback_url' => $callbackUrl,
							  'redirect_url' => $callbackUrl,
							  //'callback_url' => 'https://softspro.com/demo/andalusia/check-payment',
							  'description' => 'dfza4e2q',
							  'reference_1_label' => 'Date',
							  'reference_1' => $Date,
							  'reference_2_label' => 'Quantity/Amount',
							  'reference_2' => $quantityAmount
							);
			
			curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
			curl_setopt($process, CURLOPT_POSTFIELDS, $postdata);
			curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($process);
			$paymentArray = json_decode($response); 
			
			//pr($paymentArray); die;
			if(isset($paymentArray->error)){
				
				$errorType = $paymentArray->error->type;
				$errorMessage = $paymentArray->error->message;
				return View::make('front.user.payment_error_page',compact("errorType","errorMessage"));
			}else{
			
				$billUrl = $paymentArray->url;
				$billId = $paymentArray->id;
				Order::where('id',$orderDetails->id)->update(array('bill_id'=>$billId));
			}
			
		}else{
			
			$billId = $orderDetails->bill_id;
			$billUrl = "https://www.billplz.com/bills/".$billId;
			
			
		}
		
		
		return View::make('front.user.qr_code_generate',compact("orderDetails","totalGuests","billUrl","depositAmount"));
	}
	
	
	public function InvoiceGenerate($invoiceId = ""){
		//Session::set('PaymentMethod', 'bank-transfer');
		if(empty($invoiceId)){
			return Redirect::to('/');
		}
		
		$paymentInvoice	=	DonationPayment::where('invoice_id',$invoiceId)->where('is_deleted',0)->where('is_active',1)->first();
		if(!empty($paymentInvoice)){
			$paymentOrderId	=	$paymentInvoice->order_id;
			$orderDetails = DonationOrder::LeftJoin('sub_projects', 'donation_orders.sub_project_id', '=', 'sub_projects.id')
						->select('donation_orders.*','sub_projects.sub_project_name as sub_project_name','sub_projects.payment_type as payment_type',
							DB::raw("(select name from dropdown_managers where id=donation_orders.payment_method) as payment_method_name")
						)
						->where('donation_orders.is_deleted',0)->where('donation_orders.id',$paymentOrderId)->first();
		}else{
			$orderDetails = DonationOrder::LeftJoin('sub_projects', 'donation_orders.sub_project_id', '=', 'sub_projects.id')
						->select('donation_orders.*','sub_projects.sub_project_name as sub_project_name','sub_projects.payment_type as payment_type',
							DB::raw("(select name from dropdown_managers where id=donation_orders.payment_method) as payment_method_name")
						)
						->where('donation_orders.is_deleted',0)->where('donation_orders.unique_donation_id',$invoiceId)->first();
			if(empty($orderDetails)){
				$orderDetails = DonationOrder::LeftJoin('sub_projects', 'donation_orders.sub_project_id', '=', 'sub_projects.id')
							->select('donation_orders.*','sub_projects.sub_project_name as sub_project_name','sub_projects.payment_type as payment_type',
								DB::raw("(select name from dropdown_managers where id=donation_orders.payment_method) as payment_method_name")
							)
							->where('donation_orders.is_deleted',0)->where('donation_orders.bill_id',$invoiceId)->first();
			}
			if(!empty($orderDetails)){
				$paymentInvoice	=	DonationPayment::where('order_id',$orderDetails->id)->where('is_deleted',0)->where('is_active',1)->first();
			}
		}
		// pr($orderDetails);
		// pr($paymentInvoice); die;
		
		if(empty($orderDetails)){
			return Redirect::to('/');	
		}
		
		$subProjectDetails = SubProject::select('sub_projects.*',DB::raw("(select name from projects where id=sub_projects.project_id) as project_name"),DB::raw("(select full_name from users where id=sub_projects.vendor) as vendor_name"))->where('id',$orderDetails->sub_project_id)->first();
		//pr($subProjectDetails); die;
		
		if($subProjectDetails->project_module == 1){
			if(!empty($orderDetails->plan_price)){
				$planPrice = SubProjectPlan::where('id',$orderDetails->plan_price)->where('is_deleted',0)->pluck('price');
			}else{
				$planPrice	=	$orderDetails->other_plan_price;
			}
		}else{
			if($subProjectDetails->customize_plan_option == 2){
				$orderDetails->planDescription = SeatReservationOrder::select('seat_reservation_orders.*',DB::raw("(select seat_name from sub_project_seat_reservation_plans where id=seat_reservation_orders.seat_plan_id) as seat_name"))->where('order_id',$orderDetails->id)->where('is_active',1)->get();
				$planPrice = SeatReservationOrder::where('order_id',$orderDetails->id)->where('is_active',1)->sum('amount');
			}else if($subProjectDetails->customize_plan_option == 4){
				$orderDetails->planDescription = SectionParticipate::select('section_participates.*',DB::raw("(select section_name from sub_project_section_plans where id=section_participates.section_plan) as plan_name"))->where('order_id',$orderDetails->id)->where('is_active',1)->where('is_deleted',0)->get();
				$planPrice = 0; //SectionParticipate::where('order_id',$orderDetails->id)->where('is_active',1)->sum('price');
			}else{
				$planPrice	=	0;
			}
		}
		
		
		if(!empty($orderDetails->time_period)){
			$planPeriod = SubProjectPeriod::where('id',$orderDetails->time_period)->where('is_deleted',0)->pluck('quantity');
		}else{
			$planPeriod	=	$orderDetails->other_time_period;
		}
		
		if(!empty($orderDetails->default_project_plan)){
			$planName	=	SubProjectDefaultPlan::where('id',$orderDetails->default_project_plan)->pluck('title');
		}else if($orderDetails->quantity_project_plan){
			$planName	=	SubProjectQuantityPlan::where('id',$orderDetails->quantity_project_plan)->pluck('plan_title');
		}else if($orderDetails->dana_default_project_plan){
			$planName	=	SubProjectDanaDefaultPlan::where('id',$orderDetails->dana_default_project_plan)->pluck('title');
		}else if($orderDetails->dana_property_plan){
			$planName	=	SubProjectDanaPropertyType::where('id',$orderDetails->dana_property_plan)->pluck('title');
		}else if($orderDetails->dana_vendor){
			$planName	=	User::where('id',$orderDetails->dana_vendor)->pluck('full_name');
		}else{
			$planName	=	"";
		}
		
		if(empty(Auth::user()) && ($orderDetails->user_id == 0)){
			$RegisterDataPending = !empty(Session::get('RegisterDataPending'))?Session::get('RegisterDataPending'):'';
			if(empty($RegisterDataPending)){
				Session::forget('RegisterDataPending');
				
				$userEmail 		=	$orderDetails->email;
				$userFullName 	=	$orderDetails->full_name;
				$userPhone 	=	$orderDetails->phone;
				
				$pendingRegistrationData				=	array();
				$pendingRegistrationData['email']		=	$userEmail;
				$pendingRegistrationData['full_name']	=	$userFullName;
				$pendingRegistrationData['phone']		=	$userPhone;
				Session::set('RegisterDataPending', $pendingRegistrationData);
			}
		}
		//pr($paymentInvoice); die;
		return View::make('front.user.invoice_generate',compact("orderDetails","planPrice","planPeriod","subProjectDetails","planName","paymentInvoice"));
	}
	
	public function GetFinalPaymentDetails(){
		$userId			=	!empty(Auth::user()) ? Auth::user()->id:"";
		$orderId		=	Input::get('OrderId');
		$PaymentId		=	!empty(Input::get('PaymentId'))?Input::get('PaymentId'):0;
		$orderDetails 	= 	DonationOrder::where('id',$orderId)->first();
		
		$subProjectDetails = SubProject::select('id','project_module','customize_plan_option')->where('id',$orderDetails->sub_project_id)->first();
		
		if($subProjectDetails->project_module == 1){
			if(!empty($orderDetails->plan_price)){
				$planPrice = SubProjectPlan::where('id',$orderDetails->plan_price)->where('is_deleted',0)->pluck('price');
			}else{
				$planPrice	=	$orderDetails->other_plan_price;
			}
		}else if($subProjectDetails->project_module == 2){
			if($subProjectDetails->customize_plan_option == 2){
				$reservationPrice = SeatReservationOrder::where('order_id',$orderDetails->id)->where('is_active',1)->sum('amount');
				$totalContribution = !empty($orderDetails->total_contribution)?$orderDetails->total_contribution:0;
				
				$planPrice	=	empty($totalContribution) ? ($reservationPrice) : $totalContribution;
			}else if($subProjectDetails->customize_plan_option == 4){
				$sectionPrice = SectionParticipate::where('order_id',$orderDetails->id)->where('is_active',1)->sum('price');
				$totalContribution = !empty($orderDetails->total_contribution)?$orderDetails->total_contribution:0;
				
				$planPrice	=	empty($totalContribution)? ($sectionPrice) : $totalContribution;
			}else{
				$planPrice	=	!empty($orderDetails->total_contribution)?$orderDetails->total_contribution:0;
			}
		}else{
			$planPrice	=	!empty($orderDetails->total_contribution)?$orderDetails->total_contribution:0;
		}
		
		/* if(!empty($orderDetails->total_contribution) && $orderDetails->total_contribution > 0){
			$planPrice = $orderDetails->total_contribution;
		}else if(!empty($orderDetails->plan_price)){
			$planPrice = SubProjectPlan::where('id',$orderDetails->plan_price)->where('is_deleted',0)->pluck('price');
		}else{
			$planPrice	=	$orderDetails->other_plan_price;
		} */
		
		$paymentOptions	=	PaymentOption::where('is_active',1)->orderBy('id','ASC')->get();
		
		$userId = !empty($orderDetails) ? ($orderDetails->user_id) : 0;
		
		return View::make('front.user.get_final_payments_popup',compact("orderDetails","planPrice","paymentOptions","PaymentId"));
	}
	
	public function PayNow(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	!empty(Auth::user()) ? Auth::user()->id:"";
		//pr($thisData); die;
		
		if(empty(Input::get('order_id'))){
			$err					=	array();
			$err['error']			=	1;
			$err['message']			=	trans("Something went wrong! Payment details not featch.");
			return Response::json($err); 
			die;
		}
		if(empty(Input::get('total_payment'))){
			$err					=	array();
			$err['error']			=	1;
			$err['message']			=	trans("Please enter amount you want to pay.");
			return Response::json($err); 
			die;
		}
		if(empty(Input::get('payment_option'))){
			$err					=	array();
			$err['error']			=	1;
			$err['message']			=	trans("Please select payment option.");
			return Response::json($err); 
			die;
		}
		if(empty(Input::get('reference_id')) && empty(Input::file('receipt')) && Input::get('payment_option') != 5){
			$err					=	array();
			$err['error']			=	1;
			$err['message']			=	trans("Please enter reference id Or upload receipt");
			return Response::json($err); 
			die;
		}
		
		if(!empty(Input::get('order_id'))){
			$payment_id = !empty(Input::get('payment_id'))?Input::get('payment_id'):'';
			
			$orderDetails = DonationOrder::where('id',Input::get('order_id'))->first();
			$OrderId = $orderDetails->id;
			
			$subProjectDetails = SubProject::select('id','project_module','customize_plan_option')->where('id',$orderDetails->sub_project_id)->first();
			
			if($subProjectDetails->project_module == 1){
				if(!empty($orderDetails->plan_price)){
					$planPrice = SubProjectPlan::where('id',$orderDetails->plan_price)->where('is_deleted',0)->pluck('price');
				}else{
					$planPrice	=	$orderDetails->other_plan_price;
				}
			}else if($subProjectDetails->project_module == 2){
				if($subProjectDetails->customize_plan_option == 2){
					$reservationPrice = SeatReservationOrder::where('order_id',$orderDetails->id)->where('is_active',1)->sum('amount');
					$totalContribution = !empty($orderDetails->total_contribution)?$orderDetails->total_contribution:0;
					
					$planPrice	=	empty($totalContribution)? ($reservationPrice) : $totalContribution;
				}else if($subProjectDetails->customize_plan_option == 4){
					$sectionPrice = SectionParticipate::where('order_id',$orderDetails->id)->where('is_active',1)->sum('price');
					$totalContribution = !empty($orderDetails->total_contribution)?$orderDetails->total_contribution:0;
					
					$planPrice	=	empty($totalContribution)? ($sectionPrice) : $totalContribution;
				}else{
					$planPrice	=	!empty($orderDetails->total_contribution)?$orderDetails->total_contribution:0;
				}
			}else{
				$planPrice	=	!empty($orderDetails->total_contribution)?$orderDetails->total_contribution:0;
			}
			
			/* if(!empty($orderDetails->total_contribution)){
				$planPrice	=	$orderDetails->total_contribution;
			}else if(!empty($orderDetails->plan_price)){
				$planPrice = SubProjectPlan::where('id',$orderDetails->plan_price)->where('is_deleted',0)->pluck('price');
			}else{
				$planPrice	=	$orderDetails->other_plan_price;
			} */
			
			if(empty(Input::get('total_payment')) && Input::get('total_payment') < $planPrice){
				$err					=	array();
				$err['error']			=	1;
				$err['message']			=	trans("Please enter a valid amount");
				return Response::json($err); 
				die;
			}
			
			if(Input::get('payment_option') == 5){
				
				$api_key = Config::get("Settings.payment_secret_key"); //'af6b3ddc-5152-4852-b3b8-5605aed427a1';
				$paymentCollectionId = Config::get("Settings.payment_collection_id");
				
				//create collection if not found/empty
				if(empty($paymentCollectionId)){
					
					//$host = 'https://www.billplz.com/api/v4/webhook_rank';
					//$host = 'https://www.billplz.com/api/v3/collections/dfza4e2q'; 
					$host = 'https://www.billplz.com/api/v3/collections';
					
					//create collection id
					$process = curl_init($host);
					
					$postdata = Array(
									  'title' => 'Hidayah Center Foundation',
									  'logo' => ''
									);
					
					curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
					curl_setopt($process, CURLOPT_POSTFIELDS, $postdata);
					curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
					$return = curl_exec($process);
					$collectionArray = json_decode($return);
					
					//pr($collectionArray); die;
					$paymentCollectionId = $collectionArray->id;
					
				}
				
				
				//bill generate
				$hostBill = 'https://www.billplz.com/api/v3/bills';
				$process = curl_init($hostBill);
				
				$totalPrice = $planPrice * 100;
				$callbackUrl	=	WEBSITE_URL.'payment-success';
				
				$postdata = Array(
								  'collection_id' => $paymentCollectionId,
								  'email' => $orderDetails->email,
								  'mobile' => $orderDetails->phone,
								  'name' => $orderDetails->full_name,
								  'amount' => $totalPrice,
								  'callback_url' => $callbackUrl,
								  'redirect_url' => $callbackUrl,
								  'description' => $paymentCollectionId
								);
				
				curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
				curl_setopt($process, CURLOPT_POSTFIELDS, $postdata);
				curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($process);
				$paymentArray = json_decode($response); 
				
				//pr($paymentArray); die;
				if(isset($paymentArray->error)){
					
					$errorType = $paymentArray->error->type;
					$errorMessage = $paymentArray->error->message;
					
					$billId = "";
					$billUrl = "";
				}else{
				
					$billUrl = $paymentArray->url;
					$billId = $paymentArray->id;
					DonationOrder::where('id',$OrderId)->update(array('bill_id'=>$billId));
				}
				
				$err					=	array();
				$err['success']			=	2;
				$err['billUrl']			=	$billUrl;
				$err['message']			=	trans("Payment request send successfully.");
				return Response::json($err); 
				die;
				
			}else{
				$receiptFile = "";
				if(!empty(Input::file('receipt'))){
					$file_name 			=	str_replace(" ","_",Input::file('receipt')->getClientOriginalName());
					$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
					$folderPath			=	PAYMENT_RECEIPT_ROOT_PATH.'/'.$newFolder; 
					if(!File::exists($folderPath)){
						File::makeDirectory($folderPath, $mode = 0777,true);
					}
					
					if(Input::file('receipt')->move($folderPath, $file_name)){
						$receiptFile	=	$newFolder.$file_name;
					}
				}
				
				if(empty($orderDetails->refrence_id) && empty($orderDetails->receipt)){
					$reference_id	=	Input::get('reference_id'); 
					$receipt		=	$receiptFile; 
					DonationOrder::where('id',$OrderId)->update(array('refrence_id'=>$reference_id,'receipt'=>$receipt));
				}
				
				if(!empty($payment_id)){
					$donationPayment 				=  DonationPayment::find($payment_id);
				}else{
					$donationPayment 				=  new DonationPayment;
					$donationPayment->invoice_id		=  time().rand(00,99); 
				}
				$donationPayment->order_id			=  Input::get('order_id'); 
				$donationPayment->sub_project_id	=  $orderDetails->sub_project_id; 
				$donationPayment->payment_option	=  Input::get('payment_option'); 
				$donationPayment->reference_id		=  Input::get('reference_id'); 
				$donationPayment->receipt			=  $receiptFile; 
				$donationPayment->amount			=  $planPrice; 
				$donationPayment->payment_status	=  "1"; 
				$donationPayment->save();
				$PaymentModelId						=	$donationPayment->id;
				
				
				$orderTotalApprovedPayment = DonationPayment::where('order_id',Input::get('order_id'))->whereIn('payment_status',array(2))->sum('amount');
				DonationOrder::where('id',Input::get('order_id'))->update(array('deposite'=>$orderTotalApprovedPayment));
				
				$this->sendAmountPaidEmail(Input::get('order_id'),$PaymentModelId);
				
				$err					=	array();
				$err['success']			=	1;
				$err['message']			=	trans("Payment request send successfully.");
				return Response::json($err); 
				die;
			
			}
		}else{
			
			$err					=	array();
			$err['error']			=	3;
			$err['message']			=	trans("Something went wrong!");
			return Response::json($err); 
			die;
		}
		
	}
	
	
	public function getDashboardChartData(){
		//pr(Input::all()); die;
		//Sparkline Chart 30 days
		$startDate		=	Input::get('from_date');
		$endDate		=	Input::get('to_date');
		
		$allOrderIds	=	DonationOrder::where('is_deleted',0)->lists('id','id');
		
		$now 			= strtotime($startDate); // or your date as well
		$your_date 		= strtotime($endDate);
		$datediff 		= $your_date - $now;

		$totalDays =  round($datediff / (60 * 60 * 24));
		
		for ($i = 0; $i <= $totalDays; $i++) {
			$days[] = $i;
		}
		$num				=	0;
		
		$SparklineGraphDaily	=	array();
		
		foreach($days as $day){
			$day_start_time							=	date('Y-m-d 00:00:00', strtotime("+ ".$day." days",strtotime($startDate)));
			$dat_end_time							=	date('Y-m-d 23:59:59', strtotime("+ ".$day." days",strtotime($startDate)));
			$SparklineGraphDaily[$num]['day']		=	date('d-M-Y', strtotime("+ ".$day." days",strtotime($startDate)));
			
			$TotalContributions	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$day_start_time)->where('created_at','<=',$dat_end_time)->sum('amount');
			
			$SparklineGraphDaily[$num]['TotalContributions']	=	!empty($TotalContributions)?$TotalContributions:0;
			
			$SparklineGraphDaily[$num]['TotalContributors']	=	User::where('user_role_id',3)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$day_start_time)->where('created_at','<=',$dat_end_time)->count('id');
			
			$num++;
		}
		
		Session::set('SparklineGraphDaily', $SparklineGraphDaily);
		
		$dateArray['startDate']	=	$startDate;
		$dateArray['endDate']	=	$endDate;
		
		Session::set('dateArray', $dateArray);
		
		return $SparklineGraphDaily; die;
		
	}
	
	public function AdminDashboard(){
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', '300');
		Session::forget('SelectDonationPlanData');
		if(Auth::user()->user_role_id != 1){
			return Redirect::to('/dashboard');				
		}
		$userId			=	Auth::user()->id;
		
		$customDateArray = Session::get('dateArray');
		
		//$allOrderIds	=	DonationOrder::where('is_deleted',0)->lists('id','id');
		$allOrderIds	=	DonationOrder::leftJoin('sub_projects', function($join) {
											  $join->on('donation_orders.sub_project_id', '=', 'sub_projects.id');
											})
											->where('sub_projects.is_deleted',0)->where('sub_projects.is_active',1)->where('donation_orders.is_deleted',0)
											->lists('donation_orders.id','donation_orders.id');
		if(!empty($customDateArray)){
			$startDate = $customDateArray['startDate'];
			$endDate = $customDateArray['endDate'];
			
			//total Contribution Funds approved
			$totalApprovedContribution	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$startDate)->where('created_at','<=',$endDate)->sum('amount');
			
			//Complete Transactions approved
			$totalApprovedTransaction	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$startDate)->where('created_at','<=',$endDate)->count('id');
			
			//Total No of Contributors
			//$totalContributors		=	User::where('user_role_id',3)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$startDate)->where('created_at','<=',$endDate)->count('id');
			$totalContributors		=	DB::table('donation_orders')->select('id')->where('is_deleted',0)->where('is_active',1)->groupBy('email')->where('created_at','>=',$startDate)->where('created_at','<=',$endDate)->get();
			$totalContributors		=	!empty($totalContributors) ? (count($totalContributors)):0;
			
			//Total Transactions all
			$totalTransactions		=	DonationPayment::whereIn('order_id',$allOrderIds)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$startDate)->where('created_at','<=',$endDate)->count('id');
		}else{
			//total Contribution Funds approved
			$totalApprovedContribution	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
			
			//Complete Transactions approved
			$totalApprovedTransaction	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->count('id');
			
			//Total No of Contributors
			//$totalContributors		=	User::where('user_role_id',3)->where('is_deleted',0)->where('is_active',1)->count('id');
			$totalContributors		=	DB::table('donation_orders')->select('id')->where('is_deleted',0)->where('is_active',1)->groupBy('email')->get();
			$totalContributors		=	!empty($totalContributors) ? (count($totalContributors)):0;
			
			//Total Transactions all
			$totalTransactions		=	DonationPayment::whereIn('order_id',$allOrderIds)->where('is_deleted',0)->where('is_active',1)->count('id');
		}		
		
		//total Contribution Funds waiting approvel
		$totalWaitingApprovalContribution	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',1)->where('is_deleted',0)->where('is_active',1)->sum('amount');
		
		//No of Contributors who contribute
		$totalPaidContributors		=	0; /* DB::table('donation_orders')->leftJoin('sub_projects', function($join) {
														  $join->on('donation_orders.sub_project_id', '=', 'sub_projects.id');
														})
														->where('sub_projects.is_deleted',0)->where('donation_orders.is_deleted',0)->where('donation_orders.is_active',1)->where('donation_orders.user_id','!=',0)->groupBy('donation_orders.email')->get(['donation_orders.id']); */
		$totalPaidContributors		=	!empty($totalPaidContributors) ? (count($totalPaidContributors)):0;
		
		if(!empty($customDateArray)){
			$startDate 	= $customDateArray['startDate'];
			$endDate 	= $customDateArray['endDate'];
			
			$startMonth		=	date("m",strtotime($startDate));
			$startYear		=	date("Y",strtotime($startDate));
			$endMonth		=	date("m",strtotime($endDate));
			$endYear		=	date("Y",strtotime($endDate));
			if($startYear == $endYear){
				$totalMonthDiff =	$endMonth - $startMonth;
			}else if($endYear > $startYear){
				$totalDiffYears	=	$endYear - $startYear;
				$totalMonthDiff = 	(12 * $totalDiffYears) - $startMonth;
			}else{
				$totalMonthDiff = 	12;
			}
			
			//Quick stat chart
			//$month	=	date('m');
			//$year	=	date('Y');
			if($totalMonthDiff > 0){
				for ($i = 0; $i < $totalMonthDiff; $i++) {
					$months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
				}
				$months				=	array_reverse($months);
				$num				=	0;
				foreach($months as $month){
					$month_start_date	=	 date('Y-m-01 00:00:00', strtotime($month));
					$month_end_date		=	 date('Y-m-t 23:59:59', strtotime($month));
					$QuickStateGraph[$num]['month']					=	date('M', strtotime($month));
					$QuickStateGraph[$num]['TotalContributions']	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->sum('amount');
					
					$QuickStateGraph[$num]['TotalApprovedTransactions']	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->count('id');
					
					$TotalContributors	=	DonationOrder::where('is_deleted',0)->where('is_active',1)->groupBy('email')->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->get();
					$QuickStateGraph[$num]['TotalContributors']	=	!empty($TotalContributors) ? (count($TotalContributors)):0;//User::where('user_role_id',3)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->count('id');;
					
					$QuickStateGraph[$num]['TotalTransactions']	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->count('id');
					
					$num++;
				}
			}else{
				$startDate		=	date("d",strtotime($startDate));
				$endDate		=	date("d",strtotime($endDate));
				
				for ($i = $startDate; $i <= $endDate; $i++) {
					$days[] = date("Y-m-d", strtotime( date( 'Y-'.$startMonth.'-d' )." -$i days"));
				}
				$days				=	array_reverse($days);
				$num				=	0;
				foreach($days as $day){
					$month_start_date	=	 date('Y-m-d 00:00:00', strtotime($day));
					$month_end_date		=	 date('Y-m-d 23:59:59', strtotime($day));
					$QuickStateGraph[$num]['month']					=	date('d-M-Y', strtotime($day));
					$QuickStateGraph[$num]['TotalContributions']	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->sum('amount');
					
					$QuickStateGraph[$num]['TotalApprovedTransactions']	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->count('id');
					
					$TotalContributors	=	DonationOrder::where('is_deleted',0)->where('is_active',1)->groupBy('email')->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->get();
					$QuickStateGraph[$num]['TotalContributors']	=	!empty($TotalContributors) ? (count($TotalContributors)):0;//User::where('user_role_id',3)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->count('id');;
					
					$QuickStateGraph[$num]['TotalTransactions']	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->count('id');
					
					$num++;
				}
			}
		}else{
			//Quick stat chart
			$month	=	date('m');
			$year	=	date('Y');
			for ($i = 0; $i < 12; $i++) {
				$months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
			}
			$months				=	array_reverse($months);
			$num				=	0;
			foreach($months as $month){
				$month_start_date	=	 date('Y-m-01 00:00:00', strtotime($month));
				$month_end_date		=	 date('Y-m-t 23:59:59', strtotime($month));
				$QuickStateGraph[$num]['month']					=	date('M', strtotime($month));
				$QuickStateGraph[$num]['TotalContributions']	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->sum('amount');
				
				$QuickStateGraph[$num]['TotalApprovedTransactions']	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->count('id');
				
				$TotalContributors	=	DonationOrder::where('is_deleted',0)->where('is_active',1)->groupBy('email')->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->count();
				$QuickStateGraph[$num]['TotalContributors']	=	!empty($TotalContributors) ? ($TotalContributors):0;//User::where('user_role_id',3)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->count('id');;
				
				$QuickStateGraph[$num]['TotalTransactions']	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->count('id');
				
				$num++;
			}
		}
		
		//Sparkline Chart 1 year
		for ($i = 0; $i < 12; $i++) {
			$months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
		}
		$months				=	array_reverse($months);
		$num				=	0;
		foreach($months as $month){
			$month_start_date					=	date('Y-m-01 00:00:00', strtotime($month));
			$month_end_date						=	date('Y-m-t 23:59:59', strtotime($month));
			$SparklineGraph[$num]['month']		=	date('F', strtotime($month));
			
			$SparklineGraph[$num]['TotalContributions']	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->sum('amount');
			
			$SparklineGraph[$num]['TotalContributors']	=	User::where('user_role_id',3)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$month_start_date)->where('created_at','<=',$month_end_date)->count('id');;
			
			$num++;
		}
		
		//Sparkline Chart 30 days
		$todayDate		=	date("Y-m-d");
		$lastDate		=	date("Y-m-d",strtotime("- 30 days"));
		for ($i = 0; $i < 30; $i++) {
			$days[] = date("Y-m-d", strtotime( date( 'Y-m-d' )." -$i days"));
		}
		$days				=	array_reverse($days);
		$num				=	0;
		foreach($days as $day){
			$day_start_time							=	date('Y-m-d 00:00:00', strtotime($day));
			$dat_end_time							=	date('Y-m-d 23:59:59', strtotime($day));
			$SparklineGraphDaily[$num]['day']		=	date('d-M-Y', strtotime($day));
			
			$SparklineGraphDaily[$num]['TotalContributions']	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$day_start_time)->where('created_at','<=',$dat_end_time)->sum('amount');
			
			$SparklineGraphDaily[$num]['TotalContributors']	=	User::where('user_role_id',3)->where('is_deleted',0)->where('is_active',1)->where('created_at','>=',$day_start_time)->where('created_at','<=',$dat_end_time)->count('id');
			
			$num++;
		}
		//pr($SparklineGraphDaily); die;
		
		//totalTargetAmout
		$totalTargetAmount = SubProject::where('is_deleted',0)->where('is_active',1)->sum('target_amount');
		
		$ansarProjectIds = SubProject::where('project_module',1)->where('is_active',1)->where('is_deleted',0)->lists('id','id');
		$specialProjectIds = SubProject::where('project_module',2)->where('is_active',1)->where('is_deleted',0)->lists('id','id');
		$danaLasteriProjectIds = SubProject::where('project_module',3)->where('is_active',1)->where('is_deleted',0)->lists('id','id');
		
		$allAnsarOrderIds	=	DonationOrder::where('is_deleted',0)->whereIn('sub_project_id',$ansarProjectIds)->lists('id','id');
		$allSpecialOrderIds	=	DonationOrder::where('is_deleted',0)->whereIn('sub_project_id',$specialProjectIds)->lists('id','id');
		$allDanaOrderIds	=	DonationOrder::where('is_deleted',0)->whereIn('sub_project_id',$danaLasteriProjectIds)->lists('id','id');
		
		/* $allOrderIds	=	DonationOrder::leftJoin('sub_projects', function($join) {
											  $join->on('donation_orders.sub_project_id', '=', 'sub_projects.id');
											})
											->where('sub_projects.is_deleted',0)->where('sub_projects.is_active',1)->where('donation_orders.is_deleted',0)
											->lists('donation_orders.id','donation_orders.id'); */
		
		if(!empty($customDateArray)){
			$startDate = $customDateArray['startDate'];
			$endDate = $customDateArray['endDate'];
			
			$ansarTotalContribution = DonationPayment::whereIn('order_id',$allAnsarOrderIds)->where('created_at','>=',$startDate)->where('created_at','<=',$endDate)->where('is_deleted',0)->where('is_active',1)->where('payment_status',2)->sum('amount');
			$specialTotalContribution = DonationPayment::whereIn('order_id',$allSpecialOrderIds)->where('created_at','>=',$startDate)->where('created_at','<=',$endDate)->where('is_deleted',0)->where('is_active',1)->where('payment_status',2)->sum('amount');
			$danaTotalContribution = DonationPayment::whereIn('order_id',$allDanaOrderIds)->where('created_at','>=',$startDate)->where('created_at','<=',$endDate)->where('is_deleted',0)->where('is_active',1)->where('payment_status',2)->sum('amount');
		}else{
			$ansarTotalContribution = DonationPayment::whereIn('order_id',$allAnsarOrderIds)->where('is_deleted',0)->where('is_active',1)->where('payment_status',2)->sum('amount');
			$specialTotalContribution = DonationPayment::whereIn('order_id',$allSpecialOrderIds)->where('is_deleted',0)->where('is_active',1)->where('payment_status',2)->sum('amount');
			$danaTotalContribution = DonationPayment::whereIn('order_id',$allDanaOrderIds)->where('is_deleted',0)->where('is_active',1)->where('payment_status',2)->sum('amount');
		}
		
		$specialProject = trans("messages.dashboard.special_project");
		$projectContributions['0'] = array('key'=>'Ansar','color'=>'brand','price'=>$ansarTotalContribution);
		$projectContributions['1'] = array('key'=>$specialProject,'color'=>'success','price'=>$specialTotalContribution);
		$projectContributions['2'] = array('key'=>'Dana Lestari','color'=>'danger','price'=>$danaTotalContribution);
		
		$price = array_column($projectContributions, 'price');
		array_multisort($price, SORT_DESC, $projectContributions);
		
		
		//recent infaq
		$recentAllOrders = DonationOrder::select('donation_orders.*',
											DB::raw("(select slug from sub_projects where id=donation_orders.sub_project_id) as sub_project_slug"),
											DB::raw("(select sub_project_name from sub_projects where id=donation_orders.sub_project_id) as sub_project_name"),
											DB::raw("(select project_module from sub_projects where id=donation_orders.sub_project_id) as project_module")
										)->whereIn('id',$allOrderIds)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','DESC')->take(10)->get();
		if(!empty($recentAllOrders)){
		  foreach($recentAllOrders as &$record){
			$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',1)->pluck('payment_status');
			if(empty($checkMainPaymentStatus)){
				$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',3)->pluck('payment_status');
				if(empty($checkMainPaymentStatus)){
					$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',5)->pluck('payment_status');
					if(empty($checkMainPaymentStatus)){
						$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',2)->pluck('payment_status');
					}
				}
			}
			$record->main_payment_status	=	$checkMainPaymentStatus;
			  
		  }
		}
	    
		//success status
		$SuccessStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',2)->lists('order_id','order_id');
		$recentSuccessOrders = DonationOrder::select('donation_orders.*',
											DB::raw("(select slug from sub_projects where id=donation_orders.sub_project_id) as sub_project_slug"),
											DB::raw("(select sub_project_name from sub_projects where id=donation_orders.sub_project_id) as sub_project_name"),
											DB::raw("(select project_module from sub_projects where id=donation_orders.sub_project_id) as project_module")
										)->whereIn('id',$allOrderIds)->where('is_deleted',0)->where('is_active',1)->whereIn('id',$SuccessStatusIds)->orderBy('created_at','DESC')->take(10)->get();
		if(!empty($recentSuccessOrders)){
		  foreach($recentSuccessOrders as &$record){
			$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',1)->pluck('payment_status');
			if(empty($checkMainPaymentStatus)){
				$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',3)->pluck('payment_status');
				if(empty($checkMainPaymentStatus)){
					$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',5)->pluck('payment_status');
					if(empty($checkMainPaymentStatus)){
						$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',2)->pluck('payment_status');
					}
				}
			}
			$record->main_payment_status	=	$checkMainPaymentStatus;
			  
		  }
		}
	  
		
		//pending status
		$PendingStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->whereNotIn('payment_status',array(1,2,4,5,6))->lists('order_id','order_id');
		$recentPendingOrders = DonationOrder::select('donation_orders.*',
											DB::raw("(select slug from sub_projects where id=donation_orders.sub_project_id) as sub_project_slug"),
											DB::raw("(select sub_project_name from sub_projects where id=donation_orders.sub_project_id) as sub_project_name"),
											DB::raw("(select project_module from sub_projects where id=donation_orders.sub_project_id) as project_module")
										)->whereIn('id',$allOrderIds)->where('is_deleted',0)->where('is_active',1)->whereIn('id',$PendingStatusIds)->orderBy('created_at','DESC')->take(30)->get();
		if(!empty($recentPendingOrders)){
		  foreach($recentPendingOrders as &$record){
			$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',1)->pluck('payment_status');
			if(empty($checkMainPaymentStatus)){
				$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',3)->pluck('payment_status');
				if(empty($checkMainPaymentStatus)){
					$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',5)->pluck('payment_status');
					if(empty($checkMainPaymentStatus)){
						$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',2)->pluck('payment_status');
					}
				}
			}
			$record->main_payment_status	=	$checkMainPaymentStatus;
			  
		  }
		}
	  
		
		//waiting Approval status
		$WaitingStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',1)->lists('order_id','order_id');
		$recentWaitingOrders = DonationOrder::select('donation_orders.*',
											DB::raw("(select slug from sub_projects where id=donation_orders.sub_project_id) as sub_project_slug"),
											DB::raw("(select sub_project_name from sub_projects where id=donation_orders.sub_project_id) as sub_project_name"),
											DB::raw("(select project_module from sub_projects where id=donation_orders.sub_project_id) as project_module")
										)->whereIn('id',$allOrderIds)->where('is_deleted',0)->where('is_active',1)->whereIn('id',$WaitingStatusIds)->orderBy('created_at','DESC')->take(30)->get();
		if(!empty($recentWaitingOrders)){
		  foreach($recentWaitingOrders as &$record){
			$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',1)->pluck('payment_status');
			if(empty($checkMainPaymentStatus)){
				$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',3)->pluck('payment_status');
				if(empty($checkMainPaymentStatus)){
					$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',5)->pluck('payment_status');
					if(empty($checkMainPaymentStatus)){
						$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',2)->pluck('payment_status');
					}
				}
			}
			$record->main_payment_status	=	$checkMainPaymentStatus;
			  
		  }
		}
	  
		//location state
		$locationStates = DonationOrder::select('postcode')->whereIn('id',$allOrderIds)->where('is_deleted',0)->where('is_active',1)->groupBy('postcode')->get()->toArray();
		if(!empty($locationStates)){
			foreach($locationStates as &$locationState){
				$totalOrders = DonationOrder::where('postcode',$locationState['postcode'])->whereIn('id',$allOrderIds)->where('is_deleted',0)->where('is_active',1)->count('id');
				$postCodeOrderIds = DonationOrder::where('postcode',$locationState['postcode'])->whereIn('id',$allOrderIds)->where('is_deleted',0)->where('is_active',1)->lists('id','id');
				$totalDonation	=	DonationPayment::whereIn('order_id',$postCodeOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
				
				$locationState['total_orders']		=	!empty($totalOrders)?$totalOrders:0;
				$locationState['total_donation']	=	!empty($totalDonation)?$totalDonation:0;
				
			}
		}
		$total_orders = array_column($locationStates, 'total_orders');

		array_multisort($total_orders, SORT_DESC, $locationStates);
		//pr($locationStates); die;
		
		return View::make('front.user.admin_dashboard', compact("totalApprovedContribution","totalApprovedTransaction","totalContributors","totalTransactions","QuickStateGraph","SparklineGraph","SparklineGraphDaily","totalTargetAmount","totalPaidContributors","recentAllOrders","recentSuccessOrders","recentPendingOrders","recentWaitingOrders","ansarTotalContribution","specialTotalContribution","danaTotalContribution","projectContributions","totalWaitingApprovalContribution","locationStates","customDateArray"));
	}
	
	public function editProfile(){
		$userDetail		=	User::find(Auth::user()->id);
		$country_list	=	DB::table('countries')->orderBy('name','ASC')->lists('name','id');
		return View::make('front.user.edit_profile',compact("userDetail","country_list"));
	}
	
	/**
* Function for update user detail
*
* @param $userId as id of user
*
* @return redirect page. 
*/
	public function updateUserProfile(){	
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
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
				'title'				=> 'required',
				'first_name'		=> 'required',
				'last_name' 		=> 'required',
				'phone' 			=> 'required',
				'address' 			=> 'required',
				'country' 			=> 'required',
				'state' 			=> 'required',
				'city' 				=> 'required',
				'zip_code' 			=> 'required',
				'email' 			=> "required|email|unique:users,email,$userId",
				'password'			=> 'required|custom_password',
				'confirm_password'  => 'required|same:password', 
				//'terms'  			=> 'required', 
				'date_of_birth'		=> 'required', 
			),
			array(
				"title.required"			=>	trans("messages.please_select_title"),
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
			$response	=	array(
				'success'		=>	false,
				'errors'		=>	$validator->errors(),
			); 
			return Response::json($response); 
			die;
		}else{ 
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
			$obj->title 			=  Input::get('title');
			$obj->phone_number		=  Input::get('phone');
			$obj->mobile 			=  Input::get('mobile');
			$obj->address 			=  Input::get('address');
			$obj->city 				=  Input::get('city');
			$obj->state 			=  Input::get('state');
			$obj->country 			=  Input::get('country');
			$obj->district 			=  Input::get('district');
			$obj->language 			=  Input::get('language');
			$obj->zip_code 			=  Input::get('zip_code');
			$obj->alternative_email =  Input::get('alternative_email');
			/* $obj->referrer_email 	=  Input::get('referrer_email');
			$obj->hear_about 		=  Input::get('hear_about'); */
			//$obj->is_approved		=  1; 
			$obj->save();
			$userId					=	$obj->id;		
			$response	=	array(
				'success'	=>	true,
			); 
			return Response::json($response); 
			die; 
		}
		
		
		
		
	}// end updateUserProfile()	
	
	public function personalInformation(){
		
		$allOrderIds	=	DonationOrder::/* leftJoin('sub_projects', function($join) {
											  $join->on('donation_orders.sub_project_id', '=', 'sub_projects.id');
											})->where('sub_projects.is_deleted',0)
											-> */ leftJoin('sub_project_default_plans', function($join) {
											  $join->on('donation_orders.sub_project_id', '=', 'sub_project_default_plans.sub_project_id');
											})->where('sub_project_default_plans.is_deleted',0)->where('donation_orders.is_deleted',0)
											->lists('donation_orders.id','donation_orders.id');
		//pr($allOrderIds); die;
		
		return View::make('front.user.personal_information',compact(null));
	}
	
	public function profileOverview(){
		
		return View::make('front.user.profile_overview',compact(""));
	}
	
	public function profileAccountInformation(){
		
		return View::make('front.user.profile_account_information',compact(""));
	}	
	
	public function profileEmailSettings(){
		
		return View::make('front.user.profile_email_settings',compact(""));
	}
	
	
	
	public function AccountAdmin(){
		if(isset($_GET['ref']) && (!empty($_GET['ref'])) && ($_GET['ref'] == 'ms')){
			Session::set('applocale','ms');
			App::setLocale('ms');
		} 
		$lang = App::getLocale();
		
		$DB							=	User::query(); 
		$idsData					=	array(); 
		$searchVariable				=	array(); 
		$selectedSort_by			=	"";
		$query_string               =   "";
		$inputGet					=	Input::get();
		if(Input::get()) {
			$searchData				=	Input::get();
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
			if(isset($searchData['sort_by'])){
				unset($searchData['sort_by']);
			}
			
			foreach($searchData as $fieldName => $fieldValue){
				if(!empty($fieldValue) || $fieldValue == 0){
				    if($fieldName == "keyword"){
						$DB->where("users.full_name",'like','%'.$fieldValue.'%');
					}else{
						$DB->where("users.$fieldName",'like','%'.$fieldValue.'%');
					}
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		
		$sortBy 					= 	(Input::get('sortBy')) ? Input::get('sortBy') : 'created_at';
	    $order  					= 	(Input::get('order')) ? Input::get('order')   : 'DESC';
		
		
		$adminLists 				= 	$DB
											->where('user_role_id',1)
											->where('id','!=',1)
											->where('is_deleted',0)
											->orderBy($sortBy, $order)
											->paginate(Config::get("Reading.records_per_page"));
		
		
		$totalAdmin = DB::table('users')->where('user_role_id',1)->where('is_deleted',0)->count('id');
		
		return View::make('front.user.account_admin',compact("adminLists","totalAdmin",'searchVariable','sortBy','order','query_string'));
	}
	
	public function accountAdminAdd(){
		
		return View::make('front.user.account_admin_add',compact(null));
	}
	
	public function accountAdminSave(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
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
				'is_active' 		=> 'required',
				'email' 			=> "required|email|unique:users,email",
				'password'			=> 'required|custom_password',
				//'confirm_password'  => 'required|same:password', 
			),
			array(
				"first_name.required"		=>	trans("Please enter your first name"),
				"last_name.required"		=>	trans("Please enter your last name"),
				"phone.required"			=>	trans("Please enter your contact number"),
				"email.required"			=>	trans('Please enter your email'),
				"email.email"				=>	trans('Please enter valid email'),
				"email.unique"				=>	trans("This email address already registered"),
				"is_active.required"		=>	trans("Please select status"),
				"password.required"			=>	trans("Please enter your password"),
				"password.custom_password"	=>	trans("Password should contain atleast 1 numeric and 1 special character with minimum 8 character long"),
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
			$obj 					=  new User;
			$obj->user_role_id		=  1; 
			$obj->first_name 		=  Input::get('first_name');
			$obj->last_name 		=  Input::get('last_name');
			$obj->full_name 		=  Input::get('first_name')." ".Input::get('last_name');
			$obj->email 			=  Input::get('email');
			$obj->password	 		=  Hash::make(Input::get('password'));
			$obj->phone				=  Input::get('phone');
			$obj->slug				=  $this->getSlug($obj->full_name,'slug','User');
			$obj->is_active			=  Input::get('is_active');
			$obj->is_verified		=  1; 
			$obj->save();
			$userId					=	$obj->id;		
			
			$adminPermissions = AdminPermission::where('is_deleted',0)->where('is_active',1)->where('user_id',$userId)->pluck('id');
			if(!empty($adminPermissions)){
				$permissionModel 				=	AdminPermission::find($adminPermissions);
			}else{
				$permissionModel 				=	new AdminPermission;				
			}
			$permissionModel->user_id			=	$userId;
			$permissionModel->dashboard			=	!empty(Input::get('dashboard'))? implode(",",Input::get('dashboard')):'';
			$permissionModel->ansar				=	!empty(Input::get('ansar_projects'))? implode(",",Input::get('ansar_projects')):'';
			$permissionModel->special_project	=	!empty(Input::get('special_projects'))? implode(",",Input::get('special_projects')):'';
			$permissionModel->dana_project		=	!empty(Input::get('dana_projects'))? implode(",",Input::get('dana_projects')):'';
			$permissionModel->template			=	!empty(Input::get('project_template'))? implode(",",Input::get('project_template')):'';
			$permissionModel->general			=	!empty(Input::get('general'))? implode(",",Input::get('general')):'';
			$permissionModel->account			=	!empty(Input::get('account'))? implode(",",Input::get('account')):'';
			$permissionModel->save();
			
			
			$err					=	array();
			$err['success']			=	1;
			$err['message']			=	trans("Admin details added successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function accountAdminEdit($slug = ""){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		
		$adminDetails = DB::table('users')->where('user_role_id',1)->where('slug',$slug)->first();
		if(empty($adminDetails)){
			Session::flash('flash_notice',  trans("Admin details not found!"));
			return redirect()->back();
		}
		
		$adminPermissions = AdminPermission::where('is_deleted',0)->where('is_active',1)->where('user_id',$adminDetails->id)->first();
		
		return View::make('front.user.account_admin_edit',compact("adminDetails","adminPermissions"));
	}
	
	public function accountAdminUpdate(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		Validator::extend('custom_password', function($attribute, $value, $parameters){
			if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
				return true;
			} else {
				return false;
			}
		});
		
		$id = Input::get('id');
		
		$validator = Validator::make(
			Input::all(),
			array(
				'first_name'		=> 'required',
				'last_name' 		=> 'required',
				'phone' 			=> 'required',
				'is_active' 		=> 'required',
				'email' 			=> "required|email|unique:users,email,$id",
				'password'			=> 'sometimes|custom_password',
				//'confirm_password'  => 'required|same:password', 
			),
			array(
				"first_name.required"		=>	trans("Please enter your first name"),
				"last_name.required"		=>	trans("Please enter your last name"),
				"phone.required"			=>	trans("Please enter your contact number"),
				"email.required"			=>	trans('Please enter your email'),
				"email.email"				=>	trans('Please enter valid email'),
				"email.unique"				=>	trans("This email address already registered"),
				"is_active.required"		=>	trans("Please select status"),
				"password.required"			=>	trans("Please enter your password"),
				"password.custom_password"	=>	trans("Password should contain atleast 1 numeric and 1 special character with minimum 8 character long"),
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
			$obj 					=  User::find(Input::get('id'));
			$obj->user_role_id		=  1; 
			$obj->first_name 		=  Input::get('first_name');
			$obj->last_name 		=  Input::get('last_name');
			$obj->full_name 		=  Input::get('first_name')." ".Input::get('last_name');
			$obj->email 			=  Input::get('email');
			if(!empty(Input::get('password'))){
				$obj->password	 		=  Hash::make(Input::get('password'));
			}
			$obj->phone				=  Input::get('phone');
			//$obj->slug				=  $this->getSlug($obj->full_name,'slug','User');
			$obj->is_active			=  Input::get('is_active');
			//$obj->is_approved		=  1; 
			$obj->save();
			$userId					=	$obj->id;		
			
			
			$adminPermissions = AdminPermission::where('is_deleted',0)->where('is_active',1)->where('user_id',$userId)->pluck('id');
			if(!empty($adminPermissions)){
				$permissionModel 				=	AdminPermission::find($adminPermissions);
			}else{
				$permissionModel 				=	new AdminPermission;				
			}
			$permissionModel->user_id			=	$userId;
			$permissionModel->dashboard			=	!empty(Input::get('dashboard'))? implode(",",Input::get('dashboard')):'';
			$permissionModel->ansar				=	!empty(Input::get('ansar_projects'))? implode(",",Input::get('ansar_projects')):'';
			$permissionModel->special_project	=	!empty(Input::get('special_projects'))? implode(",",Input::get('special_projects')):'';
			$permissionModel->dana_project		=	!empty(Input::get('dana_projects'))? implode(",",Input::get('dana_projects')):'';
			$permissionModel->template			=	!empty(Input::get('project_template'))? implode(",",Input::get('project_template')):'';
			$permissionModel->general			=	!empty(Input::get('general'))? implode(",",Input::get('general')):'';
			$permissionModel->account			=	!empty(Input::get('account'))? implode(",",Input::get('account')):'';
			$permissionModel->save();
			
			
			$err					=	array();
			$err['success']			=	1;
			$err['message']			=	trans("Admin details added successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function accountAdminDelete($slug = ""){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		$adminId = DB::table('users')->where('user_role_id',1)->where('slug',$slug)->pluck('id');
		if(!empty($adminId)){
			$currentDateTime = date("Y-m-d H:i:s",time());
			DB::table('users')->where('user_role_id',1)->where('id',$adminId)->update(array('is_deleted'=>1,'deleted_at'=>$currentDateTime));
			
			Session::flash('flash_notice',  trans("Admin deleted successfully."));
		}else{
			Session::flash('flash_notice',  trans("Admin details not found!"));
		}
		
		return redirect()->back();
	}
	
	public function accountAdminChangeStatus($slug = "", $status = 0){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		$adminId = DB::table('users')->where('user_role_id',1)->where('slug',$slug)->pluck('id');
		if(!empty($adminId)){
			if($status == 1){
				$status = 1;
				$message = trans("Admin Active Successfully.");
			}else{
				$status = 0;
				$message = trans("Admin InActive Successfully.");
			}
			
			DB::table('users')->where('user_role_id',1)->where('id',$adminId)->update(array('is_active'=>$status));
			
			Session::flash('flash_notice',  $message);
		}else{
			Session::flash('flash_notice',  trans("Admin details not found!"));
		}
		
		return redirect()->back();
	}
	
	
	
	public function AccountVendors(){
		$lang = App::getLocale();
		$DB							=	User::query(); 
		$idsData					=	array(); 
		$searchVariable				=	array(); 
		$selectedSort_by			=	"";
		$query_string               =   "";
		$inputGet					=	Input::get();
		if(Input::get()) {
			$searchData				=	Input::get();
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
			if(isset($searchData['sort_by'])){
				unset($searchData['sort_by']);
			}
			
			foreach($searchData as $fieldName => $fieldValue){
				if(!empty($fieldValue) || $fieldValue == 0){
				    if($fieldName == "keyword"){
						//$DB->where("users.full_name",'like','%'.$fieldValue.'%');
						$DB->where(function ($DB) use ($fieldValue) {
									return $DB->where('users.full_name','like','%'.$fieldValue.'%')
											  ->orWhere('users.email','like','%'.$fieldValue.'%')
											 ->orWhere('users.refrral_id','like','%'.$fieldValue.'%');
									});
					
					}else{
						$DB->where("users.$fieldName",'like','%'.$fieldValue.'%');
					}
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		
		$sortBy 					= 	(Input::get('sortBy')) ? Input::get('sortBy') : 'created_at';
	    $order  					= 	(Input::get('order')) ? Input::get('order')   : 'DESC';
		
		
		$result 					= 	$DB
											->select('users.*')
											->where('users.user_role_id',2)
											->where('users.is_deleted',0)
											->orderBy($sortBy, $order)
											->paginate(Config::get("Reading.records_per_page"));
		
		
		return View::make('front.user.account_vendors',compact('searchVariable','sortBy','order','query_string',"result"));
	}
	
	public function AccountVendorAdd(){
		
		return View::make('front.user.account_vendor_add');
	}
	
	public function AccountVendorSave(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
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
				'vendor_name'		=> 'required',
				'vendor_phone' 		=> 'required',
				'vendor_email' 		=> "required|email|unique:users,email",
				'is_active' 		=> 'required',
				//'password'			=> 'required|custom_password',
				//'confirm_password'  => 'required|same:password', 
			),
			array(
				"vendor_name.required"		=>	trans("Please enter vendor name"),
				"vendor_phone.required"		=>	trans("Please enter vendor contact number"),
				"vendor_email.required"		=>	trans('Please enter vendor email'),
				"vendor_email.email"		=>	trans('Please enter valid email'),
				"vendor_email.unique"		=>	trans("This email address already registered"),
				"password.required"			=>	trans("Please enter your password"),
				"password.custom_password"	=>	trans("Password should contain atleast 1 numeric and 1 special character with minimum 8 character long"),
				"is_active.required"		=>	trans("Please select status"),
				"payment_method.required"	=>	trans("Please select payment method"),
				"deposit.required"			=>	trans("Please enter allowed deposit per guest"),
				"commission.required"		=>	trans("Please enter commission per package"),
				"refrral_id.required"		=>	trans("Please enter refrral id"),
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
			$obj 					=  new User;
			$obj->user_role_id		=  2; 
			$obj->full_name 		=  Input::get('vendor_name');
			$obj->email 			=  Input::get('vendor_email');
			$obj->phone				=  Input::get('vendor_phone');
			$obj->short_description	=  Input::get('short_description');
			//$obj->password	 		=  Hash::make(Input::get('password'));
			//$obj->payment_method	=  !empty(Input::get('payment_method'))? implode(",",Input::get('payment_method')):'';
			//$obj->deposit			=  Input::get('deposit');
			//$obj->commission		=  Input::get('commission');
			//$obj->refrral_id		=  !empty(Input::get('refrral_id'))?Input::get('refrral_id'):'';
			$obj->slug				=  $this->getSlug($obj->full_name,'slug','User');
			$obj->is_active			=  Input::get('is_active');
			$obj->is_verified		=  1; 
			$obj->save();
			$userId					=	$obj->id;		
			
			//registration email
			$full_name			=	$obj->full_name;
			$email				=	$obj->email;
			$phone				=	$obj->phone;
			//$refferal_id		=	$obj->refrral_id;
			
			//$this->sendRegistrationEmail($email,$full_name,$phone,$refferal_id);
			
			$err					=	array();
			$err['success']			=	1;
			$err['message']			=	trans("Vendor details added successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function AccountVendorEdit($slug = ""){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		
		$userDetails = DB::table('users')->where('user_role_id',2)->where('slug',$slug)->first();
		if(empty($userDetails)){
			Session::flash('flash_notice',  trans("Vendor details not found!"));
			return redirect()->back();
		}
		
		$selectedPaymentMethod = array();
		if(!empty($userDetails->payment_method)){
			$selectedPaymentMethod = explode(",",$userDetails->payment_method);
		}
		
		return View::make('front.user.account_vendor_edit',compact("userDetails","selectedPaymentMethod"));
	}
	
	public function AccountVendorUpdate(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		Validator::extend('custom_password', function($attribute, $value, $parameters){
			if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
				return true;
			} else {
				return false;
			}
		});
		
		$id = Input::get('id');
		
		$validator = Validator::make(
			Input::all(),
			array(
				'vendor_name'		=> 'required',
				'phone' 			=> 'required',
				'vendor_email' 		=> "required|email|unique:users,email,$id",
				//'password'			=> 'sometimes|custom_password',
				//'confirm_password'  => 'required|same:password', 
				'is_active' 		=> 'required',
				//'payment_method' 	=> 'required',
				//'deposit' 			=> 'required',
				//'commission' 		=> 'required',
				//'refrral_id' 		=> 'required',
			),
			array(
				"vendor_name.required"		=>	trans("Please enter sales person name"),
				"phone.required"			=>	trans("Please enter sales person contact number"),
				"vendor_email.required"		=>	trans('Please enter sales person email'),
				"vendor_email.email"		=>	trans('Please enter valid email'),
				"vendor_email.unique"		=>	trans("This email address already registered"),
				"password.required"			=>	trans("Please enter your password"),
				"password.custom_password"	=>	trans("Password should contain atleast 1 numeric and 1 special character with minimum 8 character long"),
				"is_active.required"		=>	trans("Please select status"),
				"payment_method.required"	=>	trans("Please select payment method"),
				"deposit.required"			=>	trans("Please enter allowed deposit per guest"),
				"commission.required"		=>	trans("Please enter commission per package"),
				"refrral_id.required"		=>	trans("Please enter refrral id"),
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
			$obj 					=  User::find(Input::get('id'));
			$obj->user_role_id		=  2; 
			$obj->full_name 		=  Input::get('vendor_name');
			$obj->email 			=  Input::get('vendor_email');
			$obj->phone				=  Input::get('phone');
			$obj->short_description	=  Input::get('short_description');
			//$obj->payment_method	=  !empty(Input::get('payment_method'))? implode(",",Input::get('payment_method')):'';
			//$obj->deposit			=  Input::get('deposit');
			//$obj->commission		=  Input::get('commission');
			//$obj->refrral_id		=  !empty(Input::get('refrral_id'))?Input::get('refrral_id'):'';
			$obj->is_active			=  Input::get('is_active');
			if(!empty(Input::get('password'))){
				$obj->password	 		=  Hash::make(Input::get('password'));
			}
			//$obj->slug				=  $this->getSlug($obj->vendor_name,'slug','User');
			//$obj->is_approved		=  1; 
			$obj->save();
			$userId					=	$obj->id;		
			
			$err					=	array();
			$err['success']			=	1;
			$err['message']			=	trans("Vendor details updated successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function AccountVendorDelete($slug = ""){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		$userId = DB::table('users')->where('user_role_id',2)->where('slug',$slug)->pluck('id');
		if(!empty($userId)){
			$currentDateTime = date("Y-m-d H:i:s",time());
			DB::table('users')->where('user_role_id',2)->where('id',$userId)->update(array('is_deleted'=>1,'deleted_at'=>$currentDateTime));
			
			Session::flash('flash_notice',  trans("Vendor deleted successfully."));
		}else{
			Session::flash('flash_notice',  trans("Vendor details not found!"));
		}
		
		return redirect()->back();
	}
	
	public function AccountVendorChangeStatus($slug = "", $status = 0){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		$userId = DB::table('users')->where('user_role_id',2)->where('slug',$slug)->pluck('id');
		if(!empty($userId)){
			if($status == 1){
				$status = 1;
				$message = trans("Vendor Active Successfully.");
			}else{
				$status = 0;
				$message = trans("Vendor InActive Successfully.");
			}
			
			DB::table('users')->where('user_role_id',2)->where('id',$userId)->update(array('is_active'=>$status));
			
			Session::flash('flash_notice',  $message);
		}else{
			Session::flash('flash_notice',  trans("Vendor details not found!"));
		}
		
		return redirect()->back();
	}
	
	
	public function AccountContributor(){
		$lang = App::getLocale();
		$DB							=	DonationOrder::query(); 
		$idsData					=	array(); 
		$searchVariable				=	array(); 
		$selectedSort_by			=	"";
		$query_string               =   "";
		$inputGet					=	Input::get();
		if(Input::get()) {
			$searchData				=	Input::get();
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
			if(isset($searchData['sort_by'])){
				unset($searchData['sort_by']);
			}
			
			foreach($searchData as $fieldName => $fieldValue){
				if(!empty($fieldValue) || $fieldValue == 0){
				    if($fieldName == "keyword"){
						//$DB->where("users.full_name",'like','%'.$fieldValue.'%');
						$DB->where(function ($DB) use ($fieldValue) {
									return $DB->where('users.full_name','like','%'.$fieldValue.'%')
											  ->orWhere('users.email','like','%'.$fieldValue.'%')
											 ->orWhere('users.refrral_id','like','%'.$fieldValue.'%');
									});
					
					}else{
						$DB->where("users.$fieldName",'like','%'.$fieldValue.'%');
					}
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		
		$sortBy 					= 	(Input::get('sortBy')) ? Input::get('sortBy') : 'users.created_at';
	    $order  					= 	(Input::get('order')) ? Input::get('order')   : 'DESC';
		
		
		$result 					= 	$DB->leftJoin('users', function($join) {
											  $join->on('users.id', '=', 'donation_orders.user_id');
											  $join->where('users.user_role_id','=',3) ;
											  $join->where('users.is_deleted','=',0) ;
											})->select('donation_orders.*','users.user_role_id','users.full_name as user_full_name','users.phone as user_phone','users.email as user_email','users.is_active','users.created_at','users.slug')
											//->select('donation_orders.user_id','donation_orders.full_name','donation_orders.phone','donation_orders.email','users.id','users.user_role_id','users.is_deleted','users.full_name','users.phone','users.email','users.is_active','users.created_at')
											//->where('users.user_role_id',3)
											//->where('users.is_deleted',0)
											->where('donation_orders.is_deleted',0)
											->where('donation_orders.is_active',1)
											->orderBy($sortBy, $order)
											->groupBy('donation_orders.email')
											->paginate(Config::get("Reading.records_per_page"));
		
		//pr($result); die;
		
		return View::make('front.user.account_contributors',compact('searchVariable','sortBy','order','query_string',"result"));
	}
	
	public function AccountContributorAdd(){
		
		return View::make('front.user.account_contributor_add');
	}
	
	public function AccountContributorSave(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
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
				'full_name'			=> 'required',
				'phone' 			=> 'required',
				'email' 			=> "required|email|unique:users,email",
				'password'			=> 'required|custom_password',
				//'confirm_password'  => 'required|same:password', 
				'is_active' 		=> 'required',
			),
			array(
				"full_name.required"		=>	trans("Please enter contributor name"),
				"phone.required"			=>	trans("Please enter contributor contact number"),
				"email.required"			=>	trans('Please enter contributor email'),
				"email.email"				=>	trans('Please enter valid email'),
				"email.unique"				=>	trans("This email address already registered"),
				"password.required"			=>	trans("Please enter your password"),
				"password.custom_password"	=>	trans("Password should contain atleast 1 numeric and 1 special character with minimum 8 character long"),
				"is_active.required"		=>	trans("Please select status"),
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
			$obj 					=  new User;
			$obj->user_role_id		=  3; 
			$obj->full_name 		=  Input::get('full_name');
			$obj->email 			=  Input::get('email');
			$obj->phone				=  Input::get('phone');
			$obj->password	 		=  Hash::make(Input::get('password'));
			$obj->slug				=  $this->getSlug($obj->full_name,'slug','User');
			$obj->is_active			=  Input::get('is_active');
			$obj->is_verified		=  1; 
			$obj->save();
			$userId					=	$obj->id;		
			
			//registration email
			$full_name			=	$obj->full_name;
			$email				=	$obj->email;
			$phone				=	$obj->phone;
			//$refferal_id		=	$obj->refrral_id;
			
			//$this->sendRegistrationEmail($email,$full_name,$phone,$refferal_id);
			
			$err					=	array();
			$err['success']			=	1;
			$err['message']			=	trans("Contributor details added successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function AccountContributorEdit($slug = ""){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		
		$userDetails = DB::table('users')->where('user_role_id',3)->where('slug',$slug)->first();
		if(empty($userDetails)){
			Session::flash('flash_notice',  trans("Contributor details not found!"));
			return redirect()->back();
		}
		
		return View::make('front.user.account_contributor_edit',compact("userDetails"));
	}
	
	public function AccountContributorUpdate(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		Validator::extend('custom_password', function($attribute, $value, $parameters){
			if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
				return true;
			} else {
				return false;
			}
		});
		
		$id = Input::get('id');
		
		$validator = Validator::make(
			Input::all(),
			array(
				'full_name'			=> 'required',
				'phone' 			=> 'required',
				'email' 			=> "required|email|unique:users,email,$id",
				'password'			=> 'sometimes|custom_password',
				//'confirm_password'  => 'required|same:password', 
				'is_active' 		=> 'required',
			),
			array(
				"full_name.required"		=>	trans("Please enter contributor name"),
				"phone.required"			=>	trans("Please enter contributor contact number"),
				"email.required"			=>	trans('Please enter contributor email'),
				"email.email"				=>	trans('Please enter valid email'),
				"email.unique"				=>	trans("This email address already registered"),
				"password.required"			=>	trans("Please enter your password"),
				"password.custom_password"	=>	trans("Password should contain atleast 1 numeric and 1 special character with minimum 8 character long"),
				"is_active.required"		=>	trans("Please select status"),
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
			$obj 					=  User::find(Input::get('id'));
			$obj->user_role_id		=  3; 
			$obj->full_name 		=  Input::get('full_name');
			$obj->email 			=  Input::get('email');
			$obj->phone				=  Input::get('phone');
			$obj->is_active			=  Input::get('is_active');
			if(!empty(Input::get('password'))){
				$obj->password	 		=  Hash::make(Input::get('password'));
			}
			//$obj->slug				=  $this->getSlug($obj->full_name,'slug','User');
			//$obj->is_approved		=  1; 
			$obj->save();
			$userId					=	$obj->id;		
			
			$err					=	array();
			$err['success']			=	1;
			$err['message']			=	trans("Contributor details updated successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function AccountContributorDelete($slug = ""){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		$userId = DB::table('users')->where('user_role_id',3)->where('slug',$slug)->pluck('id');
		if(!empty($userId)){
			$currentDateTime = date("Y-m-d H:i:s",time());
			DB::table('users')->where('user_role_id',3)->where('id',$userId)->update(array('is_deleted'=>1,'deleted_at'=>$currentDateTime));
			
			Session::flash('flash_notice',  trans("Contributor deleted successfully."));
		}else{
			Session::flash('flash_notice',  trans("Contributor details not found!"));
		}
		
		return redirect()->back();
	}
	
	public function AccountContributorChangeStatus($slug = "", $status = 0){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		$userId = DB::table('users')->where('user_role_id',3)->where('slug',$slug)->pluck('id');
		if(!empty($userId)){
			if($status == 1){
				$status = 1;
				$message = trans("Contributor Active Successfully.");
			}else{
				$status = 0;
				$message = trans("Contributor InActive Successfully.");
			}
			
			DB::table('users')->where('user_role_id',3)->where('id',$userId)->update(array('is_active'=>$status));
			
			Session::flash('flash_notice',  $message);
		}else{
			Session::flash('flash_notice',  trans("Contributor details not found!"));
		}
		
		return redirect()->back();
	}
	
	
	
	
	//DONE//
	public function GeneralCmsPages(){
		Session::forget('CmsImages');
		$lang = App::getLocale();
		$DB							=	Cms::query(); 
		$idsData					=	array(); 
		$searchVariable				=	array(); 
		$selectedSort_by			=	"";
		$query_string               =   "";
		$inputGet					=	Input::get();
		if(Input::get()) {
			$searchData				=	Input::get();
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
			if(isset($searchData['sort_by'])){
				unset($searchData['sort_by']);
			}
			
			foreach($searchData as $fieldName => $fieldValue){
				if(!empty($fieldValue) || $fieldValue == 0){
				    if($fieldName == "keyword"){
						$DB->where(function ($DB) use ($fieldValue) {
									return $DB->where('cms_pages.page_name','like','%'.$fieldValue.'%');
											  //->orWhere('cms_pages.email','like','%'.$fieldValue.'%')
											  //->orWhere('cms_pages.phone','like','%'.$fieldValue.'%');
									});
					
						//$DB->where("cms_pages.name",'like','%'.$fieldValue.'%');
					}else{
						$DB->where("cms_pages.$fieldName",'like','%'.$fieldValue.'%');
					}
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		
		$sortBy 					= 	(Input::get('sortBy')) ? Input::get('sortBy') : 'id';
	    $order  					= 	(Input::get('order')) ? Input::get('order')   : 'ASC';
		
		
		$result 					= 	$DB
											->where('is_deleted',0)
											->orderBy($sortBy, $order)
											->paginate(Config::get("Reading.records_per_page"));
		
		
		return View::make('front.user.general_cms_pages',compact("result",'searchVariable','sortBy','order','query_string'));
	}
	
	public function GeneralCmsPagesAdd(){
		Session::forget('CmsImages');
		$projectLists = DB::table('project_modules')->where('is_deleted',0)->where('is_active',1)->lists('name','id');
		$SubProjectRows = DB::table('subproject_rows')->where('is_deleted',0)->where('is_active',1)->lists('name','id');
		
		return View::make('front.user.general_cms_pages_add',compact("projectLists","SubProjectRows"));
	}
	
	public function GeneralCmsPagesSave(){
		//Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'page_name'					=> 'required',
				'slug' 						=> 'required|unique:cms_pages,slug',
				'theme'						=> 'required',
				'title'						=> 'required',
				'title_ms'					=> 'required',
				'sub_title'					=> 'required',
				'sub_title_ms'				=> 'required',
				'font_color'				=> 'required',
				'body'						=> 'required',
				'body_ms'					=> 'required',
				//'project'					=> 'required',
				'sub_project_row'			=> 'required',
				'footer_body'				=> 'required',
				'footer_body_ms'			=> 'required',
				'contactus_status'			=> 'required',
				'meta_title'				=> 'required',
				'meta_keyword'				=> 'required',
				'meta_description'			=> 'required',
			),
			array(
				
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
			$model 							=  new Cms;
			$model->page_name 				=  Input::get('page_name');
			$model->theme 					=  Input::get('theme');
			$model->title 					=  Input::get('title');
			$model->title_ms 				=  Input::get('title_ms');
			$model->sub_title 				=  Input::get('sub_title');
			$model->sub_title_ms 			=  Input::get('sub_title_ms');
			$model->font_color 				=  Input::get('font_color');
			$model->body 					=  Input::get('body');
			$model->body_ms 				=  Input::get('body_ms');
			$model->project 				=  Input::get('project');
			$model->arrangement 			=  Input::get('arrangement');
			$model->sub_project_row 		=  Input::get('sub_project_row');
			$model->footer_body 			=  Input::get('footer_body');
			$model->footer_body_ms 			=  Input::get('footer_body_ms');
			$model->contactus_status 		=  Input::get('contactus_status');
			$model->meta_title 				=  Input::get('meta_title');
			$model->meta_keywords 			=  Input::get('meta_keyword');
			$model->meta_description 		=  Input::get('meta_description');
			$model->slug					=  Input::get('slug');
			$model->is_active				=  1;
			$model->save();
			$modelId						=	$model->id;		
			
			$images = Session::get('CmsImages');
			if(!empty($images)){
				foreach($images as $image){
				  if(!empty($image)){
					$ImageModel 						=  new CmsImage;
					$ImageModel->cms_id					=	$modelId;
					$ImageModel->image					=	$image;
					$ImageModel->is_active				=  1;
					$ImageModel->save();
				  }
				}
			}
			
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Cms page added successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function UploadCmsImages(){
		//Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'file'						=> 'required|image',
			),
			array(
				
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
			//$model 							=  new CmsImage;
			
			// $model->is_active				=  1;
			// $model->save();
			// $modelId						=	$model->id;		
			
			if(!empty(Input::file('file'))){
				$file_name 			=	str_replace(" ","_",Input::file('file')->getClientOriginalName());
				$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
				$folderPath			=	CMS_IMG_ROOT_PATH.'/'.$newFolder; 
				if(!File::exists($folderPath)){
					File::makeDirectory($folderPath, $mode = 0777,true);
				}
				
				$image	=	$newFolder.$file_name;
				if(Input::file('file')->move($folderPath, $file_name)){
					
					$images = Session::get('CmsImages');
					
					$images[$file_name] = $image;
					
					Session::set('CmsImages', $images);
					
					$err						=	array();
					$err['success']				=	1;
					$err['message']				=	trans("Cms image added successfully.");
					return Response::json($err); 
					die;
				}
				
			}
			
			$err						=	array();
			$err['error']				=	1;
			$err['message']				=	trans("Cms image not uploaded.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function DeleteCmsImages(){
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'id'						=> 'required',
			),
			array(
				'id.required'	=> 'Image Not found.'
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
			$imageKey = $thisData['id'];
			
			$images = Session::get('CmsImages');
			
			$image_path = CMS_IMG_URL.$images[$imageKey];
			
			if(File::exists($image_path)) {
				File::delete($image_path);
			}
			unset($images[$imageKey]);
			Session::set('CmsImages', $images);
			
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Image deleted.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function DeleteCmsImage(){
		if(!empty(Input::get('imageId'))) {
			$imageId = Input::get('imageId');
		
			$imageName = CmsImage::where('id',$imageId)->pluck('image');
			
			$image_path = CMS_IMG_ROOT_PATH.$imageName;
			
			CmsImage::where('id',$imageId)->delete();
			
			if(File::exists($image_path)) {
				File::delete($image_path);
			}
			
		}
		
		echo "1"; die;
	}
	
	public function GeneralCmsPagesEdit($slug = ""){
		Session::forget('CmsImages');
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		
		$results = DB::table('cms_pages')->where('slug',$slug)->first();
		if(empty($results)){
			Session::flash('flash_notice',  trans("Cms Page not found!"));
			return redirect()->back();
		}
		
		$projectLists = DB::table('project_modules')->where('is_deleted',0)->where('is_active',1)->lists('name','id');
		$SubProjectRows = DB::table('subproject_rows')->where('is_deleted',0)->where('is_active',1)->lists('name','id');
		$sliderImages = CmsImage::where('cms_id',$results->id)->where('is_active',1)->get();
		
		return View::make('front.user.general_cms_pages_edit',compact("results","projectLists","SubProjectRows","sliderImages"));
	}
	
	public function GeneralCmsPagesUpdate(){
		//Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$id = Input::get('id');
		
		$validator = Validator::make(
			Input::all(),
			array(
				'page_name'					=> 'required',
				'slug' 						=> "required|unique:cms_pages,slug,$id",
				'theme'						=> 'required',
				'title'						=> 'required',
				'title_ms'					=> 'required',
				'sub_title'					=> 'required',
				'sub_title_ms'				=> 'required',
				'font_color'				=> 'required',
				'body'						=> 'required',
				'body_ms'					=> 'required',
				//'project'					=> 'required',
				'sub_project_row'			=> 'required',
				'footer_body'				=> 'required',
				'footer_body_ms'			=> 'required',
				'contactus_status'			=> 'required',
				'meta_title'				=> 'required',
				'meta_keyword'				=> 'required',
				'meta_description'			=> 'required',
			),
			array(
				"name.required"				=>	trans("Please enter sale type name"),
				"phone.required"			=>	trans("Please enter branch contact number"),
				"email.required"			=>	trans("Please enter branch email"),
				"email.email"				=>	trans('Please enter valid email'),
				"email.unique"				=>	trans("This email address already registered"),
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
			$model 							=  Cms::find(Input::get('id'));
			$model->page_name 				=  Input::get('page_name');
			$model->theme 					=  Input::get('theme');
			$model->title 					=  Input::get('title');
			$model->title_ms 				=  Input::get('title_ms');
			$model->sub_title 				=  Input::get('sub_title');
			$model->sub_title_ms 			=  Input::get('sub_title_ms');
			$model->font_color 				=  Input::get('font_color');
			$model->body 					=  Input::get('body');
			$model->body_ms 				=  Input::get('body_ms');
			$model->project 				=  Input::get('project');
			$model->arrangement 			=  Input::get('arrangement');
			$model->sub_project_row 		=  Input::get('sub_project_row');
			$model->footer_body 			=  Input::get('footer_body');
			$model->footer_body_ms 			=  Input::get('footer_body_ms');
			$model->contactus_status 		=  Input::get('contactus_status');
			$model->meta_title 				=  Input::get('meta_title');
			$model->meta_keywords 			=  Input::get('meta_keyword');
			$model->meta_description 		=  Input::get('meta_description');
			$model->slug					=  Input::get('slug');
			$model->is_active				=  1;
			$model->save();
			$modelId						=	$model->id;		
			
			$images = Session::get('CmsImages');
			if(!empty($images)){
				foreach($images as $image){
				  if(!empty($image)){
					$ImageModel 						=  new CmsImage;
					$ImageModel->cms_id					=	$modelId;
					$ImageModel->image					=	$image;
					$ImageModel->is_active				=  1;
					$ImageModel->save();
				  }
				}
			}
			
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Cms Page updated successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function GeneralCmsPagesDelete($slug = ""){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		$branchId = DB::table('cms_pages')->where('slug',$slug)->pluck('id');
		if(!empty($branchId)){
			DB::table('cms_pages')->where('id',$branchId)->update(array('is_deleted'=>1));
			
			Session::flash('flash_notice',  trans("Cms Page deleted successfully."));
		}else{
			Session::flash('flash_notice',  trans("Cms Page details not found!"));
		}
		
		return redirect()->back();
	}
	
	public function GeneralCmsPagesChangeStatus($slug = "", $status = 0){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		$branchId = DB::table('cms_pages')->where('slug',$slug)->pluck('id');
		if(!empty($branchId)){
			if($status == 1){
				$status = 1;
				$message = trans("Cms Page Active Successfully.");
			}else{
				$status = 0;
				$message = trans("Cms Page InActive Successfully.");
			}
			
			DB::table('cms_pages')->where('id',$branchId)->update(array('is_active'=>$status));
			
			Session::flash('flash_notice',  $message);
		}else{
			Session::flash('flash_notice',  trans("Cms Page details not found!"));
		}
		
		return redirect()->back();
	}
	
	
	
	//DONE//
	public function Projects(){
		$lang = App::getLocale();
		$DB							=	ProjectModule::query(); 
		$idsData					=	array(); 
		$searchVariable				=	array(); 
		$selectedSort_by			=	"";
		$inputGet					=	Input::get();
		if(Input::get()) {
			$searchData				=	Input::get();
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
			if(isset($searchData['sort_by'])){
				unset($searchData['sort_by']);
			}
			
			foreach($searchData as $fieldName => $fieldValue){
				if(!empty($fieldValue) || $fieldValue == 0){
				    if($fieldName == "keyword"){
						$DB->where("name",'like','%'.$fieldValue.'%');
					}else{
						$DB->where("$fieldName",'like','%'.$fieldValue.'%');
					}
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		
		$sortBy 					= 	(Input::get('sortBy')) ? Input::get('sortBy') : 'created_at';
	    $order  					= 	(Input::get('order')) ? Input::get('order')   : 'DESC';
		
		
		$result 					= 	$DB
											->where('is_deleted',0)
											->orderBy($sortBy, $order)
											->paginate(Config::get("Reading.records_per_page"));
		
		return View::make('front.user.project',compact("result",'searchVariable','sortBy','order'));
	}
	
	public function ProjectAdd(){
		
		return View::make('front.user.project_add',compact(""));
	}
	
	public function ProjectSave(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'name'				=> 'required',
			),
			array(
				"name.required"		=>	trans("Please enter project name"),
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
			$model 						=  new ProjectModule;
			$model->name 				=  Input::get('name');
			$model->slug				=  $this->getSlug($model->name,'name','ProjectModule');
			$model->is_active			=  1;
			$model->save();
			$modelId					=	$model->id;		
			
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Project added successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function ProjectEdit($slug = ""){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		
		$result = ProjectModule::where('slug',$slug)->first();
		if(empty($result)){
			Session::flash('flash_notice',  trans("Project not found!"));
			return redirect()->back();
		}
		
		return View::make('front.user.project_edit',compact("result"));
	}
	
	public function ProjectUpdate(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$id = Input::get('id');
		
		$validator = Validator::make(
			Input::all(),
			array(
				'name'				=> 'required',
			),
			array(
				"name.required"		=>	trans("Please enter package name"),
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
			$model 						=  ProjectModule::find(Input::get('id'));
			$model->name 				=  Input::get('name');
			$model->is_active			=  1;
			$model->save();
			$modelId					=	$model->id;		
			
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Project updated successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function ProjectDelete($slug = ""){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		$modelId = ProjectModule::where('slug',$slug)->pluck('id');
		if(!empty($modelId)){
			ProjectModule::where('id',$modelId)->update(array('is_deleted'=>1));
			
			Session::flash('flash_notice',  trans("Project deleted successfully."));
		}else{
			Session::flash('flash_notice',  trans("Project details not found!"));
		}
		
		return redirect()->back();
	}
	
	public function ProjectChangeStatus($slug = "", $status = 0){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		$modelId = ProjectModule::where('slug',$slug)->pluck('id');
		if(!empty($modelId)){
			if($status == 1){
				$status = 1;
				$message = trans("Project Active Successfully.");
			}else{
				$status = 0;
				$message = trans("Project InActive Successfully.");
			}
			
			ProjectModule::where('id',$modelId)->update(array('is_active'=>$status));
			
			Session::flash('flash_notice',  $message);
		}else{
			Session::flash('flash_notice',  trans("Project details not found!"));
		}
		
		return redirect()->back();
	}
	
	
	
	//DONE//
	public function GeneralEmailTempEdit(){
		
		return View::make('front.user.general_email_temp_edit',compact(""));
	}
	
	public function GeneralEmailTemplate(){
		
		return View::make('front.user.general_email_template',compact(""));
	}
	
	public function GeneralPdfTemplate(){
		
		return View::make('front.user.general_pdf_template',compact(""));
	}
	
	public function GeneralPdfTempEdit(){
		
		return View::make('front.user.general_pdf_temp_edit',compact(""));
	}
	
	
	
	//DONE//
	public function GeneralSetting(){
		
		$settingResult = GeneralSetting::find(1);
		
		/* $offlinePaymentOptions = array();
		if(!empty($settingResult)){
			$offlinePaymentOptions = !empty($settingResult->offline_payment_option) ? explode(",",$settingResult->offline_payment_option):'';
		} */
		
		$offlinePaymentOptions	=	PaymentOption::where('is_active',1)->where('type','=','offline')->orderBy('id','ASC')->get();
		
		return View::make('front.user.general_setting',compact("settingResult","offlinePaymentOptions"));
	}
	
	public function SaveGeneralSetting(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'business_name'					=> 'required',
				'business_address' 				=> 'required',
				'business_email' 				=> 'required',
				'business_contact' 				=> 'required',
				'business_url' 					=> 'required',
				'pending_payment_auto_cancel' 	=> 'required',
				'first_payment_reminder' 		=> 'required',
				'second_payment_reminder' 		=> 'required',
				'third_payment_reminder' 		=> 'required',
				'meta_title' 					=> 'required',
				//'meta_keyword' 					=> 'required',
				//'meta_description' 				=> 'required',
				//'logo' 						=> 'required|mimes:png',
				//'favicon' 					=> 'required|mimes:png',
			),
			array(
				// "name.required"				=>	trans("Please enter sale type name"),
				// "phone.required"			=>	trans("Please enter branch contact number"),
				// "email.required"			=>	trans("Please enter branch email"),
				// "email.email"				=>	trans('Please enter valid email'),
				// "email.unique"				=>	trans("This email address already registered"),
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
			$model 					=  GeneralSetting::find(1);
			
			if(!empty(Input::file('logo'))){
				//$extension 			=	Input::file('itinery_file')->getClientOriginalExtension();
				$file_name 			=	str_replace(" ","_",Input::file('logo')->getClientOriginalName());
				$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
				$folderPath			=	SYSTEM_IMAGE_DIRECTROY_PATH.'/'.$newFolder; 
				if(!File::exists($folderPath)){
					File::makeDirectory($folderPath, $mode = 0777,true);
				}
				
				$model->logo	=	$newFolder.$file_name;
				Input::file('logo')->move($folderPath, $file_name);
				
			}
			
			if(!empty(Input::file('logo_backend'))){
				//$extension 			=	Input::file('itinery_file')->getClientOriginalExtension();
				$file_name 			=	time().str_replace(" ","_",Input::file('logo_backend')->getClientOriginalName());
				$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
				$folderPath			=	SYSTEM_IMAGE_DIRECTROY_PATH.'/'.$newFolder; 
				if(!File::exists($folderPath)){
					File::makeDirectory($folderPath, $mode = 0777,true);
				}
				
				$model->logo_backend	=	$newFolder.$file_name;
				Input::file('logo_backend')->move($folderPath, $file_name);
				
			}
			
			if(!empty(Input::file('logo_invoice'))){
				//$extension 			=	Input::file('itinery_file')->getClientOriginalExtension();
				$file_name 			=	time().str_replace(" ","_",Input::file('logo_invoice')->getClientOriginalName());
				$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
				$folderPath			=	SYSTEM_IMAGE_DIRECTROY_PATH.'/'.$newFolder; 
				if(!File::exists($folderPath)){
					File::makeDirectory($folderPath, $mode = 0777,true);
				}
				
				$model->logo_invoice	=	$newFolder.$file_name;
				Input::file('logo_invoice')->move($folderPath, $file_name);
				
			}
			
			if(!empty(Input::file('favicon'))){
				//$extension 			=	Input::file('itinery_file')->getClientOriginalExtension();
				$file_name 			=	str_replace(" ","_",Input::file('favicon')->getClientOriginalName());
				$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
				$folderPath			=	SYSTEM_IMAGE_DIRECTROY_PATH.'/'.$newFolder; 
				if(!File::exists($folderPath)){
					File::makeDirectory($folderPath, $mode = 0777,true);
				}
				
				$model->favicon	=	$newFolder.$file_name;
				Input::file('favicon')->move($folderPath, $file_name);
				
			}
			
			$model->business_name 				=  Input::get('business_name');
			$model->business_address 			=  Input::get('business_address');
			$model->business_email 				=  Input::get('business_email');
			$model->business_contact 			=  Input::get('business_contact');
			$model->business_url 				=  Input::get('business_url');
			$model->pending_payment_auto_cancel =  Input::get('pending_payment_auto_cancel');
			$model->first_payment_reminder 		=  Input::get('first_payment_reminder');
			$model->second_payment_reminder 	=  Input::get('second_payment_reminder');
			$model->third_payment_reminder 		=  Input::get('third_payment_reminder');
			$model->analytics 					=  Input::get('analytics');
			$model->meta_title 					=  Input::get('meta_title');
			//$model->meta_keyword 				=  Input::get('meta_keyword');
			//$model->meta_description 			=  Input::get('meta_description');
			$model->save();
			$modelId					=	$model->id;		
			
			$this->settingFileWrite();
			
			//Session::flash('success', trans("messages.session_has_been_booked"));
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("General Settings saved successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function SaveGeneralEmailSetting(){
		//Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'mail_type'				=> 'required',
				'sender_mail' 			=> 'required',
				'smtp_security' 		=> 'required',
				'mail_host' 			=> 'required',
				'mail_port' 			=> 'required',
				'mail_user_name' 		=> 'required',
				'mail_user_password' 	=> 'required',
				'mailer_name' 			=> 'required',
				'email_header' 			=> 'required',
				'email_footer' 			=> 'required',
			),
			array(
				// "name.required"				=>	trans("Please enter sale type name"),
				// "phone.required"			=>	trans("Please enter branch contact number"),
				// "email.required"			=>	trans("Please enter branch email"),
				// "email.email"				=>	trans('Please enter valid email'),
				// "email.unique"				=>	trans("This email address already registered"),
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
			$model 							=  GeneralSetting::find(1);
			
			$model->mail_type 				=  Input::get('mail_type');
			$model->sender_mail 			=  Input::get('sender_mail');
			$model->smtp_security 			=  Input::get('smtp_security');
			$model->mail_host 				=  Input::get('mail_host');
			$model->mail_port 				=  Input::get('mail_port');
			$model->mail_user_name 			=  Input::get('mail_user_name');
			$model->mail_user_password 		=  Input::get('mail_user_password');
			$model->mailer_name 			=  Input::get('mailer_name');
			$model->email_header 			=  Input::get('email_header');
			$model->email_footer 			=  Input::get('email_footer');
			$model->save();
			$modelId						=	$model->id;		
			
			$this->settingFileWrite();
			
			//Session::flash('success', trans("messages.session_has_been_booked"));
			$err						=	array();
			$err['success']				=	1;
			$err['packageId']			=	$modelId;
			$err['message']				=	trans("Email Settings saved successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function SaveGeneralSmsSetting(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'api_endpoint'		=> 'required',
				'api_username' 		=> 'required',
				'api_password' 		=> 'required',
			),
			array(
				// "name.required"				=>	trans("Please enter sale type name"),
				// "phone.required"			=>	trans("Please enter branch contact number"),
				// "email.required"			=>	trans("Please enter branch email"),
				// "email.email"				=>	trans('Please enter valid email'),
				// "email.unique"				=>	trans("This email address already registered"),
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
			$model 						=  GeneralSetting::find(1);
			
			$model->api_endpoint 		=  Input::get('api_endpoint');
			$model->api_username 		=  Input::get('api_username');
			$model->api_password 		=  Input::get('api_password');
			$model->receiver_number 	=  Input::get('receiver_number');
			$model->save();
			$modelId					=	$model->id;		
			
			$this->settingFileWrite();
			
			//Session::flash('success', trans("messages.session_has_been_booked"));
			$err						=	array();
			$err['success']				=	1;
			$err['packageId']			=	$modelId;
			$err['message']				=	trans("SMS Settings saved successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function SavePaymentSetting(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$PaymentOption					=	!empty($thisData['Offline'])?$thisData['Offline']:'';
		$userId							=	Auth::user()->id;
		//pr($PaymentOption); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'payment_secret_key'			=> 'required',
				'payment_collection_id' 		=> 'required',
			),
			array(
				// "name.required"				=>	trans("Please enter sale type name"),
				// "phone.required"			=>	trans("Please enter branch contact number"),
				// "email.required"			=>	trans("Please enter branch email"),
				// "email.email"				=>	trans('Please enter valid email'),
				// "email.unique"				=>	trans("This email address already registered"),
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
			$model 									=  GeneralSetting::find(1);
			
			$model->payment_secret_key 				=  Input::get('payment_secret_key');
			$model->payment_collection_id 			=  Input::get('payment_collection_id');
			$model->payment_description 			=  Input::get('payment_description');
			$model->offline_payment_option 			=  !empty(Input::get('offline_payment_option'))? implode(",",Input::get('offline_payment_option')):'';
			$model->save();
			$modelId					=	$model->id;		
			
			if(!empty(Input::get('payment_description'))){
				$paymentOptionModel					=	PaymentOption::find(5);
				$paymentOptionModel->description	=	Input::get('payment_description');
				$paymentOptionModel->save();
			}
			
			if(!empty($PaymentOption)){
				$paymentOptionIds = array();
				foreach($PaymentOption as $Option){
					if(!empty($Option['name'])){
						if(!empty($Option['id'])){
							$paymentOptionModel				=	PaymentOption::find($Option['id']);
						}else{
							$paymentOptionModel				=	new PaymentOption;
							$paymentOptionModel->type		=	"offline";
							$paymentOptionModel->slug			=	$this->getSlug($Option['name'],'slug','PaymentOption');
						}
						$paymentOptionModel->name			=	$Option['name'];
						$paymentOptionModel->description	=	$Option['description'];
						$paymentOptionModel->save();
						$paymentOptionIds[]					=	$paymentOptionModel->id;
					}
				}
				if(!empty($paymentOptionIds)){
					PaymentOption::whereNotIn('id',$paymentOptionIds)->where('type','=','offline')->delete();
				}
			}
			
			$this->settingFileWrite();
			
			//Session::flash('success', trans("messages.session_has_been_booked"));
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Payment Settings saved successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function SaveIntegrationSetting(){
		//Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'google_analytics'				=> 'sometimes',
				'google_adsense' 				=> 'sometimes',
				'facebook_pixel' 				=> 'sometimes',
			),
			array(
				
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
			$model 								=  GeneralSetting::find(1);
			$model->google_analytics 			=  Input::get('google_analytics');
			$model->google_adsense 				=  Input::get('google_adsense');
			$model->facebook_pixel 				=  Input::get('facebook_pixel');
			$model->save();
			$modelId					=	$model->id;		
			
			$this->settingFileWrite();
			
			//Session::flash('success', trans("messages.session_has_been_booked"));
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Integration Settings saved successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function settingFileWrite() {
		$DB		=	Setting::query();
		$list	=	$DB->orderBy('key','ASC')->get(array('key','value'))->toArray();
		
        $file = SETTING_FILE_PATH;
		$settingfile = '<?php ' . "\n";
		foreach($list as $value){
			$val		  =	 str_replace('"',"'",$value['value']);
			if($value['key']=='Reading.records_per_page' || $value['key']=='Site.debug'){
				$settingfile .=  '$app->make('.'"config"'.')->set("'.$value['key'].'", '.$val.');' . "\n"; 
			}else{
				$settingfile .=  '$app->make('.'"config"'.')->set("'.$value['key'].'", "'.$val.'");' . "\n"; 
			}
			
		}
		
		$DB1	=	GeneralSetting::query();
		$result	=	$DB1->first()->toArray();
		//pr($result); die;
		
        //$file = SETTING_FILE_PATH;
		//$settingfile = '<?php ' . "\n";
		foreach($result as $key=>$value){
			
			$val		  =	 str_replace('"',"'",$value);
			if("Settings.".$key=='Reading.records_per_page' || "Settings.".$key=='Site.debug'){
				$settingfile .=  '$app->make('.'"config"'.')->set("Settings.'.$key.'", '.$val.');' . "\n"; 
			}else{
				$settingfile .=  '$app->make('.'"config"'.')->set("Settings.'.$key.'", "'.$val.'");' . "\n"; 
			}
			
		}
		$bytes_written = File::put($file, $settingfile);
		if ($bytes_written === false)
		{
			die("Error writing to file");
		}
	}
	
	public function AddMoreOfflinePaymentOption(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_offline_payment',compact("counter"));
	}
	
	
	
	//DONE//
	public function GeneralSmsTemplate(){
		
		return View::make('front.user.general_sms_template',compact(""));
	}
	
	public function GeneralSmsTempEdit(){
		
		return View::make('front.user.general_sms_temp_edit',compact(""));
	}
	
	
	
	public function GeneralTranslation(){
		
		return View::make('front.user.general_translation',compact(""));
	}
	
	public function GeneralTranslationEdit(){
		
		return View::make('front.user.general_translation_edit',compact(""));
	}
	
	
	public function UpdateBookingPaymentStatus(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		
		$paymentId						=	Input::get('paymentId'); 
		$status							=	Input::get('paymentStatus'); 
		
		if(empty($paymentId) || empty($status) && empty(Auth::user())){
			$err			=	array();
			$err['error']	=	1;
			$err['message']	=	"Responce not getting properly.";
			return Response::json($err); die;
		}
		if(Auth::user()->user_role_id != 1){
			$err			=	array();
			$err['error']	=	100;
			$err['message']	=	"You are not able to perform this action.";
			return Response::json($err); die;
		}
		$userId				=	Auth::user()->id;
		
		$paymentCheck = DonationPayment::where('id',$paymentId)->where('is_deleted',0)->first();
		if(!empty($paymentCheck)){
			if($paymentCheck->payment_status != $status){
				$changingDate = date("Y-m-d H:i:s");
				DonationPayment::where('id',$paymentId)->where('is_deleted',0)->update(array('payment_status'=>$status,'status_change_by'=>$userId,'payment_status_date'=>$changingDate,'last_payment_status'=>$paymentCheck->payment_status));
				
			}
			
			$totalPaidAmount = DonationPayment::where('order_id',$paymentCheck->order_id)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
				
			DonationOrder::where('id',$paymentCheck->order_id)->update(array('deposite'=>$totalPaidAmount));
			
			if($status == 1){
				$message = "Payment Status Changed To Waiting Approvel.";
			}else if($status == 2){
				$message = "Payment Approved Successfully";
			}else if($status == 3){
				$message = "Payment Status Changed To Pending";
			}else if($status == 4){
				$message = "Payment Rejected Successfully";
			}else if($status == 5){
				$message = "Payment Status Changed To Expired.";
			}else{
				$message = "Payment Status Changed Successfully";
			}
			
			$err			=	array();
			$err['success']	=	1;
			$err['message']	=	$message;
			return Response::json($err); die;
		}else{
			Session::flash('error',  trans("Responce not getting properly."));
			$err			=	array();
			$err['error']	=	1;
			$err['message']	=	"Responce not getting properly.";
			return Response::json($err); die;
			
			// Session::flash('error',  trans("Something went wrong! Payment Details Not Found."));
			// return redirect()->back();
		}
	}
	
	public function ApproveBulkPayments(){
		if(Auth::user()->user_role_id != 1){
			return Redirect::to('/dashboard');				
		}
		
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		
		if(!empty($thisData)){
			if(!empty($thisData['cng_status'])){
				$paymentIds = $thisData['cng_status'];
				$lastPaymentCheck = GuestOrderPayment::whereIn('id',$paymentIds)->where('is_deleted',0)->where('payment_status','!=',2)->lists('payment_status','id');
				// pr($thisData['cng_status']); 
				// pr($lastPaymentCheck); die;
				if(!empty($lastPaymentCheck)){
					$status = "2";
					$changingDate = date("Y-m-d H:i:s");
					GuestOrderPayment::whereIn('id',$paymentIds)->where('is_deleted',0)->where('payment_status','!=',2)->update(array('payment_status'=>$status,'status_change_by'=>$userId,'payment_status_date'=>$changingDate,'last_payment_status'=>'1'));
					
					foreach($paymentIds as $paymentId){
					  $paymentCheck = GuestOrderPayment::where('id',$paymentId)->where('is_deleted',0)->first();
					  if(!empty($paymentCheck)){
						if($paymentCheck->payment_status != $status){
							$paymentCheckApproved = GuestOrderPayment::where('id',$paymentId)->where('is_deleted',0)->where('payment_status',2)->count('id');
							if($status == 2 && $paymentCheckApproved < 1){
								$guestId = $paymentCheck->guest_id;
								$guestDetails = 0;
								//pr($guestDetails); die;
								if(!empty($guestDetails)){
									if($guestDetails->seat_status == 0){
										PackageSeat::where('room_id',$guestDetails->room)->where('package_id',$guestDetails->package_id)->where('is_deleted',0)->update(array('booked_seat'=>DB::raw('booked_seat + 1')));
										
									}
									
								}
							}
						}
						
						
					  }
					}
					
					$err					=	array();
					$err['success']			=	1;
					$err['message']			=	trans("Payment Approved Successfully.");
					return Response::json($err); 
					die;
				}else{
					
					$err					=	array();
					$err['success']			=	1;
					$err['message']			=	trans("Payment Approved Successfully.");
					return Response::json($err); 
					die;
				}
				
			}else{
				$err					=	array();
				$err['error']			=	1;
				$err['message']			=	trans("Please select al least one payment.");
				return Response::json($err); 
				die;
			}
			
		}else{
			$err					=	array();
			$err['error']			=	1;
			$err['message']			=	trans("Please select al least one payment.");
			return Response::json($err); 
			die;
		}
		
		
		if(!empty($paymentCheck)){
			if($paymentCheck != $status){
				
			}
			if($status == 2){
				$message = "Payment Approved Successfully";
			}else if($status == 4){
				$message = "Payment Cancelled Successfully";
			}else if($status == 5){
				$message = "Payment Refund Successfully";
			}else{
				$message = "Payment Status Changed Successfully";
			}
			
			Session::flash('flash_notice',  trans($message));
			return redirect()->back();
		}else{
			Session::flash('error',  trans("Something went wrong! Payment Details Not Found."));
			return redirect()->back();
		}
	}
	
	public function DeleteOrder($orderID = ""){
		if(empty($orderID)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		$order_id = Order::where('order_unique_id',$orderID)->pluck('id');
		if(!empty($order_id)){
			Order::where('id',$order_id)->update(array('is_deleted'=>1));
			
			Session::flash('flash_notice',  trans("Booking deleted successfully."));
		}else{
			Session::flash('flash_notice',  trans("Booking details not found!"));
		}
		
		return redirect()->back();
	}
	
	
	
	
	public function getDownloadFiles($uniquePackageId){
		//PDF file is stored under project/public/download/info.pdf
		//$file= public_path(). "/download/info.pdf";
		if(empty($uniquePackageId)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		
		$itenary_name = Package::where('is_deleted',0)->where('package_id',$uniquePackageId)->pluck('itinery_file');
		if(!empty($itenary_name)){
			$file = PACKAGE_FILE_ROOT_PATH .  $itenary_name;

			$headers = array(
					  'Content-Type: application/pdf',
					);

			return Response::download($file, 'filename.pdf', $headers);
			
		}else{
			Session::flash('flash_notice',  trans("Itenery Not Found!"));
			return redirect()->back();
		}
	}
	
	
	public function sendTestEmail(){
		
		//mail email and password to new registered user
		$settingsEmail 			= 	Config::get('Settings.sender_mail');
		$SiteTitle 				= 	Config::get('Settings.business_name');
		$email					=	Config::get('Settings.mailer_name');
		
		// $emailActions			= 	EmailAction::where('action','=','send_test_email')->get()->first();
		// $emailTemplates			= 	EmailTemplate::where('action','=','send_test_email')->get(array('name','subject','action','body'))->first();
	
		// $cons 					= 	explode(',',$emailActions['options']);
		$constants 				= 	array();
		
		// foreach($cons as $key => $val){
			// $constants[] 		= 	'{'.$val.'}';
		// }
		
		$subject 				= 	"Check Indivisual Email Test"; //$emailTemplates['subject'];
		$body					=	"Check Indivisual Email Test Description";
		$rep_Array 				= 	array(); 
		$messageBody			= 	$body; //str_replace($constants, $rep_Array, $body);
		$mail					= 	$this->sendMail($email,$SiteTitle,$subject,$messageBody,$settingsEmail);
		
		$err					=	array();
		$err['success']			=	"1";
		$err['message']			=	"Email Sent Successfully.";
		$err['settingsEmail']	=	$settingsEmail;
		$err['email']			=	$email;
		$err['mail']			=	$mail;
		return Response::json($err); 
		die;
		
	}
	
	public function sendTestSms(){
		
		if(!empty(Input::get('tempAction'))){
			//$smsActions			= 	SmsAction::where('action','=',Input::get('tempAction'))->get()->first();
			$smsTemplates		= 	SmsTemplate::where('action','=',Input::get('tempAction'))->get(array('name','subject','action','body'))->first();
			
			$message			= 	$smsTemplates['body'];
			
			$phoneNumber		=	Config::get('Settings.receiver_number');
		}else{
			if(!empty(Input::get('phoneNumber'))){
				$phoneNumber	=	Input::get('phoneNumber');
			}else{
				$phoneNumber	=	Config::get('Settings.receiver_number');
			}
			if(!empty(Input::get('message'))){
				$message		=	Input::get('message');
			}else{
				$message		=	!empty(Config::get('Settings.message'))?Config::get('Settings.message'):'Test SMS API. Hidayah Centre Foundation';
			}
		}
		
		$this->_sendSms($phoneNumber,$message);
		
		$err					=	array();
		$err['success']			=	"1";
		$err['message']			=	"SMS Sent Successfully.";
		$err['phoneNumber']		=	$phoneNumber;
		$err['message_body']	=	$message;
		return Response::json($err); 
		die;
		
	}
	
	
	public function PaymentSuccess(){
		$thisData						=	Input::all();  
		//$userId							=	Auth::user()->id;
		//$thisData = array('billplz' => array('id' => '75ucp0zr'));
		//pr($thisData); die;
		if(!empty($thisData)){
			if(!empty($thisData['billplz']) && !empty($thisData['billplz']['id'])){
				$api_key = Config::get("Settings.payment_secret_key"); //'af6b3ddc-5152-4852-b3b8-5605aed427a1';
				
				$billID = $thisData['billplz']['id'];
				$host = 'https://www.billplz.com/api/v3/bills/'.$billID;
				
				//get success bill response
				$process = curl_init($host);
				
				curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
				curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($process);
				
				$paymentArray = json_decode($response); 
				//pr($paymentArray); die;
				if(isset($paymentArray->error)){
					$errorType = $paymentArray->error->type;
					$errorMessage = $paymentArray->error->message;
					return View::make('front.user.payment_error_page',compact("errorType","errorMessage"));
					
				}else{
					$billUrl 	= $paymentArray->url;
					$billId 	= $paymentArray->id;
					if(!empty($paymentArray->paid_amount)){
						$paidAmount = ($paymentArray->paid_amount / 100);
					}else{
						$paidAmount = $paymentArray->paid_amount;
					}
					
					$paymentDetails = DonationPayment::where('invoice_id',$billId)->first();
					if(!empty($paymentDetails)){
						if($paymentArray->state != "due"){
							DonationPayment::where('id',$paymentDetails->id)->update(array('payment_status'=>2));
						}
						return Redirect::to('/invoice/'.$billId);
						
					}else{
						Session::flash('error',  trans("Something went wrong! Payment Details Not Found."));
						//return redirect()->back();
						$errorType = "Payment Error";
						$errorMessage = "Payment and Order response not getting.";
						return View::make('front.user.payment_error_page',compact("errorType","errorMessage"));
					}
					
				}
			}else{
				Session::flash('error',  trans("Something went wrong! Payment Details Not Found."));
				return Redirect::to('/dashboard');
			}
			
		}else{
			Session::flash('error',  trans("Something went wrong! Payment Details Not Found."));
			return Redirect::to('/dashboard');
		}
		
	}
	
	public function PaymentSuccessTest(){
		$thisData						=	Input::all();  
		//$userId							=	Auth::user()->id;
		$thisData = array('billplz' => array('id' => 'mf7fog4e'));
		//pr($thisData); die;
		if(!empty($thisData)){
			if(!empty($thisData['billplz']) && !empty($thisData['billplz']['id'])){
				$api_key = Config::get("Settings.payment_secret_key"); //'af6b3ddc-5152-4852-b3b8-5605aed427a1';
				
				$billID = $thisData['billplz']['id'];
				$host = 'https://www.billplz.com/api/v3/bills/'.$billID;
				
				//get success bill response
				$process = curl_init($host);
				
				curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
				curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($process);
				
				$paymentArray = json_decode($response); 
				//pr($paymentArray); die;
				if(isset($paymentArray->error)){
					$errorType = $paymentArray->error->type;
					$errorMessage = $paymentArray->error->message;
					return View::make('front.user.payment_error_page',compact("errorType","errorMessage"));
					
				}else{
					$billUrl 	= $paymentArray->url;
					$billId 	= $paymentArray->id;
					if(!empty($paymentArray->paid_amount)){
						$paidAmount = ($paymentArray->paid_amount / 100);
					}else{
						$paidAmount = $paymentArray->paid_amount;
					}
					
					$paymentDetails = DonationPayment::where('invoice_id',$billId)->first();
					//pr($paymentDetails); die;
					if(!empty($paymentDetails)){
						DonationPayment::where('id',$paymentDetails->id)->update(array('payment_status'=>2));
						
						return Redirect::to('/invoice/'.$billId);
						
					}else{
						Session::flash('error',  trans("Something went wrong! Payment Details Not Found."));
						//return redirect()->back();
						$errorType = "Payment Error";
						$errorMessage = "Payment and Order response not getting.";
						return View::make('front.user.payment_error_page',compact("errorType","errorMessage"));
					}
					
				}
			}else{
				Session::flash('error',  trans("Something went wrong! Payment Details Not Found."));
				return Redirect::to('/dashboard');
			}
			
		}else{
			Session::flash('error',  trans("Something went wrong! Payment Details Not Found."));
			return Redirect::to('/dashboard');
		}
		
	}
	
	
	public function PaymentErrorPage(){
		
	}
	
	
	
	
	
	public function exportAdminExcel(){

		//holoday packages
		$AdminRecords = User::where('is_deleted',0)->where('user_role_id',1)->where('id','!=',1)->orderBy('id','ASC')->get();
		
		$thead[] = array('full_name'=>'Full Name','phone_number'=>'Contact Number','email'=>'Email','status'=>'Status','created'=>'Date Registered','last_login'=>'Last Login');

		$serial_no = 0 ;

		if(!empty($AdminRecords)){

			foreach($AdminRecords as $result){

				$serial_no++;

				$status				=   ($result->is_active ==1) ? "Active" :'Disable';

				$full_name			=	!empty($result->full_name)?$result->full_name:'';

				$phone_number		=	!empty($result->phone)?$result->phone:'';

				$email				=	!empty($result->email)?$result->email:'';

				$created_date		=	!empty($result->created_at)? date("d/M/Y",strtotime($result->created_at)):'-';
				
				$created_time		=	!empty($result->created_at)? date("h:i A",strtotime($result->created_at)):'-';
				
				$last_login			=	!empty($result->last_active_date)? date("d/M/Y h:i A",strtotime($result->last_active_date)):'-';

				$thead[] 	=	array('full_name'=>$full_name,'phone_number'=>$phone_number,'email'=>$email,'status'=>$status,'created'=>$created_date,'last_login'=>$last_login);
				
			}

		}

		return View::make('front.user.view_admin_excel',compact('thead')); 

	}	

	public function exportVendorExcel(){

		//holoday packages
		$VendorRecords = User::select('users.*')->where('is_deleted',0)->where('user_role_id',2)->orderBy('id','ASC')->get();
		
		$thead[] = array('full_name'=>'Vendor Name','phone_number'=>'Contact Number','email'=>'Email','status'=>'Status','created'=>'Date Registered');

		$serial_no = 0 ;

		if(!empty($VendorRecords)){

			foreach($VendorRecords as $result){

				$serial_no++;

				$status				=   ($result->is_active ==1) ? "Active" :'Disable';

				$full_name			=	!empty($result->full_name)?$result->full_name:'';

				$phone_number		=	!empty($result->phone)?$result->phone:'';

				$email				=	!empty($result->email)?$result->email:'';

				$created_date		=	!empty($result->created_at)? date("d/M/Y",strtotime($result->created_at)):'-';
				
				$created_time		=	!empty($result->created_at)? date("h:i A",strtotime($result->created_at)):'-';
				
				$thead[] 	=	array('full_name'=>$full_name,'phone_number'=>$phone_number,'email'=>$email,'status'=>$status,'created'=>$created_date);
				
			}

		}

		return View::make('front.user.view_vendor_excel',compact('thead')); 

	}	

	public function exportContributorExcel(){

		//holoday packages
		$ContributorRecords = User::select('users.*')->where('is_deleted',0)->where('user_role_id',3)->orderBy('id','ASC')->get();
		
		$thead[] = array('full_name'=>'Contributor Name','phone_number'=>'Contact Number','email'=>'Email','status'=>'Status','created'=>'Date Registered');

		$serial_no = 0 ;

		if(!empty($ContributorRecords)){

			foreach($ContributorRecords as $result){

				$serial_no++;

				$status				=   ($result->is_active ==1) ? "Active" :'Disable';

				$full_name			=	!empty($result->full_name)?$result->full_name:'';

				$phone_number		=	!empty($result->phone)?$result->phone:'';

				$email				=	!empty($result->email)?$result->email:'';

				$created_date		=	!empty($result->created_at)? date("d/M/Y",strtotime($result->created_at)):'-';
				
				$created_time		=	!empty($result->created_at)? date("h:i A",strtotime($result->created_at)):'-';
				
				$thead[] 	=	array('full_name'=>$full_name,'phone_number'=>$phone_number,'email'=>$email,'status'=>$status,'created'=>$created_date);
				
			}

		}

		return View::make('front.user.view_contributor_excel',compact('thead')); 

	}	

	public function exportProjectExcel($subProjectSlug = ""){
		if(empty($subProjectSlug)){
			Session::flash('flash_notice',  trans("Pagination Error!"));
			return redirect()->back();
		}
		
		$subProjectDetails = DB::table('sub_projects')
								->select('sub_projects.*',
									DB::raw("(select name from project_modules where id=sub_projects.project_module) as project_module_name"),
									DB::raw("(select name from projects where id=sub_projects.project_id) as project_name")
								)
								->where('slug',$subProjectSlug)->where('is_deleted',0)->first();
		if(empty($subProjectDetails)){
			Session::flash('flash_notice',  trans("Pagination Error!"));
			return redirect()->back();
		}
		
		
		$DB							=	DonationOrder::query(); 
		$idsData					=	array(); 
		$searchVariable				=	array(); 
		$selectedSort_by			=	"";
		$inputGet					=	Input::get();
		if(Input::get()) {
			$searchData				=	Input::get();
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
			if(isset($searchData['per_page'])){
				unset($searchData['per_page']);
			}
			if(isset($searchData['sort_by'])){
				unset($searchData['sort_by']);
			}
			
			foreach($searchData as $fieldName => $fieldValue){
				if(!empty($fieldValue) || $fieldValue == 0){
				    if($fieldName == "keyword"){
						$DB->where("full_name",'like','%'.$fieldValue.'%');
					}else if($fieldName == "status"){
					  if($fieldValue != ""){
						$PaymentStatusIds = array();
						if($fieldValue == 1){
							$PaymentStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',1)->lists('order_id','order_id');
						}else if($fieldValue == 2){
							$PaymentStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',2)->lists('order_id','order_id');
						}else if($fieldValue == 3){
							$PaymentStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',3)->lists('order_id','order_id');
						}else if($fieldValue == 5){
							$PaymentStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',5)->lists('order_id','order_id');
						}
						
						$DB->whereIn("id",$PaymentStatusIds);
					  }
					}else if($fieldName == "special_project_seat_plan"){
						if($fieldValue != ""){
							$seatProjectOrderIds = SeatReservationOrder::where('seat_plan_id',$fieldValue)->where('is_deleted',0)->where('is_active',1)->lists('order_id','order_id')->toArray();
							
							$DB->whereIn('id',$seatProjectOrderIds);
						}
					}else if($fieldName == "special_project_section_plan"){
						if($fieldValue != ""){
							$sectionProjectOrderIds = SectionParticipate::where('section_plan',$fieldValue)->lists('order_id','order_id')->toArray();
							
							$DB->whereIn('id',$sectionProjectOrderIds);
						}
					}else if($fieldName == "dana_vendor"){
						if($fieldValue != ""){
							$DB->whereRaw("FIND_IN_SET(?,dana_vendor)",[$fieldValue]);
						}
					}else if($fieldName == "filterdate"){
						if($fieldValue != ""){
							$minDateTime = date("Y-m-d 00:00:01",strtotime($fieldValue));
							$maxDateTime = date("Y-m-d 23:59:59",strtotime($fieldValue));
							$DB->where("created_at",'>=',$minDateTime);
							$DB->where("created_at",'<=',$maxDateTime);
						}
					}else{
						$DB->where("$fieldName",'=',$fieldValue);
						//$DB->where("$fieldName",'like','%'.$fieldValue.'%');
					}
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		
		$sortBy 	= 	(Input::get('sortBy')) ? Input::get('sortBy') : 'created_at';
	    $order  	= 	(Input::get('order')) ? Input::get('order')   : 'DESC';
		
		
		$result 	= 	$DB
							->select('donation_orders.*',
								DB::raw("(select price from sub_project_plans where id=donation_orders.plan_price) as plan_price"),
								DB::raw("(select quantity from sub_project_periods where id=donation_orders.time_period) as time_period"),
								DB::raw("(select title from sub_project_default_plans where id=donation_orders.default_project_plan) as default_project_plan_name"),
								DB::raw("(select plan_title from sub_project_quantity_plans where id=donation_orders.quantity_project_plan) as quantity_project_plan_name"),
								DB::raw("(select title from sub_project_dana_default_plans where id=donation_orders.dana_default_project_plan) as dana_default_project_plan_name"),
								DB::raw("(select title from sub_project_dana_property_types where id=donation_orders.dana_property_plan) as dana_property_plan_name"),
								DB::raw("(select full_name from users where id=donation_orders.dana_vendor) as dana_vendor_name")
							)
							->where('sub_project_id',$subProjectDetails->id)
							->where('is_deleted',0)
							->orderBy($sortBy, $order)
							->get();
		
		if($subProjectDetails->project_module == 1){
			$dynamicFields = array('commitment_type'=>'Commitment Type','plan'=>'Plan/Total Contribution','period'=>'Period');
		}else if($subProjectDetails->project_module == 2){
		  if($subProjectDetails->customize_plan_option == 4){
			$dynamicFields = array('participate'=>'No. of Participate','session'=>'Session','contribution'=>'Total Contribution');
		  }else if($subProjectDetails->customize_plan_option == 3){
			$dynamicFields = array('plan'=>'Project Plan','quantity'=>'Quantity','contribution'=>'Total Contribution');
		  }else{
			$dynamicFields = array('plan'=>'Project Plan','contribution'=>'Total Contribution');			  
		  }
		}else if($subProjectDetails->project_module == 3){
		  if($subProjectDetails->customize_plan_option == 7){
			$dynamicFields = array('vendor'=>'Vendor','contribution'=>'Total Contribution');
		  }else{
			$dynamicFields = array('plan'=>'Project Plan','contribution'=>'Total Contribution');
		  }
		}
		
		$headArray1	=	array('s_no'=>'S.No.','full_name'=>'Name','phone_number'=>'Contact Number','email'=>'Email');
		$headArray2	=	array('status'=>'Status','created'=>'Date Registered');
		$thead[]	= 	array_merge($headArray1,$dynamicFields,$headArray2);
		//$thead[]	= 	array_merge($headArray1,$headArray2);
		//array_splice( $original, 4, 0, $inserted );

		$serial_no = 0 ;

		if(!empty($result)){
			foreach($result as $record){
				if($subProjectDetails->customize_plan_option == 4){
					$TotalParticipates = SectionParticipate::where('order_id',$record->id)->where('is_active',1)->count('id');
					$participateArray = SectionParticipate::where('order_id',$record->id)->where('is_active',1)->lists('section_plan','section_plan')->toArray();
					$sectionPlanArray	=	SubProjectSectionPlan::whereIn('id',$participateArray)->get();
					
					$record->ParticipateArray	=	$sectionPlanArray;
					$record->TotalParticipates	=	$TotalParticipates;
				}
				if($subProjectDetails->customize_plan_option == 2){
					$reservationArray = SeatReservationOrder::select('seat_reservation_orders.*',DB::raw("(select seat_name from sub_project_seat_reservation_plans where id=seat_reservation_orders.seat_plan_id) as seat_name"))->where('order_id',$record->id)->where('is_active',1)->get();
					$record->ReservationArray	=	$reservationArray;
				}
				
				$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',1)->pluck('payment_status');
				if(empty($checkMainPaymentStatus)){
					$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',3)->pluck('payment_status');
					if(empty($checkMainPaymentStatus)){
						$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',5)->pluck('payment_status');
						if(empty($checkMainPaymentStatus)){
							$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',2)->pluck('payment_status');
						}
					}
				}
				$record->main_payment_status	=	$checkMainPaymentStatus;
				
				
				$serial_no++;

				if($record->main_payment_status == 1){
					$status				=   trans('messages.dashboard.waiting_approval');
				}else if($record->main_payment_status == 2){
					$status				=   trans('messages.dashboard.success');
				}else if($record->main_payment_status == 3){
					$status				=   trans('messages.dashboard.pending');
				}else if($record->main_payment_status == 5){
					$status				=   trans('messages.dashboard.expired');
				}else{
					$status				=   trans('messages.dashboard.not_paid');
				}

				$full_name			=	!empty($record->full_name)?$record->full_name:'';

				$phone_number		=	!empty($record->phone)?$record->phone:'';

				$email				=	!empty($record->email)?$record->email:'';

				if($subProjectDetails->project_module == 1){
					
					$commitment_type	=	($record->is_enquiry == 1) ? trans('messages.edit_book_plan.enquiry') : ucfirst($record->plan_type);
					$plan				=	!empty($record->other_plan_price) ? (string)$record->other_plan_price : (string)$record->plan_price;
											
											if($record->plan_type == "daily"){
												$periodType = trans('messages.sub_project_lists.days');
											}else if($record->plan_type == "monthly"){
												$periodType = trans('messages.sub_project_lists.months');
											}else if($record->plan_type == "yearly"){
												$periodType = trans('messages.sub_project_lists.years');
											}
					$period				=	!empty($record->other_time_period) ? (string)$record->other_time_period." ".$periodType :(string) $record->time_period." ".$periodType;
					
					$dynamicValues = array('commitment_type'=>$commitment_type,'plan'=>$plan,'period'=>$period);
					
				}else if($subProjectDetails->project_module == 2){
				  if($subProjectDetails->customize_plan_option == 1){
					  $plan				=	($record->is_enquiry == 1) ? trans('messages.edit_book_plan.enquiry') : ucfirst($record->default_project_plan_name);
					  $contribution		=	!empty($record->total_contribution) ? (string)$record->total_contribution : "0";
					  
					  $dynamicValues = array('plan'=>$plan,'contribution'=>$contribution);
					  
				  }else if($subProjectDetails->customize_plan_option == 2){
					if($record->is_enquiry == 1){
						$plan				=	trans('messages.edit_book_plan.enquiry');
					}else{
						$plan	=	"";
						if(!empty($record->ReservationArray)){
							foreach($record->ReservationArray as $reservationSeats){
								$plan .= 	$reservationSeats->seat_name." x ".$reservationSeats->total_seat.", ";
							}
						}
					}
					$contribution		=	!empty($record->total_contribution) ? (string)$record->total_contribution : "0";
					
					$dynamicValues = array('plan'=>$plan,'contribution'=>$contribution);
					
				  }else if($subProjectDetails->customize_plan_option == 3){
					$plan				=	($record->is_enquiry == 1) ?  trans('messages.edit_book_plan.enquiry') : ucfirst($record->quantity_project_plan_name);
					$quantity			=	!empty($record->quantity) ? (string)$record->quantity : '0';
					$contribution		=	!empty($record->total_contribution) ? (string)$record->total_contribution : "0";
					
					$dynamicValues = array('plan'=>$plan,'quantity'=>$quantity,'contribution'=>$contribution);
					
				  }else if($subProjectDetails->customize_plan_option == 4){
					if($record->is_enquiry == 1){
						$participate	=	trans('messages.edit_book_plan.enquiry');
					}else{
						$participate	=	!empty($record->TotalParticipates) ? (string)$record->TotalParticipates : '-'; 
					}
					$session	=	"";
					if(!empty($record->ParticipateArray)){
						foreach($record->ParticipateArray as $paricipateArray){
							$session	.=	!empty($paricipateArray->section_name) ? $paricipateArray->section_name.", " : '';
						}
					}
					$contribution		=	isset($record['total_contribution']) ? (string)$record['total_contribution'] : "0" ;
					
					$dynamicValues = array('participate'=>$participate,'session'=>$session,'contribution'=>$contribution);
					
				  }
				}else if($subProjectDetails->project_module == 3){
				  if($subProjectDetails->customize_plan_option == 5){
					$plan				=	($record->is_enquiry == 1) ? trans('messages.edit_book_plan.enquiry') : ucfirst($record->dana_default_project_plan_name);
					$contribution		=	!empty($record->total_contribution) ? (string)$record->total_contribution : "0";
					
					$dynamicValues = array('plan'=>$plan,'contribution'=>$contribution);
					
				  }else if($subProjectDetails->customize_plan_option == 6){
					$plan				=	($record->is_enquiry == 1) ?  trans('messages.edit_book_plan.enquiry') : ucfirst($record->dana_property_plan_name);
					$contribution		=	!empty($record->total_contribution) ? (string)$record->total_contribution : "0";
					
					$dynamicValues = array('plan'=>$plan,'contribution'=>$contribution);
					
				  }else if($subProjectDetails->customize_plan_option == 7){
					$plan				=	($record->is_enquiry == 1) ?  trans('messages.edit_book_plan.enquiry') : ucfirst($record->dana_vendor_name);
					$contribution		=	!empty($record->total_contribution) ? (string)$record->total_contribution : "0";
					
					$dynamicValues = array('vendor'=>$plan,'contribution'=>$contribution);
					
				  }
				}

				$created_date		=	!empty($record->created_at)? date("d/M/Y h:i A",strtotime($record->created_at)):'-';
				
				$s_no = (string)$serial_no;
				
				$dataArray1	=	array('s_no'=>$s_no,'full_name'=>$full_name,'phone_number'=>$phone_number,'email'=>$email);
				$dataArray2	=	array('status'=>$status,'created'=>$created_date);
				
				$thead[] 	=	array_merge($dataArray1,$dynamicValues,$dataArray2);
				//$thead[] 	=	array_merge($dataArray1,$dataArray2);
				
			}

		}
		//pr($thead); die;
		return View::make('front.user.view_sub_projects_excel',compact('thead')); 

	}	


	public function exportLanguageExcel(){

		$LanguageRecords = AdminLanguageSetting::where('is_deleted',0)->orderBy('id','ASC')->get();
		
		$thead[] = array('english'=>'English Language','malay'=>'Malay Language','status'=>'Status','updated_date'=>'Date Edited','updated_time'=>'Time Edited');

		$serial_no = 0 ;

		if(!empty($LanguageRecords)){

			foreach($LanguageRecords as $result){

				$result_ms = AdminLanguageSetting::where('locale','ms')->where('msgid',$result->msgid)->pluck('msgstr');
				
				$serial_no++;

				$status				=   ($result->is_active ==1) ? "Active" :'Disable';

				$english			=	!empty($result->msgstr)?$result->msgstr:'';

				$malay				=	!empty($result_ms)?$result_ms:'';

				$updated_date		=	!empty($result->updated_at)? date("d/M/Y",strtotime($result->updated_at)):'-';
				
				$updated_time		=	!empty($result->updated_at)? date("h:i A",strtotime($result->updated_at)):'-';

				$thead[] 	=	array('english'=>$english,'malay'=>$malay,'status'=>$status,'updated_date'=>$updated_date,'updated_time'=>$updated_time);
				
			}

		}

		return View::make('front.user.view_language_excel',compact('thead')); 

	}	

	
	
	//import csv 
	public function importDirectFlight(){
		return View::make('front.user.import_direct_flight');
	}
	
	public function importDirectFlightSave(){
		ini_set('max_execution_time',0);
		ini_set('memory_limit',-1);
		
		$thisData						=	Input::all(); 
		//pr($thisData); die;
		$validator 					=	Validator::make(
			Input::all(),
			array(  
				'filename'					=> 'required|mimes:csv,txt',
				//'image' 					=> 'mimes:'.IMAGE_EXTENSION, 
			),
			array(
				'filename.required'			=> 'Please select file.', 
				'filename.mimes'			=> 'Please select csv file.', 
			)
		);
		if ($validator->fails()){	 
			return Redirect::Back()->withErrors($validator)->withInput();
		}else{ 
			$i = 1;
			$file = Request::file('filename');
			
			$imagePath = $file->getPathName();	
			$handle					=	fopen($imagePath, "r");
			$final_csv_reocords		=	array();
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$final_csv_reocords[]	=	$data;
				$i++;
			}
			
			unset($final_csv_reocords[0]);
			if(!empty($final_csv_reocords)){
				//pr($final_csv_reocords);die;
				foreach($final_csv_reocords as $key=>$data){
					//$userExist = DB::table("users")->where("username",$data[2])->where("is_deleted",0)->first();
					
					if(!empty($data[0]) && !empty($data[1])){
						$obj 								=  new Package;
						$obj->year 							=  !empty($data[0]) ? $data[0]: '';
						$obj->season 						=  !empty($data[1]) ? $data[1]: '';
						$obj->flight_name 					=  !empty($data[2]) ? $data[2]: '';
						$obj->hotel_category 				=  !empty($data[3]) ? $data[3]: '';
						$obj->departure_date 				=  !empty($data[4]) ? date("Y-m-d H:i:s",strtotime($data[4])): '';
						$obj->arrival_date 					=  !empty($data[5]) ? date("Y-m-d H:i:s",strtotime($data[5])): '';
						$obj->duration	 					=  !empty($data[6]) ? $data[6]: '';
						$obj->sector		 				=  !empty($data[7]) ? $data[7]: '';
						$obj->flight_class					=  !empty($data[8]) ? $data[8]: '';
						$obj->hotel_makkah_name				=  !empty($data[9]) ? $data[9]: '';
						$obj->hotel_madinah_name			=  !empty($data[10]) ? $data[10]: '';
						$obj->is_active						=  !empty($data[11]) ? $data[11]: '0';
						$obj->package_category				=  '1';
						$obj->user_id						=  Auth::user()->id;
						$obj->package_id					=  "DF-".$key.time();
						
						$obj->is_active						=  1;	
						$obj->is_deleted					=  0;	
						$obj->save();
						
						$package_id		=	$obj->id;
						//$this->saveActivityLog(ADD_OFFICER,$obj->id);
						
						//save package seats
						if(!empty($data[12]) && $data[12] != ""){
							$filteredData12 = str_replace("(","",$data[12]);
							$filteredData12 = str_replace(")","",$filteredData12);
							
							$room_6_array = explode(",",$filteredData12);
							if(!empty($room_6_array)){
								$saveSeat				= 	new PackageSeat;
								$saveSeat->package_id	=	$package_id;
								$saveSeat->room_id		=	5;
								$saveSeat->adult_price	=	!empty($room_6_array['0']) ? $room_6_array['0']: '0';
								$saveSeat->adult_seat	=	!empty($room_6_array['1']) ? $room_6_array['1']: '0';
								$saveSeat->child_price	=	!empty($room_6_array['2']) ? $room_6_array['2']: '0';
								$saveSeat->child_seat	=	!empty($room_6_array['3']) ? $room_6_array['3']: '0';
								$saveSeat->infant_price	=	!empty($room_6_array['4']) ? $room_6_array['4']: '0';
								$saveSeat->total_seat	=	($saveSeat->adult_seat + $saveSeat->child_seat);
								$saveSeat->booked_seat	=	0;
								$saveSeat->is_active	=	1;
								$saveSeat->is_deleted	=	0;
								$saveSeat->save();
								
								if(!empty($saveSeat->adult_seat)){
									$historyModel 				=  new SeatHistory;
									$historyModel->package_id	=	$package_id;
									$historyModel->room_id 		=	5;
									$historyModel->created_by 	=	Auth::user()->id;
									$historyModel->type 		=	"cr";
									$historyModel->action 		=	"new_seat_added";
									$historyModel->category 	=	"adult";
									$historyModel->seat 		=	$saveSeat->adult_seat;
									$historyModel->save();
								}
								if(!empty($saveSeat->child_seat)){
									$historyModel_1 				=  new SeatHistory;
									$historyModel_1->package_id		=	$package_id;
									$historyModel_1->room_id 		=	5;
									$historyModel_1->created_by 	=	Auth::user()->id;
									$historyModel_1->type 			=	"cr";
									$historyModel_1->action 		=	"new_seat_added";
									$historyModel_1->category 		=	"child";
									$historyModel_1->seat 			=	$saveSeat->child_seat;
									$historyModel_1->save();
								}
							}
						}
						if(!empty($data[13]) && $data[13] != ""){
							$filteredData13 = str_replace("(","",$data[13]);
							$filteredData13 = str_replace(")","",$filteredData13);
							
							$room_5_array = explode(",",$filteredData13);
							if(!empty($room_5_array)){
								$saveSeat5					= 	new PackageSeat;
								$saveSeat5->package_id		=	$package_id;
								$saveSeat5->room_id			=	4;
								$saveSeat5->adult_price		=	!empty($room_5_array['0']) ? $room_5_array['0']: '0';
								$saveSeat5->adult_seat		=	!empty($room_5_array['1']) ? $room_5_array['1']: '0';
								$saveSeat5->child_price		=	!empty($room_5_array['2']) ? $room_5_array['2']: '0';
								$saveSeat5->child_seat		=	!empty($room_5_array['3']) ? $room_5_array['3']: '0';
								$saveSeat5->infant_price	=	!empty($room_5_array['4']) ? $room_5_array['4']: '0';
								$saveSeat5->total_seat		=	($saveSeat5->adult_seat + $saveSeat5->child_seat);
								$saveSeat5->booked_seat		=	0;
								$saveSeat5->is_active		=	1;
								$saveSeat5->is_deleted		=	0;
								$saveSeat5->save();
								
								if(!empty($saveSeat5->adult_seat)){
									$historyModel 				=  new SeatHistory;
									$historyModel->package_id	=	$package_id;
									$historyModel->room_id 		=	4;
									$historyModel->created_by 	=	Auth::user()->id;
									$historyModel->type 		=	"cr";
									$historyModel->action 		=	"new_seat_added";
									$historyModel->category 	=	"adult";
									$historyModel->seat 		=	$saveSeat5->adult_seat;
									$historyModel->save();
								}
								if(!empty($saveSeat5->child_seat)){
									$historyModel_1 				=  new SeatHistory;
									$historyModel_1->package_id		=	$package_id;
									$historyModel_1->room_id 		=	4;
									$historyModel_1->created_by 	=	Auth::user()->id;
									$historyModel_1->type 			=	"cr";
									$historyModel_1->action 		=	"new_seat_added";
									$historyModel_1->category 		=	"child";
									$historyModel_1->seat 			=	$saveSeat5->child_seat;
									$historyModel_1->save();
								}
							}
						}
						if(!empty($data[14]) && $data[14] != ""){
							$filteredData14 = str_replace("(","",$data[14]);
							$filteredData14 = str_replace(")","",$filteredData14);
							
							$room_4_array = explode(",",$filteredData14);
							if(!empty($room_4_array)){
								$saveSeat4					= 	new PackageSeat;
								$saveSeat4->package_id		=	$package_id;
								$saveSeat4->room_id			=	3;
								$saveSeat4->adult_price		=	!empty($room_4_array['0']) ? $room_4_array['0']: '0';
								$saveSeat4->adult_seat		=	!empty($room_4_array['1']) ? $room_4_array['1']: '0';
								$saveSeat4->child_price		=	!empty($room_4_array['2']) ? $room_4_array['2']: '0';
								$saveSeat4->child_seat		=	!empty($room_4_array['3']) ? $room_4_array['3']: '0';
								$saveSeat4->infant_price	=	!empty($room_4_array['4']) ? $room_4_array['4']: '0';
								$saveSeat4->total_seat		=	($saveSeat4->adult_seat + $saveSeat4->child_seat);
								$saveSeat4->booked_seat		=	0;
								$saveSeat4->is_active		=	1;
								$saveSeat4->is_deleted		=	0;
								$saveSeat4->save();
								
								if(!empty($saveSeat4->adult_seat)){
									$historyModel 				=  new SeatHistory;
									$historyModel->package_id	=	$package_id;
									$historyModel->room_id 		=	3;
									$historyModel->created_by 	=	Auth::user()->id;
									$historyModel->type 		=	"cr";
									$historyModel->action 		=	"new_seat_added";
									$historyModel->category 	=	"adult";
									$historyModel->seat 		=	$saveSeat4->adult_seat;
									$historyModel->save();
								}
								if(!empty($saveSeat4->child_seat)){
									$historyModel_1 				=  new SeatHistory;
									$historyModel_1->package_id		=	$package_id;
									$historyModel_1->room_id 		=	3;
									$historyModel_1->created_by 	=	Auth::user()->id;
									$historyModel_1->type 			=	"cr";
									$historyModel_1->action 		=	"new_seat_added";
									$historyModel_1->category 		=	"child";
									$historyModel_1->seat 			=	$saveSeat4->child_seat;
									$historyModel_1->save();
								}
							}
						}
						if(!empty($data[15]) && $data[15] != ""){
							$filteredData15 = str_replace("(","",$data[15]);
							$filteredData15 = str_replace(")","",$filteredData15);
							
							$room_3_array = explode(",",$filteredData15);
							if(!empty($room_3_array)){
								$saveSeat3					= 	new PackageSeat;
								$saveSeat3->package_id		=	$package_id;
								$saveSeat3->room_id			=	2;
								$saveSeat3->adult_price		=	!empty($room_3_array['0']) ? $room_3_array['0']: '0';
								$saveSeat3->adult_seat		=	!empty($room_3_array['1']) ? $room_3_array['1']: '0';
								$saveSeat3->child_price		=	!empty($room_3_array['2']) ? $room_3_array['2']: '0';
								$saveSeat3->child_seat		=	!empty($room_3_array['3']) ? $room_3_array['3']: '0';
								$saveSeat3->infant_price	=	!empty($room_3_array['4']) ? $room_3_array['4']: '0';
								$saveSeat3->total_seat		=	($saveSeat3->adult_seat + $saveSeat3->child_seat);
								$saveSeat3->booked_seat		=	0;
								$saveSeat3->is_active		=	1;
								$saveSeat3->is_deleted		=	0;
								$saveSeat3->save();
								
								if(!empty($saveSeat3->adult_seat)){
									$historyModel 				=  new SeatHistory;
									$historyModel->package_id	=	$package_id;
									$historyModel->room_id 		=	2;
									$historyModel->created_by 	=	Auth::user()->id;
									$historyModel->type 		=	"cr";
									$historyModel->action 		=	"new_seat_added";
									$historyModel->category 	=	"adult";
									$historyModel->seat 		=	$saveSeat3->adult_seat;
									$historyModel->save();
								}
								if(!empty($saveSeat3->child_seat)){
									$historyModel_1 				=  new SeatHistory;
									$historyModel_1->package_id		=	$package_id;
									$historyModel_1->room_id 		=	2;
									$historyModel_1->created_by 	=	Auth::user()->id;
									$historyModel_1->type 			=	"cr";
									$historyModel_1->action 		=	"new_seat_added";
									$historyModel_1->category 		=	"child";
									$historyModel_1->seat 			=	$saveSeat3->child_seat;
									$historyModel_1->save();
								}
							}
						}
						if(!empty($data[16]) && $data[16] != ""){
							$filteredData16 = str_replace("(","",$data[16]);
							$filteredData16 = str_replace(")","",$filteredData16);
							
							$room_2_array = explode(",",$filteredData16);
							if(!empty($room_2_array)){
								$saveSeat2					= 	new PackageSeat;
								$saveSeat2->package_id		=	$package_id;
								$saveSeat2->room_id			=	1;
								$saveSeat2->adult_price		=	!empty($room_2_array['0']) ? $room_2_array['0']: '0';
								$saveSeat2->adult_seat		=	!empty($room_2_array['1']) ? $room_2_array['1']: '0';
								$saveSeat2->child_price		=	!empty($room_2_array['2']) ? $room_2_array['2']: '0';
								$saveSeat2->child_seat		=	!empty($room_2_array['3']) ? $room_2_array['3']: '0';
								$saveSeat2->infant_price	=	!empty($room_2_array['4']) ? $room_2_array['4']: '0';
								$saveSeat2->total_seat		=	($saveSeat2->adult_seat + $saveSeat2->child_seat);
								$saveSeat2->booked_seat		=	0;
								$saveSeat2->is_active		=	1;
								$saveSeat2->is_deleted		=	0;
								$saveSeat2->save();
								
								if(!empty($saveSeat2->adult_seat)){
									$historyModel 				=  new SeatHistory;
									$historyModel->package_id	=	$package_id;
									$historyModel->room_id 		=	1;
									$historyModel->created_by 	=	Auth::user()->id;
									$historyModel->type 		=	"cr";
									$historyModel->action 		=	"new_seat_added";
									$historyModel->category 	=	"adult";
									$historyModel->seat 		=	$saveSeat2->adult_seat;
									$historyModel->save();
								}
								if(!empty($saveSeat2->child_seat)){
									$historyModel_1 				=  new SeatHistory;
									$historyModel_1->package_id		=	$package_id;
									$historyModel_1->room_id 		=	1;
									$historyModel_1->created_by 	=	Auth::user()->id;
									$historyModel_1->type 			=	"cr";
									$historyModel_1->action 		=	"new_seat_added";
									$historyModel_1->category 		=	"child";
									$historyModel_1->seat 			=	$saveSeat2->child_seat;
									$historyModel_1->save();
								}
							}
						}
						
						//save attributes
						if(!empty($data[17]) && $data[17] != "" && !empty($data[18]) && $data[18] != ""){
							$model 						=  new PackageAttribute;
							$model->package_id 			=  $package_id;
							$model->attribute_code 		=  "directflight_attribute_0";
							$model->attribute_title 	=  $data[17];
							$model->attribute_value 	=  $data[18];
							$model->counter				=  1;
							$model->is_active			=  1;
							$model->save();
							
							$attributeTitle		=	19;
							$attributeValue		=	20;
						}
						
						$counterAttr = "1";
						$counterRepeat = "1";
						if(!empty($attributeTitle) && !empty($data[$attributeTitle]) && $data[$attributeTitle] != "" && !empty($data[$attributeValue]) && $data[$attributeValue] != ""){
							$model.$counterRepeat 						=  new PackageAttribute;
							$model.$counterRepeat->package_id 			=  $package_id;
							$model.$counterRepeat->attribute_code 		=  "directflight_attribute_".$counterAttr;
							$model.$counterRepeat->attribute_title 		=  $data[$attributeTitle];
							$model.$counterRepeat->attribute_value 		=  $data[$attributeValue];
							$model.$counterRepeat->counter				=  1 + $counterAttr;
							$model.$counterRepeat->is_active			=  1;
							$model.$counterRepeat->save();
							
							$attributeTitle++;
							$attributeValue++;
							
							$counterRepeat++;
							$counterAttr++;
						}
						//echo "die"; die;
						
					}
				}
			}
			return Redirect::route('user.direct_flight')->with('success',trans("Package added successfully"));
		}
	}
	
	
	public function sendOrderPlacedEmail($orderId){
		
		$orderDetails = DonationOrder::select(
										'donation_orders.*',
											DB::raw("(select project_module from sub_projects where id=donation_orders.sub_project_id) as project_module"),
											DB::raw("(select sub_project_name from sub_projects where id=donation_orders.sub_project_id) as sub_project_name"),
											DB::raw("(select name from dropdown_managers where id=donation_orders.payment_method) as payment_method"),
											DB::raw("(select vendor from sub_projects where id=donation_orders.sub_project_id) as vendor")
										)->where('id',$orderId)->first();
		if(!empty($orderDetails)){
			$uniqueDonationId  		= $orderDetails->unique_donation_id;
			$paymentMethod  		= $orderDetails->payment_method;
			$subProjectName  		= $orderDetails->sub_project_name;
			
			$full_name  			= $orderDetails->full_name;
			$company_name  			= $orderDetails->company_name;
			$ic_number  			= $orderDetails->ic_number;
			$phone  				= $orderDetails->phone;
			$email  				= $orderDetails->email;
			$address  				= $orderDetails->address;
			$postcode  				= $orderDetails->postcode;
			$registration_number  	= $orderDetails->registration_number;
			$order_status  			= $orderDetails->order_status;
			
			$projectModule  	= $orderDetails->project_module;
			if($projectModule == 1){
				$moduleName	=	"Ansar";
				if(!empty($orderDetails->plan_price)){
					$activePlanPrice = DB::table('sub_project_plans')->where('id',Input::get('plan_price'))->pluck('price');
				}else{
					$activePlanPrice = $orderDetails->other_plan_price;
				}
			}else if($projectModule == 2){
				$moduleName	=	"Special Project";
				$activePlanPrice = $orderDetails->total_contribution;
			}else if($projectModule == 3){
				$moduleName	=	"Dana Lestari";
				if(!empty($orderDetails->dana_default_project_plan)){
					$activePlanPrice = SubProjectDanaDefaultPlan::where('id',$orderDetails->dana_default_project_plan)->pluck('amount');
				}else if(!empty($orderDetails->dana_property_plan)){
					$activePlanPrice = $orderDetails->total_contribution;
				}else if(!empty($orderDetails->dana_vendor)){
					$activePlanPrice = $orderDetails->total_contribution;
				}else{
					$activePlanPrice = 0;
				}
			}
			
			
		}
		
		$settingsEmail 			= 	Config::get('Settings.sender_mail');
		$SiteTitle 				= 	Config::get('Settings.business_name');
		$currencySign			=	Currency;
		//email to admin
		
		$to						=	$settingsEmail; //"hkentrant+101@gmail.com";
		$receiverName			=	$SiteTitle;
		
		$emailActions			= 	EmailAction::where('action','=','new_donation_order_admin')->get()->first();
		$emailTemplates			= 	EmailTemplate::where('action','=','new_donation_order_admin')->get(array('name','subject','action','body'))->first();
	
		$cons 					= 	explode(',',$emailActions['options']);
		$constants 				= 	array();
		
		foreach($cons as $key => $val){
			$constants[] 		= 	'{'.$val.'}';
		} 
		
		if(!empty($orderDetails->billId)){
			$invoice_link 			= WEBSITE_URL . "/invoice/".$orderDetails->billId;
		}else{
			$invoice_link 			= WEBSITE_URL . "/invoice/".$uniqueDonationId;
		}
		
		$subject 				= 	$emailTemplates['subject'];
		$rep_Array 				= 	array($uniqueDonationId,$paymentMethod,$subProjectName,$moduleName,$full_name,$company_name,$ic_number,$phone,$email,$address,$postcode,$activePlanPrice,$currencySign,$SiteTitle,$invoice_link); 
		$messageBody			= 	str_replace($constants, $rep_Array, $emailTemplates['body']);
		
		try{
			$mail					= 	$this->sendMail($to,$receiverName,$subject,$messageBody,$settingsEmail);
		}
		catch(\Exception $e){
			// Get error here
		}
		
		//email to vendor
		if(!empty($orderDetails->dana_vendor)){
			$vendorIds = explode(",",$orderDetails->dana_vendor);
			$vendorDetails = User::select('id','email','full_name')->whereIn('id',$vendorIds)->where('user_role_id',2)->get();
			//pr($vendorDetails); die;
			if(!empty($vendorDetails)){
			  foreach($vendorDetails as $vendorDetail){
				$vendorTo			=	$vendorDetail->email;
				$vendorName			=	$vendorDetail->full_name;
				
				$emailActions1			= 	EmailAction::where('action','=','new_booking_vendor')->get()->first();
				$emailTemplates1		= 	EmailTemplate::where('action','=','new_booking_vendor')->get(array('name','subject','action','body'))->first();
			
				$cons1 					= 	explode(',',$emailActions1['options']);
				$constants1 			= 	array();
				
				foreach($cons1 as $key => $val){
					$constants1[] 		= 	'{'.$val.'}';
				} 
				
				$subject1 				= 	$emailTemplates1['subject'];
				$rep_Array1 			= 	array($uniqueDonationId,$paymentMethod,$subProjectName,$moduleName,$full_name,$company_name,$ic_number,$phone,$email,$address,$postcode,$activePlanPrice,$currencySign,$SiteTitle,$invoice_link); 
				$messageBody1			= 	str_replace($constants1, $rep_Array1, $emailTemplates1['body']);
				$mail					= 	$this->sendMail($vendorTo,$vendorName,$subject1,$messageBody1,$settingsEmail);
				
			  }
			}
		}
		
		
		//email to donor
		$guestTo				=	$email;
		$guestReceiver			=	$full_name;
		
		$emailActions1			= 	EmailAction::where('action','=','new_donation_created_donor')->get()->first();
		$emailTemplates1		= 	EmailTemplate::where('action','=','new_donation_created_donor')->get(array('name','subject','action','body'))->first();
	
		$cons1 					= 	explode(',',$emailActions1['options']);
		$constants1 			= 	array();
		
		foreach($cons1 as $key => $val){
			$constants1[] 		= 	'{'.$val.'}';
		} 
		
		$subject1 				= 	$emailTemplates1['subject'];
		$rep_Array1 			= 	array($uniqueDonationId,$paymentMethod,$subProjectName,$moduleName,$full_name,$company_name,$ic_number,$phone,$email,$address,$postcode,$activePlanPrice,$currencySign,$SiteTitle,$invoice_link); 
		$messageBody1			= 	str_replace($constants1, $rep_Array1, $emailTemplates1['body']);
		try{
			$mail					= 	$this->sendMail($guestTo,$guestReceiver,$subject1,$messageBody1,$settingsEmail);
		}
		catch(\Exception $e){
			// Get error here
		}
	}
	
	public function sendEnquiryEmail($orderId){
		
		$orderDetails = DonationOrder::select(
										'donation_orders.*',
											DB::raw("(select project_module from sub_projects where id=donation_orders.sub_project_id) as project_module"),
											DB::raw("(select sub_project_name from sub_projects where id=donation_orders.sub_project_id) as sub_project_name")
										)->where('id',$orderId)->first();
		if(!empty($orderDetails)){
			$uniqueDonationId  		= $orderDetails->unique_donation_id;
			$subProjectName  		= $orderDetails->sub_project_name;
			
			$full_name  			= $orderDetails->full_name;
			$company_name  			= $orderDetails->company_name;
			$ic_number  			= $orderDetails->ic_number;
			$phone  				= $orderDetails->phone;
			$email  				= $orderDetails->email;
			$address  				= $orderDetails->address;
			$postcode  				= $orderDetails->postcode;
			$registration_number  	= $orderDetails->registration_number;
			
			$projectModule  	= $orderDetails->project_module;
			if($projectModule == 1){
				$moduleName	=	"Ansar";
			}else if($projectModule == 2){
				$moduleName	=	"Special Project";
			}else if($projectModule == 3){
				$moduleName	=	"Dana Lestari";
			}
			
			
			$settingsEmail 			= 	Config::get('Settings.sender_mail');
			$SiteTitle 				= 	Config::get('Settings.business_name');
			$currencySign			=	Currency;
			//email to admin
			
			$to						=	$settingsEmail; //"hkentrant+admin@gmail.com";
			$receiverName			=	$SiteTitle;
			
			$emailActions			= 	EmailAction::where('action','=','new_donation_enquiry_admin')->get()->first();
			$emailTemplates			= 	EmailTemplate::where('action','=','new_donation_enquiry_admin')->get(array('name','subject','action','body'))->first();
		
			$cons 					= 	explode(',',$emailActions['options']);
			$constants 				= 	array();
			
			foreach($cons as $key => $val){
				$constants[] 		= 	'{'.$val.'}';
			} 
			
			$subject 				= 	$emailTemplates['subject'];
			$rep_Array 				= 	array($uniqueDonationId,$subProjectName,$moduleName,$full_name,$company_name,$ic_number,$phone,$email,$address,$postcode,$SiteTitle); 
			$messageBody			= 	str_replace($constants, $rep_Array, $emailTemplates['body']);
			$mail					= 	$this->sendMail($to,$receiverName,$subject,$messageBody,$settingsEmail);
			
			
			//email to donar
			$donorTo				=	$email;
			$donarName				=	$full_name;
			
			$emailActions			= 	EmailAction::where('action','=','new_donation_enquiry_donor')->get()->first();
			$emailTemplates			= 	EmailTemplate::where('action','=','new_donation_enquiry_donor')->get(array('name','subject','action','body'))->first();
		
			$cons 					= 	explode(',',$emailActions['options']);
			$constants 				= 	array();
			
			foreach($cons as $key => $val){
				$constants[] 		= 	'{'.$val.'}';
			} 
			
			$subject 				= 	$emailTemplates['subject'];
			$rep_Array 				= 	array($uniqueDonationId,$subProjectName,$moduleName,$full_name,$company_name,$ic_number,$phone,$email,$address,$postcode,$SiteTitle); 
			$messageBody			= 	str_replace($constants, $rep_Array, $emailTemplates['body']);
			$mail					= 	$this->sendMail($to,$receiverName,$subject,$messageBody,$settingsEmail);
			
		}
		
	}
	
	public function sendAmountPaidEmail($orderId,$paymentId){
		
		$orderDetails = DonationOrder::select(
										'donation_orders.*',
											DB::raw("(select project_module from sub_projects where id=donation_orders.sub_project_id) as project_module"),
											DB::raw("(select sub_project_name from sub_projects where id=donation_orders.sub_project_id) as sub_project_name"),
											DB::raw("(select name from dropdown_managers where id=donation_orders.payment_method) as payment_method")
										)->where('id',$orderId)->first();
		if(!empty($orderDetails)){
			$uniqueDonationId  		= $orderDetails->unique_donation_id;
			$paymentMethod  		= $orderDetails->payment_method;
			$subProjectName  		= $orderDetails->sub_project_name;
			
			$full_name  			= $orderDetails->full_name;
			$company_name  			= $orderDetails->company_name;
			$ic_number  			= $orderDetails->ic_number;
			$phone  				= $orderDetails->phone;
			$email  				= $orderDetails->email;
			$address  				= $orderDetails->address;
			$postcode  				= $orderDetails->postcode;
			$registration_number  	= $orderDetails->registration_number;
			$order_status  			= $orderDetails->order_status;
			
			$projectModule  	= $orderDetails->project_module;
			if($projectModule == 1){
				$moduleName	=	"Ansar";
				if(!empty($orderDetails->plan_price)){
					$activePlanPrice = DB::table('sub_project_plans')->where('id',Input::get('plan_price'))->pluck('price');
				}else{
					$activePlanPrice = $orderDetails->other_plan_price;
				}
			}else if($projectModule == 2){
				$moduleName	=	"Special Project";
				$activePlanPrice = $orderDetails->total_contribution;
			}else if($projectModule == 3){
				$moduleName	=	"Dana Lestari";
				if(!empty($orderDetails->dana_default_project_plan)){
					$activePlanPrice = SubProjectDanaDefaultPlan::where('id',$orderDetails->dana_default_project_plan)->pluck('amount');
				}else if(!empty($orderDetails->dana_property_plan)){
					$activePlanPrice = $orderDetails->total_contribution;
				}else if(!empty($orderDetails->dana_vendor)){
					$activePlanPrice = $orderDetails->total_contribution;
				}else{
					$activePlanPrice = 0;
				}
			}
			
			$paymentDetails = DonationPayment::select(
												'donation_payments.*',
													DB::raw("(select name from dropdown_managers where id=donation_payments.payment_option) as payment_option")
												)->where('id',$paymentId)->first();
												
			$invoiceId		=	$paymentDetails->invoice_id;
			$payment_option	=	$paymentDetails->payment_option;
			$reference_id	=	$paymentDetails->reference_id;
			$amount			=	$paymentDetails->amount;
			$paymentDate	=	date("d/m/Y h:i A",strtotime($paymentDetails->created_at));
			$invoice_link	=	WEBSITE_URL . "invoice/".$invoiceId;
			
		}
		
		
		
		$settingsEmail 			= 	Config::get('Settings.sender_mail');
		$SiteTitle 				= 	Config::get('Settings.business_name');
		$currencySign			=	Currency;
		//email to admin
		
		$to						=	$settingsEmail; //"hkentrant+Admin@gmail.com";
		$receiverName			=	$SiteTitle;
		
		$emailActions			= 	EmailAction::where('action','=','donation_paid_admin')->get()->first();
		$emailTemplates			= 	EmailTemplate::where('action','=','donation_paid_admin')->get(array('name','subject','action','body'))->first();
	
		$cons 					= 	explode(',',$emailActions['options']);
		$constants 				= 	array();
		
		foreach($cons as $key => $val){
			$constants[] 		= 	'{'.$val.'}';
		} 
		
		$subject 				= 	$emailTemplates['subject'];
		$rep_Array 				= 	array($uniqueDonationId,$moduleName,$subProjectName,$invoiceId,$payment_option,$reference_id,$amount,$currencySign,$paymentDate,$invoice_link,$SiteTitle,$full_name,$company_name,$ic_number,$phone,$email,$address); 
		$messageBody			= 	str_replace($constants, $rep_Array, $emailTemplates['body']);
		$mail					= 	$this->sendMail($to,$receiverName,$subject,$messageBody,$settingsEmail);
		
		
		//email to Donar
		$guestTo				=	$email;
		$guestReceiver			=	$full_name;
		
		$emailActions1			= 	EmailAction::where('action','=','donation_paid_guest')->get()->first();
		$emailTemplates1		= 	EmailTemplate::where('action','=','donation_paid_guest')->get(array('name','subject','action','body'))->first();
	
		$cons1 					= 	explode(',',$emailActions1['options']);
		$constants1 			= 	array();
		
		foreach($cons1 as $key => $val){
			$constants1[] 		= 	'{'.$val.'}';
		} 
		
		$subject1 				= 	$emailTemplates1['subject'];
		$rep_Array1 			= 	array($uniqueDonationId,$moduleName,$subProjectName,$invoiceId,$payment_option,$reference_id,$amount,$currencySign,$paymentDate,$invoice_link,$SiteTitle,$full_name,$company_name,$ic_number,$phone,$email,$address); 
		$messageBody1			= 	str_replace($constants1, $rep_Array1, $emailTemplates1['body']);
		$mail					= 	$this->sendMail($guestTo,$guestReceiver,$subject1,$messageBody1,$settingsEmail);
		
	}
	
	public function sendRegistrationEmail($email,$full_name,$phone,$refferal_id){
		
		$settingsEmail 			= 	Config::get('Settings.sender_mail');
		$SiteTitle 				= 	Config::get('Settings.business_name');
	
		//email to admin
		
		$to						=	$settingsEmail; //"hkentrant+Admin@gmail.com";
		$receiverName			=	$SiteTitle;
		
		$emailActions			= 	EmailAction::where('action','=','sales_person_registration_admin')->get()->first();
		$emailTemplates			= 	EmailTemplate::where('action','=','sales_person_registration_admin')->get(array('name','subject','action','body'))->first();
	
		$cons 					= 	explode(',',$emailActions['options']);
		$constants 				= 	array();
		
		foreach($cons as $key => $val){
			$constants[] 		= 	'{'.$val.'}';
		} 
		
		$subject 				= 	$emailTemplates['subject'];
		$rep_Array 				= 	array($email,$full_name,$phone,$refferal_id); 
		$messageBody			= 	str_replace($constants, $rep_Array, $emailTemplates['body']);
		$mail					= 	$this->sendMail($to,$receiverName,$subject,$messageBody,$settingsEmail);
		
		
		//email to sales person
		$salesPersonTo			=	$email;
		$salesPersonReceiver	=	$full_name;
		
		$emailActions1			= 	EmailAction::where('action','=','sales_person_registration')->get()->first();
		$emailTemplates1		= 	EmailTemplate::where('action','=','sales_person_registration')->get(array('name','subject','action','body'))->first();
	
		$cons1 					= 	explode(',',$emailActions1['options']);
		$constants1 			= 	array();
		
		foreach($cons1 as $key => $val){
			$constants1[] 		= 	'{'.$val.'}';
		} 
		
		$subject1 				= 	$emailTemplates1['subject'];
		$rep_Array1 			= 	array($email,$full_name,$phone,$refferal_id);
		$messageBody1			= 	str_replace($constants1, $rep_Array1, $emailTemplates1['body']);
		$mail					= 	$this->sendMail($salesPersonTo,$salesPersonReceiver,$subject1,$messageBody1,$settingsEmail);
		
		
	}
	
	public function sendRemainder($orderId){
		if(empty($orderId)){
			Session::flash('flash_notice',  trans("Something went wrong! Order Not Fetch."));
			return redirect()->back();
		}
		
		$orderDetails = DonationOrder::select(
										'donation_orders.*',
											DB::raw("(select project_module from sub_projects where id=donation_orders.sub_project_id) as project_module"),
											DB::raw("(select sub_project_name from sub_projects where id=donation_orders.sub_project_id) as sub_project_name"),
											DB::raw("(select name from dropdown_managers where id=donation_orders.payment_method) as payment_method"),
											DB::raw("(select vendor from sub_projects where id=donation_orders.sub_project_id) as vendor")
										)->where('unique_donation_id',$orderId)->first();
		if(!empty($orderDetails)){
			$uniqueDonationId  		= $orderDetails->unique_donation_id;
			$paymentMethod  		= $orderDetails->payment_method;
			$subProjectName  		= $orderDetails->sub_project_name;
			
			$full_name  			= $orderDetails->full_name;
			$company_name  			= $orderDetails->company_name;
			$ic_number  			= $orderDetails->ic_number;
			$phone  				= $orderDetails->phone;
			$email  				= $orderDetails->email;
			$address  				= $orderDetails->address;
			$postcode  				= $orderDetails->postcode;
			$registration_number  	= $orderDetails->registration_number;
			$order_status  			= $orderDetails->order_status;
			
			$projectModule  	= $orderDetails->project_module;
			if($projectModule == 1){
				$moduleName	=	"Ansar";
				if(!empty($orderDetails->plan_price)){
					$activePlanPrice = DB::table('sub_project_plans')->where('id',Input::get('plan_price'))->pluck('price');
				}else{
					$activePlanPrice = $orderDetails->other_plan_price;
				}
			}else if($projectModule == 2){
				$moduleName	=	"Special Project";
				$activePlanPrice = $orderDetails->total_contribution;
			}else if($projectModule == 3){
				$moduleName	=	"Dana Lestari";
				if(!empty($orderDetails->dana_default_project_plan)){
					$activePlanPrice = SubProjectDanaDefaultPlan::where('id',$orderDetails->dana_default_project_plan)->pluck('amount');
				}else if(!empty($orderDetails->dana_property_plan)){
					$activePlanPrice = $orderDetails->total_contribution;
				}else if(!empty($orderDetails->dana_vendor)){
					$activePlanPrice = $orderDetails->total_contribution;
				}else{
					$activePlanPrice = 0;
				}
			}
			
			
			$currency_sign 			= Currency;
			$invoice_link 			= WEBSITE_URL . "/invoice/".$orderDetails->bill_id;
			
			
			//send sms
			if(!empty($phone)){
				$smsActions			= 	SmsAction::where('action','=','pending_payment_reminder_customer')->get()->first();
				$smsTemplates		= 	SmsTemplate::where('action','=','pending_payment_reminder_customer')->get(array('name','subject','action','body'))->first();
				
				$cons 				= 	explode(',',$smsActions['options']);
				$constants 			= 	array();
				
				foreach($cons as $key => $val){
					$constants[] 	= 	'{'.$val.'}';
				} 
				
				$rep_Array 			= 	array($uniqueDonationId,$activePlanPrice,$invoice_link); 
				$body				= 	str_replace($constants, $rep_Array, $smsTemplates['body']);
				$this->_sendSms($phone,$body);
			}
			
			if(!empty($orderDetails->vendor)){
				$vendorDetails = User::select('id','full_name','phone')->where('id',$orderDetails->vendor)->first();
				if(!empty($vendorDetails)){
					$vendorPhone = $vendorDetails->phone;
					
					$smsActions			= 	SmsAction::where('action','=','pending_payment_reminder_vendor')->get()->first();
					$smsTemplates		= 	SmsTemplate::where('action','=','pending_payment_reminder_vendor')->get(array('name','subject','action','body'))->first();
					
					$cons 				= 	explode(',',$smsActions['options']);
					$constants 			= 	array();
					
					foreach($cons as $key => $val){
						$constants[] 	= 	'{'.$val.'}';
					} 
					
					$rep_Array 			= 	array($uniqueDonationId,$activePlanPrice,$invoice_link); 
					$body				= 	str_replace($constants, $rep_Array, $smsTemplates['body']);
					$this->_sendSms($vendorPhone,$body);
				}
			}
			
			//email settings
			$settingsEmail 			= 	Config::get('Settings.sender_mail');
			$SiteTitle 				= 	Config::get('Settings.business_name');
		
			
			//email to donor
			$to						=	$email; //"hkentrant+reminder@gmail.com";
			$receiverName			=	$full_name;
			
			$emailActions			= 	EmailAction::where('action','=','send_remainder')->get()->first();
			$emailTemplates			= 	EmailTemplate::where('action','=','send_remainder')->get(array('name','subject','action','body'))->first();
		
			$cons 					= 	explode(',',$emailActions['options']);
			$constants 				= 	array();
			
			foreach($cons as $key => $val){
				$constants[] 		= 	'{'.$val.'}';
			} 
			
			$subject 				= 	$emailTemplates['subject'];
			$rep_Array 				= 	array($uniqueDonationId,$subProjectName,$moduleName,$full_name,$company_name,$phone,$email,$activePlanPrice,$currency_sign,$invoice_link,$SiteTitle); 
			$messageBody			= 	str_replace($constants, $rep_Array, $emailTemplates['body']);
			$mail					= 	$this->sendMail($to,$receiverName,$subject,$messageBody,$settingsEmail);
			
			Session::flash('success',  trans("Remainder Email Sent Successfully."));
			return redirect()->back();
			
		}else{
			
			Session::flash('error',  trans("Something went wrong! Order Not Fetch."));
			return redirect()->back();
		}
	}
	
	
	
	
	
	
	
	
	//new
	public function ProjectTemplate(){
		$ansarProjectLists = DB::table('projects')->where('is_deleted',0)->where('project_module',1)->lists('name','id');
		$specialProjectLists = DB::table('projects')->where('is_deleted',0)->where('project_module',2)->lists('name','id');
		$danaLestariProjectLists = DB::table('projects')->where('is_deleted',0)->where('project_module',3)->lists('name','id');
		
		return View::make('front.user.project_template',compact("ansarProjectLists","specialProjectLists","danaLestariProjectLists"));
	}
	
	public function AddNewProject(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'name'				=> 'required',
			),
			array(
				"name.required"		=>	trans("Please enter project name"),
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
			$model 						=  new Project;
			$model->project_module 		=  Input::get('project_module');
			$model->name 				=  Input::get('name');
			$model->slug				=  $this->getSlug($model->name,'slug','Project');
			$model->is_active			=  1;
			$model->save();
			$modelId					=	$model->id;		
			
			$err						=	array();
			$err['success']				=	1;
			$err['ProjectModule']		=	Input::get('project_module');
			$err['message']				=	trans("Project added successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function UpdateProjectName(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'ProjectId'			=> 'required',
				'ProjectName'		=> 'required',
			),
			array(
				"ProjectId.required"	=>	trans("Project not found!"),
				"ProjectName.required"	=>	trans("Please enter project name"),
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
			$model 						=  Project::find(Input::get('ProjectId'));
			$model->name 				=  Input::get('ProjectName');
			$model->slug				=  $this->getSlug($model->name,'slug','Project');
			$model->save();
			$modelId					=	$model->id;		
			
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Project added successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function DeleteProjectBlock(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		if(!empty(Input::get('blockId'))){
			$totalSubProject = SubProject::where('project_id',Input::get('blockId'))->where('is_deleted',0)->count('id');
			if($totalSubProject == 0){
				$checkProject = Project::where('id',Input::get('blockId'))->delete();
			}else{
				$checkProject = Project::where('id',Input::get('blockId'))->update(array('is_deleted'=>1));
			}
			
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Project Block Deleted Successfully.");
			return Response::json($err); 
			die;
				
		}else{
			Session::flash('flash_notice',  trans("Project Block Not Deleted!"));
			
			$err						=	array();
			$err['error']				=	1;
			$err['message']				=	trans("Project Block Not Deleted.");
			return Response::json($err); 
			die;
				
		}
		
	}
	
	public function ChangeProjectOrder(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		if(!empty(Input::get('blockId'))){
			$ModuleId = $thisData['ModuleId'];
			$newOrder	=	Input::get('order');
			$checkProjectWithSameOrder = Project::where('id','!=',Input::get('blockId'))->where('project_module',$ModuleId)->where('order',$newOrder)->where('is_deleted',0)->pluck('id');
			Project::where('id',Input::get('blockId'))->where('project_module',$ModuleId)->update(array('order'=>$newOrder));
			if(!empty($checkProjectWithSameOrder)){
				Project::where('id','!=',Input::get('blockId'))->where('project_module',$ModuleId)->where('order','>=',$newOrder)->update(['order'=> DB::raw('`order` + 1')]);
			}
			
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Project Order Updated Successfully.");
			return Response::json($err); die;
		}else{
			Session::flash('flash_notice',  trans("Project Order Not Updated!"));
			
			$err						=	array();
			$err['error']				=	1;
			$err['message']				=	trans("Project Order Not Updated.");
			return Response::json($err); die;
		}
	}
	
	public function DeleteSubProjectBlock(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		if(!empty(Input::get('SubProjectBlockId'))){
			SubProject::where('id',Input::get('SubProjectBlockId'))->update(array('is_deleted'=>1));
			
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Project Block Deleted Successfully.");
			return Response::json($err); 
			die;
				
		}else{
			Session::flash('flash_notice',  trans("Project Block Not Deleted!"));
			
			$err						=	array();
			$err['error']				=	1;
			$err['message']				=	trans("Project Block Not Deleted.");
			return Response::json($err); 
			die;
				
		}
		
	}
	
	public function getDestinationProjectBlock(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		if(!empty(Input::get('moduleId')) && !empty(Input::get('subProjectId'))){
			
			$checkSubProject = SubProject::select('id','sub_project_name','project_id')->where('id',Input::get('subProjectId'))->where('project_module',Input::get('moduleId'))->first();
			if(!empty($checkSubProject)){
				$projectBlockList = DB::table('projects')->where('project_module',Input::get('moduleId'))->where('id','!=',$checkSubProject->project_id)->lists('name','id');
				
				$err						=	array();
				$err['success']				=	1;
				$err['projectBlockList']	=	$projectBlockList;
				$err['movableProjectName']	=	$checkSubProject->sub_project_name;
				$err['message']				=	trans("Project Block List Getting Successfully.");
				return Response::json($err); 
				die;
				
			}else{
				$err						=	array();
				$err['error']				=	2;
				$err['message']				=	trans("Invalid Action Performed!");
				return Response::json($err); 
				die;
				
			}
				
		}else{
			Session::flash('flash_notice',  trans("Something got wrong! Please try again."));
			
			$err						=	array();
			$err['error']				=	1;
			$err['message']				=	trans("Something got wrong! Please try again.");
			return Response::json($err); 
			die;
				
		}
		
	}
	
	public function MoveSubProjectBlock(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		if(!empty(Input::get('dastinationProjectId')) && !empty(Input::get('subProjectId'))){
			
			SubProject::where('id',Input::get('subProjectId'))->update(array('project_id'=>Input::get('dastinationProjectId')));
			
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Project Destination Changed Successfully.");
			return Response::json($err); 
			die;
			
		}else{
			Session::flash('flash_notice',  trans("Something got wrong! Please try again."));
			
			$err						=	array();
			$err['error']				=	1;
			$err['message']				=	trans("Something got wrong! Please try again.");
			return Response::json($err); 
			die;
				
		}
		
		
	}
	
	public function AddNewSubProject(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'sub_project_name'				=> 'required',
				'project_id'					=> 'required',
			),
			array(
				"sub_project_name.required"		=>	trans("Please enter subproject name"),
				"project_id.required"			=>	trans("Please select project"),
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
			$model 						=  new SubProject;
			$model->project_module 		=  Input::get('project_module');
			$model->project_id 			=  Input::get('project_id');
			$model->sub_project_name 	=  Input::get('sub_project_name');
			$model->slug				=  $this->getSlug($model->sub_project_name,'slug','SubProject');
			$model->is_active			=  1;
			$model->save();
			$modelId					=	$model->id;		
			
			$err						=	array();
			$err['success']				=	1;
			$err['ProjectModule']		=	Input::get('project_module');
			$err['message']				=	trans("Sub project added successfully.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function GetSubProjects(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		if(!empty($thisData['ModuleId'])){
			$module_id = $thisData['ModuleId'];
			$projectLists = DB::table('projects')->where('is_deleted',0)->where('project_module',$thisData['ModuleId'])->orderBy('created_at','ASC')->get();
			if(!empty($projectLists)){
				foreach($projectLists as &$projectList){
					$subProjectLists = DB::table('sub_projects')->where('is_deleted',0)->where('project_module',$thisData['ModuleId'])->where('project_id',$projectList->id)->orderBy('created_at','ASC')->get();
					
					$projectList->SubProjects = $subProjectLists;
				}
			}
			//pr($projectLists); die;
			
			$Projects = DB::table('projects')->where('is_deleted',0)->where('project_module',$module_id)->lists('name','id');
			
			return View::make('front.user.get_subproject_html',compact("projectLists","module_id","Projects"));
		}else{
			
			$err						=	array();
			$err['error']				=	1;
			$err['message']				=	trans("Something went wrong!");
			return Response::json($err); 
			die;
		}
	}
	
	public function ProjectTemplateAdd($slug = ""){
		Session::forget('TemplateHeaderImage');
		Session::forget('TemplateSliderImage');
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Pagination Error!"));
			return redirect()->back();
		}
		
		$subProjectDetails = DB::table('sub_projects')->where('slug',$slug)->first();
		
		$paymentMethods = PaymentOption::where('is_active',1)->orderBy('id','ASC')->lists('name','id');
		
		$vendorLists = User::where('is_active',1)->where('is_deleted',0)->where('user_role_id',2)->lists('full_name','id');
		
		return View::make('front.user.project_template_add',compact("subProjectDetails","paymentMethods","vendorLists"));
	}
	
	public function ProjectTemplateEdit($slug = ""){
		Session::forget('TemplateHeaderImage');
		Session::forget('TemplateSliderImage');
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Pagination Error!"));
			return redirect()->back();
		}
		
		$subProjectDetails = DB::table('sub_projects')->where('is_deleted',0)->where('slug',$slug)->first();
		$selectedVendors = array();
		if(!empty($subProjectDetails)){
			if(!empty($subProjectDetails->vendor) && !is_integer($subProjectDetails->vendor)){
				$selectedVendorsArray = explode(",",$subProjectDetails->vendor);
				if(!empty($selectedVendorsArray)){
					foreach($selectedVendorsArray as $selectedVendorIds){
						$selectedVendors[$selectedVendorIds]	=	$selectedVendorIds;
					}
				}
			}
		}
		
		$sliderImages = TemplateSliderImage::where('sub_project_id',$subProjectDetails->id)->get();
		
		$vendorLists = User::where('is_active',1)->where('is_deleted',0)->where('user_role_id',2)->lists('full_name','id');
		
		$dailyPlanDetails = DB::table('sub_project_plans')->where('type','daily')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->get();
		$dailyPeriodDetails = DB::table('sub_project_periods')->where('type','daily')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->get();
		//pr($subProjectDetails); die;
		
		$monthlyPlanDetails = DB::table('sub_project_plans')->where('type','monthly')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->get();
		$monthlyPeriodDetails = DB::table('sub_project_periods')->where('type','monthly')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->get();
		
		$yearlyPlanDetails = DB::table('sub_project_plans')->where('type','yearly')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->get();
		$yearlyPeriodDetails = DB::table('sub_project_periods')->where('type','yearly')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->get();
		
		$defaultPlanDetails = DB::table('sub_project_default_plans')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->get();
		$seatReservationPlans	=	SeatReservationSubtitle::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		if(!empty($seatReservationPlans)){
			foreach($seatReservationPlans as &$seatReservationPlan){
				$seatReservationDetails	=	DB::table('sub_project_seat_reservation_plans')->where('sub_project_id',$subProjectDetails->id)->where('sub_title_id',$seatReservationPlan->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
				
				$seatReservationPlan->ReservationSeats	=	$seatReservationDetails;
			}
		}
		
		$quantityPlans	=	SubProjectQuantityPlan::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		$sectionPlans	=	SubProjectSectionPlan::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		//pr($sectionPlans); die;
		
		$defaultDanaPlanDetails = SubProjectDanaDefaultPlan::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->get();
		$PropertyTypeDanaPlanDetails = SubProjectDanaPropertyType::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->get();
		$PriceRangeDanaPlanDetails = SubProjectDanaPriceRange::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->get();
		//pr($PriceRangeDanaPlanDetails); die;
		
		$paymentMethods = PaymentOption::where('is_active',1)->orderBy('id','ASC')->lists('name','id');
		
		return View::make('front.user.project_template_edit',compact("subProjectDetails","paymentMethods","dailyPlanDetails","dailyPeriodDetails","monthlyPlanDetails","monthlyPeriodDetails","yearlyPlanDetails","yearlyPeriodDetails","defaultPlanDetails","defaultDanaPlanDetails","PropertyTypeDanaPlanDetails","PriceRangeDanaPlanDetails","sectionPlans","seatReservationPlans","quantityPlans","vendorLists","selectedVendors","sliderImages"));
	}
	
	public function DeleteTemplateImage(){
		if(!empty(Input::get('imageId'))) {
			$imageId = Input::get('imageId');
		
			$imageName = TemplateSliderImage::where('id',$imageId)->pluck('image');
			
			$image_path = TEMPLATE_IMG_ROOT_PATH.$imageName;
			
			TemplateSliderImage::where('id',$imageId)->delete();
			
			if(File::exists($image_path)) {
				File::delete($image_path);
			}
			
		}
		
		echo "1"; die;
		
	}
	
	public function DeleteHeaderImage(){
		if(!empty(Input::get('projectId'))) {
			$projectId = Input::get('projectId');
		
			$imageName = SubProject::where('id',$projectId)->pluck('header_image');
			
			$image_path = TEMPLATE_IMG_ROOT_PATH.$imageName;
			
			SubProject::where('id',$projectId)->update(['header_image'=>'']);
			
			if(File::exists($image_path)) {
				File::delete($image_path);
			}
			
		}
		
		echo "1"; die;
		
	}
	
	public function AddMoreDailyPlan(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_daily_plan',compact("counter"));
	}
	
	public function AddMoreDailyPeriod(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_daily_period',compact("counter"));
	}
	
	public function AddMoreMonthlyPlan(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_monthly_plan',compact("counter"));
	}
	
	public function AddMoreMonthlyPeriod(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_monthly_period',compact("counter"));
	}
	
	public function AddMoreYearlyPlan(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_yearly_plan',compact("counter"));
	}
	
	public function AddMoreYearlyPeriod(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_yearly_period',compact("counter"));
	}
	
	public function AddMoreDefaultProjectPlan(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_default_plan',compact("counter"));
	}
	
	public function AddMoreSeatReservationSubtitle(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.get_special_project_properties',compact("counter"));
	}
	
	public function AddMoreSeatReservationPlans(){
		$userId							=	Auth::user()->id;
		$subTitleCount					=	Input::get('subTitleCount');
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_special_projects',compact("counter","subTitleCount"));
	}
	
	public function AddMoreQuantityProjectPlan(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_quantity_plans',compact("counter"));
	}
	
	public function AddMoreSectionProjectPlan(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_section_plans',compact("counter"));
	}
	
	public function SaveProjectTemplate(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$DailyPlans						=	!empty($thisData['DailyPlan'])?$thisData['DailyPlan']:'';
		$DailyPeriods					=	!empty($thisData['DailyPeriod'])?$thisData['DailyPeriod']:'';
		$MonthlyPlans					=	!empty($thisData['MonthlyPlan'])?$thisData['MonthlyPlan']:'';
		$MonthlyPeriods					=	!empty($thisData['MonthlyPeriod'])?$thisData['MonthlyPeriod']:'';
		$YearlyPlans					=	!empty($thisData['YearlyPlan'])?$thisData['YearlyPlan']:'';
		$YearlyPeriods					=	!empty($thisData['YearlyPeriod'])?$thisData['YearlyPeriod']:'';
		
		//start special projects content
		$DefaultPlans					=	!empty($thisData['DefaultPlan'])?$thisData['DefaultPlan']:'';
		$SeatReservations				=	!empty($thisData['SeatReservation'])?$thisData['SeatReservation']:'';
		$QuantityPlans					=	!empty($thisData['QuantityPlan'])?$thisData['QuantityPlan']:'';
		$SectionPlans					=	!empty($thisData['SectionPlan'])?$thisData['SectionPlan']:'';
		
		//start dana lastari projects content
		$DefaultDanaPlans				=	!empty($thisData['DefaultDanaPlan'])?$thisData['DefaultDanaPlan']:'';
		$PropertyTypes					=	!empty($thisData['PropertyType'])?$thisData['PropertyType']:'';
		$PropertyPriceRanges			=	!empty($thisData['PropertyPriceRange'])?$thisData['PropertyPriceRange']:'';
		
		$userId							=	Auth::user()->id;
		
		// pr(Session::get('TemplateHeaderImage'));
		// pr(Session::get('TemplateSliderImage'));
		
		$getProjectModule = DB::table('sub_projects')->where('id',Input::get('sub_project_id'))->pluck('project_module');
		
		$array_2=array("project_module"=>$getProjectModule);
		$thisData = array_merge($thisData,$array_2);
		
		$validator = Validator::make(
			$thisData,
			array(
				'sub_project_name'				=> 'required',
				'subject_type'					=> 'required',
				'payment_type'					=> 'required',
				'payment_method'				=> 'required',
				'contributor_type'				=> 'required',
				'target_amount'					=> 'required',
				'donation_btn_url'				=> 'required_if:donation_btn_type,url',
				'daily_status'					=> 'required_if:project_module,1',
				'daily_description'				=> 'required_if:project_module,1',
				'daily_description_ms'			=> 'required_if:project_module,1',
				'monthly_status'				=> 'required_if:project_module,1',
				'monthly_description'			=> 'required_if:project_module,1',
				'monthly_description_ms'		=> 'required_if:project_module,1',
				'yearly_status'					=> 'required_if:project_module,1',
				'yearly_description'			=> 'required_if:project_module,1',
				'yearly_description_ms'			=> 'required_if:project_module,1',
				'editor_status'					=> 'required_if:project_module,1',
				'editor'						=> 'required_if:editor_status,=,1',
				
				'customize_plan_option'				=> 'required_if:project_module,2',
				'seat_reservation_main_title'		=> 'required_if:customize_plan_option,2',
				'seat_reservation_main_title_2'		=> 'required_if:seat_reservation_menual_contribution,1',
				'seat_reservation_total_subtitle'	=> 'required_if:customize_plan_option,2',
				'section_title'						=> 'required_if:customize_plan_option,4',
				
				'title'							=> 'required',
				'title_ms'						=> 'required',
				'sub_title'						=> 'required',
				'sub_title_ms'					=> 'required',
				'slider_position'				=> 'required',
				'campaign_start_date'			=> 'required',
				'campaign_end_date'				=> 'required',
				'plan_show_status'				=> 'required',
				'share_btn_status'				=> 'required',
				'meta_title'					=> 'required',
				'meta_keywords'					=> 'required',
				'meta_description'				=> 'required',
				//'project_description'			=> 'required',
				//'slug' 							=> 'required|unique:cms_pages,slug',
			),
			array(
				'donation_btn_url.required_if'					=>	'Donation Url is required',
				'editor.required_if'							=>	'Editor is requied',
				'seat_reservation_main_title.required_if'		=>	'Main title is requied',
				'seat_reservation_main_title_2.required_if'		=>	'Main title is requied',
				'seat_reservation_total_subtitle.required_if'	=>	'No. of Subtitle is requied',
				'section_title.required_if'						=>	'Section title is requied',
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
			//pr($DailyPlans);
			if($getProjectModule == 1){
				if(empty($DailyPlans['0']['price']) && empty($MonthlyPlans['0']['price']) && empty($YearlyPlans['0']['price'])){
					$err						=	array();
					$err['error']				=	1;
					$err['message']				=	trans("Atleast One Plan is Required.");
					return Response::json($err); 
					die;
				}
				if(empty($DailyPeriods['0']['quantity']) && empty($MonthlyPeriods['0']['quantity']) && empty($YearlyPeriods['0']['quantity'])){
					$err						=	array();
					$err['error']				=	1;
					$err['message']				=	trans("Atleast One Period is Required.");
					return Response::json($err); 
					die;
				}
			}
			
			if($getProjectModule == 2){
				if(Input::get('customize_plan_option') == 2){
					$totalSubtitle = !empty(Input::get('seat_reservation_total_subtitle'))?Input::get('seat_reservation_total_subtitle'):'';
					if(!empty($totalSubtitle)){
						for($i=1; $i <= $totalSubtitle; $i++){
							if(empty($SeatReservations[$i]['description'])){
								$err						=	array();
								$err['error']				=	1;
								$err['message']				=	trans("Main Subtitle ".$i." Feild is Required For Seat Reservation.");
								return Response::json($err); 
								die;
							}
							if(empty($SeatReservations[$i]['SpecialProjectSubtitle']['0']['seat_price']) || empty($SeatReservations[$i]['SpecialProjectSubtitle']['0']['seat_max_unit']) || empty($SeatReservations[$i]['SpecialProjectSubtitle']['0']['seat_name']) || empty($SeatReservations[$i]['SpecialProjectSubtitle']['0']['seat_description'])){
								$err						=	array();
								$err['error']				=	1;
								$err['message']				=	trans("Seat Price & Max Unit & Seat Name & Seat Description Fields are Required For Seat Reservation Plan in Subtitle ".$i.".");
								return Response::json($err); 
								die;
							}
							
						}
					}
				}
				if(Input::get('customize_plan_option') == 3){
					if(empty($QuantityPlans['0']['price']) || empty($QuantityPlans['0']['plan_title']) || empty($QuantityPlans['0']['plan_description'])){
						$err						=	array();
						$err['error']				=	1;
						$err['message']				=	trans("Plan Price & Title & Description are Required For Quantity Plans.");
						return Response::json($err); 
						die;
					}
				}
				if(Input::get('customize_plan_option') == 4){
					if(empty($SectionPlans['0']['price']) || empty($SectionPlans['0']['section_name'])){
						$err						=	array();
						$err['error']				=	1;
						$err['message']				=	trans("Price & Section Name are Required For Section Plan.");
						return Response::json($err); 
						die;
					}
				}
			}
			
			if($getProjectModule == 3){
				if(Input::get('customize_plan_option') == 1){
					if(empty($DefaultDanaPlans['0']['amount']) || empty($DefaultDanaPlans['0']['title'])){
						$err						=	array();
						$err['error']				=	1;
						$err['message']				=	trans("First Plan Price & Title are Required.");
						return Response::json($err); 
						die;
					}
				}
				if(Input::get('customize_plan_option') == 2){
					if(empty($PropertyTypes['0']['title']) || empty($PropertyTypes['0']['description'])){
						$err						=	array();
						$err['error']				=	1;
						$err['message']				=	trans("First Property Title & Descriptions are Reqiored.");
						return Response::json($err); 
						die;
					}
					if(empty($PropertyPriceRanges['0']['min_price']) || empty($PropertyPriceRanges['0']['max_price'])){
						$err						=	array();
						$err['error']				=	1;
						$err['message']				=	trans("Price Range Fields are Reqiored.");
						return Response::json($err); 
						die;
					}
					
				}
			}
			
			$TemplateHeaderImage 		= Session::get('TemplateHeaderImage');
			if(empty($TemplateHeaderImage)){
				$err						=	array();
				$err['error']				=	1;
				$err['message']				=	trans("Header Background Image is Required.");
				return Response::json($err); 
				die;
			}
			
			$images = Session::get('TemplateSliderImage');
			if(empty($images)){
				$err						=	array();
				$err['error']				=	1;
				$err['message']				=	trans("Atleaset One Slider Image is Required.");
				return Response::json($err); 
				die;
			}
			
			//echo "sdf"; die;
			
		//pr($thisData); die;
		
			$model 									=  SubProject::find(Input::get('sub_project_id'));
			$model->sub_project_name 				=  Input::get('sub_project_name');
			$model->subject_type 					=  Input::get('subject_type');
			$model->payment_type 					=  Input::get('payment_type');
			$model->payment_method 					=  !empty(Input::get('payment_method'))? implode(",",Input::get('payment_method')):'';
			$model->contributor_type 				=  Input::get('contributor_type');
			$model->target_amount 					=  Input::get('target_amount');
			$model->client_view 					=  Input::get('client_view');
			$model->donation_btn_type 				=  !empty(Input::get('donation_btn_type')) ? Input::get('donation_btn_type') :'default';
			$model->donation_btn_url 				=  !empty(Input::get('donation_btn_url')) ? Input::get('donation_btn_url') :'';
			
			//start ansar project content
			$model->daily_status 					=  !empty(Input::get('daily_status'))?Input::get('daily_status'):'0';
			$model->daily_description 				=  !empty(Input::get('daily_description'))?Input::get('daily_description'):'';
			$model->daily_description_ms 			=  !empty(Input::get('daily_description_ms'))?Input::get('daily_description_ms'):'';
			$model->daily_plan_allow_other 			=  !empty(Input::get('daily_plan_allow_other'))?Input::get('daily_plan_allow_other'):'0';
			$model->daily_period_allow_other 		=  !empty(Input::get('daily_period_allow_other'))?Input::get('daily_period_allow_other'):'0';
			$model->monthly_status 					=  !empty(Input::get('monthly_status'))?Input::get('monthly_status'):'0';
			$model->monthly_description 			=  !empty(Input::get('monthly_description'))?Input::get('monthly_description'):'';
			$model->monthly_description_ms 			=  !empty(Input::get('monthly_description_ms'))?Input::get('monthly_description_ms'):'';
			$model->monthly_plan_allow_other 		=  !empty(Input::get('monthly_plan_allow_other'))?Input::get('monthly_plan_allow_other'):'0';
			$model->monthly_period_allow_other 		=  !empty(Input::get('monthly_period_allow_other'))?Input::get('monthly_period_allow_other'):'0';
			$model->yearly_status 					=  !empty(Input::get('yearly_status'))?Input::get('yearly_status'):'0';
			$model->yearly_description	 			=  !empty(Input::get('yearly_description'))?Input::get('yearly_description'):'';
			$model->yearly_description_ms 			=  !empty(Input::get('yearly_description_ms'))?Input::get('yearly_description_ms'):'';
			$model->yearly_plan_allow_other 		=  !empty(Input::get('yearly_plan_allow_other'))?Input::get('yearly_plan_allow_other'):'0';
			$model->yearly_period_allow_other 		=  !empty(Input::get('yearly_period_allow_other'))?Input::get('yearly_period_allow_other'):'0';
			
			//start special project content
			$model->customize_plan_option	 				=  !empty(Input::get('customize_plan_option'))?Input::get('customize_plan_option'):'0';
			$model->seat_reservation_main_title	 			=  !empty(Input::get('seat_reservation_main_title'))?Input::get('seat_reservation_main_title'):'';
			$model->seat_reservation_main_title_2			=  !empty(Input::get('seat_reservation_main_title_2'))?Input::get('seat_reservation_main_title_2'):'';
			$model->seat_reservation_total_subtitle			=  !empty(Input::get('seat_reservation_total_subtitle'))?Input::get('seat_reservation_total_subtitle'):'0';
			$model->seat_reservation_menual_contribution	=  !empty(Input::get('seat_reservation_menual_contribution'))?Input::get('seat_reservation_menual_contribution'):'0';
			$model->section_title							=  !empty(Input::get('section_title'))?Input::get('section_title'):'';
			$model->is_multiple_participate					=  !empty(Input::get('is_multiple_participate'))?Input::get('is_multiple_participate'):'0';
			
			//start dana letsari project content
			$model->vendor							=  !empty(Input::get('vendor'))?Input::get('vendor'):'0';
			
			
			$model->editor_status 					=  Input::get('editor_status');
			$model->editor 							=  Input::get('editor');
			$model->editor_ms 						=  Input::get('editor_ms');
			$model->title 							=  Input::get('title');
			$model->title_ms 						=  Input::get('title_ms');
			$model->sub_title 						=  Input::get('sub_title');
			$model->sub_title_ms 					=  Input::get('sub_title_ms');
			$model->slider_position 				=  Input::get('slider_position');
			$model->campaign_start_date 			=  Input::get('campaign_start_date');
			$model->campaign_end_date 				=  Input::get('campaign_end_date');
			$model->plan_show_status 				=  Input::get('plan_show_status');
			$model->share_btn_status 				=  Input::get('share_btn_status');
			$model->project_description 			=  Input::get('project_description');
			$model->project_description_ms 			=  Input::get('project_description_ms');
			$model->meta_title 						=  Input::get('meta_title');
			$model->meta_keywords 					=  Input::get('meta_keywords');
			$model->meta_description 				=  Input::get('meta_description');
			$model->header_image 					=  !empty($TemplateHeaderImage)?$TemplateHeaderImage:'';
			$model->slug							=  $this->getSlug($model->sub_project_name,'slug','SubProject');
			$model->is_active						=  1;
			$model->save();
			$modelId						=	$model->id;		
			
			if(!empty($DailyPlans)){
				foreach($DailyPlans as $key=>$DailyPlan){
					$DailyPlanModel						=	new SubProjectPlan;
					if($key == Input::get('DailyPlan_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					$DailyPlanModel->sub_project_id		=	$modelId;
					$DailyPlanModel->price				=	$DailyPlan['price'];
					$DailyPlanModel->is_primary			=	$is_primary;
					$DailyPlanModel->type				=	"daily";
					$DailyPlanModel->save();
					
				}
			}
			
			if(!empty($DailyPeriods)){
				foreach($DailyPeriods as $key=>$DailyPeriod){
					$DailyPeriodModel						=	new SubProjectPeriod;
					if($key == Input::get('DailyPeriod_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					$DailyPeriodModel->sub_project_id		=	$modelId;
					$DailyPeriodModel->quantity				=	$DailyPeriod['quantity'];
					$DailyPeriodModel->is_primary			=	$is_primary;
					$DailyPeriodModel->type					=	"daily";
					$DailyPeriodModel->save();
					
				}
			}
			
			if(!empty($MonthlyPlans)){
				foreach($MonthlyPlans as $key=>$MonthlyPlan){
					$MonthlyPlanModel						=	new SubProjectPlan;
					if($key == Input::get('MonthlyPlan_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					$MonthlyPlanModel->sub_project_id		=	$modelId;
					$MonthlyPlanModel->price				=	$MonthlyPlan['price'];
					$MonthlyPlanModel->is_primary			=	$is_primary;
					$MonthlyPlanModel->type					=	"monthly";
					$MonthlyPlanModel->save();
					
				}
			}
			
			if(!empty($MonthlyPeriods)){
				foreach($MonthlyPeriods as $key=>$MonthlyPeriod){
					$MonthlyPeriodModel						=	new SubProjectPeriod;
					if($key == Input::get('MonthlyPeriod_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					$MonthlyPeriodModel->sub_project_id		=	$modelId;
					$MonthlyPeriodModel->quantity			=	$MonthlyPeriod['quantity'];
					$MonthlyPeriodModel->is_primary			=	$is_primary;
					$MonthlyPeriodModel->type				=	"monthly";
					$MonthlyPeriodModel->save();
					
				}
			}
			
			if(!empty($YearlyPlans)){
				foreach($YearlyPlans as $key=>$YearlyPlan){
					$YearlyPlanModel						=	new SubProjectPlan;
					if($key == Input::get('YearlyPlan_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					$YearlyPlanModel->sub_project_id		=	$modelId;
					$YearlyPlanModel->price					=	$YearlyPlan['price'];
					$YearlyPlanModel->is_primary			=	$is_primary;
					$YearlyPlanModel->type					=	"yearly";
					$YearlyPlanModel->save();
					
				}
			}
			
			if(!empty($YearlyPeriods)){
				foreach($YearlyPeriods as $key=>$YearlyPeriod){
					$YearlyPeriodModel						=	new SubProjectPeriod;
					if($key == Input::get('YearlyPeriod_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					$YearlyPeriodModel->sub_project_id		=	$modelId;
					$YearlyPeriodModel->quantity			=	$YearlyPeriod['quantity'];
					$YearlyPeriodModel->is_primary			=	$is_primary;
					$YearlyPeriodModel->type				=	"yearly";
					$YearlyPeriodModel->save();
					
				}
			}
			
			//start special projects contents//
			if(!empty($DefaultPlans)){
				foreach($DefaultPlans as $DefaultPlan){
					$defaultPlanModel						=	new SubProjectDefaultPlan;
					$defaultPlanModel->sub_project_id		=	$modelId;
					$defaultPlanModel->title				=	$DefaultPlan['title'];
					$defaultPlanModel->description			=	$DefaultPlan['description'];
					$defaultPlanModel->save();
					
				}
			}
			
			if(!empty($SeatReservations)){
				foreach($SeatReservations as $SeatReservation){
					$SubTitleModel						=	new SeatReservationSubtitle;
					$SubTitleModel->sub_project_id		=	$modelId;
					$SubTitleModel->description			=	$SeatReservation['description'];
					$SubTitleModel->save();
					$subTitleId							=	$SubTitleModel->id;
					
					if(!empty($SeatReservation['SpecialProjectSubtitle'])){
						foreach($SeatReservation['SpecialProjectSubtitle'] as $SeatReservationPlan){
							$reservationPlanModel							=	new SubProjectSeatReservationPlan;
							$reservationPlanModel->sub_project_id			=	$modelId;
							$reservationPlanModel->sub_title_id				=	$subTitleId;
							$reservationPlanModel->seat_price				=	$SeatReservationPlan['seat_price'];
							$reservationPlanModel->seat_max_unit			=	$SeatReservationPlan['seat_max_unit'];
							$reservationPlanModel->seat_name				=	$SeatReservationPlan['seat_name'];
							$reservationPlanModel->seat_description			=	$SeatReservationPlan['seat_description'];
							$reservationPlanModel->save();
							
						}
					}					
				}
			}
			
			if(!empty($QuantityPlans)){
				foreach($QuantityPlans as $QuantityPlan){
					$quantityPlanModel						=	new SubProjectQuantityPlan;
					$quantityPlanModel->sub_project_id		=	$modelId;
					$quantityPlanModel->price				=	$QuantityPlan['price'];
					$quantityPlanModel->plan_title			=	$QuantityPlan['plan_title'];
					$quantityPlanModel->plan_description	=	$QuantityPlan['plan_description'];
					$quantityPlanModel->save();
					
				}
			}
			
			if(!empty($SectionPlans)){
				foreach($SectionPlans as $SectionPlan){
					$sectionPlanModel						=	new SubProjectSectionPlan;
					$sectionPlanModel->sub_project_id		=	$modelId;
					$sectionPlanModel->price				=	$SectionPlan['price'];
					$sectionPlanModel->section_name			=	$SectionPlan['section_name'];
					$sectionPlanModel->save();
					
				}
			}
			
			
			//start dana lestari contents//
			if(!empty($DefaultDanaPlans)){
				foreach($DefaultDanaPlans as $key=>$DefaultDanaPlan){
					if($key == Input::get('default_dana_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					$defaultDanaPlanModel						=	new SubProjectDanaDefaultPlan;
					$defaultDanaPlanModel->sub_project_id		=	$modelId;
					$defaultDanaPlanModel->title				=	$DefaultDanaPlan['title'];
					$defaultDanaPlanModel->amount				=	$DefaultDanaPlan['amount'];
					$defaultDanaPlanModel->is_primary			=	$is_primary;
					$defaultDanaPlanModel->save();
					
				}
			}
			
			if(!empty($PropertyTypes)){
				foreach($PropertyTypes as $key=>$PropertyType){
					$PropertyTypePlanModel						=	new SubProjectDanaPropertyType;
					$PropertyTypePlanModel->sub_project_id		=	$modelId;
					$PropertyTypePlanModel->title				=	$PropertyType['title'];
					$PropertyTypePlanModel->description			=	$PropertyType['description'];
					$PropertyTypePlanModel->save();
					
				}
			}
			
			if(!empty($PropertyPriceRanges)){
				foreach($PropertyPriceRanges as $key=>$PropertyPriceRange){
					$PropertyPriceRangeModel						=	new SubProjectDanaPriceRange;
					$PropertyPriceRangeModel->sub_project_id		=	$modelId;
					$PropertyPriceRangeModel->min_price				=	$PropertyPriceRange['min_price'];
					$PropertyPriceRangeModel->max_price				=	$PropertyPriceRange['max_price'];
					$PropertyPriceRangeModel->save();
					
				}
			}
			
			
			$images = Session::get('TemplateSliderImage');
			if(!empty($images)){
				$counter = "0";
				foreach($images as $image){
				  if(!empty($image)){
					$ImageModel 						=  new TemplateSliderImage;
					$ImageModel->sub_project_id			=	$modelId;
					$ImageModel->image					=	$image;
					if(!empty(Input::get('is_featured'))){
						$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
						$folderPath			=	TEMPLATE_IMG_ROOT_PATH.'/'.$newFolder; 
						if(!File::exists($folderPath)){
							File::makeDirectory($folderPath, $mode = 0777,true);
						}
						
						$featuredImage	=	$newFolder.Input::get('is_featured');
						if($featuredImage == $image){
							$ImageModel->is_featured	=	1;
						}else{
							$ImageModel->is_featured	=	0;
						}
					}else{
						$ImageModel->is_featured		=	($counter == 0) ? 1:'0';
					}
					//$ImageModel->is_featured			=	($counter == 0) ? 1:'0';
					$ImageModel->save();
					
					$counter++;
				  }
				}
			}
			
			Session::forget('TemplateHeaderImage');
			Session::forget('TemplateSliderImage');
			
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Cms page added successfully.");
			return Response::json($err); 
			die;
		}
		
		
	}
	
	public function UpdateProjectTemplate(){
		//Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$DailyPlans						=	!empty($thisData['DailyPlan'])?$thisData['DailyPlan']:'';
		$DailyPeriods					=	!empty($thisData['DailyPeriod'])?$thisData['DailyPeriod']:'';
		$MonthlyPlans					=	!empty($thisData['MonthlyPlan'])?$thisData['MonthlyPlan']:'';
		$MonthlyPeriods					=	!empty($thisData['MonthlyPeriod'])?$thisData['MonthlyPeriod']:'';
		$YearlyPlans					=	!empty($thisData['YearlyPlan'])?$thisData['YearlyPlan']:'';
		$YearlyPeriods					=	!empty($thisData['YearlyPeriod'])?$thisData['YearlyPeriod']:'';
		
		//start special projects content
		$DefaultPlans					=	!empty($thisData['DefaultPlan'])?$thisData['DefaultPlan']:'';
		$SeatReservations				=	!empty($thisData['SeatReservation'])?$thisData['SeatReservation']:'';
		$QuantityPlans					=	!empty($thisData['QuantityPlan'])?$thisData['QuantityPlan']:'';
		$SectionPlans					=	!empty($thisData['SectionPlan'])?$thisData['SectionPlan']:'';
		
		//start dana lastari projects content
		$DefaultDanaPlans				=	!empty($thisData['DefaultDanaPlan'])?$thisData['DefaultDanaPlan']:'';
		$PropertyTypes					=	!empty($thisData['PropertyType'])?$thisData['PropertyType']:'';
		$PropertyPriceRanges			=	!empty($thisData['PropertyPriceRange'])?$thisData['PropertyPriceRange']:'';
		
		$userId							=	Auth::user()->id;
		
		// pr(Session::get('TemplateHeaderImage'));
		// pr(Session::get('TemplateSliderImage'));
		
		$getProjectModule = DB::table('sub_projects')->where('id',Input::get('sub_project_id'))->where('is_deleted',0)->pluck('project_module');
		
		$array_2=array("project_module"=>$getProjectModule);
		$thisData = array_merge($thisData,$array_2);
		// pr(Session::get('TemplateSliderImage'));
		// pr($thisData); die;
		$validator = Validator::make(
			$thisData,
			array(
				'sub_project_name'				=> 'required',
				'subject_type'					=> 'required',
				'payment_type'					=> 'required',
				'payment_method'				=> 'required',
				'contributor_type'				=> 'required',
				'target_amount'					=> 'required',
				'donation_btn_url'				=> 'required_if:donation_btn_type,url',
				'daily_status'					=> 'required_if:project_module,1',
				'daily_description'				=> 'required_if:project_module,1',
				'daily_description_ms'			=> 'required_if:project_module,1',
				'monthly_status'				=> 'required_if:project_module,1',
				'monthly_description'			=> 'required_if:project_module,1',
				'monthly_description_ms'		=> 'required_if:project_module,1',
				'yearly_status'					=> 'required_if:project_module,1',
				'yearly_description'			=> 'required_if:project_module,1',
				'yearly_description_ms'			=> 'required_if:project_module,1',
				'editor_status'					=> 'required_if:project_module,1',
				'editor'						=> 'required_if:editor_status,=,1',
				'editor_ms'						=> 'required_if:editor_status,=,1',
				
				'customize_plan_option'				=> 'required_if:project_module,2',
				'seat_reservation_main_title'		=> 'required_if:customize_plan_option,2',
				'seat_reservation_main_title_2'		=> 'required_if:seat_reservation_menual_contribution,1',
				'seat_reservation_total_subtitle'	=> 'required_if:customize_plan_option,2',
				'section_title'						=> 'required_if:customize_plan_option,4',
				
				'vendor'						=> 'required_if:customize_plan_option,6',
				'vendors'						=> 'required_if:customize_plan_option,7',
				
				'title'							=> 'required',
				'title_ms'						=> 'required',
				'sub_title'						=> 'required',
				'sub_title_ms'					=> 'required',
				'slider_position'				=> 'required',
				'campaign_start_date'			=> 'required',
				'campaign_end_date'				=> 'required',
				'plan_show_status'				=> 'required',
				'share_btn_status'				=> 'required',
				'meta_title'					=> 'required',
				'meta_keywords'					=> 'required',
				'meta_description'				=> 'required',
				//'project_description'			=> 'required',
				//'slug' 							=> 'required|unique:cms_pages,slug',
			),
			array(
				'donation_btn_url.required_if'					=>	'Donation Url is required',
				'editor.required_if'							=>	'Editor is requied',
				'editor_ms.required_if'							=>	'Editor(Malay) is requied',
				'seat_reservation_main_title.required_if'		=>	'Main title is requied',
				'seat_reservation_main_title_2.required_if'		=>	'Main title is requied',
				'seat_reservation_total_subtitle.required_if'	=>	'No. of Subtitle is requied',
				'section_title.required_if'						=>	'Section title is requied',
				'vendor.required_if'							=>	'Vendor is requied',
				'vendors.required_if'							=>	'Atleast One Vendor is requied',
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
			if($getProjectModule == 1){
				if(empty($DailyPlans['0']['price']) && empty($MonthlyPlans['0']['price']) && empty($YearlyPlans['0']['price'])){
					$err						=	array();
					$err['error']				=	1;
					$err['message']				=	trans("Atleast One Plan is Required.");
					return Response::json($err); 
					die;
				}
				if(empty($DailyPeriods['0']['quantity']) && empty($MonthlyPeriods['0']['quantity']) && empty($YearlyPeriods['0']['quantity'])){
					$err						=	array();
					$err['error']				=	1;
					$err['message']				=	trans("Atleast One Period is Required.");
					return Response::json($err); 
					die;
				}
			}
			
			if($getProjectModule == 2){
				if(Input::get('customize_plan_option') == 2){
					$totalSubtitle = !empty(Input::get('seat_reservation_total_subtitle'))?Input::get('seat_reservation_total_subtitle'):'';
					if(!empty($totalSubtitle)){
						for($i=1; $i <= $totalSubtitle; $i++){
							if(empty($SeatReservations[$i]['description'])){
								$err						=	array();
								$err['error']				=	1;
								$err['message']				=	trans("Main Subtitle ".$i." Feild is Required For Seat Reservation.");
								return Response::json($err); 
								die;
							}
							if(empty($SeatReservations[$i]['SpecialProjectSubtitle']['0']['seat_price']) || empty($SeatReservations[$i]['SpecialProjectSubtitle']['0']['seat_max_unit']) || empty($SeatReservations[$i]['SpecialProjectSubtitle']['0']['seat_name']) || empty($SeatReservations[$i]['SpecialProjectSubtitle']['0']['seat_description'])){
								$err						=	array();
								$err['error']				=	1;
								$err['message']				=	trans("Seat Price & Max Unit & Seat Name & Seat Description Fields are Required For Seat Reservation Plan in Subtitle ".$i.".");
								return Response::json($err); 
								die;
							}
							
						}
					}
				}
				if(Input::get('customize_plan_option') == 3){
					if(empty($QuantityPlans['0']['price']) || empty($QuantityPlans['0']['plan_title']) || empty($QuantityPlans['0']['plan_description'])){
						$err						=	array();
						$err['error']				=	1;
						$err['message']				=	trans("Plan Price & Title & Description are Required For Quantity Plans.");
						return Response::json($err); 
						die;
					}
				}
				if(Input::get('customize_plan_option') == 4){
					if(empty($SectionPlans['0']['price']) || empty($SectionPlans['0']['section_name'])){
						$err						=	array();
						$err['error']				=	1;
						$err['message']				=	trans("Price & Section Name are Required For Section Plan.");
						return Response::json($err); 
						die;
					}
				}
			}
			
			if($getProjectModule == 3){
				if(Input::get('customize_plan_option') == 1){
					if(empty($DefaultDanaPlans['0']['amount']) || empty($DefaultDanaPlans['0']['title'])){
						$err						=	array();
						$err['error']				=	1;
						$err['message']				=	trans("First Plan Price & Title are Required.");
						return Response::json($err); 
						die;
					}
				}
				if(Input::get('customize_plan_option') == 2){
					if(empty($PropertyTypes['0']['title']) || empty($PropertyTypes['0']['description'])){
						$err						=	array();
						$err['error']				=	1;
						$err['message']				=	trans("First Property Title & Descriptions are Reqiored.");
						return Response::json($err); 
						die;
					}
					if(empty($PropertyPriceRanges['0']['min_price']) || empty($PropertyPriceRanges['0']['max_price'])){
						$err						=	array();
						$err['error']				=	1;
						$err['message']				=	trans("Price Range Fields are Reqiored.");
						return Response::json($err); 
						die;
					}
					
				}
			}
			
			$TemplateHeaderImage 		= Session::get('TemplateHeaderImage');
			/* if(empty($TemplateHeaderImage)){
				$err						=	array();
				$err['error']				=	1;
				$err['message']				=	trans("Header Background Image is Required.");
				return Response::json($err); 
				die;
			} */
			
			$images = Session::get('TemplateSliderImage');
			/* if(empty($images)){
				$err						=	array();
				$err['error']				=	1;
				$err['message']				=	trans("Atleaset One Slider Image is Required.");
				return Response::json($err); 
				die;
			} */
			
			//echo "sdf"; die;
			
			$getSubProjectId = DB::table('sub_projects')->where('id',Input::get('sub_project_id'))->where('is_deleted',0)->pluck('id');
			
			$model 									=  SubProject::find($getSubProjectId);
			if($model->sub_project_name != Input::get('sub_project_name')){
				$model->slug						=  $this->getSlug(Input::get('sub_project_name'),'slug','SubProject');
			}
			$model->sub_project_name 				=  Input::get('sub_project_name');
			$model->is_active 						=  !empty(Input::get('is_active')) ? Input::get('is_active'):0;
			$model->subject_type 					=  Input::get('subject_type');
			$model->payment_type 					=  Input::get('payment_type');
			$model->payment_method 					=  !empty(Input::get('payment_method'))? implode(",",Input::get('payment_method')):'';
			$model->contributor_type 				=  Input::get('contributor_type');
			$model->target_amount 					=  Input::get('target_amount');
			$model->client_view 					=  Input::get('client_view');
			$model->donation_btn_type 				=  !empty(Input::get('donation_btn_type')) ? Input::get('donation_btn_type') :'default';
			$model->donation_btn_url 				=  !empty(Input::get('donation_btn_url')) ? Input::get('donation_btn_url') :'';
			
			//start ansar project content
			$model->daily_status 					=  !empty(Input::get('daily_status'))?Input::get('daily_status'):0;
			$model->daily_description 				=  !empty(Input::get('daily_description'))?Input::get('daily_description'):'';
			$model->daily_description_ms 			=  !empty(Input::get('daily_description_ms'))?Input::get('daily_description_ms'):'';
			$model->daily_plan_allow_other 			=  !empty(Input::get('daily_plan_allow_other'))?Input::get('daily_plan_allow_other'):'0';
			$model->daily_period_allow_other 		=  !empty(Input::get('daily_period_allow_other'))?Input::get('daily_period_allow_other'):'0';
			$model->monthly_status 					=  !empty(Input::get('monthly_status'))?Input::get('monthly_status'):0;
			$model->monthly_description 			=  !empty(Input::get('monthly_description'))?Input::get('monthly_description'):'';
			$model->monthly_description_ms 			=  !empty(Input::get('monthly_description_ms'))?Input::get('monthly_description_ms'):'';
			$model->monthly_plan_allow_other 		=  !empty(Input::get('monthly_plan_allow_other'))?Input::get('monthly_plan_allow_other'):'0';
			$model->monthly_period_allow_other 		=  !empty(Input::get('monthly_period_allow_other'))?Input::get('monthly_period_allow_other'):'0';
			$model->yearly_status 					=  !empty(Input::get('yearly_status'))?Input::get('yearly_status'):0;
			$model->yearly_description 				=  !empty(Input::get('yearly_description'))?Input::get('yearly_description'):'';
			$model->yearly_description_ms 			=  !empty(Input::get('yearly_description_ms'))?Input::get('yearly_description_ms'):'';
			$model->yearly_plan_allow_other 		=  !empty(Input::get('yearly_plan_allow_other'))?Input::get('yearly_plan_allow_other'):'0';
			$model->yearly_period_allow_other 		=  !empty(Input::get('yearly_period_allow_other'))?Input::get('yearly_period_allow_other'):'0';
			
			//start special project content
			$model->customize_plan_option	 				=  !empty(Input::get('customize_plan_option'))?Input::get('customize_plan_option'):'0';
			$model->seat_reservation_main_title	 			=  !empty(Input::get('seat_reservation_main_title'))?Input::get('seat_reservation_main_title'):'';
			$model->seat_reservation_main_title_2			=  !empty(Input::get('seat_reservation_main_title_2'))?Input::get('seat_reservation_main_title_2'):'';
			$model->seat_reservation_total_subtitle			=  !empty(Input::get('seat_reservation_total_subtitle'))?Input::get('seat_reservation_total_subtitle'):'0';
			$model->seat_reservation_menual_contribution	=  !empty(Input::get('seat_reservation_menual_contribution'))?Input::get('seat_reservation_menual_contribution'):'0';
			$model->section_title							=  !empty(Input::get('section_title'))?Input::get('section_title'):'';
			$model->is_multiple_participate					=  !empty(Input::get('is_multiple_participate'))?Input::get('is_multiple_participate'):'0';
			
			//start dana letsari project content
			if(Input::get('customize_plan_option') == 6){
				$model->vendor							=  !empty(Input::get('vendor'))?Input::get('vendor'):'';
			}else{
				$model->vendor							=  !empty(Input::get('vendors'))? implode(",",Input::get('vendors')):'';
			}
			
			$model->editor_status 					=  Input::get('editor_status');
			$model->editor 							=  Input::get('editor');
			$model->editor_ms 						=  Input::get('editor_ms');
			$model->title 							=  Input::get('title');
			$model->title_ms 						=  Input::get('title_ms');
			$model->sub_title 						=  Input::get('sub_title');
			$model->sub_title_ms 					=  Input::get('sub_title_ms');
			$model->slider_position 				=  Input::get('slider_position');
			$model->campaign_start_date 			=  Input::get('campaign_start_date');
			$model->campaign_end_date 				=  Input::get('campaign_end_date');
			$model->plan_show_status 				=  Input::get('plan_show_status');
			$model->share_btn_status 				=  Input::get('share_btn_status');
			$model->project_description 			=  Input::get('project_description');
			$model->project_description_ms 			=  Input::get('project_description_ms');
			$model->meta_title 						=  Input::get('meta_title');
			$model->meta_keywords 					=  Input::get('meta_keywords');
			$model->meta_description 				=  Input::get('meta_description');
			if(!empty($TemplateHeaderImage)){
				$model->header_image 					=  !empty($TemplateHeaderImage)?$TemplateHeaderImage:'';
			}
			//$model->slug							=  $this->getSlug($model->sub_project_name,'slug','SubProject');
			//$model->is_active						=  1;
			//pr($model); die;
			$model->save();
			$modelId						=	$model->id;		
			
			if(!empty($DailyPlans)){
				$DailyPlanIds = array();
				foreach($DailyPlans as $key=>$DailyPlan){
					if(!empty($DailyPlan['id']) && $DailyPlan['id'] != ""){
						$DailyPlanModel						=	SubProjectPlan::find($DailyPlan['id']);
					}else{
						$DailyPlanModel						=	new SubProjectPlan;
					}
					if($key == Input::get('DailyPlan_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					$DailyPlanModel->sub_project_id		=	$modelId;
					$DailyPlanModel->price				=	$DailyPlan['price'];
					$DailyPlanModel->is_primary			=	$is_primary;
					$DailyPlanModel->type				=	"daily";
					$DailyPlanModel->save();
					
					$DailyPlanIds[]		=	$DailyPlanModel->id;
				}
				
				//deleted record delete from table
				if(!empty($DailyPlanIds)){
					SubProjectPlan::whereNotIn('id',$DailyPlanIds)->where('sub_project_id',$modelId)->where('type','daily')->update(array('is_deleted'=>1));
				}
				
			}
			
			if(!empty($DailyPeriods)){
				$DailyPeriodIds = array();
				foreach($DailyPeriods as $key=>$DailyPeriod){
					if(!empty($DailyPeriod['id']) && $DailyPeriod['id'] != ""){
						$DailyPeriodModel						=	SubProjectPeriod::find($DailyPeriod['id']);
					}else{
						$DailyPeriodModel						=	new SubProjectPeriod;
					}
					if($key == Input::get('DailyPeriod_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					$DailyPeriodModel->sub_project_id		=	$modelId;
					$DailyPeriodModel->quantity				=	$DailyPeriod['quantity'];
					$DailyPeriodModel->is_primary			=	$is_primary;
					$DailyPeriodModel->type					=	"daily";
					$DailyPeriodModel->save();
					
					$DailyPeriodIds[]		=	$DailyPeriodModel->id;
				}
				
				//deleted record delete from table
				if(!empty($DailyPeriodIds)){
					SubProjectPeriod::whereNotIn('id',$DailyPeriodIds)->where('sub_project_id',$modelId)->where('type','daily')->update(array('is_deleted'=>1));
				}
				
			}
			
			if(!empty($MonthlyPlans)){
				$MonthlyPlanIds = array();
				foreach($MonthlyPlans as $key=>$MonthlyPlan){
					if(!empty($MonthlyPlan['id']) && $MonthlyPlan['id'] != ""){
						$MonthlyPlanModel						=	SubProjectPlan::find($MonthlyPlan['id']);
					}else{
						$MonthlyPlanModel						=	new SubProjectPlan;
					}
					if($key == Input::get('MonthlyPlan_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					$MonthlyPlanModel->sub_project_id		=	$modelId;
					$MonthlyPlanModel->price				=	$MonthlyPlan['price'];
					$MonthlyPlanModel->is_primary			=	$is_primary;
					$MonthlyPlanModel->type					=	"monthly";
					$MonthlyPlanModel->save();
					
					$MonthlyPlanIds[]		=	$MonthlyPlanModel->id;
				}
				
				//deleted record delete from table
				if(!empty($MonthlyPlanIds)){
					SubProjectPlan::whereNotIn('id',$MonthlyPlanIds)->where('sub_project_id',$modelId)->where('type','monthly')->update(array('is_deleted'=>1));
				}
				
			}
			
			if(!empty($MonthlyPeriods)){
				$MonthlyPeriodIds = array();
				foreach($MonthlyPeriods as $key=>$MonthlyPeriod){
					if(!empty($MonthlyPeriod['id']) && $MonthlyPeriod['id'] != ""){
						$MonthlyPeriodModel						=	SubProjectPeriod::find($MonthlyPeriod['id']);
					}else{
						$MonthlyPeriodModel						=	new SubProjectPeriod;
					}
					if($key == Input::get('MonthlyPeriod_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					$MonthlyPeriodModel->sub_project_id		=	$modelId;
					$MonthlyPeriodModel->quantity			=	$MonthlyPeriod['quantity'];
					$MonthlyPeriodModel->is_primary			=	$is_primary;
					$MonthlyPeriodModel->type				=	"monthly";
					$MonthlyPeriodModel->save();
					
					$MonthlyPeriodIds[]		=	$MonthlyPeriodModel->id;
				}
				
				//deleted record delete from table
				if(!empty($MonthlyPeriodIds)){
					SubProjectPeriod::whereNotIn('id',$MonthlyPeriodIds)->where('sub_project_id',$modelId)->where('type','monthly')->update(array('is_deleted'=>1));
				}
				
			}
			
			if(!empty($YearlyPlans)){
				$YearlyPlanIds = array();
				foreach($YearlyPlans as $key=>$YearlyPlan){
					if(!empty($YearlyPlan['id']) && $YearlyPlan['id'] != ""){
						$YearlyPlanModel						=	SubProjectPlan::find($YearlyPlan['id']);
					}else{
						$YearlyPlanModel						=	new SubProjectPlan;
					}
					if($key == Input::get('YearlyPlan_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					$YearlyPlanModel->sub_project_id		=	$modelId;
					$YearlyPlanModel->price					=	$YearlyPlan['price'];
					$YearlyPlanModel->is_primary			=	$is_primary;
					$YearlyPlanModel->type					=	"yearly";
					$YearlyPlanModel->save();
					
					$YearlyPlanIds[]		=	$YearlyPlanModel->id;
				}
				
				//deleted record delete from table
				if(!empty($YearlyPlanIds)){
					SubProjectPlan::whereNotIn('id',$YearlyPlanIds)->where('sub_project_id',$modelId)->where('type','yearly')->update(array('is_deleted'=>1));
				}
				
			}
			
			if(!empty($YearlyPeriods)){
				$YearlyPeriodIds = array();
				foreach($YearlyPeriods as $key=>$YearlyPeriod){
					if(!empty($YearlyPeriod['id']) && $YearlyPeriod['id'] != ""){
						$YearlyPeriodModel						=	SubProjectPeriod::find($YearlyPeriod['id']);
					}else{
						$YearlyPeriodModel						=	new SubProjectPeriod;
					}
					if($key == Input::get('YearlyPeriod_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					$YearlyPeriodModel->sub_project_id		=	$modelId;
					$YearlyPeriodModel->quantity			=	$YearlyPeriod['quantity'];
					$YearlyPeriodModel->is_primary			=	$is_primary;
					$YearlyPeriodModel->type				=	"yearly";
					$YearlyPeriodModel->save();
					
					$YearlyPeriodIds[]		=	$YearlyPeriodModel->id;
				}
				
				//deleted record delete from table
				if(!empty($YearlyPeriodIds)){
					SubProjectPeriod::whereNotIn('id',$YearlyPeriodIds)->where('sub_project_id',$modelId)->where('type','yearly')->update(array('is_deleted'=>1));
				}
				
			}
			
			//start special projects contents//
			if(Input::get('customize_plan_option') == 1){
				if(!empty($DefaultPlans)){
					$defaultPlanIds = array();
					foreach($DefaultPlans as $DefaultPlan){
						if(!empty($DefaultPlan['id']) && $DefaultPlan['id'] != ""){
							$defaultPlanModel						=	SubProjectDefaultPlan::find($DefaultPlan['id']);
						}else{
							$defaultPlanModel						=	new SubProjectDefaultPlan;
						}
						$defaultPlanModel->sub_project_id		=	$modelId;
						$defaultPlanModel->title				=	$DefaultPlan['title'];
						$defaultPlanModel->description			=	$DefaultPlan['description'];
						$defaultPlanModel->save();
						
						$defaultPlanIds[]		=	$defaultPlanModel->id;
					}
					
					//deleted record delete from table
					if(!empty($defaultPlanIds)){
						SubProjectDefaultPlan::whereNotIn('id',$defaultPlanIds)->where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					}
					
					//delete other plan record in this subprojects
					SeatReservationSubtitle::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					SubProjectQuantityPlan::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					SubProjectSectionPlan::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					
				}
			
			}
			
			if(Input::get('customize_plan_option') == 2){
				if(!empty($SeatReservations)){
					$reservationPlanIds = array();
					foreach($SeatReservations as $SeatReservation){
						if(!empty($SeatReservation['id']) && $SeatReservation['id'] != ""){
							$SubTitleModel						=	SeatReservationSubtitle::find($SeatReservation['id']);
						}else{
							$SubTitleModel						=	new SeatReservationSubtitle;
						}
						$SubTitleModel->sub_project_id		=	$modelId;
						$SubTitleModel->description			=	$SeatReservation['description'];
						$SubTitleModel->save();
						$subTitleId							=	$SubTitleModel->id;
						
						if(!empty($SeatReservation['SpecialProjectSubtitle'])){
							foreach($SeatReservation['SpecialProjectSubtitle'] as $SeatReservationPlan){
								if(!empty($SeatReservationPlan['id']) && $SeatReservationPlan['id'] != ""){
									$reservationPlanModel						=	SubProjectSeatReservationPlan::find($SeatReservationPlan['id']);
								}else{
									$reservationPlanModel						=	new SubProjectSeatReservationPlan;
								}
								$reservationPlanModel->sub_project_id			=	$modelId;
								$reservationPlanModel->sub_title_id				=	$subTitleId;
								$reservationPlanModel->seat_price				=	$SeatReservationPlan['seat_price'];
								$reservationPlanModel->seat_max_unit			=	$SeatReservationPlan['seat_max_unit'];
								$reservationPlanModel->seat_name				=	$SeatReservationPlan['seat_name'];
								$reservationPlanModel->seat_description			=	$SeatReservationPlan['seat_description'];
								$reservationPlanModel->save();
								
								$reservationPlanIds[]	=	$reservationPlanModel->id;
							}
						}					
					}
					
					//deleted record delete from table
					if(!empty($reservationPlanIds)){
						SubProjectSeatReservationPlan::whereNotIn('id',$reservationPlanIds)->where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					}
					
					//delete other plan record in this subprojects
					SubProjectDefaultPlan::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					SubProjectQuantityPlan::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					SubProjectSectionPlan::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					
				}
			}
			
			if(Input::get('customize_plan_option') == 3){
				if(!empty($QuantityPlans)){
					$quantityPlanIds = array();
					foreach($QuantityPlans as $QuantityPlan){
						if(!empty($QuantityPlan['id']) && $QuantityPlan['id'] != ""){
							$quantityPlanModel					=	SubProjectQuantityPlan::find($QuantityPlan['id']);
						}else{
							$quantityPlanModel					=	new SubProjectQuantityPlan;
						}
						$quantityPlanModel->sub_project_id		=	$modelId;
						$quantityPlanModel->price				=	$QuantityPlan['price'];
						$quantityPlanModel->plan_title			=	$QuantityPlan['plan_title'];
						$quantityPlanModel->plan_description	=	$QuantityPlan['plan_description'];
						$quantityPlanModel->save();
						
						$quantityPlanIds[]	=	$quantityPlanModel->id;
					}
					
					//deleted record delete from table
					if(!empty($quantityPlanIds)){
						SubProjectQuantityPlan::whereNotIn('id',$quantityPlanIds)->where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					}
					
					//delete other plan record in this subprojects
					SubProjectDefaultPlan::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					SubProjectSeatReservationPlan::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					SubProjectSectionPlan::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
				}
			}
			
			if(Input::get('customize_plan_option') == 4){
				if(!empty($SectionPlans)){
					$sectionPlanIds = array();
					foreach($SectionPlans as $SectionPlan){
						if(!empty($SectionPlan['id']) && $SectionPlan['id'] != ""){
							$sectionPlanModel					=	SubProjectSectionPlan::find($SectionPlan['id']);
						}else{
							$sectionPlanModel					=	new SubProjectSectionPlan;
						}
						$sectionPlanModel->sub_project_id		=	$modelId;
						$sectionPlanModel->price				=	$SectionPlan['price'];
						$sectionPlanModel->section_name			=	$SectionPlan['section_name'];
						$sectionPlanModel->save();
						
						$sectionPlanIds[]	=	$sectionPlanModel->id;
					}
					
					//deleted record delete from table
					if(!empty($sectionPlanIds)){
						SubProjectSectionPlan::whereNotIn('id',$sectionPlanIds)->where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					}
					
					//delete other plan record in this subprojects
					SubProjectDefaultPlan::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					SubProjectSeatReservationPlan::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
					SubProjectQuantityPlan::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
				}
			}
			
			//start dana lestari contents//
			if(!empty($DefaultDanaPlans)){
				$defaultDanaPlanIds = array();
				foreach($DefaultDanaPlans as $key=>$DefaultDanaPlan){
					if($key == Input::get('default_dana_is_primary')){
						$is_primary			=	"1";
					}else{
						$is_primary			=	"0";
					}
					if(!empty($DefaultDanaPlan['id']) && $DefaultDanaPlan['id'] != ""){
						$defaultDanaPlanModel					=	SubProjectDanaDefaultPlan::find($DefaultDanaPlan['id']);
					}else{
						$defaultDanaPlanModel					=	new SubProjectDanaDefaultPlan;
					}
					$defaultDanaPlanModel->sub_project_id		=	$modelId;
					$defaultDanaPlanModel->title				=	$DefaultDanaPlan['title'];
					$defaultDanaPlanModel->amount				=	$DefaultDanaPlan['amount'];
					$defaultDanaPlanModel->is_primary			=	$is_primary;
					$defaultDanaPlanModel->save();
					
					$defaultDanaPlanIds[]	=	$defaultDanaPlanModel->id;
				}
				
				//deleted record delete from table
				if(!empty($defaultDanaPlanIds)){
					SubProjectDanaDefaultPlan::whereNotIn('id',$defaultDanaPlanIds)->where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
				}
				
			}else{
				//deleted record delete from table
				SubProjectDanaDefaultPlan::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
			}
			
			if(!empty($PropertyTypes)){
				$PropertyTypePlanIds = array();
				foreach($PropertyTypes as $key=>$PropertyType){
					if(!empty($PropertyType['id']) && $PropertyType['id'] != ""){
						$PropertyTypePlanModel					=	SubProjectDanaPropertyType::find($PropertyType['id']);
					}else{
						$PropertyTypePlanModel					=	new SubProjectDanaPropertyType;
					}
					$PropertyTypePlanModel->sub_project_id		=	$modelId;
					$PropertyTypePlanModel->title				=	$PropertyType['title'];
					$PropertyTypePlanModel->description			=	$PropertyType['description'];
					$PropertyTypePlanModel->save();
					
					$PropertyTypePlanIds[]	=	$PropertyTypePlanModel->id;
				}
				
				//deleted record delete from table
				if(!empty($PropertyTypePlanIds)){
					SubProjectDanaPropertyType::whereNotIn('id',$PropertyTypePlanIds)->where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
				}
				
			}else{
				//deleted record delete from table
				SubProjectDanaPropertyType::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
			}
			
			if(!empty($PropertyPriceRanges)){
				$PropertyPriceRangeIds = array();
				foreach($PropertyPriceRanges as $key=>$PropertyPriceRange){
					if(!empty($PropertyPriceRange['id']) && $PropertyPriceRange['id'] != ""){
						$PropertyPriceRangeModel					=	SubProjectDanaPriceRange::find($PropertyPriceRange['id']);
					}else{
						$PropertyPriceRangeModel					=	new SubProjectDanaPriceRange;
					}
					$PropertyPriceRangeModel->sub_project_id		=	$modelId;
					$PropertyPriceRangeModel->min_price				=	$PropertyPriceRange['min_price'];
					$PropertyPriceRangeModel->max_price				=	$PropertyPriceRange['max_price'];
					$PropertyPriceRangeModel->save();
					
					$PropertyPriceRangeIds[]	=	$PropertyPriceRangeModel->id;
				}
				
				//deleted record delete from table
				if(!empty($PropertyPriceRangeIds)){
					SubProjectDanaPriceRange::whereNotIn('id',$PropertyPriceRangeIds)->where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
				}
				
			}else{
				//deleted record delete from table
				SubProjectDanaPriceRange::where('sub_project_id',$modelId)->update(array('is_deleted'=>1));
			}
			
			
			
			
			$images = Session::get('TemplateSliderImage');
			if(!empty($images)){
				$counter = "0";
				foreach($images as $image){
				  if(!empty($image)){
					$ImageModel 						=  new TemplateSliderImage;
					$ImageModel->sub_project_id			=	$modelId;
					$ImageModel->image					=	$image;
					if(!empty(Input::get('is_featured'))){
						$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
						$folderPath			=	TEMPLATE_IMG_ROOT_PATH.'/'.$newFolder; 
						if(!File::exists($folderPath)){
							File::makeDirectory($folderPath, $mode = 0777,true);
						}
						
						$featuredImage	=	$newFolder.Input::get('is_featured');
						if($featuredImage == $image){
							$ImageModel->is_featured	=	1;
						}else{
							$ImageModel->is_featured	=	0;
						}
					}else{
						//$ImageModel->is_featured		=	($counter == 0) ? 1:'0';
					}
					//$ImageModel->is_featured			=	($counter == 0) ? 1:'0';
					$ImageModel->save();
					
					$counter++;
				  }
				}
			}else if(!empty(Input::get('is_featured'))){
				TemplateSliderImage::where('sub_project_id',$modelId)->update(['is_featured'=>0]);
				TemplateSliderImage::where('sub_project_id',$modelId)->where('image',Input::get('is_featured'))->update(['is_featured'=>1]);
			}
			
			Session::forget('TemplateHeaderImage');
			Session::forget('TemplateSliderImage');
			
			$err						=	array();
			$err['success']				=	1;
			$err['message']				=	trans("Cms page added successfully.");
			return Response::json($err); 
			die;
		}
		
		
	}
	
	public function UploadTemplateHeaderImage(){
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'file'						=> 'required|image',
			),
			array(
				
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
			
			if(!empty(Input::file('file'))){
				$file_name 			=	str_replace(" ","_",Input::file('file')->getClientOriginalName());
				$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
				$folderPath			=	TEMPLATE_IMG_ROOT_PATH.'/'.$newFolder; 
				if(!File::exists($folderPath)){
					File::makeDirectory($folderPath, $mode = 0777,true);
				}
				
				$image	=	$newFolder.$file_name;
				if(Input::file('file')->move($folderPath, $file_name)){
					
					Session::set('TemplateHeaderImage', $image);
					
					$err						=	array();
					$err['success']				=	1;
					$err['message']				=	trans("Template header image added successfully.");
					return Response::json($err); 
					die;
				}
				
			}
			
			$err						=	array();
			$err['error']				=	1;
			$err['message']				=	trans("Template header image not uploaded.");
			return Response::json($err); 
			die;
		}
		
	}
	
	public function UploadTemplateSliderImages(){
		$thisData						=	Input::all();  
		$userId							=	Auth::user()->id;
		//pr($thisData); die;
		
		$validator = Validator::make(
			Input::all(),
			array(
				'file'						=> 'required|image',
			),
			array(
				
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
			
			if(!empty(Input::file('file'))){
				$file_name 			=	str_replace(" ","_",Input::file('file')->getClientOriginalName());
				$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
				$folderPath			=	TEMPLATE_IMG_ROOT_PATH.'/'.$newFolder; 
				if(!File::exists($folderPath)){
					File::makeDirectory($folderPath, $mode = 0777,true);
				}
				
				$image	=	$newFolder.$file_name;
				if(Input::file('file')->move($folderPath, $file_name)){
					
					$images = Session::get('TemplateSliderImage');
					
					$images[$file_name]	=	$image;
					
					Session::set('TemplateSliderImage', $images);
					
					$err						=	array();
					$err['success']				=	1;
					$err['message']				=	trans("Template Slider image added successfully.");
					return Response::json($err); 
					die;
				}
				
			}
			
			$err						=	array();
			$err['error']				=	1;
			$err['message']				=	trans("Template Slider image not uploaded.");
			return Response::json($err); 
			die;
		}
		
	}
	
	//3
	public function AddMoreDefaultDanaPlan(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_default_dana_plan',compact("counter"));
	}
	
	public function AddMoreDanaPropertyType(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_dana_property_type',compact("counter"));
	}
	
	public function AddMoreDanaPropertyPriceRange(){
		$userId							=	Auth::user()->id;
		$counter						=	Input::get('counter');
		
		return View::make('front.user.add_more_dana_property_price_range',compact("counter"));
	}
	
	//sub project orders list here
	public function SubProjectLists($subProjectSlug = ""){
		Session::forget('SelectDonationPlanData');
		$vendorLists = array();
		$lang = App::getLocale();
		if(empty($subProjectSlug)){
			Session::flash('flash_notice',  trans("Pagination Error!"));
			return redirect()->back();
		}
		
		$subProjectDetails = DB::table('sub_projects')
								->select('sub_projects.*',
									DB::raw("(select name from project_modules where id=sub_projects.project_module) as project_module_name"),
									DB::raw("(select name from projects where id=sub_projects.project_id) as project_name")
								)
								->where('slug',$subProjectSlug)->where('is_deleted',0)->first();
		if(empty($subProjectDetails)){
			Session::flash('flash_notice',  trans("Pagination Error!"));
			return redirect()->back();
		}
		
		$default_plan_ids = DB::table('sub_project_default_plans')->where('is_deleted',0)->lists('id','id');
		//->whereIn('default_project_plan',$default_plan_ids)
		$allOrderIds	=	DonationOrder::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->lists('id','id');
		
		//total contribution funds -total approved payments
		$totalApprovedContribution	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
		
		//total pending payment approval
		$totalPendingPayments	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',3)->where('is_deleted',0)->where('is_active',1)->count('id');
		
		//total waiting payment approval
		$totalWaitingApprovalPayments	=	DonationPayment::whereIn('order_id',$allOrderIds)->where('payment_status',1)->where('is_deleted',0)->where('is_active',1)->sum('amount');
		
		//target aechive
		if(!empty($subProjectDetails->target_amount) && !empty($totalApprovedContribution)){
			$targetAchive	=	round((($totalApprovedContribution / $subProjectDetails->target_amount) * 100),2);
		}else{
			$targetAchive	=	0;
		}
		
		$colorArray = array('success','brand','danger','info','warning','primary','brand');
		
		//plan name, contribution and chart
		$chartData	=	array();
		$planLists	=	array();
		if($subProjectDetails->project_module == 1){
			$pieChartData					=	array();
			$pieChartData['0']['name']		=	"daily";
			$pieChartData['1']['name']		=	"monthly";
			$pieChartData['2']['name']		=	"yearly";
			
			$TotalApprovedPayment	=	"";
			if(!empty($pieChartData)){
				foreach($pieChartData as $key=>&$planName){
					$chartOrderIds = DonationOrder::where('plan_type',$planName)->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->lists('id','id');
					$chartDonationAmount	=	DonationPayment::whereIn('order_id',$chartOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
					
					if(!empty($chartDonationAmount)){
						$avgPlanPayment	=	round((($chartDonationAmount / $totalApprovedContribution) * 100),2);
					}else if(!empty($totalApprovedContribution)){
						$avgPlanPayment	=	round((($chartDonationAmount) * 100),2);
					}else{
						$avgPlanPayment	=	0;
					}
					
					if(isset($colorArray[$key])){
						$planName['color']	=	$colorArray[$key];
					}else{
						$planName['color']	=	"success";
					}
					
					$planName['amount']			=	$chartDonationAmount;
					$planName['avg_payment']	=	$avgPlanPayment;
					
					if(!empty($avgPlanPayment)){
						$chartData[] = '{
										label: "'.$planName['name'].'",
										
										value: "'.$avgPlanPayment.'"
									}';
					}
					
				}
			}
			//pr($pieChartData); die;
			if(!empty($chartData)){
				$saleTypeChartData = implode(",",$chartData);
			}else{
				$saleTypeChartData = '{
										label: "No Date Found!",
										
										value: "0"
									}';
			}
			
		}else if($subProjectDetails->project_module == 2){
			if($subProjectDetails->customize_plan_option == 1){
				$pieChartData	=	SubProjectDefaultPlan::select('id','title')->where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectDetails->id)->get()->toArray();
				if(!empty($pieChartData)){
					$counter = 0;
					foreach($pieChartData as $key=>&$planRecord){
						$planRecord['name']	=	$planRecord['title'];
						
						$chartOrderIds = DonationOrder::where('default_project_plan',$planRecord['id'])->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->lists('id','id')->toArray();
						$chartDonationAmount	=	DonationPayment::whereIn('order_id',$chartOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
						
						if(!empty($chartDonationAmount) && !empty($totalApprovedContribution)){
							$avgPlanPayment	=	round((($chartDonationAmount / $totalApprovedContribution) * 100),2);
						}else{
							$avgPlanPayment	=	0;
						}
						
						$planRecord['amount']			=	$chartDonationAmount;
						$planRecord['avg_payment']		=	$avgPlanPayment;
						
						if(!empty($avgPlanPayment)){
							
							if(isset($colorArray[$counter])){
								$planRecord['color']	=	$colorArray[$counter];
							}else{
								$planRecord['color']	=	"success";
							}
							
							$chartData[] = '{
											label: "'.$planRecord['name'].'",
											
											value: "'.$avgPlanPayment.'"
										}';
							
							$counter++;
						}
						
					}
				}
				//problem total contribution aa raha h par plan chart me 0 aa raha h-- kyu ki plan delete ho chuka h to nahi dikhega na bro--
				//pr($pieChartData); die;
				
				$planLists	=	SubProjectDefaultPlan::select('title as name','id')->where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectDetails->id)->lists('name','id')->toArray();
				
			}elseif($subProjectDetails->customize_plan_option == 2){
				$pieChartData	=	SubProjectSeatReservationPlan::select('id','seat_name')->where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectDetails->id)->get()->toArray();
				if(!empty($pieChartData)){
					foreach($pieChartData as $key=>&$planRecord){
						$planRecord['name']	=	$planRecord['seat_name'];
						
						if(isset($colorArray[$key])){
							$planRecord['color']	=	$colorArray[$key];
						}else{
							$planRecord['color']	=	"success";
						}
						
						$chartOrderIds = SeatReservationOrder::where('seat_plan_id',$planRecord['id'])->where('is_deleted',0)->where('is_active',1)->lists('order_id','order_id')->toArray();
						
						$chartDonationAmount	=	DonationPayment::whereIn('order_id',$chartOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
						
						if(!empty($chartDonationAmount) && !empty($totalApprovedContribution)){
							$avgPlanPayment	=	round((($chartDonationAmount / $totalApprovedContribution) * 100),2);
						}else{
							$avgPlanPayment	=	0;
						}
						
						$planRecord['amount']			=	$chartDonationAmount;
						$planRecord['avg_payment']		=	$avgPlanPayment;
						
						if(!empty($avgPlanPayment)){
							$chartData[] = '{
											label: "'.$planRecord['name'].'",
											
											value: "'.$avgPlanPayment.'"
										}';
						}
						
					}
				}
				
				$planLists	=	SubProjectSeatReservationPlan::select('seat_name as name','id')->where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectDetails->id)->lists('name','id')->toArray();
				
			}elseif($subProjectDetails->customize_plan_option == 3){
				$pieChartData	=	SubProjectQuantityPlan::select('id','plan_title')->where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectDetails->id)->get()->toArray();
				if(!empty($pieChartData)){
					foreach($pieChartData as $key=>&$planRecord){
						$planRecord['name']	=	$planRecord['plan_title'];
						
						if(isset($colorArray[$key])){
							$planRecord['color']	=	$colorArray[$key];
						}else{
							$planRecord['color']	=	"success";
						}
						
						$chartOrderIds = DonationOrder::where('quantity_project_plan',$planRecord['id'])->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->lists('id','id')->toArray();
						
						$chartDonationAmount	=	DonationPayment::whereIn('order_id',$chartOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
						
						if(!empty($chartDonationAmount) && !empty($totalApprovedContribution)){
							$avgPlanPayment	=	round((($chartDonationAmount / $totalApprovedContribution) * 100),2);
						}else{
							$avgPlanPayment	=	0;
						}
						
						$planRecord['amount']			=	$chartDonationAmount;
						$planRecord['avg_payment']		=	$avgPlanPayment;
						
						if(!empty($avgPlanPayment)){
							$chartData[] = '{
											label: "'.$planRecord['name'].'",
											
											value: "'.$avgPlanPayment.'"
										}';
						}
						
					}
				}
				
				$planLists	=	SubProjectQuantityPlan::select('id','plan_title as name')->where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectDetails->id)->lists('name','id')->toArray();
				
			}elseif($subProjectDetails->customize_plan_option == 4){
				$pieChartData	=	SubProjectSectionPlan::select('id','section_name')->where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectDetails->id)->get()->toArray();
				if(!empty($pieChartData)){
					foreach($pieChartData as $key=>&$planRecord){
						$planRecord['name']	=	$planRecord['section_name'];
						
						if(isset($colorArray[$key])){
							$planRecord['color']	=	$colorArray[$key];
						}else{
							$planRecord['color']	=	"success";
						}
						
						$chartOrderIds = SectionParticipate::where('section_plan',$planRecord['id'])->where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectDetails->id)->lists('order_id','order_id')->toArray();
						
						$chartDonationAmount	=	DonationPayment::whereIn('order_id',$chartOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
						
						if(!empty($chartDonationAmount) && !empty($totalApprovedContribution)){
							$avgPlanPayment	=	round((($chartDonationAmount / $totalApprovedContribution) * 100),2);
						}else{
							$avgPlanPayment	=	0;
						}
						
						$planRecord['amount']			=	$chartDonationAmount;
						$planRecord['avg_payment']		=	$avgPlanPayment;
						
						if(!empty($avgPlanPayment)){
							$chartData[] = '{
											label: "'.$planRecord['name'].'",
											
											value: "'.$avgPlanPayment.'"
										}';
						}
						
					}
				}
				
				$planLists	=	SubProjectSectionPlan::select('id','section_name as name')->where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectDetails->id)->lists('name','id')->toArray();
				
			}
			
			if(!empty($chartData)){
				$saleTypeChartData = implode(",",$chartData);
			}else{
				$saleTypeChartData = '{
										label: "No Date Found!",
										
										value: "0"
									}';
			}
			
		}else if($subProjectDetails->project_module == 3){
			if($subProjectDetails->customize_plan_option == 5){
				$pieChartData	=	SubProjectDanaDefaultPlan::select('id','title')->where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectDetails->id)->get()->toArray();
				//pr($pieChartData); die;
				if(!empty($pieChartData)){
					$counter = 0;
					foreach($pieChartData as $key=>&$planRecord){
						$planRecord['name']	=	$planRecord['title'];
						
						$chartOrderIds = DonationOrder::where('dana_default_project_plan',$planRecord['id'])->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->lists('id','id')->toArray();
						
						$chartDonationAmount	=	DonationPayment::whereIn('order_id',$chartOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
						
						if(!empty($chartDonationAmount) && !empty($totalApprovedContribution)){
							$avgPlanPayment	=	round((($chartDonationAmount / $totalApprovedContribution) * 100),2);
						}else{
							$avgPlanPayment	=	0;
						}
						
						$planRecord['amount']			=	$chartDonationAmount;
						$planRecord['avg_payment']		=	$avgPlanPayment;
						
						if(!empty($avgPlanPayment)){
							
							if(isset($colorArray[$counter])){
								$planRecord['color']	=	$colorArray[$counter];
							}else{
								$planRecord['color']	=	"success";
							}
							
							$chartData[] = '{
											label: "'.$planRecord['name'].'",
											
											value: "'.$avgPlanPayment.'"
										}';
										
							$counter++;
						}
						
					}
				}
				
				$planLists	=	SubProjectDanaDefaultPlan::select('id','title as name')->where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectDetails->id)->lists('name','id')->toArray();
				
			}else if($subProjectDetails->customize_plan_option == 6){
				$pieChartData	=	SubProjectDanaPropertyType::select('id','title')->where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectDetails->id)->get()->toArray();
				if(!empty($pieChartData)){
					$counter = 0;
					foreach($pieChartData as $key=>&$planRecord){
						$planRecord['name']	=	$planRecord['title'];
						
						$chartOrderIds = DonationOrder::where('dana_property_plan',$planRecord['id'])->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->lists('id','id')->toArray();
						
						$chartDonationAmount	=	DonationPayment::whereIn('order_id',$chartOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
						
						if(!empty($chartDonationAmount) && !empty($totalApprovedContribution)){
							$avgPlanPayment	=	round((($chartDonationAmount / $totalApprovedContribution) * 100),2);
						}else{
							$avgPlanPayment	=	0;
						}
						
						$planRecord['amount']			=	$chartDonationAmount;
						$planRecord['avg_payment']		=	$avgPlanPayment;
						
						if(!empty($avgPlanPayment)){
							
							if(isset($colorArray[$counter])){
								$planRecord['color']	=	$colorArray[$counter];
							}else{
								$planRecord['color']	=	"success";
							}
							
							$chartData[] = '{
											label: "'.$planRecord['name'].'",
											
											value: "'.$avgPlanPayment.'"
										}';
										
							$counter++;
						}
						
					}
				}
				
				$planLists	=	SubProjectDanaPropertyType::select('id','title as name')->where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectDetails->id)->lists('name','id')->toArray();
				
			}else if($subProjectDetails->customize_plan_option == 7){
				$pieChartData	=	User::select('id','full_name')->where('is_deleted',0)->where('is_active',1)->get()->toArray();
				//pr($pieChartData); die;
				if(!empty($pieChartData)){
					$counter = 0;
					foreach($pieChartData as $key=>&$planRecord){
						$planRecord['name']	=	$planRecord['full_name'];
						
						if(isset($colorArray[$key])){
							$planRecord['color']	=	$colorArray[$key];
						}else{
							$planRecord['color']	=	"success";
						}
						
						$planId = $planRecord['id'];
						$chartOrderIds = DonationOrder::whereRaw('FIND_IN_SET(?, dana_vendor)',[$planId])->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->lists('id','id')->toArray();
						
						$chartDonationAmount	=	DonationPayment::whereIn('order_id',$chartOrderIds)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
						
						if(!empty($chartDonationAmount) && !empty($totalApprovedContribution)){
							$avgPlanPayment	=	round((($chartDonationAmount / $totalApprovedContribution) * 100),2);
						}else{
							$avgPlanPayment	=	0;
						}
						
						$planRecord['amount']			=	$chartDonationAmount;
						$planRecord['avg_payment']		=	$avgPlanPayment;
						
						if(!empty($avgPlanPayment)){
							
							if(isset($colorArray[$counter])){
								$planRecord['color']	=	$colorArray[$counter];
							}else{
								$planRecord['color']	=	"success";
							}
							
							$chartData[] = '{
											label: "'.$planRecord['name'].'",
											
											value: "'.$avgPlanPayment.'"
										}';
										
							$counter++;
						}
						
					}
				}
				
				$vendorLists	=	User::select('id','full_name as name')->where('user_role_id',2)->where('is_deleted',0)->where('is_active',1)->lists('name','id')->toArray();
				
			}
			
			if(!empty($chartData)){
				$saleTypeChartData = implode(",",$chartData);
			}else{
				$saleTypeChartData = '{
										label: "No Date Found!",
										
										value: "0"
									}';
			}
			
		}else{
			$pieChartData			=	"";
			$saleTypeChartData = '{
									label: "No Date Found!",
									
									value: "0"
								}';
			
		}
		
		if(!empty($pieChartData)){
			$price = array_column($pieChartData, 'amount');
			array_multisort($price, SORT_DESC, $pieChartData);
		}else{
			$pieChartData	=	"";
		}
		//pr($pieChartData); die;
		
		$DB							=	DonationOrder::query(); 
		$idsData					=	array(); 
		$searchVariable				=	array(); 
		$selectedSort_by			=	"";
		$inputGet					=	Input::get();
		if(Input::get()) {
			$searchData				=	Input::get();
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
			if(isset($searchData['per_page'])){
				unset($searchData['per_page']);
			}
			if(isset($searchData['sort_by'])){
				unset($searchData['sort_by']);
			}
			
			foreach($searchData as $fieldName => $fieldValue){
				if((!empty($fieldValue) && ($fieldValue != "")) || $fieldValue == 0){
				    if($fieldName == "keyword" && $fieldValue != ""){
						$DB->where("full_name",'like','%'.$fieldValue.'%');
					}else if($fieldName == "status"){
					  if($fieldValue != ""){
						$PaymentStatusIds = array();
						if($fieldValue == 1){
							$PaymentStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',1)->lists('order_id','order_id');
						}else if($fieldValue == 2){
							$PaymentStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',2)->lists('order_id','order_id');
						}else if($fieldValue == 3){
							$PaymentStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',3)->lists('order_id','order_id');
						}else if($fieldValue == 5){
							$PaymentStatusIds = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('payment_status',5)->lists('order_id','order_id');
						}
						
						$DB->whereIn("id",$PaymentStatusIds);
					  }
					}else if($fieldName == "special_project_seat_plan" && $fieldValue != ""){
						if($fieldValue != ""){
							$seatProjectOrderIds = SeatReservationOrder::where('seat_plan_id',$fieldValue)->where('is_deleted',0)->where('is_active',1)->lists('order_id','order_id')->toArray();
							
							$DB->whereIn('id',$seatProjectOrderIds);
						}
					}else if($fieldName == "special_project_section_plan" && $fieldValue != ""){
						if($fieldValue != ""){
							$sectionProjectOrderIds = SectionParticipate::where('section_plan',$fieldValue)->lists('order_id','order_id')->toArray();
							
							$DB->whereIn('id',$sectionProjectOrderIds);
						}
					}else if($fieldName == "dana_vendor" && $fieldValue != ""){
						if($fieldValue != ""){
							$DB->whereRaw("FIND_IN_SET(?,dana_vendor)",[$fieldValue]);
						}
					}else if($fieldName == "filterdate" && $fieldValue != ""){
						if($fieldValue != ""){
							$filterDateArray = explode(" - ",$fieldValue);
							$minDateTime = date("Y-m-d 00:00:01",strtotime($filterDateArray['0']));
							$maxDateTime = date("Y-m-d 23:59:59",strtotime($filterDateArray['1']));
							$DB->where("created_at",'>=',$minDateTime);
							$DB->where("created_at",'<=',$maxDateTime);
						}
					}else{
					  if($fieldValue != ""){
						$DB->where("$fieldName",'=',$fieldValue);
						//$DB->where("$fieldName",'like','%'.$fieldValue.'%');
					  }
					}
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		
		$sortBy 					= 	(Input::get('sortBy')) ? Input::get('sortBy') : 'created_at';
	    $order  					= 	(Input::get('order')) ? Input::get('order')   : 'DESC';
		
		
		$result 					= 	$DB
											->select('donation_orders.*',
												DB::raw("(select price from sub_project_plans where id=donation_orders.plan_price) as plan_price"),
												DB::raw("(select quantity from sub_project_periods where id=donation_orders.time_period) as time_period"),
												DB::raw("(select title from sub_project_default_plans where id=donation_orders.default_project_plan) as default_project_plan_name"),
												DB::raw("(select plan_title from sub_project_quantity_plans where id=donation_orders.quantity_project_plan) as quantity_project_plan_name"),
												DB::raw("(select title from sub_project_dana_default_plans where id=donation_orders.dana_default_project_plan) as dana_default_project_plan_name"),
												DB::raw("(select title from sub_project_dana_property_types where id=donation_orders.dana_property_plan) as dana_property_plan_name"),
												DB::raw("(select full_name from users where id=donation_orders.dana_vendor) as dana_vendor_name")
											)
											->where('sub_project_id',$subProjectDetails->id)
											->where('is_deleted',0)
											->orderBy($sortBy, $order)
											->paginate(Config::get("Reading.records_per_page"));
											
		if(!empty($result)){
			foreach($result as &$record){
				if($subProjectDetails->customize_plan_option == 4){
					$TotalParticipates = SectionParticipate::where('order_id',$record->id)->where('is_active',1)->count('id');
					$participateArray = SectionParticipate::where('order_id',$record->id)->where('is_active',1)->lists('section_plan','section_plan')->toArray();
					$sectionPlanArray	=	SubProjectSectionPlan::whereIn('id',$participateArray)->get();
					
					$record->ParticipateArray	=	$sectionPlanArray;
					$record->TotalParticipates	=	$TotalParticipates;
				}
				if($subProjectDetails->customize_plan_option == 2){
					$reservationArray = SeatReservationOrder::select('seat_reservation_orders.*',DB::raw("(select seat_name from sub_project_seat_reservation_plans where id=seat_reservation_orders.seat_plan_id) as seat_name"))->where('order_id',$record->id)->where('is_active',1)->get();
					$record->ReservationArray	=	$reservationArray;
				}
				
				$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',1)->pluck('payment_status');
				if(empty($checkMainPaymentStatus)){
					$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',3)->pluck('payment_status');
					if(empty($checkMainPaymentStatus)){
						$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',5)->pluck('payment_status');
						if(empty($checkMainPaymentStatus)){
							$checkMainPaymentStatus = DonationPayment::where('order_id',$record->id)->where('is_active',1)->where('is_deleted',0)->where('payment_status',2)->pluck('payment_status');
						}
					}
				}
				$record->main_payment_status	=	$checkMainPaymentStatus;
				
			}
		}
		
		$complete_string		=	Input::query();
		unset($complete_string["sortBy"]);
		unset($complete_string["order"]);
		$query_string			=	http_build_query($complete_string);
		$result->appends(Input::all())->render();
		
		
		$paymentMethods = DB::table('dropdown_managers')->where('is_active',1)->where('dropdown_type','payment-method')->lists('name','id');
		
		//pr($result); die;
		
		return View::make('front.user.sub_project_lists',compact("subProjectDetails","result",'searchVariable','sortBy','order','totalApprovedContribution','totalPendingPayments','totalWaitingApprovalPayments','targetAchive','pieChartData','saleTypeChartData','planLists','vendorLists','paymentMethods'));
	}
	
	public function AddMoreSectionParticipate(){
		$userId							=	!empty(Auth::user()) ? Auth::user()->id:0;
		$counter						=	Input::get('counter');
		$subProjectId					=	Input::get('subProjectId');
		$sectionPlans					=	SubProjectSectionPlan::where('sub_project_id',$subProjectId)
															->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		
		return View::make('front.user.add_more_section_participate',compact("counter","sectionPlans"));
	}
	
	public function BookPlan($subProjectSlug = ""){
		$lang			=	App::getLocale();
		if(empty($lang)){
			$lang	=	"en";
		}
		
		//pr($subProjectSlug); die;
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
			Session::flash('flash_notice',  trans("Pagination Error!"));
			return redirect()->back();
		}
		
		if($lang != "en"){
			if(!empty($subProjectDetails->daily_description_ms)){
				$subProjectDetails->daily_description = $subProjectDetails->daily_description_ms;
			}
			if(!empty($subProjectDetails->monthly_description_ms)){
				$subProjectDetails->monthly_description = $subProjectDetails->monthly_description_ms;
			}
			if(!empty($subProjectDetails->yearly_description_ms)){
				$subProjectDetails->yearly_description = $subProjectDetails->yearly_description_ms;
			}
			if(!empty($subProjectDetails->title_ms)){
				$subProjectDetails->title = $subProjectDetails->title_ms;
			}
			if(!empty($subProjectDetails->sub_title_ms)){
				$subProjectDetails->sub_title = $subProjectDetails->sub_title_ms;
			}
			if(!empty($subProjectDetails->project_description_ms)){
				$subProjectDetails->project_description = $subProjectDetails->project_description_ms;
			}
			if(!empty($subProjectDetails->editor_ms)){
				$subProjectDetails->editor = $subProjectDetails->editor_ms;
			}
			
		}
		
		//for front end get last step data selected//
		$selectedDonationPlanData = !empty(Session::get('SelectDonationPlanData'))?Session::get('SelectDonationPlanData'):'';
		//pr($selectedDonationPlanData); die;
		
		if(!empty($selectedDonationPlanData) && !empty($selectedDonationPlanData['plan_type'])){
			$dailyPlanDetails = DB::table('sub_project_plans')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('type',$selectedDonationPlanData['plan_type'])->orderBy('created_at','ASC')->get();
			$dailyPeriodDetails = DB::table('sub_project_periods')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('type',$selectedDonationPlanData['plan_type'])->orderBy('created_at','ASC')->get();
		}else{
			$dailyPlanDetails = DB::table('sub_project_plans')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('type','daily')->orderBy('created_at','ASC')->get();
			$dailyPeriodDetails = DB::table('sub_project_periods')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('type','daily')->orderBy('created_at','ASC')->get();
		}
		
		//SPECIAL PROJECTS//
		$projectPlans	=	SubProjectDefaultPlan::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		$seatReservationPlans	=	SeatReservationSubtitle::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		if(!empty($seatReservationPlans)){
			foreach($seatReservationPlans as &$seatReservationPlan){
				$seatReservationDetails	=	DB::table('sub_project_seat_reservation_plans')->where('sub_project_id',$subProjectDetails->id)->where('sub_title_id',$seatReservationPlan->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
				
				$seatReservationDetailArray	=	array();
				if(!empty($selectedDonationPlanData) && !empty($selectedDonationPlanData['project_module']) && ($selectedDonationPlanData['project_module'] == 2) && ($selectedDonationPlanData['customize_plan_option'] == 2)){
					if(!empty($seatReservationDetails)){
						$dataCounter = "1";
						foreach($seatReservationDetails as $seatReservationDetail){
							if(!empty($selectedDonationPlanData['SeatReservation'][$seatReservationDetail->id]) && isset($selectedDonationPlanData['SeatReservation'][$seatReservationDetail->id]['total_seat']) && ($selectedDonationPlanData['SeatReservation'][$seatReservationDetail->id]['seat_subtitle_id'] == $seatReservationDetail->sub_title_id)){
								$seatReservationDetail->total_booked_seat	=	$selectedDonationPlanData['SeatReservation'][$seatReservationDetail->id]['total_seat'];
								$seatReservationDetail->total_attendance	=	$selectedDonationPlanData['SeatReservation'][$seatReservationDetail->id]['total_attendance'];
							}else{
								$seatReservationDetail->total_booked_seat	=	0;
								$seatReservationDetail->total_attendance	=	0;
							}
							
							$seatReservationDetailArray[]	=	$seatReservationDetail;
							$dataCounter++;
						}
					}
				}
				if(!empty($seatReservationDetailArray)){
					$seatReservationPlan->ReservationSeats	=	$seatReservationDetailArray;
				}else{
					$seatReservationPlan->ReservationSeats	=	$seatReservationDetails;
				}
			}
		}
		//pr($selectedDonationPlanData);
		//pr($seatReservationPlans); die;
		
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
		
		if(!empty(Auth::user()) && (Auth::user()->user_role_id == 1)){
			$paymentMethods = PaymentOption::where('is_active',1)->orderBy('id','ASC')->get();
		}else{
			$availablePaymnetMethodArray	=	!empty($subProjectDetails->payment_method) ? explode(",",$subProjectDetails->payment_method):[];
			$paymentMethods = PaymentOption::where('is_active',1)->whereIn('id',$availablePaymnetMethodArray)->orderBy('id','ASC')->get();
		}
		
		return View::make('front.user.book_plan',compact("subProjectDetails","dailyPlanDetails","dailyPeriodDetails","paymentMethods","projectPlans","projectPlans","seatReservationPlans","quantityPlans","sectionPlans","danaDefaultPlans","danaProperyPlans","danaProperyPriceRanges","vendorLists","selectedDonationPlanData"));
	}
	
	public function getBookPlanPopup($subProjectSlug = ""){
		$lang			=	App::getLocale();
		if(empty($lang)){
			$lang	=	"en";
		}
		
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
			Session::flash('flash_notice',  trans("Pagination Error!"));
			return redirect()->back();
		}
		
		if($lang != "en"){
			if(!empty($subProjectDetails->daily_description_ms)){
				$subProjectDetails->daily_description = $subProjectDetails->daily_description_ms;
			}
			if(!empty($subProjectDetails->monthly_description_ms)){
				$subProjectDetails->monthly_description = $subProjectDetails->monthly_description_ms;
			}
			if(!empty($subProjectDetails->yearly_description_ms)){
				$subProjectDetails->yearly_description = $subProjectDetails->yearly_description_ms;
			}
			if(!empty($subProjectDetails->title_ms)){
				$subProjectDetails->title = $subProjectDetails->title_ms;
			}
			if(!empty($subProjectDetails->sub_title_ms)){
				$subProjectDetails->sub_title = $subProjectDetails->sub_title_ms;
			}
			if(!empty($subProjectDetails->project_description_ms)){
				$subProjectDetails->project_description = $subProjectDetails->project_description_ms;
			}
			if(!empty($subProjectDetails->editor_ms)){
				$subProjectDetails->editor = $subProjectDetails->editor_ms;
			}
			
		}
		
		//for front end get last step data selected//
		$selectedDonationPlanData = !empty(Session::get('SelectDonationPlanData'))?Session::get('SelectDonationPlanData'):'';
		//pr($selectedDonationPlanData); die;
		
		if(!empty($selectedDonationPlanData) && !empty($selectedDonationPlanData['plan_type'])){
			$dailyPlanDetails = DB::table('sub_project_plans')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('type',$selectedDonationPlanData['plan_type'])->orderBy('created_at','ASC')->get();
			$dailyPeriodDetails = DB::table('sub_project_periods')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('type',$selectedDonationPlanData['plan_type'])->orderBy('created_at','ASC')->get();
		}else{
			$dailyPlanDetails = DB::table('sub_project_plans')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('type','daily')->orderBy('created_at','ASC')->get();
			$dailyPeriodDetails = DB::table('sub_project_periods')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('type','daily')->orderBy('created_at','ASC')->get();
		}
		
		//SPECIAL PROJECTS//
		$projectPlans	=	SubProjectDefaultPlan::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		$seatReservationPlans	=	SeatReservationSubtitle::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		if(!empty($seatReservationPlans)){
			foreach($seatReservationPlans as &$seatReservationPlan){
				$seatReservationDetails	=	DB::table('sub_project_seat_reservation_plans')->where('sub_project_id',$subProjectDetails->id)->where('sub_title_id',$seatReservationPlan->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
				
				$seatReservationDetailArray	=	array();
				if(!empty($selectedDonationPlanData) && !empty($selectedDonationPlanData['project_module']) && ($selectedDonationPlanData['project_module'] == 2) && ($selectedDonationPlanData['customize_plan_option'] == 2)){
					if(!empty($seatReservationDetails)){
						$dataCounter = "1";
						foreach($seatReservationDetails as $seatReservationDetail){
							if(!empty($selectedDonationPlanData['SeatReservation'][$seatReservationDetail->id]) && isset($selectedDonationPlanData['SeatReservation'][$seatReservationDetail->id]['total_seat']) && ($selectedDonationPlanData['SeatReservation'][$seatReservationDetail->id]['seat_subtitle_id'] == $seatReservationDetail->sub_title_id)){
								$seatReservationDetail->total_booked_seat	=	$selectedDonationPlanData['SeatReservation'][$seatReservationDetail->id]['total_seat'];
								$seatReservationDetail->total_attendance	=	$selectedDonationPlanData['SeatReservation'][$seatReservationDetail->id]['total_attendance'];
							}else{
								$seatReservationDetail->total_booked_seat	=	0;
								$seatReservationDetail->total_attendance	=	0;
							}
							
							$seatReservationDetailArray[]	=	$seatReservationDetail;
							$dataCounter++;
						}
					}
				}
				if(!empty($seatReservationDetailArray)){
					$seatReservationPlan->ReservationSeats	=	$seatReservationDetailArray;
				}else{
					$seatReservationPlan->ReservationSeats	=	$seatReservationDetails;
				}
			}
		}
		//pr($selectedDonationPlanData);
		//pr($seatReservationPlans); die;
		
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
		
		if(!empty(Auth::user()) && (Auth::user()->user_role_id == 1)){
			$paymentMethods = PaymentOption::where('is_active',1)->orderBy('id','ASC')->get();
		}else{
			$availablePaymnetMethodArray	=	!empty($subProjectDetails->payment_method) ? explode(",",$subProjectDetails->payment_method):[];
			$paymentMethods = PaymentOption::where('is_active',1)->whereIn('id',$availablePaymnetMethodArray)->orderBy('id','ASC')->get();
		}
		
		return View::make('front.user.get_book_plan_modal',compact("subProjectDetails","dailyPlanDetails","dailyPeriodDetails","paymentMethods","projectPlans","projectPlans","seatReservationPlans","quantityPlans","sectionPlans","danaDefaultPlans","danaProperyPlans","danaProperyPriceRanges","vendorLists","selectedDonationPlanData"));
	}
	
	public function EditBookPlan($subProjectSlug = "", $orderId	= ""){
		if(empty($subProjectSlug) || empty($orderId)){
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
			Session::flash('flash_notice',  trans("Pagination Error!"));
			return redirect()->back();
		}
				
		$donationOrderDetails	=	DonationOrder::where('is_deleted',0)->where('unique_donation_id',$orderId)->first();
		if(empty($donationOrderDetails)){
			Session::flash('flash_notice',  trans("Order Details Not Found!"));
			return redirect()->back();
		}
		
		$orderID	=	$donationOrderDetails->id;
		
		$dailyPlanDetails = DB::table('sub_project_plans')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('type','daily')->orderBy('created_at','ASC')->get();
		$dailyPeriodDetails = DB::table('sub_project_periods')->where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('type','daily')->orderBy('created_at','ASC')->get();
		
		//SPECIAL PROJECTS//
		$projectPlans	=	SubProjectDefaultPlan::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		$seatReservationPlans	=	SeatReservationSubtitle::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		if(!empty($seatReservationPlans)){
			foreach($seatReservationPlans as &$seatReservationPlan){
				$seatReservationDetails	=	DB::table('sub_project_seat_reservation_plans')
												->select('sub_project_seat_reservation_plans.*',
													DB::raw("(select total_seat from seat_reservation_orders where seat_plan_id=sub_project_seat_reservation_plans.id AND order_id='$orderID') as total_booked_seat"),
													DB::raw("(select total_attendance from seat_reservation_orders where seat_plan_id=sub_project_seat_reservation_plans.id AND order_id='$orderID') as total_attendance"),
													DB::raw("(select id from seat_reservation_orders where seat_plan_id=sub_project_seat_reservation_plans.id AND order_id='$orderID') as booked_seat_id")
												)->where('sub_project_id',$subProjectDetails->id)->where('sub_title_id',$seatReservationPlan->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
				
				$seatReservationPlan->ReservationSeats	=	$seatReservationDetails;
			}
		}
		
		$quantityPlans	=	SubProjectQuantityPlan::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		$sectionPlans	=	SubProjectSectionPlan::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		
		
		//pr($subProjectDetails); die;
		
		$availablePaymnetMethodArray	=	!empty($subProjectDetails->payment_method) ? explode(",",$subProjectDetails->payment_method):'';
		$paymentMethods = DropDown::where('dropdown_type','payment-method')->where('is_active',1)->whereIn('id',$availablePaymnetMethodArray)->get();
		//$paymentMethodList = DropDown::where('dropdown_type','payment-method')->where('is_active',1)->whereIn('id',$availablePaymnetMethodArray)->lists('name','id');
		$paymentMethodList	=	PaymentOption::where('is_active',1)->orderBy('id','ASC')->lists('name','id');
		
		//participate array for sepecial project section 4
		$participateArray = SectionParticipate::where('order_id',$donationOrderDetails->id)->where('is_active',1)->where('is_deleted',0)->get();
		
		//DANA LASTARI
		$danaDefaultPlans	=	SubProjectDanaDefaultPlan::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		$danaProperyPlans	=	SubProjectDanaPropertyType::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		$danaProperyPriceRanges	=	SubProjectDanaPriceRange::where('sub_project_id',$subProjectDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
		if(!empty($subProjectDetails->vendor) && !is_array($subProjectDetails->vendor)){
			$vendorIds	=	explode(",",$subProjectDetails->vendor);
			$vendorLists =	User::select('id','full_name','slug')->whereIn('id',$vendorIds)->where('user_role_id',2)->where('is_deleted',0)->where('is_active',1)->orderBy('full_name','ASC')->get();
		}else{
			$vendorLists =	User::select('id','full_name','slug')->where('id',$subProjectDetails->vendor)->where('user_role_id',2)->where('is_deleted',0)->where('is_active',1)->orderBy('full_name','ASC')->get();
		}
		
		
		//donation Payments//
		$donationPayments = DonationPayment::select('donation_payments.*',DB::raw("(select full_name from users WHERE id=donation_payments.status_change_by) as status_change_by"))->where('order_id',$donationOrderDetails->id)->where('is_deleted',0)->where('is_active',1)->orderBy('id','ASC')->get();
		
		return View::make('front.user.edit_book_plan',compact("subProjectDetails","dailyPlanDetails","dailyPeriodDetails","paymentMethods","projectPlans","donationOrderDetails","seatReservationPlans","quantityPlans","sectionPlans","participateArray","danaDefaultPlans","danaProperyPlans","danaProperyPriceRanges","vendorLists","donationPayments","paymentMethodList"));
	}
	
	public function GetPlanHtml(){
		$sub_project_id			=	Input::get('sub_project_id');
		$plan_type				=	Input::get('plan_type');
		$order_id				=	!empty(Input::get('order_id'))?Input::get('order_id'):'0';
		
		if(empty($sub_project_id) || empty($plan_type)){
			Session::flash('flash_notice',  trans("Pagination Error!"));
			return redirect()->back();
			die;
		}
		
		$subProjectDetails = DB::table('sub_projects')
								->select('id','daily_period_allow_other','daily_plan_allow_other','monthly_plan_allow_other','monthly_period_allow_other','yearly_plan_allow_other','yearly_period_allow_other')
								->where('id',$sub_project_id)->where('is_deleted',0)->where('is_active',1)->first();
		//pr($subProjectDetails); die;
		
		$PlanDetails = DB::table('sub_project_plans')->where('sub_project_id',$sub_project_id)->where('is_deleted',0)->where('type',$plan_type)->orderBy('created_at','ASC')->get();
		$PeriodDetails = DB::table('sub_project_periods')->where('sub_project_id',$sub_project_id)->where('is_deleted',0)->where('type',$plan_type)->orderBy('created_at','ASC')->get();
		
		
		$OrderPlanPrice		=	DonationOrder::where('is_deleted',0)->where('id',$order_id)->pluck('plan_price');
		$OrderPlanPeriod	=	DonationOrder::where('is_deleted',0)->where('id',$order_id)->pluck('time_period');
		
		$OrderPlanOtherPrice	=	DonationOrder::where('is_deleted',0)->where('id',$order_id)->pluck('other_plan_price');
		$OrderPlanOtherPeriod	=	DonationOrder::where('is_deleted',0)->where('id',$order_id)->pluck('other_time_period');
		
		
		return View::make('front.user.get_plan_html',compact("PlanDetails","PeriodDetails","subProjectDetails","plan_type","OrderPlanPrice","OrderPlanPeriod","OrderPlanOtherPrice","OrderPlanOtherPeriod"));
	}
	
	public function DeleteDonationOrder($SubProjectPlan = "", $slug = ""){
		if(empty($slug) || empty($SubProjectPlan)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		$result = DonationOrder::where('unique_donation_id',$slug)->pluck('id');
		if(!empty($result)){
			DonationOrder::where('id',$result)->update(array('is_deleted'=>1));
			
			Session::flash('flash_notice',  trans("Order deleted successfully."));
		}else{
			Session::flash('flash_notice',  trans("Order details not found!"));
		}
		
		return redirect()->back();
	}
	
	//save donation details and create billplz invoice
	public function saveDonation(){
		Session::forget('SelectDonationPlanData');
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$sectionParticipates			=	!empty($thisData['Section'])?$thisData['Section']:'';
		$SeatReservations				=	!empty($thisData['SeatReservation'])?$thisData['SeatReservation']:'';
		$userId							=	!empty(Auth::user()) ? Auth::user()->id :0;
		
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
		
		$validator = Validator::make(
			$thisData,
			array(
				'plan_type'					=> 'required_if:project_module,==,1',
				'plan_price'				=> 'required_if:project_module,==,1',
				'time_period'				=> 'required_if:project_module,==,1',
				'default_project_plan'		=> "required_if:customize_plan_option,==,1",
				'total_contribution'		=> "required_if:customize_plan_option,==,1,2,3,7",
				'quantity_project_plan'		=> "required_if:customize_plan_option,==,3",
				'quantity'					=> "required_if:customize_plan_option,==,3",
				'section_name'				=> "required_if:customize_plan_option,==,4",
				'section_plan'				=> "required_if:customize_plan_option,==,4",
				'dana_default_project_plan'	=> "required_if:customize_plan_option,==,5",
				'dana_property_plan'		=> "required_if:customize_plan_option,==,6",
				'dana_vendor'				=> "required_if:customize_plan_option,==,7",
				'full_name'					=> 'required',
				'phone'						=> 'required',
				'email'						=> 'required',
				'postcode'					=> 'required',
				'payment_method'			=> 'required',
				'company_name'				=> 'required_if:profile_type,==,1',
				'other_plan_price'			=> 'required_if:plan_price,==,other',
				'other_time_period'			=> 'required_if:time_period,==,other',
				//'slug' 					=> 'required|unique:cms_pages,slug',
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
			
			$model 								=  new DonationOrder;
			
			if(!empty(Input::file('receipt'))){
				$file_name 			=	str_replace(" ","_",Input::file('receipt')->getClientOriginalName());
				$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
				$folderPath			=	PAYMENT_RECEIPT_ROOT_PATH.'/'.$newFolder; 
				if(!File::exists($folderPath)){
					File::makeDirectory($folderPath, $mode = 0777,true);
				}
				
				if(Input::file('receipt')->move($folderPath, $file_name)){
					$model->receipt			=	$newFolder.$file_name;
				}
				
			}
			
			if(!empty(Input::get('email')) && empty($userId)){
				$userDetails = User::where('email',Input::get('email'))->where('is_deleted',0)->first();
				$userId	=	!empty($userDetails)?$userDetails->id:0;
			}
			
			if(empty($userId) || $userId == 0){
				Session::forget('RegisterDataPending');
				
				$pendingRegistrationData				=	array();
				$pendingRegistrationData['email']		=	Input::get('email');
				$pendingRegistrationData['full_name']	=	Input::get('full_name');
				$pendingRegistrationData['phone']		=	Input::get('phone');
				Session::set('RegisterDataPending', $pendingRegistrationData);
				
			}
			
			$model->user_id 					=  $userId;
			$model->unique_donation_id 			=  $this->createOrderId(Input::get('sub_project_id'));
			$model->sub_project_id 				=  Input::get('sub_project_id');
			$model->is_recurring 				=  ($subProjectDetails->payment_type == 1) ? 1 :0;
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
			
			$model->full_name 					=  Input::get('full_name');
			$model->postcode 					=  Input::get('postcode');
			$model->payment_method 				=  Input::get('payment_method');
			$model->phone 						=  Input::get('phone');
			$model->email 						=  Input::get('email');
			$model->address 					=  !empty(Input::get('address'))?Input::get('address'):'';
			$model->ic_number 					=  !empty(Input::get('ic_number'))?Input::get('ic_number'):'';
			$model->refrence_id 				=  !empty(Input::get('refrence_id'))?Input::get('refrence_id'):'';
			$model->company_name 				=  !empty(Input::get('company_name'))?Input::get('company_name'):'';
			$model->registration_number 		=  !empty(Input::get('registration_number'))?Input::get('registration_number'):'';
			
			$model->is_active						=  1;
			$model->save();
			$modelId						=	$model->id;		
			
			if(!empty($sectionParticipates)){
				$sectionTotalContribution = 0;
				foreach($sectionParticipates as $sectionParticipat){
					if(!empty($sectionParticipat['name']) && !empty($sectionParticipat['section_plan'])){
						$sectionPlanPrice = SubProjectSectionPlan::where('id',$sectionParticipat['section_plan'])->pluck('price');
						$participateModel					=	new SectionParticipate;
						$participateModel->order_id			=	$modelId;
						$participateModel->sub_project_id	=	Input::get('sub_project_id');
						$participateModel->name				=	$sectionParticipat['name'];
						$participateModel->section_plan		=	$sectionParticipat['section_plan'];
						$participateModel->price			=	$sectionPlanPrice;
						$participateModel->save();
						
						$sectionTotalContribution +=	$sectionPlanPrice;
					}
				}
				if(!empty($sectionTotalContribution)){
					DonationOrder::where('id',$modelId)->update(array('total_contribution'=>$sectionTotalContribution));
					
					$model->total_contribution	=	$sectionTotalContribution;
				}
			}
			
			//seat reservationPlan
			if(!empty($SeatReservations)){
				$reservationTotalContribution = 0;
				foreach($SeatReservations as $seatPlanId=>$SeatReservation){
					if(!empty($SeatReservation['total_seat'])){
						$seatPrice	=	SubProjectSeatReservationPlan::where('id',$seatPlanId)->pluck('seat_price');
						$saveReservationOrder						=	new SeatReservationOrder;
						$saveReservationOrder->amount				=	!empty($seatPrice)?$seatPrice:0;
						$saveReservationOrder->order_id				=	$modelId;
						$saveReservationOrder->sub_project_id		=	Input::get('sub_project_id');
						$saveReservationOrder->seat_plan_id			=	$seatPlanId;
						$saveReservationOrder->seat_subtitle_id		=	$SeatReservation['seat_subtitle_id'];
						$saveReservationOrder->total_seat			=	!empty($SeatReservation['total_seat'])?$SeatReservation['total_seat']:1;
						$saveReservationOrder->total_attendance		=	!empty($SeatReservation['total_attendance'])?$SeatReservation['total_attendance']:$SeatReservation['total_seat'];
						$saveReservationOrder->save();
						
						$reservationTotalContribution +=	($saveReservationOrder->amount * $saveReservationOrder->total_seat);
					}
				}
				if(!empty($reservationTotalContribution)){
					$reservationFinalContribution = $reservationTotalContribution + $model->total_contribution;
					DonationOrder::where('id',$modelId)->update(array('seat_reservation_plan_price_1'=>$reservationTotalContribution,'seat_reservation_plan_price_2'=>$model->total_contribution,'total_contribution'=>$reservationFinalContribution));
					
					$model->total_contribution	=	$reservationFinalContribution;
				}else{
					DonationOrder::where('id',$modelId)->update(array('seat_reservation_plan_price_2'=>$model->total_contribution));
				}
			}
			
			if($projectModule == 1){
				$projectModuleName = "Ansar";
				if(!empty($model->plan_price) && ($model->plan_price != "other")){
					$activePlanPrice = DB::table('sub_project_plans')->where('id',Input::get('plan_price'))->pluck('price');
				}else{
					$activePlanPrice = $model->other_plan_price;
				}
				DonationOrder::where('id',$modelId)->update(array('total_contribution'=>$activePlanPrice));
			}else if($projectModule == 2){
				$projectModuleName = "Special Project";
				$activePlanPrice = $model->total_contribution;
			}else if($projectModule == 3){
				$projectModuleName = "Dana Lestari";
				if(!empty(Input::get('dana_default_project_plan'))){
					$activePlanPrice = SubProjectDanaDefaultPlan::where('id',Input::get('dana_default_project_plan'))->pluck('amount');
					DonationOrder::where('id',$modelId)->update(array('total_contribution'=>$activePlanPrice));
				}else if(!empty(Input::get('dana_property_plan'))){
					$activePlanPrice = $model->total_contribution;
				}else if(!empty(Input::get('dana_vendor'))){
					$activePlanPrice = $model->total_contribution;
				}else{
					$activePlanPrice = 0;
				}
			}else{
				$projectModuleName	=	"";
			}
			
			//pr($projectModule); die;
			
			$api_key = Config::get("Settings.payment_secret_key"); //'af6b3ddc-5152-4852-b3b8-5605aed427a1';
			$paymentCollectionId = Config::get("Settings.payment_collection_id");
			
			//create collection if not found/empty
			if(empty($paymentCollectionId)){
				
				//$host = 'https://www.billplz.com/api/v4/webhook_rank';
				//$host = 'https://www.billplz.com/api/v3/collections/dfza4e2q'; 
				$host = 'https://www.billplz.com/api/v3/collections';
				
				//create collection id
				$process = curl_init($host);
				
				$postdata = Array(
								  'title' => 'Hidayah Center Foundation',
								  'logo' => ''
								);
				
				curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
				curl_setopt($process, CURLOPT_POSTFIELDS, $postdata);
				curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
				$return = curl_exec($process);
				$collectionArray = json_decode($return);
				
				//pr($collectionArray); die;
				$paymentCollectionId = $collectionArray->id;
				
			}
			
			
			//bill generate
			$hostBill = 'https://www.billplz.com/api/v3/bills';
			$process = curl_init($hostBill);
			$callbackUrl = WEBSITE_URL.'payment-success';
			
			$totalPrice = $activePlanPrice * 100;
			
			$postdata = Array(
							  'collection_id' => $paymentCollectionId,
							  'email' => $model->email,
							 // 'mobile' => $model->phone,
							  'name' => $model->full_name,
							  'amount' => $totalPrice,
							  'callback_url' => $callbackUrl,
							  'redirect_url' => $callbackUrl,
							  'description' => $paymentCollectionId
							);
			
			curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
			curl_setopt($process, CURLOPT_POSTFIELDS, $postdata);
			curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($process);
			$paymentArray = json_decode($response); 
			
			if(isset($paymentArray->error)){
				
				$errorType = $paymentArray->error->type;
				$errorMessage = $paymentArray->error->message;
				//return View::make('front.user.payment_error_page',compact("errorType","errorMessage"));
				
				$billId = "";
				$billUrl = "";
			}else{
			
				$billUrl = $paymentArray->url;
				$billId = $paymentArray->id;
			}
			
			$bill_invoice_id = !empty($billId)?$billId:$model->unique_donation_id; 
			DonationOrder::where('id',$modelId)->update(array('bill_id'=>$bill_invoice_id));
			//pr($billUrl); die;
			
			//send sms
			$phone	=	$model->phone;
			if(!empty($phone)){
				$smsActions			= 	SmsAction::where('action','=','payment_contribution_customer')->get()->first();
				$smsTemplates		= 	SmsTemplate::where('action','=','payment_contribution_customer')->get(array('name','subject','action','body'))->first();
				
				$cons 				= 	explode(',',$smsActions['options']);
				$constants 			= 	array();
				
				foreach($cons as $key => $val){
					$constants[] 	= 	'{'.$val.'}';
				} 
				
				$DonationDate = date("d/m/Y");
				
				if(!empty($billId)){
					$invoice_link 			= WEBSITE_URL . "/invoice/".$billId;
				}else{
					$invoice_link 			= WEBSITE_URL . "/invoice/".$model->unique_donation_id;
				}
				
				$payment_type = DB::table('dropdown_managers')->where('id',$model->payment_method)->pluck('name');
				$project_name = $subProjectDetails->sub_project_name;
				$project_type = $projectModuleName;
				
				$rep_Array 			= 	array($model->unique_donation_id,$activePlanPrice,$DonationDate,$invoice_link,$payment_type,$project_name,$project_type); 
				$body				= 	str_replace($constants, $rep_Array, $smsTemplates['body']);
				$this->_sendSms($phone,$body);
			}
			
			$this->sendOrderPlacedEmail($modelId);
			
			if($model->payment_method == 5){
				//create payment transection whern online payment with status=0 and refrence_id=bill_id
				if(!empty($billId)){
					$donationPayment 					=  new DonationPayment;
					$donationPayment->order_id			=  $modelId; 
					$donationPayment->sub_project_id	=  Input::get('sub_project_id'); 
					$donationPayment->payment_option	=  $model->payment_method; 
					$donationPayment->invoice_id		=  !empty($billId)?$billId:$model->unique_donation_id; 
					$donationPayment->reference_id		=  $billId; 
					$donationPayment->receipt			=  ""; 
					$donationPayment->amount			=  $activePlanPrice; 
					$donationPayment->payment_status	=  "0"; 
					$donationPayment->save();
				}
				
				$err						=	array();
				$err['success']				=	1;
				$err['message']				=	trans("Donation added successfully.");
				$err['billUrl']				=	$billUrl;
				$err['invoiceId']			=	!empty($billId)?$billId:$model->unique_donation_id; 
				$err['DonationOrderId']		=	$model->unique_donation_id;
				return Response::json($err); 
				die;
			}else{
				if(!empty($model->receipt) || !empty($model->refrence_id)){
					$donationPayment 					=  new DonationPayment;
					$donationPayment->order_id			=  $modelId; 
					$donationPayment->sub_project_id	=  Input::get('sub_project_id'); 
					$donationPayment->payment_option	=  $model->payment_method; 
					$donationPayment->invoice_id		=  !empty($billId)?$billId:$model->unique_donation_id; 
					$donationPayment->reference_id		=  !empty($model->refrence_id) ? $model->refrence_id:''; 
					$donationPayment->receipt			=  !empty($model->receipt) ? $model->receipt:''; 
					$donationPayment->amount			=  $activePlanPrice; 
					$donationPayment->payment_status	=  "1"; 
					$donationPayment->save();
				}else{
					$donationPayment 					=  new DonationPayment;
					$donationPayment->order_id			=  $modelId; 
					$donationPayment->sub_project_id	=  Input::get('sub_project_id'); 
					$donationPayment->payment_option	=  $model->payment_method; 
					$donationPayment->invoice_id		=  !empty($billId)?$billId:$model->unique_donation_id; 
					$donationPayment->reference_id		=  !empty($model->refrence_id) ? $model->refrence_id:''; 
					$donationPayment->receipt			=  !empty($model->receipt) ? $model->receipt:''; 
					$donationPayment->amount			=  $activePlanPrice; 
					$donationPayment->payment_status	=  "0"; 
					$donationPayment->save();
				}
				
				$err						=	array();
				$err['success']				=	2;
				$err['message']				=	trans("Donation added successfully.");
				$err['invoiceId']			=	!empty($billId)?$billId:$model->unique_donation_id; 
				$err['DonationOrderId']		=	$model->unique_donation_id;
				$err['billUrl']				=	$billUrl;
				return Response::json($err); 
				die;
			}
		}
		
	}
	
	public function updateDonation(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$sectionParticipates			=	!empty($thisData['Section'])?$thisData['Section']:'';
		$Payments						=	!empty($thisData['Payment'])?$thisData['Payment']:'';
		$SeatReservations				=	!empty($thisData['SeatReservation'])?$thisData['SeatReservation']:'';
		$userId							=	Auth::user()->id;
		
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
			$err['error']				=	2;
			$err['message']				=	trans("Something Went Wrong!");
			return Response::json($err); 
			die;
		}
		
		//pr($thisData); die;
		//pr($Payments); die;
		
		$validator = Validator::make(
			$thisData,
			array(
				'plan_type'					=> 'required_if:project_module,=,1',
				'plan_price'				=> 'required_if:project_module,=,1',
				'time_period'				=> 'required_if:project_module,=,1',
				'default_project_plan'		=> 'required_if:customize_plan_option,=,1',
				'total_contribution'		=> 'required_if:customize_plan_option,=,1,2,3',
				'quantity_project_plan'		=> 'required_if:customize_plan_option,=,3',
				'quantity'					=> 'required_if:customize_plan_option,=,3',
				'section_name'				=> 'required_if:customize_plan_option,=,4',
				'section_plan'				=> 'required_if:customize_plan_option,=,4',
				'dana_default_project_plan'	=> 'required_if:customize_plan_option,=,5',
				'dana_property_plan'		=> 'required_if:customize_plan_option,=,6',
				'dana_vendor'				=> 'required_if:customize_plan_option,=,7',
				'full_name'					=> 'required',
				'phone'						=> 'required',
				'email'						=> 'required',
				'postcode'					=> 'required',
				'payment_method'			=> 'required',
				'company_name'				=> 'required_if:profile_type,1',
				'other_plan_price'			=> 'required_if:plan_price,=,other',
				'other_time_period'			=> 'required_if:time_period,=,other',
				//'slug' 					=> 'required|unique:cms_pages,slug',
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
			
			$paymentNumber = "1";
			if(!empty($Payments)){
			  foreach($Payments as $key=>$Payment){
				if(empty($Payment['amount'])){
					$err						=	array();
					$err['success']				=	false;
					$err['error']				=	1;
					$err['message']				=	trans("Enter payment amount for payment ".$paymentNumber.".");
					return Response::json($err); 
					die;
				}
				if(empty($Payment['payment_option'])){
					$err						=	array();
					$err['success']				=	false;
					$err['error']				=	1;
					$err['message']				=	trans("Select payment type for payment ".$paymentNumber.".");
					return Response::json($err); 
					die;
				}
				if(empty($Payment['reference_id'])){
					$err						=	array();
					$err['success']				=	false;
					$err['error']				=	1;
					$err['message']				=	trans("Enter refrence id for payment ".$paymentNumber.".");
					return Response::json($err); 
					die;
				}
				
				$paymentNumber++;
			  }
			}
			
			
			$donationOrderId		=	Input::get('donation_order_id');
			
			$model 								=  DonationOrder::find($donationOrderId);
			//$model->unique_donation_id 			=  $this->createOrderId(Input::get('sub_project_id'));
			$model->sub_project_id 				=  Input::get('sub_project_id');
			$model->plan_type 					=  !empty(Input::get('plan_type'))?Input::get('plan_type'):'';
			$model->plan_price 					=  !empty(Input::get('plan_price'))?Input::get('plan_price'):'';
			$model->time_period 				=  !empty(Input::get('time_period'))?Input::get('time_period'):'';
			if(!empty($model->plan_price)){
				$model->other_plan_price 			=  "";
			}else{
				$model->other_plan_price 			=  !empty(Input::get('other_plan_price'))?Input::get('other_plan_price'):'';
			}
			if(!empty($model->time_period)){
				$model->other_time_period 			=  "";
			}else{
				$model->other_time_period 			=  !empty(Input::get('other_time_period'))?Input::get('other_time_period'):'';				
			}
			
			$model->default_project_plan 		=  !empty(Input::get('default_project_plan'))?Input::get('default_project_plan'):'';
			$model->total_contribution 			=  !empty(Input::get('total_contribution'))?Input::get('total_contribution'):'';
			$model->quantity_project_plan 		=  !empty(Input::get('quantity_project_plan'))?Input::get('quantity_project_plan'):'';
			$model->quantity 					=  !empty(Input::get('quantity'))?Input::get('quantity'):'';
			
			$model->dana_default_project_plan 	=  !empty(Input::get('dana_default_project_plan'))?Input::get('dana_default_project_plan'):'';
			$model->dana_property_plan 			=  !empty(Input::get('dana_property_plan'))?Input::get('dana_property_plan'):'';
			$model->extra_note 					=  !empty(Input::get('extra_note'))?Input::get('extra_note'):'';
			$model->dana_vendor 				=  !empty(Input::get('dana_vendor'))?Input::get('dana_vendor'):'';
			
			$model->full_name 					=  Input::get('full_name');
			$model->postcode 					=  Input::get('postcode');
			$model->payment_method 				=  Input::get('payment_method');
			$model->phone 						=  Input::get('phone');
			$model->email 						=  Input::get('email');
			$model->address 					=  !empty(Input::get('address'))?Input::get('address'):'';
			$model->ic_number 					=  !empty(Input::get('ic_number'))?Input::get('ic_number'):'';
			$model->refrence_id 				=  !empty(Input::get('refrence_id'))?Input::get('refrence_id'):'';
			$model->company_name 				=  !empty(Input::get('company_name'))?Input::get('company_name'):'';
			$model->registration_number 		=  !empty(Input::get('registration_number'))?Input::get('registration_number'):'';
			
			$model->save();
			$modelId						=	$model->id;		
			
			//section participant add
			if(!empty($sectionParticipates)){
				$sectionTotalContribution = 0;
				foreach($sectionParticipates as $sectionParticipat){
					if(!empty($sectionParticipat['name']) && !empty($sectionParticipat['section_plan'])){
						$sectionPlanPrice = SubProjectSectionPlan::where('id',$sectionParticipat['section_plan'])->pluck('price');
						if(!empty($sectionParticipat['id'])){
							$participateModel				=	SectionParticipate::find($sectionParticipat['id']);
						}else{
							$participateModel				=	new SectionParticipate;
						}
						$participateModel->order_id			=	$modelId;
						$participateModel->sub_project_id	=	Input::get('sub_project_id');
						$participateModel->name				=	$sectionParticipat['name'];
						$participateModel->section_plan		=	$sectionParticipat['section_plan'];
						$participateModel->price			=	$sectionPlanPrice;
						$participateModel->save();
						
						$sectionTotalContribution +=	$sectionPlanPrice;
					}
				}
				if(!empty($sectionTotalContribution)){
					DonationOrder::where('id',$modelId)->update(array('total_contribution'=>$sectionTotalContribution));
					
					$model->total_contribution	=	$sectionTotalContribution;
				}
			}
			
			
			//seat reservationPlan
			if(!empty($SeatReservations)){
				$reservationTotalContribution = 0;
				foreach($SeatReservations as $seatPlanId=>$SeatReservation){
					if(!empty($SeatReservation['total_seat'])){
					  if(!empty($SeatReservation['id']) && isset($SeatReservation['id'])){
						  $saveReservationOrder						=	SeatReservationOrder::find($SeatReservation['id']);
					  }else{
						$seatPrice	=	SubProjectSeatReservationPlan::where('id',$seatPlanId)->pluck('seat_price');
						$saveReservationOrder						=	new SeatReservationOrder;
						$saveReservationOrder->amount				=	!empty($seatPrice)?$seatPrice:0;
					  }
						$saveReservationOrder->order_id				=	$modelId;
						$saveReservationOrder->sub_project_id		=	Input::get('sub_project_id');
						$saveReservationOrder->seat_plan_id			=	$seatPlanId;
						$saveReservationOrder->seat_subtitle_id		=	$SeatReservation['seat_subtitle_id'];
						$saveReservationOrder->total_seat			=	$SeatReservation['total_seat'];
						$saveReservationOrder->total_attendance		=	!empty($SeatReservation['total_attendance'])?$SeatReservation['total_attendance']:$SeatReservation['total_seat'];
						$saveReservationOrder->save();
						
						$reservationTotalContribution +=	$saveReservationOrder->amount;
					}
				}
				if(!empty($reservationTotalContribution)){
					$reservationTotalContribution = $reservationTotalContribution + $model->total_contribution;
					DonationOrder::where('id',$modelId)->update(array('seat_reservation_plan_price_1'=>$reservationTotalContribution,'seat_reservation_plan_price_2'=>$model->total_contribution,'total_contribution'=>$reservationTotalContribution));
					
					$model->total_contribution	=	$reservationTotalContribution;
				}
			}
			
			
			if($projectModule == 1){
				if(!empty($model->plan_price)){
					$activePlanPrice = DB::table('sub_project_plans')->where('id',Input::get('plan_price'))->pluck('price');
				}else{
					$activePlanPrice = $model->other_plan_price;
				}
			}else if($projectModule == 2){
				$activePlanPrice = $model->total_contribution;
			}else if($projectModule == 3){
				if(!empty(Input::get('dana_default_project_plan'))){
					$activePlanPrice = SubProjectDanaDefaultPlan::where('id',Input::get('dana_default_project_plan'))->pluck('amount');
					DonationOrder::where('id',$modelId)->update(array('total_contribution'=>$activePlanPrice));
				}else if(!empty(Input::get('dana_property_plan'))){
					$activePlanPrice = $model->total_contribution;
				}else if(!empty(Input::get('dana_vendor'))){
					$activePlanPrice = $model->total_contribution;
				}else{
					$activePlanPrice = 0;
				}
			}
			
			if(!empty($Payments)){
				foreach($Payments as $Payment){
					if(!empty($Payment['id'])){
						$savePaymentModel					=	DonationPayment::find($Payment['id']);
					}else{
						$savePaymentModel					=	new DonationPayment;
					}
					$savePaymentModel->order_id				=	$modelId; 
					$savePaymentModel->amount				=	$Payment['amount']; 
					$savePaymentModel->payment_option		=	$Payment['payment_option']; 
					$savePaymentModel->payment_status_date	=	$Payment['payment_date'];
					$savePaymentModel->invoice_id			=	time().rand(00,99); 
					$savePaymentModel->reference_id			=	$Payment['reference_id']; 
					$savePaymentModel->payment_status		=	$Payment['payment_status']; 
					if($savePaymentModel->payment_status == 2){
						$savePaymentModel->status_change_by		=	Auth::user()->id; 
					}
					$savePaymentModel->save();
				}
				
				$totalPaidAmount = DonationPayment::where('order_id',$modelId)->where('payment_status',2)->where('is_deleted',0)->where('is_active',1)->sum('amount');
				
				DonationOrder::where('id',$modelId)->update(array('deposite'=>$totalPaidAmount));
				
			}
			
			
			/* $api_key = Config::get("Settings.payment_secret_key"); //'af6b3ddc-5152-4852-b3b8-5605aed427a1';
			$paymentCollectionId = Config::get("Settings.payment_collection_id");
			
			//create collection if not found/empty
			if(empty($paymentCollectionId)){
				
				//$host = 'https://www.billplz.com/api/v4/webhook_rank';
				//$host = 'https://www.billplz.com/api/v3/collections/dfza4e2q'; 
				$host = 'https://www.billplz.com/api/v3/collections';
				
				//create collection id
				$process = curl_init($host);
				
				$postdata = Array(
								  'title' => 'Hidayah Center Foundation',
								  'logo' => ''
								);
				
				curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
				curl_setopt($process, CURLOPT_POSTFIELDS, $postdata);
				curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
				$return = curl_exec($process);
				$collectionArray = json_decode($return);
				
				//pr($collectionArray); die;
				$paymentCollectionId = $collectionArray->id;
				
			}
			
			
			//bill generate
			$hostBill = 'https://www.billplz.com/api/v3/bills';
			$process = curl_init($hostBill);
			$callbackUrl = WEBSITE_URL.'check-payment-success';
			
			$totalPrice = $activePlanPrice * 100;
			
			$postdata = Array(
							  'collection_id' => $paymentCollectionId,
							  'email' => $model->email,
							  //'mobile' => $model->phone,
							  'name' => $model->full_name,
							  'amount' => $totalPrice,
							  'callback_url' => $callbackUrl,
							  'redirect_url' => $callbackUrl,
							  'description' => $paymentCollectionId
							);
			
			curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
			curl_setopt($process, CURLOPT_POSTFIELDS, $postdata);
			curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($process);
			$paymentArray = json_decode($response); 
			
			//pr($paymentArray); die;
			if(isset($paymentArray->error)){
				
				$errorType = $paymentArray->error->type;
				$errorMessage = $paymentArray->error->message;
				//return View::make('front.user.payment_error_page',compact("errorType","errorMessage"));
				
				$billId = "";
				$billUrl = "";
			}else{
			
				$billUrl = $paymentArray->url;
				$billId = $paymentArray->id;
				DonationOrder::where('id',$modelId)->update(array('bill_id'=>$billId));
			} */
			//pr($billUrl); die;
			$billUrl = "";
			if($model->payment_method == 5){
				//create payment transection whern online payment with status=0 and refrence_id=bill_id
				/* if(!empty($billId)){
					$donationPayment 					=  new DonationPayment;
					$donationPayment->order_id			=  $modelId; 
					$donationPayment->payment_option	=  $model->payment_method; 
					$donationPayment->reference_id		=  $billId; 
					$donationPayment->receipt			=  ""; 
					$donationPayment->amount			=  $activePlanPrice; 
					$donationPayment->payment_status	=  "0"; 
					$donationPayment->save();
				} */
				
				$err						=	array();
				$err['success']				=	1;
				$err['message']				=	trans("Donation added successfully.");
				$err['billUrl']				=	$billUrl;
				$err['DonationOrderId']		=	$model->unique_donation_id;
				return Response::json($err); 
				die;
			}else{
				$err						=	array();
				$err['success']				=	2;
				$err['message']				=	trans("Donation added successfully.");
				$err['DonationOrderId']		=	$model->unique_donation_id;
				$err['billUrl']				=	$billUrl;
				return Response::json($err); 
				die;
			}
		}
		
	}
	
	public function saveEnquiry(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData						=	Input::all();  
		$userId							=	!empty(Auth::user()) ? Auth::user()->id :0;
		//pr($thisData); die;
		if(!empty(Input::get('sub_project_id'))){
			$subProjectDetails = DB::table('sub_projects')->where('id',Input::get('sub_project_id'))->first();
			$projectModule			=	$subProjectDetails->project_module;
			$customizePlanOption	=	($subProjectDetails->customize_plan_option == 0) ? 10 : $subProjectDetails->customize_plan_option ;
			
			$array_2=array("project_module"=>$projectModule,"customize_plan_option"=>$customizePlanOption);
			$thisData = array_merge($thisData,$array_2);
			
		}else{
			$err						=	array();
			$err['error']				=	1;
			$err['message']				=	trans("Something Went Wrong!");
			return Response::json($err); 
			die;
		}
		
		//pr($thisData); die;
		
		$validator = Validator::make(
			$thisData,
			array(
				'full_name'					=> 'required',
				'phone'						=> 'required',
				'email'						=> 'required',
				'postcode'					=> 'required',
				'company_name'				=> 'required_if:profile_type,1',
			),
			array(
				'company_name.required_if'	=>	'Company name is required',
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
			
			$model 								=  new DonationOrder;
			
			if(!empty(Input::get('email')) && empty($userId)){
				$userDetails = User::where('email',Input::get('email'))->where('is_deleted',0)->first();
				$userId	=	!empty($userDetails)?$userDetails->id:0;
			}
			
			if(empty($userId) || $userId == 0){
				Session::forget('RegisterDataPending');
				
				$pendingRegistrationData				=	array();
				$pendingRegistrationData['email']		=	Input::get('email');
				$pendingRegistrationData['full_name']	=	Input::get('full_name');
				$pendingRegistrationData['phone']		=	Input::get('phone');
				Session::set('RegisterDataPending', $pendingRegistrationData);
				
			}
			
			$model->user_id 					=  $userId;
			$model->unique_donation_id 			=  $this->createOrderId(Input::get('sub_project_id'));
			$model->sub_project_id 				=  Input::get('sub_project_id');
			
			$model->full_name 					=  Input::get('full_name');
			$model->postcode 					=  Input::get('postcode');
			$model->phone 						=  Input::get('phone');
			$model->email 						=  Input::get('email');
			$model->address 					=  !empty(Input::get('address'))?Input::get('address'):'';
			$model->ic_number 					=  !empty(Input::get('ic_number'))?Input::get('ic_number'):'';
			$model->refrence_id 				=  !empty(Input::get('refrence_id'))?Input::get('refrence_id'):'';
			$model->company_name 				=  !empty(Input::get('company_name'))?Input::get('company_name'):'';
			$model->registration_number 		=  !empty(Input::get('registration_number'))?Input::get('registration_number'):'';
			
			$model->is_enquiry					=  1;
			$model->is_active					=  1;
			$model->save();
			$modelId							=	$model->id;		
			
			//
			$donationPayment 					=  new DonationPayment;
			$donationPayment->order_id			=  $modelId; 
			$donationPayment->sub_project_id	=  Input::get('sub_project_id'); 
			$donationPayment->payment_option	=  ""; 
			$donationPayment->invoice_id		=  $model->unique_donation_id; 
			$donationPayment->reference_id		=  ''; 
			$donationPayment->receipt			=  ''; 
			$donationPayment->amount			=  0; 
			$donationPayment->payment_status	=  6; 
			$donationPayment->save();
			
			$this->sendEnquiryEmail($modelId);
			
			
			if(empty(Auth::user())){
				Session::forget('RegisterDataPending');
				
				$pendingRegistrationData				=	array();
				$pendingRegistrationData['email']		=	Input::get('email');
				$pendingRegistrationData['full_name']	=	Input::get('full_name');
				$pendingRegistrationData['phone']		=	Input::get('phone');
				Session::set('RegisterDataPending', $pendingRegistrationData);
				
				$err						=	array();
				$err['success']				=	2;
				$err['message']				=	trans("Donation added successfully.");
				$err['DonationOrderId']		=	$model->unique_donation_id;
				return Response::json($err); 
				die;
			}else{
				$err						=	array();
				$err['success']				=	1;
				$err['message']				=	trans("Donation added successfully.");
				$err['DonationOrderId']		=	$model->unique_donation_id;
				return Response::json($err); 
				die;
			}
		}
		
	}
	
	public function cancelRecurringPlan($donationId = null){
		if(!empty($donationId)){
			DonationOrder::where('unique_donation_id',$donationId)->update(array('is_recurring'=>0));
			
			Session::flash('flash_notice',  trans("Plan recurring payment is cancelled."));
			return redirect()->back();
			
		}else{
			
			Session::flash('flash_notice',  trans("Pagination error."));
			return redirect()->back();
			
		}
	}
	
	public function getOrderLists(){
		$subProjectId	=	"1";
		$finalOrderListArray	=	array();
		
		$OrderLists	=	DonationOrder::where('is_deleted',0)->where('is_active',1)->where('sub_project_id',$subProjectId)->get()->toArray();
		
		$pageMetaDetails['page']		=	"1";
		$pageMetaDetails['pages']		=	"1";
		$pageMetaDetails['perpage']		=	"-1";
		$pageMetaDetails['total']		=	"350";
		$pageMetaDetails['sort']		=	"asc";
		$pageMetaDetails['field']		=	"RecordID";
		
		$finalOrderListArray['meta']	=	$pageMetaDetails;
		$finalOrderListArray['data']	=	$OrderLists;
		
		return Response::json($finalOrderListArray); 
		die;
		pr($finalOrderListArray); die;
		
		
	}
	
	public function AddMorePayment(){
		$counter				=	Input::get('counter');
		$order_id				=	Input::get('order_id');
		
		//$paymentMethods = Dropdown::where('is_active',1)->where('dropdown_type','payment-method')->lists('name','id');
		$paymentMethods = PaymentOption::where('is_active',1)->orderBy('id','ASC')->lists('name','id');
		
		return View::make('front.user.add_more_payments',compact("counter","paymentMethods"));
	}
	
	public function GetDonationInvoiceTable(){
		$orderId		=	Input::get('order_id');
		//$orderDetails 	= 	Order::where('id',$orderId)->first();
		
		$DonationInvoiceLists = DonationPayment::where('is_active',1)->where('is_deleted',0)->where('order_id',$orderId)->orderBy('id', 'ASC')->get();
		
		return View::make('front.user.get_donation_invoice_table',compact("DonationInvoiceLists"));
	}
	
	
	
	
	public function ansarangkasaswasta(){
		return View::make('front.user.ansar_angkasa_swasta');
	}
	public function projecttemplatecharity(){
		return View::make('front.user.project_template_charity');
	}
	public function specialprojectcharity(){
		return View::make('front.user.special_project_charity');
	}
	public function specialprojectiftarperdana(){
		return View::make('front.user.special_project_iftar_perdana');
	}
	public function danalestarihibahtakaful(){
		return View::make('front.user.dana_lestari_hibah_takaful');
	}
	public function projecttemplatesdanalestari(){
		return View::make('front.user.project_templates_dana_lestari');
	}
	public function accountadminlistadd(){
		return View::make('front.user.account_admin_list_add');
	}
	public function danalestaripelaburansukuk(){
		return View::make('front.user.dana_lestari_pelaburan_sukuk');
	}
	
	//https://www.smshubs.net/api/sendsms.php?email=[EMAIL]&key=[KEY]&sender=[SENDER]&recipient =[RECIPIENT]&message=[MESSAGE]&referenceID=[CUSTOMREFERENCEID]
	
	
}// end UserController class
