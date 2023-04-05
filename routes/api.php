<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\verificationController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;

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

Route::group(['middleware' => 'auth'], function (){
    Route::get('stores', [StoreController::class, 'index']);
    Route::post('stores', [StoreController::class, 'store']);
});


Route::post('register', RegisterController::class);
Route::post('verification',  verificationController::class);
Route::post('login', LoginController::class);
Route::put('forget_Password', [ResetPasswordController::class, 'forgetPassword']);
Route::post('verfiy_user', [ResetPasswordController::class, 'verfiyUser']);
Route::post('reset-passsword', [ResetPasswordController::class, 'setNewPassword']);


