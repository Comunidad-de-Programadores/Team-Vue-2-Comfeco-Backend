<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use App\Repositories\General\UserActivityRepository;

class UserActivityController extends CustomController
{
    protected $userActivityRepository;

    public function __construct(UserActivityRepository $userActivityRepository)
    {
        parent::__construct();
        $this->userActivityRepository = $userActivityRepository;
    }

    public function listByUser()
    {
        $records = $this->userActivityRepository->listByUser(request()->user()->id);
        return response()->json(['records' => $records], $this->successStatus);
    }
}
