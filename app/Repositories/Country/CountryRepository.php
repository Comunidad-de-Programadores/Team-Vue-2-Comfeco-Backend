<?php

namespace App\Repositories\Country;

use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CountryRepository
{
    public function getCountries() {
        return DB::table('countries')
            ->select(['id', 'name'])
            ->orderBy('order', 'asc')
            ->get();
    }
}
