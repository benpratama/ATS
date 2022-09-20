<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
// use Facade\FlareClient\Http\Response;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use League\CommonMark\Extension\Table\Table;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;

class FptkController extends Controller
{
    public function index(){
        // $start = Carbon::now()->startOfMonth()->toDateString();
        // $end = Carbon::now()->endOfMonth()->toDateString();
        // dd($start, $end);
        // dd(Auth::user());
        $filter_nofptk= DB::table('T_FPTK')
                ->select('nofptk')
                ->distinct()
                ->where('id_Organisasi',Auth::user()->id_Organisasi)
                ->get();
        
        $filter_npeminta= DB::table('T_FPTK')
                ->select('namapeminta')
                ->distinct()
                ->where('id_Organisasi',Auth::user()->id_Organisasi)
                ->get();
        
        $filter_natasan= DB::table('T_FPTK')
                ->select('namaatasanlangusng')
                ->distinct()
                ->where('id_Organisasi',Auth::user()->id_Organisasi)
                ->get();
        
        $filter_posisi= DB::table('T_FPTK')
                ->select('posisi')
                ->distinct()
                ->where('id_Organisasi',Auth::user()->id_Organisasi)
                ->get();
        
        $filter_lokasi= DB::table('T_FPTK')
                ->select('penempatan')
                ->distinct()
                ->where('id_Organisasi',Auth::user()->id_Organisasi)
                ->get();
        
        $filter_status= DB::table('M_StatusFPTK')
                ->select('id','keterangan')
                ->where('active',1)
                ->where('deleted',0)
                ->get();
        // dd($filter_posisi);
        return view(
            'hr/hr_fptk',
            [
                'nofptks'=>$filter_nofptk,
                'namapemintas'=>$filter_npeminta,
                'namaatasans'=>$filter_natasan,
                'posisis'=>$filter_posisi,
                'lokasis'=>$filter_lokasi,
                'statuss'=>$filter_status
            ]);
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
        

        if ($FPTK) {
            $raw_filename = explode("_",$FPTK->getClientOriginalName()); //buat ambil nama pengupload [1]
            $id_Organisasi = explode(".",$raw_filename[2]);//buat ambil id_Organisasi [0]

            $reader = new Xlsx();
            // dd($reader);

            $spreadsheet = $reader->load($FPTK);
            $datas = $spreadsheet->getSheetByName('FPTK FIX')->toArray();

            //row
            //nanti ubahnya disini jadi 3
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
                $lobandsub= $datas[$i][8];
                $penempatan= $datas[$i][9];
                $alasandigantikan= $datas[$i][10];
                $namaygdigantikan= $datas[$i][11];
                $namaSpvDm= $datas[$i][12];
                $pic= $datas[$i][13];

                $result_golongan = DB::table('M_Job')
                                ->where('nama',$posisi)
                                ->where('active',1)
                                ->where('deleted',0)
                                ->first();
                // dd($result_golongan->golongan);
                if (empty($result_golongan)) {
                    // dd('golongan gak ada');
                    $golongan=null;
                }else{
                    // dd('golongan ada');
                    $golongan = $result_golongan->golongan;
                }

                $result_lobandsub = DB::table('M_LobandSub')
                                    ->where('nama',$lobandsub)
                                    ->where('id_Organisasi',$id_Organisasi[0])
                                    ->first();
                // dd($result_lobandsub->id);
                if (empty($result_lobandsub)) {
                    // dd('golongan gak ada');
                    $id_lob=null;
                }else{
                    // dd('golongan ada');
                    $id_lob = $result_lobandsub->id;
                }


                if(empty($nofptk)&&empty($tglinput)&&empty($tgldisetujui)&&empty($nikpeminta)) {
                    break;
                }else{
                    // $cek = DB::table('T_fptk')
                    //     ->where('nofptk',$nofptk)
                    //     // ->get();
                    //     ->count();
                    // if($cek>=1){
                    //     continue;
                    // }else{
                        DB::table('T_fptk')
                        ->insert([ 
                            'nofptk'=>$nofptk,
                            'tglinputfptk'=>$tglinput,
                            'tgldisetujui'=>$tgldisetujui,
                            'nikpeminta'=>$nikpeminta,
                            'namapeminta'=>$namapeminta,
                            'namaatasanlangusng'=>$namaatasanlangusng,
                            'posisi'=>$posisi,
                            'golongan'=>$golongan,
                            'lobandsub'=>$lobandsub,
                            'id_Tlobandsub'=>$id_lob,
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
                    // }
                }
            }
           
        } else {
            return Redirect::back();
        }
       return Redirect::back();
    }

    public function ShowFptk(Request $request){
        $startdate =Carbon::now()->startOfMonth()->toDateString();
        $enddate = Carbon::now()->endOfMonth()->toDateString();

        $fptk = DB::table('T_FPTK')
            ->select('T_FPTK.id','nofptk','tgldisetujui','namapeminta','namaatasanlangusng','posisi','penempatan','M_StatusFPTK.keterangan')
            ->leftjoin('M_StatusFPTK','M_StatusFPTK.id','T_FPTK.status')
            ->where('id_Organisasi',Auth::user()->id_Organisasi);

            if(!empty($request->filter_Speriod)){
                $fptk->where('tglinputfptk','>=',$request->filter_Speriod);
            }elseif(empty($request->filter_Speriod)&&empty($request->nofptk)&&
                    empty($request->namapeminta)&&empty($request->namaatasan)&&
                    empty($request->posisi)&&empty($request->lokasi)&&empty($request->status)
            ){
                $fptk->where('tglinputfptk','>=',$startdate);
            }

            if(!empty($request->filter_Eperiod)){
                $fptk->where('tglinputfptk','<=',$request->filter_Eperiod);
            }elseif(empty($request->filter_Eperiod)&&empty($request->nofptk)&&
                    empty($request->namapeminta)&&empty($request->namaatasan)&&
                    empty($request->posisi)&&empty($request->lokasi)&&empty($request->status)
            ){
                $fptk->where('tglinputfptk','<=',$enddate);
            }

            if(!empty($request->nofptk)){
                $fptk->whereIn('nofptk',$request->nofptk);
            }
            if(!empty($request->namapeminta)){
                $fptk->whereIn('namapeminta',$request->namapeminta);
            }
            if(!empty($request->namaatasan)){
                $fptk->whereIn('namaatasanlangusng',$request->namaatasan);
            }
            if(!empty($request->posisi)){
                $fptk->whereIn('posisi',$request->posisi);
            }
            if(!empty($request->lokasi)){
                $fptk->whereIn('penempatan',$request->lokasi);
            }
            if(!empty($request->status)){
                $fptk->whereIn('status',$request->status);
            }
        $result=$fptk->get();
        return $result;
    }

    public function UpdateFptk(Request $request){
        // return $request;
        try {
            DB::beginTransaction();

            $result_golongan = DB::table('M_Job')
                                ->where('nama',$request->posisi)
                                ->where('active',1)
                                ->where('deleted',0)
                                ->first();
            // dd($result_golongan->golongan);
            if (empty($result_golongan)) {
                // dd('golongan gak ada');
                $golongan=null;
            }else{
                // dd('golongan ada');
                $golongan = $result_golongan->golongan;
            }

            $result_lobandsub = DB::table('M_LobandSub')
                                    ->where('nama',$request->lobandsub)
                                    ->where('id_Organisasi',Auth::user()->id_Organisasi)
                                    ->first();
            // dd($result_lobandsub->id);
            if (empty($result_lobandsub)) {
                // dd('golongan gak ada');
                $id_lob=null;
            }else{
                // dd('golongan ada');
                $id_lob = $result_lobandsub->id;
            }
        
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
                    'golongan'=>$golongan,
                    'lobandsub'=>$request->lobandsub,
                    'id_Tlobandsub'=>$id_lob,
                    'penempatan'=>$request->penempatan,
                    'alasandigantikan'=>$request->alasandigantikan,
                    'namaygdigantikan'=>$request->namaygdigantikan,
                    'namaSpvDm'=>$request->namaSpvDm,
                    'pic'=>$request->pic,
                    'namakarybergabung'=>$request->namakarybergabung,
                    'status'=>$request->status,
                    'leadtime'=>0,
                ]);
            DB::table('T_DFPTK')
                ->where('id_TFPTK',$request->id_fptk)
                ->delete();

            if (!empty($request->id_kandidat)) {
                $list_kandidat = array_unique($request->id_kandidat);
                for ($i=0; $i <count($list_kandidat) ; $i++) {
                    
                    $source = DB::table('T_kandidat')
                            ->join('T_link','T_link.id','T_kandidat.id_Tlink')
                            ->where('T_kandidat.id',$list_kandidat[$i])
                            ->select('T_link.source')
                            ->get();

                    DB::table('T_DFPTK')
                        ->insert([
                            'id_TFPTK'=>$request->id_fptk,
                            'id_TKandidat'=>$list_kandidat[$i],
                            'tglkonfirm'=>$request->tgl_konfirm[$i],
                            'tgljoin'=>$request->tgl_join[$i],
                            'tglbatal'=>$request->tgl_batal[$i],
                            'ket'=>null,
                            'sumber'=>$source[0]->source,
                            'jenis'=>null
                        ]);
                }
                
            }
        //// Start LEAD TIME
            $result  = DB::table('T_DFPTK')
            ->where('id_TFPTK',$request->id_fptk)
            ->select('tglkonfirm')
            ->first();
            if(!empty($request->tgl_disetujui)&&!empty($result->tglkonfirm)){
                $dt = Carbon::parse($request->tgl_disetujui);
                $dt2 = Carbon::parse($result->tglkonfirm);
                $workdays = $dt->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                }, $dt2);
                $holiday  = DB::select('EXEC SP_Get_Holiday ?,?',array($request->tgl_disetujui,$result->tglkonfirm));
                $leadtime = $workdays-$holiday[0]->jml_hari+1;
            }else{
                $leadtime = 0;
            }
            DB::table('T_FPTK')
                ->where('id',$request->id_fptk)
                ->update([
                    'leadtime'=>$leadtime 
                ]);
        //// End LEAD TIME

            DB::commit();
            return True;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function ExportDataFptk($F_start,$F_end){
        if ($F_start=="NULL") {
            $F_start = Carbon::now()->startOfMonth()->toDateString();
        }else{
            $F_start = $F_start;
        }
        if ($F_end=="NULL") {
            $F_end = Carbon::now()->endOfMonth()->toDateString();
        }else{
            $F_end =$F_end;
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');


        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="test.xlsx"');

        $writer = IOFactory::createWriter($spreadsheet,'Xlsx');
        $writer->save('php://output');
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
        $list_job = DB::table('M_Job')
                    ->where('active',1)
                    ->where('deleted',0)
                    ->get();
        $list_lob= DB::table('M_LobandSub')
                    ->where('id_Organisasi',Auth::user()->id_Organisasi)
                    ->get();

        return view('hr/hr_detail_fptk',
                    [
                        'detailfptk'=>$detail_fptk,
                        'statusfptk'=>$status_fptk,
                        'idkandidat'=>$id_kandidat,
                        'listjob'=>$list_job,
                        'listlob'=>$list_lob
                    ]);
    }

    //$id->id fptk
    public function ShowDetailKandidatFptk($id){
        $info_kandidat = DB::table('T_DFPTK')
                        ->where('id_TFPTK',$id)
                        ->get();
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

    public function ShowModalKandidat($idF,$idK){
        $infodetailkandiat = DB::table('T_DFPTK')
                        ->where('id_TFPTK',$idF)
                        ->where('id_TKandidat',$idK)
                        ->get();
        return $infodetailkandiat;
    }

    public function UpdateModal(Request $request){
        DB::table('T_DFPTK')
            ->where('id_TFPTK',$request->id_fptk)
            ->where('id_TKandidat',$request->id_kandidat)
            ->update([
                'ket'=>$request->keterangan,
                'jenis'=>$request->jenis
            ]);
        return true;
    }

    public function CekPosisi(Request $request){
        $result = DB::table('M_job')
                ->where('active',1)
                ->where('deleted',0)
                ->where('nama',$request->posisi)
                ->count();
        return $result;
    }
    public function CekOrganisasi(Request $request){
        return $request;
    }


}
