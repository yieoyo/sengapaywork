<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\BaseController;
use App\Model\AdminPermission;
use App\Model\Setting;
use App\Model\AdminLanguageSetting;
use App\Model\LanguageSetting;
use App\Model\Language;
use Illuminate\Routing\Route;
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

	
	
	public $model	=	'LanguageSettings';
	
	
	
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
		
		
		View::share('modelName',$this->model);
	}
	
	

/**
* Function for display list of all languages
*
* @param null
*
* @return view page. 
*/
	public function listLanguageSetting(){	
		if(isset($_GET['ref']) && (!empty($_GET['ref'])) && ($_GET['ref'] == 'ms')){
			Session::set('applocale','ms');
			App::setLocale('ms');
		} 
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
				if($fieldValue != ""){
				  if($fieldName == "keyword"){
					$DB->where("msgstr",'like','%'.$fieldValue.'%');
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				  }else if($fieldName == "is_active"){
					$DB->where("is_active",$fieldValue);
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				  }
				}
			}
		}
		
		$sortBy = (Input::get('sortBy')) ? Input::get('sortBy') : 'updated_at';
	    $order  = (Input::get('order')) ? Input::get('order')   : 'DESC';
		
		$result = $DB->where('locale','en')->where('is_deleted',0)->orderBy($sortBy,$order)->paginate(Config::get("Reading.records_per_page"));
		if(!empty($result)){
			foreach($result as &$record){
				$result_ms = AdminLanguageSetting::where('locale','ms')->where('msgid',$record->msgid)->where('is_deleted',0)->pluck('msgstr');
				
				$record->ms_msgstr  = $result_ms;
			}
		}
		
		$complete_string		=	Input::query();
		unset($complete_string["sortBy"]);
		unset($complete_string["order"]);
		$query_string			=	http_build_query($complete_string);
		$result->appends(Input::all())->render();
		//echo  35345;die;
		
		$totalRecords = $DB->count('id');
		
		return  View::make('front.languages.index',compact('result','searchVariable','sortBy','order','totalRecords'));
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
		
		return  View::make('front.languages.add',compact('languages' ,'language_code'));
	
	} // end addLanguageSetting()

