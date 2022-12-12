<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class DokumenController extends Controller
{
    //
    public function ETHsurat(Request $request){
        // dd($request);
        if ($request->jenis=='single') {
            $data = DB::table('T_logkandidat')
                ->where('id',$request->id_log)
                ->get();
            
            $detail = json_decode($data[0]->test);
            $id_lab = $detail->id_lab;
            $no_surat = $detail->nosurat;
    
            $info_lab =DB::table('M_Vendor')
                        ->where('id', $id_lab)
                        ->get();
            
            $info_kandidat = DB::table('T_kandidat_N')
                            ->whereIn('id',[$data[0]->id_Tkandidat])
                            ->get();
            $notlp = DB::table('T_kandidat_phone_N')
                    ->whereIn('id_Tkandidat',[$data[0]->id_Tkandidat])
                    ->where('phonePrimary','Y')
                    ->get();
            // dd($notlp);
            $pdf = Pdf::loadView('Surat MCU.eth',
                    [
                        'NO_SURAT'=>$no_surat,
                        'INFO_LAB'=>$info_lab,
                        'INFO_KANDIDAT'=>$info_kandidat,
                        'INFO_TLP'=>$notlp
                    ]);

            $filename = 'FORM MCU '.$info_kandidat[0]->namalengkap.'.pdf';
            return $pdf->download($filename);
        }else{
            // dd('asd');
            $list_id_kandidat = [];
            $data = DB::table('T_logkandidat_group as A')
                ->select('B.id_Tkandidat','test')
                ->join('T_logkandidat as B','A.id_Tlogkandidat','B.id')
                ->where('A.namaGroup',$request->id_log)
                ->get();
            // $detail = json_decode($data[0]->test);

            $detail = json_decode($data[0]->test);
            $id_lab = $detail->id_lab;
            $no_surat = $detail->nosurat;
    
            $info_lab =DB::table('M_Vendor')
                        ->where('id', $id_lab)
                        ->get();
            foreach ($data as $key => $value) {
                array_push($list_id_kandidat,$value->id_Tkandidat);
            }
            
            $info_kandidat = DB::table('T_kandidat_N')
                            ->whereIn('id',$list_id_kandidat )
                            ->get();
            $notlp = DB::table('T_kandidat_phone_N')
                    ->whereIn('id_Tkandidat',$list_id_kandidat )
                    ->where('phonePrimary','Y')
                    ->get();
            // dd($notlp);
            $pdf = Pdf::loadView('Surat MCU.eth',
                    [
                        'NO_SURAT'=>$no_surat,
                        'INFO_LAB'=>$info_lab,
                        'INFO_KANDIDAT'=>$info_kandidat,
                        'INFO_TLP'=>$notlp
                    ]);

            $filename = 'FORM MCU Group '.$request->id_log.'.pdf';
            return $pdf->download($filename);
        }
        
    }
    public function Fimasurat(Request $request){
        return view('Surat MCU.fima');
    }
    public function HJsurat(Request $request){
        return view('Surat MCU.hj');
    }
    public function fkpk(Request $request){
        // dd($request);
        $wk_wdays=$request->wk_wdays;
        $wk_wend=$request->wk_wend;

        $F_kesehatan=$request->F_kesehatan;
        $F_kost=$request->F_kost;
        $F_penempatan=$request->F_penempatan;
        $F_kemahalan=$request->F_kemahalan;

        $F_sewaMotor=$request->F_sewaMotor;
        $F_uangMakan=$request->F_uangMakan;
        $F_transport=$request->F_transport;
        $F_makan=$request->F_makan;

        $percobaan = $request->percobaan;
        $ikatandinas =$request->ikatandinas;

        $negosiator = $request->negosiator;
        $hrd_direktur = $request->hrd_direktur;
        $manager = $request->manager;
        $direktur = $request->direktur;
        $hrd_manager = $request->hrd_manager;

        $id = $request->id_kandidat;
        $data = DB::table('T_kandidat_N')
                ->where('id',$id)
                ->first();
        $homebase = DB::table('T_kandidat_card_N')
                    ->where('id_Tkandidat',$id)
                    ->where('cardType',57)
                    ->first();
        $city = DB::table('PMCity')
                ->where('CityId',$data->tempatlahir)
                ->first();
        
        $pernikahan = DB::table('PMMaritalSt')
                    ->where('MaritalStId',$data->status_perkawinan)
                    ->first();
        $job = DB::table('T_link as A')
                ->select('B.nama','B.golongan')
                ->join('M_Job as B','A.id_Tjob','B.id')
                ->first();
        $detail_FPTK = DB::table('T_DFPTK as A')
                        ->select('B.namaatasanlangusng','B.penempatan','A.tgljoin')
                        ->join('T_FPTK as B','A.id_TFPTK','B.id')
                        ->where('id_Tkandidat',$id)
                        ->first();
        $pdf = Pdf::loadView('form_kpk',
                            [
                                'Data'=>$data,
                                'City'=>$city,
                                'Pernikahan'=>$pernikahan,
                                'Job'=>$job,
                                'Detail_FPTK'=>$detail_FPTK,
                                'WK_D'=>$wk_wdays,
                                'WK_W'=>$wk_wend,
                                'F_kesehatan'=>$F_kesehatan,
                                'F_kost'=>$F_kost,
                                'F_penempatan'=>$F_penempatan,
                                'F_kemahalan'=>$F_kemahalan,
                                'F_sewaMotor'=>$F_sewaMotor,
                                'F_uangMakan'=>$F_uangMakan,
                                'F_transport'=>$F_transport,
                                'F_makan'=>$F_makan,
                                'Percobaan'=>$percobaan,
                                'Ikatandinas'=>$ikatandinas,
                                'Negosiator'=>$negosiator,
                                'hrd_direktur'=>$hrd_direktur,
                                'manager'=>$manager,
                                'direktur'=>$direktur,
                                'hrd_manager'=>$hrd_manager,
                                'homebase'=>$homebase
                            ]);
        $filename = 'fkpk_'.$data->namalengkap.'.pdf';
        // $pdf->save('fpkp'.$filename);
        return $pdf->download($filename);
        // return redirect()->back();


        // return view('form_kpk',
        //                 [
        //                     'Data'=>$data,
        //                     'City'=>$city,
        //                     'Pernikahan'=>$pernikahan,
        //                     'Job'=>$job,
        //                     'Detail_FPTK'=>$detail_FPTK,
        //                     'WK_D'=>$wk_wdays,
        //                     'WK_W'=>$wk_wend,
        //                     'F_kesehatan'=>$F_kesehatan,
        //                     'F_kost'=>$F_kost,
        //                     'F_penempatan'=>$F_penempatan,
        //                     'F_kemahalan'=>$F_kemahalan,
        //                     'F_sewaMotor'=>$F_sewaMotor,
        //                     'F_uangMakan'=>$F_uangMakan,
        //                     'F_transport'=>$F_transport,
        //                     'F_makan'=>$F_makan,
        //                     'Percobaan'=>$percobaan,
        //                     'Ikatandinas'=>$ikatandinas,
        //                     'Negosiator'=>$negosiator,
        //                     'hrd_direktur'=>$hrd_direktur,
        //                     'manager'=>$manager,
        //                     'direktur'=>$direktur,
        //                     'hrd_manager'=>$hrd_manager,
        //                     'homebase'=>$homebase
        //                 ]
        //             );
    }
}
