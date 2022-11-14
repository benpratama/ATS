<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class KandidatController extends Controller
{
    public $idDeptHR=[3,4,5];
    public function index($id,$noidentitas){
          // dd($server);
          $info_kandidat = DB::table('T_kandidat')
                    ->where('id',$id)
                    ->where('noidentitas',$noidentitas)
                    ->first();
                    
            $applyAs =DB::table('T_link')
                    ->select('M_Job.nama')
                    ->join('M_Job','T_link.id_Tjob','M_job.id')
                    ->where('T_link.id',$info_kandidat->id_Tlink)
                    ->get();
            // dd($applyAs);

          // Start UMUR, last Pendidikan, FreshorNot, Status Perkawinan
          $age = Carbon::parse($info_kandidat->tglLahir)->diff(Carbon::now())->y;
          $last_pendidikan = DB::table('last_Pendidikan')
                              ->where('id_Tkandidat',$id)
                              ->first();

          $FreshorNot = DB::table('freshornot')
                         ->where('id_Tkandidat',$id)
                         ->first();
          if (empty($FreshorNot)) {
               $FreshorNot='FRESH';
               $last_pekerjaan ="";
          }else{
               $FreshorNot='PENGALAMAN';
               $last_pekerjaan = DB::table('last_Pekerjaan')
                              ->where('id_Tkandidat',$id)
                              ->first();
          }
          $status_perkawinan = DB::table('M_Statuspernikahan')
                              ->where('active',1)
                              ->where('deleted',0)
                              ->get();
          $kota = DB::table('M_kodepos_Final')
                              ->distinct()
                              ->select('kabupaten','provinsi')
                              ->where('deleted',0)
                              ->where('active',1)
                              ->get();
          // End UMUR, last pendidikan, Fresh or Not
          

          // Start url pahse 2
          $url_pahse2 = DB::table('T_linkPhase2')
                         ->select('url')
                         ->where('id_Tkandidat',$id)
                         ->first();
          if($url_pahse2){
               $server = $_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'];
               $url = $server.'/form-kandidat/phase2/'.$url_pahse2->url;
          }else{
               $url='BLM ada';
          }
          // End url pahse 2
          
          // phase2
          $infokandidat2 = DB::table('T_kandidat2')
                         ->where('id_Tkandidat',$id)
                         ->first();
          
          $referensi = DB::table('T_refrensi')
                         ->where('id_Tkandidat',$id) 
                         ->get();

          $darurat = DB::table('T_darurat')
                         ->where('id_Tkandidat',$id) 
                         ->get();
          //schedule
          $list_proses = DB::table('M_Rekrutmen')
                        ->select('id','proses')
                        ->where('active',1)
                        ->where('deleted',0)
                        ->whereNotIn('id', [1,7,8])
                        ->get();
          //list_cc
          $list_cc = DB::table('M_User')
                    ->select('nama','email')
                    ->where('id_Organisasi',$info_kandidat->id_Organisasi)
                    ->get();
          $list_mcu = DB::table('M_Vendor')
                    ->select('id','namaLab')
                    ->where('Jenis','MCU')
                    ->where('active',1)
                    ->where('deleted',0)
                    ->get();
            
        if (!in_array(session()->get('user')['dept'], $this->idDeptHR)) {
            $disabled=true;
        }else{
            $disabled=false;
        }

          if($info_kandidat){
               return view('detail_kandidat',
                    [
                         'kotas'=>$kota,
                         'StatusPerkawinan'=>$status_perkawinan,
                         'FreshorNot'=>$FreshorNot,
                         'pekerjaan'=>$last_pekerjaan,
                         'pendidikan' =>$last_pendidikan,
                         'info_kandidat' => $info_kandidat,
                         'umur'=>$age,
                         'url_phase2' => $url,
                         'applyas'=>$applyAs,
                         
                         // phase2
                         'info_kandidat2' => $infokandidat2,
                         'referensi'=>$referensi,
                         'darurat'=>$darurat,

                         // schedule
                         'list_proses'=>$list_proses,
                         'list_cc'=>$list_cc,
                         'list_mcu'=>$list_mcu,
                         'disabled'=>$disabled
                    ]);
          }else{
               return redirect()->route('home');
          }      
    }

    public function GenUrl(Request $request){
          $id_kandidat = $request->id_kandidat;
          $noidentitas = $request->noidentitas;
          $date = Carbon::now();
          $join = $id_kandidat.$noidentitas.$date;
          $url = base64_encode($join);
          
          $result = DB::table('T_linkPhase2')
                    ->where('id_Tkandidat',$id_kandidat)
                    ->first();
          if($result){
               DB::table('T_linkPhase2')
                    ->where('id_Tkandidat',$id_kandidat)
                    ->update([
                         'openlink'=>Carbon::now(),
                         'closelink'=>null,
                         'url'=>$url,
                         'active'=>1,
                         'deleted'=>0
                    ]);
               // HAPUS SEMUA TBALE YANG MSUK PHASE2
               DB::select('EXEC SP_Clear_FormPhase2  ?',array($id_kandidat));
          }else{
               // return 'tdk ada';
               DB::table('T_linkPhase2')
               ->insert([
                    'id_Tkandidat'=>$id_kandidat,
                    'openlink'=>Carbon::now(),
                    'closelink'=>null,
                    'url'=>$url,
                    'active'=>1,
                    'deleted'=>0
               ]);
          }
          return $url;
    }

    public function GetSim($id){
        $sim = DB::table('T_kandidat_sim')
            ->where('id_Tkandidat',$id)
            ->get();

        $list_sim = DB::table('M_SIM')
                ->where('active',1)
                ->where('deleted',0)
                ->where('id','<>',1)
                ->get();

        if (!in_array(session()->get('user')['dept'], $this->idDeptHR)) {
            $disabled=true;
        }else{
            $disabled=false;
        }
        return [$sim,$list_sim,$disabled];
    }

    public function GetPendidikan($id){
          $pendidikan = DB::table('T_kandidat_edukasi')
                         ->where('id_Tkandidat',$id)
                         ->orderBy('urutan','asc')
                         ->get();
          $jurusan_sma = DB::table('M_SMASederajat')
                         ->where('jenis','SMA')
                         ->where('active',1)
                         ->where('deleted',0)
                         ->get();
          $jurusan_sederajat = DB::table('M_SMASederajat')
                              ->where('jenis','Sederajat')
                              ->where('active',1)
                              ->where('deleted',0)
                              ->get();
            if (!in_array(session()->get('user')['dept'], $this->idDeptHR)) {
            $disabled=true;
            }else{
                $disabled=false;
            }
          return [$pendidikan,$jurusan_sma,$jurusan_sederajat,$disabled];
    }

    public function GetPekerjaan($id){
          $pekerjaan = DB::table('T_kandidat_pekerjaan')
                         ->where('id_Tkandidat',$id)
                         ->get();
        if (!in_array(session()->get('user')['dept'], $this->idDeptHR)) {
            $disabled=true;
        }else{
                $disabled=false;
        }
          return [$pekerjaan,$disabled];
    }

    public function GetPelatihan($id){
          $Pelatihan = DB::table('T_pelatihan')
                         ->where('id_Tkandidat',$id)
                         ->get();
        if (!in_array(session()->get('user')['dept'], $this->idDeptHR)) {
        $disabled=true;
        }else{
                $disabled=false;
        }
          return [$Pelatihan,$disabled];
    }

    public function GetBahasa($id){
          $bahasa = DB::table('T_bahasa')
                         ->where('id_Tkandidat',$id)
                         ->get();
            if (!in_array(session()->get('user')['dept'], $this->idDeptHR)) {
            $disabled=true;
            }else{
                    $disabled=false;
            }
          return [$bahasa,$disabled];
    }

    public function GetOrganisasi($id){
           $organisasi = DB::table('T_organisasi')
                         ->where('id_Tkandidat',$id)
                         ->get();
            if (!in_array(session()->get('user')['dept'], $this->idDeptHR)) {
            $disabled=true;
            }else{
                    $disabled=false;
            }
          return [$organisasi,$disabled];
    }

    public function GetKenal($id){
          $kenal = DB::table('T_kenal')
          ->where('id_Tkandidat',$id)
          ->get();
          if (!in_array(session()->get('user')['dept'], $this->idDeptHR)) {
            $disabled=true;
            }else{
                    $disabled=false;
            }
          return [$kenal,$disabled];
    }

     public function GetKerabat($id){
          $kerabat = DB::table('T_Kerabat')
               ->where('id_Tkandidat',$id)
               ->get();
            if (!in_array(session()->get('user')['dept'], $this->idDeptHR)) {
            $disabled=true;
            }else{
                    $disabled=false;
            }
          return [$kerabat,$disabled];
     }

     public function GetKeluarga($id){
          $ayahIbu = DB::table('T_keluarga')
                    ->where('id_Tkandidat',$id)
                    ->whereIn('statusKeluarga',['Ayah','Ibu'])
                    ->get();

          $ayahIbuMertua = DB::table('T_keluarga')
                         ->where('id_Tkandidat',$id)
                         ->whereIn('statusKeluarga',['Ayah Mertua','Ibu Mertua'])
                         ->get();

          $kakakAdik = DB::table('T_keluarga')
                    ->where('id_Tkandidat',$id)
                    ->where('statusKeluarga','LIKE','%Kaka/Adik%')
                    ->get();
          
          $suamiIstri = DB::table('T_keluarga')
                    ->where('id_Tkandidat',$id)
                    ->where('statusKeluarga','Suami/Istri')
                    ->get();

          $anak = DB::table('T_keluarga')
                    ->where('id_Tkandidat',$id)
                    ->where('statusKeluarga','LIKE','%Anak%')
                    ->get();

          $alamtkeluarga = DB::table('T_alamatKeluarga')
                         ->where('id_Tkandidat',$id)
                         ->get();
            if (!in_array(session()->get('user')['dept'], $this->idDeptHR)) {
                $disabled=true;
            }else{
                $disabled=false;
            }
          return [$ayahIbu,$ayahIbuMertua,$kakakAdik,$suamiIstri,$anak,$alamtkeluarga,$disabled];
     }
    
     //kebutuhan tambah data
    public function ListSim(){
     $list_sim = DB::table('M_SIM')
               ->where('active',1)
               ->where('deleted',0)
               ->where('id','<>',1)
               ->get();
     return $list_sim;
    }

    //KONTEN EMAIL
    public function GetKonten(Request $request){
        $isi_konten = DB::table('konten')
                    ->select('konten')
                    ->where('id_Organisasi',session()->get('user')['organisasi'])
                    ->where('jenis',$request->schedule)
                    ->where('online',$request->online)
                    ->where('id_Organisasi',$request->organisasi)
                    ->where('konfirmasi',$request->konfirmasi)
                    ->where('to','kandidat')
                    ->get();
        return $isi_konten;
    }


    //update
     // untuk yang atas
    public function UpdateForm1(Request $request){
          DB::table('T_kandidat')
          ->where('id',$request->id_kandidat)
          ->update([
               'namalengkap'=>$request->namalengkap,
               'gender'=>$request->gender,
               'status_perkawinan'=>$request->status_perkawinan,
               'noidentitas'=>$request->noidentitas,
               'npwp'=>$request->npwp,
               'nohp'=>$request->nohp,
               'email'=>$request->email,
               'tempatlahir'=>$request->tempatlahir,
               'tgllahir'=>$request->tgllahir,
               'urlPorto'=>$request->porto
          ]);
          return Redirect::back();
    }
     //untuk yang bawah
    public function UpdateForm1_1(Request $request){
    // dd($request);
     DB::beginTransaction();
     try {
          DB::table('T_kandidat')
          ->where('id',$request->id_kandidat2)
          ->update([
               'alamatlengkap'=>$request->alamatlengkap,
               'rumahmilik'=>$request->rumahmilik,
               'kota1'=>$request->kota1,
               'kodepos'=>$request->kodepos,
               'alamat_koresponden'=>$request->alamat_koresponden,
               'rumahmilik_koresponden'=>$request->rumahmilik_koresponden,
               'kota_koresponden'=>$request->kota_koresponden,
               'kodepos_koresponden'=>$request->kodepos_koresponden,
               'gaji'=>$request->gaji,
               'tunjangan'=>$request->tunjangan,
               'tanggungjawab'=>$request->tanggungjawab,
               'jabatanharapan'=>$request->jabatanharapan,
               'gajiharapan'=>$request->gajiharapan,
               'tujanganharapan'=>$request->tujanganharapan,
               'bertugasluarkota'=>$request->bertugasluarkota,
               'ditempatkanluarkota'=>$request->ditempatkanluarkota,
          ]);

          // SIM
            DB::table('T_kandidat_sim')->where('id_Tkandidat',$request->id_kandidat2)->delete();
            if(!empty($request->sim)){
                for ($i=0; $i <count($request->sim) ; $i++) { 
                    if ($request->sim[$i]!=1) {
                        DB::table('T_kandidat_sim')
                                ->insert([
                                    'id_Tkandidat'=>$request->id_kandidat2,
                                    'sim'=> $request->sim[$i],
                                    'nosim'=> $request->nosim[$i],
                        ]);
                    }
                }
            }

            DB::table('T_kandidat_edukasi')->where('id_Tkandidat',$request->id_kandidat2)->delete();
            if (!empty($request->namasekolah)) {
                $pendidikan_ = ['SD','SLTP','SMA','Akademi','S1','S2'];
                for ($j=0; $j <count($request->namasekolah) ; $j++) {
                    $namasekolah = trim($request->namasekolah[$j],''); 
                    $jurusan = trim($request->jurusan[$j],''); 
                    $kota = trim($request->kota[$j],''); 
                    $tahun = trim($request->tahun[$j],''); 

                    if (!empty($namasekolah)||!empty($jurusan)||!empty($kota)||!empty($tahun)) {
                        DB::table('T_kandidat_edukasi')
                            ->insert([
                                'id_Tkandidat'=>$request->id_kandidat2,
                                'urutan'=>$j+1,
                                'pendidikan'=>$pendidikan_[$j],
                                'namaSekolah'=>$namasekolah,
                                'jurusan'=>$jurusan,
                                'kota'=>$kota,
                                'tahun'=>$tahun,
                            ]);
                    }
                }
            }
          
        
        DB::table('T_kandidat_pekerjaan')->where('id_Tkandidat',$request->id_kandidat2)->delete();
        if(!empty($request->nama_perushaan)){
            for ($k=0; $k <count($request->nama_perushaan) ; $k++) { 
                $namaperusahaan = trim($request->nama_perushaan[$k],'');
                $alamatperushaan = trim($request->alamat_perusahaan[$k],''); 
                $jabatanperusahaan = trim($request->jabatan_perusahaan[$k],''); 
                $atasanperusahaan = trim($request->atasan_perusahaan[$k],''); 
                $startperusahaan = trim($request->start_perusahaan[$k],''); 
                
                // if(empty($request->end_perusahaan[$k])){
                //     $endperusahaan = null;
                //     $tahun=null;
                //     $bulan=null;
                //     $hari=null;
                // }else{
                //     $endperusahaan = $request->end_perusahaan[$k];
                //     $start = Carbon::parse($startperusahaan);
                //     $end = Carbon::parse( $endperusahaan);
                //     $lama = $start->diff($end)->format('%y-%m-%d');
                //     $rslt = explode("-",$lama);
                //     $tahun = null;
                //     $bulan = null;
                //     $hari = null;
                // }

                if (!empty($namaperusahaan)&&!empty($alamatperushaan)&&!empty($jabatanperusahaan)&&!empty($atasanperusahaan)) {
                    DB::table('T_kandidat_pekerjaan')
                        ->insert([
                            'id_Tkandidat'=>$request->id_kandidat2,
                            'namaPerusahaan'=>$namaperusahaan,
                            'jenisPerusahaan'=>$request->jenis_perusahaan[$k],
                            'alamatPerusahaan'=>$alamatperushaan,
                            'jabatanPerusahaan'=>$jabatanperusahaan,
                            'atasanPerusahaan'=>$atasanperusahaan,
                            'tahunPerusahaan'=>0,
                            'startPerushaan'=>$startperusahaan,
                            'endPerushaan'=>$request->end_perusahaan[$k],
                            'tahun'=>null,
                            'bulan'=>null,
                            'hari'=>null
                        ]);
                }
            }
        }
          DB::commit();
          return Redirect::back();
     } catch (Exception $e) {
          DB::rollBack();
          return Redirect::back()->with('error', $e);
     }
          
    }

    public function UpdateForm2(Request $request){
          // dd($request);

          $id_kandidat = $request->id_kandidat3;

          DB::table('T_kandidat2')
               ->where('id_Tkandidat',$id_kandidat)
               ->update([
                    'golDarah'=>$request->goldarah,
                    'noTlp'=>$request->tlprumah,
                    'prestasiPendidikan'=>$request->prestasi,
                    'tulisanIlmiah'=>$request->karyailmiah,
                    'kegiatan'=>$request->waktuluang,
                    'suratKabar'=>$request->suratkabar,
                    'topik'=>$request->topik,
                    'alasanMelamar'=>$request->alasan,
                    'lingkunganKerja'=>$request->lingkungankerja,
                    'sakit'=>$request->sakit,
                    'tahunSakit'=>$request->sakitkapan,
                    'psikologis'=>$request->psikologis,
                    'tahunPsikolog'=>$request->psikologiskapan,
                    'lembagaPsikolog'=>$request->psikologislembaga,
                    'tujuanPsikolog'=>$request->psikologistujuan,
                    'jenisKendaraan'=>$request->kendaraan,
                    'milikKendaraan'=>$request->kendaraanmilik,
                    'kerabatFarmasi'=>$request->kerabat,
                    'updated_at'=>carbon::now()
               ]);
          
          DB::table('T_pelatihan')->where('id_Tkandidat',$id_kandidat)->delete();
          if(!empty($request->jenis_pelatihan)){
               for ($k=0; $k <count($request->jenis_pelatihan) ; $k++) { 
                    $jenispelatihan = trim($request->jenis_pelatihan[$k],''); 
                    $penyelenggarapelatihan = trim($request->penyelenggara_pelatihan[$k],''); 
                    $tahunpelatihan = trim($request->tahun_pelatihan[$k],''); 
                    // dd($jenispelatihan,$penyelenggarapelatihan,$tahunpelatihan);
                    if (!empty($jenispelatihan)&&!empty($penyelenggarapelatihan)&&!empty($tahunpelatihan)) {
                         
                         DB::table('T_pelatihan')
                              ->insert([
                                   'id_Tkandidat'=>$id_kandidat, //$request->kandidat
                                   'jenisPlthn'=>$jenispelatihan,
                                   'penyelenggaraPlthn'=>$penyelenggarapelatihan,
                                   'tahunPlthn'=>$tahunpelatihan
                              ]);
                    }
               
               }
               
          }

          DB::table('T_organisasi')->where('id_Tkandidat',$id_kandidat)->delete();
          if(!empty($request->nama_organisasi)){
               for ($k=0; $k <count($request->nama_organisasi) ; $k++) { 
                   $namaorganisasi = trim($request->nama_organisasi[$k],''); 
                   $kotaorganisasi = trim($request->kota_organisasi[$k],''); 
                   $jabatanorganisasi = trim($request->jabatan_organisasi[$k],''); 
                   $tahunorganisasi = trim($request->tahun_organisasi[$k],''); 
                   
                   if (!empty($namaorganisasi)&&!empty($kotaorganisasi)&&!empty($jabatanorganisasi)&&!empty($tahunorganisasi)) {
                       DB::table('T_organisasi')
                           ->insert([
                               'id_Tkandidat'=>$id_kandidat, //$request->kandidat
                               'namaOrg'=>$namaorganisasi,
                               'kotaOrg'=>$kotaorganisasi,
                               'jabatanOrg'=>$jabatanorganisasi,
                               'tahunOrg'=>$tahunorganisasi
                           ]);
                   }
               }
               
          }

          DB::table('T_Kerabat')->where('id_Tkandidat',$id_kandidat)->delete();
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
                               'id_Tkandidat'=>$id_kandidat,//$request->kandidat
                               'hubunganKrbt'=>$hubungansaudara,
                               'namaKrbt'=>$namasaudara,
                               'genderKrbt'=>$gendersaudara,
                               'nmperusahaanKrbt'=>$perusahaansaudara,
                               'jabatanKrbt'=>$jabatansaudara
                           ]);
                   }
               }
               
          }

          DB::table('T_kenal')->where('id_Tkandidat',$id_kandidat)->delete();
          if(!empty($request->nama_kenal)){
               for ($k=0; $k <count($request->nama_kenal) ; $k++) { 
                   $namakenal = trim($request->nama_kenal[$k],''); 
                   $hubungankenal = trim($request->hubungan_kenal[$k],''); 

                   if (!empty($namakenal)&&!empty($hubungankenal)) {
                       DB::table('T_kenal')
                           ->insert([
                               'id_Tkandidat'=>$id_kandidat,//$request->kandidat
                               'namaKenalan'=>$namakenal,
                               'hubunganKenalan'=>$hubungankenal
                           ]);
                   }
               }
               
           }

          DB::table('T_refrensi')->where('id_Tkandidat',$id_kandidat)->delete();
          if(!empty($request->nama_referensi)){
               for ($k=0; $k <count($request->nama_referensi) ; $k++) { 
                   $namaref = trim($request->nama_referensi[$k],''); 
                   $alamatref = trim($request->alamat_referensi[$k],''); 
                   $pekerjaanref = trim($request->pekerjaan_referensi[$k],''); 
                   $tlpref = trim($request->tlp_referensi[$k],''); 
                   
                   if (!empty($namaref)&&!empty($alamatref)&&!empty($alamatref)&&!empty($pekerjaanref)&&!empty($tlpref)) {
                       DB::table('T_refrensi')
                           ->insert([
                               'id_Tkandidat'=>$id_kandidat,
                               'namaRef'=>$namaref,
                               'alamatRef'=>$alamatref,
                               'pekerjaanRef'=>$pekerjaanref,
                               'tlpRef'=>$tlpref
                           ]);
                   }
               }
               
           }

           DB::table('T_darurat')->where('id_Tkandidat',$id_kandidat)->delete();
           if(!empty($request->nama_kontakdarurat)){
               for ($k=0; $k <count($request->nama_kontakdarurat) ; $k++) { 
                   $namadarurat = trim($request->nama_kontakdarurat[$k],''); 
                   $alamatdarurat = trim($request->alamat_kontakdarurat[$k],''); 
                   $tlpdarurat = trim($request->tlp_kontakdarurat[$k],''); 
                   
                   if (!empty($namadarurat)&&!empty($alamatdarurat)&&!empty($tlpdarurat)) {
                       DB::table('T_darurat')
                           ->insert([
                               'id_Tkandidat'=>$id_kandidat,
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

            DB::table('T_keluarga')->where('id_Tkandidat',$id_kandidat)->delete();
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
                            'id_Tkandidat'=>$id_kandidat,
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

            DB::table('T_alamatKeluarga')->where('id_Tkandidat',$id_kandidat)->delete();
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
                                'id_Tkandidat'=>$id_kandidat,
                                'statusAlamat'=>$status,
                                'alamatKeluarga'=>$alamatkeluarga,
                                'tlpKeluarga'=>$tlpkeluarga
                            ]);
                        }
                }
                
            }

            DB::table('T_bahasa')->where('id_Tkandidat',$id_kandidat)->delete();
            if(!empty($request->bahasa)){
               for ($k=0; $k <count($request->bahasa) ; $k++) { 
                   $bahasa = trim($request->bahasa[$k],''); 
                   $berbicara = trim($request->berbicara[$k],''); 
                   $menulis = trim($request->menulis[$k],''); 
                   $membaca = trim($request->membaca[$k],''); 
                   
                   if (!empty($bahasa)&&!empty($berbicara)&&!empty($menulis)&&!empty($membaca)) {
                       DB::table('T_bahasa')
                           ->insert([
                               'id_Tkandidat'=>$id_kandidat, //$request->kandidat
                               'bahasa'=>$bahasa,
                               'berbicara'=>$berbicara,
                               'menulis'=>$menulis,
                               'membaca'=>$membaca
                           ]);
                   }
               }
               
           }

          return Redirect::back();
    }

    public function GetSchedule($id){
        $list_schedule=DB::select('EXEC SP_Get_Schedule  ?',array($id));
        // $list_schedule=DB::table('T_LogKandidat')
        //                 ->select('')
        //                 ->where('id_Tkandidat',$id)
        //                 ->get();
        return $list_schedule;
    }

    public function SetSchedule(Request $request){
        
        if ($request->ccTo>0) {
            // $email_raw=implode('","',$request->ccTo);
            // $email = '"'.$email_raw.'"';
            $email=implode(',',$request->ccTo);
            // $email = '"'.$email_raw.'"';
        }else{
            $email=NULL;
        }
        // return $email_raw;
        // if ($request->detail>0) {
        //     $detail="'"+$request->detail+"'";
        // }else{
        //     $detail=NULL;
        // }
        $waktu = str_replace("T"," ",$request->tglWaktu);
        $date = Carbon::createFromFormat('Y-m-d H:i', $waktu)->format('Y-m-d H:i');

        $id_email= DB::table('T_LogKandidat')
            ->insertGetId([
                'id_Tkandidat'=>$request->id_kandidat,
                'id_Rekrutmen'=>$request->schedule,
                'id_Organisasi'=>session()->get('user')['organisasi'],
                'jadwal'=>$date,
                'ccEmail'=>$email,
                'sendEmail'=>NULL,
                'Summary'=>NULL,
                'Notes'=>NULL,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>NULL,
                'jenis'=>$request->online,
                'test'=>json_encode($request->detail)
            ]);
        return $id_email;
    }

    public function SetGSchedule(Request $request){
        if ($request->ccTo>0) {
            // $email_raw=implode('","',$request->ccTo);
            // $email = '"'.$email_raw.'"';
            $email=implode(',',$request->ccTo);
            // $email = '"'.$email_raw.'"';
        }else{
            $email=NULL;
        }
        $waktu = str_replace("T"," ",$request->tglWaktu);
        $date = Carbon::createFromFormat('Y-m-d H:i', $waktu)->format('Y-m-d H:i');
        foreach ($request->arrId_kandidat as $key => $value) {
            $id_Tlog = DB::table('T_LogKandidat')
                ->insertGetId([
                    'id_Tkandidat'=>$value,
                    'id_Rekrutmen'=>$request->schedule,
                    'id_Organisasi'=>session()->get('user')['organisasi'],
                    'jadwal'=>$date,
                    'ccEmail'=>$email,
                    'sendEmail'=>NULL,
                    'Summary'=>NULL,
                    'Notes'=>NULL,
                    'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'=>NULL,
                    'jenis'=>$request->online,
                    'test'=>json_encode($request->detail)
                ]);

            DB::table('T_logkandidat_group')
                ->insert([
                    'id_Tlogkandidat'=>$id_Tlog,
                    'namaGroup'=>$request->namagroup,
                    'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                ]);
        }
        return $request->namagroup;
    }

    public function SendEmail (Request $request){
        // return $request;
        $schedule=$request->schedule;
        $email_raw = DB::table('T_kandidat')
                ->select('email')
                ->where('id',$request->id_kandidat)
                ->get();
        $email = $email_raw[0]->email; 
        if ($schedule==2) {
            $subject = 'MCU';
            if ($request->id_lab!="") {
                $lab = DB::table('M_vendor')
                    ->select('NamaLab','alamat')
                    ->where('id',$request->id_lab)
                    ->where('jenis','MCU')
                    ->get();

                $konten= str_replace(["[CLINIC’s / LAB’s NAME]","[CLINIS’s / LAB’s ADDRESS]"],[$lab[0]->NamaLab,$lab[0]->alamat],$request->konten);
            }else{
                $konten = $request->konten;
            }
                
        } else if($schedule==3) {
            $konten = $request->konten;
            $subject = 'Psikotest';
        } else if($schedule==4){
            $konten = $request->konten;
            $subject = 'tech test';
        }else if($schedule==5){
            $konten = $request->konten;
            $subject = 'interview HR';
        }else if($schedule==6){
            $konten = $request->konten;
            $subject = 'interview User';
        }else if($schedule==9){
            $konten = $request->konten;
            $subject = 'offer';
        }
        
        
        Mail::raw($konten, function ($message) use ($email,$subject) {
            
            $message
            ->from('mantap@domain.com') //ini buat pengirim
            ->to($email)
            ->cc('kwjwkwkwk@gmail.com')
            ->subject($subject);
        });

        DB::table('T_LogKandidat')
            ->where('id',$request->id_email)
            ->update([
                'sendEmail'=>1
            ]);
        $send = 'Yes';

        return $send;
    }

    public function SendGEmail(Request $request){
        // return $request->id_group;
        $schedule=$request->schedule;
        $namagroup = $request->id_group;
        $info_kandiat = DB::table('T_kandidat as A')
                        ->select('namalengkap','email','C.nama')
                        ->join('T_link as B','B.id','A.id_Tlink')
                        ->join('M_Job as C','C.id','B.id_Tjob')
                        ->whereIn('A.id',$request->arrId_kandidat)
                        ->get();
        $array1=[];
        $array2=array();
        if ($schedule==2) {
            $subject = 'MCU';
            $lab = DB::table('M_vendor')
                    ->select('NamaLab','alamat')
                    ->where('id',$request->id_lab)
                    ->where('jenis','MCU')
                    ->get();
            
            
            foreach ($info_kandiat as $key => $value) {
                $konten= str_replace(["[CLINIC’s / LAB’s NAME]","[CLINIS’s / LAB’s ADDRESS]","[CANDIDAT NAME]","[POSITION]"],[$lab[0]->NamaLab,$lab[0]->alamat,$value->namalengkap,$value->nama],$request->konten);
                $array2["email"]=$value->email;
                $array2["konten"]=$konten;
                array_push($array1,$array2);
            }
        }
         else if($schedule==3) {
            $subject = 'Psikotest';

            foreach ($info_kandiat as $key => $value) {
                $konten= str_replace(["[CANDIDAT NAME]","[POSITION]"],[$value->namalengkap,$value->nama],$request->konten);
                $array2["email"]=$value->email;
                $array2["konten"]=$konten;
                array_push($array1,$array2);
            }
        } 
        else if($schedule==4){
            $subject = 'tech test';
            foreach ($info_kandiat as $key => $value) {
                $konten= str_replace(["[CANDIDAT NAME]","[POSITION]"],[$value->namalengkap,$value->nama],$request->konten);
                $array2["email"]=$value->email;
                $array2["konten"]=$konten;
                array_push($array1,$array2);
            }
        }
        else if($schedule==5){
            $subject = 'interview HR';
            foreach ($info_kandiat as $key => $value) {
                $konten= str_replace(["[CANDIDAT NAME]","[POSITION]"],[$value->namalengkap,$value->nama],$request->konten);
                $array2["email"]=$value->email;
                $array2["konten"]=$konten;
                array_push($array1,$array2);
            }
        }else if($schedule==6){
            $subject = 'interview User';
            foreach ($info_kandiat as $key => $value) {
                $konten= str_replace(["[CANDIDAT NAME]","[POSITION]"],[$value->namalengkap,$value->nama],$request->konten);
                $array2["email"]=$value->email;
                $array2["konten"]=$konten;
                array_push($array1,$array2);
            }
        }else if($schedule==9){
            $subject = 'offer';
            foreach ($info_kandiat as $key => $value) {
                $konten= str_replace(["[CANDIDAT NAME]","[POSITION]"],[$value->namalengkap,$value->nama],$request->konten);
                $array2["email"]=$value->email;
                $array2["konten"]=$konten;
                array_push($array1,$array2);
            }
        }
        // $id_Tlog = DB::table('T_logkandidat_group')
        //             // ->select('id_Tlogkandidat')
        //             ->where('namaGroup',$request->namagroup)
        //             ->pluck('id_Tlogkandidat');
        // $id_kandiat = DB::table('T_logkandidat')
        //                 ->select('id_Tkandidat','id_Rekrutmen','id_Organisasi','jenis')
        //                 ->whereIn('id', $id_Tlog)
        //                 ->get();

        foreach ($array1 as $key => $value) {
            // return $value["email"];
            $email = $value["email"];
            $konten = $value["konten"];
            // return $konten;
            Mail::raw($konten, function ($message) use ($email,$subject) {
                $message
                ->to($email)
                ->cc('kwjwkwkwk@gmail.com')
                ->subject($subject);
            });
        }
        $id_log = DB::table('T_logkandidat_group')
                ->where('namaGroup',$namagroup)
                ->pluck('id_Tlogkandidat');
        DB::table('T_logkandidat')
            ->whereIn('id', $id_log)
            ->update([
                'sendEmail'=>1
            ]);
            
        return $id_log;
    }

    public function GetNotes($id){
        $notes = DB::table('T_LogKandidat')
                -> select('Summary','notes')
                ->where('id',$id)
                ->get();
        return $notes;
    }

    public function ShowDetailEmail($id){
        $data = DB::table('T_LogKandidat')
                ->where('id',$id)
                ->get();
        return $data;
    }

    public function EditSchedule(Request $request){
        $id = $request->id;
        if ($request->ccTo>0) {
            $email=implode(',',$request->ccTo);
        }else{
            $email=NULL;
        }
        $waktu = str_replace("T"," ",$request->tglWaktu);
        $date = Carbon::createFromFormat('Y-m-d H:i', $waktu)->format('Y-m-d H:i');

        DB::table('T_LogKandidat')
            ->where('id',$id)
            ->update([
                'ccEmail'=>$email,
                'jadwal'=>$date,
                'test'=>json_encode($request->detail)
            ]);
        return true;
    }

    public function SetNotes(Request $request){
        DB::table('T_LogKandidat')
            ->where('id',$request->id)
            ->update([
                'summary'=>$request->summary,
                'notes'=>$request->notes
            ]);
        return true;
    }

    public function Showlog($id){
        $result = DB::table('T_logFPTK')
                ->where('id_TKandidat',$id)
                ->get();
        return $result;
    }
}
