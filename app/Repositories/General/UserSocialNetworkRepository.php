<?php

namespace App\Repositories\General;

use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserSocialNetwork;

class UserSocialNetworkRepository
{
    public function store($data)
    {
        $model = UserSocialNetwork::create($data);

        return $model;
    }
    
    public function updateData(array$data)
    {
        $model = UserSocialNetwork::find($data["id"]);
        if (is_null($model)) {
            return null;
        }

        $flag = $model->update($data);

        return $flag;
    }

    public function searchUserByProvider($user_id, $provider_id)
    {
        $model = UserSocialNetwork::where('provider_id', $provider_id)
                            ->where('user_id', $user_id)
                            ->first();
        
        return $model;
    }

    public function manageSocialObj($socialUser)
    {
        $userRepository = app('App\Repositories\General\UserRepository');
        $user = $userRepository->searchByEmail($socialUser->email);
        $avatar = isset($socialUser->avatar) ? $socialUser->avatar : null;
        $userFields = [
            'email' => $socialUser->email,
            'name' => $socialUser->name,
            'avatar' => isset($socialUser->avatar_original) ? $socialUser->avatar_original : $avatar
        ];
        $socialiteFields = [
            'user_id' => null,
            'provider' => $socialUser->provider,
            'provider_id' => $socialUser->id,
            'expires_in' => $socialUser->expiresIn,
            'token' => $socialUser->token,
            'refresh_token' => isset($socialUser->refresh_token) ? $socialUser->refresh_token : '',
            'avatar_normal' => $avatar,
            'avatar_original' => isset($socialUser->avatar_original) ? $socialUser->avatar_original : $avatar,
            'verified_email' => isset($socialUser->user["verified_email"]) ? $socialUser->user["verified_email"] : 0,
        ];
        if (is_null($user)) {
            $user = $userRepository->store($userFields);
        } else {
            $user->update($userFields);
        }

        $socialiteFields["user_id"] = $user->id;

        $socialite_user = $this->searchUserByProvider($socialiteFields["user_id"], $socialiteFields["provider_id"]);
        if (is_null($socialite_user)) {
            $socialite_user = $this->store($socialiteFields);
        } else {
            $socialite_user->update($socialiteFields);
        }

        return $user;
    }
}
