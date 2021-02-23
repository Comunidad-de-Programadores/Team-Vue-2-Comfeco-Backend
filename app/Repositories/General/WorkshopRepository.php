<?php

namespace App\Repositories\General;

use App\Models\Workshop;

class WorkshopRepository
{
    public function list($search)
    {
        $perPage = 5;
        $workshops = Workshop::where('area', 'like', '%' . $search . '%')->paginate($perPage);
        $workshops->appends(['name' => $search]);
        return $workshops;
    }
}
