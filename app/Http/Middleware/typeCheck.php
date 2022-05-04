<?php

namespace App\Http\Middleware;

use Closure;

class typeCheck
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
        $url=(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null);
//dd($_SERVER['HTTP_REFERER']);
        if ($url==null) {
          return redirect()->route('dashboard'); 
        }
        else
        return $next($request);
    }
}
