<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [\App\Http\Controllers\AuthApiController::class, 'register']);

Route::post('/auth/login', [\App\Http\Controllers\AuthApiController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', [\App\Http\Controllers\AuthApiController::class,'getAuthenticatedUser']);

    Route::post('/auth/logout', [\App\Http\Controllers\AuthApiController::class, 'logout']);

    Route::resource('berita',\App\Http\Controllers\API\BeritaAPIControlller::class);
});
