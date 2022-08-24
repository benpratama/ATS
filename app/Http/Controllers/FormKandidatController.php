<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

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
                        ->where('url',$url)
                        ->select('id','id_Organisasi')
                        ->first();
            $Tempatlahir = DB::table('M_kodepos_Final')
                        ->distinct()
                        ->select('provinsi')
                        ->where('deleted',0)
                        ->where('active',1)
                        ->get();
            
            return view('form kandidat/formkandidat',
                    [   
                        'SIM'=>$SIM,
                        'Pernikahan'=>$pernikahan,
                        'SMA'=>$SMA,
                        'Sederajat'=>$Sederajat,
                        'Domisili' =>$Domisili,
                        'URL' =>$url,
                        'TempatLahir'=>$Tempatlahir
                    ]);
        }
    }

    public function SubmitForm1(Request $request){
        DB::beginTransaction();
        try {
            $result1 = DB::table('T_kandidat')
                    ->where('noidentitas',$request->noidentitas)
                    ->count();
            $result2 = DB::table('T_kandidat')
                    ->where('noidentitas',$request->noidentitas)
                    ->where('id_Organisasi',$request->organisasiid)
                    ->count();
            if ($result1>=1 && $result2>=1) {
                // kalo usenya pernah daftar dan di organisasi yang sama
                // update flag jadi 1
                dd('masuk if');
            }else if($result1>=1 && $result2==0){
                // kalo usenya pernah daftar dan di organisasi beda
                // tambah row data
                // update flag jadi 1
                DB::table('T_kandidat')
                ->where('noidentitas',$request->noidentitas)
                ->update([
                    'flag'=>1,
                    'updated_at'=>Carbon::now()
                ]);
            }else{
                // kalo usenya blm pernah daftar
                // flag null
                $id_kandidat = DB::table('T_kandidat')
                        ->insertGetId([
                            'id_Organisasi'=>$request->organisasiid,
                            'id_Tlink'=>$request->urlid,
                            'id_Test'=>NULL,
                            'id_MCU'=>NULL,
                            'id_FPTK'=>NULL,
                            'UserInterview'=>NULL,
                            'namalengkap'=>$request->namalengkap,
                            'gender'=>$request->gender,
                            'status_perkawinan'=>$request->status_perkawinan,
                            'tempatlahir'=>$request->tempatlahir,
                            'tgllahir'=>$request->tgllahir,
                            'alamatlengkap'=>$request->alamatlengkap,
                            'rumahmilik'=>$request->rumahmilik,
                            'kota1'=>$request->kota1,
                            'kodepos'=>$request->kodepos,
                            'alamat_koresponden'=>$request->alamat_koresponden,
                            'rumahmilik_koresponden'=>$request->rumahmilik_koresponden,
                            'kota_koresponden'=>$request->kota_koresponden,
                            'kodepos_koresponden'=>$request->kodepos_koresponden,
                            'noidentitas'=>$request->noidentitas,
                            'npwp'=>$request->npwp,
                            'nohp'=>$request->nohp,
                            'email'=>$request->email,
                            'tinggibadan'=>$request->tinggibadan,
                            'beratbadan'=>$request->beratbadan,
                            'gaji'=>$request->gaji,
                            'tunjangan'=>$request->tunjangan,
                            'gambarkedudukan'=>NULL,
                            'tanggungjawab'=>$request->tanggungjawab,
                            'prestasi'=>$request->prestasi,
                            'jabatanharapan'=>$request->jabatanharapan,
                            'gajiharapan'=>$request->gajiharapan,
                            'tujanganharapan'=>$request->tujanganharapan,
                            'bertugasluarkota'=>$request->bertugasluarkota,
                            'ditempatkanluarkota'=>$request->bertugasluarkota,
                            'fotoCV'=>NULL,
                            'CV'=>NULL,
                            'urlPorto'=>$request->porto,
                            'flag'=>NULL,
                            'created_at'=>Carbon::now(),
                            'updated_at'=>NULL
                        ]);

                for ($i=0; $i <count($request->sim) ; $i++) { 
                    if ($request->sim[$i]!=1) {
                        DB::table('T_kandidat_sim')
                            ->insert([
                                'id_Tkandidat'=>$id_kandidat,
                                'sim'=> $request->sim[$i],
                                'nosim'=> $request->nosim[$i],
                        ]);
                    }
                }
                
                $pendidikan_ = ['SD','SLTP','SMA','Akademi','S1','S2'];
                for ($j=0; $j <count($request->namasekolah) ; $j++) {
                    $namasekolah = trim($request->namasekolah[$j],''); 
                    $jurusan = trim($request->jurusan[$j],''); 
                    $kota = trim($request->kota[$j],''); 
                    $tahun = trim($request->tahun[$j],''); 

                    if (!empty($namasekolah)&&!empty($jurusan)&&!empty($kota)&&!empty($tahun)) {
                        DB::table('T_kandidat_edukasi')
                            ->insert([
                                'id_Tkandidat'=>$id_kandidat,
                                'urutan'=>$j+1,
                                'pendidikan'=>$pendidikan_[$j],
                                'namaSekolah'=>$namasekolah,
                                'jurusan'=>$jurusan,
                                'kota'=>$kota,
                                'tahun'=>$tahun,
                            ]);
                    }
                }

                for ($k=0; $k <count($request->nama_perushaan) ; $k++) { 
                    $namaperusahaan = trim($request->nama_perushaan[$k],''); 
                    $alamatperushaan = trim($request->alamat_perusahaan[$k],''); 
                    $jabatanperusahaan = trim($request->jabatan_perusahaan[$k],''); 
                    $atasanperusahaan = trim($request->atasan_perusahaan[$k],''); 
                    $lamaperusahaan = trim($request->lama_perusahaan[$k],''); 

                    if (!empty($namaperusahaan)&&!empty($alamatperushaan)&&!empty($jabatanperusahaan)&&!empty($atasanperusahaan)&&!empty($lamaperusahaan)) {
                        DB::table('T_kandidat_pekerjaan')
                            ->insert([
                                'id_Tkandidat'=>2,
                                'namaPerusahaan'=>$namaperusahaan,
                                'jenisPerusahaan'=>$request->jenis_perusahaan[$k],
                                'alamatPerusahaan'=>$alamatperushaan,
                                'jabatanPerusahaan'=>$jabatanperusahaan,
                                'atasanPerusahaan'=>$atasanperusahaan,
                                'tahunPerusahaan'=>$lamaperusahaan
                            ]);
                    }
                }
                        
                DB::table('T_LogKandidat')
                    ->insert([
                        'noidentitas_Tkandidat'=>$request->noidentitas,
                        'id_Rekrutmen'=>'1',
                        'id_Organisasi'=>$request->organisasiid,
                        'id_Summary'=>NULL,
                        'notes'=>NULL,
                        'created_at'=>Carbon::now(),
                        'updated_at'=>NULL
                    ]);
            }
            // DB::commit();
            // return redirect()->route('fk.terimakasih');
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', 'salah bosss');
        }
        
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
    // public function test(){
    //     return redirect()->route('fk.terimakasih');
    // }
}
