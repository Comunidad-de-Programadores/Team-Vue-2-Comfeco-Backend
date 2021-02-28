<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use App\Repositories\General\SponsorRepository;

class SponsorController extends CustomController
{
    protected $sponsorRepository;

    public function __construct(SponsorRepository $sponsorRepository)
    {
        parent::__construct();
        $this->sponsorRepository = $sponsorRepository;
    }

    public function list()
    {
        $records = $this->sponsorRepository->list();
        return response()->json(['records' => $records], $this->successStatus);
    }
}
