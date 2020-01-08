<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login', 'SocialiteController@redirect')->name('login');
Route::get('auth-callback', 'SocialiteController@callback');
Route::post('logout', 'SocialiteController@logout')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/account/me', 'AccountController@me')->name('me');
    Route::get('/account/me_facade', 'AccountController@meFacade')->name('me_facade');
    Route::get('/account/me_trait', 'AccountController@meTrait')->name('me_trait');
    Route::get('/account/me_macro', 'AccountController@meMacro')->name('me_macro');

    Route::get('refresh', 'RefreshController')->name('refresh_token');
});
