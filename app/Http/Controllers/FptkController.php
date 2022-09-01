<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\DB;

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

        $ss = IOFactory::load($filenameDownload);

        $data_user = DB::table('M_user')
                    ->select('nama','NIK','namaManager','id_Organisasi','location')
                    ->where('id_Organisasi',Auth::user()->id)
                    ->get();
        $data_lob = DB::table('M_LobandSub')
                    ->select ('nama','id_Organisasi')
                    ->get();
        $data_job = DB::table('M_job')
                    ->select('nama','golongan')
                    ->where('active',1)
                    ->where('deleted',0)
                    ->get();

        $ws1=null;

        $ws1=$ss->getSheetByName('Sheet1');
        $i=3;
        foreach($data_user as $row1){
            // dd($row1->nama);
            $ws1->setCellValue('AN'.$i, $row1->NIK);
            $ws1->setCellValue('AO'.$i, $row1->nama);
            $ws1->setCellValue('AP'.$i, $row1->namaManager);
            $ws1->setCellValue('AQ'.$i, $row1->location);
            $ws1->setCellValue('AR'.$i, $row1->id_Organisasi);
            $i++;
        }
        $j=3;
        foreach($data_lob as $row1){
            // dd($row1->nama);
            $ws1->setCellValue('AT'.$j, $row1->nama);
            $ws1->setCellValue('AU'.$j, $row1->id_Organisasi);
            $j++;
        }
        $k=3;
        foreach($data_job as $row1){
            // dd($row1->nama);
            $ws1->setCellValue('AW'.$k, $row1->nama);
            $ws1->setCellValue('AX'.$k, $row1->golongan);
            $k++;
        }

        $totalRows=$ws1->getHighestRow();

        $writer = IOFactory::createWriter($ss, "Xlsx");
        // $writer->save($filenameDownload);
        // $writer->save('php://output');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filenameDownload);
        $writer->save('php://output');
        unlink($filenameDownload);
    }
}
