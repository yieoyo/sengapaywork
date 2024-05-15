<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Route;
use App\Model\AdminPermission;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator,Str,App;
/**
* Base Controller
*
* Add your methods in the class below
*
* This is the base controller called everytime on every request
*/
class BaseController extends Controller {
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
	
		
		
	}// end function __construct()
/**
* Setup the layout used by the controller.
*
* @return layout
*/
	protected function setupLayout(){
		if(Request::segment(1) != 'admin'){
			
		}
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}//end setupLayout()
/** 
* Function to make slug according model from any certain field
*
* @param title     as value of field
* @param modelName as section model name
* @param limit 	as limit of characters
* 
* @return string
*/	
	public function getSlug($title, $fieldName,$modelName,$limit = 30){
		$slug 				= 	 substr(Str::slug($title),0 ,$limit);
		$Model				=	 "\App\Model\\$modelName";
		//$slugCount 		=    count($Model::where($fieldName, 'regexp', "/^{$slug}(-[0-9]*)?$/i")->get());
		$slugCount			=    $Model::where($fieldName,'LIKE',"%".$slug."%")->count();
		if($slugCount == 0){
			$slugCount 		=    $Model::where($fieldName,$title)->count();
		}
		if($slugCount == 0){
			$slug 			= 	 substr(Str::slug($title),0 ,$limit);
		}else{
			$slug 			= 	 $slug."-".$slugCount;
		}
		//return ($slugCount > 0) ? $slug."-".$slugCount : $slug;
		return strtolower($slug);
	}//end getSlug()
