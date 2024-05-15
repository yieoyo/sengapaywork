<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\BaseController;
use App\Model\Faq;
use App\Model\DropDown;
use App\Model\FaqDescription;
use App\Model\Language;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator,Str;
/**
* Faqs Controller
*
* Add your methods in the class below
*
* This file will render views from views/admin/faq
*/
	class FaqsController extends BaseController {
/**
* Function for display list of all faq's
*
* @param null
*
* @return view page. 
*/
	public function listFaq(){
		$DB							=	Faq::with('category')->select();
		$searchVariable				=	array(); 
		$inputGet					=	Input::get();
		if (Input::get()) {
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
			
			foreach($searchData as $fieldName => $fieldValue){
				if(!empty($fieldValue)){
					if($fieldName=='category_id'){
						$DB->where("category_id",$fieldValue);
					}else{
						$DB->where("$fieldName",'like','%'.$fieldValue.'%');
					}
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		
		$sortBy 					=	(Input::get('sortBy')) ? Input::get('sortBy') : 'updated_at';
	    $order  					=	(Input::get('order')) ? Input::get('order')   : 'DESC';
		$listDownloadCategory		=	DropDown::where('dropdown_type','faq-topic')->orderBy('created_at','asc')->lists('name','id');
		$result 					=  $DB->orderBy($sortBy, $order)->paginate(Config::get("Reading.records_per_page"));
		$complete_string		=	Input::query();
		unset($complete_string["sortBy"]);
		unset($complete_string["order"]);
		$query_string			=	http_build_query($complete_string);
		$result->appends(Input::all())->render();
		
		return  View::make('admin.faq.index',compact('result','searchVariable','sortBy','order','listDownloadCategory','query_string'));
	}// end listFaq()
/**
* Function for display page for add faq
*
* @param null
*
* @return view page. 
*/
	public function addFaq(){
		$languages					=	DB::select("CALL GetAcitveLanguages(1)");
		$default_language			=	Config::get('default_language');
		$language_code 				=   $default_language['language_code'];
		$listDownloadCategory		=	DropDown::where('dropdown_type','faq-topic')->orderBy('name','ASC')->lists('name','id')->toArray();
		return  View::make('admin.faq.add',compact('languages' ,'language_code','listDownloadCategory'));
	}// end addFaq()
/**
* Function for save created faq
*
* @param null
*
* @return redirect page. 
*/
	function saveFaq(){	
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData					=	Input::all();
		$default_language			=	Config::get('default_language');
		$language_code 				=   $default_language['language_code'];
		$dafaultLanguageArray		=	$thisData['data'][$language_code];
		$validator = Validator::make(
			array(
				'question' 			=> $dafaultLanguageArray["'question'"],
				'answer' 			=> $dafaultLanguageArray["'answer'"],
				//'category_id' 		=> Input::get('category_id'),
			),
			array(
				'question' 			=> 'required',
				'answer' 			=> 'required',
				//'category_id' 		=> 'required',
			),
			array(
				//'category_id.required' =>'The topic field is required.'
			)
		);
		if ($validator->fails()){	
			return Redirect::to('admin/faqs-manager/add-faqs')
				->withErrors($validator)->withInput();
		}else{
			$obj 					= 	new Faq;
			$obj->question 			= $dafaultLanguageArray["'question'"];
			$obj->answer   			= $dafaultLanguageArray["'answer'"];
			//$obj->category_id  	 	= Input::get('category_id');
			$obj->save();
			$faq_id					=	$obj->id;
			//FaqDescription::where('parent_id', '=', $faq_id)->delete();
			foreach ($thisData['data'] as $language_id => $faqs) {
				if (is_array($faqs)){
					FaqDescription::insert(
						array(
							'language_id'		=>	$language_id,
							'parent_id'			=>	$faq_id,
							'question'			=>	$faqs["'question'"],
							'answer'			=>	$faqs["'answer'"],
							//'category_id'		=>	Input::get('category_id'),
							'created_at' 		=> DB::raw('NOW()'),
							'updated_at' 		=> DB::raw('NOW()')
						)
					);
				}
			}
			Session::flash('flash_notice', trans("FAQ added successfully")); 
			return Redirect::intended('admin/faqs-manager');
		}
	}// end saveFaq()
/**
* Function for display page for edit faq
*
* @param $Id as id of faq
*
* @return view page. 
*/
	public function editFaq($Id){
		
		$AdminFaq 					=	Faq::find($Id);
		if(empty($AdminFaq)) {
			return Redirect::to('admin/faqs-manager');
		}
		$faqDescription				=	FaqDescription::where('parent_id', '=',  $Id)->get();
		$listDownloadCategory		=	DropDown::where('dropdown_type','faq-topic')->lists('name','id')->toArray();
		$multiLanguage				=	array();
		if(!empty($faqDescription)){
			foreach($faqDescription as $key =>$description) {
				$multiLanguage[$description->language_id]['question']	=	$description->question;						
				$multiLanguage[$description->language_id]['answer']	=	$description->answer;						
			}
		}
		$languages					=	DB::select("CALL GetAcitveLanguages(1)");
		$default_language			=	Config::get('default_language');
		$language_code 				=   $default_language['language_code'];
		return  View::make('admin.faq.edit',compact('languages','language_code','AdminFaq','multiLanguage','listDownloadCategory'));
	}//editFaq()
/**
* Function for update faq
*
* @param $Id as id of faq
*
* @return redirect page. 
*/	
	function updateFaq($Id){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData					=	Input::all();
		$default_language			=	Config::get('default_language');
		$language_code 				=   $default_language['language_code'];
		$dafaultLanguageArray		=	$thisData['data'][$language_code];
		$validator = Validator::make(
			array(
				'question' 			=> $dafaultLanguageArray["'question'"],
				'answer' 			=> $dafaultLanguageArray["'answer'"],
				//'category_id' 		=> Input::get('category_id'),
			),
			array(
				'question' 			=> 'required',
				'answer' 			=> 'required',
				//'category_id' 		=> 'required',
			),
			array(
				//'category_id.required' 		=>'The topic field is required.'
			)
		);
		if ($validator->fails()){	
			return Redirect::to('admin/faqs-manager/edit-faqs/'.$Id)
				->withErrors($validator)->withInput();
		}else{
			$obj	 				=  Faq::find($Id);
			$obj->question 			= $dafaultLanguageArray["'question'"];
			$obj->answer   			= $dafaultLanguageArray["'answer'"];
			//$obj->category_id   	= Input::get('category_id');
			$obj->save();
			$faq_id					= $obj->id;
			FaqDescription::where('parent_id', '=', $Id)->delete();
			foreach ($thisData['data'] as $language_id => $faqs) {
				if (is_array($faqs)){
					FaqDescription::insert(
						array(
							'language_id'		=>	$language_id,
							'parent_id'			=>	$faq_id,
							'question'			=>	$faqs["'question'"],
							'answer'			=>	$faqs["'answer'"],
							//'category_id'		=>	Input::get('category_id'),
							'updated_at' 		=> DB::raw('NOW()')
						)
					);
				}
			}
			Session::flash('flash_notice', trans("FAQ updated successfully")); 
			return Redirect::to('admin/faqs-manager');
		}
	} // end updateFaq()
/**
* Function for update faq status
*
* @param $Id as id of faq
* @param $Status as status of faq
*
* @return redirect page. 
*/	
	public function updateFaqStatus($Id = 0, $Status = 0){
		if($Status == 0	){
			$statusMessage	=	trans("FAQ deactivated successfully");
		}else{
			$statusMessage	=	trans("FAQ activated successfully");
		}
		$this->_update_all_status('faqs',$Id,$Status);
		//Faq::where('id', '=', $Id)->update(array('is_active' => $Status));
		Session::flash('flash_notice',$statusMessage); 
		return Redirect::back();
	}// end updateFaqStatus()
/**
* Function for delete faq
*
* @param $Id as id of faq
*
* @return redirect page. 
*/	
	public function deleteFaq($Id = 0){
		if($Id){
			/* $obj					=  Faq::find($Id);
			$obj->delete(); */
			$this->_delete_table_entry('faqs',$Id,'id');
			$this->_delete_table_entry('faq_descriptions',$Id,'parent_id');
			Session::flash('flash_notice', trans("FAQ removed successfully") ); 
		}
		return Redirect::intended('admin/faqs-manager');
	} // end deleteFaq()
/**
* Function for view Faq
*
* @param $Id as id of faq
*
* @return redirect page. 
*/		
	public function viewFaq($id){
		$faqDescription				=	FaqDescription::where('parent_id', '=',  $id)->get();
		$multiLanguage				=	array();
		if(!empty($faqDescription)){
			foreach($faqDescription as $key =>$description) {
				$multiLanguage[$description->language_id]['question']		=	$description->question;						
				$multiLanguage[$description->language_id]['answer']			=	$description->answer;
			}
		}
		$languages					=	DB::select("CALL GetAcitveLanguages(1)");
		$language_code				=	Config::get('default_language.language_code');
		return  View::make('admin.faq.view',compact('multiLanguage','languages','language_code'));
	}	
/**
* Function for delete,active,deactive faqs
*
* @param null
*
* @return redirect page. 
*/
 	public function performMultipleAction(){
		if(Request::ajax()){
			$actionType 			= ((Input::get('type'))) ? Input::get('type') : '';
			if(!empty($actionType) && !empty(Input::get('ids'))){
				if($actionType	==	'active'){
					Faq::whereIn('id', Input::get('ids'))->update(array('is_active' => 1));
				}
				elseif($actionType	==	'inactive'){
					Faq::whereIn('id', Input::get('ids'))->update(array('is_active' => 0));
				}
				elseif($actionType	==	'delete'){
					Faq::whereIn('id', Input::get('ids'))->delete();
				}
				Session::flash('success', trans("messages.system_management.action_performed_message")); 
			}
		}
	}//end performMultipleAction()
}// end FaqsController