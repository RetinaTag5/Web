<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\friendship;

class friendmdw
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$authid = auth()->id();
		$userid = $request->input('userId');
		$friendornot = friendship::where([['user_r', '=', $authid], ['user_c','=', $userid], ['relation','=','1']])->get();
		$relation = false;
		if(count($friendornot)==0)
			return redirect('/notfriend/'.$userid);
		else 
			return $next($request);
    }
}
