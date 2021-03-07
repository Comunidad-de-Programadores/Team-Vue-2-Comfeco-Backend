<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use App\Repositories\General\UserRepository;
use App\Http\Requests\General\RegisterRequest;
use App\Http\Requests\General\RecoverPasswordRequest;
use App\Http\Requests\General\CancelRecoverPasswordRequest;
use App\Http\Requests\General\GeneratePasswordRequest;
use App\Http\Requests\General\UpdateProfileRequest;

class UserController extends CustomController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    public function store(RegisterRequest $request)
    {
        $fields = request(['name','email','password','nickname']);

        try {
            $user = $this->userRepository->store($fields);
            $token = $this->userRepository->createToken($user);
            $userFormatted = $this->userRepository->generalFields($user);
            $userFormatted = (object) array_merge((array) $userFormatted, (array) $token);
            $response = [
                "error" => false,
                "user" => $userFormatted
            ];
            return response()->json($response, $this->successStatus);
        } catch (\Throwable $th) {
            $response = [
                "error" => true,
                "messages" => [ "Error, contáctese con soporte técnico." ]
            ];
            return response()->json($response, $this->errorStatus);
        }
    }

    public function recoverPassword(RecoverPasswordRequest $request)
    {
        $check = $this->userRepository->recoverPassword(request('email'));
        if ($check) {
            $response = [
                'error' => false,
                'message' => 'Se enviará un correo para que pueda recuperar la contraseña'
            ];
            return response()->json($response, $this->successStatus);
        }

        return response()->json($check, $this->errorStatus);
    }

    public function validateRecoverPasswordExpiration(CancelRecoverPasswordRequest $request)
    {
        $email = decrypt(request('email'));
        $expirationValidation = $this->userRepository->validateRecoverPasswordExpiration($email);

        return response()->json($expirationValidation, $this->successStatus);
    }

    public function cancelRecoverPassword(CancelRecoverPasswordRequest $request)
    {
        $email = decrypt(request('email'));
        $check = $this->userRepository->cancelRecoverPassword($email);
        if ($check) {
            $response = [
                'error' => false,
                'message' => 'Recuperación correctamente anulada'
            ];
            return response()->json($response, $this->successStatus);
        }
        return response()->json($check, $this->errorStatus);
    }

    public function generatePassword(GeneratePasswordRequest $request)
    {
        $email = decrypt(request('email'));
        $password = request('password');
        $this->userRepository->generatePassword($email, $password);
        $response = [
            'error' => false,
            'message' => 'Clave actualizada correctamente'
        ];
        return response()->json($response, $this->successStatus);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = request()->only([
            'name',
            'nickname',
            'avatar',
            'birthday',
            'genre',
            'country_id',
            'area_id',
            'facebook_url',
            'github_url',
            'twitter_url',
            'linkedin_url',
            'password'
        ]);

        $user = request()->user();

        $response = [
            'error' => false,
            'message' => ''
        ];
        
        try {
            $userData = $this->userRepository->updateProfile($user, $data);
            $response['message'] = 'Perfil actualizado correctamente';
            $response['data'] = $userData;
        } catch (\Throwable $th) {
            $response['error'] = true;
            $response['message'] = $th->getMessage();
        }

        return response()->json($response, $response['error'] ? $this->successStatus : $this->errorStatus);
    }
}
