<?php

namespace App\Http\Controllers\Technology;

use App\Http\Controllers\CustomController;
use App\Repositories\General\TechnologyRepository;

class TechnologyController extends CustomController
{
    protected $technologyRepository;

    public function __construct(TechnologyRepository $technologyRepository)
    {
        parent::__construct();
        $this->technologyRepository = $technologyRepository;
    }

    public function index()
    {
        $technologies = $this->technologyRepository->getTechnologies();
        return response()->json(['technologies' => $technologies], $this->successStatus);
    }
}
