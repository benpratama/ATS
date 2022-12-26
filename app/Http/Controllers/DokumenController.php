<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DokumenController extends Controller
{
    //
    public function ETHsurat(Request $request){
        // dd($request);
        if ($request->jenis=='single') {
            $data = DB::table('T_logkandidat')
                ->where('id',$request->id_log)
                ->get();
            $list_id_phone=[];
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
            foreach ($notlp as $key => $value) {
                array_push($list_id_phone,$value->id_Tkandidat);
            }
            // dd($notlp);
            $pdf = Pdf::loadView('Surat MCU.eth',
                    [
                        'NO_SURAT'=>$no_surat,
                        'INFO_LAB'=>$info_lab,
                        'INFO_KANDIDAT'=>$info_kandidat,
                        'INFO_TLP'=>$notlp,
                        'List_id_P'=>$list_id_phone
                    ]);

            $filename = 'FORM MCU '.$info_kandidat[0]->namalengkap.'.pdf';
            return $pdf->download($filename);
        }else{
            // dd('asd');
            $list_id_kandidat = [];
            $list_id_phone=[];
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
            foreach ($notlp as $key => $value) {
                array_push($list_id_phone,$value->id_Tkandidat);
            }
            $pdf = Pdf::loadView('Surat MCU.eth',
                    [
                        'NO_SURAT'=>$no_surat,
                        'INFO_LAB'=>$info_lab,
                        'INFO_KANDIDAT'=>$info_kandidat,
                        'INFO_TLP'=>$notlp,
                        'List_id_P'=>$list_id_phone
                    ]);

            $filename = 'FORM MCU Group '.$request->id_log.'.pdf';
            return $pdf->download($filename);
        }
        
    }
    public function Fimasurat(Request $request){
        // dd($request);
        // dd($request);
        if ($request->jenis=='single') {
            $data = DB::table('T_logkandidat')
                ->where('id',$request->id_log)
                ->get();
            $list_id_phone=[];
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
            foreach ($notlp as $key => $value) {
                array_push($list_id_phone,$value->id_Tkandidat);
            }
            // dd($notlp);
            $pdf = Pdf::loadView('Surat MCU.fima',
                    [
                        'NO_SURAT'=>$no_surat,
                        'INFO_LAB'=>$info_lab,
                        'INFO_KANDIDAT'=>$info_kandidat,
                        'INFO_TLP'=>$notlp,
                        'List_id_P'=>$list_id_phone
                    ]);

            $filename = 'FORM MCU '.$info_kandidat[0]->namalengkap.'.pdf';
            return $pdf->download($filename);
        }else{
            // dd('asd');
            $list_id_kandidat = [];
            $list_id_phone=[];
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
            foreach ($notlp as $key => $value) {
                array_push($list_id_phone,$value->id_Tkandidat);
            }
            $pdf = Pdf::loadView('Surat MCU.fima',
                    [
                        'NO_SURAT'=>$no_surat,
                        'INFO_LAB'=>$info_lab,
                        'INFO_KANDIDAT'=>$info_kandidat,
                        'INFO_TLP'=>$notlp,
                        'List_id_P'=>$list_id_phone
                    ]);

            $filename = 'FORM MCU Group '.$request->id_log.'.pdf';
            return $pdf->download($filename);
        }
        // return view('Surat MCU.fima');
    }
    public function HJsurat(Request $request){
        if ($request->jenis=='single') {
            $data = DB::table('T_logkandidat')
                ->where('id',$request->id_log)
                ->get();
            $detail = json_decode($data[0]->test);
            $id_lab = $detail->id_lab;
            $no_surat = $detail->nosurat;
    
            $info_lab =DB::table('M_Vendor as A')
                        ->select('A.NamaLab','A.alamat','B.noTlp','B.email')
                        ->join('M_DVendor as B','A.id','B.id_Vendor')
                        ->where('A.id', $id_lab)
                        ->Where('B.noTlp','<>','')
                        ->Where('B.email','<>','')
                        ->limit(1)
                        ->get();

            $info_kandidat = DB::select('EXEC SP_Get_kandidatMCU_HJ  ?',array($data[0]->id_Tkandidat));
            $pdf = Pdf::loadView('Surat MCU.hj',
                    [
                        'TGL'=>Carbon::now()->format('Y-m-d'),
                        'Data'=>$data,
                        'NO_SURAT'=>$no_surat,
                        'INFO_LAB'=>$info_lab,
                        'INFO_KANDIDAT'=>$info_kandidat
                    ]);

            $filename = 'FORM MCU '.$info_kandidat[0]->namalengkap.'.pdf';
            return $pdf->download($filename);
            // return $pdf->stream();
        }else{
            $list_id_kandidat = [];

            $data = DB::table('T_logkandidat_group as A')
                ->select('B.id_Tkandidat','test','B.jadwal')
                ->join('T_logkandidat as B','A.id_Tlogkandidat','B.id')
                ->where('A.namaGroup',$request->id_log)
                ->get();
            

            $detail = json_decode($data[0]->test);
            $id_lab = $detail->id_lab;
            $no_surat = $detail->nosurat;

            foreach ($data as $key => $value) {
                array_push($list_id_kandidat,$value->id_Tkandidat);
            }
            $list = implode(",",$list_id_kandidat);
            
            $info_lab =DB::table('M_Vendor as A')
            ->select('A.NamaLab','A.alamat','B.noTlp','B.email')
            ->leftjoin('M_DVendor as B','A.id','B.id_Vendor')
            ->where('A.id', $id_lab)
            ->Where('B.noTlp','<>','')
            ->Where('B.email','<>','')
            ->limit(1)
            ->get();
            $info_kandidat = DB::select('EXEC SP_Get_kandidatMCU_HJ  ?',array($list));
            $pdf = Pdf::loadView('Surat MCU.hj',
                    [
                        'TGL'=>Carbon::now()->format('Y-m-d'),
                        'Data'=>$data,
                        'NO_SURAT'=>$no_surat,
                        'INFO_LAB'=>$info_lab,
                        'INFO_KANDIDAT'=>$info_kandidat
                    ]);
            $filename = 'FORM MCU Group '.$request->id_log.'.pdf';
            return $pdf->download($filename);
        }
        // return view('Surat MCU.hj');
    }
    public function fkpk(Request $request){
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

        $state = DB::table('PMState')
                ->select('StateId','StateName')
                // ->where('CountryId',115)
                ->where('StateId',$data->tempatlahir)
                ->get();

        // $city = DB::table('PMCity')
        //         ->where('CityId',$data->tempatlahir)
        //         ->first();
        
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
                                'State'=>$state,
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
        //                     'State'=>$state,
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
    public function solutiva(Request $request){
        // dd($request);
        $Organisasi=$request->org_PicGen;
        $PIC = $request->nama_PicGen;
        $namaOrg = DB::table('M_Organisasi')
                    ->where('id',$Organisasi)
                    ->get();
        if ($request->jenis_p=='single') {
            
            $data = DB::table('T_logkandidat')
                ->where('id',$request->id_log_p)
                ->get();
            // $detail = json_decode($data[0]->test);
            // $id_lab = $detail->id_lab;
            // $no_surat = $detail->nosurat;
    
            // $info_lab =DB::table('M_Vendor')
            //             ->where('id', $id_lab)
            //             ->get();
            
            $info_kandidat = DB::table('T_kandidat_N as A')
                            ->select('A.namalengkap','B.phoneNumber','A.id_Tlink','D.nama')
                            ->leftjoin('T_link as C','A.id_Tlink','C.id')
                            ->leftJoin('M_Job as D','C.id_Tjob','D.id')
                            ->leftjoin('T_kandidat_phone_N as B','A.id','B.id_Tkandidat')
                            ->where('B.phonePrimary','Y')
                            ->whereIn('A.id',[$data[0]->id_Tkandidat])
                            ->get();
            // foreach ($info_kandidat as $key => $value) {
            //     array_push($list_link,$value->id_Tlink);
            // }
            // $info_job = DB::table('T_link as A')
            //             ->select('A.id','B.nama')
            //             ->leftJoin('M_Job as B','A.id_Tjob','B.id')
            //             ->whereIn('A.id',$list_link)
            //             ->get();
            // dd($info_kandidat,$info_job,$PIC,$namaOrg,$data[0]);
            $pdf = Pdf::loadView('Surat Psikotes.solutiva',
                    [
                        'Data'=>$data[0],
                        'INFO_KANDIDAT'=>$info_kandidat,
                        'INFO_Organisasi'=>$namaOrg,
                        'PIC'=>$PIC
                    ]);
            // return $pdf->stream();
            $filename = 'FORM PSIKOLOG '.$info_kandidat[0]->namalengkap.'.pdf';
            return $pdf->download($filename);
        }else{

            $list_id_kandidat = [];
            $data = DB::table('T_logkandidat_group as A')
                ->select('B.id_Tkandidat','test')
                ->join('T_logkandidat as B','A.id_Tlogkandidat','B.id')
                ->where('A.namaGroup',$request->id_log_p)
                ->get();
            foreach ($data as $key => $value) {
                array_push($list_id_kandidat,$value->id_Tkandidat);
            }
            $info_kandidat = DB::table('T_kandidat_N as A')
                            ->select('A.namalengkap','B.phoneNumber','A.id_Tlink','D.nama')
                            ->leftjoin('T_link as C','A.id_Tlink','C.id')
                            ->leftJoin('M_Job as D','C.id_Tjob','D.id')
                            ->leftjoin('T_kandidat_phone_N as B','A.id','B.id_Tkandidat')
                            ->where('B.phonePrimary','Y')
                            ->whereIn('A.id',$list_id_kandidat)
                            ->get();
            $data = DB::table('T_logkandidat')
                    ->where('id',$list_id_kandidat[0])
                    ->get();
            $pdf = Pdf::loadView('Surat Psikotes.solutiva',
                    [
                        'Data'=>$data[0],
                        'INFO_KANDIDAT'=>$info_kandidat,
                        'INFO_Organisasi'=>$namaOrg,
                        'PIC'=>$PIC
                    ]);
                    // return $pdf->stream();
            $filename = 'FORM PSIKOLOG '.$request->id_log_p.'.pdf';
            return $pdf->download($filename);
        }


        // $pdf = Pdf::loadView('Surat Psikotes.solutiva');
        // $filename = 'test.pdf';
        // return $pdf->download($filename);
        // return view ('Surat Psikotes.solutiva');
    }
    public function firstasia(Request $request){
        $namaOrganisasi = DB::table('M_Organisasi')
                        ->where('id',$request->org_PicGen)
                        ->get();
        $infoPIC = session()->get('user');
        $infoPIC2 = DB::table('M_User')
                ->where('id',$infoPIC['id'])
                ->get();
        if ($request->jenis_p=='single') {
            $infoLog = DB::table('T_logkandidat')
                    ->where('id',$request->id_log_p)
                    ->get();
            $infokandidat = DB::table('T_kandidat_N as A')
                        ->select('A.namalengkap','B.email','C.phoneNumber','E.nama')
                        ->leftJoin('T_link as D','A.id_Tlink','D.id')
                        ->leftJoin('M_job as E','D.id_Tjob','E.id')
                        ->leftjoin('T_kandidat_email_N as B','A.id','B.id_Tkandidat')
                        ->leftJoin('T_kandidat_phone_N as C','A.id','C.id_Tkandidat')
                        ->where('A.id',$infoLog[0]->id_Tkandidat)
                        ->where('B.emailPrimary','Y')
                        ->where('C.phonePrimary','Y')
                        ->get();
            // $posisi = DB::table('T_link as a')
            //         ->select('b.nama')
            //         ->leftJoin('M_job as b','a.id_Tjob','b.id')
            //         ->where('a.id',$infokandidat[0]->id_Tlink)
            //         ->get();

            $file = storage_path('app\public\template').'\05c. First Asia Consultants (2022) - (NAMAPAKET) JUMLAH - NAMAORGANISASI.xlsx';
            $filenameDownload = '05c. First Asia Consultants (2022) - (NAMAPAKET) 1 -  '.$namaOrganisasi[0]->nama.'.xlsx';

            $success=copy($file, $filenameDownload);
            if(!$success) die();

            $ss = IOFactory::load($filenameDownload);

            $ws1=null;

            $ws1=$ss->getSheetByName('Purchase Order (Bahasa)');
            $ws1->setCellValue('C3',Carbon::now()->format('Y-m-d'));
            $ws1->setCellValue('C4',$namaOrganisasi[0]->nama);
            $ws1->setCellValue('C5',explode(" ",$infoLog[0]->jadwal)[0]);
            $ws1->setCellValue('B10',$infokandidat[0]->namalengkap);
            $ws1->setCellValue('C10',trim($infokandidat[0]->phoneNumber).'/'.$infokandidat[0]->email);
            $ws1->setCellValue('D10',$infokandidat[0]->nama);


            $ws1->setCellValue('C30',$infoPIC['nama']);
            $ws1->setCellValue('C31',$infoPIC2[0]->email);
            $ws1->setCellValue('C32',$infoPIC2[0]->title);
            $ws1->setCellValue('C33',$namaOrganisasi[0]->nama);
            $ws1->setCellValue('G47',$infoPIC['nama']);
            $ws1->setCellValue('G48',$infoPIC2[0]->title);

            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename='.$filenameDownload);
            $writer = IOFactory::createWriter($ss, "Xlsx");
            $writer->save('php://output');

            // readfile($filenameDownload);
            unlink($filenameDownload);
        } else {
            // dd($request);
            $list_id_kandidat = [];
            $data = DB::table('T_logkandidat_group as A')
                ->select('B.id_Tkandidat','test','B.id')
                ->join('T_logkandidat as B','A.id_Tlogkandidat','B.id')
                ->where('A.namaGroup',$request->id_log_p)
                ->get();
            foreach ($data as $key => $value) {
                array_push($list_id_kandidat,$value->id_Tkandidat);
            }
            $infoLog = DB::table('T_logkandidat')
                    ->where('id',$data[0]->id)
                    ->get();
            $infokandidat = DB::table('T_kandidat_N as A')
                        ->select('A.namalengkap','B.email','C.phoneNumber','E.nama')
                        ->leftJoin('T_link as D','A.id_Tlink','D.id')
                        ->leftJoin('M_job as E','D.id_Tjob','E.id')
                        ->leftjoin('T_kandidat_email_N as B','A.id','B.id_Tkandidat')
                        ->leftJoin('T_kandidat_phone_N as C','A.id','C.id_Tkandidat')
                        ->whereIn('A.id',$list_id_kandidat)
                        ->where('B.emailPrimary','Y')
                        ->where('C.phonePrimary','Y')
                        ->get();

            $file = storage_path('app\public\template').'\05c. First Asia Consultants (2022) - (NAMAPAKET) JUMLAH - NAMAORGANISASI.xlsx';
            $filenameDownload = '05c. First Asia Consultants (2022) - (NAMAPAKET) '.count($list_id_kandidat).' - '.$namaOrganisasi[0]->nama.' Group '.$request->id_log_p.'.xlsx';

            $success=copy($file, $filenameDownload);
            if(!$success) die();

            $ss = IOFactory::load($filenameDownload);

            $ws1=null;

            $ws1=$ss->getSheetByName('Purchase Order (Bahasa)');
            $ws1->setCellValue('C3',Carbon::now()->format('Y-m-d'));
            $ws1->setCellValue('C4',$namaOrganisasi[0]->nama);
            $ws1->setCellValue('C5',explode(" ",$infoLog[0]->jadwal)[0]);

            $rw_data = 9;
            $add_row = 11;
            $no =0;
            foreach ($infokandidat as $key => $value) {
                $rw_data++;
                $no++;
                $ws1->setCellValue('A'.$rw_data,$no);
                $ws1->setCellValue('B'.$rw_data,$value->namalengkap);
                $ws1->setCellValue('C'.$rw_data,trim($value->phoneNumber).'/'.$infokandidat[0]->email);
                $ws1->setCellValue('D'.$rw_data,$value->nama);
                $ws1->insertNewRowBefore($add_row++);
            }
            $ws1->setCellValue('C'.$add_row+=19,$infoPIC['nama']);
            $ws1->setCellValue('C'.$add_row+=1,$infoPIC2[0]->email);
            $ws1->setCellValue('C'.$add_row+=1,$infoPIC2[0]->title);
            $ws1->setCellValue('C'.$add_row+=1,$namaOrganisasi[0]->nama);
            $ws1->setCellValue('G'.$add_row+=14,$infoPIC['nama']);
            $ws1->setCellValue('G'.$add_row+=1,$infoPIC2[0]->title);

            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename='.$filenameDownload);
            $writer = IOFactory::createWriter($ss, "Xlsx");
            $writer->save('php://output');

            // readfile($filenameDownload);
            unlink($filenameDownload);
        }
    }
}
