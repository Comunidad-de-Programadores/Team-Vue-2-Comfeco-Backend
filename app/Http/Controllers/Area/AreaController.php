<?php


namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Repositories\Area\AreaRepository;
//use App\Http\Requests\Area\AreaRequest;

class AreaController extends Controller
{
    protected $areaRepository;

    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function getAreas()
    {
        return response()->json($this->areaRepository->getAreas(), 200);
    }
}
