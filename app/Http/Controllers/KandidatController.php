<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KandidatController extends Controller
{
    public function index($id,$noidentitas){
          // dd($server);
          $info_kandidat = DB::table('T_kandidat')
                    ->where('id',$id)
                    ->where('noidentitas',$noidentitas)
                    ->first();

          // Start UMUR, last Pendidikan, FreshorNot, Status Perkawinan
          $age = Carbon::parse($info_kandidat->tglLahir)->diff(Carbon::now())->y;
          $last_pendidikan = DB::table('last_Pendidikan')
                              ->where('id_Tkandidat',$id)
                              ->first();

          $FreshorNot = DB::table('freshornot')
                         ->where('id_Tkandidat',$id)
                         ->first();
          if (empty($FreshorNot)) {
               $FreshorNot='FRESH';
               $last_pekerjaan ="";
          }else{
               $FreshorNot='PENGALAMAN';
               $last_pekerjaan = DB::table('last_Pekerjaan')
                              ->where('id_Tkandidat',$id)
                              ->first();
          }
          $status_perkawinan = DB::table('M_Statuspernikahan')
                              ->where('active',1)
                              ->where('deleted',0)
                              ->get();
          // End UMUR, last pendidikan, Fresh or Not
          

          // Start url pahse 2
          $url_pahse2 = DB::table('T_linkPhase2')
                         ->select('url')
                         ->where('id_Tkandidat',$id)
                         ->first();
          if($url_pahse2){
               $server = $_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'];
               $url = $server.'/form-kandidat/phase2/'.$url_pahse2->url;
          }else{
               $url='BLM ada';
          }
          // End url pahse 2

          if($info_kandidat){
               return view('detail_kandidat',
                    [
                         'StatusPerkawinan'=>$status_perkawinan,
                         'FreshorNot'=>$FreshorNot,
                         'pekerjaan'=>$last_pekerjaan,
                         'pendidikan' =>$last_pendidikan,
                         'info_kandidat' => $info_kandidat,
                         'umur'=>$age,
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
                         'closelink'=>null,
                         'url'=>$url,
                         'active'=>1,
                         'deleted'=>0
                    ]);
               // TRS HAPUS SEMUA TBALE YANG MSUK PHASE2
               DB::select('EXEC SP_Clear_FormPhase2  ?',array($id_kandidat));
          }else{
               // return 'tdk ada';
               DB::table('T_linkPhase2')
               ->insert([
                    'id_Tkandidat'=>$id_kandidat,
                    'openlink'=>Carbon::now(),
                    'closelink'=>null,
                    'url'=>$url,
                    'active'=>1,
                    'deleted'=>0
               ]);
          }
          return $url;
    }
}
