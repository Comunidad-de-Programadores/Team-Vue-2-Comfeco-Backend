<?php

namespace App\Repositories\General;

use App\Models\Workshop;

class WorkshopRepository
{
    public function list($search)
    {

        $workshops = Workshop::where('area', 'like', '%' . $search . '%')->paginate(5);

        $workshops->appends(['name' => $search]);
        
        return $workshops;
    }
}
