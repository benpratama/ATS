<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Atasan
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
        $id = Auth::user()->id;
        $id_organisasi = Auth::user()->id_Organisasi;
        $listAkses = DB::table('M_AksesMPP')
                              ->select('id_MUser')
                              ->where('active',1)
                              ->where('id_MOrganisasi',$id_organisasi)
                              ->distinct()->pluck('id_MUser');
                              // ->pluck('id_MUser')
        $arrAkses=[];
        for ($i=0; $i <count($listAkses) ; $i++) { 
            array_push($arrAkses,$listAkses[$i]);
        }

        if (!in_array($id,$arrAkses)) {
             return redirect()->route('rq.home');
        }

        return $next($request);
    }
}
