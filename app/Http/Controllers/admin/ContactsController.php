<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\BaseController;
use App\Model\AdminUser;
use App\Model\Contact;
use App\Model\EmailTemplate;
use App\Model\EmailAction;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator;
/**
* Contacts Controller
*
* Add your methods in the class below
*
* This file will render views from views/admin/contact
*/
 
	class ContactsController extends BaseController {
/**
* $model Contact. 
*/	
	public $model	=	'Contact';
/**
* Function for __construct
*
* @param null
*
* @return model name
*/	
	public function __construct() {
		View::share('modelName',$this->model);
	}
/**
* Function for display list of  all contact
*
* @param null
*
* @return view page. 
*/
	public function listContact(){
		$DB 								= 	Contact::query();
		$searchVariable						=	array(); 
		$inputGet							=	Input::get();
		if (Input::get()) {
			$searchData						=	Input::get();
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
					$searchVariable			=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		$sortBy 							= 	(Input::get('sortBy')) ? Input::get('sortBy') : 'created_at';
	    $order  							= 	(Input::get('order')) ? Input::get('order')   : 'DESC';
		$model 								= 	$DB->orderBy($sortBy, $order)->paginate(Config::get("Reading.records_per_page"));
		
		$complete_string		=	Input::query();
		unset($complete_string["sortBy"]);
		unset($complete_string["order"]);
		$query_string			=	http_build_query($complete_string);
		$model->appends(Input::all())->render();
		
		return  View::make("admin.$this->model.index",compact('model' ,'searchVariable','sortBy','order','query_string'));
	} // end listContact()
/**
* Function for display contact detail
*
@param $modelId as id of contact
*
* @return view page. 
*/
	public function viewContact($modelId = 0){
		if($modelId){
			$model	=	Contact::where('id' ,$modelId)->first();
			if(empty($model)) {
				return Redirect::to('admin/contact-manager');
			}
			return  View::make("admin.$this->model.view", compact('model','modelId'));
		} 
	} // end viewContact()
/**
* Function for delete contact
* 
* @param $modelId as id 
*
* @return redirect page. 
*/
	public function deleteContact($modelId = 0){
		if($modelId){
			$model = Contact::findorFail($modelId);
			//$model->description()->delete();
			$model->delete();
			Session::flash('flash_notice',trans("Contact mail has been removed successfully")); 
		}
		return Redirect::route("$this->model.index");
	}// end deleteContact()
/**
* Function to reply a user 
* 
* @param $modelId as id 
*
* @return view page. 
*/	
	public function replyToUser($Id){
		Input::replace($this->arrayStripTags(Input::all()));
		if(!empty(Input::all())){
			$validationRules		=	array('message'	=> 'required');
			$validator 				=	Validator::make(
				Input::all(),
				$validationRules
			);
			if($validator->fails()){
				 return Redirect::back()->withErrors($validator)->withInput();
			}else{ 
				$userData			=	Contact::where('id',$Id)->first();
				##### send email to user from admin,to inform user that your message has been received successfully #####
				$emailActions		=	EmailAction::where('action','=','replay_to_user')->get()->toArray();
				$emailTemplates		=	EmailTemplate::where('action','=','replay_to_user')->get(array('name','subject','action','body'))->toArray();
				$cons 				=	explode(',',$emailActions[0]['options']);
				$constants 			=	array();
				foreach($cons as $key=>$val){
					$constants[] 	=	'{'.$val.'}';
				}
				$name				=	$userData->name;
				$email				=	$userData->email;
				$message			=	Input::get('message');
				
				$subject 			=  	$emailTemplates[0]['subject'];
				$rep_Array 			=  	array($name,$message); 
				$messageBody		=  	str_replace($constants, $rep_Array, $emailTemplates[0]['body']);
				$this->sendMail($email,$name,$subject,$messageBody,Config::get("Site.contact_email"));
				Session::flash('success','You have Successfully replied to '. $name);
				return Redirect::route("$this->model.index");
			}	
		}		
	}//end replyToUser()
	
	
	public function deleteContactEmail($Id){
		$this->_delete_table_entry('contacts',$Id,'id');
		Session::flash('flash_notice', trans("Contact mail has been removed successfully") ); 
		return Redirect::back();
	}
}// end ContactsController