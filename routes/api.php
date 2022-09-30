<?php

use App\Http\Controllers\ApiAdmin;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->group(function () {
    Route::post('/signup', [ApiAdmin::class, 'signup'])->name('api_login');
    Route::post('/login', [ApiAdmin::class, 'login'])->name('api_login')->middleware('alreadyloggedin');
    Route::get('/logout', [ApiAdmin::class, 'logout'])->name('api_logout')->middleware('auth:sanctum');
    Route::get('/user', function (Request $request){
        return $request->user();
    })->middleware('auth:sanctum');
});


Route::any('cats', 'apiController@cats');
Route::any('news', 'apiController@news');

Route::post('login', 'apiController@login');
