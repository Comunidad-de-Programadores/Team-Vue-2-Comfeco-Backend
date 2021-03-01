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

    public function findById($id)
    {
        $detail = Community::where('id', $id)
                        ->select('id', 'name', 'slug', 'order')
                        ->first();
                        
        return $detail;
    }
}
