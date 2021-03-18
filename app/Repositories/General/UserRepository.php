<?php

namespace App\Repositories\General;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\RecoverPasswordMail;
use App\Mail\CancelRecoverPasswordMail;
use App\Repositories\RoleRepository;
use App\Traits\FileMethods;

class UserRepository
{
    use FileMethods;

    public function store($data)
    {
        $roleRepository = app('App\Repositories\General\RoleRepository');
        $developerRoleId = $roleRepository->findByName('Developers')->id;
        $id = isset($data["id"]) ? $data["id"] : null;
        $model = User::updateOrCreate(['id' => $id], $data);

        if ($model->wasRecentlyCreated) {
            $model->roles()->sync([$developerRoleId]);
        }

        return $model;
    }

    public function updateProfile($user, $data)
    {
        if (isset($data['birthday']) && !is_null($data["birthday"])) {
            $data['birthday'] = date('Y-m-d', strtotime(\str_replace('/', '-', $data["birthday"])));
        }

        if (isset($data['password']) && (is_null($data["password"]) || ($data["password"] == ""))) {
            unset($data['password']);
        }

        if (isset($data['avatar']) && !is_null($data["avatar"])) {
            $file = $data['avatar'];
            if (strpos($file, 'base64') !== false) {
                @list($type, $file) = explode(';', $file);
                @list(, $file) = explode(',', $file);
                if ($file) {
                    $file = base64_decode($file);
                    $this->manageFile64($user, $file, 'avatar', 'public', 'users');
                }
            }
            unset($data['avatar']);
        }

        $user->update($data);

        $this->validateBadgeUpdateProfile($user);

        return $this->generalFields($user, true);
    }

    private function validateBadgeUpdateProfile($user)
    {
        $updateBadge = DB::table('badge_user')
            ->where('user_id', '=', $user->id)
            ->where('badge_id', '=', 8)
            ->select(DB::raw('count(*) as `update`'))
            ->get()[0];

        $updateBadge->update === 0 && ($user->badges()->sync(9));
    }

    private function validateBadgeLogin($user)
    {
        $loginBadge = DB::table('badge_user')
            ->where('user_id', '=', $user->id)
            ->where('badge_id', '=', 7)
            ->select(DB::raw('count(*) as login'))
            ->get()[0];

        $loginBadge->login === 0 && ($user->badges()->sync([8]));
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
        $user->recover_expiration_time = date("Y-m-d H:i:s", strtotime('+24 hours'));
        $user->update();

        $linkToRecoverPassword = env("APP_FRONTEND_URL") . "/recuperarClave/" . encrypt($user->email);
        $linkToCancelRecoverPassword = env("APP_FRONTEND_URL") . "/anularRecuperarClave/" . encrypt($user->email);

        Mail::to($user->email)->queue(new RecoverPasswordMail($linkToRecoverPassword, $linkToCancelRecoverPassword));

        return true;
    }

    public function validateRecoverPasswordExpiration($email)
    {
        $user = User::where('email', $email)->first();
        if (is_null($user)) {
            return [
                "error" => true,
                "errors" => "Este correo no está registrado"
            ];
        }

        if (is_null($user->recover_expiration_time) && $user->recover_password_flag == 0) {
            return [
                "error" => true,
                "errors" => 'Inválido'
            ];
        }

        $expiration_time = strtotime($user->recover_expiration_time);
        $current_time = time();
        $expirationFlag = $current_time <= $expiration_time;

        return [
            "error" => !$expirationFlag,
            "errors" => $expirationFlag ? 'Válido' : 'Inválido'
        ];
    }

    public function cancelRecoverPassword($email)
    {
        $user = User::where('email', $email)->first();
        if (is_null($user)) {
            return [
                "error" => true,
                "errors" => "Este correo no está registrado"
            ];
        }

        $user->recover_password_flag = false;
        $user->recover_expiration_time = null;
        $user->update();

        Mail::to($user->email)->queue(new CancelRecoverPasswordMail());

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
        $user->recover_expiration_time = null;
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
        $auxUser = $user->only([
            "id",
            "email",
            "name",
            "nickname",
            "avatar",
            "birthday",
            "genre",
            "country_id",
            "area_id",
            "facebook_url",
            "github_url",
            "twitter_url",
            "linkedin_url",
        ]);
        
        $auxUser['avatar'] = strpos($auxUser['avatar'], 'users/') !== false ? asset('storage/'. $auxUser['avatar']) : $auxUser['avatar'] ;

        $this->validateBadgeLogin($user);

        return $auxUser;
    }

    public function searchByEmail($email)
    {
        return User::whereEmail($email)->first();
    }
}
