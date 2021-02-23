<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\General\WorkshopRepository;
use App\Http\Requests\General\WorkshopRequest;

class WorkshopController extends Controller
{
    protected $workshopRepository;

    public function __construct(WorkshopRepository $workshopRepository)
    {
        $this->workshopRepository = $workshopRepository;
    }

    public function list()
    {
        $name = request('area');

        $records = $this->workshopRepository->list($name);

        return response()->json(['records' => $records], 200);
    }
}
