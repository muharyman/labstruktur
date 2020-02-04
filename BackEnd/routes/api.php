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

Route::group([    
    'namespace' => 'API\Auth',    
    'prefix' => 'auth'
], function () {    
    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
    Route::post('passwordreset/create', 'ForgotPasswordController@create');
    Route::get('passwordreset/check/{token}', 'ForgotPasswordController@check')->name('passwordreset.check');
    Route::post('passwordreset/reset', 'ForgotPasswordController@reset');
    Route::post('verifyemail/send', 'VerifyEmailController@send');
    Route::get('verifyemail/verify/{token}', 'VerifyEmailController@verify')->name('verifyemail.verify');
});
 
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
