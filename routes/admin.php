<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\CityController;
use App\Http\Controllers\Api\Admin\StoreController;
use App\Http\Controllers\Api\Admin\CountryController;
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
});

Route::resource('countries', CountryController::class)->except('create');
Route::resource('cities', CityController::class)->except('create');
Route::resource('categories', CategoryController::class)->except('create');





