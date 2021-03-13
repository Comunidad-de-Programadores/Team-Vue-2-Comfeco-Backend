<?php


namespace App\Http\Controllers\Country;

use App\Http\Controllers\CustomController;
//use Illuminate\Http\Request;
use App\Repositories\Country\CountryRepository;
//use App\Http\Requests\Area\AreaRequest;

class CountryController extends CustomController
{
    protected $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        parent::__construct();
        $this->countryRepository = $countryRepository;
    }

    public function getCountries()
    {
        return response()->json($this->countryRepository->getCountries(), $this->successStatus);
    }
}
