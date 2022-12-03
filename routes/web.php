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
    return view('home');
});

Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    return 'clear';
});

Route::get('login', 'AuthController@login')->name('login');
Route::post('login', 'AuthController@postLogin')->name('login.post');
Route::post('logout', 'AuthController@logout')->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

    Route::get('nota-dinas', 'SuratNotaDinasController@index')->name('nota.dinas.index');
    Route::get('nota-dinas/create', 'SuratNotaDinasController@create')->name('nota.dinas.create');
    // Route::get('nota-dinas/download/{file_lama_atau_baru}/{surat_id}/', 'SuratNotaDinasController@download')->name('nota-dinas.download');
    Route::post('nota-dinas', 'SuratNotaDinasController@store')->name('nota.dinas.store');
    Route::get('nota-dinas/edit/{id}', 'SuratNotaDinasController@edit')->name('nota.dinas.edit');
    Route::post('nota-dinas/update/{id}', 'SuratNotaDinasController@update')->name('nota.dinas.update');
    Route::delete('nota-dinas/delete/{id}', 'SuratNotaDinasController@delete')->name('nota.dinas.delete');



    Route::get('undangan', 'SuratUndanganController@index')->name('undangan.index');
    Route::get('undangan/create', 'SuratUndanganController@create')->name('undangan.create');
    // Route::get('undangan/download/{file_lama_atau_baru}/{surat_id}/', 'SuratUndanganController@download')->name('undangan.download');
    Route::post('undangan', 'SuratUndanganController@store')->name('undangan.store');
    Route::get('undangan/edit/{id}', 'SuratUndanganController@edit')->name('undangan.edit');
    Route::post('undangan/update/{id}', 'SuratUndanganController@update')->name('undangan.update');
    Route::delete('undangan/delete/{id}', 'SuratUndanganController@delete')->name('undangan.delete');

    Route::get('biasa', 'SuratBiasaController@index')->name('biasa.index');
    Route::get('biasa/create', 'SuratBiasaController@create')->name('biasa.create');
    // Route::get('biasa/download/{file_lama_atau_baru}/{surat_id}/', 'SuratBiasaController@download')->name('biasa.download');
    Route::post('biasa', 'SuratBiasaController@store')->name('biasa.store');
    Route::get('biasa/edit/{id}', 'SuratBiasaController@edit')->name('biasa.edit');
    Route::post('biasa/update/{id}', 'SuratBiasaController@update')->name('biasa.update');
    Route::delete('biasa/delete/{id}', 'SuratBiasaController@delete')->name('biasa.delete');

    Route::get('tracking/{surat_id}', 'Admin\TrackingController@index')->name('tracking.surat.index');

    Route::get('kirim/email/{file_lama_atau_baru}/{surat_id}', 'SuratController@sendEmail')->name('send.email');


    Route::get('admin/surat-nota-dinas/download/{file_lama_atau_baru}/{surat_id}/', 'Admin\SuratNotaDinasController@download')->name('admin.surat-nota-dinas.download');
    Route::get('admin/surat-undangan/download/{file_lama_atau_baru}/{surat_id}/', 'Admin\SuratUndanganController@download')->name('admin.surat-undangan.download');
    Route::get('admin/surat-biasa/download/{file_lama_atau_baru}/{surat_id}/', 'Admin\SuratBiasaController@download')->name('admin.surat-biasa.download');

    // store update undangan
    Route::post('admin/surat-undangan', 'Admin\SuratUndanganController@store')->name('admin.surat-undangan.store');
    Route::post('admin/surat-undangan/update/{id}', 'Admin\SuratUndanganController@update')->name('admin.surat-undangan.update');

    // store update nota dinas
    Route::post('surat-nota-dinas', 'Admin\SuratNotaDinasController@store')->name('admin.surat-nota-dinas.store');
    Route::post('surat-nota-dinas/update/{id}', 'Admin\SuratNotaDinasController@update')->name('admin.surat-nota-dinas.update');

    // store update permohnan
    Route::post('surat-biasa', 'Admin\SuratBiasaController@store')->name('admin.surat-biasa.store');
    Route::post('surat-biasa/update/{id}', 'Admin\SuratBiasaController@update')->name('admin.surat-biasa.update');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard.index');

    // CRUD BIRO
    Route::get('pegawai', 'Admin\PegawaiController@index')->name('admin.pegawai.index');
    Route::post('pegawai/create', 'Admin\PegawaiController@store')->name('admin.pegawai.store');
    Route::post('pegawai/update/{id}', 'Admin\PegawaiController@update')->name('admin.pegawai.update');
    Route::delete('pegawai/delete/{id}', 'Admin\PegawaiController@delete')->name('admin.pegawai.delete');


    // CRUD BIRO
    Route::get('biro', 'Admin\BiroController@index')->name('admin.biro.index');
    Route::post('biro/create', 'Admin\BiroController@store')->name('admin.biro.store');
    Route::post('biro/update/{id}', 'Admin\BiroController@update')->name('admin.biro.update');
    Route::delete('biro/delete/{id}', 'Admin\BiroController@delete')->name('admin.biro.delete');


    // CRUD BIRO
    Route::get('tembusan', 'Admin\TembusanController@index')->name('admin.tembusan.index');
    Route::post('tembusan/create', 'Admin\TembusanController@store')->name('admin.tembusan.store');
    Route::post('tembusan/update/{id}', 'Admin\TembusanController@update')->name('admin.tembusan.update');
    Route::delete('tembusan/delete/{id}', 'Admin\TembusanController@delete')->name('admin.tembusan.delete');


    // CRUD YTH
    Route::get('yth', 'Admin\YthController@index')->name('admin.yth.index');
    Route::post('yth/create', 'Admin\YthController@store')->name('admin.yth.store');
    Route::post('yth/update/{id}', 'Admin\YthController@update')->name('admin.yth.update');
    Route::delete('yth/delete/{id}', 'Admin\YthController@delete')->name('admin.yth.delete');


    Route::get('surat-nota-dinas', 'Admin\SuratNotaDinasController@index')->name('admin.surat-nota-dinas.index');
    Route::get('surat-nota-dinas/create', 'Admin\SuratNotaDinasController@create')->name('admin.surat-nota-dinas.create');
    Route::get('surat-nota-dinas/edit/{surat_id}', 'Admin\SuratNotaDinasController@edit')->name('admin.surat-nota-dinas.edit');
    // Route::post('surat-nota-dinas', 'Admin\SuratNotaDinasController@store')->name('admin.surat-nota-dinas.store');
    // Route::post('surat-nota-dinas/update/{id}', 'Admin\SuratNotaDinasController@update')->name('admin.surat-nota-dinas.update');
    Route::delete('surat-nota-dinas/delete/{id}', 'Admin\SuratNotaDinasController@delete')->name('admin.surat-nota-dinas.delete');


    Route::get('surat-undangan', 'Admin\SuratUndanganController@index')->name('admin.surat-undangan.index');
    Route::get('surat-undangan/create', 'Admin\SuratUndanganController@create')->name('admin.surat-undangan.create');
    Route::get('surat-undangan/edit/{surat_id}', 'Admin\SuratUndanganController@edit')->name('admin.surat-undangan.edit');
    // Route::post('surat-undangan', 'Admin\SuratUndanganController@store')->name('admin.surat-undangan.store');
    // Route::post('surat-undangan/update/{id}', 'Admin\SuratUndanganController@update')->name('admin.surat-undangan.update');
    Route::delete('surat-undangan/delete/{id}', 'Admin\SuratUndanganController@delete')->name('admin.surat-undangan.delete');

    Route::get('surat-biasa', 'Admin\SuratBiasaController@index')->name('admin.surat-biasa.index');
    Route::get('surat-biasa/create', 'Admin\SuratBiasaController@create')->name('admin.surat-biasa.create');
    Route::get('surat-biasa/edit/{surat_id}', 'Admin\SuratBiasaController@edit')->name('admin.surat-biasa.edit');
    // Route::post('surat-undangan', 'Admin\SuratUndanganController@store')->name('admin.surat-undangan.store');
    // Route::post('surat-undangan/update/{id}', 'Admin\SuratUndanganController@update')->name('admin.surat-undangan.update');
    Route::delete('surat-biasa/delete/{id}', 'Admin\SuratBiasaController@delete')->name('admin.surat-biasa.delete');

    Route::post('upload/{surat_id}', 'Admin\SuratController@upload')->name('upload.surat');


    Route::get('tracking/{surat_id}', 'Admin\TrackingController@index')->name('admin.tracking.surat.index');
    Route::post('tracking/{surat_id}', 'Admin\TrackingController@store')->name('admin.tracking.surat.store');
});
