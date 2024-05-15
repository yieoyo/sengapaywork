<?php

namespace App\Http\Middleware;

use Closure;
Use Auth;
Use Redirect,App;

class AuthAdmin 
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
		App::setLocale("en");
		if (Auth::guest())
		{
			return Redirect::to('/admin/login');
		}
		if(Auth::user()->user_role_id  != SUPER_ADMIN_ROLE_ID){
			return Redirect::to('/');
		}
        return $next($request);
    }
}
