<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function Index(){
        $list_user = DB::table('M_User')
                    ->select('id','nama','id_Organisasi')
                    ->where('id_Organisasi',Auth::user()->id_Organisasi)
                    ->get();
        $list_lob = DB::table('M_LobandSub')
                    ->select('id','nama')
                    ->where('id_Organisasi',Auth::user()->id_Organisasi)
                    ->get();
        return view('hr/hr_menu',['listUser'=>$list_user,'listLOB'=>$list_lob]);
    }

    public function getMPP(){
        $listAkses = DB::table('M_AksesMPP as A')
                    ->select('A.id','B.nama','B.title','C.nama as department','D.nama as akses','A.active')
                    ->leftJoin('M_User as B','A.id_MUser','B.id')
                    ->leftJoin('M_LobandSub as C','B.id_Dept','C.id')
                    ->leftJoin('M_LobandSub as D','A.id_MLobandSub','D.id')
                    ->get();
        return $listAkses;
    }

    public function ActiveAkses(Request $request){
        DB::table('M_AksesMPP')
            ->where('id',$request->id_akses)
            ->update(['active'=>$request->active]);
        return true;
    }

    public function DelAkses(Request $request){
        for ($i=0; $i <count($request->arrId_akses) ; $i++) { 
            DB::table('M_AksesMPP')
                ->where('id',$request->arrId_akses[$i])
                ->delete();
        }
        return true;
    }   

    public function AddAkses(Request $request){
        $listaksesLob = $request->id_lob;
        $id_user = $request->id_user;
        $id_Organisasi = $request->id_organisasi;

        for ($i=0; $i <count($listaksesLob) ; $i++) { 
            $result = DB::table('M_AksesMPP')
                    ->where('id_MUser',$id_user)
                    ->where('id_MOrganisasi',$id_Organisasi)
                    ->where('id_MLobandSub',$listaksesLob[$i])
                    ->count();
            if ($result<1) {
                DB::table('M_AksesMPP')
                    ->insert([
                        'id_MUser'=>$id_user,
                        'id_MOrganisasi'=>$id_Organisasi,
                        'id_MLobandSub'=>$listaksesLob[$i],
                        'active'=>1
                    ]);
            }
        }
        return true;
    }
    public function registWA(Request $request){
        return view('hr/hr_wa');
    }
}
