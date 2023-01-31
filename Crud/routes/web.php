<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [CrudController::class, 'showData']);
Route::get('/add_user', [CrudController::class, 'addData']);
Route::post('/store_Data', [CrudController::class, 'storeData']);
