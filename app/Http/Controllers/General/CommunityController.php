<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\General\CommunityRepository;

class CommunityController extends Controller
{
    protected $communityRepository;

    public function __construct(CommunityRepository $communityRepository)
    {
        $this->communityRepository = $communityRepository;
    }

    public function list()
    {
        $records = $this->communityRepository->list();
        return response()->json(['records' => $records], 200);
    }
}
