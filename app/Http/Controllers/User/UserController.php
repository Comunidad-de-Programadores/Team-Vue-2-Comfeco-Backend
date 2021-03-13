<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\CustomController;
//use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Http\Requests\User\UserRequest;

class UserController extends CustomController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    public function getUserConnected(UserRequest $request)
    {
        return response()->json($this->userRepository->getUserActualConnected(request('id')), $this->successStatus);
    }
}
