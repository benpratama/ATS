<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class FormKandidatController extends Controller
{
    public function ShowForm1($url){
        $date = Carbon::now()->format('Y-m-d');
        $result = DB::table('T_link')
            ->where('url',$url)
            ->where('openlink','<=',$date)
            ->where('closelink','>=',$date)
            ->first();
        if (!$result){
            return abort(404);
        }else{
            $SIM = DB::table('M_SIM')
                    ->select('id','nama')
                    ->where('deleted',0)
                    ->where('active',1)
                    ->get();

            $pernikahan = DB::table('M_Statuspernikahan')
                        ->select('nama','keterangan')
                        ->where('deleted',0)
                        ->where('active',1)
                        ->get();

            $SMA = DB::table('M_SMASederajat')
                        ->select('id','nama')
                        ->where('jenis','SMA')
                        ->where('deleted',0)
                        ->where('active',1)
                        ->get();

            $Sederajat = DB::table('M_SMASederajat')
                        ->select('id','nama')
                        ->where('jenis','Sederajat')
                        ->where('deleted',0)
                        ->where('active',1)
                        ->get();
            $Domisili = DB::table('M_kodepos_Final')
                        ->distinct()
                        ->select('kabupaten')
                        ->where('deleted',0)
                        ->where('active',1)
                        ->get();
            $url = DB::table('T_link')
                        ->select('id','id_Organisasi')
                        ->first();
            
            return view('form kandidat/formkandidat',
                    [   
                        'SIM'=>$SIM,
                        'Pernikahan'=>$pernikahan,
                        'SMA'=>$SMA,
                        'Sederajat'=>$Sederajat,
                        'Domisili' =>$Domisili,
                        'URL' =>$url
                    ]);
        }
    }

    public function SubmitForm1(Request $request){
        dd($request);
        $id_kandidat = DB::table('T_kandidat')
                    ->insertGetId([
                        'id_Organisasi'=>$request->organisasiid,
                        'id_Tlink'=>$request->urlid,
                        'id_Test'=>NULL,
                        'id_MCU'=>NULL,
                        'id_FPTK'=>NULL,
                        'UserInterview'=>NULL,
                        'namaLengkap'=>$request->namalengkap,
                        'alamatKTP'=>$request->alamatlengkap,
                        'kodePos'=>$request->alamatlengkap,
                        'rumahMilik'=>$request->rumahmilik,
                        'alamatKoresponden'=>$request->alamat_koresponden,
                        'kotaKoresponden'=>$request->kota_koresponden,
                        'rumahMilikKoresponden'=>$request->rumahmilik_koresponden,
                        'statusPerkawinan'=>$request->rumahmilik_koresponden,
                        'rumahMilikKoresponden'=>$request->rumahmilik_koresponden,
                    ]);
    }

    public function ShowKodePos(Request $request){
        $kodepos= DB::table('M_kodepos_Final')
                ->select('kodepos')
                ->where('kabupaten',$request->kota)
                ->where('deleted',0)
                ->where('active',1)
                ->get();
        return $kodepos;
    }

    public function GetSIM(){
        $SIM = DB::table('M_SIM')
                    ->select('id','nama')
                    ->where('deleted',0)
                    ->where('active',1)
                    ->get();
        return $SIM;
    }
}
