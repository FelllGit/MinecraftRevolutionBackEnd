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

Route::get('users', 'App\Http\Controllers\User\UserController@GetAllUsers');
Route::get('user', 'App\Http\Controllers\User\UserController@getUserInfo')->middleware('jwt.auth');
Route::get('users/{id}', 'App\Http\Controllers\User\UserController@GetUserByID');
Route::post('users', 'App\Http\Controllers\User\UserController@CreateUser');
Route::put('users/{id}', 'App\Http\Controllers\User\UserController@EditUser');
Route::delete('users/{id}', 'App\Http\Controllers\User\UserController@DeleteUser');

Route::post('/authenticate', 'App\Http\Controllers\User\UserAuthenticateController@AuthenticateUser');
Route::middleware('jwt.auth')->group(function () {
    Route::post('logout', 'App\Http\Controllers\User\UserAuthenticateController@LogoutUser');
});

//Route::resource('users', 'App\Http\Controllers\User\UserController');

Route::resource('posts', 'App\Http\Controllers\PostsController');