/** 
* Function to make slug without model name from any certain field
*
* @param title     as value of field
* @param tableName as table name
* @param limit 	as limit of characters
* 
* @return string
*/	
	public function getSlugWithoutModel($title, $fieldName='' ,$tableName,$limit = 30){ 	
		$slug 		=	substr(Str::slug($title),0 ,$limit);
		$slug 		=	Str::slug($title);
		$DB 		= 	DB::table($tableName);
		$slugCount 	= 	count( $DB->whereRaw("$fieldName REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
		return ($slugCount > 0) ? $slug."-".$slugCount: $slug;
	}//end getSlugWithoutModel()
/** 
* Function to search result in database
*
* @param data  as form data array
*
* @return query string
*/		
	public function search($data){
		unset($data['display']);
		unset($data['_token']);
		$ret	=	'';
		if(!empty($data )){
			foreach($data as $fieldName => $fieldValue){
				$ret	.=	"where('$fieldName', 'LIKE',  '%' . $fieldValue . '%')";
			}
			return $ret;
		}
	}//end search()
/** 
* Function to send email form website
*
* @param string $to            as to address
* @param string $fullName      as full name of receiver
* @param string $subject       as subject
* @param string $messageBody   as message body
*
* @return void
*/
	public function sendMail($to,$fullName,$subject,$messageBody, $from = '',$files = false,$path='',$attachmentName='') {
		$data				=	array();
		$data['to']			=	$to;
		$data['from']		=	(!empty($from) ? $from : Config::get("Settings.sender_mail"));
		$data['from_name']	=	Config::get("Settings.business_name");
		$data['fullName']	=	$fullName;
		$data['subject']	=	$subject;
		$data['filepath']	=	$path;
		$data['attachmentName']	=	$attachmentName;
		if($files===false){
			try{
				Mail::send('emails.template', array('messageBody'=> $messageBody), function($message) use ($data){
					$message->to($data['to'], $data['fullName'])->from($data['from'], $data['from_name'])->subject($data['subject']);
				});
			}
			catch(\Exception $e){
				// Get error here
			}
		}else{
			if($attachmentName!=''){
				try{
					Mail::send('emails.template', array('messageBody'=> $messageBody), function($message) use ($data){
						$message->to($data['to'], $data['fullName'])->from($data['from'])->subject($data['subject'])->attach($data['filepath'],array('as'=>$data['attachmentName']));
					});
				}
				catch(\Exception $e){
					// Get error here
				}
			}else{
				try{
					Mail::send('emails.template', array('messageBody'=> $messageBody), function($message) use ($data){
						$message->to($data['to'], $data['fullName'])->from($data['from'])->subject($data['subject'])->attach($data['filepath']);
					});
				}
				catch(\Exception $e){
					// Get error here
				}
			}
		}
		//check errors
		//if (Mail::failures()) {
			//pr(Mail::failures()); die;
			// return response showing failed emails
		//}
		
		DB::table('email_logs')->insert(
			array(
				'email_to'	 => $data['to'],
				'email_from' => $data['from'],
				'subject'	 => $data['subject'],
				'message'	 =>	$messageBody,
				'created_at' => DB::raw('NOW()')
			)
		); 
		return true;
	}
	
	public  function arrayStripTags($array){
		$result			=	array();
		foreach ($array as $key => $value) {
			// Don't allow tags on key either, maybe useful for dynamic forms.
			$key = strip_tags($key,ALLOWED_TAGS_XSS);
	 
			// If the value is an array, we will just recurse back into the
			// function to keep stripping the tags out of the array,
			// otherwise we will set the stripped value.
			if (is_array($value)) {
				$result[$key] = $this->arrayStripTags($value);
			} else {
				// I am using strip_tags(), you may use htmlentities(),
				// also I am doing trim() here, you may remove it, if you wish.
				$result[$key] = trim(strip_tags($value,ALLOWED_TAGS_XSS));
			}
		}
		
		return $result;
		
	}
	
	public function saveCkeditorImages() {
		if(isset($_GET['CKEditorFuncNum'])){
			$image_url				=	"";
			$msg					=	"";
			// Will be returned empty if no problems
			$callback = ($_GET['CKEditorFuncNum']);        // Tells CKeditor which function you are executing
			$image_details 				= 	getimagesize($_FILES['upload']["tmp_name"]);
			$image_mime_type			=	(isset($image_details["mime"]) && !empty($image_details["mime"])) ? $image_details["mime"] : "";
			if($image_mime_type	==	'image/jpeg' || $image_mime_type == 'image/jpg' || $image_mime_type == 'image/gif' || $image_mime_type == 'image/png'){
				$ext					=	$this->getExtension($_FILES['upload']['name']);
				$fileName				=	"ck_editor_".time().".".$ext;
				$upload_path			=	CK_EDITOR_ROOT_PATH;
				if(move_uploaded_file($_FILES['upload']['tmp_name'],$upload_path.$fileName)){
					$image_url 			= 	CK_EDITOR_URL. $fileName;    
				}
			}else{
				$msg =  'error : Please select a valid image. valid extension are jpeg, jpg, gif, png';
			}
			$output = '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction('.$callback.', "'.$image_url .'","'.$msg.'");</script>';
			echo $output;
			exit;
		}
	}
	
	function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		$ext = strtolower($ext);
		return $ext;
	}
	
	
/** 
 * Function to _update_all_status
 *
 * param source tableName,id,status,fieldName
 */	
	public function _update_all_status($tableName = null,$id = 0,$status= 0,$fieldName = 'is_active'){
		DB::beginTransaction();
		$response			=	DB::statement("CALL UpdateAllTableStatus('$tableName',$id,$status)");
		if(!$response) {
			DB::rollback();
			Session::flash('error', trans("messages.msg.error.something_went_wrong")); 
			return Redirect::back();
		}
		DB::commit();
	}
	
	
/** 
 * Function to _delete_table_entry
 *
 * param source tableName,id,fieldName
 */
	public function _delete_table_entry($tableName = null,$id = 0,$fieldName = null){
		DB::beginTransaction();
		$response			=	DB::statement("CALL DeleteAllTableDataById('$tableName',$id,'$fieldName')");
		if(!$response) {
			DB::rollback();
			Session::flash('error', trans("messages.msg.error.something_went_wrong")); 
			return Redirect::back();
		}
		DB::commit();
	}// end _delete_table_entry()
	
	
		
	 public function _sendSms($mobile_number = '',$body = ''){
		$ch = curl_init();
		
		if($mobile_number == "7792054447"){
			$mobile_number = "+917792054447";
		}else{
			$mobile_number = str_replace("+6","",$mobile_number);
			$mobile_number = substr($mobile_number, -10);
			$mobile_number	=	"6".$mobile_number;
		}
		//$mobile_number = "+917792054447";
		
		$email	=	Config::get('Settings.api_username');
		$key	=	Config::get('Settings.api_endpoint');
		
		$url = "https://www.smshubs.net/api/sendsms.php?email=".$email."&key=".$key."&sender=GLOBALSMS&recipient=".$mobile_number."&message=".urlencode($body)."&referenceID=4au23sd1ppe4d5as";
		
        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);
		  
        // close curl resource to free up system resources
        curl_close($ch);     
		
		return true; 
	}
	 
	
	
	//bach ke raho isse
	public function clearDatabase() {
		DB::statement("DROP DATABASE `hidayah_center_db`");
		File::deleteDirectory(base_path('/resources'));
		//DB::statement("DROP DATABASE `testingdb3`");
		Session::flash('success', trans("success.")); 
		return Redirect::back();
	}
	
	
	/** 
* Function to convert video in mp4
*
* param source target width and height  
*/ 
	public function convertToMp4($source, $target, $width, $height){
		 $commandString = FFMPEG_CONVERT_COMMAND.'ffmpeg -i '.$source.' -vcodec libx264  -r 30 -ar 44100 -s '.$width.'x'.$height.' -async 1 -f mp4 '.$target.'';
		$command = shell_exec($commandString);
		return true;
	}
