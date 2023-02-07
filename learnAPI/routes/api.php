<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);


Route::group(['middleware'=>'auth:sanctum'], function(){
    //productcontroller
    Route::resource('products', ProductController::class);

    Route::get('/logout', [UserController::class, 'logout']);
});


// Route::get('/getAlldata/{id?}', [ApiuserController::class, 'getAlldata']);
// Route::post('/storedata', [ApiuserController::class, 'storedata']);
// Route::put('/updatedata', [ApiuserController::class, 'updatedata']);
// Route::delete('/deletedata/{id}', [ApiuserController::class, 'deletedata']);
// Route::get('/search/{name}', [ApiuserController::class, 'search']);
