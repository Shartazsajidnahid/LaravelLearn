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

use App\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('store-image', [ImageController::class, 'store_image'])->name('store_image');
Route::post('save-image', [ImageController::class, 'save_image'])->name('save_image');
Route::get('image-list', [ImageController::class, 'image_list'])->name('image_list');
