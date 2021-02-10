<?php

use Illuminate\Support\Facades\Route;

Route::prefix('pangkat')->group(function() {
    Route::get('/showAll', 'PangkatController@showAll');
    Route::delete('/delete/{pangkat}', 'PangkatController@destroy');
    Route::post('/create', 'PangkatController@store');
    Route::post('/update/{pangkat}', 'PangkatController@update');
});

Route::prefix('instansi')->group(function() {
    Route::get('/showAll', 'InstansiController@showAll');
    Route::delete('/delete/{instansi}', 'InstansiController@destroy');
    Route::post('/create', 'InstansiController@store');
    Route::post('/update/{instansi}', 'InstansiController@update');
});

Route::prefix('transaksi')->group(function() {
    Route::post('/getAnggota', 'TransaksiController@getAnggota');
});

Route::get('/anggota/all', 'AnggotaController@showAll');

Route::get('/simpanan/jenis-simpanan', 'SimpananController@jenis');
