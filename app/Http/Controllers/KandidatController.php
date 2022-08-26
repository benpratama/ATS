<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KandidatController extends Controller
{
    public function index($id,$noidentitas)
    {

        $info_kandiat = DB::table('T_kandidat')
                ->where('id',$id)
                ->where('noidentitas',$noidentitas)
                ->first();
        // $info_kandiat = DB::table('T_kandidat')
        //                 ->where('id',$id)
        //                 ->first();
       if($info_kandiat){
            return view('detail_kandidat',['info_kandidat' => $info_kandiat]);
       }else{
            return redirect()->route('home');
       }      
    }
}
