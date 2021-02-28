<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use App\Http\Requests\General\SocialLoginRequest;
use App\Repositories\General\UserRepository;
use App\Repositories\General\UserSocialNetworkRepository;

class SocialLoginController extends CustomController
{
    public function login(SocialLoginRequest $request, UserRepository $userRepository, UserSocialNetworkRepository $userSocialRepository)
    {
        $social_user = (object)request()->all();
       
        $user = $userSocialRepository->manageSocialObj($social_user);
        $token = $userRepository->createToken($user);

        $userFormatted = $userRepository->generalFields($user);
        $userFormatted = (object) array_merge((array) $userFormatted, (array) $token);
        $userFormatted->provider = $social_user->provider;

        $response = [
            "error" => false,
            "user" => $userFormatted
        ];

        return response($response, $this->successStatus);
    }
}
