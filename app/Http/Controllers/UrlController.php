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
        $job = DB::table('T_link')
                ->select('T_link.id_Tjob','M_job.nama',DB::raw('count(id_Tjob) as jumlah'))
                ->join('M_job', 'T_link.id_Tjob', '=', 'M_job.id')
                ->groupBy('T_link.id_Tjob','M_job.nama')
                ->where('T_link.id_Organisasi',Auth::user()->id)
                ->get();
        return $job;
    }
    //buat ambil list seluruh data url
    public function ModalUrl($id){
        $list_url = DB::table('T_link')
                ->where('id_Tjob',$id)
                ->where('deleted',0)
                ->where('id_Organisasi',Auth::user()->id)
                ->get();
        return $list_url;
    }
    //buat ambil data detail 1 
    public function ModalUrl2($id){
        $detail_url = DB::table('T_link')
                    ->where('id',$id)
                    ->where('deleted',0)
                    ->where('id_Organisasi',Auth::user()->id)
                    ->get();
        return $detail_url;
    }
}
