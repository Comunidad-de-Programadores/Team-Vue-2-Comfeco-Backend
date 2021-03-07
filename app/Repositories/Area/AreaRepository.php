<?php

namespace App\Repositories\Area;

use Illuminate\Support\Facades\DB;
use App\Models\Area;

class AreaRepository
{
    public function getAreas() {
        return DB::table('areas')
            ->select(['id', 'name'])
            ->orderBy('order', 'asc')
            ->get();
    }
}
