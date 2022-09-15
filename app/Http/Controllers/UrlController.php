<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
    //
    public function index(){
        return view('hr/hr_url');
    }
    
    public function ShowUrl(){
        // dd(Auth::user());
        // $job = DB::table('T_link')
        //         ->select('T_link.id_Tjob','M_job.nama',DB::raw('count(id_Tjob) as jumlah'))
        //         ->join('M_job', 'T_link.id_Tjob', '=', 'M_job.id')
        //         ->groupBy('T_link.id_Tjob','M_job.nama')
        //         ->where('T_link.id_Organisasi',Auth::user()->id_Organisasi)
        //         ->where('T_link.deleted',0)
        //         ->get();
        $job = DB::select('EXEC SP_Get_ShowUrl ?',array(strval(Auth::user()->id_Organisasi)));
        return $job;
    }

    //buat ambil list seluruh data url
    public function ModalUrl($id){
        $list_url = DB::table('T_link')
                ->where('id_Tjob',$id)
                ->where('deleted',0)
                ->where('id_Organisasi',Auth::user()->id_Organisasi)
                ->get();
        return $list_url;
    }
    //buat ambil data detail 1 
    public function ModalUrl2($id){
        $detail_url = DB::table('T_link')
                    ->where('id',$id)
                    ->where('deleted',0)
                    ->where('id_Organisasi',Auth::user()->id_Organisasi)
                    ->get();
        return $detail_url;
    }

    public function EdiUrl(Request $request){
        DB::table('T_link')
            ->where('id',$request->idurl)
            ->update([
                'noteslink'=>$request->editnote,
                'openlink'=>str_replace('T', ' ', $request->editopenlink),
                'closelink'=>str_replace('T', ' ', $request->editcloselink)
            ]);
        return true;
    }

    public function AddUrl(Request $request){
        $url_=$request->id_job.$request->source.strtok($request->open, 'T').strtok($request->close, 'T');
        $url = base64_encode($url_);
        DB::table('T_link')
            ->insert([
                'id_Tjob'=>$request->id_job,
                'source'=>$request->source,
                'noteslink'=>$request->notes,
                'openlink'=>str_replace('T', ' ',$request->open),
                'closelink'=>str_replace('T', ' ',$request->close),
                'url'=>$url,
                'active'=>'1',
                'deleted'=>'0',
                'id_Organisasi'=>Auth::user()->id_Organisasi
            ]);

        return True;
    }

    public function ActiveUrl(Request $request){
        DB::table('T_link')
            ->where('id',$request->id_Url)
            ->update(['active'=>$request->active]);
        return true;
    }

    public function DelUrl(Request $request){
        $delted =1;
        $active =0;
        for ($i=0; $i <count($request->arrId_url) ; $i++) { 
            DB::table('T_link')
                ->where('id',$request->arrId_url[$i])
                ->update(['deleted'=>$delted,'active'=>$active]);
        }
        return true;
    }
}
