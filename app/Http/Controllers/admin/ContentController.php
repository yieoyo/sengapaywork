<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\BaseController;
use App\Model\Content;
use App\Model\AdminUser;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator;
/**
* ContentController Controller
*
* Add your methods in the class below
*
* This file will render views from views/admin/Content
*/
	class ContentController extends BaseController {
/**
* Function for display all Content 
*
* @param null
*
* @return view page. 
*/
	public function listContent($user_id = 0){	
		$userDetails	=	AdminUser::find($user_id); 
		if(empty($userDetails)) {
			return Redirect::to('admin/users');
		}
		
		
		$DB							=	Content::query();
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
					$DB->where("$fieldName",'like','%'.$fieldValue.'%');
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}
		$sortBy 					= (Input::get('sortBy')) ? Input::get('sortBy') : 'updated_at';
	    $order  					= (Input::get('order')) ? Input::get('order')   : 'DESC';
		$result 					= $DB->where("user_id",$user_id)->orderBy($sortBy, $order)->paginate(Config::get("Reading.records_per_page"));
		
		$complete_string			=	Input::query();
		unset($complete_string["sortBy"]);
		unset($complete_string["order"]);
		$query_string				=	http_build_query($complete_string);
		$result->appends(Input::all())->render();
		
		return  View::make('admin.content.index',compact('result','searchVariable','sortBy','order','query_string',"userDetails"));
	}// end listContent()
/**
* Function for display page  for add new Content
*
* @param null
*
* @return view page. 
*/
	public function addContent($user_id = 0){
		$userDetails	=	AdminUser::find($user_id); 
		if(empty($userDetails)) {
			return Redirect::to('admin/users');
		}
		return  View::make('admin.content.add',compact("userDetails"));
	} //end addContent()
/**
* Function for save Content
*
* @param null
*
* @return redirect page. 
*/
	function saveContent($user_id = 0){
		$userDetails	=	AdminUser::find($user_id); 
		if(empty($userDetails)) {
			return Redirect::to('admin/users');
		}
		
		$thisData							=	Input::all();
		if(Input::get('content_type') == 'embedded'){
			$regex  = '#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si';
			$validator = Validator::make(
				$thisData,
				array(
					'title' 				=> 'required',
					//'description'			=> 'required',
					'banner_image' 			=> 'required|mimes:'.IMAGE_EXTENSION,
					'embedded_url' 			=>	'required|regex:'.$regex,
				),
				array(
					'banner_image.required'	=>	'The banner image field is required',
					'banner_image.mimes'	=>	'The banner image valid type is: '.IMAGE_EXTENSION,
				)
			);
		}
		if(Input::get('content_type') == 'pdf'){
			$pdfType						=	'pdf,PDF';
			$validator = Validator::make(
				$thisData,
				array(
					'title' 				=> 'required',
					//'description'			=> 'required',
					//'banner_image' 			=> 'required|mimes:'.IMAGE_EXTENSION,
					'pdf_path'				=> 'required|mimes:'.IMAGE_EXTENSION,
				),
				array(
					'pdf_path.required'			=>	'The photo field is required',
					'pdf_path.mimes'			=>	'The photo valid type is: '.IMAGE_EXTENSION,
					'banner_image.required'	=>	'The banner image field is required',
					'banner_image.mimes'	=>	'The banner image valid type is: '.IMAGE_EXTENSION,
				)
			);
		}
		
		
		if ($validator->fails()){	
			return Redirect::back()
			->withErrors($validator)->withInput();
		}else{
			$doc 				= 	new Content;
			$file_name		= 	'';
			if(!empty(Input::get('content_type')) && Input::get('content_type') == 'pdf' && Input::get('content_type') != ''){
				if(Input::hasFile('pdf_path')){
					$extension 			=	Input::file('pdf_path')->getClientOriginalExtension();
					$fileName			=	time().'-content-photo.'.$extension;
					$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
					$folderPath			=	CONTENT_IMAGE_ROOT_PATH.$newFolder;
					if(!File::exists($folderPath)) {
						File::makeDirectory($folderPath, $mode = 0777,true);
					}
					if(Input::file('pdf_path')->move($folderPath, $fileName)){
						$doc->pdf_path    = $newFolder.$fileName;
					}
				}
			}else {
				if(Input::hasFile('banner_image')){
					$extension 		=	Input::file('banner_image')->getClientOriginalExtension();
					$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
					$folderPath			=	CONTENT_IMAGE_ROOT_PATH.$newFolder;
					if(!File::exists($folderPath)) {
						File::makeDirectory($folderPath, $mode = 0777,true);
					}
					$file_name		=	time().'banner_image.'.$extension; 
					Input::file('banner_image')->move($folderPath, $file_name);
					$file_name		=	$newFolder.$file_name; 
				}else{
					$file_name		= 	'';
				} 
			}
			
			$doc->title    		= 	Input::get('title');
			$doc->user_id    	= 	$user_id;
			$doc->description	= 	Input::get('description');
			$doc->slug   		= 	$this->getSlug($doc->title,'title','Content');
			$doc->content_type   = 	Input::get('content_type');
			$doc->banner_image  = 	$file_name;
			$doc->embedded_url    =	!empty(Input::get('embedded_url')) ? Input::get('embedded_url') : '';
			$doc->save();
			Session::flash('flash_notice', trans("Profile content added successfully")); 
			return Redirect::to('admin/artists-content/'.$user_id);
		}
	}//end saveContent()
