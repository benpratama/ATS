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
            
            return view('form kandidat/formkandidat',
                    [   
                        'SIM'=>$SIM,
                        'Pernikahan'=>$pernikahan,
                        'SMA'=>$SMA,
                        'Sederajat'=>$Sederajat
                    ]);
        }
    }

    public function SubmitForm1(Request $request){
        dd($request);
    }
}
