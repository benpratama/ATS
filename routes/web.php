<?php

use App\Http\Controllers\EmailController;
use App\Http\Middleware\Atasan;
use App\Http\Middleware\CekLevel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::group([
        'middleware' => [CekLevel::class]
    ],function () {
        //Dashboar HRD
        Route::get('/hrdats/dashboard/hrd', 'HomeController@index')->name('home');
        Route::post('/hrdats/dashboard/hrd/summary','HomeController@ShowSummary')->name('hm.Summary');
        Route::get('/hrdats/dashboard/hrd/name','HomeController@GetName')->name('hm.GetName');
        Route::post('/hrdats/dashboard/hrd/detail','HomeController@ShowDetail')->name('hm.Detail');
        Route::post('/hrdats/dashboard/hrd/transfer','HomeController@TransferKandidat')->name('hm.TransferKandidat');
        Route::get('/hrdats/dashboard/getschedule','KandidatController@GetGSchedule')->name('dk.GetGSchedule');
        Route::get('/hrdats/dashboard/email/{nama}/{proses}','KandidatController@ShowDetailGEmail')->name('dk.ShowDetailGEmail');
        Route::post('/hrdats/dashboard/hrd/schedule/getkandiat','HomeController@ShowSchGkandidat')->name('hm.ShowSchGkandidat');


        // //Detail Kandidat
        Route::post('/hrdats/detail/kandidat/genurl','KandidatController@GenUrl')->name('dk.GenUrl');
        Route::post('/hrdats/detail/kandidat/genurl1','KandidatController@GenUrl1')->name('dk.GenUrl1');
        Route::post('/hrdats/detail/update/phase1','KandidatController@UpdateForm1')->name('dk.UpdateForm1');
        Route::post('/hrdats/detail/update/phase1_1','KandidatController@UpdateForm1_1')->name('dk.UpdateForm1_1');
        Route::post('/hrdats/detail/update/phase2','KandidatController@UpdateForm2')->name('dk.UpdateForm2');
        Route::Post('/hrdats/detail/setschedule/kandidat','KandidatController@SetSchedule')->name('dk.SetSchedule');
        Route::Post('/hrdats/detail/setschedule/groupkandidat','KandidatController@SetGSchedule')->name('dk.SetGSchedule');
        Route::Post('/hrdats/konten/email','KandidatController@GetKonten')->name('dk.GetKonten');
        Route::Post('/hrdats/send/email','KandidatController@SendEmail')->name('dk.SendEmail');
        Route::Post('/hrdats/send/groupemail','KandidatController@SendGEmail')->name('dk.SendGEmail');
        Route::get('/hrdats/detail/email/{id}','KandidatController@ShowDetailEmail')->name('dk.ShowDetailEmail');
        Route::get('/hrdats/detail/schedule/{id}','KandidatController@ShowDetailSchedule')->name('dk.ShowDetailSchedule');
        Route::get('/hrdats/detail/show/major', 'KandidatController@ShowMajor')->name('dk.ShowMajor');
        Route::get('/hrdats/detail/show/inst', 'KandidatController@ShowInst')->name('dk.ShowInst');
        Route::Post('/hrdats/edit/schedule','KandidatController@EditSchedule')->name('dk.EditSchedule');

        //Master Table Internal
        Route::get('/hrdats/mt/internal', 'MasterTableController@indexInternal')->name('mt.internal');
        //--JOB--
        Route::get('/hrdats/mt/show/job', 'MasterTableController@ShowJob')->name('mt.ShowJob');
        Route::Post('/hrdats/mt/del/job', 'MasterTableController@DelJob')->name('mt.DelJob');
        Route::Post('/hrdats/mt/add/job', 'MasterTableController@AddJob')->name('mt.AddJob');
        Route::get('/hrdats/mt/modal/job/{id}', 'MasterTableController@ModalJob')->name('mt.ModalJob');
        Route::Post('/hrdats/mt/edit/job', 'MasterTableController@EditJob')->name('mt.EditJob');
        Route::Post('/hrdats/mt/active/job', 'MasterTableController@ActiveJob')->name('mt.ActiveJob');
        //--USER--
        Route::get('/hrdats/mt/show/user', 'MasterTableController@ShowUser')->name('mt.ShowUser');
        Route::Post('/hrdats/mt/del/user', 'MasterTableController@DelUser')->name('mt.DelUser');
        Route::Post('/hrdats/mt/add/user', 'MasterTableController@AddUser')->name('mt.AddUser');
        Route::get('/hrdats/mt/modal/user/{id}', 'MasterTableController@ModalUser')->name('mt.ModalUser');
        Route::Post('/hrdats/mt/edit/user', 'MasterTableController@EditUser')->name('mt.EditUser');
        Route::Post('/hrdats/mt/active/user', 'MasterTableController@ActiveUser')->name('mt.ActiveUser');
        //--ORGANISASI--
        Route::get('/hrdats/mt/show/organisasi', 'MasterTableController@ShowOrganisasi')->name('mt.ShowOrganisasi');
        //--Dept--
        Route::get('/hrdats/mt/show/dept', 'MasterTableController@ShowDept')->name('mt.ShowDept');

        //Master Table Form
        Route::get('/hrdats/mt/form', 'MasterTableController@indexForm')->name('mt.form');
        //--SIM--
        Route::get('/hrdats/mt/show/sim', 'MasterTableController@ShowSim')->name('mt.showSim');
        Route::Post('/hrdats/mt/del/sim', 'MasterTableController@DelSim')->name('mt.DelSim');
        Route::Post('/hrdats/mt/add/sim', 'MasterTableController@AddSim')->name('mt.AddSim');
        Route::get('/hrdats/mt/modal/sim/{id}', 'MasterTableController@ModalSim')->name('mt.ModalSim');
        Route::Post('/hrdats/mt/edit/sim', 'MasterTableController@EditSim')->name('mt.EditSim');
        Route::Post('/hrdats/mt/active/sim', 'MasterTableController@ActiveSim')->name('mt.ActiveSim');
        //--DOMISILI--
        Route::get('/hrdats/mt/show/domisili', 'MasterTableController@ShowDomisili')->name('mt.ShowDomisili');
        Route::Post('/hrdats/mt/del/domisili', 'MasterTableController@DelDomisili')->name('mt.DelDomisili');
        Route::Post('/hrdats/mt/add/domisili', 'MasterTableController@AddDomisili')->name('mt.AddDomisili');
        Route::get('/hrdats/mt/modal/domisili/{id}', 'MasterTableController@ModalDomisili')->name('mt.ModalDomisili');
        Route::Post('/hrdats/mt/edit/domisili', 'MasterTableController@EditDomisili')->name('mt.EditDomisili');
        Route::Post('/hrdats/mt/active/domisili', 'MasterTableController@ActiveDomisili')->name('mt.ActiveDomisili');
        //--Edulvl--
        Route::get('/hrdats/mt/show/edulvl', 'MasterTableController@ShowEdulvl')->name('mt.ShowEdulvl');
        Route::Post('/hrdats/mt/del/edulvl', 'MasterTableController@DelEdulvl')->name('mt.DelEdulvl');
        Route::Post('/hrdats/mt/add/edulvl', 'MasterTableController@AddEdulvl')->name('mt.AddEdulvl');
        Route::get('/hrdats/mt/modal/edulvl/{id}', 'MasterTableController@ModalEdulvl')->name('mt.ModalEdulvl');
        Route::Post('/hrdats/mt/edit/edulvl', 'MasterTableController@EditEdulvl')->name('mt.EditEdulvl');
        Route::Post('/hrdats/mt/active/edulvl', 'MasterTableController@ActiveEdulvl')->name('mt.ActiveEdulvl');
        //--INST--
        Route::get('/hrdats/mt/show/inst', 'MasterTableController@ShowInst')->name('mt.ShowInst');
        Route::Post('/hrdats/mt/del/inst', 'MasterTableController@DelInst')->name('mt.DelInst');
        Route::Post('/hrdats/mt/add/inst', 'MasterTableController@AddInst')->name('mt.AddInst');
        Route::get('/hrdats/mt/modal/inst/{id}', 'MasterTableController@ModalInst')->name('mt.ModalInst');
        Route::Post('/hrdats/mt/edit/inst', 'MasterTableController@EditInst')->name('mt.EditInst');
        Route::Post('/hrdats/mt/active/inst', 'MasterTableController@ActiveInst')->name('mt.ActiveInst');
        //--Major--
        Route::get('/hrdats/mt/show/major', 'MasterTableController@ShowMajor')->name('mt.ShowMajor');
        Route::Post('/hrdats/mt/del/major', 'MasterTableController@DelMajor')->name('mt.DelMajor');
        Route::Post('/hrdats/mt/add/major', 'MasterTableController@AddMajor')->name('mt.AddMajor');
        Route::get('/hrdats/mt/modal/major/{id}', 'MasterTableController@ModalMajor')->name('mt.ModalMajor');
        Route::Post('/hrdats/mt/edit/major', 'MasterTableController@EditMajor')->name('mt.EditMajor');
        Route::Post('/hrdats/mt/active/major', 'MasterTableController@ActiveMajor')->name('mt.ActiveMajor');

        //--Jurusan--
        // Route::get('/hrdats/mt/show/jurusan', 'MasterTableController@ShowJurusan')->name('mt.ShowJurusan');
        // Route::Post('/hrdats/mt/del/jurusan', 'MasterTableController@DelJurusan')->name('mt.DelJurusan');
        // Route::Post('/hrdats/mt/add/jurusan', 'MasterTableController@AddJurusan')->name('mt.AddJurusan');
        // Route::get('/hrdats/mt/modal/jurusan/{id}', 'MasterTableController@ModalJurusan')->name('mt.ModalJurusan');
        // Route::Post('/hrdats/mt/edit/jurusan', 'MasterTableController@EditJurusan')->name('mt.EditJurusan');
        // Route::Post('/hrdats/mt/active/jurusan', 'MasterTableController@ActiveJurusan')->name('mt.ActiveJurusan');
        //--Perkawinan--
        Route::get('/hrdats/mt/show/perkawinan', 'MasterTableController@ShowPerkawinan')->name('mt.ShowPerkawinan');
        Route::Post('/hrdats/mt/del/perkawinan', 'MasterTableController@DelPerkawinan')->name('mt.DelPerkawinan');
        Route::Post('/hrdats/mt/add/perkawinan', 'MasterTableController@AddPerkawinan')->name('mt.AddPerkawinan');
        Route::get('/hrdats/mt/modal/perkawinan/{id}', 'MasterTableController@ModalPerkawinan')->name('mt.ModalPerkawinan');
        Route::Post('/hrdats/mt/edit/perkawinan', 'MasterTableController@EditPerkawinan')->name('mt.EditPerkawinan');
        Route::Post('/hrdats/mt/active/perkawinan', 'MasterTableController@ActivePerkawinan')->name('mt.ActivePerkawinan');
        //--Status FPTK--
        Route::get('/hrdats/mt/show/sfptk', 'MasterTableController@ShowSFptk')->name('mt.ShowSFptk');
        Route::Post('/hrdats/mt/del/sfptk', 'MasterTableController@DelSFptk')->name('mt.DelSFptk');
        Route::Post('/hrdats/mt/add/sfptk', 'MasterTableController@AddSFptk')->name('mt.AddSFptk');
        Route::get('/hrdats/mt/modal/sfptk/{id}', 'MasterTableController@ModalSFptk')->name('mt.ModalSFptk');
        Route::Post('/hrdats/mt/edit/sfptk', 'MasterTableController@EditSFptk')->name('mt.EditSFptk');
        Route::Post('/hrdats/mt/active/sfptk', 'MasterTableController@ActiveSFptk')->name('mt.ActiveSFptk');
        //--Status MCU--
        Route::get('/hrdats/mt/show/smcu', 'MasterTableController@ShowSMcu')->name('mt.ShowSMcu');
        Route::Post('/hrdats/mt/del/smcu', 'MasterTableController@DelSMcu')->name('mt.DelSMcu');
        Route::Post('/hrdats/mt/add/smcu', 'MasterTableController@AddSMcu')->name('mt.AddSMcu');
        Route::get('/hrdats/mt/modal/smcu/{id}', 'MasterTableController@ModalSMcu')->name('mt.ModalSMcu');
        Route::Post('/hrdats/mt/edit/smcu', 'MasterTableController@EditSMcu')->name('mt.EditSMcu');
        Route::Post('/hrdats/mt/active/smcu', 'MasterTableController@ActiveSMcu')->name('mt.ActiveSMcu');
        //--Status Test--
        Route::get('/hrdats/mt/show/stest', 'MasterTableController@ShowSTest')->name('mt.ShowSTest');
        Route::Post('/hrdats/mt/del/stest', 'MasterTableController@DelSTest')->name('mt.DelSTest');
        Route::Post('/hrdats/mt/add/stest', 'MasterTableController@AddSTest')->name('mt.AddSTest');
        Route::get('/hrdats/mt/modal/stest/{id}', 'MasterTableController@ModalSTest')->name('mt.ModalSTest');
        Route::Post('/hrdats/mt/edit/stest', 'MasterTableController@EditSTest')->name('mt.EditSTest');
        Route::Post('/hrdats/mt/active/stest', 'MasterTableController@ActiveSTest')->name('mt.ActiveSTest');
        //--Status Rekrutmen--
        Route::get('/hrdats/mt/show/srek', 'MasterTableController@ShowSRek')->name('mt.ShowSRek');
        Route::Post('/hrdats/mt/del/srek', 'MasterTableController@DelSRek')->name('mt.DelSRek');
        Route::Post('/hrdats/mt/add/srek', 'MasterTableController@AddSRek')->name('mt.AddSRek');
        Route::get('/hrdats/mt/modal/srek/{id}', 'MasterTableController@ModalSRek')->name('mt.ModalSRek');
        Route::Post('/hrdats/mt/edit/srek', 'MasterTableController@EditSRek')->name('mt.EditSRek');
        Route::Post('/hrdats/mt/active/srek', 'MasterTableController@ActiveSRek')->name('mt.ActiveSRek');

        Route::get('/hrdats/mt/show/fam', 'MasterTableController@ShowFam')->name('mt.ShowFam');
        Route::Post('/hrdats/mt/del/fam', 'MasterTableController@DelFam')->name('mt.DelFam');
        Route::Post('/hrdats/mt/add/fam', 'MasterTableController@AddFam')->name('mt.AddFam');
        Route::get('/hrdats/mt/modal/fam/{id}', 'MasterTableController@ModalFam')->name('mt.ModalFam');
        Route::Post('/hrdats/mt/edit/fam', 'MasterTableController@EditFam')->name('mt.EditFam');
        Route::Post('/hrdats/mt/active/fam', 'MasterTableController@ActiveFam')->name('mt.ActiveFam');
        //Master Table Vendor
        Route::get('/hrdats/mt/vendor', 'MasterTableController@indexVendor')->name('mt.vendor');
        //--Status MCU--
        Route::get('/hrdats/mt/show/mcu', 'MasterTableController@ShowMCU')->name('mt.ShowMCU');
        Route::Post('/hrdats/mt/del/mcu', 'MasterTableController@DelMCU')->name('mt.DelMCU');
        Route::Post('/hrdats/mt/add/mcu', 'MasterTableController@AddMCU')->name('mt.AddMCU');
        Route::get('/hrdats/mt/modal/mcu/{id}', 'MasterTableController@ModalMCU')->name('mt.ModalMCU');
        Route::Post('/hrdats/mt/edit/mcu', 'MasterTableController@EditMCU')->name('mt.EditMCU');
        Route::Post('/hrdats/mt/active/mcu', 'MasterTableController@ActiveMCU')->name('mt.ActiveMCU');
        //--Status PSIKOTEST--
        Route::get('/hrdats/mt/show/psikotest', 'MasterTableController@ShowPsikotest')->name('mt.ShowPsikotest');
        Route::Post('/hrdats/mt/del/psikotest', 'MasterTableController@DelPsikotest')->name('mt.DelPsikotest');
        Route::Post('/hrdats/mt/add/psikotest', 'MasterTableController@AddPsikotest')->name('mt.AddPsikotest');
        Route::get('/hrdats/mt/modal/psikotest/{id}', 'MasterTableController@ModalPsikotest')->name('mt.ModalPsikotest');
        Route::Post('/hrdats/mt/edit/psikotest', 'MasterTableController@EditPsikotest')->name('mt.EditPsikotest');
        Route::Post('/hrdats/mt/active/psikotest', 'MasterTableController@ActivePsikotest')->name('mt.ActivePsikotest');
        //FPTK
        Route::get('/hrdats/hrd/fptk', 'FptkController@index')->name('hr_fptk.index');
        Route::get('/hrdats/hrd/export/fptk', 'FptkController@TemplateFptk')->name('hr_fptk.TemplateFptk');
        Route::get('/hrdats/hrd/exportdata/fptk/{Fstart}/{Fend}', 'FptkController@ExportDataFptk')->name('hr_fptk.ExportDataFptk');
        Route::post('/hrdats/hrd/import/fptk', 'FptkController@ImportFptk')->name('hr_fptk.ImportFptk');
        Route::POST('/hrdats/hrd/show/fptk', 'FptkController@ShowFptk')->name('hr_fptk.ShowFptk');
        // -- masuk ke detail
        Route::get('/hrdats/hrd/show/detail/fptk/{id}', 'FptkController@ShowDetailFptk')->name('hr_fptk.ShowDetailFptk'); //masuk ke halaman detail-nya
        Route::get('/hrdats/hrd/show/detailkandidat/fptk/{id}', 'FptkController@ShowDetailKandidatFptk')->name('hr_fptk.ShowDetailKandidatFptk'); // show kandidat yang udah dipilih
        Route::get('/hrdats/hrd/show/kandidat/fptk', 'FptkController@ShowKandidat')->name('hr_fptk.ShowKandidat'); //list seluruh kandidat
        Route::get('/hrdats/hrd/modaldetail/kandiat/fptk/{idF}/{idK}','FptkController@ShowModalKandidat')->name('hr_fptk.ShowModalKandidat');
        Route::Post('/hrdats/hrd/update/fptk','FptkController@UpdateFptk')->name('hr_fptk.UpdateFptk');
        Route::post('/hrdats/hrd/show/updatemodal/fptk/','FptkController@UpdateModal')->name('hr_fptk.UpdateModal');
        Route::post('/hrdats/hrd/cek/posisi','FptkController@CekPosisi')->name('hr_fptk.CekPosisi');
        Route::post('/hrdats/hrd/cek/organisasi','FptkController@CekOrganisasi')->name('hr_fptk.CekOrganisasi');
        Route::post('/hrdats/hrd/cek/nik','FptkController@CekNik')->name('hr_fptk.CekNik');
        Route::post('/hrdats/hrd/delete/kandidat/fptk','FptkController@DelKandidat')->name('hr_fptk.DelKandidat');
        Route::get('/hrdats/hrd/show/logfptk/{nofptk}', 'FptkController@Showlog')->name('hr_fptk.Showlog');

        //MPP
        Route::get('/hrdats/hrd/mpp', 'MppController@index')->name('hr_mpp.index');
        Route::get('/hrdats/hrd/export/mpp', 'MppController@TemplateMpp')->name('hr_mpp.TemplateMpp');
        Route::post('/hrdats/hrd/import/mpp', 'MppController@ImportMpp')->name('hr_mpp.ImportMpp');
        Route::post('/hrdats/hrd/show/mpp', 'MppController@ShowMpp')->name('hr_mpp.ShowMpp');
        Route::post('/hrdats/hrd/update/mpp', 'MppController@UpdateMpp')->name('hr_mpp.UpdateMpp');

        //LINK
        Route::get('/hrdats/hrd/link','UrlController@index')->name('hr_url.index');
        Route::get('/hrdats/hrd/show/link','UrlController@ShowUrl')->name('hr_url.ShowUrl');
        Route::get('/hrdats/hrd/modal/link/{id}', 'UrlController@ModalUrl')->name('hr_url.ModalUrl');
        Route::get('/hrdats/hrd/modal2/link/{id}', 'UrlController@ModalUrl2')->name('hr_url.ModalUrl2');
        Route::Post('/hrdats/hrd/edit/link', 'UrlController@EdiUrl')->name('hr_url.EdiUrl');
        Route::Post('/hrdats/hrd/add/link', 'UrlController@AddUrl')->name('hr_url.AddUrl');
        Route::Post('/hrdats/hrd/active/link', 'UrlController@ActiveUrl')->name('hr_url.ActiveUrl');
        Route::Post('/hrdats/hrd/del/link', 'UrlController@DelUrl')->name('hr_url.DelUrl');

        //DOKUMEN
        Route::post('/hrdats/hrd/Dokumen/eth/mcu', 'DokumenController@ETHsurat')->name('doc.ETHsurat');
        Route::post('/hrdats/hrd/Dokumen/fima/mcu', 'DokumenController@Fimasurat')->name('doc.Fimasurat');
        Route::post('/hrdats/hrd/Dokumen/hj/mcu', 'DokumenController@HJsurat')->name('doc.HJsurat');
        Route::post('/hrdats/hrd/Dokumen/fkpk', 'DokumenController@fkpk')->name('doc.fkpk');
        Route::post('/hrdats/hrd/Dokumen/psikotes/solutiva','DokumenController@solutiva')->name('doc.solutiva');
        Route::post('/hrdats/hrd/Dokumen/psikotes/firstasia','DokumenController@firstasia')->name('doc.firstasia');

        //EMAIL
        Route::get('/mailsourcing','EmailController@ESourcing')->name('em.ESourcing');

        //BUAT TESTING
        // Route::get('/test','FormKandidatController@Test')->name('fk.Test');

        //AKSES MENU
        Route::get('/hrdats/menu','MenuController@Index')->name('hr_menu.index');
        Route::get('/hrdats/menu/getMPP','MenuController@getMPP')->name('hr_menu.getMPP');
        Route::Post('/hrdats/menu/active/akses', 'MenuController@ActiveAkses')->name('hr_menu.ActiveAkses');
        Route::Post('/hrdats/menu/del/akses', 'MenuController@DelAkses')->name('hr_menu.DelAkses');
        Route::Post('/hrdats/menu/add/akses', 'MenuController@AddAkses')->name('hr_menu.AddAkses');

        //WA
        Route::get('/hrdats/menu/wa', 'MenuController@registWA')->name('hr_wa.index');
    });
    Route::group([
        'middleware' => [Atasan::class]
    ],function () {
        Route::get('/hrdats/requestor/mpp','RequestorController@indexMPP')->name('rq.indexMPP');
        Route::post('/hrdats/requestor/show/mpp', 'RequestorController@ShowMpp')->name('rq.ShowMpp');
    });
    Route::get('/hrdats/requestor/dashboard','RequestorController@index')->name('rq.home');
    Route::post('/hrdats/requestor/filterdashboard','RequestorController@indexFilter')->name('rq.indexFilter');
    Route::post('/hrdats/requestor/listfptk','RequestorController@R_ListFptk')->name('rq.R_ListFptk');
    Route::post('/hrdats/requestor/summaryfptk','RequestorController@R_SummaryFptk')->name('rq.R_SummaryFptk');
    Route::get('/hrdats/requestor/lhw/{golongan}/{idkandidat}/{idfptk}', 'RequestorController@TemplateLHW')->name('rq.TemplateLHW');
    Route::post('/hrdats/requestor/import/lhw', 'RequestorController@ImportLHW')->name('rq.ImportLHW');

    //Detail Kandidat
    Route::get('/hrdats/detail/kandidat/{id}/{noidentitas}', 'KandidatController@index')->name('dk.home');
    Route::get('/hrdats/detail/getkontak/kandidat/{id}','KandidatController@GetKontak')->name('dk.GetKontak');
    Route::get('/hrdats/detail/getsim/kandidat/{id}','KandidatController@GetSim')->name('dk.GetSim');
    Route::get('/hrdats/detail/getpendidikan/kandidat/{id}','KandidatController@GetPendidikan')->name('dk.GetPendidikan');
    Route::get('/hrdats/detail/getpekerjaan/kandidat/{id}','KandidatController@GetPekerjaan')->name('dk.GetPekerjaan');
    Route::get('/hrdats/detail/listsim','KandidatController@ListSim')->name('dk.ListSim');
    Route::get('/hrdats/detail/logfptk/{id}','KandidatController@Showlog')->name('dk.Showlog');
    
    //detail phase2
    Route::get('/hrdats/detail/getpelatihan/kandidat/{id}','KandidatController@GetPelatihan')->name('dk.GetPelatihan');
    Route::get('/hrdats/detail/getbahasa/kandidat/{id}','KandidatController@GetBahasa')->name('dk.GetBahasa');
    Route::get('/hrdats/detail/getorganisasi/kandidat/{id}','KandidatController@GetOrganisasi')->name('dk.GetOrganisasi');
    Route::get('/hrdats/detail/getkenal/kandidat/{id}','KandidatController@GetKenal')->name('dk.GetKenal');
    Route::get('/hrdats/detail/getkerabat/kandidat/{id}','KandidatController@GetKerabat')->name('dk.GetKerabat');
    Route::get('/hrdats/detail/getkeluarga/kandidat/{id}','KandidatController@GetKeluarga')->name('dk.GetKeluarga');
    Route::get('/hrdats/detail/getschedule/kandidat/{id}','KandidatController@GetSchedule')->name('dk.GetSchedule');
    Route::get('/hrdats/detail/getschedule/notes/{id}','KandidatController@GetNotes')->name('dk.GetNotes');
    Route::post('/hrdats/detail/getschedule/update/notes','KandidatController@SetNotes')->name('dk.SetNotes');
});

