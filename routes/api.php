<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/***** GENERAL ******/
use App\Http\Controllers\General\LoginController as GeneralLogin;
use App\Http\Controllers\General\SocialLoginController as GeneralSocialLogin;
use App\Http\Controllers\General\UserController as GeneralUser;
use App\Http\Controllers\General\SponsorController as GeneralSponsor;
use App\Http\Controllers\General\WorkshopController as GeneralWorkshop;
use App\Http\Controllers\General\CommunityController as GeneralCommunity;
use App\Http\Controllers\General\MentorController as GeneralMentor;
use App\Http\Controllers\General\BadgeUserController as GeneralBadgeUser;
use App\Http\Controllers\General\ComfecoEventController as GeneralComfecoEvent;
use App\Http\Controllers\General\UserActivityController as GeneralUserActivity;
/******* USER  *******/

use App\Http\Controllers\User\UserController as User;

/******* AREA  *******/

use App\Http\Controllers\Area\AreaController as Area;

/******* COUNTRY  *******/

use App\Http\Controllers\Country\CountryController as Country;

/******* BADGE  *******/

use App\Http\Controllers\Badge\BadgeController as Badge;
use App\Http\Controllers\Technology\TechnologyController;
use App\Http\Controllers\Team\TeamController;

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
        Route::get('communities', [GeneralCommunity::class,'list'])->name('communities.list');
        Route::get('communities/{id}', [GeneralCommunity::class,'detail'])->name('communities.detail');
        Route::get('mentors', [GeneralMentor::class,'list'])->name('mentors.list');
        Route::get('badges', [ Badge::class,'getBadges' ])->name('badges');
        Route::apiResource('teams', TeamController::class)->only(['index']);
        Route::apiResource('technologies', TechnologyController::class)->only(['index']);
    });

    Route::group([
        'middleware' => ['auth:api'],
    ], function () {
        Route::get('user', [GeneralUser::class,'getUser'])->name('user');
        Route::get('getAreas', [Area::class,'getAreas'])->name('area.get');
        Route::get('getCountries', [Country::class,'getCountries'])->name('country.get');
        Route::post('updateProfile', [GeneralUser::class,'updateProfile'])->name('updateProfile');

        Route::get('users/badges', [GeneralBadgeUser::class,'getListAssigned'])->name('users.badges');
        Route::get('comfecoEvents', [GeneralComfecoEvent::class,'list'])->name('comfecoEvents.list');
        Route::get('comfecoEvents/{comfecoEventId}', [GeneralComfecoEvent::class,'detail'])->name('comfecoEvents.detail');
        Route::put('comfecoEvents/{comfecoEventId}/assign', [GeneralComfecoEvent::class,'attachToUser'])->name('comfecoEvents.attach');
        Route::put('comfecoEvents/{comfecoEventId}/unassign', [GeneralComfecoEvent::class,'detachToUser'])->name('comfecoEvents.detach');
        Route::get('users/comfecoEvents', [GeneralComfecoEvent::class,'listByUser'])->name('users.comfecoEvents');
        Route::get('users/activities', [GeneralUserActivity::class,'listByUser'])->name('users.activities');

        Route::post('createBadge', [GeneralBadgeUser::class,'store'])->name('store');
        Route::post('updateBadge', [GeneralBadgeUser::class,'updateBadge'])->name('update');

        Route::get('teams/me', [ TeamController::class,'currentTeam' ])->name('current_team');
        Route::delete('teams/me', [ TeamController::class,'leaveTeam' ])->name('current_team');
        Route::post('teams/{id}/members', [ TeamController::class,'joinTeam' ])->name('join_team');
    });
});
