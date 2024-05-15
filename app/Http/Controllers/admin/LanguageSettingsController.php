<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseController;
use App\Model\Setting;
use App\Model\AdminLanguageSetting;
use App\Model\LanguageSetting;
use App\Model\Language;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator;

/**
 * LanguageSettings Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/languages/
 */
 
class LanguageSettingsController extends BaseController {

/**
* Function for display list of all languages
*
* @param null
*
* @return view page. 
*/
	public $model	=	'LanguageSettings';
	
	public function __construct() {
		View::share('modelName',$this->model);
	}
	
	public function listLanguageSetting(){	
		//echo 5435;die;
		//$this->settingFileWrite(); 
		$DB				=	AdminLanguageSetting::query();
		$searchVariable	=	array(); 
		$inputGet		=	Input::get();
		
		if ((Input::get() && isset($inputGet['display'])) || isset($inputGet['page']) ) {
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
		
		$sortBy = (Input::get('sortBy')) ? Input::get('sortBy') : 'updated_at';
	    $order  = (Input::get('order')) ? Input::get('order')   : 'DESC';
		
		$result = $DB->orderBy($sortBy,$order)->paginate(Config::get("Reading.records_per_page"));
		$complete_string		=	Input::query();
		unset($complete_string["sortBy"]);
		unset($complete_string["order"]);
		$query_string			=	http_build_query($complete_string);
		$result->appends(Input::all())->render();
		//echo  35345;die;
		return  View::make('admin.languages.index',compact('result','searchVariable','sortBy','order','model'));
	} // listLanguageSetting()

/**
 * Function for display page for  add new text or message
 *
 * @param null
 *
 * @return view page. 
 */
	public function addLanguageSetting(){
		$languages			=	Language::where('is_active', '=', '1')->get();
		$default_language	=	Config::get('default_language');
		$language_code 		=   $default_language['language_code'];
		
		return  View::make('admin.languages.add',compact('languages' ,'language_code'));
	
	} // end addLanguageSetting()

/**
 * Function for save new text or message 
 *
 * @param null
 *
 * @return redirect page. 
 */
	public function saveLanguageSetting(){	
		$thisData	=	Input::all();
		$validator  = Validator::make(
			$thisData,
			array(
				'default' 		=> 'required'
			),
			array('default.required' 		=> 'Default language required')
		);
		
		if ($validator->fails())
		{	
			return Redirect::to('admin/language-settings/add-setting')
				->withErrors($validator)->withInput();
		}else{
			
			$msgid		=	Input::get('default');
			foreach($thisData['language'] as $key => $val){
				$obj	 = 	new AdminLanguageSetting;
			if(!empty($val)){
				$obj->msgid    		=  trim($msgid);
				$obj->locale   		=  trim($key);
				$obj->msgstr   		=  empty($val)?addslashes($key):$val;
				
				$obj->save();
			}
				$langarr 			=	$thisData['language'];
				$filename			= 'f' . gmdate('YmdHis');
				foreach ($langarr as $k => $v){			
				
						$path = ROOT.DS.'resources'.DS.'lang'.DS.$k;
						if (!file_exists($path)) mkdir($path,0777);
						$file = $path.DS.$filename;
						if (!file_exists($path)) touch($file);
						$file = new File($path.DS.$filename);
					    $list			=	LanguageSetting::where('locale',$k)->get();
						$currLangArray	=	'<?php return array(';
						foreach($list as $listDetails){
							if($listDetails['locale'] == $k){
								$currLangArray	.=  '"'.$listDetails['msgid'].'"=>"'.$listDetails['msgstr'].'",'."\n";
							}
						}
						$currLangArray	.=	');';
						
						$file 			= 	 ROOT.DS.'resources'.DS.'lang'.DS.$k.DS.'messages.php';
						$bytes_written  = 	 File::put($file, $currLangArray);
						
						if (file_exists(ROOT.DS.'resources'.DS.'lang'.DS.'messages.php'))
						rename (ROOT.DS.'resources'.DS.'lang'.DS.$k.DS.'messages.php',ROOT.DS.'resources'.DS.'lang'.DS.$k.DS.'messages.php.old'.gmdate('YmdHis'));
					}
			}
			return Redirect::to('admin/language-settings')
				->with('success',trans("messages.system_Management.language_add_msg") );
		}
	}// end saveLanguageSetting()
 
/**
 * Function for display page for edit text or message
 *
 * @param $Id as id of created text or message
 *
 * @return view page. 
*/
	public function editLanguageSetting($Id){ 
		$id = Input::get('id');
		$result		=	AdminLanguageSetting::find($Id);
		//pr($result);die;
		return  View::make('admin.languages.edit',compact('Id','result'));
	} // end editLanguageSetting()

/**
 * Function for save changed message or text 
 *
 * @param $Id as id of created text or message
 *
 * @return redirect page. 
*/
	function updateLanguageSetting(){ 
			$id				=	Input::get('id');	
			$msgstr			=   Input::get('msgstr');
			$obj	 	 	=	AdminLanguageSetting::find($id);
			$obj->msgstr   	= 	!empty($msgstr) ? addslashes($msgstr):'';
			$local 			=   $obj->locale;
			$obj->save();
			/** Writes on the file **/

				$filename= 'f' . gmdate('YmdHis');
				$path = ROOT.DS.'resources'.DS.'lang'.DS.$local;
				if (!file_exists($path)) mkdir($path,0777);
				$file = $path.DS.$filename;
				if (!file_exists($path)) touch($file);
				$file = new File($path.DS.$filename);
				
				
				$list		=	LanguageSetting::where('locale',$local)->get();
				//$languages	=	language::where('is_active', '=', '1')->get(array('folder_code','lang_code'));
				$currLangArray	=	'<?php return array(';
				foreach($list as $listDetails){
					if($listDetails['locale'] == $local){
						$currLangArray	.=  '"'.$listDetails['msgid'].'"=>"'.$listDetails['msgstr'].'",'."\n";
					}
				}
				$currLangArray	.=	');';
				
				$file 			= 	 ROOT.DS.'resources'.DS.'lang'.DS.$local.DS.'messages.php';
				$bytes_written  = 	 File::put($file, $currLangArray);
				Session::flash('flash_notice',trans("Language word updated successfully")); 
			die;
	} // end updateLanguageSetting()
/**
 * Function for write file on create and update text  or message 
 *
 * @param null
 *
 * @return void. 
 */
	public function settingFileWrite(){ 
		//echo "HELLO";die;
		/* $DB			=	AdminLanguageSetting::query();
		$list		=	$DB->get()->toArray(); */
		//pr($list);die;
		$languages	=	Language::where('is_active', '=', '1')->get(array('folder_code','lang_code'));
		
		foreach($languages as $key => $val){
			$currLangArray	=	'<?php return array(';
			$list			=	AdminLanguageSetting::where('locale',$val->lang_code)->select("msgid","msgstr")->get()->toArray();
			//pr($list);die;
			if(!empty($list)){
				foreach($list as $listDetails){
					//if($listDetails['locale'] == $val->lang_code){
						$currLangArray	.=  '"'.$listDetails['msgid'].'"=>"'.$listDetails['msgstr'].'",'."\n";
					//}
				}
			}
			$currLangArray	.=	');';
			
			$file 			= 	 ROOT.DS.'resources'.DS.'lang'.DS.$val->lang_code.DS.'messages.php';
			File::put($file, $currLangArray);
			/* $bytes_written  = 	 
			if ($bytes_written === false)
			{
				die("Error writing to file");
			} */
		}
	}// end settingFileWrite()
	
/*  Import language data from en file  */
	function import($lang_code = 'en') {
		// set the filename to read from
		$filename='message.php';
		$filename = ROOT.DS.'resources'.DS.'lang'.DS.$lang_code.DS.'messages.php';
		// open the file
		
		$filehandle = fopen($filename, "r");
		
		while (($row = fgets($filehandle)) !== FALSE) {
		  if (preg_match('/"([^"]+)"/', $row, $msgstring)) {
				// parse string in hochkomma:
				$msgid = $msgstring[1];
				$re = '~(["\'])[^"\']+\1[^"\']*(["\'])([^"\']+)\1~';
				//pr($msgid);
				 if (!empty($msgid)) {  
					//$row = fgets($filehandle);
					if ( preg_match($re, $row, $mString) )
					{
						$msgstr =  $mString[3];						
					} // check if exists
					
					$trec =DB::table('language_settings')->where('msgid','like', '%' . $msgid . '%')->where('locale',$lang_code)->first();
					
				    if (empty($trec)) {  						
						 $modelSettings 				=   new LanguageSetting;
						$modelSettings->msgid			=	$msgid;
						$modelSettings->msgstr			=	$msgstr;
						$modelSettings->locale			=	$lang_code;
						$modelSettings->save();  
					} else { 
					} 
				} 
			} 
		}
		fclose($filehandle);
		die;
   }  //end import()
	
}// end LanguageSettingsController
