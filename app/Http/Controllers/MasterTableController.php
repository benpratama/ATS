<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterTableController extends Controller
{   
    //MASTER TABLE INTERNAL
    public function indexInternal(){
        return view('master table/mt_internal');
    }
     //----JOB----
    public function ShowJob(){
        $job = DB::table('M_Job')
            ->select('id','nama','golongan','active','deleted')
            ->where('deleted',0)
            ->get();
        return $job;
    }
    public function DelJob(Request $request){
        $delted =1;
        $active =0;
        for ($i=0; $i <count($request->arrId_job) ; $i++) { 
            DB::table('M_Job')
                ->where('id',$request->arrId_job[$i])
                ->update(['deleted'=>$delted,'active'=>$active]);
        }
        return true;
    }
    public function AddJob(Request $request){
        DB::table('M_Job')
            ->insert([
                'nama'=>$request->new_job,
                'golongan'=>$request->new_golongan,
                'active'=>'1',
                'deleted'=>'0'
            ]);
        return true;
    }
    public function ModalJob($id){
        $job = DB::table('M_Job')
            ->select('nama','golongan')
            ->where('id',$id)
            ->get();
        return $job;
    }
    public function EditJob(Request $request){
        DB::table('M_Job')
        ->where('id',$request->id_job)
        ->update(['nama'=>$request->edit_job,'golongan'=>$request->edit_golongan]);
        return true;
    }
    public function ActiveJob(Request $request){
        DB::table('M_Job')
            ->where('id',$request->id_job)
            ->update(['active'=>$request->active]);
        return true;
    }

    //----ORGANISASI----
    public function ShowOrganisasi(){
        $organisasi = DB::table('M_Organisasi')
            ->select('nama')
            ->get();
        return $organisasi;
    }

    //----DEPARTMENT----
    public function ShowDept(){
        $Dept = DB::table('M_LobandSub')
            ->select('nama')
            ->get();
        return $Dept;
    }

    //----USER----
    public function ShowUser(){
        $User = DB::table('M_user')
            ->select('id','nama','email','NIK','extensionName','location','namaManager')
            ->get();
        return $User;
    }
    public function ModalUser($id){
        $kontak = DB::table('M_user')
            ->select('email','mobilePhone')
            ->where('id',$id)
            ->get();
        return $kontak;
    }
    public function EditUser(Request $request){
        DB::table('M_user')
        ->where('id',$request->id_user)
        ->update(['mobilePhone'=>$request->edit_wa]);
        return true;
    }


    //MASTER TABLE FORM
    public function indexForm(){
        return view('master table/mt_form');
    }
    //----SIM----
    public function ShowSim(){
        $sims = DB::table('M_SIM')
            ->select('id','nama','active','deleted')
            ->where('deleted',0)
            ->get();
        return $sims;
    }
    public function DelSim(Request $request){
        $delted =1;
        $active =0;
        for ($i=0; $i <count($request->arrId_sim) ; $i++) { 
            DB::table('M_sim')
                ->where('id',$request->arrId_sim[$i])
                ->update(['deleted'=>$delted,'active'=>$active]);
        }
        return true;
    }
    public function AddSim(Request $request){
        DB::table('M_sim')
            ->insert([
                'nama'=>$request->new_sim,
                'active'=>'1',
                'deleted'=>'0'
            ]);
        return true;
    }
    public function ModalSim($id){
        $SIM = DB::table('M_sim')
            ->select('nama')
            ->where('id',$id)
            ->get();
        return $SIM;
    }
    public function EditSim(Request $request){
        DB::table('M_sim')
        ->where('id',$request->id_sim)
        ->update(['nama'=>$request->Edit_sim]);
        return true;
    }
    public function ActiveSim(Request $request){
        DB::table('M_sim')
            ->where('id',$request->id_sim)
            ->update(['active'=>$request->active]);
        return true;
    }

    //----JURUSAN----
    public function ShowJurusan(){
        $jurusan = DB::table('M_SMASederajat')
            ->select('id','nama','jenis','active','deleted')
            ->where('deleted',0)
            ->get();
        return $jurusan;
    }
    public function DelJurusan(Request $request){
        $delted =1;
        $active =0;
        for ($i=0; $i <count($request->arrId_jurusan) ; $i++) { 
            DB::table('M_SMASederajat')
                ->where('id',$request->arrId_jurusan[$i])
                ->update(['deleted'=>$delted,'active'=>$active]);
        }
        return true;
    }
    public function AddJurusan(Request $request){
        DB::table('M_SMASederajat')
            ->insert([
                'nama'=>$request->new_jurusan,
                'jenis'=>$request->new_jenis,
                'active'=>'1',
                'deleted'=>'0'
            ]);
        return true;
    }
    public function ModalJurusan($id){
        $SIM = DB::table('M_SMASederajat')
            ->select('nama','jenis')
            ->where('id',$id)
            ->get();
        return $SIM;
    }
    public function Editjurusan(Request $request){
        DB::table('M_SMASederajat')
        ->where('id',$request->id_jurusan)
        ->update(['nama'=>$request->Edit_jurusan,'jenis'=>$request->Edit_jenis]);
        return true;
    }
    public function ActiveJurusan(Request $request){
        DB::table('M_SMASederajat')
            ->where('id',$request->id_jurusan)
            ->update(['active'=>$request->active]);
        return true;
    }

    //----PERKAWINAN----
    public function ShowPerkawinan(){
        $perkawinan = DB::table('M_Statuspernikahan')
            ->select('id','nama','keterangan','active','deleted')
            ->where('deleted',0)
            ->get();
        return $perkawinan;
    }
    public function DelPerkawinan(Request $request){
        $delted =1;
        $active =0;
        for ($i=0; $i <count($request->arrId_perkawinan) ; $i++) { 
            DB::table('M_Statuspernikahan')
                ->where('id',$request->arrId_perkawinan[$i])
                ->update(['deleted'=>$delted,'active'=>$active]);
        }
        return true;
    }
    public function AddPerkawinan(Request $request){
        DB::table('M_Statuspernikahan')
            ->insert([
                'nama'=>$request->new_perkawinan,
                'keterangan'=>$request->new_keterangan,
                'active'=>'1',
                'deleted'=>'0'
            ]);
        return true;
    }
    public function ModalPerkawinan($id){
        $perkawinan = DB::table('M_Statuspernikahan')
            ->select('nama','keterangan')
            ->where('id',$id)
            ->get();
        return $perkawinan;
    }
    public function EditPerkawinan(Request $request){
        DB::table('M_Statuspernikahan')
        ->where('id',$request->id_perkawinan)
        ->update(['nama'=>$request->Edit_perkawinan,'keterangan'=>$request->Edit_keterangan]);
        return true;
    }
    public function ActivePerkawinan(Request $request){
        DB::table('M_Statuspernikahan')
            ->where('id',$request->id_perkawinan)
            ->update(['active'=>$request->active]);
        return true;
    }

    //----STATUS FPTK----
    public function ShowSFptk(){
        $S_FPTK = DB::table('M_StatusFPTK')
            ->select('id','keterangan','active','deleted')
            ->where('deleted',0)
            ->get();
        return $S_FPTK;
    }
    public function DelSFptk(Request $request){
        $delted =1;
        $active =0;
        for ($i=0; $i <count($request->arrId_sfptk) ; $i++) { 
            DB::table('M_StatusFPTK')
                ->where('id',$request->arrId_sfptk[$i])
                ->update(['deleted'=>$delted,'active'=>$active]);
        }
        return true;
    }
    public function AddSFptk(Request $request){
        DB::table('M_StatusFPTK')
            ->insert([
                'keterangan'=>$request->new_sfptk,
                'active'=>'1',
                'deleted'=>'0'
            ]);
        return true;
    }
    public function ModalSFptk($id){
        $sfptk = DB::table('M_StatusFPTK')
            ->select('keterangan')
            ->where('id',$id)
            ->get();
        return $sfptk;
    }
    public function EditSFptk(Request $request){
        DB::table('M_StatusFPTK')
        ->where('id',$request->id_sfptk)
        ->update(['keterangan'=>$request->Edit_keterangan]);
        return true;
    }
    public function ActiveSFptk(Request $request){
        DB::table('M_StatusFPTK')
            ->where('id',$request->id_sfptk)
            ->update(['active'=>$request->active]);
        return true;
    }

    //----STATUS MCU----
    public function ShowSMcu(){
        $S_MCU = DB::table('M_MCUandTest')
            ->select('id','keterangan','active','deleted')
            ->where('jenis','MCU')
            ->where('deleted',0)
            ->get();
        return $S_MCU;
    }
    public function DelSMcu(Request $request){
        $delted =1;
        $active =0;
        for ($i=0; $i <count($request->arrId_smcu) ; $i++) { 
            DB::table('M_MCUandTest')
                ->where('id',$request->arrId_smcu[$i])
                ->update(['deleted'=>$delted,'active'=>$active]);
        }
        return true;
    }
    public function AddSMcu(Request $request){
        DB::table('M_MCUandTest')
            ->insert([
                'keterangan'=>$request->new_smcu,
                'jenis'=>'MCU',
                'active'=>'1',
                'deleted'=>'0'
            ]);
        return true;
    }
    public function ModalSMcu($id){
        $smcu = DB::table('M_MCUandTest')
            ->select('keterangan')
            ->where('id',$id)
            ->get();
        return $smcu;
    }
    public function ActiveSMcu(Request $request){
        DB::table('M_MCUandTest')
            ->where('id',$request->id_smcu)
            ->update(['active'=>$request->active]);
        return true;
    }
    public function EditSMcu(Request $request){
        DB::table('M_MCUandTest')
        ->where('id',$request->id_smcu)
        ->update(['keterangan'=>$request->Edit_keterangan]);
        return true;
    }

    //----STATUS TEST----
    public function ShowSTest(){
        $S_Test = DB::table('M_MCUandTest')
            ->select('id','keterangan','active','deleted')
            ->where('jenis','PSIKOTEST')
            ->where('deleted',0)
            ->get();
        return $S_Test;
    }
    public function DelSTest(Request $request){
        $delted =1;
        $active =0;
        for ($i=0; $i <count($request->arrId_stest) ; $i++) { 
            DB::table('M_MCUandTest')
                ->where('id',$request->arrId_stest[$i])
                ->update(['deleted'=>$delted,'active'=>$active]);
        }
        return true;
    }
    public function AddSTest(Request $request){
        DB::table('M_MCUandTest')
            ->insert([
                'keterangan'=>$request->new_stest,
                'jenis'=>'PSIKOTEST',
                'active'=>'1',
                'deleted'=>'0'
            ]);
        return true;
    }
    public function ModalSTest($id){
        $stest = DB::table('M_MCUandTest')
            ->select('keterangan')
            ->where('id',$id)
            ->get();
        return $stest;
    }
    public function ActiveSTest(Request $request){
        DB::table('M_MCUandTest')
            ->where('id',$request->id_stest)
            ->update(['active'=>$request->active]);
        return true;
    }
    public function EditSTest(Request $request){
        DB::table('M_MCUandTest')
        ->where('id',$request->id_stest)
        ->update(['keterangan'=>$request->Edit_keterangan]);
        return true;
    }

    //----STATUS TEST----
    public function ShowSRek(){
        $S_Test = DB::table('M_Rekrutmen')
            ->select('id','proses','active','deleted')
            ->where('deleted',0)
            ->get();
        return $S_Test;
    }
    public function DelSRek(Request $request){
        $delted =1;
        $active =0;
        for ($i=0; $i <count($request->arrId_srek) ; $i++) { 
            DB::table('M_Rekrutmen')
                ->where('id',$request->arrId_srek[$i])
                ->update(['deleted'=>$delted,'active'=>$active]);
        }
        return true;
    }
    public function AddSRek(Request $request){
        DB::table('M_Rekrutmen')
            ->insert([
                'proses'=>$request->new_srek,
                'active'=>'1',
                'deleted'=>'0'
            ]);
        return true;
    }
    public function ModalSRek($id){
        $srek = DB::table('M_Rekrutmen')
            ->select('proses')
            ->where('id',$id)
            ->get();
        return $srek;
    }
    public function ActiveSRek(Request $request){
        DB::table('M_Rekrutmen')
            ->where('id',$request->id_srek)
            ->update(['active'=>$request->active]);
        return true;
    }
    public function EditSRek(Request $request){
        DB::table('M_Rekrutmen')
        ->where('id',$request->id_srek)
        ->update(['proses'=>$request->Edit_keterangan]);
        return true;
    }

    //MASTER TABLE VENDOR
    public function indexVendor(){
        return view('master table/mt_vendor');
    }
    //----MCU----
    public function ShowMCU(){
        $filter='MCU';
        $MCU = DB::select('EXEC SP_Show_M_Vendor ?',array($filter));
        return $MCU;
    }
    public function DelMCU(Request $request){
        $delted =1;
        $active =0;
        for ($i=0; $i <count($request->arrId_mcu) ; $i++) { 
            DB::table('M_Vendor')
                ->where('id',$request->arrId_mcu[$i])
                ->update(['deleted'=>$delted,'active'=>$active]);
        }
        return true;
    }
    public function ActiveMCU(Request $request){
        DB::table('M_Vendor')
            ->where('id',$request->id_mcu)
            ->update(['active'=>$request->active]);
        return true;
    }
    public function AddMCU(Request $request){
        DB::beginTransaction();
        try {
            
            $id_vendor = DB::table('M_Vendor')
                        ->insertGetId([
                            'namaVendor'=>$request->new_namavendor,
                            'namaLab'=>$request->new_namalab,
                            'alamat'=>$request->new_alamat,
                            'jenis'=>'MCU',
                            'active'=>'1',
                            'deleted'=>'0'
                        ]);
            for ($i=0; $i <count($request->new_notlp) ; $i++) { 
                $new_notlp = trim($request->new_notlp[$i],'');
                $new_nofax = trim($request->new_nofax[$i],'');
                $new_email = trim($request->new_email[$i],'');
                $new_namapic = trim($request->new_namapic[$i],'');
                $new_tlppic = trim($request->new_tlppic[$i],'');

                if (!empty($new_notlp)||!empty($new_nofax)||!empty($new_email)||!empty($new_namapic)||!empty($new_tlppic)) {
                    DB::table('M_DVendor')
                    ->insert([
                        'id_Vendor'=>$id_vendor,
                        'noTlp'=>$new_notlp,
                        'noFax'=>$new_nofax,
                        'email'=>$new_email,
                        'namaPIC'=>$new_namapic,
                        'noTlpPIC'=>$new_tlppic
                    ]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
    public function ModalMCU($id){
        $MCU = DB::table('M_Vendor')
            ->select('namaVendor','NamaLab','alamat')
            ->where('id',$id)
            ->get();
        $detail = DB::table('M_DVendor')
                ->select ('noTlp','noFax','email','namaPIC','noTlpPIC')
                ->where('id_Vendor',$id)
                ->get();
        return [$MCU,$detail];
    }
    public function EditMCU(Request $request){
        DB::beginTransaction();
        try {
            DB::table('M_Vendor')
            ->where('id',$request->id_mcu)
            ->update([
                'namaVendor'=>$request->edit_namavendor,
                'namaLab'=>$request->edit_namalab,
                'alamat'=>$request->edit_alamat
            ]);
            
            //delete dulu baru insert
            DB::table('M_DVendor')->where('id_Vendor',$request->id_mcu)->delete();
            if ($request->edit_notlp!=null) {
                for ($i=0; $i <count($request->edit_notlp) ; $i++) { 
                    $edit_notlp = trim($request->edit_notlp[$i],'');
                    $edit_nofax = trim($request->edit_nofax[$i],'');
                    $edit_email = trim($request->edit_email[$i],'');
                    $edit_namapic = trim($request->edit_namapic[$i],'');
                    $edit_tlppic = trim($request->edit_tlppic[$i],'');
    
                    if (!empty($edit_notlp)||!empty($edit_nofax)||!empty($edit_email)||!empty($edit_namapic)||!empty($edit_tlppic)) {
                        DB::table('M_DVendor')
                        ->insert([
                            'id_Vendor'=>$request->id_mcu,
                            'noTlp'=>$edit_notlp,
                            'noFax'=>$edit_nofax,
                            'email'=>$edit_email,
                            'namaPIC'=>$edit_namapic,
                            'noTlpPIC'=>$edit_tlppic
                        ]);
                    }
                }
            }
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    //----PSIKOTEST----
    public function ShowPsikotest(){
        $filter='PSIKOTEST';
        $Psikotest = DB::select('EXEC SP_Show_M_Vendor ?',array($filter));
        return $Psikotest;
    }
    public function DelPsikotest(Request $request){
        $delted =1;
        $active =0;
        for ($i=0; $i <count($request->arrId_psikotest) ; $i++) { 
            DB::table('M_Vendor')
                ->where('id',$request->arrId_psikotest[$i])
                ->update(['deleted'=>$delted,'active'=>$active]);
        }
        return true;
    }
    public function ActivePsikotest(Request $request){
        DB::table('M_Vendor')
            ->where('id',$request->id_psikotest)
            ->update(['active'=>$request->active]);
        return true;
    }
    public function AddPsikotest(Request $request){
        DB::beginTransaction();
        try {
            
            $id_vendor = DB::table('M_Vendor')
                        ->insertGetId([
                            'namaVendor'=>$request->new_namavendor,
                            'alamat'=>$request->new_alamat,
                            'jenis'=>'PSIKOTEST',
                            'active'=>'1',
                            'deleted'=>'0'
                        ]);
            for ($i=0; $i <count($request->new_notlp) ; $i++) { 
                $new_notlp = trim($request->new_notlp[$i],'');
                $new_nofax = trim($request->new_nofax[$i],'');
                $new_email = trim($request->new_email[$i],'');
                $new_namapic = trim($request->new_namapic[$i],'');
                $new_tlppic = trim($request->new_tlppic[$i],'');

                if (!empty($new_notlp)||!empty($new_nofax)||!empty($new_email)||!empty($new_namapic)||!empty($new_tlppic)) {
                    DB::table('M_DVendor')
                    ->insert([
                        'id_Vendor'=>$id_vendor,
                        'noTlp'=>$new_notlp,
                        'noFax'=>$new_nofax,
                        'email'=>$new_email,
                        'namaPIC'=>$new_namapic,
                        'noTlpPIC'=>$new_tlppic
                    ]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
    public function ModalPsikotest($id){
        $MCU = DB::table('M_Vendor')
            ->select('namaVendor','alamat')
            ->where('id',$id)
            ->get();
        $detail = DB::table('M_DVendor')
                ->select ('noTlp','noFax','email','namaPIC','noTlpPIC')
                ->where('id_Vendor',$id)
                ->get();
        return [$MCU,$detail];
    }
    public function EditPsikotest(Request $request){
        DB::beginTransaction();
        try {
            DB::table('M_Vendor')
            ->where('id',$request->id_psikotest)
            ->update([
                'namaVendor'=>$request->edit_namavendor,
                'alamat'=>$request->edit_alamat
            ]);
            
            //delete dulu baru insert
            DB::table('M_DVendor')->where('id_Vendor',$request->id_psikotest)->delete();
            if ($request->edit_notlp!=null) {
                for ($i=0; $i <count($request->edit_notlp) ; $i++) { 
                    $edit_notlp = trim($request->edit_notlp[$i],'');
                    $edit_nofax = trim($request->edit_nofax[$i],'');
                    $edit_email = trim($request->edit_email[$i],'');
                    $edit_namapic = trim($request->edit_namapic[$i],'');
                    $edit_tlppic = trim($request->edit_tlppic[$i],'');
    
                    if (!empty($edit_notlp)||!empty($edit_nofax)||!empty($edit_email)||!empty($edit_namapic)||!empty($edit_tlppic)) {
                        DB::table('M_DVendor')
                        ->insert([
                            'id_Vendor'=>$request->id_psikotest,
                            'noTlp'=>$edit_notlp,
                            'noFax'=>$edit_nofax,
                            'email'=>$edit_email,
                            'namaPIC'=>$edit_namapic,
                            'noTlpPIC'=>$edit_tlppic
                        ]);
                    }
                }
            }
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
}
