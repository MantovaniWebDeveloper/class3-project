<?php

namespace App\Http\Middleware;

use Closure;

class Ajax
{
    /**
     * Handle an incoming request. Only ajax please!
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	public function handle($request, \Closure $next) {
		if ( ! $request->ajax())
			return response('Forbidden. Only Ajax Allowed. Team_1_speranza rules!', 403);
		return $next($request);
	}
	
}
