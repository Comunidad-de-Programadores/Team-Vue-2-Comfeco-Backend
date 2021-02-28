<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Http\Requests\General\LoginRequest;
use App\Repositories\General\UserRepository;

class LoginController extends CustomController
{
    public function login(LoginRequest $request, UserRepository $userRepository)
    {
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            $response = [
                "error" => true,
                "messages" => [ "Clave o correo erróneos" ]
            ];
            return response()->json($response, $this->errorStatus);
        }
      
        $user = request()->user();
        $rememberMe = request('rememberMe', false);
        $token = $userRepository->createToken($user, $rememberMe);
        
        $userFormatted = $userRepository->generalFields($user);
        $userFormatted = (object) array_merge((array) $userFormatted, (array) $token);

        $response = [
            "error" => false,
            "user" => $userFormatted
        ];
            
        return response()->json($response, $this->successStatus);
    }
}
