<?php

use Illuminate\Support\Facades\Route;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
],
    function ($router) {
    Route::post('login', '\App\Http\Controllers\AuthController@login');
    Route::post('logout', '\App\Http\Controllers\AuthController@logout');
    Route::post('refresh', '\App\Http\Controllers\AuthController@refresh');
    Route::post('me', '\App\Http\Controllers\AuthController@me');
});

Route::apiResource('user',\App\Http\Controllers\api\UserController::class)
    ->except('store')
    ->middleware('auth:api');
Route::apiResource('user',\App\Http\Controllers\api\UserController::class)
    ->only('store');


Route::apiResource('book',\App\Http\Controllers\api\BookController::class)
    ->only(['index', 'show'])
    ->middleware('auth:api');
Route::apiResource('book',\App\Http\Controllers\api\BookController::class)
    ->except(['index', 'show'])
    ->middleware(['auth:api', 'role:booker']);

Route::apiResource('borrow',\App\Http\Controllers\api\BorrowController::class)
    ->middleware('auth:api');
Route::post('return_book/{borrow}',[\App\Http\Controllers\api\BorrowController::class,'return_book'])
    ->middleware(['auth:api','role:booker']);
