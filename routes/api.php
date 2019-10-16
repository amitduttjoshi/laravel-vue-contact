<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->group(function () {
    Route::post('/contacts', 'ContactController@store');
    Route::get('/contacts', 'ContactController@index');
    Route::get('/contact/{contact}', 'ContactController@show');
    Route::patch('/contact/{contact}', 'ContactController@update');
    Route::delete('/contact/{contact}', 'ContactController@destroy');
});
