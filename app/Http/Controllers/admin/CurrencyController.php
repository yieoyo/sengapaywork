<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\BaseController;
use App\Model\Faq;
use App\Model\DropDown;
use App\Model\FaqDescription;
use App\Model\Language;
use App\Model\Currency;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator,Str;
/**
* Faqs Controller
*
* Add your methods in the class below
*
* This file will render views from views/admin/faq
*/
	class CurrencyController extends BaseController {
/**
* Function for display list of all faq's
*
* @param null
*
* @return view page. 
*/
	public function listCurrency(){
		$DB							=	Currency::query();
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
				}
				$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
			}
		}
		
		$sortBy 					=	(Input::get('sortBy')) ? Input::get('sortBy') : 'updated_at';
	    $order  					=	(Input::get('order')) ? Input::get('order')   : 'DESC'; 
		$result 					=   $DB->orderBy($sortBy, $order)->where('is_deleted',0)->paginate(Config::get("Reading.records_per_page"));
		$complete_string		=	Input::query();
		unset($complete_string["sortBy"]);
		unset($complete_string["order"]);
		$query_string			=	http_build_query($complete_string);
		$result->appends(Input::all())->render();
		
		return  View::make('admin.currency.index',compact('result','searchVariable','sortBy','order','query_string'));
	}// end listFaq()
/**
* Function for display page for add faq
*
* @param null
*
* @return view page. 
*/
	public function addCurrency(){   
		return  View::make('admin.currency.add',compact(''));
	}// end addCurrency()
/**
* Function for save created faq
*
* @param null
*
* @return redirect page. 
*/
	function saveCurrency(){	
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData					=	Input::all(); 
		$validator = Validator::make(
			Input::all(),
			array(
				'name' 			=> 'required',
				'symbol' 			=> 'required', 
			),
			array( 
			)
		);
		if ($validator->fails()){	
			return Redirect::Back()
				->withErrors($validator)->withInput();
		}else{
			$obj 					= 	new Currency;
			$obj->name 				= Input::get('name');
			$obj->symbol   			= Input::get('symbol'); 
			$obj->save(); 
			Session::flash('flash_notice', trans("Currency added successfully")); 
			return Redirect::route('currency.listCurrency');
		}
	}// end saveFaq()
/**
* Function for display page for edit faq
*
* @param $Id as id of faq
*
* @return view page. 
*/
	public function editCurrency($Id){ 
		$currency 					=	Currency::find($Id);
		if(empty($currency)) {
			return Redirect::to('admin/faqs-manager');
		} 
		return  View::make('admin.currency.edit',compact('currency'));
	}//editFaq()
/**
* Function for update faq
*
* @param $Id as id of faq
*
* @return redirect page. 
*/	
	function updateCurrency($Id){
		Input::replace($this->arrayStripTags(Input::all()));
		$thisData					=	Input::all(); 
		$validator = Validator::make(
			Input::all(),
			array(
				'name' 			=> 'required',
				'symbol' 			=> 'required', 
			),
			array( 
			)
		);
		if ($validator->fails()){	
			return Redirect::Back()
				->withErrors($validator)->withInput();
		}else{
			$obj	 				=  Currency::find($Id); 
			$obj->name 				= Input::get('name');
			$obj->symbol   			= Input::get('symbol'); 
			$obj->save(); 
			Session::flash('flash_notice', trans("Currency updated successfully")); 
			return Redirect::route('currency.listCurrency');
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
	public function updateCurrencyStatus($Id = 0, $Status = 0){
		if($Status == 0	){
			$statusMessage	=	trans("Currency deactivated successfully");
		}else{
			$statusMessage	=	trans("Currency activated successfully");
		}
		$this->_update_all_status('currencies',$Id,$Status);
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
	public function deleteCurrency($Id = 0){
		if($Id){
			DB::table('currencies')->where('id',$Id)->update(['is_deleted'=>1]);
			Session::flash('flash_notice', trans("Currency removed successfully") ); 
		}
		return Redirect::route('currency.listCurrency');
	}// end deleteFaq()

}// end FaqsController