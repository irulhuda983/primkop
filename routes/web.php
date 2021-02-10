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

Auth::routes();


Route::group(['middleware' => ['get.menu']], function () {
    Route::middleware('auth')->group(function(){
        Route::get('/', 'HomeController@index');
    });
    
    Route::group(['middleware' => ['role:user']], function () {
        
        Route::prefix('transaksi')->group(function() {
            Route::get('', 'TransaksiController@index');
            Route::get('/{rekening}', 'TransaksiController@create');
            Route::post('/{rekening}/setor', 'TransaksiController@setor');
            Route::post('/{rekening}/potongan', 'TransaksiController@potongan');
            Route::post('/{rekening}/tarik', 'TransaksiController@tarik');
        });

        Route::prefix('simpanan')->group(function(){
            Route::get('/', 'SimpananController@index');
            Route::get('/{kode_transaksi}/edit', 'SimpananController@edit');
            Route::patch('/{simpanan}', 'SimpananController@update');
            Route::delete('/{simpanan}', 'SimpananController@destroy');
        });

        Route::prefix('potongan')->group(function(){
            Route::get('/', 'PotonganController@index')->name('potongan.index');
            Route::get('/{kode_transaksi}/edit', 'PotonganController@edit');
            Route::patch('/{potongan}', 'PotonganController@update');
            Route::delete('/{potongan}', 'PotonganController@destroy');
        });

        Route::prefix('penarikan')->group(function(){
            Route::get('/', 'PenarikanController@index');
            Route::get('/{kode_transaksi}/edit', 'PenarikanController@edit');
            Route::patch('/{penarikan}', 'PenarikanController@update');
            Route::delete('/{penarikan}', 'PenarikanController@destroy');
        });

        Route::prefix('report')->group(function(){
            Route::get('/', 'ReportController@index');
            Route::get('/export/{bulan}/{tahun}', 'ReportController@export');
            Route::get('/kesatuan/{kesatuan}', 'ReportController@showByKesatuan');
            Route::get('/export/{kesatuan}/{bulan}/{tahun}', 'ReportController@exportbyKesatuan');
        });

        Route::prefix('upload')->group(function() {
            Route::post('/anggota', 'UploadAnggotaController@store');
            Route::post('/rekening', 'UploadRekeningController@store');
            Route::get('/', 'UploadAnggotaController@index');
        });


    });


    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/pangkat', 'PangkatController@index');
        Route::get('/pangkat/{pangkat}', 'PangkatController@show');

        Route::get('/kesatuan', 'InstansiController@index');
        
        Route::prefix('anggota')->group(function() {
            Route::get('', 'AnggotaController@index');
            Route::get('/kesatuan/{instansi}', 'AnggotaController@detail');
            Route::get('/create', 'AnggotaController@create');
            Route::get('/{anggota}/edit', 'AnggotaController@edit');
            Route::post('/', 'AnggotaController@store');
            Route::patch('/{anggota}', 'AnggotaController@update');
            Route::delete('/{anggota}', 'AnggotaController@destroy');
        });

        Route::prefix('rekening')->group(function(){
            Route::patch('/{rekening}/update', 'RekeningController@update');
            Route::get('/{anggota}', 'RekeningController@show');
            Route::post('/', 'RekeningController@store');
        });

        Route::resource('users', 'UsersController')->except( ['create', 'store'] );

        Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
        Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');
        Route::prefix('menu/element')->group(function () { 
            Route::get('/',             'MenuElementController@index')->name('menu.index');
            Route::get('/move-up',      'MenuElementController@moveUp')->name('menu.up');
            Route::get('/move-down',    'MenuElementController@moveDown')->name('menu.down');
            Route::get('/create',       'MenuElementController@create')->name('menu.create');
            Route::post('/store',       'MenuElementController@store')->name('menu.store');
            Route::get('/get-parents',  'MenuElementController@getParents');
            Route::get('/edit',         'MenuElementController@edit')->name('menu.edit');
            Route::post('/update',      'MenuElementController@update')->name('menu.update');
            Route::get('/show',         'MenuElementController@show')->name('menu.show');
            Route::get('/delete',       'MenuElementController@delete')->name('menu.delete');
        });
        Route::prefix('menu/menu')->group(function () { 
            Route::get('/',         'MenuController@index')->name('menu.menu.index');
            Route::get('/create',   'MenuController@create')->name('menu.menu.create');
            Route::post('/store',   'MenuController@store')->name('menu.menu.store');
            Route::get('/edit',     'MenuController@edit')->name('menu.menu.edit');
            Route::post('/update',  'MenuController@update')->name('menu.menu.update');
            Route::get('/delete',   'MenuController@delete')->name('menu.menu.delete');
        });
    });
});