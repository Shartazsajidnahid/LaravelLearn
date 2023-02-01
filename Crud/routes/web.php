<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [CrudController::class, 'showData']);
Route::get('/add_user', [CrudController::class, 'addData']);
Route::post('/store_Data', [CrudController::class, 'storeData']);
Route::get('/edit_Data/{id}', [CrudController::class, 'editData']);
Route::post('/update_Data/{id}', [CrudController::class, 'updateData']);
Route::get('/delete_Data/{id}', [CrudController::class, 'deleteData']);
