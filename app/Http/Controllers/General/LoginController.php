<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\General\LoginRequest;
use Auth;
use Carbon\Carbon;
use App\Repositories\General\UserRepository;

class LoginController extends Controller
{
    public function login(LoginRequest $request, UserRepository $userRepository)
    {
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            $response = [
                "error" => true,
                "errors" => [ "Clave o correo erróneos" ]
            ];
            return response()->json($response, 200);
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
            
        return response()->json($response, 200);
    }
}
