<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Http\Requests\User\UserRequest;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserConnected( $request )
    {
        return response()->json($this->userRepository->getUserActualConnected(request('id')), 200);
    }
}
