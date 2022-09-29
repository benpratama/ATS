<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KandidatController extends Controller
{
    public function index($id,$noidentitas){
          // dd($server);
          $info_kandidat = DB::table('T_kandidat')
                    ->where('id',$id)
                    ->where('noidentitas',$noidentitas)
                    ->first();

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
                         
                         // phase2
                         'info_kandidat2' => $infokandidat2,
                         'referensi'=>$referensi,
                         'darurat'=>$darurat
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
     return [$sim,$list_sim];
    }

    public function GetPendidikan($id){
          $pendidikan = DB::table('T_kandidat_edukasi')
                         ->where('id_Tkandidat',$id)
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
          return [$pendidikan,$jurusan_sma,$jurusan_sederajat];
    }

    public function GetPekerjaan($id){
          $pekerjaan = DB::table('T_kandidat_pekerjaan')
                         ->where('id_Tkandidat',$id)
                         ->get();
          return $pekerjaan;
    }

    public function GetPelatihan($id){
          $Pelatihan = DB::table('T_pelatihan')
                         ->where('id_Tkandidat',$id)
                         ->get();
          return $Pelatihan;
    }

    public function GetBahasa($id){
          $bahasa = DB::table('T_bahasa')
                         ->where('id_Tkandidat',$id)
                         ->get();
          return $bahasa;
    }

    public function GetOrganisasi($id){
           $organisasi = DB::table('T_organisasi')
                         ->where('id_Tkandidat',$id)
                         ->get();
          return $organisasi;
    }

    public function GetKenal($id){
          $kenal = DB::table('T_kenal')
          ->where('id_Tkandidat',$id)
          ->get();
          return $kenal;
    }

     public function GetKerabat($id){
          $kerabat = DB::table('T_Kerabat')
               ->where('id_Tkandidat',$id)
               ->get();
          return $kerabat;
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

          return [$ayahIbu,$ayahIbuMertua,$kakakAdik,$suamiIstri,$anak,$alamtkeluarga];
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

          DB::table('T_kandidat_edukasi')->where('id_Tkandidat',$request->id_kandidat2)->delete();

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

          DB::table('T_kandidat_pekerjaan')->where('id_Tkandidat',$request->id_kandidat2)->delete();
          if(!empty($request->nama_perushaan)){
               for ($k=0; $k <count($request->nama_perushaan) ; $k++) { 
               $namaperusahaan = trim($request->nama_perushaan[$k],''); 
               $alamatperushaan = trim($request->alamat_perusahaan[$k],''); 
               $jabatanperusahaan = trim($request->jabatan_perusahaan[$k],''); 
               $atasanperusahaan = trim($request->atasan_perusahaan[$k],''); 
               $lamaperusahaan = trim($request->lama_perusahaan[$k],''); 
               $startperusahaan = trim($request->start_perusahaan[$k],''); 
               $endperusahaan = trim($request->end_perusahaan[$k],'');
                    if(empty($request->end_perusahaan[$k])){
                    $endperusahaan = null;
                    $tahun=null;
                    $bulan=null;
                    $hari=null;
                    }else{
                    $endperusahaan = $request->end_perusahaan[$k];
                    $start = Carbon::parse($startperusahaan);
                    $end = Carbon::parse( $endperusahaan);
                    $lama = $start->diff($end)->format('%y-%m-%d');
                    $rslt = explode("-",$lama);
                    $tahun = $rslt[0];
                    $bulan = $rslt[1];
                    $hari = $rslt[2];
                    }

               if (!empty($namaperusahaan)&&!empty($alamatperushaan)&&!empty($jabatanperusahaan)&&!empty($atasanperusahaan)) {


                    DB::table('T_kandidat_pekerjaan')
                         ->insert([
                              'id_Tkandidat'=>$request->id_kandidat2,
                              'namaPerusahaan'=>$namaperusahaan,
                              'jenisPerusahaan'=>$request->jenis_perusahaan[$k],
                              'alamatPerusahaan'=>$alamatperushaan,
                              'jabatanPerusahaan'=>$jabatanperusahaan,
                              'atasanPerusahaan'=>$atasanperusahaan,
                              'tahunPerusahaan'=>$lamaperusahaan,
                              'startPerushaan'=>$startperusahaan,
                              'endPerushaan'=>$endperusahaan,
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
          return Redirect::back();
    }
}
