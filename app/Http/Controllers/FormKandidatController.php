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
use Illuminate\Support\Facades\Mail;

class FormKandidatController extends Controller
{

    public function ShowFormjf($url){
        $date = Carbon::now()->format('Y-m-d H:i');
        $result = DB::table('T_link')
            ->where('url',$url)
            ->where('openlink','<=',$date)
            ->where('closelink','>=',$date)
            ->where('active','1')
            ->where('jobfair',1)
            ->where('deleted',0)
            ->first();

        //data
        $state = DB::table('PMState')
                ->select('StateId','StateName')
                ->where('CountryId',115)
                ->get();
        $city = DB::table('PMCity')
                ->select('CityId','CityName')
                ->where('CityCountryId',115)
                ->get();
        // $institusi = DB::table('PMEduInstitution')
        //             ->select('EduInsId','EduInsName')
        //             ->get();
        // $major = DB::table('PMEduMajor')
        //             ->select('EduMjrId','EduMjrName')
        //             ->get();
        if (!$result){
            return abort(404);
        }else{
            // dd($result);
            return view('form kandidat/formjobfair',['States'=>$state,'Citys'=>$city,'idlink'=>$result->id]);
        }
    }

    public function ShowForm1($url){
        
        $date = Carbon::now()->format('Y-m-d H:i');
        $result = DB::table('T_link')
                ->where('url',$url)
                ->where('openlink','<=',$date)
                ->where('closelink','>=',$date)
                ->where('active','1')
                ->where('deleted',0)
                ->first();
        $cekphase1 = DB::table('T_linkPhase1')
                ->where('url',$url)
                ->where('openlink','<=',$date)
                ->where('active','1')
                ->where('deleted',0)
                ->first();
        if (!$result and !$cekphase1){
            return abort(404);
        }elseif($result !=null and !$cekphase1){
            $SIM = DB::table('M_SIM')
                    ->select('id','nama')
                    ->where('deleted',0)
                    ->where('active',1)
                    ->get();

            // $pernikahan = DB::table('M_Statuspernikahan')
            //             ->select('nama','keterangan')
            //             ->where('deleted',0)
            //             ->where('active',1)
            //             ->get();

            $pernikahan = DB::table('PmMaritalSt')
                        ->select('MaritalStId','MaritalSt')
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
            // $Domisili = DB::table('M_kodepos_Final')
            //             ->distinct()
            //             ->select('kabupaten')
            //             ->where('deleted',0)
            //             ->where('active',1)
            //             ->get();
            $Domisili=DB::table('PMCity')
                        ->select('CityId','CityName')
                        ->where('CityCountryId',115)
                        ->get();
            $url = DB::table('T_link')
                        ->where('url',$url)
                        ->select('id','id_Organisasi')
                        ->first();      
            // $Tempatlahir = DB::table('M_kodepos_Final')
            //             ->distinct()
            //             ->select('provinsi')
            //             ->where('deleted',0)
            //             ->where('active',1)
            //             ->get();
            
            $Tempatlahir = DB::table('PMState')
                            ->select('StateId','StateName')
                            ->where('CountryId',115)
                            ->get();

            $status = DB::table('PmHouseStatus')
                        ->select('HouseStatusId','HouseStatus')
                        ->get();

            $city = DB::table('PMCity')
                    ->select('CityId','CityName')
                    ->where('CityCountryId',115)
                    ->get();

            return view('form kandidat/formkandidat',
                    [   
                        'SIM'=>$SIM,
                        'Pernikahan'=>$pernikahan,
                        'SMA'=>$SMA,
                        'Sederajat'=>$Sederajat,
                        'Domisili' =>$Domisili,
                        'URL' =>$url,
                        'TempatLahir'=>$Tempatlahir,
                        'Status'=>$status,
                        'Citys'=>$city,
                        'jobfair'=>false
                    ]);
        }elseif (!$result and $cekphase1!=null) {
            // =========== DATA JOBFAIR ============
            $id = $cekphase1->id_Tkandidat;
            $info_kandidat = DB::table('T_kandidat_N')
                            ->where('id',$id)
                            ->get();         

            $info_kota_ktp = DB::table('T_kandidat_card_N')
                            ->where('id_Tkandidat',$id)
                            ->where('cardType',57)
                            ->pluck('publisher');
            $info_phone =DB::table('T_kandidat_phone_N')
                        ->where('id_Tkandidat',$id)
                        ->get();
            $info_email = DB::table('T_kandidat_email_N')
                        ->where('id_Tkandidat',$id)
                        ->get();
            $info_sim = DB::table('T_kandidat_card_N')
                        ->where('id_Tkandidat',$id)
                        ->where('cardType','<>',57)
                        ->get();
            // $info_pendidikan = DB::table('T_kandidat_pendidikan_N')
            //                 ->where('id_Tkandidat',$id)
            //                 ->get();

            // dd($info_email);
            // =====================================

            
            $SIM = DB::table('M_SIM')
                    ->select('id','nama')
                    ->where('deleted',0)
                    ->where('active',1)
                    ->get();

            // $pernikahan = DB::table('M_Statuspernikahan')
            //             ->select('nama','keterangan')
            //             ->where('deleted',0)
            //             ->where('active',1)
            //             ->get();

            $pernikahan = DB::table('PmMaritalSt')
                        ->select('MaritalStId','MaritalSt')
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
            // $Domisili = DB::table('M_kodepos_Final')
            //             ->distinct()
            //             ->select('kabupaten')
            //             ->where('deleted',0)
            //             ->where('active',1)
            //             ->get();
            $Domisili=DB::table('PMCity')
                        ->select('CityId','CityName')
                        ->where('CityCountryId',115)
                        ->get();
                        
            // $Tempatlahir = DB::table('M_kodepos_Final')
            //             ->distinct()
            //             ->select('provinsi')
            //             ->where('deleted',0)
            //             ->where('active',1)
            //             ->get();
            
            $Tempatlahir = DB::table('PMState')
                            ->select('StateId','StateName')
                            ->where('CountryId',115)
                            ->get();

            $status = DB::table('PmHouseStatus')
                        ->select('HouseStatusId','HouseStatus')
                        ->get();

            $city = DB::table('PMCity')
                    ->select('CityId','CityName')
                    ->where('CityCountryId',115)
                    ->get(); 
            return view('form kandidat/formkandidat',
                    [   
                        'SIM'=>$SIM,
                        'Pernikahan'=>$pernikahan,
                        'SMA'=>$SMA,
                        'info'=>$cekphase1,
                        'Sederajat'=>$Sederajat,
                        'Domisili' =>$Domisili,
                        'TempatLahir'=>$Tempatlahir,
                        'Status'=>$status,
                        'Citys'=>$city,
                        'jobfair'=>true,
                        'info_kandidat_'=>$info_kandidat[0],
                        'info_kota_ktp'=>$info_kota_ktp[0],
                        'info_phone'=>$info_phone[0],
                        'info_email'=>$info_email[0],
                        'info_sim'=>$info_sim
                        // 'pendidikan'=>$info_pendidikan
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
            $info_kandidat = DB::table('T_kandidat_N as A')
                    ->select('B.StateName','A.*')
                    ->join('PMState as B','A.tempatlahir','B.stateId')
                    ->where('id',$id_kandidat->id_Tkandidat)
                    ->first();
            return view('form kandidat/formkandidat2',[
                        'info_kandidat'=>$info_kandidat
                    ]);
        }else{
            return abort(404);
        }
    }

    public function SubmitFormjf(Request $request){
        // dd($request);
        DB::beginTransaction();
        try {
            $id_organisasi = DB::table('T_link as A')
                            ->select('B.id','B.id_proint')
                            ->join('M_Organisasi as B','A.id_Organisasi','B.id')
                            ->where('A.id',$request->urlid)
                            ->get();
            $result1 = DB::table('T_kandidat_N')
                    ->where('noidentitas',$request->noidentitas)
                    ->count();
            $result2 = DB::table('T_kandidat_N')
                    ->where('noidentitas',$request->noidentitas)
                    ->where('id_Organisasi',$id_organisasi[0]->id)
                    ->count();
            $posisi = DB::table('T_link')
                    ->select('M_Job.nama')
                    ->join('M_Job','T_link.id_Tjob','M_Job.id')
                    ->where('T_link.id',$request->urlid)
                    ->get();
            // dd($result1,$result2);
            if ($result1>=1 && $result2>=1) {
                // kalo usenya pernah daftar dan di organisasi yang sama
                // update flag jadi 1
                $id_kandidat_raw = DB::table('T_kandidat_N')
                                        ->where('noidentitas',$request->noidentitas)
                                        ->where('id_Organisasi',$id_organisasi[0]->id)
                                        ->pluck('id');
                $idKandidat = $id_kandidat_raw[0];

                DB::table('T_kandidat_N')
                    ->where('id',$idKandidat)
                    ->update([
                        'id_Organisasi'=>$id_organisasi[0]->id,
                        'id_Organisasi_Pronit'=>$id_organisasi[0]->id_proint,
                        'id_Tlink'=>$request->urlid,
                        'namalengkap'=>$request->namalengkap,
                        'gender'=>$request->gender,
                        'status_perkawinan'=>NULL,
                        'tempatlahir'=>$request->tempatlahir,
                        'Citizenship'=>115,
                        'tglLahir'=>$request->tgllahir,
                        'alamatlengkap'=>NULL,
                        'RT_ktp'=>NULL,
                        'RW_ktp'=>NULL,
                        'rumahmilik'=>NULL,
                        'kota1'=>NULL,
                        'kodepos'=>NULL,
                        'domisilisaatini'=>$request->domisili,
                        'alamat_koresponden'=>NULL,
                        'RT_koresponden'=>NULL,
                        'RW_koresponden'=>NULL,
                        'rumahmilik_koresponden'=>NULL,
                        'kota_koresponden'=>NULL,
                        'kodepos_koresponden'=>NULL,
                        'noidentitas'=>$request->noidentitas,
                        'npwp'=>NULL,
                        'tinggibadan'=>NULL,
                        'beratbadan'=>NULL,
                        'golDarah'=>NULL,
                        'memilikiMotor'=>$request->motor,
                        'pengalamanMR'=>$request->PMR,
                        'gaji'=>NULL,
                        'tunjangan'=>NULL,
                        'gambarkedudukan'=>NULL,
                        'tanggungjawab'=>NULL,
                        'prestasi'=>NULL,
                        'jabatanharapan'=>NULL,
                        'gajiharapan'=>NULL,
                        'tujanganharapan'=>NULL,
                        'bertugasluarkota'=>NULL,
                        'ditempatkanluarkota'=>$request->luarkota,
                        'fotoCV'=>NULL,
                        'CV'=>NULL,
                        'urlPorto'=>NULL,
                        'flag'=>1,
                        'created_at'=>Carbon::now(),
                        'updated_at'=>NULL,
                        'jobfair'=>'1'
                    ]);

                DB::table('T_kandidat_pekerjaan')->where('id_Tkandidat',$idKandidat)->delete();
                
                /// PHONE           
                DB::table('T_kandidat_phone_N')
                    ->where('id_Tkandidat',$idKandidat)
                    ->delete();

                DB::table('T_kandidat_phone_N')
                    ->insert([
                        'id_Tkandidat'=>$idKandidat,
                        'phoneType'=>'M',
                        'areaCode'=>NULL,
                        'phoneNumber'=>$request->nohp,
                        'phonePrimary'=>'Y'
                    ]);

                /// EMAIL
                DB::table('T_kandidat_email_N')
                    ->where('id_Tkandidat',$idKandidat)
                    ->delete(); 

                DB::table('T_kandidat_email_N')
                    ->insert([
                        'id_Tkandidat'=>$idKandidat,
                        'emailTpye'=>$request->jenis_email,
                        'email'=>$request->email,
                        'emailPrimary'=>'Y'
                    ]);
                
                /// CARD
                DB::table('T_kandidat_card_N')
                    ->where('id_Tkandidat',$idKandidat)
                    ->delete();

                DB::table('T_kandidat_card_N')
                    ->insert([
                        'id_Tkandidat'=>$idKandidat,
                        'cardType'=>57,
                        'cardNumber'=>$request->noidentitas,
                        'expiredDate'=>NULL,
                        'publisher'=>$request->kota_noidentitas,
                    ]);

                for ($i=0; $i < count($request->jenis_SIM); $i++) {
                    if ($request->jenis_SIM[$i]!=0) {
                        DB::table('T_kandidat_card_N')
                        ->insert([
                            'id_Tkandidat'=>$idKandidat,
                            'cardType'=>$request->jenis_SIM[$i],
                            'cardNumber'=>$request->no_SIM[$i],
                            'expiredDate'=>$request->exp_sim[$i],
                            'publisher'=>$request->kota_sim[$i],
                        ]);
                    } 
                }

                DB::table('T_kandidat_pendidikan_N')
                    ->where('id_Tkandidat',$idKandidat)
                    ->delete();
                for ($i=0; $i < count($request->jenis_pendidikan); $i++) {
                    if ($request->jenis_pendidikan[$i]!=0) {
                        DB::table('T_kandidat_pendidikan_N')
                        ->insert([
                            'id_Tkandidat'=>$idKandidat,
                            'jenisPendidikan'=>$request->jenis_pendidikan[$i],
                            'id_namaPendidikan'=>null,
                            'namaPendidikanHR'=>null,
                            'namaPendidikan'=>$request->nama_pendidikan[$i],
                            'id_jurusanPendidikan'=>null,
                            'jurusanPendidikanHR'=>null,
                            'jurusanPendidikan'=>$request->jurusan_pendidikan[$i],
                            'nilai'=>$request->nilai_pendidikan[$i],
                            'kota'=>null,
                            'tahunmulai'=>null,
                            'tahunselesai'=>null
                        ]);
                    } 
                }
            }else if($result1>=1 && $result2==0){
                // kalo usenya pernah daftar dan di organisasi beda
                // tambah row data
                // update flag jadi 1

                DB::table('T_kandidat_N')
                ->where('noidentitas',$request->noidentitas)
                ->update([
                    'flag'=>1
                ]);

                $idKandidat = DB::table('T_kandidat_N')
                            ->insertGetId([
                                'id_Organisasi'=>$id_organisasi[0]->id,
                                'id_Organisasi_Pronit'=>$id_organisasi[0]->id_proint,
                                'id_Tlink'=>$request->urlid,
                                'namalengkap'=>$request->namalengkap,
                                'gender'=>$request->gender,
                                'status_perkawinan'=>NULL,
                                'tempatlahir'=>$request->tempatlahir,
                                'Citizenship'=>115,
                                'domisilisaatini'=>$request->domisili,
                                'tglLahir'=>$request->tgllahir,
                                'alamatlengkap'=>NULL,
                                'RT_ktp'=>NULL,
                                'RW_ktp'=>NULL,
                                'rumahmilik'=>NULL,
                                'kota1'=>NULL,
                                'kodepos'=>NULL,
                                'alamat_koresponden'=>NULL,
                                'RT_koresponden'=>NULL,
                                'RW_koresponden'=>NULL,
                                'rumahmilik_koresponden'=>NULL,
                                'kota_koresponden'=>NULL,
                                'kodepos_koresponden'=>NULL,
                                'noidentitas'=>$request->noidentitas,
                                'npwp'=>NULL,
                                'tinggibadan'=>NULL,
                                'beratbadan'=>NULL,
                                'golDarah'=>NULL,
                                'memilikiMotor'=>$request->motor,
                                'pengalamanMR'=>$request->PMR,
                                'gaji'=>NULL,
                                'tunjangan'=>NULL,
                                'gambarkedudukan'=>NULL,
                                'tanggungjawab'=>NULL,
                                'prestasi'=>NULL,
                                'jabatanharapan'=>NULL,
                                'gajiharapan'=>NULL,
                                'tujanganharapan'=>NULL,
                                'bertugasluarkota'=>NULL,
                                'ditempatkanluarkota'=>$request->luarkota,
                                'fotoCV'=>NULL,
                                'CV'=>NULL,
                                'urlPorto'=>NULL,
                                'flag'=>1,
                                'created_at'=>Carbon::now(),
                                'updated_at'=>NULL,
                                'jobfair'=>'1'
                            ]);
                
                DB::table('T_kandidat_pekerjaan')->where('id_Tkandidat',$idKandidat)->delete();

                DB::table('T_kandidat_phone_N')
                    ->insert([
                        'id_Tkandidat'=>$idKandidat,
                        'phoneType'=>'M',
                        'areaCode'=>NULL,
                        'phoneNumber'=>$request->nohp,
                        'phonePrimary'=>'Y'
                    ]);
                DB::table('T_kandidat_email_N')
                    ->insert([
                        'id_Tkandidat'=>$idKandidat,
                        'emailTpye'=>$request->jenis_email,
                        'email'=>$request->email,
                        'emailPrimary'=>'Y'
                    ]);

                DB::table('T_kandidat_card_N')
                    ->insert([
                        'id_Tkandidat'=>$idKandidat,
                        'cardType'=>57,
                        'cardNumber'=>$request->noidentitas,
                        'expiredDate'=>NULL,
                        'publisher'=>$request->kota_noidentitas,
                    ]);

                for ($i=0; $i < count($request->jenis_SIM); $i++) {
                    if ($request->jenis_SIM[$i]!=0) {
                        DB::table('T_kandidat_card_N')
                        ->insert([
                            'id_Tkandidat'=>$idKandidat,
                            'cardType'=>$request->jenis_SIM[$i],
                            'cardNumber'=>$request->no_SIM[$i],
                            'expiredDate'=>$request->exp_sim[$i],
                            'publisher'=>$request->kota_sim[$i],
                        ]);
                    } 
                }

                for ($i=0; $i < count($request->jenis_pendidikan); $i++) {
                    if ($request->jenis_pendidikan[$i]!=0) {
                        DB::table('T_kandidat_pendidikan_N')
                        ->insert([
                            'id_Tkandidat'=>$idKandidat,
                            'jenisPendidikan'=>$request->jenis_pendidikan[$i],
                            'id_namaPendidikan'=>null,
                            'namaPendidikanHR'=>null,
                            'namaPendidikan'=>$request->nama_pendidikan[$i],
                            'id_jurusanPendidikan'=>null,
                            'jurusanPendidikanHR'=>null,
                            'jurusanPendidikan'=>$request->jurusan_pendidikan[$i],
                            'nilai'=>$request->nilai_pendidikan[$i],
                            'kota'=>null,
                            'tahunmulai'=>null,
                            'tahunselesai'=>null
                        ]);
                    } 
                }
            }else{
                // kalo usenya blm pernah daftar
                // flag null
                $idKandidat = DB::table('T_kandidat_N')
                            ->insertGetId([
                                'id_Organisasi'=>$id_organisasi[0]->id,
                                'id_Organisasi_Pronit'=>$id_organisasi[0]->id_proint,
                                'id_Tlink'=>$request->urlid,
                                'namalengkap'=>$request->namalengkap,
                                'gender'=>$request->gender,
                                'status_perkawinan'=>NULL,
                                'tempatlahir'=>$request->tempatlahir,
                                'Citizenship'=>115,
                                'tglLahir'=>$request->tgllahir,
                                'alamatlengkap'=>NULL,
                                'RT_ktp'=>NULL,
                                'RW_ktp'=>NULL,
                                'rumahmilik'=>NULL,
                                'kota1'=>NULL,
                                'kodepos'=>NULL,
                                'domisilisaatini'=>$request->domisili,
                                'alamat_koresponden'=>NULL,
                                'RT_koresponden'=>NULL,
                                'RW_koresponden'=>NULL,
                                'rumahmilik_koresponden'=>NULL,
                                'kota_koresponden'=>NULL,
                                'kodepos_koresponden'=>NULL,
                                'noidentitas'=>$request->noidentitas,
                                'npwp'=>NULL,
                                'tinggibadan'=>NULL,
                                'beratbadan'=>NULL,
                                'golDarah'=>NULL,
                                'memilikiMotor'=>$request->motor,
                                'pengalamanMR'=>$request->PMR,
                                'gaji'=>NULL,
                                'tunjangan'=>NULL,
                                'gambarkedudukan'=>NULL,
                                'tanggungjawab'=>NULL,
                                'prestasi'=>NULL,
                                'jabatanharapan'=>NULL,
                                'gajiharapan'=>NULL,
                                'tujanganharapan'=>NULL,
                                'bertugasluarkota'=>NULL,
                                'ditempatkanluarkota'=>$request->luarkota,
                                'fotoCV'=>NULL,
                                'CV'=>NULL,
                                'urlPorto'=>NULL,
                                'flag'=>NULL,
                                'created_at'=>Carbon::now(),
                                'updated_at'=>NULL,
                                'jobfair'=>'1'
                            ]);

                DB::table('T_kandidat_pekerjaan')->where('id_Tkandidat',$idKandidat)->delete();

                DB::table('T_kandidat_phone_N')
                    ->insert([
                        'id_Tkandidat'=>$idKandidat,
                        'phoneType'=>'M',
                        'areaCode'=>NULL,
                        'phoneNumber'=>$request->nohp,
                        'phonePrimary'=>'Y'
                    ]);
                DB::table('T_kandidat_email_N')
                    ->insert([
                        'id_Tkandidat'=>$idKandidat,
                        'emailTpye'=>$request->jenis_email,
                        'email'=>$request->email,
                        'emailPrimary'=>'Y'
                    ]);

                DB::table('T_kandidat_card_N')
                    ->insert([
                        'id_Tkandidat'=>$idKandidat,
                        'cardType'=>57,
                        'cardNumber'=>$request->noidentitas,
                        'expiredDate'=>NULL,
                        'publisher'=>$request->kota_noidentitas,
                    ]);

                for ($i=0; $i < count($request->jenis_SIM); $i++) {
                    if ($request->jenis_SIM[$i]!=0) {
                        DB::table('T_kandidat_card_N')
                        ->insert([
                            'id_Tkandidat'=>$idKandidat,
                            'cardType'=>$request->jenis_SIM[$i],
                            'cardNumber'=>$request->no_SIM[$i],
                            'expiredDate'=>$request->exp_sim[$i],
                            'publisher'=>$request->kota_sim[$i],
                        ]);
                    } 
                }

                for ($i=0; $i < count($request->jenis_pendidikan); $i++) {
                    if ($request->jenis_pendidikan[$i]!=0) {
                        DB::table('T_kandidat_pendidikan_N')
                        ->insert([
                            'id_Tkandidat'=>$idKandidat,
                            'jenisPendidikan'=>$request->jenis_pendidikan[$i],
                            'id_namaPendidikan'=>null,
                            'namaPendidikanHR'=>null,
                            'namaPendidikan'=>$request->nama_pendidikan[$i],
                            'id_jurusanPendidikan'=>null,
                            'jurusanPendidikanHR'=>null,
                            'jurusanPendidikan'=>$request->jurusan_pendidikan[$i],
                            'nilai'=>$request->nilai_pendidikan[$i],
                            'kota'=>null,
                            'tahunmulai'=>null,
                            'tahunselesai'=>null
                        ]);
                    } 
                }
                
            }

            DB::table('T_LogKandidat')
                ->insert([
                    'id_Tkandidat'=>$idKandidat,
                    'id_Rekrutmen'=>'1',
                    'id_Organisasi'=>$id_organisasi[0]->id,
                    'jadwal'=>Carbon::now(),
                    'ccEmail'=>NULL,
                    'sendEmail'=>1,
                    'summary'=>NULL,
                    'notes'=>'yang baru',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>NULL,
                    'test'=>NULL,
                    'jenis'=>NULL
                ]);
            
            DB::commit();

            ///INI UNTUK KIRIM EMAIL

            // $data=[
            //     'jenisemail'=>'1',
            //     'org'=>$request->organisasiid,
            //     'nama'=>$request->namalengkap,
            //     'posisi'=>$posisi[0]->nama
            // ];
            // // dd($data);
            // $sendTo=$request->email;
            
            // //ini tempelin langusng aja di controller-nya
            // Mail::send('Email and WA/konten', array('datas'=>$data), function($message) use($sendTo)
            // {
            // // $message->to("maptuh.mahpudin@kalbe.co.id")->subject('Pengajuan Beasiswa YKLB');
            //     $message->to($sendTo)->subject('apply');
            // });

            return redirect()->route('fk.terimakasih');
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e);
        }
    }

    public function SubmitForm1(Request $request){
        // dd($request);
        $path_gambarkedudukan = storage_path('app/public/kandidatFotoKedudukans');
        $path_profile=storage_path('app/public/kandidatFotos');
        $path_CV=storage_path('app/public/kandidatCVs/');

        $gambarkedudukan_ =storage_path('app\public\kandidatFotoKedudukans\\');
        $profile_ =storage_path('app\public\kandidatFotos\\');
        $CV_=storage_path('app\public\kandidatCVs\\');
        $CV2='public\kandidatCVs\\';

        DB::beginTransaction();
        try {
            
            $posisi = DB::table('T_link')
                    ->select('M_Job.nama')
                    ->join('M_Job','T_link.id_Tjob','M_Job.id')
                    ->where('T_link.id',$request->urlid)
                    ->get();
            // dd($posisi);

            if ($request->jobfairflag==null) {
                $id_organisasi = DB::table('T_link as A')
                            ->select('B.id','B.id_proint')
                            ->join('M_Organisasi as B','A.id_Organisasi','B.id')
                            ->where('A.id',$request->urlid)
                            ->get();

                $result1 = DB::table('T_kandidat_N')
                        ->where('noidentitas',$request->noidentitas)
                        ->count();

                $result2 = DB::table('T_kandidat_N')
                        ->where('noidentitas',$request->noidentitas)
                        ->where('id_Organisasi',$id_organisasi[0]->id)
                        ->count();

                if ($result1>=1 && $result2>=1) {
                    // dd('masuk sini');
                    // kalo usenya pernah daftar dan di organisasi yang sama
                    // update flag jadi 1
                    $id_kandidat_ = DB::table('T_kandidat_N')
                                    ->select('id')
                                    ->where('noidentitas',$request->noidentitas)
                                    ->where('id_Organisasi',$id_organisasi[0]->id)
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
    
                    DB::table('T_kandidat_N')
                        ->where('id',$id_kandidat)
                        ->update([
                            'id_Organisasi'=>$id_organisasi[0]->id,
                            'id_Organisasi_Pronit'=>$id_organisasi[0]->id_proint,
                            'id_Tlink'=>$request->urlid,
                            'namalengkap'=>$request->namalengkap,
                            'gender'=>$request->gender,
                            'status_perkawinan'=>$request->status_perkawinan,
                            'tempatlahir'=>$request->tempatlahir,
                            'Citizenship'=>115,
                            'tglLahir'=>$request->tgllahir,
                            'alamatlengkap'=>$request->alamat_KTP,
                            'RT_ktp'=>$request->RT_KTP,
                            'RW_ktp'=>$request->RW_KTP,
                            'rumahmilik'=>$request->rumahmilik,
                            'kota1'=>$request->kota1,
                            'kodepos'=>$request->kodepos,
                            'alamat_koresponden'=>$request->alamat_koresponden,
                            'RT_koresponden'=>$request->RT_koresponden,
                            'RW_koresponden'=>$request->RW_koresponden,
                            'rumahmilik_koresponden'=>$request->rumahmilik_koresponden,
                            'kota_koresponden'=>$request->kota_koresponden,
                            'kodepos_koresponden'=>$request->kodepos_koresponden,
                            'noidentitas'=>$request->noidentitas,
                            'npwp'=>$request->npwp,
                            'tinggibadan'=>$request->tinggibadan,
                            'beratbadan'=>$request->beratbadan,
                            'golDarah'=>$request->goldarah,
                            'memilikiMotor'=>NULL,
                            'pengalamanMR'=>NULL,
                            'gaji'=>$request->gaji,
                            'tunjangan'=>$request->tunjangan,
                            'gambarkedudukan'=>$imgName,
                            'tanggungjawab'=>$request->tanggungjawab,
                            'prestasi'=>$request->prestasi,
                            'jabatanharapan'=>$request->jabatanharapan,
                            'gajiharapan'=>$request->gajiharapan,
                            'tujanganharapan'=>$request->tujanganharapan,
                            'bertugasluarkota'=>$request->bertugasluarkota,
                            'ditempatkanluarkota'=>$request->ditempatkanluarkota,
                            'fotoCV'=>$imgName2,
                            'CV'=>$filecv,
                            'urlPorto'=>$request->porto,
                            'flag'=>1,
                            'created_at'=>Carbon::now(),
                            'updated_at'=>NULL,
                            'memilikiMotor'=>$request->motor,
                            'pengalamanMR'=>$request->PMR,
                            'jobfair'=>0,
                            'domisilisaatini'=>$request->domisili,
                        ]);
    
                    DB::table('T_kandidat_card_N')->where('id_Tkandidat',$id_kandidat)->delete();
                    DB::table('T_kandidat_card_N')
                        ->insert([
                            'id_Tkandidat'=>$id_kandidat,
                            'cardType'=>57,
                            'cardNumber'=>$request->noidentitas,
                            'expiredDate'=>NULL,
                            'publisher'=>$request->kotapenerbitKTP,
                        ]);
                    if(!empty($request->jenis_SIM)){
                        for ($i=0; $i <count($request->jenis_SIM) ; $i++) { 
                            if ($request->jenis_SIM[$i]!=0) {
                                DB::table('T_kandidat_card_N')
                                    ->insert([
                                        'id_Tkandidat'=>$id_kandidat,
                                        'cardType'=>$request->jenis_SIM[$i],
                                        'cardNumber'=>$request->no_SIM[$i],
                                        'expiredDate'=>$request->exp_sim[$i],
                                        'publisher'=>$request->kota_sim[$i],
                                ]);
                            }
                        }
                    }
    
                    DB::table('T_kandidat_phone_N')->where('id_Tkandidat',$id_kandidat)->delete();
                    if(!empty($request->tipe_Tlp)){
                        for ($j=0; $j <count($request->tipe_Tlp) ; $j++) {
                            if ($j==0) {
                                $primary='Y';
                            } else {
                                $primary=NULL;
                            }
                            DB::table('T_kandidat_phone_N')
                                ->insert([
                                    'id_Tkandidat'=>$id_kandidat,
                                    'phoneType'=>$request->tipe_Tlp[$j],
                                    'areaCode'=>$request->Area_Tlp[$j],
                                    'phoneNumber'=>$request->no_Tlp[$j],
                                    'phonePrimary'=>$primary
                                ]);
                        }
                    }
    
                    DB::table('T_kandidat_email_N')->where('id_Tkandidat',$id_kandidat)->delete();
                    if(!empty($request->tipe_Email)){
                        for ($j=0; $j <count($request->tipe_Email) ; $j++) {
                            if ($j==0) {
                                $primary='Y';
                            } else {
                                $primary=NULL;
                            }
                            DB::table('T_kandidat_email_N')
                                ->insert([
                                    'id_Tkandidat'=>$id_kandidat,
                                    'emailTpye'=>$request->tipe_Email[$j],
                                    'email'=>$request->email[$j],
                                    'emailPrimary'=>$primary
                                ]);
                        }
                    }

                    DB::table('T_kandidat_pendidikan_N')->where('id_Tkandidat',$id_kandidat)->delete();
                    if(!empty($request->tingkap_p)){
                        for ($i=0; $i < count($request->tingkap_p); $i++) {
                            if ($request->tingkap_p[$i]!=0) {
                                DB::table('T_kandidat_pendidikan_N')
                                ->insert([
                                    'id_Tkandidat'=>$id_kandidat,
                                    'jenisPendidikan'=>$request->tingkap_p[$i],
                                    'id_namaPendidikan'=>null,
                                    'namaPendidikanHR'=>null,
                                    'namaPendidikan'=>$request->namaInst_p[$i],
                                    'id_jurusanPendidikan'=>null,
                                    'jurusanPendidikanHR'=>null,
                                    'jurusanPendidikan'=>$request->jurusan_p[$i],
                                    'nilai'=>$request->nilai_pendidikan[$i],
                                    'kota'=>$request->kota_p[$i],
                                    'tahunmulai'=>$request->thnMulai_p[$i],
                                    'tahunselesai'=>$request->thnSelesai_p[$i],
                                ]);
                            } 
                        }
                    }
                   
                    DB::table('T_kandidat_pekerjaan')->where('id_Tkandidat',$id_kandidat)->delete();
                    if(!empty($request->nama_Rpekerjaan)){
                        for ($k=0; $k <count($request->nama_Rpekerjaan) ; $k++) { 
                            $namaperusahaan = trim($request->nama_Rpekerjaan[$k],'');
                            $alamatperushaan = trim($request->alamat_Rpekerjaan[$k],''); 
                            $jabatanperusahaan = trim($request->jabatan_Rpekerjaan[$k],''); 
                            $atasanperusahaan = trim($request->atasan_Rpekerjaan[$k],''); 
                            $startperusahaan = $request->ThnMasuk_Rpekerjaan[$k].'-01';
            
                            if (!empty($namaperusahaan)&&!empty($alamatperushaan)&&!empty($jabatanperusahaan)&&!empty($atasanperusahaan)) {
                                DB::table('T_kandidat_pekerjaan')
                                    ->insert([
                                        'id_Tkandidat'=>$id_kandidat,
                                        'namaPerusahaan'=>$namaperusahaan,
                                        'jenisPerusahaan'=>$request->fnf_Rpekerjaan[$k],
                                        'alamatPerusahaan'=>$alamatperushaan,
                                        'jabatanPerusahaan'=>$jabatanperusahaan,
                                        'atasanPerusahaan'=>$atasanperusahaan,
                                        'tahunPerusahaan'=>0,
                                        'startPerushaan'=>$startperusahaan,
                                        'endPerushaan'=>$request->ThnKeluar_Rpekerjaan[$k],
                                        'tahun'=>null,
                                        'bulan'=>null,
                                        'hari'=>null
                                    ]);
                            }
                        }
                    }
                }else if($result1>=1 && $result2==0){
                    // kalo usenya pernah daftar dan di organisasi beda
                    // tambah row data
    
                    // update flag jadi 1
                    DB::table('T_kandidat_N')
                    ->where('noidentitas',$request->noidentitas)
                    ->update([
                        'flag'=>1
                    ]);
    
                    //tamabh row data
                    $id_kandidat = DB::table('T_kandidat_N')
                                ->insertGetId([
                                    'id_Organisasi'=>$id_organisasi[0]->id,
                                    'id_Organisasi_Pronit'=>$id_organisasi[0]->id_proint,
                                    'id_Tlink'=>$request->urlid,
                                    'namalengkap'=>$request->namalengkap,
                                    'gender'=>$request->gender,
                                    'status_perkawinan'=>$request->status_perkawinan,
                                    'tempatlahir'=>$request->tempatlahir,
                                    'Citizenship'=>115,
                                    'tglLahir'=>$request->tgllahir,
                                    'alamatlengkap'=>$request->alamat_KTP,
                                    'RT_ktp'=>$request->RT_KTP,
                                    'RW_ktp'=>$request->RW_KTP,
                                    'rumahmilik'=>$request->rumahmilik,
                                    'kota1'=>$request->kota1,
                                    'kodepos'=>$request->kodepos,
                                    'alamat_koresponden'=>$request->alamat_koresponden,
                                    'RT_koresponden'=>$request->RT_koresponden,
                                    'RW_koresponden'=>$request->RW_koresponden,
                                    'rumahmilik_koresponden'=>$request->rumahmilik_koresponden,
                                    'kota_koresponden'=>$request->kota_koresponden,
                                    'kodepos_koresponden'=>$request->kodepos_koresponden,
                                    'noidentitas'=>$request->noidentitas,
                                    'npwp'=>$request->npwp,
                                    'tinggibadan'=>$request->tinggibadan,
                                    'beratbadan'=>$request->beratbadan,
                                    'golDarah'=>$request->goldarah,
                                    'memilikiMotor'=>NULL,
                                    'pengalamanMR'=>NULL,
                                    'gaji'=>$request->gaji,
                                    'tunjangan'=>$request->tunjangan,
                                    'gambarkedudukan'=>NULL,
                                    'tanggungjawab'=>$request->tanggungjawab,
                                    'prestasi'=>$request->prestasi,
                                    'jabatanharapan'=>$request->jabatanharapan,
                                    'gajiharapan'=>$request->gajiharapan,
                                    'tujanganharapan'=>$request->tujanganharapan,
                                    'bertugasluarkota'=>$request->bertugasluarkota,
                                    'ditempatkanluarkota'=>$request->ditempatkanluarkota,
                                    'fotoCV'=>NULL,
                                    'CV'=>NULL,
                                    'urlPorto'=>$request->porto,
                                    'flag'=>1,
                                    'created_at'=>Carbon::now(),
                                    'updated_at'=>NULL,
                                    'memilikiMotor'=>$request->motor,
                                    'pengalamanMR'=>$request->PMR,
                                    'jobfair'=>0,
                                    'domisilisaatini'=>$request->domisili,
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
                            
    
                    DB::table('T_kandidat_N')
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
    
                    DB::table('T_kandidat_N')
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
    
                    DB::table('T_kandidat_N')
                        ->where('id',$id_kandidat)
                        ->update([
                            'CV'=>$imgName2
                        ]);
    
                    DB::table('T_kandidat_card_N')
                        ->insert([
                            'id_Tkandidat'=>$id_kandidat,
                            'cardType'=>57,
                            'cardNumber'=>$request->noidentitas,
                            'expiredDate'=>NULL,
                            'publisher'=>$request->kotapenerbitKTP,
                        ]);
    
                    if(!empty($request->jenis_SIM)){
                        for ($i=0; $i <count($request->jenis_SIM) ; $i++) { 
                            if ($request->jenis_SIM[$i]!=0) {
                                DB::table('T_kandidat_card_N')
                                    ->insert([
                                        'id_Tkandidat'=>$id_kandidat,
                                        'cardType'=>$request->jenis_SIM[$i],
                                        'cardNumber'=>$request->no_SIM[$i],
                                        'expiredDate'=>$request->exp_sim[$i],
                                        'publisher'=>$request->kota_sim[$i],
                                ]);
                            }
                        }
                    }
    
                    if(!empty($request->tipe_Tlp)){
                        for ($j=0; $j <count($request->tipe_Tlp) ; $j++) {
                            if ($j==0) {
                                $primary='Y';
                            } else {
                                $primary=NULL;
                            }
                            DB::table('T_kandidat_phone_N')
                                ->insert([
                                    'id_Tkandidat'=>$id_kandidat,
                                    'phoneType'=>$request->tipe_Tlp[$j],
                                    'areaCode'=>$request->Area_Tlp[$j],
                                    'phoneNumber'=>$request->no_Tlp[$j],
                                    'phonePrimary'=>$primary
                                ]);
                        }
                    }
    
                    if(!empty($request->tipe_Email)){
                        for ($j=0; $j <count($request->tipe_Email) ; $j++) {
                            if ($j==0) {
                                $primary='Y';
                            } else {
                                $primary=NULL;
                            }
                            DB::table('T_kandidat_email_N')
                                ->insert([
                                    'id_Tkandidat'=>$id_kandidat,
                                    'emailTpye'=>$request->tipe_Email[$j],
                                    'email'=>$request->email[$j],
                                    'emailPrimary'=>$primary
                                ]);
                        }
                    }
                    
                    DB::table('T_kandidat_pendidikan_N')->where('id_Tkandidat',$id_kandidat)->delete();
                    if(!empty($request->tingkap_p)){
                        for ($i=0; $i < count($request->tingkap_p); $i++) {
                            if ($request->tingkap_p[$i]!=0) {
                                DB::table('T_kandidat_pendidikan_N')
                                ->insert([
                                    'id_Tkandidat'=>$id_kandidat,
                                    'jenisPendidikan'=>$request->tingkap_p[$i],
                                    'id_namaPendidikan'=>null,
                                    'namaPendidikanHR'=>null,
                                    'namaPendidikan'=>$request->namaInst_p[$i],
                                    'id_jurusanPendidikan'=>null,
                                    'jurusanPendidikanHR'=>null,
                                    'jurusanPendidikan'=>$request->jurusan_p[$i],
                                    'nilai'=>$request->nilai_pendidikan[$i],
                                    'kota'=>$request->kota_p[$i],
                                    'tahunmulai'=>$request->thnMulai_p[$i],
                                    'tahunselesai'=>$request->thnSelesai_p[$i],
                                ]);
                            } 
                        }
                    }
    
                    if(!empty($request->nama_Rpekerjaan)){
                        for ($k=0; $k <count($request->nama_Rpekerjaan) ; $k++) { 
                            $namaperusahaan = trim($request->nama_Rpekerjaan[$k],'');
                            $alamatperushaan = trim($request->alamat_Rpekerjaan[$k],''); 
                            $jabatanperusahaan = trim($request->jabatan_Rpekerjaan[$k],''); 
                            $atasanperusahaan = trim($request->atasan_Rpekerjaan[$k],''); 
                            $startperusahaan = $request->ThnMasuk_Rpekerjaan[$k].'-01';
            
                            if (!empty($namaperusahaan)&&!empty($alamatperushaan)&&!empty($jabatanperusahaan)&&!empty($atasanperusahaan)) {
                                DB::table('T_kandidat_pekerjaan')
                                    ->insert([
                                        'id_Tkandidat'=>$id_kandidat,
                                        'namaPerusahaan'=>$namaperusahaan,
                                        'jenisPerusahaan'=>$request->fnf_Rpekerjaan[$k],
                                        'alamatPerusahaan'=>$alamatperushaan,
                                        'jabatanPerusahaan'=>$jabatanperusahaan,
                                        'atasanPerusahaan'=>$atasanperusahaan,
                                        'tahunPerusahaan'=>0,
                                        'startPerushaan'=>$startperusahaan,
                                        'endPerushaan'=>$request->ThnKeluar_Rpekerjaan[$k],
                                        'tahun'=>null,
                                        'bulan'=>null,
                                        'hari'=>null
                                    ]);
                            }
                        }
                    }

                    if(!empty($request->nama_Rpekerjaan)){
                        for ($i=0; $i < count($request->tingkap_p); $i++) {
                            if ($request->tingkap_p[$i]!=0) {
                                DB::table('T_kandidat_pendidikan_N')
                                ->insert([
                                    'id_Tkandidat'=>$id_kandidat,
                                    'jenisPendidikan'=>$request->tingkap_p[$i],
                                    'id_namaPendidikan'=>null,
                                    'namaPendidikanHR'=>null,
                                    'namaPendidikan'=>$request->namaInst_p[$i],
                                    'id_jurusanPendidikan'=>null,
                                    'jurusanPendidikanHR'=>null,
                                    'jurusanPendidikan'=>$request->jurusan_p[$i],
                                    'nilai'=>$request->nilai_pendidikan[$i],
                                    'kota'=>$request->kota_p[$i],
                                    'tahunmulai'=>$request->thnMulai_p[$i],
                                    'tahunselesai'=>$request->thnSelesai_p[$i],
                                ]);
                            } 
                        }
                    }

                }else{
                    // kalo usenya blm pernah daftar
                    // flag null
                    $id_kandidat = DB::table('T_kandidat_N')
                            ->insertGetId([
                                'id_Organisasi'=>$id_organisasi[0]->id,
                                'id_Organisasi_Pronit'=>$id_organisasi[0]->id_proint,
                                'id_Tlink'=>$request->urlid,
                                'namalengkap'=>$request->namalengkap,
                                'gender'=>$request->gender,
                                'status_perkawinan'=>$request->status_perkawinan,
                                'tempatlahir'=>$request->tempatlahir,
                                'Citizenship'=>115,
                                'tglLahir'=>$request->tgllahir,
                                'alamatlengkap'=>$request->alamat_KTP,
                                'RT_ktp'=>$request->RT_KTP,
                                'RW_ktp'=>$request->RW_KTP,
                                'rumahmilik'=>$request->rumahmilik,
                                'kota1'=>$request->kota1,
                                'kodepos'=>$request->kodepos,
                                'alamat_koresponden'=>$request->alamat_koresponden,
                                'RT_koresponden'=>$request->RT_koresponden,
                                'RW_koresponden'=>$request->RW_koresponden,
                                'rumahmilik_koresponden'=>$request->rumahmilik_koresponden,
                                'kota_koresponden'=>$request->kota_koresponden,
                                'kodepos_koresponden'=>$request->kodepos_koresponden,
                                'noidentitas'=>$request->noidentitas,
                                'npwp'=>$request->npwp,
                                'tinggibadan'=>$request->tinggibadan,
                                'beratbadan'=>$request->beratbadan,
                                'golDarah'=>$request->goldarah,
                                'memilikiMotor'=>NULL,
                                'pengalamanMR'=>NULL,
                                'gaji'=>$request->gaji,
                                'tunjangan'=>$request->tunjangan,
                                'gambarkedudukan'=>NULL,
                                'tanggungjawab'=>$request->tanggungjawab,
                                'prestasi'=>$request->prestasi,
                                'jabatanharapan'=>$request->jabatanharapan,
                                'gajiharapan'=>$request->gajiharapan,
                                'tujanganharapan'=>$request->tujanganharapan,
                                'bertugasluarkota'=>$request->bertugasluarkota,
                                'ditempatkanluarkota'=>$request->ditempatkanluarkota,
                                'fotoCV'=>NULL,
                                'CV'=>NULL,
                                'urlPorto'=>$request->porto,
                                'flag'=>NULL,
                                'created_at'=>Carbon::now(),
                                'updated_at'=>NULL,
                                'memilikiMotor'=>$request->motor,
                                'pengalamanMR'=>$request->PMR,
                                'jobfair'=>0,
                                'domisilisaatini'=>$request->domisili,
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
    
                    DB::table('T_kandidat_N')
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
    
                    DB::table('T_kandidat_N')
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
    
                    DB::table('T_kandidat_N')
                        ->where('id',$id_kandidat)
                        ->update([
                            'CV'=>$filecv
                        ]);
    
                    DB::table('T_kandidat_card_N')
                        ->insert([
                            'id_Tkandidat'=>$id_kandidat,
                            'cardType'=>57,
                            'cardNumber'=>$request->noidentitas,
                            'expiredDate'=>NULL,
                            'publisher'=>$request->kotapenerbitKTP,
                        ]);
    
                    if(!empty($request->jenis_SIM)){
                        for ($i=0; $i <count($request->jenis_SIM) ; $i++) { 
                            if ($request->jenis_SIM[$i]!=0) {
                                DB::table('T_kandidat_card_N')
                                    ->insert([
                                        'id_Tkandidat'=>$id_kandidat,
                                        'cardType'=>$request->jenis_SIM[$i],
                                        'cardNumber'=>$request->no_SIM[$i],
                                        'expiredDate'=>$request->exp_sim[$i],
                                        'publisher'=>$request->kota_sim[$i],
                                ]);
                            }
                        }
                    }
    
                    if(!empty($request->tipe_Tlp)){
                        for ($j=0; $j <count($request->tipe_Tlp) ; $j++) {
                            if ($j==0) {
                                $primary='Y';
                            } else {
                                $primary=NULL;
                            }
                            DB::table('T_kandidat_phone_N')
                                ->insert([
                                    'id_Tkandidat'=>$id_kandidat,
                                    'phoneType'=>$request->tipe_Tlp[$j],
                                    'areaCode'=>$request->Area_Tlp[$j],
                                    'phoneNumber'=>$request->no_Tlp[$j],
                                    'phonePrimary'=>$primary
                                ]);
                        }
                    }
    
                    if(!empty($request->tipe_Email)){
                        for ($j=0; $j <count($request->tipe_Email) ; $j++) {
                            if ($j==0) {
                                $primary='Y';
                            } else {
                                $primary=NULL;
                            }
                            DB::table('T_kandidat_email_N')
                                ->insert([
                                    'id_Tkandidat'=>$id_kandidat,
                                    'emailTpye'=>$request->tipe_Email[$j],
                                    'email'=>$request->email[$j],
                                    'emailPrimary'=>$primary
                                ]);
                        }
                    }
    
                    DB::table('T_kandidat_pendidikan_N')->where('id_Tkandidat',$id_kandidat)->delete();
                    if(!empty($request->tingkap_p)){
                        for ($i=0; $i < count($request->tingkap_p); $i++) {
                            if ($request->tingkap_p[$i]!=0) {
                                DB::table('T_kandidat_pendidikan_N')
                                ->insert([
                                    'id_Tkandidat'=>$id_kandidat,
                                    'jenisPendidikan'=>$request->tingkap_p[$i],
                                    'id_namaPendidikan'=>null,
                                    'namaPendidikanHR'=>null,
                                    'namaPendidikan'=>$request->namaInst_p[$i],
                                    'id_jurusanPendidikan'=>null,
                                    'jurusanPendidikanHR'=>null,
                                    'jurusanPendidikan'=>$request->jurusan_p[$i],
                                    'nilai'=>$request->nilai_pendidikan[$i],
                                    'kota'=>$request->kota_p[$i],
                                    'tahunmulai'=>$request->thnMulai_p[$i],
                                    'tahunselesai'=>$request->thnSelesai_p[$i],
                                ]);
                            } 
                        }
                    }
                    
                    if(!empty($request->nama_Rpekerjaan)){
                        for ($k=0; $k <count($request->nama_Rpekerjaan) ; $k++) { 
                            $namaperusahaan = trim($request->nama_Rpekerjaan[$k],'');
                            $alamatperushaan = trim($request->alamat_Rpekerjaan[$k],''); 
                            $jabatanperusahaan = trim($request->jabatan_Rpekerjaan[$k],''); 
                            $atasanperusahaan = trim($request->atasan_Rpekerjaan[$k],''); 
                            $startperusahaan = $request->ThnMasuk_Rpekerjaan[$k];
            
                            if (!empty($namaperusahaan)&&!empty($alamatperushaan)&&!empty($jabatanperusahaan)&&!empty($atasanperusahaan)) {
                                DB::table('T_kandidat_pekerjaan')
                                    ->insert([
                                        'id_Tkandidat'=>$id_kandidat,
                                        'namaPerusahaan'=>$namaperusahaan,
                                        'jenisPerusahaan'=>$request->fnf_Rpekerjaan[$k],
                                        'alamatPerusahaan'=>$alamatperushaan,
                                        'jabatanPerusahaan'=>$jabatanperusahaan,
                                        'atasanPerusahaan'=>$atasanperusahaan,
                                        'tahunPerusahaan'=>0,
                                        'startPerushaan'=>$startperusahaan,
                                        'endPerushaan'=>$request->ThnKeluar_Rpekerjaan[$k],
                                        'tahun'=>null,
                                        'bulan'=>null,
                                        'hari'=>null
                                    ]);
                            }
                        }
                    }

                    if(!empty($request->nama_Rpekerjaan)){
                        for ($i=0; $i < count($request->tingkap_p); $i++) {
                            if ($request->tingkap_p[$i]!=0) {
                                DB::table('T_kandidat_pendidikan_N')
                                ->insert([
                                    'id_Tkandidat'=>$id_kandidat,
                                    'jenisPendidikan'=>$request->tingkap_p[$i],
                                    'id_namaPendidikan'=>null,
                                    'namaPendidikanHR'=>null,
                                    'namaPendidikan'=>$request->namaInst_p[$i],
                                    'id_jurusanPendidikan'=>null,
                                    'jurusanPendidikanHR'=>null,
                                    'jurusanPendidikan'=>$request->jurusan_p[$i],
                                    'nilai'=>$request->nilai_pendidikan[$i],
                                    'kota'=>$request->kota_p[$i],
                                    'tahunmulai'=>$request->thnMulai_p[$i],
                                    'tahunselesai'=>$request->thnSelesai_p[$i],
                                ]);
                            } 
                        }
                    }
                }
    
                DB::table('T_LogKandidat')
                    ->insert([
                        'id_Tkandidat'=>$id_kandidat,
                        'id_Rekrutmen'=>'1',
                        'id_Organisasi'=>$id_organisasi[0]->id,
                        'jadwal'=>Carbon::now(),
                        'ccEmail'=>NULL,
                        'sendEmail'=>1,
                        'summary'=>NULL,
                        'notes'=>'yang baru1',
                        'created_at'=>Carbon::now(),
                        'updated_at'=>NULL,
                        'test'=>NULL,
                        'jenis'=>NULL
                    ]);
            } else {
                $id_kandidat = $request->urlidkandidat;

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

                DB::table('T_kandidat_N')
                    ->where('id',$id_kandidat)
                    ->update([
                        'namalengkap'=>$request->namalengkap,
                        'status_perkawinan'=>$request->status_perkawinan,
                        // 'tempatlahir'=>$request->tempatlahir,
                        'Citizenship'=>115,
                        'tglLahir'=>$request->tgllahir,
                        'alamatlengkap'=>$request->alamat_KTP,
                        'RT_ktp'=>$request->RT_KTP,
                        'RW_ktp'=>$request->RW_KTP,
                        'rumahmilik'=>$request->rumahmilik,
                        'kota1'=>$request->kota1,
                        'kodepos'=>$request->kodepos,
                        'alamat_koresponden'=>$request->alamat_koresponden,
                        'RT_koresponden'=>$request->RT_koresponden,
                        'RW_koresponden'=>$request->RW_koresponden,
                        'rumahmilik_koresponden'=>$request->rumahmilik_koresponden,
                        'kota_koresponden'=>$request->kota_koresponden,
                        'kodepos_koresponden'=>$request->kodepos_koresponden,
                        'npwp'=>$request->npwp,
                        'tinggibadan'=>$request->tinggibadan,
                        'beratbadan'=>$request->beratbadan,
                        'golDarah'=>$request->goldarah,
                        'gaji'=>$request->gaji,
                        'tunjangan'=>$request->tunjangan,
                        'gambarkedudukan'=>$imgName,
                        'tanggungjawab'=>$request->tanggungjawab,
                        'prestasi'=>$request->prestasi,
                        'jabatanharapan'=>$request->jabatanharapan,
                        'gajiharapan'=>$request->gajiharapan,
                        'tujanganharapan'=>$request->tujanganharapan,
                        'bertugasluarkota'=>$request->bertugasluarkota,
                        'ditempatkanluarkota'=>$request->ditempatkanluarkota,
                        'fotoCV'=>$imgName2,
                        'CV'=>$filecv,
                        'urlPorto'=>$request->porto,
                        'updated_at'=>Carbon::now()
                    ]);

                DB::table('T_kandidat_card_N')
                    ->where('id_Tkandidat',$id_kandidat)
                    ->where('cardType','<>',57)
                    ->delete();   
                if(!empty($request->jenis_SIM)){
                    for ($i=0; $i <count($request->jenis_SIM) ; $i++) { 
                        if ($request->jenis_SIM[$i]!=0) {
                            DB::table('T_kandidat_card_N')
                                ->insert([
                                    'id_Tkandidat'=>$id_kandidat,
                                    'cardType'=>$request->jenis_SIM[$i],
                                    'cardNumber'=>$request->no_SIM[$i],
                                    'expiredDate'=>$request->exp_sim[$i],
                                    'publisher'=>$request->kota_sim[$i],
                            ]);
                        }
                    }
                }
                // dd($request);
                DB::table('T_kandidat_phone_N')->where('id_Tkandidat',$id_kandidat)->delete();
                if(!empty($request->tipe_Tlp)){
                    for ($j=0; $j <count($request->tipe_Tlp) ; $j++) {
                        if ($j==0) {
                            $primary='Y';
                        } else {
                            $primary=NULL;
                        }
                        
                        DB::table('T_kandidat_phone_N')
                            ->insert([
                                'id_Tkandidat'=>$id_kandidat,
                                'phoneType'=>$request->tipe_Tlp[$j],
                                'areaCode'=>$request->Area_Tlp[$j],
                                'phoneNumber'=>$request->no_Tlp[$j],
                                'phonePrimary'=>$primary
                            ]);

                    }
                }

                DB::table('T_kandidat_email_N')->where('id_Tkandidat',$id_kandidat)->delete();
                if(!empty($request->tipe_Email)){
                    for ($j=0; $j <count($request->tipe_Email) ; $j++) {
                        if ($j==0) {
                            $primary='Y';
                        } else {
                            $primary=NULL;
                        }
                        DB::table('T_kandidat_email_N')
                            ->insert([
                                'id_Tkandidat'=>$id_kandidat,
                                'emailTpye'=>$request->tipe_Email[$j],
                                'email'=>$request->email[$j],
                                'emailPrimary'=>$primary
                            ]);
                    }
                }

                DB::table('T_kandidat_pekerjaan')->where('id_Tkandidat',$id_kandidat)->delete();
                if(!empty($request->nama_Rpekerjaan)){
                    for ($k=0; $k <count($request->nama_Rpekerjaan) ; $k++) { 
                        $namaperusahaan = trim($request->nama_Rpekerjaan[$k],'');
                        $alamatperushaan = trim($request->alamat_Rpekerjaan[$k],''); 
                        $jabatanperusahaan = trim($request->jabatan_Rpekerjaan[$k],''); 
                        $atasanperusahaan = trim($request->atasan_Rpekerjaan[$k],''); 
                        $startperusahaan = $request->ThnMasuk_Rpekerjaan[$k];
        
                        if (!empty($namaperusahaan)&&!empty($alamatperushaan)&&!empty($jabatanperusahaan)&&!empty($atasanperusahaan)) {
                            DB::table('T_kandidat_pekerjaan')
                                ->insert([
                                    'id_Tkandidat'=>$id_kandidat,
                                    'namaPerusahaan'=>$namaperusahaan,
                                    'jenisPerusahaan'=>$request->fnf_Rpekerjaan[$k],
                                    'alamatPerusahaan'=>$alamatperushaan,
                                    'jabatanPerusahaan'=>$jabatanperusahaan,
                                    'atasanPerusahaan'=>$atasanperusahaan,
                                    'tahunPerusahaan'=>0,
                                    'startPerushaan'=>$startperusahaan,
                                    'endPerushaan'=>$request->ThnKeluar_Rpekerjaan[$k],
                                    'tahun'=>null,
                                    'bulan'=>null,
                                    'hari'=>null
                                ]);
                        }
                    }
                }

                DB::table('T_kandidat_pendidikan_N')->where('id_Tkandidat',$id_kandidat)->delete();
                if(!empty($request->tingkap_p)){
                    for ($i=0; $i < count($request->tingkap_p); $i++) {
                        if ($request->tingkap_p[$i]!=0) {
                            DB::table('T_kandidat_pendidikan_N')
                            ->insert([
                                'id_Tkandidat'=>$id_kandidat,
                                'jenisPendidikan'=>$request->tingkap_p[$i],
                                'id_namaPendidikan'=>null,
                                'namaPendidikanHR'=>null,
                                'namaPendidikan'=>$request->namaInst_p[$i],
                                'id_jurusanPendidikan'=>null,
                                'jurusanPendidikanHR'=>null,
                                'jurusanPendidikan'=>$request->jurusan_p[$i],
                                'nilai'=>$request->nilai_pendidikan[$i],
                                'kota'=>$request->kota_p[$i],
                                'tahunmulai'=>$request->thnMulai_p[$i],
                                'tahunselesai'=>$request->thnSelesai_p[$i],
                            ]);
                        } 
                    }
                }

                DB::table('T_linkPhase1')
                    ->where('id_Tkandidat',$id_kandidat)
                    ->update([
                        'active'=>0
                    ]);
            }
            DB::commit();
            // $data=[
            //     'jenisemail'=>'1',
            //     'org'=>$request->organisasiid,
            //     'nama'=>$request->namalengkap,
            //     'posisi'=>$posisi[0]->nama
            // ];
            // // dd($data);
            // $sendTo=$request->email;
            
            // //ini tempelin langusng aja di controller-nya
            // Mail::send('Email and WA/konten', array('datas'=>$data), function($message) use($sendTo)
            // {
            // // $message->to("maptuh.mahpudin@kalbe.co.id")->subject('Pengajuan Beasiswa YKLB');
            //     $message->to($sendTo)->subject('apply');
            // });

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
            DB::table('T_kandidat2_N')
                ->insert([
                    'id_Tkandidat'=>$request->kandidat,
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
                    'updated_at'=>NULL
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

            if(!empty($request->nama_karyawan)){
                for ($k=0; $k <count($request->nama_karyawan) ; $k++) { 
                    $namakenal = trim($request->nama_karyawan[$k],''); 
                    $hubungankenal = trim($request->hubungan_karyawan[$k],''); 

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

            if(!empty($request->nama_darurat)){
                for ($k=0; $k <count($request->nama_darurat) ; $k++) { 
                    $namadarurat = trim($request->nama_darurat[$k],''); 
                    $alamatdarurat = trim($request->alamat_darurat[$k],''); 
                    $tlpdarurat = trim($request->tlp_darurat[$k],''); 
                    
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

            // $statuskeluarga = ['Ayah','Ibu','Kaka/Adik 1',
            //                     'Kaka/Adik 2','kaka/adik 3',
            //                     'Kaka/Adik 4','Suami/Istri',
            //                     'Anak 1','Anak 2','Anak 3','Anak 4',
            //                     'Ayah Mertua','Ibu Mertua'
            // ];
            // $statusalamt = [
            //     'Alamat Keluarga',
            //     'Alamat Merrtua'
            // ];

            if(!empty($request->hubungan_kel)){
                for ($k=0; $k <count($request->hubungan_kel) ; $k++) {
                    $hubungan = $request->hubungan_kel[$k]; 
                    $nama = trim($request->nama_kel[$k]);
                    $gender = $request->gender_kel[$k]; 
                    $tgl_lahir = $request->tgl_kel[$k]; 
                    $alamat = trim($request->alamat_kel[$k]); 

                    if (!empty($hubungan)&&!empty($nama)&&!empty($gender)&&!empty($tgl_lahir)&&!empty($alamat)) {

                        $FamRelName = DB::table('PMFamRel')
                                        ->select('FamRelType')
                                        ->where('FamRelId',$hubungan)
                                        ->pluck('FamRelType');

                        DB::table('T_kandidat_keluarga_N')
                            ->insert([
                                'id_Tkandidat'=>$request->kandidat,
                                'hubungan'=>$hubungan,
                                'FamRelType'=>$FamRelName[0],
                                'nama'=>$nama,
                                'tgl_lahir'=>$tgl_lahir,
                                'alamat'=>$alamat,
                                'gender'=>$gender
                            ]);
                    }
                }
            }



            // if(!empty($request->nama)){
            //     for ($k=0; $k <count($request->nama) ; $k++) {
            //         $status = $statuskeluarga[$k]; 
            //         $namakeluarga = trim($request->nama[$k],''); 
            //         $usiakeluarga = trim($request->usia[$k],''); 
            //         $LPKeluarga = trim($request->LP[$k],''); 
            //         $pendidikankeluarga = trim($request->pendidikan[$k],'');
            //         $perushaankeluarga = trim($request->namaperushaan[$k],''); 
                    
            //         if (!empty($namakeluarga)&&!empty($usiakeluarga)&&!empty($LPKeluarga)&&!empty($pendidikankeluarga)&&!empty($perushaankeluarga)) {
            //             DB::table('T_keluarga')
            //             ->insert([
            //                 'id_Tkandidat'=>$request->kandidat,
            //                 'statusKeluarga'=>$status,
            //                 'namaKelurga'=>$namakeluarga,
            //                 'usiaKeluarga'=>$usiakeluarga,
            //                 'genderKeluarga'=>$LPKeluarga,
            //                 'pendidikanKeluarga'=>$pendidikankeluarga,
            //                 'perushaanKeluarga'=>$perushaankeluarga
            //             ]);
            //         }
            //     }
                
            // }

            // if(!empty($request->alamat)){
            //     for ($k=0; $k <count($request->alamat) ; $k++) {
            //         $status = $statusalamt[$k]; 
            //         $alamatkeluarga = trim($request->alamat[$k],'');
            //         if ($k<1) {
            //             $tlpkeluarga = trim($request->notlp[$k],''); 
            //         } else{
            //             $tlpkeluarga=null;
            //         }
                    
                    
            //         if (!empty($status)&&!empty($alamatkeluarga)) {
            //             DB::table('T_alamatKeluarga')
            //                 ->insert([
            //                     'id_Tkandidat'=>$request->kandidat,
            //                     'statusAlamat'=>$status,
            //                     'alamatKeluarga'=>$alamatkeluarga,
            //                     'tlpKeluarga'=>$tlpkeluarga
            //                 ]);
            //             }
            //     }
                
            // }

            if(!empty($request->nama_bahasa)){
                for ($k=0; $k <count($request->nama_bahasa) ; $k++) { 
                    $bahasa = trim($request->nama_bahasa[$k],''); 
                    $berbicara = trim($request->berbicara_bahasa[$k],''); 
                    $menulis = trim($request->menulis_bahasa[$k],''); 
                    $membaca = trim($request->membaca_bahasa[$k],''); 
                    
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

    public function Test(){
        $date = Carbon::parse('2022-08-24');
        $now = Carbon::now();

        // $diff = $date->diffInMonths($now);
        // $diff = $date->diff(Carbon::now())->format('%y years, %m months and %d days');
        $diff = $date->diff(Carbon::now())->format('%y-%m-%d');
        dd($diff);
    }

    public function GetEduLvlandCity(){
        $edu = DB::table('PMEduLevel')
                ->select('EduLvlId','EduLvlName')
                ->where('EduLvlStatus','F')
                ->where('active',1)
                ->where('deleted',0)
                // ->whereNotIn('EduLvlId',[100,98,99,107])
                ->get();

        $city = DB::table('PMCity')
                ->select('CityId','CityName')
                ->get();
        return [$edu,$city];
    }

    public function GetPendidikanF($id){
        // return $id;
        $info_pendidikan = DB::table('T_kandidat_pendidikan_N')
                            ->where('id_Tkandidat',$id)
                            ->get();
        $edu = DB::table('PMEduLevel')
                ->select('EduLvlId','EduLvlName')
                ->where('EduLvlStatus','F')
                ->get();
        $city = DB::table('PMCity')
                ->select('CityId','CityName')
                ->get();

        return [$info_pendidikan,$edu,$city];
    }

    public function GetFamRel(){
        $list_keluarga = DB::table('PMFamRel')
                        ->select('FamRelId','FamRelName')
                        ->orderBy('FamRelType', 'asc')
                        ->get();
        return $list_keluarga;
    }

}
