<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudsController;


Auth::routes();



Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/check', [App\Http\Controllers\HomeController::class, 'gocheck']);


    Route::get('/', [CrudsController::class, 'showData']);
    Route::get('/add_user', [CrudsController::class, 'addData']);
    Route::post('/store_Data', [CrudsController::class, 'storeData']);
    Route::get('/edit_Data/{id}', [CrudsController::class, 'editData']);
    Route::post('/update_Data/{id}', [CrudsController::class, 'updateData']);
    Route::get('/delete_Data/{id}', [CrudsController::class, 'deleteData']);
});