/**
 * Function for save new text or message 
 *
 * @param null
 *
 * @return redirect page. 
 */
	public function saveLanguageSetting(){	
		$thisData				=	Input::all();
		$dafaultLanguage		=	$thisData['language']['en'];
		//pr($thisData); die;
		
		$validator  = Validator::make(

			array(
				
				'default' 			=> 	Input::get('default'),
				'language[en]' 		=> 	$dafaultLanguage,

			),
			
			array(

				'default' 			=> 'required',
				'language[en]' 		=> 'required',

			),

			array(
				
				'default.required' 		=> 'Default language required',
				'language[en].required' => 'English language required',
				
				)

		);

		if ($validator->fails()){	

			return Redirect::to('language-settings/add-setting')

				->withErrors($validator)->withInput();

		/* if(empty($thisData)){	
			return Redirect::to('language-settings/add-setting'); */
			
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
			
			
			
			
			/* foreach($thisData['language'] as $langKey => $langVal){
			  if(empty($langVal)){
				$validator  = Validator::make(
					array(
						'language['.$langKey.']'
					),
					array(
						'language['.$langKey.']' 					=> 'required'
					),
					array(
						'language['.$langKey.'].required' 		=> 'Default language required'
					)
				);
				
				if ($validator->fails())
				{	
					return Redirect::to('language-settings/add-setting')
						->withErrors($validator)->withInput();
				}
			  }
			}
			
			$msgid		=	$thisData['language']['en']; //Input::get('default');
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
			} */
			
			return Redirect::to('language-settings')
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
		
		$languages			=	Language::where('is_active', '=', '1')->get();
		if(!empty($languages)){
			foreach($languages as &$language){
				$langValue		=	AdminLanguageSetting::where('msgid',$Id)->where('is_deleted',0)->where('locale',$language->lang_code)->pluck('msgstr');
				$langSettingId	=	AdminLanguageSetting::where('msgid',$Id)->where('is_deleted',0)->where('locale',$language->lang_code)->pluck('id');
				$language->langValue 		= $langValue;
				$language->langSettingId 	= $langSettingId;
			}
		}
		
		//pr($languages);die;
		return  View::make('front.languages.edit',compact('Id','languages'));
	} // end editLanguageSetting()

/**
 * Function for save changed message or text 
 *
 * @param $Id as id of created text or message
 *
 * @return redirect page. 
*/
	function updateLanguageSetting(){ 
		$thisData				=	Input::all();
		$dafaultLanguage		=	$thisData['language']['en']['val'];
		//pr($thisData); die;
		
		$validator  = Validator::make(

			array(
				
				'language[en][val]' 		=> 	$dafaultLanguage,

			),
			
			array(

				'language[en][val]' 		=> 'required',

			),

			array(
				
				//'default.required' 		=> 'Default language required',
				'language[en][val].required' => 'English language required',
				
			)

		);

		if ($validator->fails()){	

			return redirect()->back()

				->withErrors($validator)->withInput();
		
		/* if(empty($thisData)){	
			return redirect()->back(); */
			
		}else{
			/* foreach($thisData['language'] as $langKey => $langVal){
			  if(empty($langVal['val'])){
				$validator  = Validator::make(
					array(
						'language['.$langKey.'][val]'
					),
					array(
						'language['.$langKey.'][val]' 					=> 'required'
					),
					array(
						'language['.$langKey.'][val].required' 		=> 'This field is required'
					)
				);
				
				if ($validator->fails())
				{	
					return Redirect::back()
						->withErrors($validator)->withInput();
				}
			  }
			} */
			
			foreach($thisData['language'] as $key => $val){
				$id				=	$val['langid'];	
				$msgstr			=   $val['val'];
				$obj	 	 	=	AdminLanguageSetting::find($id);
				$obj->msgstr   	= 	!empty($msgstr) ? addslashes($msgstr):'';
				$local 			=   $obj->locale;
				$obj->save();
				
				
				$langarr 			=	$thisData['language'];
				$filename			= 'f' . gmdate('YmdHis');
				foreach ($langarr as $k => $v){			
				
					$path = ROOT.DS.'resources'.DS.'lang'.DS.$k;
					if (!file_exists($path)) mkdir($path,0777);
					$file = $path.DS.$filename;
					if (!file_exists($path)) touch($file);
					$file = new File($path.DS.$filename);
					$list			=	LanguageSetting::where('locale',$k)->where('is_deleted',0)->where('is_active',1)->get();
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
			return Redirect::to('language-settings')
				->with('success',trans("messages.system_Management.language_add_msg") );
		}
		
		/* echo "aaaaaaaaa"; die;
		
		$id				=	Input::get('id');	
		$msgstr			=   Input::get('msgstr');
		$obj	 	 	=	AdminLanguageSetting::find($id);
		$obj->msgstr   	= 	!empty($msgstr) ? addslashes($msgstr):'';
		$local 			=   $obj->locale;
		$obj->save(); */
		/** Writes on the file **/

			/* $filename= 'f' . gmdate('YmdHis');
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
		die; */
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
			$list			=	AdminLanguageSetting::where('locale',$val->lang_code)->select("msgid","msgstr")->where('is_deleted',0)->get()->toArray();
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
	
	
	
	public function deleteLanguageSetting($slug = ""){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		DB::table('language_settings')->where('msgid',$slug)->where('is_deleted',0)->update(array('is_deleted'=>1));
		
		Session::flash('flash_notice',  trans("Language component deleted successfully."));
		
		return redirect()->back();
	}
	
	
	public function LanguageSettingChangeStatus($slug = "", $status = 0){
		if(empty($slug)){
			Session::flash('flash_notice',  trans("Something went wrong!"));
			return redirect()->back();
		}
		
		if($status == 1){
			$status = 1;
			$message = trans("Language component Active Successfully.");
		}else{
			$status = 0;
			$message = trans("Language component InActive Successfully.");
		}
		
		DB::table('language_settings')->where('msgid',$slug)->where('is_deleted',0)->update(array('is_active'=>$status));
		
		Session::flash('flash_notice',  $message);
	
		return redirect()->back();
	}
	
	
}// end LanguageSettingsController
