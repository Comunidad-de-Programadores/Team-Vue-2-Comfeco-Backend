<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use App\Repositories\General\WorkshopRepository;
use App\Http\Requests\General\WorkshopRequest;

class WorkshopController extends CustomController
{
    protected $workshopRepository;

    public function __construct(WorkshopRepository $workshopRepository)
    {
        parent::__construct();
        $this->workshopRepository = $workshopRepository;
    }

    public function list()
    {
        $name = request('area');
        $records = $this->workshopRepository->list($name);
        return response()->json(['records' => $records], $this->successStatus);
    }
}
