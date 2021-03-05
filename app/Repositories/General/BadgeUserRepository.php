<?php

namespace App\Repositories\General;

use Illuminate\Support\Facades\DB;

class BadgeUserRepository
{
    public function getListAssigned($user)
    {
        $storageUrl = asset('storage/');
        DB::statement(DB::raw("SET @storageUrl = '${storageUrl}'"));
        $badgesAssigned = $user->badges()
                            ->selectRaw("
                                badges.id,
                                badges.name,
                                CASE WHEN badges.image_url IS NULL 
                                    THEN ''
                                ELSE
                                    CONCAT(@storageUrl,'/',badges.image_url)
                                END as image_url
                            ")
                            ->get();

        return $badgesAssigned;
    }
}
