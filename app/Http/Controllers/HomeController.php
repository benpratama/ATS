<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables as DataTablesDataTables;

class HomeController extends Controller
{
    public $date=365;
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
        // schedule
        $list_cc = DB::table('M_User')
                    ->select('nama','email')
                    ->where('id_Organisasi',session()->get('user')['organisasi'])
                    ->get();
        $list_proses = DB::table('M_Rekrutmen')
                    ->select('id','proses')
                    ->where('active',1)
                    ->where('deleted',0)
                    ->whereNotIn('id', [1,7,8])
                    ->get();
        
        $list_mcu = DB::table('M_Vendor')
                    ->select('id','namaLab')
                    ->where('Jenis','MCU')
                    ->where('active',1)
                    ->where('deleted',0)
                    ->get();
        $list_organisasi = DB::table('M_Organisasi')
                            ->where('id','<>',Auth::user()->id_Organisasi)
                            ->get();
        return view('home',['ListPendidikan'=>$list_pendidikan,'ListJurusan'=>$list_jurusan,'ListJob'=>$list_job,'ListStatus'=>$list_status,'Domisili'=>$Domisili,'list_proses'=>$list_proses,
        'list_cc'=>$list_cc,'list_mcu'=>$list_mcu,'list_organisasi'=>$list_organisasi]);
    }

    public function ShowSummary(Request $request){
        //filter periode
        if (empty($request->Speriod)) {
            //Ubah dari 365 ->90
            $Speriod = Carbon::now()->subDays($this->date)->format('Y-m-d');
         }else{
             $Speriod = $request->Speriod;
         }
         if(empty($request->Eperiod)){
             $Eperiod = Carbon::now()->format('Y-m-d');
         }else{
             $Eperiod = $request->Eperiod;
         }

        // return [ $Speriod,$Eperiod];
        $id_Organisasi = Auth::user()->id_Organisasi;
        $summary =  DB::select('EXEC SP_Get_Summary ?,?,?',array(strval($id_Organisasi),strval($Speriod),strval($Eperiod. " 23:59:00.000")));

        return $summary;
    }   
    
    public function ShowDetail(Request $request){

        //filter periode
        if (empty($request->Speriod)) {
            //Ubah dari 365 ->90
           $Speriod = Carbon::now()->subDays($this->date)->format('Y-m-d');
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

        $id_Organisasi = Auth::user()->id_Organisasi;
        // $detail =  DB::select('EXEC SP_Get_Detail_Kandidat ?',array(strval($id_Organisasi)));

        // $id_Organisasi = $request->id_Organisasi;
        $detail =  DB::select('EXEC SP_Get_Detail_Kandidat ?,?,?,?,?,?,?,?,?,?',
                    array(
                        strval($id_Organisasi),
                        strval($Speriod),
                        strval($Eperiod.' 23:59'),
                        $Sumur,$Eumur,
                        strval($pendidikan),
                        strval($jurusan),
                        strval($job),
                        strval($status),
                        strval($domisili)
                        ));
        return DataTablesDataTables::of($detail)->make(true);
    }

    public function GetName(){
        $name = Auth::user()->nama;
        return $name;
    }

    public function TransferKandidat(Request $request){
        $array1=[];
        $array2=array();
        foreach ($request->arrId_kandidat as $key => $value) {

            $cek = DB::table('T_DFPTK')
                    ->join('T_FPTK','T_DFPTK.id_TFPTK','T_FPTK.id')
                    ->where('id_TKandidat',$value)
                    ->pluck('nofptk');
            $info_kandidat = DB::table('T_kandidat')
                            ->where('id', $value)
                            ->pluck('namalengkap');
            // return count($cek);
            if (count($cek)<1) {
                DB::table('T_kandidat')
                ->where('id',$value)
                ->update([
                    'id_Organisasi'=>$request->id_Organisasi
                ]);
            }else{
                
                foreach ($cek as $key => $value) {
                    $array2['nofptk']=$value;
                    $array2['namalengkap']=$info_kandidat[0];
                    array_push($array1,$array2);
                }
                
            }
        }
        return $array1;
    }
}
