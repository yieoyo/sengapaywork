<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\BaseController;
use App\Model\HowItWork;
use App\Model\HowItWorkDescription;
use App\Model\Language;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Auth, Blade, Config, Cache, Cookie, DB, File, Hash, Input, Mail, mongoDate, Redirect, Request, Response, Session, URL, View, Validator;
/**
* HowItWorkController Controller
*
* Add your methods in the class below
*
* This file will render views from views/admin/HowItWork
*/
 
	class HowItWorkController extends BaseController {

	public $model	=	'HowItWork';
	
	public function __construct() {
		View::share('modelName',$this->model);
	}
/**
* Function for display all HowItWork    
*
* @param null
*
* @return view page. 
*/
	public function listHowItWork(){
		$DB								=	HowItWork::query();
		$searchVariable					=	array(); 
		$inputGet						=	Input::get();
		## Searching on the basis of comment ##
		if (Input::get()) {
			$searchData					=	Input::get();
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
					$searchVariable		=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		$sortBy 						= (Input::get('sortBy')) ? Input::get('sortBy') : 'updated_at';
	    $order  						= (Input::get('order')) ? Input::get('order')   : 'DESC';
		$model 							= $DB->orderBy($sortBy, $order)->paginate(Config::get("Reading.records_per_page"));
		
		$complete_string				=	Input::query();
		unset($complete_string["sortBy"]);
		unset($complete_string["order"]);
		$query_string					=	http_build_query($complete_string);
		$model->appends(Input::all())->render();
		
		
		return  View::make("admin.$this->model.index",compact('model','searchVariable','sortBy','order','query_string'));
	}// end listHowItWork()
/**
* Function for display page  for add new HowItWork  
*
* @param null
*
* @return view page. 
*/
	public function addHowItWork(){
		$languages				=	DB::select("CALL GetAcitveLanguages(1)");
		$language_code			=	Config::get('default_language.language_code');
		return  View::make("admin.$this->model.add",compact('languages' ,'language_code'));
	} //end addHowItWork()
/**
* Function for save added HowItWork page
*
* @param null
*
* @return redirect page. 
*/
	function saveHowItWork(){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData				=	Input::all();
		$default_language		=	Config::get('default_language');
		$language_code 			=   $default_language['language_code'];
		$dafaultLanguageArray	=	$thisData['data'][$language_code];
		$validator = Validator::make(
			array(
				'image' 		=> Input::file('image'),
				'name' 			=> $dafaultLanguageArray['name'],
				'order' 		=> Input::get('order'),
			),
			array(
				'image' 		=> 'required|image',
				'name' 			=> 'required',
				'order' 		=> 'required|numeric|unique:how_it_works,how_order',
			),
			array(
				'name.required' => 'The title field is required.',
			)
		);
		
		if ($validator->fails()){	
			return Redirect::back()
				->withErrors($validator)->withInput();
		}else{
			$model 						=	new HowItWork;
			if(Input::hasFile('image')){
				$extension 				=	Input::file('image')->getClientOriginalExtension();
				$fileName				=	time().'-image.'.$extension;
				if(Input::file('image')->move(HOWITWORK_ROOT_PATH, $fileName)){
					$model->image    	= 	$fileName;
				}
			}
			$model->name    			=	$dafaultLanguageArray['name'];
			$model->how_order 			= 	Input::get('order');
			$model->save();
			$modelId					=	$model->id;		
			foreach ($thisData['data'] as $language_id => $descriptionResult) {
				$modelDescription							=  new HowItWorkDescription();
				$modelDescription->language_id				=	$language_id;
				$modelDescription->parent_id				=	$modelId;
				$modelDescription->name						=	$descriptionResult['name'];	
				$modelDescription->save();
			}
			Session::flash('flash_notice',  trans("How it works added successfully"));  
			return Redirect::route("$this->model.index");
		}
	}//end saveHowItWork()
/**
* Function for display page  for edit HowItWork page
*
* @param $Id as id of HowItWork 
*
* @return view page. 
*/	
	public function editHowItWork($modelId){
		$model					=	HowItWork::findorFail($modelId);
		if(empty($model)) {
			return Redirect::to('admin/how-it-work-manager');
		}
		$modelDescriptions		=	HowItWorkDescription::where('parent_id','=',$modelId)->get();
		
		$multiLanguage			=	array();
		if(!empty($modelDescriptions)){
			foreach($modelDescriptions as $modelDescription) {
				$multiLanguage[$modelDescription->language_id]['name']	=	$modelDescription->name;
			}
		}
		$languages				=	DB::select("CALL GetAcitveLanguages(1)");
		$language_code			=	Config::get('default_language.language_code');
		return  View::make("admin.$this->model.edit",compact('languages','language_code','model','multiLanguage'));
	}// end editHowItWork()
/**
* Function for update HowItWork 
*
* @param $Id ad id of HowItWork 
*
* @return redirect page. 
*/
	function updateHowItWork($modelId){
		Input::replace($this->arrayStripTags(Input::all()));
		$model 					= 	HowItWork:: findOrFail($modelId);
		$this_data				=	Input::all();

		$language_code			=	Config::get('default_language.language_code');
		$dafaultLanguageArray	=	$this_data['data'][$language_code];
		
		$validator = Validator::make(
			array(
				'name' 			=> $dafaultLanguageArray['name'],
				'order' 		=> Input::get('order'),
			),
			array(
				'name' 			=> 'required',
				'order' 		=> "required|numeric|unique:how_it_works,how_order,$modelId",
			),
			array(
				'name.required' => 'The title field is required.',
				
			)
		);
		
		if ($validator->fails())
		{	return Redirect::back()
				->withErrors($validator)->withInput();
		}else{
			if(Input::hasFile('image')){
				$extension 							=	Input::file('image')->getClientOriginalExtension();
				$fileName							=	time().'-howitwork-image.'.$extension;
				if(Input::file('image')->move(HOWITWORK_ROOT_PATH, $fileName)){
					$model->image    				=   $fileName;
				}
			}
			$model->name    						= 	$dafaultLanguageArray['name'];
			$model->how_order 						= 	Input::get('order');
			$model->save();
			$modelId								=	$model->id;
			HowItWorkDescription::where('parent_id', '=', $modelId)->delete();
			foreach ($this_data['data'] as $language_id => $descriptionResult) {
				$modelDescription					=   new HowItWorkDescription();
				$modelDescription->language_id		=	$language_id;
				$modelDescription->parent_id		=	$modelId;
				$modelDescription->name				=	$descriptionResult['name'];	
				$modelDescription->save();					
			}
			Session::flash('flash_notice',  trans("How it works updated successfully"));
			return Redirect::route("$this->model.index");
		}
	
	}// end updateHowItWork()
/**
* Function for update HowItWork  status
*
* @param $Id as id of HowItWork 
* @param $Status as status of HowItWork 
* 
* @return redirect page. 
*/	
	public function updateHowItWorkStatus($modelId = 0, $modelStatus = 0){
		if($modelStatus == 0	){
			$statusMessage	=	trans("How it works deactivated successfully");
		}else{
			$statusMessage	=	trans("How it works activated successfully");
		}
		$this->_update_all_status('how_it_works',$modelId,$modelStatus);
		/* HowItWork::where('id', '=', $modelId)->update(array('is_active' => $modelStatus)); */
		Session::flash('flash_notice', $statusMessage); 
		return Redirect::route("$this->model.index");
	}// end updateHowItWorkStatus()
/**
* Function for delete HowItWork 
*
* @param $Id as id of HowItWork 
*
* @return redirect page. 
*/	
	public function deleteHowItWork($modelId = 0){
		if($modelId){
			/* $model = HowItWork::findorFail($modelId);
			$model->description()->delete();
			$model->delete(); */
			$this->_delete_table_entry('how_it_works',$modelId,'id');
			$this->_delete_table_entry('how_it_work_descriptions',$modelId,'parent_id');
			Session::flash('flash_notice',trans("How it works removed successfully")); 
		}
		return Redirect::route("$this->model.index");
	}// end deleteHowItWork()
/**
* Function for update the orderby field
*
* @param null
*
* @return view page. 
*/
	public function changeBlockOrder(){
		$order_by			=	Input::get('order_by'); 
		$id					=	Input::get('current_id');
		$sliderOrder		=	HowItWork::where('id',$id)->pluck('how_order');
		$validator 			= 	Validator::make(
		Input::all(),
		array(
			'order_by' 		=> 'required|numeric|unique:how_it_works,how_order,'.$id,
		),
		array(
			"order_by.required"=>'This order is required.',
			"order_by.numeric"=>'This order is numeric only.',
			"order_by.unique"=>'This order has been already taken.'
		)
		);
		$message			= 	$validator->messages()->toArray();
		if ($validator->fails()){	
			$response		=	array(
					'success' => false,
					'message'=> $message['order_by'],	
					
			);
			return Response::json($response); die;			
		}else{
			HowItWork::where('id',$id)->update(
						array(
							'how_order' => $order_by,
						)
					);
					
			$response		=	array(
					'success' => 1,
					'order_by' => $order_by,
			);
			return Response::json($response); die;		
		}
	}//end changeSliderOrder()
}// end HowItWorkController class
