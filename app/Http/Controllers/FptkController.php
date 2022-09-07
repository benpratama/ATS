<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FptkController extends Controller
{
    public function index()
    {
        // dd(Auth::user());
        
        return view('hr/hr_fptk');
    }

    public function TemplateFptk(){
        $file = storage_path('app\public\template').'\FPTK_NAMA_ORGANISASI.xlsx';
        $filenameDownload = 'FPTK_'.Auth::user()->nama.'_'.Auth::user()->id_Organisasi.'.xlsx';

        $success=copy($file, $filenameDownload);
        if(!$success) die();

        // $ss = IOFactory::load($filenameDownload);

        // $data_user = DB::table('M_user')
        //             ->select('nama','NIK','namaManager','id_Organisasi','location')
        //             ->where('id_Organisasi',Auth::user()->id)
        //             ->get();
        // $data_lob = DB::table('M_LobandSub')
        //             ->select ('nama','id_Organisasi')
        //             ->get();
        // $data_job = DB::table('M_job')
        //             ->select('nama','golongan')
        //             ->where('active',1)
        //             ->where('deleted',0)
        //             ->get();

        // $ws1=null;

        // $ws1=$ss->getSheetByName('FPTK FIX');
        // $i=3;
        // foreach($data_user as $row1){
        //     // dd($row1->nama);
        //     $ws1->setCellValue('AN'.$i, $row1->NIK);
        //     $ws1->setCellValue('AO'.$i, $row1->nama);
        //     $ws1->setCellValue('AP'.$i, $row1->namaManager);
        //     $ws1->setCellValue('AQ'.$i, $row1->location);
        //     $ws1->setCellValue('AR'.$i, $row1->id_Organisasi);
        //     $i++;
        // }
        // $j=3;
        // foreach($data_lob as $row1){
        //     // dd($row1->nama);
        //     $ws1->setCellValue('AT'.$j, $row1->nama);
        //     $ws1->setCellValue('AU'.$j, $row1->id_Organisasi);
        //     $j++;
        // }
        // $k=3;
        // foreach($data_job as $row1){
        //     // dd($row1->nama);
        //     $ws1->setCellValue('AW'.$k, $row1->nama);
        //     $ws1->setCellValue('AX'.$k, $row1->golongan);
        //     $k++;
        // }

        // $totalRows=$ws1->getHighestRow();
        // $writer = IOFactory::createWriter($ss, "Xlsx");
        // $writer->save($filenameDownload);
        // $writer->save('php://output');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filenameDownload);
        // $writer->save('php://output');
        readfile($filenameDownload); 
        unlink($filenameDownload);
    }

    public function ImportFptk(Request $request){
        $FPTK = $request->file('upload_FPTK');
        $raw_filename = explode("_",$FPTK->getClientOriginalName()); //buat ambil nama pengupload [1]
        $id_Organisasi = explode(".",$raw_filename[2]);//buat ambil id_Organisasi [0]

        if ($FPTK) {
            $reader = new Xlsx();
            // dd($reader);

            $spreadsheet = $reader->load($FPTK);
            $datas = $spreadsheet->getSheetByName('FPTK FIX')->toArray();

            //row
            for ($i=2; $i <count($datas) ; $i++) { 
                // //kolom
                // $j=0;
                // for ($j=0; $j <14 ; $j++) { 
                //     dd($datas[$i][$j]);
                // }
                $nofptk = $datas[$i][1];
                $tglinput = $datas[$i][2];
                $tgldisetujui= $datas[$i][3];
                $nikpeminta= $datas[$i][4];
                $namapeminta= $datas[$i][5];
                $namaatasanlangusng= $datas[$i][6];
                $posisi= $datas[$i][7];
                $organisasi= $datas[$i][8];
                $penempatan= $datas[$i][9];
                $alasandigantikan= $datas[$i][10];
                $namaygdigantikan= $datas[$i][11];
                $namaSpvDm= $datas[$i][12];
                $pic= $datas[$i][13];

                if(empty($nofptk)&&empty($tglinput)&&empty($tgldisetujui)&&empty($nikpeminta)) {
                    break;
                }else{
                    DB::table('T_fptk')
                        ->insert([
                            'nofptk'=>$nofptk,
                            'tglinputfptk'=>$tglinput,
                            'tgldisetujui'=>$tgldisetujui,
                            'nikpeminta'=>$nikpeminta,
                            'namapeminta'=>$namapeminta,
                            'namaatasanlangusng'=>$namaatasanlangusng,
                            'posisi'=>$posisi,
                            'organisasi'=>$organisasi,
                            'penempatan'=>$penempatan,
                            'alasandigantikan'=>$alasandigantikan,
                            'namaygdigantikan'=>$namaygdigantikan,
                            'namaSpvDm'=>$namaSpvDm,
                            'pic'=>$pic,
                            'id_Organisasi'=> $id_Organisasi[0],
                            'created_at'=> Carbon::now(),
                            'namakarybergabung'=>null,
                            'status'=>null,
                            'leadtime'=>null
                        ]);
                }
            }
           
        } else {
            dd('file tdk ada');
        }
       return Redirect::back();
    }

    public function ShowFptk(){
        $fptk = DB::table('T_FPTK')
            ->select('id','nofptk','tgldisetujui','namapeminta','namaatasanlangusng','posisi','penempatan','status')
            ->where('id_Organisasi',Auth::user()->id_Organisasi)
            ->get();
        return $fptk;
    }

    public function UpdateFptk(Request $request){     
        try {
            DB::beginTransaction();
            DB::table('T_FPTK')
                ->where('id',$request->id_fptk)
                ->update([
                    'nofptk'=>$request->nofptk,
                    'tglinputfptk'=>$request->tgl_inputfptk,
                    'tgldisetujui'=>$request->tgl_disetujui,
                    'nikpeminta'=>$request->nikpeminta,
                    'namapeminta'=>$request->namapeminta,
                    'namaatasanlangusng'=>$request->namaatasanlangusng,
                    'posisi'=>$request->posisi,
                    'organisasi'=>$request->organisasi,
                    'penempatan'=>$request->penempatan,
                    'alasandigantikan'=>$request->alasandigantikan,
                    'namaygdigantikan'=>$request->namaygdigantikan,
                    'namaSpvDm'=>$request->namaSpvDm,
                    'pic'=>$request->pic,
                    'namakarybergabung'=>$request->namakarybergabung,
                    'status'=>$request->status,
                    'leadtime'=>$request->leadtime,
                ]);
            DB::table('T_DFPTK')
                ->where('id_TFPTK',$request->id_fptk)
                ->delete();

            if (!empty($request->id_kandidat)) {
                $list_kandidat = array_unique($request->id_kandidat);
                for ($i=0; $i <count($list_kandidat) ; $i++) { 
                    DB::table('T_DFPTK')
                        ->insert([
                            'id_TFPTK'=>$request->id_fptk,
                            'id_TKandidat'=>$list_kandidat[$i],
                            'tglkonfirm'=>null,
                            'tgljoin'=>null,
                            'tglbatal'=>null,
                            'ket'=>null,
                            'sumber'=>null,
                            'jenis'=>null
                        ]);
                }
                
            }
            
            DB::commit();
            return True;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    // DETAIL FPTK
    public function ShowDetailFptk($id){
        $detail_fptk = DB::table('T_FPTK')
                        ->where('id',$id)
                        ->where('id_Organisasi',Auth::user()->id_Organisasi)
                        ->get();
        $status_fptk = DB::table('M_StatusFPTK')
                        ->where('active',1)
                        ->where('deleted',0)
                        ->get();
        $id_kandidat = DB::table('T_kandidat')
                        ->select('id','namalengkap')
                        ->where('id_Organisasi',Auth::user()->id_Organisasi)
                        ->get();
        // dd($status_fptk);
        return view('hr/hr_detail_fptk',
                    [
                        'detailfptk'=>$detail_fptk,
                        'statusfptk'=>$status_fptk,
                        'idkandidat'=>$id_kandidat
                    ]);
    }

    public function ShowDetailKandidatFptk($id){
        $info_kandidat = DB::table('T_DFPTK')
                        ->where('id_TFPTK',$id)
                        ->get();
        // $arr = [];
        // foreach ($info_kandidat as $key => $value) {
        //     array_push($arr,$value->id_TKandidat);
        // }
        $data_kandidat = DB::table('T_kandidat')
                        ->select('id','noidentitas','namalengkap')
                        ->where('id_Organisasi',Auth::user()->id_Organisasi)
                        ->get();
        return [$info_kandidat,$data_kandidat];
    }

    public function ShowKandidat(){
        $data_kandidat = DB::table('T_kandidat')
                        ->select('id','noidentitas','namalengkap')
                        ->where('id_Organisasi',Auth::user()->id_Organisasi)
                        ->get();
        return $data_kandidat;
    }
}
