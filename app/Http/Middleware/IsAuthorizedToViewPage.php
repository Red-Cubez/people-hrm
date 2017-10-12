<?php

namespace People\Http\Middleware;

use Closure;

class IsAuthorizedToViewPage
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
        $test = $request->server("REQUEST_URI");
      //  dd($test);
        return $next($request);
    }
   
}