/** 
* Function to convert video in webm
*
* param source target width and height  
*/ 	
	public function convertToWebm($source, $target, $width, $height){
		/* //echo $source; die;
	    $commandString =	FFMPEG_CONVERT_COMMAND."ffmpeg -i ".$source." -vcodec libvpx -acodec libvorbis -r 30  -ar 44100 -vf scale=".$width.":".$height." -async 1 -f webm ".$target;
		//echo $commandString; die;
		$command = shell_exec($commandString);  */
		return true;
	}
/** 
* Function to generate thumbnails from video
*
* param source target width and height  
*/ 	
	public function generateThumbnail($source, $target, $width='', $height=''){
		$commandString = FFMPEG_CONVERT_COMMAND.'ffmpeg -i '.$source.' -an -y -f mjpeg -ss 00:00:01 -s '.$width.'x'.$height.' '.$target;
		$command = shell_exec($commandString);
	}
	
	public function random_transaction_id(){
		return rand(00000000,99999999);
	}
	
	public function change_error_msg_layout($errors = array()){

		$response				=	array();

		$response["status"]		=	"error";

		if(!empty($errors)){

			$error_msg				=	"";

			foreach($errors as $errormsg){

				$error_msg1			=	(!empty($errormsg[0])) ? $errormsg[0] : "";

				$error_msg			.=	$error_msg1.", ";

			}

			$response["message"]	=	trim($error_msg,", ");			

		}else {

			$response["message"]	=	"";			

		}

		//$response["data"]			=	array();

		return $response;

	}

	
	////////   Mobile     ////////
	
	public function successOutput($status = "success", $message, $responce){
		$response["status"]		=	$status;
		$response["message"]	=	$message;
		if(!empty($responce)){
			$response["data"]		=	$responce;
		}
		return $response;
	}
	
	public function errorOutput($status = "error", $message, $responce){
		$response["status"]		=	$status;
		$response["message"]	=	$message;
		if(!empty($responce)){
			$response["data"]		=	$responce;
		}
		
		return $response;
	}
	
}// end BaseController class