//--FORM Kandidat--
// Route::view('/term-of-use','termofuse')->name('termofuse');
Route::get('/form-kandidat-jf/{url}','FormKandidatController@ShowFormjf')->name('fk.ShowFormjf');
Route::Post('/submit/form-kandidat-jf','FormKandidatController@SubmitFormjf')->name('fk.SubmitFormjf');
Route::get('/form-kandidat/{url}','FormKandidatController@ShowForm1')->name('fk.ShowForm1');
Route::post('/form-kandidat/kodepos','FormKandidatController@ShowKodePos')->name('fk.ShowKodePos');
Route::Post('/submit/form-kandidat','FormKandidatController@SubmitForm1')->name('fk.SubmitForm1');
Route::get('/getpendidikan/form-kandidat-jf/{id}','FormKandidatController@GetPendidikanF')->name('fk.GetPendidikanF');
Route::view('/submit/finish','form kandidat/terimakasih')->name('fk.terimakasih');

Route::get('/form-kandidat/phase2/{url}','FormKandidatController@ShowForm2')->name('fk.ShowForm2');
Route::Post('/submit/form-kandidat2','FormKandidatController@SubmitForm2')->name('fk.SubmitForm2');

//data form
Route::get('/form-kandidat/get/edulvlandcity','FormKandidatController@GetEduLvlandCity')->name('fk.GetEduLvlandCity');
Route::get('/form-kandidat/get/famrel','FormKandidatController@GetFamRel')->name('fk.GetFamRel');
Route::get('/form-kandidat/get/sim','FormKandidatController@GetSIM')->name('fk.GetSIM');

///////////////REQUESTOR///////////////////

