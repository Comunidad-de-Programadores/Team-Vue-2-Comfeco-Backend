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

    public function manageSocialObj($social_user)
    {
        $userRepository = app('App\Repositories\General\UserRepository');
        $user = $userRepository->searchByEmail($social_user->email);
        $avatar = isset($social_user->avatar) ? $social_user->avatar : null;
        $userFields = [
            'email' => $social_user->email,
            'name' => $social_user->name,
        ];
        $socialiteFields = [
            'user_id' => null,
            'provider' => $social_user->provider,
            'provider_id' => $social_user->id,
            'expires_in' => $social_user->expiresIn,
            'token' => $social_user->token,
            'refresh_token' => isset($social_user->refresh_token) ? $social_user->refresh_token : '',
            'avatar_normal' => $avatar,
            'avatar_original' => isset($social_user->avatar_original) ? $social_user->avatar_original : $avatar,
            'verified_email' => isset($social_user->user["verified_email"]) ? $social_user->user["verified_email"] : 0,
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
