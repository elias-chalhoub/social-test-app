<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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


/**
 * Login
 */
Auth::routes();

/**
* Users
*/
Route::group(['prefix' => 'user', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/', 'UserController@current');
    // Not acceptable, but for a test project let's be fine with it.
    Route::get('/all', 'UserController@all');
    Route::get('/posts', 'UserController@posts');
    Route::get('/followers', 'UserController@followers');
    Route::get('/followings', 'UserController@followings');
    Route::get('/followings/posts', 'UserController@followingsPosts');

    // Follow/Unfollow.
    Route::post('/follow/{user_id}', 'UserController@follow');
    Route::delete('/unfollow/{user_id}', 'UserController@unfollow');
});

/**
 * CRUD Resources
 */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('post', 'PostController');
});
