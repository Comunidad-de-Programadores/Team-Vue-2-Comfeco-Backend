<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use App\Repositories\General\CommunityRepository;

class CommunityController extends CustomController
{
    protected $communityRepository;

    public function __construct(CommunityRepository $communityRepository)
    {
        parent::__construct();
        $this->communityRepository = $communityRepository;
    }

    public function list()
    {
        $records = $this->communityRepository->list();
        return response()->json(['records' => $records], $this->successStatus);
    }

    public function detail()
    {
        $detail = $this->communityRepository->findById(request('id'));
        return response()->json(['data' => $detail], $this->successStatus);
    }
}
