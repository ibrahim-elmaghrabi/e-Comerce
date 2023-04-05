<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\CityController;
use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\Admin\ColorController;
use App\Http\Controllers\Api\Admin\StoreController;
use App\Http\Controllers\Api\Admin\CouponController;
use App\Http\Controllers\Api\Admin\AddressController;
use App\Http\Controllers\Api\Admin\CountryController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\CategoryController;

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

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::resource('stores', StoreController::class)->except('create');
    Route::resource('products', ProductController::class)->except('create');

});

Route::resources([
    'countries' =>  CountryController::class,
    'cities' =>  CityController::class,
    'categories', CategoryController::class,
    'admins', AdminController::class,
    'colors', ColorController::class,
    'coupons', CouponController::class,
    'addresses', AddressController::class,
], ['except' => ['create']]);








