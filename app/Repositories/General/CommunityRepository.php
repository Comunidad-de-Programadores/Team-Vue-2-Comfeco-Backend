<?php

namespace App\Repositories\General;

use App\Models\Community;

class CommunityRepository
{
    public function list()
    {
        $records = Community::select('id', 'name', 'slug', 'order')->orderBy('order')->get();

        return $records;
    }
}
