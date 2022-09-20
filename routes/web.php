<?php

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
    return view('welcome');
});

Auth::routes();

//Dashboar HRD
Route::get('/hrdats/dashboard/hrd', 'HomeController@index')->name('home');
Route::get('/hrdats/dashboard/hrd/summary','HomeController@ShowSummary')->name('hm.Summary');
Route::get('/hrdats/dashboard/hrd/name','HomeController@GetName')->name('hm.GetName');
Route::post('/hrdats/dashboard/hrd/detail','HomeController@ShowDetail')->name('hm.Detail');

//Detail Kandidat
Route::get('/hrdats/detail/kandidat/{id}/{noidentitas}', 'KandidatController@index')->name('dk.home');
Route::post('/hrdats/detail/kandidat/genurl','KandidatController@GenUrl')->name('dk.GenUrl');

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
//--Jurusan--
Route::get('/hrdats/mt/show/jurusan', 'MasterTableController@ShowJurusan')->name('mt.ShowJurusan');
Route::Post('/hrdats/mt/del/jurusan', 'MasterTableController@DelJurusan')->name('mt.DelJurusan');
Route::Post('/hrdats/mt/add/jurusan', 'MasterTableController@AddJurusan')->name('mt.AddJurusan');
Route::get('/hrdats/mt/modal/jurusan/{id}', 'MasterTableController@ModalJurusan')->name('mt.ModalJurusan');
Route::Post('/hrdats/mt/edit/jurusan', 'MasterTableController@EditJurusan')->name('mt.EditJurusan');
Route::Post('/hrdats/mt/active/jurusan', 'MasterTableController@ActiveJurusan')->name('mt.ActiveJurusan');
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

//--FORM Kandidat--
// Route::view('/term-of-use','termofuse')->name('termofuse');
Route::get('/form-kandidat/{url}','FormKandidatController@ShowForm1')->name('fk.ShowForm1');
Route::get('/form-kandidat/get/sim','FormKandidatController@GetSIM')->name('fk.GetSIM');
Route::post('/form-kandidat/kodepos','FormKandidatController@ShowKodePos')->name('fk.ShowKodePos');
Route::Post('/submit/form-kandidat','FormKandidatController@SubmitForm1')->name('fk.SubmitForm1');
Route::view('/submit/finish','form kandidat/terimakasih')->name('fk.terimakasih');

Route::get('/form-kandidat/phase2/{url}','FormKandidatController@ShowForm2')->name('fk.ShowForm2');
Route::Post('/submit/form-kandidat2','FormKandidatController@SubmitForm2')->name('fk.SubmitForm2');

//FPTK
Route::get('/hrdats/hrd/fptk', 'FptkController@index')->name('hr_fptk.index');
Route::get('/hrdats/hrd/export/fptk', 'FptkController@TemplateFptk')->name('hr_fptk.TemplateFptk');
Route::get('/hrdats/hrd/exportdata/fptk/{start}/{end}', 'FptkController@ExportDataFptk')->name('hr_fptk.ExportDataFptk');
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
