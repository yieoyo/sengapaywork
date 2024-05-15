<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\BaseController;
use App\Model\Setting;
use App\Model\Language;
use App\Model\LanguageSetting;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator;
/**
* Language Controller
*
* Add your methods in the class below
*
* This file will render views from views/admin/language
*/
	class LanguageController extends BaseController {
/**
* Function for display list of all languages
*
* @param null
*
* @return view page. 
*/
	public $model	=	'Language';
	
	public function __construct() {
		View::share('modelName',$this->model);
	}
	
	public function listLanguage(){
		$DB = Language::query();
		$searchVariable	=	array(); 
		$inputGet		=	Input::get();
		 
		if (Input::get() && isset($inputGet['display'])) {
			$search = true;
			$searchData	=	Input::get();
			unset($searchData['display']);
			unset($searchData['_token']);
			foreach($searchData as $field_name => $fieldValue){
				if(!empty($fieldValue)){
					$DB->where("$field_name",'like','%'.$fieldValue.'%');
					$searchVariable	=	array_merge($searchVariable,array($field_name => $fieldValue));
				}
			}
		}
		$default_lang	 =  Setting::where('key','default_language.language_code')->pluck('value');
		$sortBy 		 = 	(Input::get('sortBy')) ? Input::get('sortBy') : 'created_at';
	    $order  		 = 	(Input::get('order')) ? Input::get('order')   : 'ASC';
	    
		$model 			 = 	$DB->orderBy($sortBy, $order)->paginate(Config::get("Reading.records_per_page"));
		return  View::make("admin.$this->model.index",compact('sortBy','order','model','searchVariable','default_lang'));
	}//end listLanguage()
/**
* Function for display add languages page
*
* @param null
*
* @return view page. 
*/	
	public function addLanguage(){
		return  View::make("admin.$this->model.add");
	}//end addLanguage()
/**
* Function for save added languages
*
* @param null
*
* @return view page. 
*/	
	public function saveLanguage(){
		Input::replace($this->arrayStripTags(Input::all()));
		$formData			=	Input::all();
		//pr($formData);die;
		if(!empty($formData)){
			$validator 		= 	Validator::make(
			Input::all(),
			array(
				'title'				=> 'required',
				'languagecode' 		=> 'required',
				'foldercode' 		=> 'required',
				)
			);
		}
		if($validator->fails()){
			 return Redirect::back()->withErrors($validator)->withInput();
		}else{
			$model 					=  new Language;
			$model->title			=	Input::get('title');
			$model->lang_code		=	Input::get('languagecode');
			$model->folder_code		=	Input::get('foldercode');
			
			$model->save();
			$modelId 				= $model->id;
			//echo $modelId;die;
			$selected_language 		= 	DB::table('languages')->where('id',$modelId)->first();
			$language_code			=	$selected_language->folder_code;
			$lang_code				=	$selected_language->lang_code;
			
			$deletedRows  			=	LanguageSetting::where('locale',$language_code)->delete();
			$eng_records			=	LanguageSetting::where('locale','en')->get();
			$temp					=	array();
			 foreach($eng_records as $eng_record){
					$modelSettings 					=   new LanguageSetting;
					$modelSettings->msgid			=	$eng_record->msgid;
					$modelSettings->locale			=	$language_code;
					$modelSettings->msgstr			=	$this->translate($eng_record->msgstr, 'en', $lang_code);
					$modelSettings->save();
				}
				/** Writes on the file **/
				$filename= 'f' . gmdate('YmdHis');
				$path = ROOT.DS.'resources'.DS.'lang'.DS.$language_code;
				if (!file_exists($path)) mkdir($path,0777);
				$file = $path.DS.$filename;
				if (!file_exists($path)) touch($file);
				$file = new File($path.DS.$filename);
				
				
				$list		=	LanguageSetting::where('locale',$language_code)->get();
				//$languages	=	language::where('is_active', '=', '1')->get(array('folder_code','lang_code'));
				$currLangArray	=	'<?php return array(';
				foreach($list as $listDetails){
					if($listDetails['locale'] == $lang_code){
						$currLangArray	.=  '"'.$listDetails['msgid'].'"=>"'.$listDetails['msgstr'].'",'."\n";
					}
				}
				$currLangArray	.=	');';
				
				$file 			= 	 ROOT.DS.'resources'.DS.'lang'.DS.$lang_code.DS.'messages.php';
				$bytes_written  = 	 File::put($file, $currLangArray);
				
			Session::flash('flash_notice',trans("Language added successfully"));  
			return Redirect::route("$this->model.index");
		}
	}//end saveLanguage()
/**
* Function for update active/inactive status
*
* @param $Id and $status 
*
* @return view page. 
*/	
	public function updateLanguageStatus($modelId = 0,$modelStatus=0){	
	
		if($modelStatus == 1	){
			/* 
			$selected_language 		= 	DB::table('languages')->where('id',$modelId)->first();
			$language_code			=	$selected_language->folder_code;
			$lang_code				=	$selected_language->lang_code;
			
			$deletedRows  			=	LanguageSetting::where('locale',$language_code)->delete();
			$eng_records			=	LanguageSetting::where('locale','en')->get();
			$temp					=	array();
			 foreach($eng_records as $eng_record){
					$modelSettings 					=   new LanguageSetting;
					$modelSettings->msgid			=	$eng_record->msgid;
					$modelSettings->locale			=	$language_code;
					$modelSettings->msgstr			=	$this->translate($eng_record->msgstr, 'en', $lang_code);
					$modelSettings->save();
				}
				
				$filename= 'f' . gmdate('YmdHis');
				$path = ROOT.DS.'resources'.DS.'lang'.DS.$language_code;
				if (!file_exists($path)) mkdir($path,0777);
				$file = $path.DS.$filename;
				if (!file_exists($path)) touch($file);
				$file = new File($path.DS.$filename);
				
				
				$list		=	LanguageSetting::where('locale',$language_code)->get();
			
				$currLangArray	=	'<?php return array(';
				foreach($list as $listDetails){
					if($listDetails['locale'] == $lang_code){
						$currLangArray	.=  '"'.$listDetails['msgid'].'"=>"'.$listDetails['msgstr'].'",'."\n";
					}
				}
				$currLangArray	.=	');';
				
				$file 			= 	 ROOT.DS.'resources'.DS.'lang'.DS.$lang_code.DS.'messages.php';
				$bytes_written  = 	 File::put($file, $currLangArray);
			 */
			$statusMessage	=	trans("Language activated successfully");
		}else{
			$statusMessage	=	trans("Language deactivated successfully");
		}
		$this->_update_all_status('languages',$modelId,$modelStatus);
		Session::flash('flash_notice',$statusMessage); 
		return Redirect::route("$this->model.index");
	}//end updateLanguageStatus()
/**
* Function for delete language
*
* @param $Id as language id
*
* @return view page. 
*/	
	public function deleteLanguage($modelId = 0){
		if($modelId){
			/* $model = Language::findorFail($modelId);
			$model->delete(); */
			$this->_delete_table_entry('languages',$modelId,'id');
			Session::flash('flash_notice',trans("Language removed successfully")); 
		}
		return Redirect::route("$this->model.index");
	}//end deleteLanguage()
/**
* Function for set defaultlanguage
*
* @param $language_id as language id
* $name as title
* $folder_code as folder code 
*
* @return view page. 
*/	
	public function updateDefaultLanguage($language_id = 0, $name = 0,$folder_code=0){
		// set the filename to read from
		if (empty($filename)) $filename='message.php';
		$filename = ROOT.DS.'resources'.DS.'lang'.DS.'en'.DS.'messages.php';
		
		// open the file
		
		$filehandle = fopen($filename, "r");
		while (($row = fgets($filehandle)) !== FALSE) {
			 if (preg_match('/"([^"]+)"/', $row, $msgstring)) {
			
				// parse string in hochkomma:
				$msgid = $msgstring[1];
				//echo $msgid.'<br>';
				$re = '~(["\'])[^"\']+\1[^"\']*(["\'])([^"\']+)\1~';
				 if (!empty($msgid)) { 
					$row = fgets($filehandle);
					if ( preg_match($re, $row, $mString) )
					{
						$msgstr =  $mString[3];
					} // check if exists
					
					$trec =DB::table('language_settings')->where('msgid','like', '%' . $msgid . '%')->where('locale',$folder_code)->first();
				    if (empty($trec)) { 
						$modelSettings 				    =   new LanguageSetting;
						$modelSettings->msgid			=	$msgid;
						$modelSettings->msgstr			=	$this->translate($msgstr, 'en',$folder_code);
						$modelSettings->locale			=	$folder_code;
						$modelSettings->save(); 
						
						//file write in exiting locale
						$path = ROOT.DS.'resources'.DS.'lang'.DS.$folder_code;
						if (!file_exists($path)) mkdir($path,0777);
						$file = $path.DS.$filename;
						if (!file_exists($path)) touch($file);
						$file = new File($path.DS.$filename);
					    $list			=	LanguageSetting::where('locale',$folder_code)->get();
						$currLangArray	=	'<?php return array(';
						foreach($list as $listDetails){
							if($listDetails['locale'] == $folder_code){
								$currLangArray	.=  '"'.$listDetails['msgid'].'"=>"'.$this->translate($listDetails['msgstr'], 'en',$folder_code).'",'."\n";
							}
						}
						$currLangArray	.=	');';
						
						$file 			= 	 ROOT.DS.'resources'.DS.'lang'.DS.$folder_code.DS.'messages.php';
						$bytes_written  = 	 File::put($file, $currLangArray);
						
						if (file_exists(ROOT.DS.'resources'.DS.'lang'.DS.'messages.php'))
						rename (ROOT.DS.'resources'.DS.'lang'.DS.$folder_code.DS.'messages.php',ROOT.DS.'resources'.DS.'lang'.DS.$folder_code.DS.'messages.php.old'.gmdate('YmdHis'));
						
					} else { 
					} 
				} 
			} 
		}
		fclose($filehandle);
		Session::flash('flash_notice',trans("messages.languages.language_mark_default_message")); 	
		return Redirect::route("$this->model.index");
	}//end updateDefaultLanguage()
/**
* function for write file on update and create
*
*@param null
*
* @return void
*/	
	public function settingFileWrite() {
		$DB		=	Setting::query();
		$list	=	$DB->orderBy('key','ASC')->get(array('key','value'))->toArray();
		$file 	= 	SETTING_FILE_PATH;
		$settingfile = '<?php ' . "\n";
		foreach($list as $value){
			$val		  =	 str_replace('"',"'",$value['value']);
			$settingfile .=  '$app->make('.'"config"'.')->set("'.$value['key'].'", "'.$val.'");' . "\n"; 
		}
		$bytes_written = File::put($file, $settingfile);
		if ($bytes_written === false)
		{
			die("Error writing to file");
		}
	}//end settingFileWrite()
/**
* Function for delete,active,deactive user
*
* @param $userId as id of users
*
* @return redirect page. 
*/
	public function performMultipleAction($userId = 0){
		if(Request::ajax()){
			$actionType 		= ((Input::get('type'))) ? Input::get('type') : '';
			if(!empty($actionType) && !empty(Input::get('ids'))){
				if($actionType	==	'active'){
					Language::whereIn('id', Input::get('ids'))->update(array('active' => 1));
				}
				elseif($actionType	==	'inactive'){
					Language::whereIn('id', Input::get('ids'))->update(array('active' => 0));
				}
				elseif($actionType	==	'delete'){
					Language::whereIn('id', Input::get('ids'))->delete();
				}
				Session::flash('flash_notice', trans("messages.global.action_performed_message")); 
			}
		}
	}//end performMultipleAction()
}//end LanguageController