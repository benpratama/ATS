<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
    public function index(){
        $list_pendidikan = DB::table('last_Pendidikan')
                            ->select('pendidikan')
                            ->distinct()
                            ->get();
        $list_jurusan = DB::table('M_SMASederajat')
                        ->select('nama')
                        ->where('active',1)
                        ->where('deleted',0)
                        ->get();
        $list_job = DB::table('M_Job')
                    ->select('id','nama')
                    ->where('active',1)
                    ->where('deleted',0)
                    ->get();
        $list_status = DB::table('M_Rekrutmen')
                        ->select('id','proses')
                        ->where('active',1)
                        ->where('deleted',0)
                        ->get();

        $Domisili = DB::table('M_kodepos_Final')
                        ->distinct()
                        ->select('kabupaten')
                        ->orderBy('kabupaten', 'asc')
                        ->where('deleted',0)
                        ->where('active',1)
                        ->get();
        // dd($list_pendidikan);
        return view('home',['ListPendidikan'=>$list_pendidikan,'ListJurusan'=>$list_jurusan,'ListJob'=>$list_job,'ListStatus'=>$list_status,'Domisili'=>$Domisili]);
    }

    public function ShowSummary(){
        $id_Organisasi = Auth::user()->id_Organisasi;
        $summary =  DB::select('EXEC SP_Get_Summary ?',array(strval($id_Organisasi)));
        return $summary;
    }
    public function ShowDetail(Request $request){

        //filter periode
        if (empty($request->Speriod)) {
           $Speriod = Carbon::now()->subDays(30)->format('Y-m-d');
        }else{
            $Speriod = $request->Speriod;
        }
        if(empty($request->Eperiod)){
            $Eperiod = Carbon::now()->format('Y-m-d');
        }else{
            $Eperiod = $request->Eperiod;
        }

        // filter umur
        if(empty($request->Sumur)){
            $Sumur = 0;
        }else{
            $Sumur = $request->Sumur;
        }
        if(empty($request->Eumur)){
            $Eumur=100;
        }else{
            $Eumur =$request->Eumur;
        }

        //pendidikan
        if(empty($request->pendidikan)){
            $pendidikan="null";
        }else{
            $pendidikan = implode('\',\'',$request->pendidikan);
            $pendidikan="('".$pendidikan."')";
        }

        //jurusan
        if(empty($request->jurusan)){
            $jurusan="null";
        }else{
            $jurusan = implode('\',\'',$request->jurusan);
            $jurusan="('".$jurusan."')";
        }

        //job
        if(empty($request->job)){
            $job="null";
        }else{
            $job = implode('\',\'',$request->job);
            $job="('".$job."')";
        }

        //Status
        if(empty($request->status)){
            $status="null";
        }else{
            $status = implode('\',\'',$request->status);
            $status="('".$status."')";
        }

        //Domisili
        if(empty($request->domisili)){
            $domisili="null";
        }else{
            $domisili = implode('\',\'',$request->domisili);
            $domisili="('".$domisili."')";
        }
       
        // return $request;
        $id_Organisasi = Auth::user()->id_Organisasi;
        // $detail =  DB::select('EXEC SP_Get_Detail_Kandidat ?',array(strval($id_Organisasi)));

        // $id_Organisasi = $request->id_Organisasi;
        $detail =  DB::select('EXEC SP_Get_Detail_Kandidat ?,?,?,?,?,?,?,?,?,?',
                    array(
                        strval($id_Organisasi),
                        strval($Speriod),
                        strval($Eperiod),
                        $Sumur,$Eumur,
                        strval($pendidikan),
                        strval($jurusan),
                        strval($job),
                        strval($status),
                        strval($domisili)
                        ));
        return $detail;
    }
    public function GetName(){
        $name = Auth::user()->nama;
        return $name;
    }
}
