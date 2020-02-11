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
    'namespace' => 'API',
    'middleware' => 'cors',
], function() {
    // Authentication
    Route::group([    
        'namespace' => 'Auth',    
        'prefix' => 'auth'
    ], function () {    
        Route::post('login', 'LoginController@login');
        Route::get('logout', 'LogoutController@logout')->middleware('auth:api');
        Route::post('register', 'RegisterController@register');
        Route::post('passwordreset/create', 'ForgotPasswordController@create');
        Route::get('passwordreset/check/{token}', 'ForgotPasswordController@check')->name('passwordreset.check');
        Route::post('passwordreset/reset', 'ForgotPasswordController@reset');
        Route::post('verifyemail/send', 'VerifyEmailController@send');
        Route::get('verifyemail/verify/{token}', 'VerifyEmailController@verify')->name('verifyemail.verify');
    });

    // User 
    Route::group([
        'namespace' => 'User',
        'middleware' => 'auth:api',
        'prefix' => 'user'
    ], function () {
        Route::get('index', 'CRUDController@index');
        Route::get('show/{id}', 'CRUDController@show');
        Route::post('create', 'CRUDController@store');
        Route::put('update/{id}', 'CRUDController@update');
        Route::delete('delete/{id}', 'CRUDController@delete');
    });
    
    // Pengujian 
    Route::group([
        'namespace' => 'Pengujian',
        'prefix' => 'pengujian'
    ], function () {
        Route::post('create', 'CRUDController@store');
        Route::group([
            'middleware' => 'auth:api',
        ], function () {
            Route::get('index', 'CRUDController@index');
            Route::get('show/{id}', 'CRUDController@show');
            Route::post('update/{id}', 'CRUDController@update');
            Route::delete('delete/{id}', 'CRUDController@delete');
            Route::get('filter', 'GetController@indexWithFilter');
        });
    });

    // Pembayaran 
    Route::group([
        'namespace' => 'Pembayaran',
        'middleware' => 'auth:api',
        'prefix' => 'pembayaran',
    ], function () {
        Route::get('index', 'CRUDController@index');
        Route::get('show/{id}', 'CRUDController@show');
        Route::post('create', 'CRUDController@store');
        Route::put('update/{id}', 'CRUDController@update');
        Route::delete('delete/{id}', 'CRUDController@delete');
    });

    // Log
    Route::group([
        'namespace' => 'Log',
        'middleware' => 'auth:api',
        'prefix' => 'log'
    ], function () {
        Route::get('index', 'CRUDController@index');
        Route::get('show/{id}', 'CRUDController@show');
        Route::post('create', 'CRUDController@store');
        Route::put('update/{id}', 'CRUDController@update');
        Route::delete('delete/{id}', 'CRUDController@delete');
    });

    // Kategori Pengujian
    Route::group([
        'namespace' => 'KategoriPengujian',
        'middleware' => 'auth:api',
        'prefix' => 'kategoripengujian'
    ], function () {
        Route::get('index', 'CRUDController@index');
        Route::get('show/{id}', 'CRUDController@show');
        Route::post('create', 'CRUDController@store');
        Route::put('update/{id}', 'CRUDController@update');
        Route::delete('delete/{id}', 'CRUDController@delete');
    });

    // Jenis Pengujian
    Route::group([
        'namespace' => 'JenisPengujian',
        'middleware' => 'auth:api',
        'prefix' => 'jenispengujian'
    ], function () {
        Route::get('index', 'CRUDController@index');
        Route::get('show/{id}', 'CRUDController@show');
        Route::post('create', 'CRUDController@store');
        Route::put('update/{id}', 'CRUDController@update');
        Route::delete('delete/{id}', 'CRUDController@delete');
    });

    // Jabatan
    Route::group([
        'namespace' => 'Jabatan',
        'middleware' => 'auth:api',
        'prefix' => 'jabatan'
    ], function () {
        Route::get('index', 'CRUDController@index');
        Route::get('show/{id}', 'CRUDController@show');
        Route::post('create', 'CRUDController@store');
        Route::put('update/{id}', 'CRUDController@update');
        Route::delete('delete/{id}', 'CRUDController@delete');
    });

    // Item Pengujian
    Route::group([
        'namespace' => 'ItemPengujian',
        'middleware' => 'auth:api',
        'prefix' => 'itempengujian'
    ], function () {
        Route::get('index', 'CRUDController@index');
        Route::get('show/{id}', 'CRUDController@show');
        Route::post('create', 'CRUDController@store');
        Route::post('update/{id}', 'CRUDController@update');
        Route::delete('delete/{id}', 'CRUDController@delete');
    });
});

 
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
