<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestorController extends Controller
{
    public $date=60;
    //FPTK
    public function index(){
        
        $filter_status = DB::table('M_StatusFPTK')
                        ->select('id','keterangan')
                        ->where('active',1)
                        ->where('deleted',0)
                        ->get();
        $list_atasan = DB::table('M_AksesMPP')
                    ->select('id_MUser')
                    ->distinct()
                    ->where('active',1)
                    ->pluck('id_MUser')->toArray();
        return view ('requestor/home_requestor',['filterstatus'=>$filter_status,'atasan'=>$list_atasan]);
    }

    public function R_SummaryFptk(Request $request){
        $startdate =Carbon::now()->subDays($this->date)->toDateString();
        $enddate = Carbon::now()->endOfMonth()->toDateString();
        $id_User = $request->id_User;

        //periode
        if(!empty($request->Speriod)){
            $filterS = $request->Speriod;
        }else{
            $filterS = $startdate;
        }

        if(!empty($request->Eperiod)){
            $filterE = $request->Eperiod;
        }else{
            $filterE =$enddate;
        }
        
        //atasan?
        $list_MPP = DB::table('M_AksesMPP')
                    ->select('id_MLobandSub')
                    ->where('id_MUser',$id_User)
                    ->where('active',1)
                    ->pluck('id_MLobandSub')->toArray();

        if (count($list_MPP)>0) {
            $atasan=1;
            $id_dept=$list_MPP;
            $id_dept = implode('\',\'',$list_MPP);
            $id_dept="('".$id_dept."')";
        }else{
            $atasan=0;
            $id_dept="null";
        }
        $list_fptk = DB::select('EXEC SP_Get_Req_SummaryFPTK ?,?,?,?,?',array($filterS,$filterE,$request->NIK,$id_dept,$atasan));
        return $list_fptk;
    }

    public function indexFilter(Request $request){
        $startdate =Carbon::now()->subDays($this->date)->toDateString();
        $enddate = Carbon::now()->endOfMonth()->toDateString();
        $id_User = $request->id_User;
        $id_dept = $request->id_dept;

        //periode
        if(!empty($request->Speriod)){
            $filterS = $request->Speriod;
        }else{
            $filterS = $startdate;
        }

        if(!empty($request->Eperiod)){
            $filterE = $request->Eperiod;
        }else{
            $filterE =$enddate;
        }

        //ambil list akses mpp kalo dia atasan
        $list_MPP = DB::table('M_AksesMPP')
                    ->select('id_MLobandSub')
                    ->where('id_MUser',$id_User)
                    ->where('active',1)
                    ->pluck('id_MLobandSub')->toArray();

        //cek atasan atau bukan
        if (count($list_MPP)>0) {
            $atasan=1;
            // $arr_lob =[];

            // foreach ($list_MPP as $key => $value) {
            //     array_push($arr_lob,$value);
            // }
        }else{
            $atasan=0;
        }

        if ($atasan==0) {
            $filter_nofptk = DB::table('T_FPTK')
                            ->select('nofptk')
                            ->distinct()
                            ->whereBetween('tglinputfptk',[$filterS,$filterE])
                            ->where('nikpeminta',Auth::user()->NIK)
                            ->get();

            $filter_namapeminta = [];
            $filter_lob=[];

            $filter_lokasi = DB::table('T_FPTK')
                                ->select('penempatan')
                                ->distinct()
                                ->whereBetween('tglinputfptk',[$filterS,$filterE])
                                ->where('nikpeminta',Auth::user()->NIK)
                                ->get();
        } else {
            $filter_nofptk = DB::table('T_FPTK')
                            ->select('nofptk')
                            ->distinct()
                            ->whereBetween('tglinputfptk',[$filterS,$filterE])
                            ->whereIn('id_Tlobandsub',$list_MPP)
                            ->get();
            
            $filter_namapeminta = DB::table('T_FPTK')
                                ->select('namapeminta')
                                ->distinct()
                                ->whereBetween('tglinputfptk',[$filterS,$filterE])
                                ->whereIn('id_Tlobandsub',$list_MPP)
                                ->get();

            $filter_lokasi =DB::table('T_FPTK')
                            ->select('penempatan')
                            ->distinct()
                            ->whereBetween('tglinputfptk',[$filterS,$filterE])
                            ->whereIn('id_Tlobandsub',$list_MPP)
                            ->get();

            $filter_lob = DB::table('M_AksesMPP')
                            ->select('M_AksesMPP.id_MLobandSub','M_LobandSub.nama')
                            ->join('M_LobandSub','M_LobandSub.id','M_AksesMPP.id_MLobandSub')
                            ->where('id_MUser',$id_User)
                            ->where('active',1)
                            ->get();
        }
        return [$filter_nofptk,$filter_namapeminta,$filter_lokasi,$filter_lob];
        // return $filter_nofptk;
    }

    public function R_ListFptk(Request $request){
        $startdate =Carbon::now()->subDays($this->date)->toDateString();
        $enddate = Carbon::now()->endOfMonth()->toDateString();
        $nofptk='null';
        $lokasi='null';
        $status='null';
        $lob='null';
        $namapeminta='null';
        //periode
        if(!empty($request->Speriod)){
            $filterS = $request->Speriod;
        }else{
            $filterS = $startdate;
        }

        if(!empty($request->Eperiod)){
            $filterE = $request->Eperiod;
        }else{
            $filterE =$enddate;
        }

        // return $request;
        $all = 0;
        $id_dept='null';
        $result = DB::table('M_AksesMPP')
                ->select('id_MLobandSub')
                ->where('id_MUser',$request->id_User)
                ->where('active',1)
                ->where('id_MUser',$request->id_User)
                ->pluck('id_MLobandSub')->toArray();
                
        if (count($result)>0) {
           $all=1;
           $id_dept = implode('\',\'',$result);
           $id_dept="('".$id_dept."')";
        }

        //extra
        if(!empty($request->nofptk)){
            $nofptk = implode('\',\'',$request->nofptk);
            $nofptk = "('".$nofptk."')";
        }
        if(!empty($request->lokasi)){
            $lokasi = implode('\',\'',$request->lokasi);
            $lokasi = "('".$lokasi."')";
        }
        if(!empty($request->status)){
            $status = implode('\',\'',$request->status);
            $status = "('".$status."')";
        }
        if(!empty($request->status)){
            $status = implode('\',\'',$request->status);
            $status = "('".$status."')";
        }
        if(!empty($request->lob)){
            $lob = implode('\',\'',$request->lob);
            $lob = "('".$lob."')";
        }
        if(!empty($request->namapeminta)){
            $namapeminta = implode('\',\'',$request->namapeminta);
            $namapeminta = "('".$namapeminta."')";
        }
        
        $list_fptk = DB::select('EXEC SP_Get_Req_DetailFPTK ?,?,?,?,?,?,?,?,?,?',array($filterS,$filterE,$request->nik,$id_dept,$all,$nofptk,$lokasi,$status,$lob,$namapeminta));
        return $list_fptk;
    }

    public function TemplateLHW($golongan,$idkandidat,$idfptk){
        $namalengkap = DB::table('T_kandidat')
                    ->select('namalengkap')
                    ->where('id',$idkandidat)
                    ->first();
        // dd($namalengkap->namalengkap);
       if ($golongan==4) {
        $file = storage_path('app\public\template').'\LHW Gol. 4 - Supporting.xls';
        $filenameDownload ='LHW Gol. 4 - Supporting '.$namalengkap->namalengkap.'-'.$idfptk.'.xls';
       } elseif ($golongan==5) {
        $file = storage_path('app\public\template').'\LHW GOL. 5 - Managerial.xls';
        $filenameDownload ='LHW GOL. 5 - Managerial '.$namalengkap->namalengkap.'-'.$idfptk.'.xls';
       }elseif ($golongan==3) {
        $file = storage_path('app\public\template').'\NEW_Form Gol.3(MR)-Seleksi-Promosi.xls';
        $filenameDownload ='NEW_Form Gol.3(MR)-Seleksi-Promosi '.$namalengkap->namalengkap.'-'.$idfptk.'.xls';
       }elseif ($golongan==2) {
        $file = storage_path('app\public\template').'\NEW_Form Gol.2(ADMIN)-Seleksi-Promosi.xls';
        $filenameDownload ='NEW_Form Gol.2(ADMIN)-Seleksi-Promosi '.$namalengkap->namalengkap.'-'.$idfptk.'.xls';
       }
       $success=copy($file, $filenameDownload);
       if(!$success) die();

        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filenameDownload);
        readfile($filenameDownload); 
        unlink($filenameDownload);
       
    }

    //LHW
    public function ImportLHW(Request $request){
        $LHW = $request->file('upload_LHW');
        $nama_file=$LHW->getClientOriginalName();
        $idfptk = $request->idfptk;

        $result = DB::table('T_FPTK')
                    ->select('fileLhw')
                    ->where('id',$idfptk)
                    ->first();

        if(!$result->fileLhw==null){
            $deletefile = storage_path('app\public\LHW\\').$result->fileLhw;
            unlink($deletefile);
        }
        $LHW->move(storage_path('app\public\LHW\\'),$nama_file);
            DB::table('T_FPTK')
                ->where('id',$idfptk)
                ->update([
                    "fileLhw"=>$nama_file
                ]);
        return redirect()->route('rq.home');
    }

    //MPP
    public function indexMPP(){
        //ini nanti filternya
        $list_LOB = DB::table('M_AksesMPP')
                    ->select('id_MLobandSub','M_LobandSub.nama')
                    ->join('M_LobandSub','M_AksesMPP.id_MLobandSub','M_LobandSub.id')
                    ->where('id_MUser',Auth::user()->id)
                    ->where('active',1)
                    ->get();
        return view ('requestor/mpp_requestor',['ListLob'=>$list_LOB]);
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
                    ->where('id_Tlobandsub',$request->lob)
                    ->get();
        
        $actual = DB::select('exec SP_Get_MPP_Actual ?,?,?',array(Auth::user()->id_Organisasi,$request->lob,$request->thn));

        return [$lvl,$mpp,$actual];
    }
}
