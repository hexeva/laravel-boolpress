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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Rotta per API le rotte create in questo file hanno di default l'url base /api
Route::get('/posts', 'Api\PostController@index');

// Rotta per endpoint Api del dettaglio del singolo Post
Route::get('/posts/{slug}','Api\PostController@show');

// Rotta per endpoint Tags
Route::get('/tags/{slug}','Api\TagController@show');

// Rotta per Api LEads
Route::post('/leads/store', 'Api\LeadController@store');