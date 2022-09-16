<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;

class FormKandidatController extends Controller
{


    public function ShowForm1($url){
        $date = Carbon::now()->format('Y-m-d H:i');
        $result = DB::table('T_link')
            ->where('url',$url)
            ->where('openlink','<=',$date)
            ->where('closelink','>=',$date)
            ->where('active','1')
            ->where('deleted',0)
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

    public function ShowForm2($url){
        $id_kandidat = DB::table('T_linkPhase2')
                    ->where('url',$url)
                    ->where('active',1)
                    ->where('deleted',0)
                    ->first();    
        if($id_kandidat){
            $info_kandidat = DB::table('T_kandidat')
                    ->where('id',$id_kandidat->id)
                    ->first(); 
            return view('form kandidat/formkandidat2',[
                        'info_kandidat'=>$info_kandidat
                    ]);
        }else{
            return abort(404);
        }
    }

    public function SubmitForm1(Request $request){
        $path_gambarkedudukan = storage_path('app/public/kandidatFotoKedudukans');
        $path_profile=storage_path('app/public/kandidatFotos');
        $path_CV=storage_path('app/public/kandidatCVs/');

        $gambarkedudukan_ =storage_path('app\public\kandidatFotoKedudukans\\');
        $profile_ =storage_path('app\public\kandidatFotos\\');
        $CV_=storage_path('app\public\kandidatCVs\\');
        $CV2='public\kandidatCVs\\';

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
                // dd('masuk sini');
                // kalo usenya pernah daftar dan di organisasi yang sama
                // update flag jadi 1
                $id_kandidat_ = DB::table('T_kandidat')
                                ->select('id')
                                ->where('noidentitas',$request->noidentitas)
                                ->where('id_Organisasi',$request->organisasiid)
                                ->first();
                $id_kandidat = $id_kandidat_->id;

                $gambarkedudukan = $request->file('gambarkedudukan');
                if (!File::isDirectory($path_gambarkedudukan)) {
                    File::makeDirectory($path_gambarkedudukan);
                }
                if ($gambarkedudukan) {
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.png')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.png');
                    }
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.jpg')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.jpg');
                    }
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.jpeg')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.jpeg');
                    }

                    $imgName = $id_kandidat . '.' . $gambarkedudukan->getClientOriginalExtension();
                    Image::make($gambarkedudukan)->save($path_gambarkedudukan . '/' . $imgName);
                }else if($gambarkedudukan==null){
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.png')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.png');
                    }
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.jpg')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.jpg');
                    }
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.jpeg')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.jpeg');
                    }
                    $imgName=null;
                }

                $fotoprofile = $request->file('foto');
                if (!File::isDirectory($path_profile)) {
                    File::makeDirectory($path_profile);
                }
                if ($fotoprofile) {
                    if(file_exists($profile_ . $id_kandidat . '.png')) {
                        unlink($profile_ . $id_kandidat . '.png');
                    }
                    if(file_exists($profile_ . $id_kandidat . '.jpg')) {
                        unlink($profile_ . $id_kandidat . '.jpg');
                    }
                    if(file_exists($profile_ . $id_kandidat . '.jpeg')) {
                        unlink($profile_ . $id_kandidat . '.jpeg');
                    }

                    $imgName2 = $id_kandidat . '.' . $fotoprofile->getClientOriginalExtension();
                    Image::make($fotoprofile)->save($path_profile . '/' . $imgName2);
                }else if($fotoprofile==null){
                    if(file_exists($profile_ . $id_kandidat . '.png')) {
                        unlink($profile_ . $id_kandidat . '.png');
                    }
                    if(file_exists($profile_ . $id_kandidat . '.jpg')) {
                        unlink($profile_ . $id_kandidat . '.jpg');
                    }
                    if(file_exists($profile_ . $id_kandidat . '.jpeg')) {
                        unlink($profile_ . $id_kandidat . '.jpeg');
                    }

                    $imgName2= null;
                }

                $cv = $request->file('cv');
                if (!File::isDirectory($path_CV)) {
                    File::makeDirectory($path_CV);
                }
                if ($cv) {
                    if(file_exists($CV_ . $id_kandidat . '.pdf')) {
                        unlink($CV_ . $id_kandidat . '.pdf');
                    }

                    $filecv = $id_kandidat . '.' . $cv->getClientOriginalExtension();
                    $request->file('cv')->storeAs($CV2,$filecv);
                }else if($cv==null){
                    // dd(file_exists($CV_ . $id_kandidat . '.pdf'),$CV_ . $id_kandidat . '.pdf');
                    if(file_exists($CV_ . $id_kandidat . '.pdf')) {
                        unlink($CV_ . $id_kandidat . '.pdf');
                    }

                    $filecv = null;
                }

                DB::table('T_kandidat')
                ->where('id',$id_kandidat)
                ->update([
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
                    'npwp'=>$request->npwp,
                    'nohp'=>$request->nohp,
                    'email'=>$request->email,
                    'tinggibadan'=>$request->tinggibadan,
                    'beratbadan'=>$request->beratbadan,
                    'gaji'=>$request->gaji,
                    'tunjangan'=>$request->tunjangan,
                    'gambarkedudukan'=>$imgName,
                    'tanggungjawab'=>$request->tanggungjawab,
                    'prestasi'=>$request->prestasi,
                    'jabatanharapan'=>$request->jabatanharapan,
                    'gajiharapan'=>$request->gajiharapan,
                    'tujanganharapan'=>$request->tujanganharapan,
                    'bertugasluarkota'=>$request->bertugasluarkota,
                    'ditempatkanluarkota'=>$request->bertugasluarkota,
                    'fotoCV'=>$imgName2,
                    'CV'=>$filecv,
                    'urlPorto'=>$request->porto,
                    'flag'=>1,
                    'updated_at'=>Carbon::now()
                ]);

                DB::table('T_kandidat_sim')->where('id_Tkandidat',$id_kandidat)->delete();

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

                DB::table('T_kandidat_edukasi')->where('id_Tkandidat',$id_kandidat)->delete();

                $pendidikan_ = ['SD','SLTP','SMA','Akademi','S1','S2'];
                for ($j=0; $j <count($request->namasekolah) ; $j++) {
                    $namasekolah = trim($request->namasekolah[$j],''); 
                    $jurusan = trim($request->jurusan[$j],''); 
                    $kota = trim($request->kota[$j],''); 
                    $tahun = trim($request->tahun[$j],''); 

                    if (!empty($namasekolah)||!empty($jurusan)||!empty($kota)||!empty($tahun)) {
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


                DB::table('T_kandidat_pekerjaan')->where('id_Tkandidat',$id_kandidat)->delete();

                if(!empty($request->nama_perushaan)){
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

                //tamabh row data
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
                            'flag'=>1,
                            'created_at'=>Carbon::now(),
                            'updated_at'=>NULL
                        ]);

                $gambarkedudukan = $request->file('gambarkedudukan');
                if (!File::isDirectory($path_gambarkedudukan)) {
                    File::makeDirectory($path_gambarkedudukan);
                }
                if ($gambarkedudukan) {
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.png')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.png');
                    }
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.jpg')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.jpg');
                    }
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.jpeg')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.jpeg');
                    }
                
                    $imgName = $id_kandidat . '.' . $gambarkedudukan->getClientOriginalExtension();
                    Image::make($gambarkedudukan)->save($path_gambarkedudukan . '/' . $imgName);
                }else{
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.png')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.png');
                    }
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.jpg')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.jpg');
                    }
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.jpeg')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.jpeg');
                    }
                    $imgName=null;
                }
                        

                DB::table('T_kandidat')
                    ->where('id',$id_kandidat)
                    ->update([
                        'gambarkedudukan'=>$imgName
                    ]);

                $fotoprofile = $request->file('foto');
                if (!File::isDirectory($path_profile)) {
                    File::makeDirectory($path_profile);
                }
                if ($fotoprofile) {
                    if(file_exists($profile_ . $id_kandidat . '.png')) {
                        unlink($profile_ . $id_kandidat . '.png');
                    }
                    if(file_exists($profile_ . $id_kandidat . '.jpg')) {
                        unlink($profile_ . $id_kandidat . '.jpg');
                    }
                    if(file_exists($profile_ . $id_kandidat . '.jpeg')) {
                        unlink($profile_ . $id_kandidat . '.jpeg');
                    }
                
                    $imgName2 = $id_kandidat . '.' . $fotoprofile->getClientOriginalExtension();
                    Image::make($fotoprofile)->save($path_profile . '/' . $imgName2);
                }else if($fotoprofile==null){
                    if(file_exists($profile_ . $id_kandidat . '.png')) {
                        unlink($profile_ . $id_kandidat . '.png');
                    }
                    if(file_exists($profile_ . $id_kandidat . '.jpg')) {
                        unlink($profile_ . $id_kandidat . '.jpg');
                    }
                    if(file_exists($profile_ . $id_kandidat . '.jpeg')) {
                        unlink($profile_ . $id_kandidat . '.jpeg');
                    }
                
                    $imgName2= null;
                }

                DB::table('T_kandidat')
                    ->where('id',$id_kandidat)
                    ->update([
                        'fotoCV'=>$imgName2
                    ]);

                $cv = $request->file('cv');
                if (!File::isDirectory($path_CV)) {
                    File::makeDirectory($path_CV);
                }
                if ($cv) {
                    if(file_exists($CV_ . $id_kandidat . '.pdf')) {
                        unlink($CV_ . $id_kandidat . '.pdf');
                    }
                
                    $filecv = $id_kandidat . '.' . $cv->getClientOriginalExtension();
                    $request->file('cv')->storeAs($CV2,$filecv);
                }else if($cv==null){
                    if(file_exists($CV_ . $id_kandidat . '.pdf')) {
                        unlink($CV_ . $id_kandidat . '.pdf');
                    }
                
                    $filecv = null;
                }

                DB::table('T_kandidat')
                    ->where('id',$id_kandidat)
                    ->update([
                        'CV'=>$imgName2
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

                    if (!empty($namasekolah)||!empty($jurusan)||!empty($kota)||!empty($tahun)) {
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

                if (!empty($request->nama_perushaan)) {
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
                
                $gambarkedudukan = $request->file('gambarkedudukan');
                if (!File::isDirectory($path_gambarkedudukan)) {
                    File::makeDirectory($path_gambarkedudukan);
                }
                if ($gambarkedudukan) {
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.png')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.png');
                    }
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.jpg')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.jpg');
                    }
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.jpeg')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.jpeg');
                    }
                
                    $imgName = $id_kandidat . '.' . $gambarkedudukan->getClientOriginalExtension();
                    Image::make($gambarkedudukan)->save($path_gambarkedudukan . '/' . $imgName);
                }else{
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.png')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.png');
                    }
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.jpg')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.jpg');
                    }
                    if(file_exists($gambarkedudukan_ . $id_kandidat . '.jpeg')) {
                        unlink($gambarkedudukan_ . $id_kandidat . '.jpeg');
                    }
                    $imgName=null;
                }

                DB::table('T_kandidat')
                    ->where('id',$id_kandidat)
                    ->update([
                        'gambarkedudukan'=>$imgName
                    ]);

                $fotoprofile = $request->file('foto');
                if (!File::isDirectory($path_profile)) {
                    File::makeDirectory($path_profile);
                }
                if ($fotoprofile) {
                    if(file_exists($profile_ . $id_kandidat . '.png')) {
                        unlink($profile_ . $id_kandidat . '.png');
                    }
                    if(file_exists($profile_ . $id_kandidat . '.jpg')) {
                        unlink($profile_ . $id_kandidat . '.jpg');
                    }
                    if(file_exists($profile_ . $id_kandidat . '.jpeg')) {
                        unlink($profile_ . $id_kandidat . '.jpeg');
                    }
                
                    $imgName2 = $id_kandidat . '.' . $fotoprofile->getClientOriginalExtension();
                    Image::make($fotoprofile)->save($path_profile . '/' . $imgName2);
                }else if($fotoprofile==null){
                    if(file_exists($profile_ . $id_kandidat . '.png')) {
                        unlink($profile_ . $id_kandidat . '.png');
                    }
                    if(file_exists($profile_ . $id_kandidat . '.jpg')) {
                        unlink($profile_ . $id_kandidat . '.jpg');
                    }
                    if(file_exists($profile_ . $id_kandidat . '.jpeg')) {
                        unlink($profile_ . $id_kandidat . '.jpeg');
                    }
                
                    $imgName2= null;
                }

                DB::table('T_kandidat')
                    ->where('id',$id_kandidat)
                    ->update([
                        'fotoCV'=>$imgName2
                    ]);

                $cv = $request->file('cv');
                if (!File::isDirectory($path_CV)) {
                    File::makeDirectory($path_CV);
                }
                if ($cv) {
                    if(file_exists($CV_ . $id_kandidat . '.pdf')) {
                        unlink($CV_ . $id_kandidat . '.pdf');
                    }
                
                    $filecv = $id_kandidat . '.' . $cv->getClientOriginalExtension();
                    $request->file('cv')->storeAs($CV2,$filecv);
                }else if($cv==null){
                    // dd(file_exists($CV_ . $id_kandidat . '.pdf'),$CV_ . $id_kandidat . '.pdf');
                    if(file_exists($CV_ . $id_kandidat . '.pdf')) {
                        unlink($CV_ . $id_kandidat . '.pdf');
                    }
                    
                    $filecv = null;
                }

                DB::table('T_kandidat')
                    ->where('id',$id_kandidat)
                    ->update([
                        'CV'=>$filecv
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

                    if (!empty($namasekolah)||!empty($jurusan)||!empty($kota)||!empty($tahun)) {
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

                if(!empty($request->nama_perushaan)){
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
            DB::commit();
            return redirect()->route('fk.terimakasih');
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e);
        }
        
    }

    public function SubmitForm2(Request $request){
        // dd($request);
        DB::beginTransaction();
        try {
            DB::table('T_kandidat2')
                ->insert([
                    'id_Tkandidat'=>$request->kandidat,
                    'golDarah'=>$request->goldarah,
                    'noTlp'=>$request->tlprumah,
                    'prestasiPendidikan'=>$request->prestasi,
                    'tulisanIlmiah'=>$request->karyailmiah,
                    'kegiatan'=>$request->waktuluang,
                    'suratKabar'=>$request->suratkabar,
                    'topik'=>$request->topik,
                    'alasanMelamar'=>$request->alasan,
                    'lingkunganKerja'=>implode(", ",$request->lingkungankerja),
                    'sakit'=>$request->sakit,
                    'tahunSakit'=>$request->sakitkapan,
                    'psikologis'=>$request->psikologis,
                    'tahunPsikolog'=>$request->psikologiskapan,
                    'lembagaPsikolog'=>$request->psikologislembaga,
                    'tujuanPsikolog'=>$request->psikologistujuan,
                    'jenisKendaraan'=>$request->kendaraan,
                    'milikKendaraan'=>$request->kendaraanmilik,
                    'kerabatFarmasi'=>$request->kerabat,
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now()
                ]);

            if(!empty($request->jenis_pelatihan)){
                for ($k=0; $k <count($request->jenis_pelatihan) ; $k++) { 
                    $jenispelatihan = trim($request->jenis_pelatihan[$k],''); 
                    $penyelenggarapelatihan = trim($request->penyelenggara_pelatihan[$k],''); 
                    $tahunpelatihan = trim($request->tahun_pelatihan[$k],''); 

                    if (!empty($jenispelatihan)&&!empty($penyelenggarapelatihan)&&!empty($tahunpelatihan)) {
                    
                        DB::table('T_pelatihan')
                            ->insert([
                                'id_Tkandidat'=>$request->kandidat, //$request->kandidat
                                'jenisPlthn'=>$jenispelatihan,
                                'penyelenggaraPlthn'=>$penyelenggarapelatihan,
                                'tahunPlthn'=>$tahunpelatihan
                            ]);
                    }
                }
                
            }
            
            if(!empty($request->nama_organisasi)){
                for ($k=0; $k <count($request->nama_organisasi) ; $k++) { 
                    $namaorganisasi = trim($request->nama_organisasi[$k],''); 
                    $kotaorganisasi = trim($request->kota_organisasi[$k],''); 
                    $jabatanorganisasi = trim($request->jabatan_organisasi[$k],''); 
                    $tahunorganisasi = trim($request->tahun_organisasi[$k],''); 
                    
                    if (!empty($namaorganisasi)&&!empty($kotaorganisasi)&&!empty($jabatanorganisasi)&&!empty($tahunorganisasi)) {
                        DB::table('T_organisasi')
                            ->insert([
                                'id_Tkandidat'=>$request->kandidat, //$request->kandidat
                                'namaOrg'=>$namaorganisasi,
                                'kotaOrg'=>$kotaorganisasi,
                                'jabatanOrg'=>$jabatanorganisasi,
                                'tahunOrg'=>$tahunorganisasi
                            ]);
                    }
                }
                
            }

            //ubah disini BLM di update
            if(!empty($request->nama_saudarafarmasi)){
                for ($k=0; $k <count($request->nama_saudarafarmasi) ; $k++) { 
                    $namasaudara = trim($request->nama_saudarafarmasi[$k],''); 
                    $hubungansaudara = trim($request->hubungan_saudarafarmasi[$k],''); 
                    $gendersaudara = trim($request->LP_saudarafarmasi[$k],''); 
                    $perusahaansaudara = trim($request->perushaan_saudarafarmasi[$k],''); 
                    $jabatansaudara = trim($request->jabatan_saudarafarmasi[$k],''); 

                    if (!empty($namasaudara)&&!empty($hubungansaudara)&&!empty($gendersaudara)&&!empty($perusahaansaudara)&&!empty($jabatansaudara)) {
                        DB::table('T_Kerabat')
                            ->insert([
                                'id_Tkandidat'=>$request->kandidat,//$request->kandidat
                                'hubunganKrbt'=>$hubungansaudara,
                                'namaKrbt'=>$namasaudara,
                                'genderKrbt'=>$gendersaudara,
                                'nmperusahaanKrbt'=>$perusahaansaudara,
                                'jabatanKrbt'=>$jabatansaudara
                            ]);
                    }
                }
                
            }

            if(!empty($request->nama_kenal)){
                for ($k=0; $k <count($request->nama_kenal) ; $k++) { 
                    $namakenal = trim($request->nama_kenal[$k],''); 
                    $hubungankenal = trim($request->hubungan_kenal[$k],''); 

                    if (!empty($namakenal)&&!empty($hubungankenal)) {
                        DB::table('T_kenal')
                            ->insert([
                                'id_Tkandidat'=>$request->kandidat,//$request->kandidat
                                'namaKenalan'=>$namakenal,
                                'hubunganKenalan'=>$hubungankenal
                            ]);
                    }
                }
                
            }

            if(!empty($request->nama_referensi)){
                for ($k=0; $k <count($request->nama_referensi) ; $k++) { 
                    $namaref = trim($request->nama_referensi[$k],''); 
                    $alamatref = trim($request->alamat_referensi[$k],''); 
                    $pekerjaanref = trim($request->pekerjaan_referensi[$k],''); 
                    $tlpref = trim($request->tlp_referensi[$k],''); 
                    
                    if (!empty($namaref)&&!empty($alamatref)&&!empty($alamatref)&&!empty($pekerjaanref)&&!empty($tlpref)) {
                        DB::table('T_refrensi')
                            ->insert([
                                'id_Tkandidat'=>$request->kandidat,
                                'namaRef'=>$namaref,
                                'alamatRef'=>$alamatref,
                                'pekerjaanRef'=>$pekerjaanref,
                                'tlpRef'=>$tlpref
                            ]);
                    }
                }
                
            }

            if(!empty($request->nama_kontakdarurat)){
                for ($k=0; $k <count($request->nama_kontakdarurat) ; $k++) { 
                    $namadarurat = trim($request->nama_kontakdarurat[$k],''); 
                    $alamatdarurat = trim($request->alamat_kontakdarurat[$k],''); 
                    $tlpdarurat = trim($request->tlp_kontakdarurat[$k],''); 
                    
                    if (!empty($namadarurat)&&!empty($alamatdarurat)&&!empty($tlpdarurat)) {
                        DB::table('T_darurat')
                            ->insert([
                                'id_Tkandidat'=>$request->kandidat,
                                'namaDart'=>$namadarurat,
                                'alamatDart'=>$alamatdarurat,
                                'tlpDart'=>$tlpdarurat
                            ]);
                    }
                }
                
            }

            $statuskeluarga = ['Ayah','Ibu','Kaka/Adik 1',
                                'Kaka/Adik 2','kaka/adik 3',
                                'Kaka/Adik 4','Suami/Istri',
                                'Anak 1','Anak 2','Anak 3','Anak 4',
                                'Ayah Mertua','Ibu Mertua'
            ];
            $statusalamt = [
                'Alamat Keluarga',
                'Alamat Merrtua'
            ];

            if(!empty($request->nama)){
                for ($k=0; $k <count($request->nama) ; $k++) {
                    $status = $statuskeluarga[$k]; 
                    $namakeluarga = trim($request->nama[$k],''); 
                    $usiakeluarga = trim($request->usia[$k],''); 
                    $LPKeluarga = trim($request->LP[$k],''); 
                    $pendidikankeluarga = trim($request->pendidikan[$k],'');
                    $perushaankeluarga = trim($request->namaperushaan[$k],''); 
                    
                    if (!empty($namakeluarga)&&!empty($usiakeluarga)&&!empty($LPKeluarga)&&!empty($pendidikankeluarga)&&!empty($perushaankeluarga)) {
                        DB::table('T_keluarga')
                        ->insert([
                            'id_Tkandidat'=>$request->kandidat,
                            'statusKeluarga'=>$status,
                            'namaKelurga'=>$namakeluarga,
                            'usiaKeluarga'=>$usiakeluarga,
                            'genderKeluarga'=>$LPKeluarga,
                            'pendidikanKeluarga'=>$pendidikankeluarga,
                            'perushaanKeluarga'=>$perushaankeluarga
                        ]);
                    }
                }
                
            }

            if(!empty($request->alamat)){
                for ($k=0; $k <count($request->alamat) ; $k++) {
                    $status = $statusalamt[$k]; 
                    $alamatkeluarga = trim($request->alamat[$k],'');
                    if ($k<1) {
                        $tlpkeluarga = trim($request->notlp[$k],''); 
                    } else{
                        $tlpkeluarga=null;
                    }
                    
                    
                    if (!empty($status)&&!empty($alamatkeluarga)) {
                        DB::table('T_alamatKeluarga')
                            ->insert([
                                'id_Tkandidat'=>$request->kandidat,
                                'statusAlamat'=>$status,
                                'alamatKeluarga'=>$alamatkeluarga,
                                'tlpKeluarga'=>$tlpkeluarga
                            ]);
                        }
                }
                
            }

            if(!empty($request->bahasa)){
                for ($k=0; $k <count($request->bahasa) ; $k++) { 
                    $bahasa = trim($request->bahasa[$k],''); 
                    $berbicara = trim($request->berbicara[$k],''); 
                    $menulis = trim($request->menulis[$k],''); 
                    $membaca = trim($request->membaca[$k],''); 
                    
                    if (!empty($bahasa)&&!empty($berbicara)&&!empty($menulis)&&!empty($membaca)) {
                        DB::table('T_bahasa')
                            ->insert([
                                'id_Tkandidat'=>$request->kandidat, //$request->kandidat
                                'bahasa'=>$bahasa,
                                'berbicara'=>$berbicara,
                                'menulis'=>$menulis,
                                'membaca'=>$membaca
                            ]);
                    }
                }
                
            }

            DB::table('T_linkPhase2')
                ->where('id',$request->kandidat)
                ->update([
                    'active'=>0
                ]);
            
            DB::commit();
            return redirect()->route('fk.terimakasih');
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e);
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
}
