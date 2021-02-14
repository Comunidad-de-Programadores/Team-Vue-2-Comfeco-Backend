<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\General\UserRepository;
use App\Http\Requests\General\RegisterRequest;
use App\Http\Requests\General\RecoverPasswordRequest;
use App\Http\Requests\General\CancelRecoverPasswordRequest;
use App\Http\Requests\General\GeneratePasswordRequest;

class UserController extends Controller
{
    protected $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(RegisterRequest $request)
    {
        $fields = request(['name','email','password','phone']);
        
        try {
            $user = $this->userRepository->store($fields);
            $token = $this->userRepository->createToken($user);
            $userFormatted = $this->userRepository->generalFields($user);
            $userFormatted = (object) array_merge((array) $userFormatted, (array) $token);
            $response = [
                "error" => false,
                "user" => $userFormatted
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                "error" => true,
                "messages" => [ "Error, contáctese con soporte técnico." ]
            ];
            return response()->json($response, 422);
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
            return response()->json($response, 200);
        }
        return response()->json($check, 200);
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
            return response()->json($response, 200);
        }
        return response()->json($check, 200);
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
        return response()->json($response, 200);
    }
}
