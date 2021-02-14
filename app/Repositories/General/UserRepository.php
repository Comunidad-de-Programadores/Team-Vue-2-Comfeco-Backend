<?php

namespace App\Repositories\General;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class UserRepository
{
    public function store($data)
    {
        $id = isset($data["id"]) ? $data["id"] : null;
        $model = User::updateOrCreate(['id' => $id], $data);

        return $model;
    }

    public function createToken($user, $rememberMe = false)
    {
        $tokenResult = $user->createToken('Api user token', ['app-client-guest','app-client-logged']);
        $tokenModel = $tokenResult->token;
        $tokenModel->expires_at = $rememberMe ? now()->addMonths(1) : now()->addHours(24);
        $tokenModel->save();

        return [
            "access_token" => $tokenResult->accessToken,
            "expires_at" => Carbon::parse($tokenModel->expires_at)->toDateTimeString()
        ];
    }

    public function generalFields($user)
    {
        return $user->only(["id", "email", "name", "phone" ]);
    }
}
