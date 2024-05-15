<?php
namespace App\Http\Controllers\front;

use App\Http\Controllers\BaseController;
use App\Model\AdminUser;
use App\Model\AdminPermission;
use App\Model\EmailTemplate;
use App\Model\EmailAction;
use Illuminate\Routing\Route;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator;

/**
* Emailtemplate Controller
*
* Add your methods in the class below
*
* This file will render views from views/emailtemplates
*/
 
	class EmailtemplateController extends BaseController {
		
		
		
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
* Function for display list of all email templates
*
* @param null
*
* @return view page. 
*/


	public function listTemplate(){
		$DB				=	EmailTemplate::query();
		$searchVariable	=	array(); 
		$inputGet		=	Input::get();
		if ((Input::get() && isset($inputGet['display'])) || isset($inputGet['page']) ){
			$searchData	=	Input::get();
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
				if(!empty($fieldValue)){
					$DB->where("$fieldName",'like','%'.$fieldValue.'%');
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		
		$sortBy = (Input::get('sortBy')) ? Input::get('sortBy') : 'id';
	    $order  = (Input::get('order')) ? Input::get('order')   : 'ASC';
		
		$adminResult	 	= 	$DB->where('template_for','admin')->orderBy($sortBy, $order)->paginate(Config::get("Reading.records_per_page"));
		$salesResult	 	= 	EmailTemplate::where('template_for','vendor')->orderBy($sortBy, $order)->paginate(Config::get("Reading.records_per_page"));
		$guestResult	 	= 	EmailTemplate::where('template_for','donor')->orderBy($sortBy, $order)->paginate(Config::get("Reading.records_per_page"));
		$result	 			= 	EmailTemplate::where('template_for','other')->orderBy($sortBy, $order)->paginate(Config::get("Reading.records_per_page"));
		
		$complete_string		=	Input::query();
		unset($complete_string["sortBy"]);
		unset($complete_string["order"]);
		$query_string			=	http_build_query($complete_string);
		$result->appends(Input::all())->render();
		
		return  View::make('front.emailtemplates.index', compact('result','adminResult','salesResult','guestResult','searchVariable','sortBy','order','query_string'));
	}// end listTemplate()
	
/**
* Function for display page for add email template
*
* @param null
*
* @return view page. 
*/
	public function addTemplate(){
		$Action_options	=	EmailAction::lists('action','action');
		return  View::make('front.emailtemplates.add',compact('Action_options'));
	}// end addTemplate()
	
/**
* Function for display save email template
*
* @param null
*
* @return redirect page. 
*/
	public function saveTemplate(){
		Input::replace($this->arrayStripTags(Input::all()));
		$validator = Validator::make(
			Input::all(),
			array(
				'template_for' 	=> 'required',
				'name' 			=> 'required',
				'subject' 		=> 'required',
				'action' 		=> 'required',
				'constants' 	=> 'required',
				'body' 			=> 'required'
			)
		);
		if ($validator->fails())
		{	
			return Redirect::to('email-manager/add-template')
				->withErrors($validator)->withInput();
		}else{			
			EmailTemplate::insert(
				array(
					'template_for'	=> Input::get('template_for'),
					'name'		 	=> Input::get('name'),
					'subject' 		=> Input::get('subject'),
					'action' 		=> Input::get('action'),
					'body'			=> Input::get('body'),
					'created_at' 	=> DB::raw('NOW()'),
					'updated_at' 	=> DB::raw('NOW()')
				)
			);
			
			Session::flash('flash_notice', trans("Email template added successfully")); 
			return Redirect::intended('email-manager');
		}
	}//  end saveTemplate()
	
/**
* Function for display page for edit email template page
*
* @param $Id as id of email template
*
* @return view page. 
*/
	public function editTemplate($Id){
		$Action_options	=	EmailAction::lists('action','action')->toArray();
		$emailTemplate	=	EmailTemplate::find($Id);
		if(empty($emailTemplate)) {
			return Redirect::to('email-manager');
		}
		return  View::make('front.emailtemplates.edit',compact('Action_options','emailTemplate'));
	} // end editTemplate()
	
/**
* Function for update email template
*
* @param $Id as id of email template
*
* @return redirect page. 
*/
	public function updateTemplate($Id){
		Input::replace($this->arrayStripTags(Input::all()));
		$validator = Validator::make(
			Input::all(),
			array(
				//'name' 			=> 'required',
				'subject' 		=> 'required',
				'body' 			=> 'required'
			)
		);
		if ($validator->fails())
		{	
			return Redirect::to('email-manager/edit-template/'.$Id)
				->withErrors($validator)->withInput();
		}else{
			EmailTemplate::where('id', $Id)
				->update(
					array(
						//'name'		 	=> Input::get('name'),
						'subject' 		=> Input::get('subject'),
						'body'			=> Input::get('body'),
						'updated_at' 	=> DB::raw('NOW()')
					)
				);
			Session::flash('flash_notice', trans("Email template updated successfully")); 
			return Redirect::intended('email-manager');
		}
	} // end updateTemplate()
	
/**
* Function for get all  defined constant  for email template
*
* @param null
*
* @return all  constant defined for template. 
*/
	public function getConstant(){
		if(Request::ajax() && Input::get()){
			$constantName 	= 	Input::get('constant');
			$options		= 	EmailAction::where('action', '=', $constantName)->lists('options','action'); 
			$a 				= 	explode(',',$options[$constantName]);
			echo json_encode($a);
		}
		exit;
	}


	public function sendTestEmailTemplate(){
		$TemplateId = Input::get('TemplateId');
		
		$templateDetails = EmailTemplate::find($TemplateId);
		//pr($templateDetails); die;
		if(!empty($templateDetails)){
			//mail email and password to new registered user
			$settingsEmail 			= 	Config::get('Settings.sender_mail');
			$SiteTitle 				= 	Config::get('Settings.business_name');
			
			$email					=	$settingsEmail;
			$to						=	$email;
			
			$emailActions			= 	EmailAction::where('action','=',$templateDetails->action)->get()->first();
			$emailTemplates			= 	EmailTemplate::where('action','=',$templateDetails->action)->get(array('name','subject','action','body'))->first();
		
			$cons 					= 	explode(',',$emailActions['options']);
			$constants 				= 	array();
			
			foreach($cons as $key => $val){
				$constants[] 		= 	'{'.$val.'}';
			} 
			
			$subject 				= 	$emailTemplates['subject'];
			$rep_Array 				= 	array(); 
			$messageBody			= 	str_replace($constants, $rep_Array, $emailTemplates['body']);
			$mail					= 	$this->sendMail($to,$SiteTitle,$subject,$messageBody,$settingsEmail);
			
			$err				=	array();
			$err['success']		=	"1";
			$err['message']		=	"Email Sent Successfully To ".$settingsEmail;
			return Response::json($err); 
			die;
		}else{
			$err				=	array();
			$err['error']		=	"1";
			$err['message']		=	"Email Not Sent.";
			return Response::json($err); 
			die;
		}
		
	}



}