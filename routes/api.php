<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/***** GENERAL ******/
use App\Http\Controllers\General\LoginController as GeneralLogin;
use App\Http\Controllers\General\SocialLoginController as GeneralSocialLogin;
use App\Http\Controllers\General\UserController as GeneralUser;
use App\Http\Controllers\General\SponsorController as GeneralSponsor;
use App\Http\Controllers\General\WorkshopController as GeneralWorkshop;

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
        Route::post('socialLogin', [GeneralSocialLogin::class,'login'])->name('socialLogin');
        Route::post('recoverPassword', [GeneralUser::class,'recoverPassword'])->name('recoverPassword');
        Route::get('validateRecoverPasswordExpiration', [GeneralUser::class,'validateRecoverPasswordExpiration'])->name('validateRecoverPasswordExpiration');
        Route::post('cancelRecoverPassword', [GeneralUser::class,'cancelRecoverPassword'])->name('cancelRecoverPassword');
        Route::post('generatePassword', [GeneralUser::class,'generatePassword'])->name('generatePassword');


        Route::get('sponsors', [GeneralSponsor::class,'list'])->name('sponsors.list');
        Route::get('workshops', [GeneralWorkshop::class,'list'])->name('workshops.list');
    });
});
