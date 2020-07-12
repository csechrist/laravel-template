<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Route::get( '', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm'] );
Route::post( '', ['as' => 'login', 'uses' => 'Auth\LoginController@login'] );

Route::get( 'register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm'] );
Route::post( 'register', ['as' => 'register', 'uses' => 'Auth\RegisterController@register'] )->middleware( 'recaptcha:register' );

Route::get( 'reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'] );
Route::post( 'reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'] );

Route::group([ 'prefix' => 'provider' ], function() {
    Route::get('{provider}', ['as' => 'provider.auth', 'uses' => 'Auth\ThirdPartyLoginController@redirectToProvider']);
    Route::get('{provider}/callback', ['as' => 'provider.callback', 'uses' => 'Auth\ThirdPartyLoginController@handleCallback']);

});

Auth::routes( ['login' => false, 'register' => false, 'verify' => true] );

Route::get( '/home', 'HomeController@index' )->name( 'home' );

Route::get('logout', function(Request $request) {
    Session::flush();
    Auth::logout();
    return redirect()->route('login')->with(['message' => 'You have been logged out.', 'alert-type' => "success"]);
});
