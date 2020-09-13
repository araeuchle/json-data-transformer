<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'snapshots'], function() {
    Route::get('/', 'SnapshotController@list');
    Route::post('/add', 'SnapshotController@add');
    Route::get('/restore/{filename}', 'SnapshotController@restore');
    Route::delete('/{filename}', 'SnapshotController@delete');
    Route::delete('/', 'SnapshotController@deleteAll');
});

Route::group(['prefix' => 'export'],  function() {
    Route::post('/', 'ExportController@index');
});