/**
* Function for display page  for edit Content page
*
* @param $Id ad id of Content page
*
* @return view page. 
*/	
	public function editContent($Id,$user_id){
		$userDetails	=	AdminUser::find($user_id); 
		if(empty($userDetails)) {
			return Redirect::to('admin/users');
		}
		$docs				=	Content::find($Id);
		if(empty($docs)) {
			return Redirect::to('admin/franchises-content');
		}
		return  View::make('admin.content.edit',array('doc' => $docs,"userDetails"=>$userDetails));
	}// end editContent()
/**
* Function for update Content 
*
* @param $Id ad id of Content 
*
* @return redirect page. 
*/
	function updateContent($Id,$user_id){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData							=	Input::all();
		$this_data							=	Input::all();
		$doc 								= 	Content:: find($Id);
		if(Input::get('content_type') == 'embedded'){
			$regex  = '#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si';
			$validator = Validator::make(
				$thisData,
				array(
					'title' 				=> 'required',
					//'description'			=> 'required',
					'banner_image' 			=> 'mimes:'.IMAGE_EXTENSION,
					'embedded_url' 			=>	'required|regex:'.$regex,
				),
				array(
					'banner_image.required'	=>	'The banner image field is required',
					'banner_image.mimes'	=>	'The banner image valid type is: '.IMAGE_EXTENSION,
				)
			);
		}
		if(Input::get('content_type') == 'pdf'){
			$pdfType						=	'pdf,PDF';
			$validator = Validator::make(
				$thisData,
				array(
					'title' 				=> 'required',
					//'description'			=> 'required',
					//'banner_image' 			=> 'required|mimes:'.IMAGE_EXTENSION,
					'pdf_path'				=> 'mimes:'.$pdfType,
				),
				array(
					'pdf_path.required'			=>	'The photo field is required',
					'pdf_path.mimes'			=>	'The photo valid type is: '.IMAGE_EXTENSION,
					'banner_image.required'	=>	'The banner image field is required',
					'banner_image.mimes'	=>	'The banner image valid type is: '.IMAGE_EXTENSION,
				)
			);
		}
		if ($validator->fails()){	
			return Redirect::back()
				->withErrors($validator)->withInput();
		}else{	
			$time  = time();
			
			if(!empty(Input::get('content_type')) && Input::get('content_type') == 'pdf' && Input::get('content_type') != ''){
				if(Input::hasFile('pdf_path')){
					$extension 			=	Input::file('pdf_path')->getClientOriginalExtension();
					$fileName			=	$time.'-content-photo.'.$extension;
					$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
					$folderPath			=	CONTENT_IMAGE_ROOT_PATH.$newFolder;
					if(!File::exists($folderPath)) {
						File::makeDirectory($folderPath, $mode = 0777,true);
					}
					if(Input::file('pdf_path')->move($folderPath, $fileName)){
						$doc->pdf_path    = $newFolder.$fileName;
					}
				}
			}else {
				if(Input::hasFile('banner_image') && !empty(Input::get('banner_image'))){
					$extension 		=	Input::file('banner_image')->getClientOriginalExtension();
					$newFolder     		= 	strtoupper(date('M'). date('Y')).DS;
					$folderPath			=	CONTENT_IMAGE_ROOT_PATH.$newFolder;
					if(!File::exists($folderPath)) {
						File::makeDirectory($folderPath, $mode = 0777,true);
					}
					@unlink(CONTENT_IMAGE_ROOT_PATH.$doc->banner_image);
					$file_name		=	time().'banner_image.'.$extension; 
					Input::file('banner_image')->move($folderPath, $file_name);
					$file_name		=	$newFolder.$file_name; 
					
					$doc->banner_image    	= 	$file_name;
				}
			}
			
			$doc->title    				= 	Input::get('title');
			$doc->user_id    			= 	$user_id;
			$doc->description    		= 	Input::get('description');
			$doc->content_type    		= 	Input::get('content_type');
			$doc->embedded_url    		=	!empty(Input::get('embedded_url')) ? Input::get('embedded_url') : '';
			$doc->save();
			Session::flash('flash_notice',  trans("Profile content updated successfully")); 
			return Redirect::intended('admin/artists-content/'.$user_id);
		}
	}// end updateContent()
/**
* Function for update Content  status
*
* @param $Id as id of Content 
* @param $Status as status of Content 
*
* @return redirect page. 
*/	
	public function updateContentStatus($Id = 0, $Status = 0){
		if($Status == 0	){
			$statusMessage	=	trans("Profile content  deactivated successfully");
		}else{
			$statusMessage	=	trans("Profile content  activated successfully");
		}
		$this->_update_all_status('artist_contents',$Id,$Status);
		Session::flash('flash_notice', $statusMessage); 
		return Redirect::back();
	}// end updateContentStatus()
/**
* Function for delete Content 
*
* @param $Id as id of Content 
*
* @return redirect page. 
*/	
	public function deleteContent($Id = 0){
		if($Id){
			$doc				=	Content::find($Id) ;
			@unlink(CONTENT_IMAGE_ROOT_PATH.$doc->banner_image);
			@unlink(CONTENT_IMAGE_ROOT_PATH.$doc->pdf_path);
			$this->_delete_table_entry('artist_contents',$Id,'id');
		}
		Session::flash('flash_notice',trans("Profile content removed successfully"));  
		return Redirect::back();
	}// end deleteContent()
	
	public function change_featured_status(){
		$content_id			=	Input::get("content_id");
		$userStatus			=	Input::get("checked_value");
		Content::where('id', '=', $content_id)->update(array('is_featured' => $userStatus));
		die;
	}

}// end ContentController	