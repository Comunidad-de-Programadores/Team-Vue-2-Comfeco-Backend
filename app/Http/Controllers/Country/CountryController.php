<?php


namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Repositories\Country\CountryRepository;
//use App\Http\Requests\Area\AreaRequest;

class CountryController extends Controller
{
    protected $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function getCountries()
    {
        return response()->json($this->countryRepository->getCountries(), 200);
    }
}
