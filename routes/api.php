<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/***** GENERAL ******/
use App\Http\Controllers\General\LoginController as GeneralLogin;
use App\Http\Controllers\General\UserController as GeneralUser;

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
        Route::post('register', [GeneralUser::class,'store'])->name('register');
        Route::post('recoverPassword', [GeneralUser::class,'recoverPassword'])->name('recoverPassword');
        Route::post('generatePassword', [GeneralUser::class,'generatePassword'])->name('generatePassword');
    });
});
