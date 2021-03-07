<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use App\Repositories\General\BadgeUserRepository;

class BadgeUserController extends CustomController
{
    protected $badgeUserRepository;

    public function __construct(BadgeUserRepository $badgeUserRepository)
    {
        parent::__construct();
        $this->badgeUserRepository = $badgeUserRepository;
    }

    public function getListAssigned()
    {
        $records = $this->badgeUserRepository->getListAssigned(request()->user());
        return response()->json(['records' => $records], $this->successStatus);
    }
}
