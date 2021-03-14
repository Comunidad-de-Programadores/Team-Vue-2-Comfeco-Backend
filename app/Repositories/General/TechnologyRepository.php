<?php

namespace App\Repositories\General;
use App\Models\Technology;

class TechnologyRepository
{
    public function getTechnologies(){
        $technologies = Technology::all();

        return $technologies;
    }
}
