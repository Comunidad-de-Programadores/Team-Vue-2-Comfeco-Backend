<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/***** GENERAL ******/
use App\Http\Controllers\General\LoginController as GeneralLogin;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'prefix' => 'v1',
], function () {
    Route::group([
        'middleware' => ['client:app-client-guest'],
    ], function () {
        Route::post('login', [GeneralLogin::class,'login'])->name('login');
    });
});
