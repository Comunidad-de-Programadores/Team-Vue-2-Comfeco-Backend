<?php

namespace App\Http\Controllers\Badge;

use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use App\Repositories\Badge\BadgeRepository;

class BadgeController extends CustomController
{
    protected $badgeRepository;

    public function __construct(BadgeRepository $badgeRepository)
    {
        parent::__construct();
        $this->badgeRepository = $badgeRepository;
    }

    public function getBadges()
    {
        $badges = $this->badgeRepository->getBadges();
        return response()->json(['badges' => $badges], $this->successStatus);
    }
}
