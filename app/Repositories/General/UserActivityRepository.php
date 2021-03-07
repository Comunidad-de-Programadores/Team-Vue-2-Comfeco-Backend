<?php

namespace App\Repositories\General;

use App\Models\UserActivity;
use Illuminate\Support\Facades\DB;

class UserActivityRepository
{
    public function listByUser($userId)
    {
        $storageUrl = asset('storage/');
        DB::statement(DB::raw("SET @storageUrl = '${storageUrl}'"));
        $records = UserActivity::selectRaw("
                            id,
                            activity,
                            CASE WHEN image_url IS NULL 
                                THEN ''
                            ELSE
                                CONCAT(@storageUrl,'/',image_url)
                            END as image_url
                        ")
                        ->where('user_id', $userId)
                        ->orderBy('id', 'desc')
                        ->get();

        return $records;
    }
}
