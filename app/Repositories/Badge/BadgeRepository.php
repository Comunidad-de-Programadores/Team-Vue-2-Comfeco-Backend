<?php

namespace App\Repositories\Badge;
use App\Models\Badge;
use Illuminate\Support\Facades\DB;

class BadgeRepository
{
    public function getBadges(){
        $perPage = 5;
        $storageUrl = asset('storage/');
        DB::statement(DB::raw("SET @storageUrl = '${storageUrl}'"));
        $badges = Badge::selectRaw("
            badges.id,
            badges.name,
            CASE WHEN badges.image_url IS NULL 
                THEN ''
            ELSE
                CONCAT(@storageUrl,'/',badges.image_url)
            END as image_url,
            description,
            how_win
        ")->paginate($perPage);

        return $badges;
    }
}
