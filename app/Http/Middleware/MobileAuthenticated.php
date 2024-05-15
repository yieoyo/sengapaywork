<?php

namespace App\Http\Middleware;

use Closure;
Use Auth,Redirect,Input;

class MobileAuthenticated 
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
		//$accessToken 	= 	$request->header('access_token'); // string
		//echo $accessToken;die;
		return $next($request);
    }
}
