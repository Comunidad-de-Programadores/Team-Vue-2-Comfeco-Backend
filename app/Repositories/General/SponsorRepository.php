<?php

namespace App\Repositories\General;

use App\Models\Sponsor;

class SponsorRepository
{
    public function list()
    {
        $records = Sponsor::select('id', 'name', 'image_url', 'order')->orderBy('order')->get();

        return $records;
    }
}
