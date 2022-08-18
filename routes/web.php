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

Route::get('/hrdats/dashboard/hrd', 'HomeController@index')->name('home');

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