<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class MppController extends Controller
{
    //
    public function index(){
        $list_LOB = DB::table('M_LobandSub')
                    ->where('id_Organisasi',Auth::user()->id_Organisasi)
                    ->get();
        return view('hr/hr_mpp',[
            'list_lobs'=>$list_LOB
        ]);
    }

    public function TemplateMpp(){
        $file = storage_path('app\public\template').'\MPP_NAMA_ORGANISASI.xlsx';
        $filenameDownload = 'MPP_'.Auth::user()->nama.'_'.Auth::user()->id_Organisasi.'.xlsx';

        $success=copy($file, $filenameDownload);
        if(!$success) die();

        //ini bikin sheet
        $ss = IOFactory::load('./'.$filenameDownload);
        $list_lob = DB::table('M_LobandSub')
                    ->where('id_Organisasi',Auth::user()->id_Organisasi)
                    ->get();
        foreach ($list_lob as $key => $value) {
            $clonedWorksheet = clone $ss->getSheetByName('Sheet1');
            $clonedWorksheet->setTitle($value->nama.'-'.$value->id);
            $ss->addSheet($clonedWorksheet);
        }

        //ini hapus sheet
        $ss->setActiveSheetIndexByName('Sheet1');
        $sheetIndex = $ss->getActiveSheetIndex();
        $ss->removeSheetByIndex($sheetIndex);

        $writer = IOFactory::createWriter($ss, "Xlsx");
        $writer->save($filenameDownload);

        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filenameDownload);

        readfile($filenameDownload); 
        unlink($filenameDownload);

    }

    public function ImportMpp(Request $request){
        // dd($request);
        $MPPs = $request->file('upload_MPP');
        $raw_filename = explode("_",$MPPs->getClientOriginalName()); //buat ambil nama pengupload [1]
        $raw_id_Organisasi= explode(".",$raw_filename[2]);//buat ambil id_Organisasi [0]
        
        if ($MPPs) {
            $reader = new Xlsx();
            $spreadsheet = $reader->load($MPPs);
            $sheetname = $spreadsheet->getSheetNames();

            foreach ($sheetname as $key => $value) {
                
                $datas = $spreadsheet->getSheetByName($value)->toArray();
                $raw_id_lobandsub = explode("-",$value);

                $thnBE = $request->tahunBE;
                $id_Organisasi = $raw_id_Organisasi[0];
                $id_lobandsub = $raw_id_lobandsub[1];
                $createdBy = $raw_filename[1];
                $gol78 = $datas[2][2];
                $gol6 = $datas[3][2];
                $gol5 = $datas[4][2];
                $gol4 = $datas[5][2];
                $gol3 = $datas[6][2];
                $dol12 = $datas[7][2];
                $ttlPermanen = $datas[8][2];
                $ttlTemporary= $datas[9][2];

                DB::table('T_MPP')
                ->insert([
                    'id_Torganisasi'=>$id_Organisasi,
                    'id_Tlobandsub'=>$id_lobandsub,
                    'tahunBE'=>$thnBE,
                    'gol 7-8'=>$gol78,
                    'gol 6'=>$gol6,
                    'gol 5'=>$gol5,
                    'gol 4'=>$gol4,
                    'gol 3'=>$gol3,
                    'gol 1-2'=>$dol12,
                    'ttlPermanen'=>$ttlPermanen,
                    'ttlTemporary'=>$ttlTemporary,
                    'createdBy'=>$createdBy,
                    'created_at'=>Carbon::now()
                ]);

            }
        }else {
            dd('file tdk ada');
        }
       return Redirect::back();
    }

    public function ShowMpp(Request $request){
        $lvl = [
            'Direksi (Golongan 7-8)',
            'General Manager (Golongan 6)',
            'Manager (Golongan 5)',
            'Supervisor / Officer (Golongan 4)',
            'Staff (Golongan 3)',
            'Non Staff (Golongan 1-2)',
            'Total Permanent Employee',
            'Total Temporary Employee'
        ];
        $mpp = DB::table('T_MPP')
                    ->select('gol 7-8','gol 6','gol 5','gol 4','gol 3','gol 1-2','ttlPermanen','ttlTemporary')
                    ->where('tahunBe',$request->thn)
                    ->where('id_Tlobandsub',1)
                    ->get();
        
        $actual = DB::select('exec SP_Get_MPP_Actual ?,?,?',array(Auth::user()->id_Organisasi,$request->lob,$request->thn));

        return [$lvl,$mpp,$actual];
    }

    public function UpdateMpp(Request $request){
        DB::table('T_MPP')
            ->where('tahunBE',$request->thn)
            ->where('id_Tlobandsub',$request->lob)
            ->where('id_Torganisasi',Auth::user()->id_Organisasi)
            ->update([
                'gol 7-8'=>$request->updateBE[0],
                'gol 6'=>$request->updateBE[1],
                'gol 5'=>$request->updateBE[2],
                'gol 4'=>$request->updateBE[3],
                'gol 3'=>$request->updateBE[4],
                'gol 1-2'=>$request->updateBE[5],
                'ttlPermanen'=>$request->updateBE[6],
                'ttlTemporary'=>$request->updateBE[7]
            ]);
        return true;
    }
}
