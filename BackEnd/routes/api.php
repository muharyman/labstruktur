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
        Route::group([
            'middleware' => 'scope:1,2'
        ], function(){
            Route::get('index', 'CRUDController@index');
            Route::post('create', 'CRUDController@store');
            Route::delete('delete/{id}', 'CRUDController@delete');
            Route::post('update/multiple', 'UpdateController@multipleUpdateOrCreate');
        });
        Route::get('show/{id}', 'CRUDController@show');
        Route::put('update/{id}', 'CRUDController@update');
    });
    Route::get('user/index/role', 'User\GetController@getByRoles');
    
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
            Route::delete('delete/{id}', 'CRUDController@delete')->middleware('scope:1,2,3');
            Route::get('filter', 'GetController@indexWithFilter');
            Route::get('show/relation/{id}', 'GetController@getWithRelation');
            Route::delete('deletelaporan/{id}', "DeleteController@deleteLaporan");
        });
    });

    // Pembayaran 
    Route::group([
        'namespace' => 'Pembayaran',
        'middleware' => 'auth:api',
        'prefix' => 'pembayaran',
    ], function () {
        Route::group([
            'scope:1,2,3,4'
        ], function(){
            Route::get('index', 'CRUDController@index');
            Route::get('show/{id}', 'CRUDController@show');
            Route::post('create', 'CRUDController@store');
            Route::put('update/{id}', 'CRUDController@update');
            Route::delete('delete/{id}', 'CRUDController@delete');
            Route::post('update/multiple', 'UpdateController@multipleUpdateOrCreate');
            Route::get('kuitansi/{id}', 'LaporanController@kuitansi');
            Route::get('getbypengujian', 'GetController@getByPengujian');
        });
        Route::get('laporanbulanan', 'LaporanController@laporanBulanan')->middleware('scope:1,2');
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
        'middleware' => ['auth:api','scope:1,2,3,4'],
        'prefix' => 'itempengujian'
    ], function () {
        Route::get('index', 'CRUDController@index');
        Route::get('show/{id}', 'CRUDController@show');
        Route::post('create', 'CRUDController@store');
        Route::put('update/{id}', 'CRUDController@update');
        Route::delete('delete/{id}', 'CRUDController@delete');
        Route::post('update/multiple', 'UpdateController@multipleUpdateOrCreate');
        Route::get('getbypengujian', 'GetController@getByPengujian');
    });

    // Foto Inventaris
    Route::group([
        'namespace' => 'FotoInventaris',
        'middleware' => ['auth:api', 'scope:1,2,3,4'],
        'prefix' => 'fotoinventaris'
    ], function () {
        Route::get('index', 'CRUDController@index');
        Route::get('show/{id}', 'CRUDController@show');
        Route::post('create', 'CRUDController@store');
        Route::post('update/{id}', 'CRUDController@update');
        Route::delete('delete/{id}', 'CRUDController@delete');
    });

    // Inventaris
    Route::group([
        'namespace' => 'Inventaris',
        'middleware' => ['auth:api', 'scope:1,2,3,4'],
        'prefix' => 'inventaris'
    ], function () {
        Route::get('index', 'CRUDController@index');
        Route::get('show/{id}', 'CRUDController@show');
        Route::post('create', 'CRUDController@store');
        Route::post('update/{id}', 'CRUDController@update');
        Route::delete('delete/{id}', 'CRUDController@delete');
        Route::post('import', 'ImportController@import');
        Route::delete('deletefile/{id}', 'DeleteController@deleteFile');
    });

    // Foto Landing Page
    Route::group([
        'namespace' => 'FotoLandingPage',
        'middleware' => 'auth:api',
        'prefix' => 'fotolandingpage'
    ], function () {
        Route::get('index', 'CRUDController@index');
        Route::get('show/{id}', 'CRUDController@show');
        Route::group([
            'middleware' => 'scope:1,2'
        ], function (){
            Route::post('create', 'CRUDController@store');
            Route::post('update/{id}', 'CRUDController@update');
            Route::delete('delete/{id}', 'CRUDController@delete');
        });
    });

    // Landing Page
    Route::group([
        'prefix' => 'landingpage',
    ], function () {
        Route::get('get', 'LandingPageController@get');
        Route::post('edit', 'LandingPageController@edit')->middleware(['auth:api', 'scope:1,2']);
    });
});

// get file
Route::get('getfile', function(Request $request) {
    return Storage::response($request->input('filepath'));
})->name('getfile');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
