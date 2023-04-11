<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Mobile\OrderController;
use App\Http\Controllers\Api\Mobile\StoreController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Mobile\AddressController;
use App\Http\Controllers\Api\Mobile\ContactController;
use App\Http\Controllers\Api\Mobile\ProductController;
use App\Http\Controllers\Api\Mobile\ProfileController;
use App\Http\Controllers\Api\Auth\verificationController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Mobile\ReturningRequestController;

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
    Route::get('stores', StoreController::class);
    Route::resource('orders', OrderController::class)->except('edit', 'update', 'destroy', 'create');
    Route::post('contacts', ContactController::class);
    Route::get('products', [ProductController::class, 'index']);
    Route::resource('returning_requests', ReturningRequestController::class)->except('create', 'edit', 'update', 'destroy');
    Route::resource('addresses', AddressController::class)->except('create');


});


Route::post('register', RegisterController::class);
Route::post('verification',  verificationController::class);
Route::post('user_login', [LoginController::class, 'login']);
Route::put('forget_password', [ResetPasswordController::class, 'forgetPassword']);
Route::post('verify_user', [ResetPasswordController::class, 'verifyUser']);
Route::post('reset-password', [ResetPasswordController::class, 'setNewPassword']);


