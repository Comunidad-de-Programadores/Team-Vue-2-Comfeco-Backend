<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\General\SponsorRepository;

class SponsorController extends Controller
{
    protected $sponsorRepository;

    public function __construct(SponsorRepository $sponsorRepository)
    {
        $this->sponsorRepository = $sponsorRepository;
    }

    public function list()
    {
        $records = $this->sponsorRepository->list();

        return response()->json(['records' => $records], 200);
    }
}
