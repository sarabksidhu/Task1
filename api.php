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

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');*/

Route::group(['middleware' => 'cors'], function() {
	Route::post('/logindetails','LoginController@login' )->name('login');
    Route::get('/fetch-userlist','UserController@fetchUserlist');
    Route::post('/add-user','UserController@addUser');
    Route::post('/edit-user/{u_id?}','UserController@addUser');
});
