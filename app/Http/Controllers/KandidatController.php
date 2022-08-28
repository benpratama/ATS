<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KandidatController extends Controller
{
    public function index($id,$noidentitas){

        $info_kandiat = DB::table('T_kandidat')
                ->where('id',$id)
                ->where('noidentitas',$noidentitas)
                ->first();

        $url_pahse2 = DB::table('T_linkPhase2')
                        ->where('id_Tkandidat',$id)
                        ->first();
       if($url_pahse2){
          $url = '/form-kandidat/phase2/'.$url_pahse2->url;
       }else{
          $url='BLM ada';
       }
       if($info_kandiat){
            return view('detail_kandidat',
                    [
                         'info_kandidat' => $info_kandiat,
                         'url_phase2' => $url
                    ]);
       }else{
            return redirect()->route('home');
       }      
    }

    public function GenUrl(Request $request){
          $id_kandidat = $request->id_kandidat;
          $noidentitas = $request->noidentitas;
          $date = Carbon::now();
          $join = $id_kandidat.$noidentitas.$date;
          $url = base64_encode($join);
          
          $result = DB::table('T_linkPhase2')
                    ->where('id_Tkandidat',$id_kandidat)
                    ->first();
          if($result){
               DB::table('T_linkPhase2')
                    ->where('id_Tkandidat',$id_kandidat)
                    ->update([
                         'openlink'=>Carbon::now(),
                         'closelink'=>$date->addDays(3),
                         'url'=>$url,
                         'active'=>1,
                         'deleted'=>0
                    ]);
               // TRS HAPUS SEMUA TBALE YANG MSUK PHASE2
          }else{
               // return 'tdk ada';
               DB::table('T_linkPhase2')
               ->insert([
                    'id_Tkandidat'=>$id_kandidat,
                    'openlink'=>Carbon::now(),
                    'closelink'=>$date->addDays(3),
                    'url'=>$url,
                    'active'=>1,
                    'deleted'=>0
               ]);
          }
          
          return true;
    }
}
