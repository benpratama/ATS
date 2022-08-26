<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(Auth::user());
        
        return view('home');
    }

    public function ShowSummary(){
        $id_Organisasi = Auth::user()->id_Organisasi;
        $summary =  DB::select('EXEC SP_Get_Summary ?',array(strval($id_Organisasi)));
        return $summary;
    }
    public function ShowDetail(Request $request){
        // $id_Organisasi = Auth::user()->id_Organisasi;
        $id_Organisasi = $request->id_Organisasi;
        $detail =  DB::select('EXEC SP_Get_Detail_Kandidat ?',array(strval($id_Organisasi)));
        return $detail;
    }
}
