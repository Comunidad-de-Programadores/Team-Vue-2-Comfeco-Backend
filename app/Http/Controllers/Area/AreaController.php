<?php


namespace App\Http\Controllers\Area;

use App\Http\Controllers\CustomController;
//use Illuminate\Http\Request;
use App\Repositories\Area\AreaRepository;
//use App\Http\Requests\Area\AreaRequest;

class AreaController extends CustomController
{
    protected $areaRepository;

    public function __construct(AreaRepository $areaRepository)
    {
        parent::__construct();
        $this->areaRepository = $areaRepository;
    }

    public function getAreas()
    {
        return response()->json($this->areaRepository->getAreas(), $this->successStatus);
    }
}
