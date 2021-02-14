<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\General\UserRepository;
use App\Http\Requests\General\RegisterRequest;

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
}
