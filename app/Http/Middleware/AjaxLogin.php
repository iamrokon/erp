<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\tantousya;
use Session;

class AjaxLogin
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

        $r=$request->route()->parameters();
        $bango=$r['id'];
        //$bango=$request->get('userId');
        $hasId=session()->get('login'.$bango);
      //dd($hasId,$bango,tantousya::where('bango',$bango)->first());
        if ($hasId != null && $hasId == tantousya::where('bango',$bango)->first()->accesscode) 
        {
            return $next($request);
            
        }

        else
        {
            session()->forget('login'.$bango);
            return redirect()->route('loginPage');
        }    

        
    }
}
