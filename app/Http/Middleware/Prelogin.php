<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Redirect;

class Prelogin
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
        if ((Auth::guard('tantousya')->check())) {
          return back();
        }

        else {
            return $next($request);
        }

    }
}
