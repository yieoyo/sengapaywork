<?php

namespace App\Http\Middleware;

use Closure;
Use Auth;
Use Redirect;
Use Session;
Use App;
Use Config;

class AuthFront 
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if (Session::has('applocale')) {
            App::setLocale(Session::get('applocale'));
        }else {
            App::setLocale(Config::get('app.fallback_locale'));
        }
		/* if(!empty(Auth::user()) && Auth::user()->user_role_id  == SUPER_ADMIN_ROLE_ID){
			return Redirect::to('/admin');
		} */
		if(Auth::guest()){
			return Redirect::to('/login');	
		}
        return $next($request);
    }
}
