<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekLevel
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
        $idDeptHR=[3,4,5];

        $dep = Auth::user()->id_Dept;
        if (!in_array($dep,$idDeptHR)) {
             return redirect()->route('rq.home');
        }
        return $next($request);
    }
}
