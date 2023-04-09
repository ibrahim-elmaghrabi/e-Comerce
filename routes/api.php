<?php

use Illuminate\Http\Request;
use App\Models\ReturningRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Mobile\OrderController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Mobile\ProfileController;
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

Route::group(['middleware' => 'auth:sanctum'], function (){

    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('profile', [ProfileController::class, 'profile']);
    Route::get('profile/edit', [ProfileController::class, 'editProfile']);
    Route::put('profile', [ProfileController::class, 'updateProfile']);
    Route::put('profile/change_password', [ProfileController::class, 'changePassword']);

    Route::resource('returning_requests', ReturningRequest::class)->except('edit','update','destroy');

    Route::post('orders', [OrderController::class, 'store']);

});


Route::post('register', RegisterController::class);
Route::post('verification',  verificationController::class);
Route::post('user_login', [LoginController::class, 'login']);
Route::put('forget_password', [ResetPasswordController::class, 'forgetPassword']);
Route::post('verfiy_user', [ResetPasswordController::class, 'verfiyUser']);
Route::post('reset-passsword', [ResetPasswordController::class, 'setNewPassword']);


