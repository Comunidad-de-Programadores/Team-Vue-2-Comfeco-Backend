<?php

namespace App\Repositories\General;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;
use App\Models\User;
use App\Mail\RecoverPasswordMail;

class UserRepository
{
    public function store($data)
    {
        $developerRoleId = 3;
        $id = isset($data["id"]) ? $data["id"] : null;
        $model = User::updateOrCreate(['id' => $id], $data);

        if ($model->wasRecentlyCreated) {
            $model->roles()->sync([$developerRoleId]);
        }

        return $model;
    }

    public function recoverPassword($email)
    {
        $user = User::where('email', $email)->first();
        if (is_null($user)) {
            return [
                "error" => true,
                "message" => "Este correo no está registrado"
            ];
        }

        $user->recover_password_flag = true;
        $user->update();

        $linkToRecoverPassword = "http://localhost:3000/recuperarClave?email=" . encrypt($user->email);
        $linkToCancelRecoverPassword = "http://localhost:3000/anularRecuperarClave?email=" . encrypt($user->email);

        Mail::to("ggalvez92@hotmail.com")->queue(new RecoverPasswordMail($linkToRecoverPassword, $linkToCancelRecoverPassword));

        return true;
    }

    public function cancelRecoverPassword($email)
    {
        $user = User::where('email', $email)->first();
        if (is_null($user)) {
            return [
                "error" => true,
                "message" => "Este correo no está registrado"
            ];
        }

        $user->recover_password_flag = false;
        $user->update();

        return true;
    }

    public function generatePassword($email, $password)
    {
        $user = User::where('email', $email)->first();
        if (is_null($user)) {
            return;
        }

        $user->password = $password;
        $user->recover_password_flag = false;
        $user->update();
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
