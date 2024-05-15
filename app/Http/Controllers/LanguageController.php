<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Config;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

/**
 * Language Controller
 *
 * Add your methods in the class below
 */

class LanguageController extends Controller
{
/** 
 * Function to switchLang
 *
 * @param $lang
 * 
 * @return view page
 */
    public function switchLang($lang)
    {
		//echo $lang;die;
	/* print_r( $lang);
		die; */
        //if (array_key_exists($lang, Config::get('languages'))) {
            Session::set('applocale', $lang);
			 App::setLocale($lang);
			 /* $lang			=	App::getLocale();
			echo $lang;die; */
        //}
        return Redirect::back();
    }// end switchLang()

}// end LanguageController
