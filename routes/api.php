<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'snapshots'], function() {
    Route::get('/', 'SnapshotController@list');
    Route::post('/add', 'SnapshotController@add');
});

