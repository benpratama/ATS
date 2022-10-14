<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestorController extends Controller
{
    //
    public function index(){
        //ini nanti filternya
        return view ('requestor/home_requestor');
    }

    public function indexMPP(){
        //ini nanti filternya
        return view ('requestor/mpp_requestor');
    }

    //FPTK
    public function R_ListFptk(Request $request){
        // return $request;
        $all = 0;
        $id_dept='null';
        $result = DB::table('M_AksesMPP')
                ->select('id_MLobandSub')
                ->where('id_MUser',$request->id_User)
                ->where('active',1)
                ->where('id_MUser',$request->id_User)
                ->pluck('id_MLobandSub')->toArray();
                
        if (count($result)>0) {
           $all=1;
           $id_dept = implode('\',\'',$result);
           $id_dept="('".$id_dept."')";
           
        }
        $list_fptk = DB::select('EXEC SP_Get_ReqFPTK ?,?,?',array($request->nik,$id_dept,$all));
        return $list_fptk;
    }
}
