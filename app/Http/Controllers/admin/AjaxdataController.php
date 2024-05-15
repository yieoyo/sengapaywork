<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\BaseController;
use App\Model\AdminUser;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator;
/**
 * Ajaxdata Controller
 *
 * Add your methods in the class below
 *
 * These methods are used in ajax call
 */
 
class AjaxdataController extends BaseController {

	public function get_more_availability(){
		$day_type			=	input::get("day_type");
		$counter			=	input::get("counter");
		return  View::make('admin.artist.add_more_availability', compact('day_type',"counter"));
	}
	

	
}
