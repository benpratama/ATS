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

//Master Table Vendor
Route::get('/hrdats/mt/vendor', 'MasterTableController@indexVendor')->name('mt.vendor');
